<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Changes_To_Module_Registration_Form extends CI_Controller {

	private $allowed_permissions;

	function __construct()
	{
		parent::__construct();

		//Check is loggied in to system
		if ($this->session->is_loggedin == false) {
			redirect('login');
		}

		$this->load->model("ChangesToModuleRegistrationModel");
		$this->load->model("UomUserModel");
		$this->load->model("ApprovalProcessModel");
		$this->load->model("MeetingModel");
		$this->load->library("pdfgenerator");

	}

	public function index()
	{

		// Check permissions for modulereg view page
		if(!$this->permission->has_permission("changestomoduleregistrationform_viewall")){
			echo "No permissions";
			return;
		}

		$student_id = $this->session->userdata('user_id');

		$changestomodreg = array();
		if ($this->permission->has_permission("view_all_changestomoduleregistration")) {
			// Get all changestomodreg form from db
			$changestomodreg = $this->ChangesToModuleRegistrationModel->GetAllWithDetails();
		}else{

			$status = array();

			// Get changestomodreg by status list
			$this->permission->has_permission("approve_pending_changestomodreg") ? array_push($status, 'pending') : null;
			$this->permission->has_permission("approve_sem_coor_approved_changestomodreg") ? array_push($status, 'semester_coordinator_recommended') : null;
			$this->permission->has_permission("approve_hod_approved_changestomodreg") ? array_push($status, 'hod_recommended') : null;
			$this->permission->has_permission("approve_fac_approved_changestomodreg") ? array_push($status, 'fac_rep_recommended') : null;
			$this->permission->has_permission("approve_chairman_approved_changestomodreg") ? array_push($status, 'chairman_forwarded_to_FAC') : null;
			$this->permission->has_permission("view_chairman_rejected_appeals") ? array_push($status, 'chairman_rejected') : null;

			if (count($status) > 0) {
				$changestomodreg = $this->ChangesToModuleRegistrationModel->GetAllByStatusList($status);
			}
		}

		// get my changes to module reg
		$my_changestomodreg = $this->ChangesToModuleRegistrationModel->GetAllWithDetails($student_id);

		// Define data array
		$data = array(
			"changestomodreg_list" => $changestomodreg,
			"my_changestomodreg" => $my_changestomodreg
		);

		// Load modulereg view
		$this->layout->view('manage_forms/changestomoduleregistration_form/changestomoduleregistration_form',$data);
	}

	function create()
	{

		$has_permision = $this->permission->has_permission("changestomoduleregistrationform_create");

		if(!$has_permision){
			echo "No permissions";
			return;
		}

		$student_id = $this->session->userdata('user_id');

		if ($_POST) {

			// set validation rules
			$this->form_validation->set_rules('module_action','Add or Drop', 'trim|required|max_length[45]');
			$this->form_validation->set_rules('course','Course', 'trim|required|max_length[45]');
			$this->form_validation->set_rules('reasonForChanges','Reason For Changes', 'trim|required|max_length[250]');
			$this->form_validation->set_rules('is_verified','Agreement Verification', 'trim|required');

			$valid = $this->form_validation->run();

			if ($valid) {

				$file_name = '';

				// check file is selected
				if (isset($_FILES['userfile']) && is_uploaded_file($_FILES['userfile']['tmp_name'])) {

					$file_name = uniqid() . ".pdf";

					$config = array(
						'upload_path' => "./uploads/",
						'allowed_types' => "pdf",
						'overwrite' => TRUE,
						'file_name' => $file_name
					);
					$this->load->library('upload', $config);
					if($this->upload->do_upload())
					{
						$data = array('upload_data' => $this->upload->data());
						//var_dump($data);
					}
				}

				// save data into changes to mod reg form table
				$form_data = array(
					'addOrDrop' => $_POST["module_action"], 
					'course' => $_POST["course"], 
					'reasonForChanges' => $_POST["reasonForChanges"], 
					'uomUser_id' => $student_id 
				);

				$new_changestomodreg_id = $this->ChangesToModuleRegistrationModel->Insert($form_data);

				/// set flash message
				$this->session->set_flashdata('success', "Changes to Module Registration Created Successfully! Changes to Module Registration ID: ". $new_changestomodreg_id);

 				/// redirect to all permission page
				redirect('changes_to_module_registration_form');
			}

		}

		// Get user details
		$student = $this->UomUserModel->GetByIdWithDetails($student_id);
		
		$data = array('student' => $student);

 		/// Load all mod. reg. page
		$this->layout->view("manage_forms/changestomoduleregistration_form/create_changestomoduleregistration", $data);
	}


	public function view()
	{

		// Get changestomodreg id from url
		$changestomodreg_id = $this->uri->segment(3);

		// get data from db
		$changestomodreg = $this->ChangesToModuleRegistrationModel->GetById($changestomodreg_id);
		$changestomodregapprovalallrecords = $this->ChangesToModuleRegistrationModel->GetByIdAllRecords($changestomodreg_id);

		// get student data from db
		$student = $this->UomUserModel->GetByIdWithDetails($changestomodreg->uomUser_id);

		// upcomming meetings
		$meetings = $this->MeetingModel->Upcoming_meetings();
		
		$meeting_dropdown = array();
		$meeting_dropdown[''] = "-- Select a Meeting --";
		foreach ($meetings as $key => $meeting) {
			$meeting_dropdown[$meeting->id] = $meeting->meetingCode . ' : ' . $meeting->name;
		}

		// get approval history
		$aproval_history = $this->ApprovalProcessModel->getApprovalStatusByField('changesToModuleRegistration_id', $changestomodreg_id);

		if($_POST){

			if (isset($_POST['reject'])) {
				// set validation rules
				$this->form_validation->set_rules('comment','Comments', 'trim|required|max_length[100]');
			}else{
				// set validation rules
				$this->form_validation->set_rules('comment','Comments', 'trim|max_length[100]');

				// if chairman approved, set meeting validation
				if ($_POST['status'] == 'chairman_forwarded_to_FAC') { 
					$this->form_validation->set_rules('meeting_id','Meeting', 'trim|required|max_length[100]');
				}
			}

			$valid = $this->form_validation->run();

			if($valid){

				$status = $_POST["status"];
				if (isset($_POST['reject'])) {
					$status = 'chairman_rejected';
				}

				// update data into changestomodreg form table
				$form_data = array(
					'status' => $status,
					'meeting_id' => $_POST["meeting_id"]
				);

				$updated_changestomodreg_id = $this->ChangesToModuleRegistrationModel->Update($changestomodreg_id,$form_data);

				// save data into approval process table
				if ($updated_changestomodreg_id) {
					$approval_data = array(
						'comment' => $_POST["comment"],
						'status' => $status,
						'uomUser_id' => $this->session->userdata('user_id'),
						'changesToModuleRegistration_id' => $changestomodreg_id
					);

					$new_approvalprocess_id = $this->ApprovalProcessModel->Insert($approval_data);

				}

				$message = "Changes to Module Registration Approved Successfully! Changes to Module Registration ID: ";
				if (isset($_POST['reject'])) {
					$message = "Changes to Module Registration Rejected Successfully! Changes to Module Registration ID: ";
				}

				/// set flash message
				$this->session->set_flashdata('success', $message. $changestomodreg_id);

 				/// redirect to all changestomodreg form page
				redirect('changes_to_module_registration_form');

			}

		}

		$data = array(
			'changestomodreg' => $changestomodreg,
			'changestomodregapprovalallrecords' => $changestomodregapprovalallrecords,
			'student' => $student,
			'meeting_dropdown' => $meeting_dropdown,
			'aproval_history' => $aproval_history
		);

		$this->layout->view("manage_forms/changestomoduleregistration_form/view_changestomoduleregistration", $data);


	}

	public function myview()
	{

		// Get changestomodreg id from url
		$changestomodreg_id = $this->uri->segment(3);

		// get data from db
		$changestomodreg = $this->ChangesToModuleRegistrationModel->GetById($changestomodreg_id);
		$changestomodregapprovalallrecords = $this->ChangesToModuleRegistrationModel->GetByIdAllRecords($changestomodreg_id);


		// get student data from db
		$student = $this->UomUserModel->GetByIdWithDetails($changestomodreg->uomUser_id);

		// get approval history
		$aproval_history = $this->ApprovalProcessModel->getApprovalStatusByField('changesToModuleRegistration_id', $changestomodreg_id);

		$data = array(
			'changestomodreg' => $changestomodreg,
			'student' => $student,
			'changestomodregapprovalallrecords' => $changestomodregapprovalallrecords,
			'aproval_history' => $aproval_history
		);

		$this->layout->view("manage_forms/changestomoduleregistration_form/my_view_changestomoduleregistration", $data);
	}

	function delete()
	{

		$has_permision = $this->permission->has_permission("changestomoduleregistrationform_delete");
		if(!$has_permision){
			echo "No permissions";
			return;
		}

		// Get id from url
		$changestomodreg_id = $this->uri->segment(3);

		if($changestomodreg_id){
			$isDeleted = $this->ChangesToModuleRegistrationModel->Delete($changestomodreg_id);
			if($isDeleted){

				/// set flash data
				$this->session->set_flashdata('success', 'Changes to Module Registration Deleted successfully!');

				redirect("changes_to_module_registration_form");
			}
		}

	}

	public function changestomodregreport()
	{

		// Get changestomodreg id from url
		$changestomodreg_id = $this->uri->segment(3);

		// get data from db
		$changestomodreg = $this->ChangesToModuleRegistrationModel->GetById($changestomodreg_id);
		$changestomodregapprovalallrecords = $this->ChangesToModuleRegistrationModel->GetByIdAllRecords($changestomodreg_id);


		// get student data from db
		$student = $this->UomUserModel->GetByIdWithDetails($changestomodreg->uomUser_id);

		// get approval history
		$aproval_history = $this->ApprovalProcessModel->getApprovalStatusByField('changesToModuleRegistration_id', $changestomodreg_id);

		$data = array(
			'changestomodreg' => $changestomodreg,
			'student' => $student,
			'changestomodregapprovalallrecords' => $changestomodregapprovalallrecords,
			'aproval_history' => $aproval_history
		);

		/// Load changestomodreg view
		$html = $this->layout->report_view("analysis_and_reporting/changestomodreg_list", $data, true);

		$this->pdfgenerator->Generate($html);
	}

}

?>