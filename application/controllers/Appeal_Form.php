<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appeal_Form extends CI_Controller {

	private $allowed_permissions;

	function __construct()
	{
		parent::__construct();

		//Check is loggied in to system
		if ($this->session->is_loggedin == false) {
			redirect('login');
		}

		$this->load->model("AppealFormModel");
		$this->load->model("UomUserModel");
		$this->load->model("ApprovalProcessModel");
		$this->load->model("MeetingModel");
		$this->load->library("pdfgenerator");

	}

	public function index()
	{

		// Check permissions for appeal form view page
		if(!$this->permission->has_permission("appealform_viewall")){
			echo "No permissions";
			return;
		}

		$student_id = $this->session->userdata('user_id');

		$appeal = array();
		if ($this->permission->has_permission("view_all_appeals")) {
			// Get all appeal form from db
			$appeal = $this->AppealFormModel->GetAllWithDetails();
		}else{

			$status = array();

			// Get appeal by status list
			$this->permission->has_permission("approve_pending_appeals") ? array_push($status, 'pending') : null;
			$this->permission->has_permission("approve_semester_coordinator_approved_appeals") ? array_push($status, 'semester_coordinator_recommended') : null;
			$this->permission->has_permission("approve_hod_approved_appeals") ? array_push($status, 'hod_recommended') : null;
			$this->permission->has_permission("approve_fac_approved_appeals") ? array_push($status, 'fac_rep_recommended') : null;
			$this->permission->has_permission("view_chairman_rejected_appeals") ? array_push($status, 'chairman_rejected') : null;

			if (count($status) > 0) {
				$appeal = $this->AppealFormModel->GetAllByStatusList($status);
			}
		}


		// get my appealse
		$my_appeal = $this->AppealFormModel->GetAllWithDetails($student_id);

		// Define data array
		$data = array(
			"appeal_list" => $appeal,
			"my_appeal" => $my_appeal
		);

		// Load appeal form view
		$this->layout->view('manage_forms/appeal_form/appeal_form',$data);
	}

	function create()
	{

		$has_permision = $this->permission->has_permission("appealform_create");

		if(!$has_permision){
			echo "No permissions";
			return;
		}

		$student_id = $this->session->userdata('user_id');

		if ($_POST) {

			// set validation rules
			$this->form_validation->set_rules('appealbrief','Appeal in Brief', 'trim|required|max_length[100]');
			$this->form_validation->set_rules('appealsummary','Summary of the appeal', 'trim|required|max_length[800]');
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

				// save data into appeal form table
				$form_data = array(
					'appealInBrief' => $_POST["appealbrief"], 
					'summary' => $_POST["appealsummary"], 
					'uomUser_id' => $student_id ,
					'supportingDocuments' => $file_name
				);

				$new_appeal_id = $this->AppealFormModel->Insert($form_data);

				/// set flash message
				$this->session->set_flashdata('success', "Appeal Created Successfully! Appeal ID: ". $new_appeal_id);

 				/// redirect to all permission page
				redirect('appeal_form');
			}

		}

		// Get user details
		$student = $this->UomUserModel->GetByIdWithDetails($student_id);
		
		$data = array('student' => $student);

 		/// Load all appeal form page
		$this->layout->view("manage_forms/appeal_form/create_appeal", $data);
	}

	public function view()
	{

		// Get appeal id from url
		$appeal_id = $this->uri->segment(3);

		// get data from db
		$appeal = $this->AppealFormModel->GetById($appeal_id);
		$appealapprovalallrecords = $this->AppealFormModel->GetByIdAllRecords($appeal_id);

		// get student data from db
		$student = $this->UomUserModel->GetByIdWithDetails($appeal->uomUser_id);

		// upcomming meetings
		$meetings = $this->MeetingModel->Upcoming_meetings();

		$meeting_dropdown = array();
		$meeting_dropdown[''] = "-- Select a Meeting --";
		foreach ($meetings as $key => $meeting) {
			$meeting_dropdown[$meeting->id] = $meeting->meetingCode . ' : ' . $meeting->name;
		}

		// get approval history
		$aproval_history = $this->ApprovalProcessModel->getApprovalStatusByField('appealForm_id', $appeal_id);

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

				// update data into appeal form table
				$form_data = array(
					'status' => $status,
					'meeting_id' => $_POST["meeting_id"]
				);

				$updated_appeal_id = $this->AppealFormModel->Update($appeal_id,$form_data);

				// save data into approval process table
				if ($updated_appeal_id) {
					$approval_data = array(
						'comment' => $_POST["comment"],
						'status' => $status,
						'uomUser_id' => $this->session->userdata('user_id'),
						'appealForm_id' => $appeal_id
					);

					$new_approvalprocess_id = $this->ApprovalProcessModel->Insert($approval_data);

				}

				$message = "Appeal Approved Successfully! Appeal ID: ";
				if (isset($_POST['reject'])) {
					$message = "Appeal Rejected Successfully! Appeal ID: ";
				}

				/// set flash message
				$this->session->set_flashdata('success', $message. $appeal_id);

 				/// redirect to all appeal form page
				redirect('appeal_form');

			}

		}

		$data = array(
			'appeal' => $appeal,
			'appealapprovalallrecords' => $appealapprovalallrecords,
			'student' => $student,
			'meeting_dropdown' => $meeting_dropdown,
			'aproval_history' => $aproval_history
		);

		$this->layout->view("manage_forms/appeal_form/view_appeal", $data);
	}

	public function myview()
	{

		// Get appeal id from url
		$appeal_id = $this->uri->segment(3);

		// get data from db
		$appeal = $this->AppealFormModel->GetById($appeal_id);
		$appealapprovalallrecords = $this->AppealFormModel->GetByIdAllRecords($appeal_id);

		// get student data from db
		$student = $this->UomUserModel->GetByIdWithDetails($appeal->uomUser_id);

		// get approval history
		$aproval_history = $this->ApprovalProcessModel->getApprovalStatusByField('appealForm_id', $appeal_id);

		$data = array(
			'appeal' => $appeal,
			'student' => $student,
			'appealapprovalallrecords' => $appealapprovalallrecords,
			'aproval_history' => $aproval_history
		);

		$this->layout->view("manage_forms/appeal_form/my_view_appeal", $data);
	}

	function delete()
	{

		$has_permision = $this->permission->has_permission("appealform_delete");
		if(!$has_permision){
			echo "No permissions";
			return;
		}

		// Get id from url
		$appeal_id = $this->uri->segment(3);

		if($appeal_id){
			$isDeleted = $this->AppealFormModel->Delete($appeal_id);
			if($isDeleted){

				/// set flash data
				$this->session->set_flashdata('success', 'Appeal Deleted successfully!');

				redirect("appeal_form");
			}
		}

	}

	public function appealreport()
	{

		// Get appeal id from url
		$appeal_id = $this->uri->segment(3);

		// get data from db
		$appeal = $this->AppealFormModel->GetById($appeal_id);
		$appealapprovalallrecords = $this->AppealFormModel->GetByIdAllRecords($appeal_id);

		// get student data from db
		$student = $this->UomUserModel->GetByIdWithDetails($appeal->uomUser_id);

		// get approval history
		$aproval_history = $this->ApprovalProcessModel->getApprovalStatusByField('appealForm_id', $appeal_id);

		$data = array(
			'appeal' => $appeal,
			'appealapprovalallrecords' => $appealapprovalallrecords,
			'student' => $student,
			'aproval_history' => $aproval_history
		);

		/// Load appeal view
		$html = $this->layout->report_view("analysis_and_reporting/appeal_list", $data, true);

		$this->pdfgenerator->Generate($html);
	}
}

?>