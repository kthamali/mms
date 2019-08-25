<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_For_Alternative_Modules_Form extends CI_Controller {
 
	private $allowed_permissions;

	function __construct()
	{
		parent::__construct();

		//Check is loggied in to system
		if ($this->session->is_loggedin == false) {
			redirect('login');
		}

		$this->load->model("RequestForAlternativeModuleModel");
		$this->load->model("UomUserModel");
		$this->load->model("ApprovalProcessModel");
		$this->load->model("MeetingModel");
		$this->load->model("EnrolmentModel");
		$this->load->library("pdfgenerator");

	}

	public function index()
	{

		// Check permissions for altmodules view page
		if(!$this->permission->has_permission("requestforalternativemodulesform_viewall")){
			echo "No permissions";
			return;
		}

		$student_id = $this->session->userdata('user_id');

		$requestforaltmod = array();
		if ($this->permission->has_permission("view_all_requestforalternativemodules")) {
			// Get all requestforaltmod form from db
			$requestforaltmod = $this->RequestForAlternativeModuleModel->GetAllWithDetails();
		}else{

			$status = array();

			// Get requestforaltmod by status list
			$this->permission->has_permission("approve_pending_requestforaltmod") ? array_push($status, 'pending') : null;
			$this->permission->has_permission("approve_sem_coor_approved_requestforaltmod") ? array_push($status, 'semester_coordinator_recommended') : null;
			$this->permission->has_permission("approve_hod_approved_requestforaltmod") ? array_push($status, 'hod_recommended') : null;
			$this->permission->has_permission("approve_fac_approved_requestforaltmod") ? array_push($status, 'fac_rep_recommended') : null;
			$this->permission->has_permission("approve_chairman_approved_requestforaltmod") ? array_push($status, 'chairman_forwarded_to_FAC') : null;
			$this->permission->has_permission("view_chairman_rejected_appeals") ? array_push($status, 'chairman_rejected') : null;

			if (count($status) > 0) {
				$requestforaltmod = $this->RequestForAlternativeModuleModel->GetAllByStatusList($status);
			}
		}

		// get my requestforaltmod
		$my_requestforaltmod = $this->RequestForAlternativeModuleModel->GetAllWithDetails($student_id);

		// Define data array
		$data = array(
			"requestforaltmod_list" => $requestforaltmod,
			"my_requestforaltmod" => $my_requestforaltmod
		);

		// Load modulereg view
		$this->layout->view('manage_forms/requestforalternativemodules_form/requestforalternativemodules_form',$data);
	}

	function create()
	{

		$has_permision = $this->permission->has_permission("requestforalternativemodulesform_create");

		if(!$has_permision){
			echo "No permissions";
			return;
		}

		$student_id = $this->session->userdata('user_id');

		if ($_POST) {

			// set validation rules
			$this->form_validation->set_rules('discourses','Discontinued Course', 'trim|required|max_length[45]');
			$this->form_validation->set_rules('equcourses','Equivalent Course', 'trim|required|max_length[45]');
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

				// save data into request for alt mod form table
				$form_data = array(
					'discontinueCourse' => $_POST["discourses"], 
					'equivalentCourse' => $_POST["equcourses"], 
					'uomUser_id' => $student_id 
				);

				$new_requestforaltmod_id = $this->RequestForAlternativeModuleModel->Insert($form_data);

				/// set flash message
				$this->session->set_flashdata('success', "Request For Alternative Modules Created Successfully! Request For Alternative Modules Registration ID: ". $new_requestforaltmod_id);

 				/// redirect to all permission page
				redirect('request_for_alternative_modules_form');
			}

		}

			// get enrolled courses
		$allEnrolledcourses = $this->EnrolmentModel->Enrolments($student_id);
		$enrolledcourses_dropdown = array();
		$enrolledcourses_dropdown[''] = '-- Select Course --';
		foreach ($allEnrolledcourses as $key => $Enrolledcourses) {
			$enrolledcourses_dropdown[$Enrolledcourses->course_id] = $Enrolledcourses->courseCode . " - " . $Enrolledcourses->courseName;
		}

		// Get user details
		$student = $this->UomUserModel->GetByIdWithDetails($student_id);
		
		$data = array(
			'student' => $student,
			'allEnrolledcourses' => $allEnrolledcourses,
			'enrolledcourses_dropdown' => $enrolledcourses_dropdown
		);

  		/// Load all alternative modules page
		$this->layout->view("manage_forms/requestforalternativemodules_form/create_requestforalternativemodules", $data);
	}

	public function view()
	{

		// Get requestforaltmod id from url
		$requestforaltmod_id = $this->uri->segment(3);

		// get data from db
		$requestforaltmod = $this->RequestForAlternativeModuleModel->GetById($requestforaltmod_id);
		$requestforaltmodapprovalallrecords = $this->RequestForAlternativeModuleModel->GetByIdAllRecords($requestforaltmod_id);

		// get student data from db
		$student = $this->UomUserModel->GetByIdWithDetails($requestforaltmod->uomUser_id);

		// upcomming meetings
		$meetings = $this->MeetingModel->Upcoming_meetings();
		
		$meeting_dropdown = array();
		$meeting_dropdown[''] = "-- Select a Meeting --";
		foreach ($meetings as $key => $meeting) {
			$meeting_dropdown[$meeting->id] = $meeting->meetingCode . ' : ' . $meeting->name;
		}

		// get approval history
		$aproval_history = $this->ApprovalProcessModel->getApprovalStatusByField('requestForAlternativeModule_id', $requestforaltmod_id);

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

				// update data into requestforaltmod form table
				$form_data = array(
					'status' => $status,
					'meeting_id' => $_POST["meeting_id"]
				);

				$updated_requestforaltmod_id = $this->RequestForAlternativeModuleModel->Update($requestforaltmod_id,$form_data);

				// save data into approval process table
				if ($updated_requestforaltmod_id) {
					$approval_data = array(
						'comment' => $_POST["comment"],
						'status' => $status,
						'uomUser_id' => $this->session->userdata('user_id'),
						'requestForAlternativeModule_id' => $requestforaltmod_id
					);

					$new_approvalprocess_id = $this->ApprovalProcessModel->Insert($approval_data);

				}

				$message = "Request For Alternative Modules Approved Successfully! Request For Alternative Modules ID: ";
				if (isset($_POST['reject'])) {
					$message = "Request For Alternative Modules Rejected Successfully! Request For Alternative Modules ID: ";
				}

				/// set flash message
				$this->session->set_flashdata('success', $message. $requestforaltmod_id);

 				/// redirect to all requestforaltmod form page
				redirect('request_for_alternative_modules_form');

			}

		}

		$data = array(
			'requestforaltmod' => $requestforaltmod,
			'requestforaltmodapprovalallrecords' => $requestforaltmodapprovalallrecords,
			'student' => $student,
			'meeting_dropdown' => $meeting_dropdown,
			'aproval_history' => $aproval_history
		);

		$this->layout->view("manage_forms/requestforalternativemodules_form/view_requestforalternativemodules", $data);
	}

	public function myview()
	{

		// Get requestforaltmod id from url
		$requestforaltmod_id = $this->uri->segment(3);

		// get data from db
		$requestforaltmod = $this->RequestForAlternativeModuleModel->GetById($requestforaltmod_id);
		$requestforaltmodapprovalallrecords = $this->RequestForAlternativeModuleModel->GetByIdAllRecords($requestforaltmod_id);

		// get student data from db
		$student = $this->UomUserModel->GetByIdWithDetails($requestforaltmod->uomUser_id);

		// get approval history
		$aproval_history = $this->ApprovalProcessModel->getApprovalStatusByField('requestForAlternativeModule_id', $requestforaltmod_id);

		$data = array(
			'requestforaltmod' => $requestforaltmod,
			'student' => $student,
			'requestforaltmodapprovalallrecords' => $requestforaltmodapprovalallrecords,
			'aproval_history' => $aproval_history
		);

		$this->layout->view("manage_forms/requestforalternativemodules_form/my_view_requestforalternativemodules", $data);
	}

	function delete()
	{

		$has_permision = $this->permission->has_permission("requestforalternativemodulesform_delete");
		if(!$has_permision){
			echo "No permissions";
			return;
		}

		// Get id from url
		$requestforaltmod_id = $this->uri->segment(3);

		if($requestforaltmod_id){
			$isDeleted = $this->RequestForAlternativeModuleModel->Delete($requestforaltmod_id);
			if($isDeleted){

				/// set flash data
				$this->session->set_flashdata('success', 'Request For Alternative Modules Deleted successfully!');

				redirect("request_for_alternative_modules_form");
			}
		}

	}

	public function requestforaltmodreport()
	{

		// Get requestforaltmod id from url
		$requestforaltmod_id = $this->uri->segment(3);

		// get data from db
		$requestforaltmod = $this->RequestForAlternativeModuleModel->GetById($requestforaltmod_id);
		$requestforaltmodapprovalallrecords = $this->RequestForAlternativeModuleModel->GetByIdAllRecords($requestforaltmod_id);

		// get student data from db
		$student = $this->UomUserModel->GetByIdWithDetails($requestforaltmod->uomUser_id);

		// get approval history
		$aproval_history = $this->ApprovalProcessModel->getApprovalStatusByField('requestForAlternativeModule_id', $requestforaltmod_id);

		$data = array(
			'requestforaltmod' => $requestforaltmod,
			'student' => $student,
			'requestforaltmodapprovalallrecords' => $requestforaltmodapprovalallrecords,
			'aproval_history' => $aproval_history
		);

		/// Load requestforaltmod view
		$html = $this->layout->report_view("analysis_and_reporting/requestforaltmod_list", $data, true);

		$this->pdfgenerator->Generate($html);
	}

}

?>