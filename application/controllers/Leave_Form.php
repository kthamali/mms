<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave_Form extends CI_Controller {

	private $allowed_permissions;

	function __construct()
	{
		parent::__construct();

		//Check is loggied in to system
		if ($this->session->is_loggedin == false) {
			redirect('login');
		}

		$this->load->model("LeaveFormModel");
		$this->load->model("UomUserModel");
		$this->load->model("ApprovalProcessModel");
		$this->load->model("MeetingModel");
		$this->load->model("LeaveTypeModel");
		$this->load->library("pdfgenerator");

	}

	public function index()
	{
		// Check permissions for leave form view page
		if(!$this->permission->has_permission("leaveform_viewall")){
			echo "No permissions";
			return;
		}

		$student_id = $this->session->userdata('user_id');

		$leave = array();
		if ($this->permission->has_permission("view_all_leaves")) {
			// Get all leave form from db
			$leave = $this->LeaveFormModel->GetAllWithDetails();
		}else{

			$status = array();

			// Get leave by status list
			$this->permission->has_permission("approve_pending_leaves") ? array_push($status, 'pending') : null;
			$this->permission->has_permission("approve_semester_coordinator_approved_leaves") ? array_push($status, 'semester_coordinator_recommended') : null;
			$this->permission->has_permission("approve_hod_approved_leaves") ? array_push($status, 'hod_recommended') : null;
			$this->permission->has_permission("approve_fac_approved_leaves") ? array_push($status, 'fac_rep_recommended') : null;
			$this->permission->has_permission("approve_chairman_approved_leaves") ? array_push($status, 'chairman_forwarded_to_FAC') : null;
			$this->permission->has_permission("view_chairman_rejected_appeals") ? array_push($status, 'chairman_rejected') : null;

			if (count($status) > 0) {
				$leave = $this->LeaveFormModel->GetAllByStatusList($status);
			}
		}


		// get my leave
		$my_leave = $this->LeaveFormModel->GetAllWithDetails($student_id);

		// Define data array
		$data = array(
			"leave_list" => $leave,
			"my_leave" => $my_leave
		);

		// Load leave form view
		$this->layout->view('manage_forms/leave_form/leave_form',$data);
	}

	function create()
	{

		$has_permision = $this->permission->has_permission("leaveform_create");

		if(!$has_permision){
			echo "No permissions";
			return;
		}

		$student_id = $this->session->userdata('user_id');

		if ($_POST) {

			// set validation rules
			$this->form_validation->set_rules('leavetype','Leave Type', 'trim|required');
			$this->form_validation->set_rules('leavesummary','Summary of the leave', 'trim|required|max_length[250]');
			$this->form_validation->set_rules('startdate','Start Date', 'trim|required');
			$this->form_validation->set_rules('enddate','End Date', 'trim|required|callback_compareDate');
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

				// save data into leave form table
				$form_data = array(
					'leaveType_id' => $_POST["leavetype"], 
					'summary' => $_POST["leavesummary"], 
					'startDate' => $_POST["startdate"], 
					'endDate' => $_POST["enddate"], 
					'uomUser_id' => $student_id 
				);

				$new_leave_id = $this->LeaveFormModel->Insert($form_data);

				/// set flash message
				$this->session->set_flashdata('success', "Leave Created Successfully! Leave ID: ". $new_leave_id);

 				/// redirect to all permission page
				redirect('leave_form');
			}
		}

		// Get all leave types
		$allleavetypes = $this->LeaveTypeModel->GetAll();
		$leavetype_dropdown = array();
		$leavetype_dropdown[''] = '-- Select Leave Type --';
		foreach ($allleavetypes as $key => $leavetypes) {
			$leavetype_dropdown[$leavetypes->id] = $leavetypes->leaveTypeName;
		}

		// Get user details
		$student = $this->UomUserModel->GetByIdWithDetails($student_id);
		
		$data = array(
			'student' => $student,
			'leavetype_dropdown' => $leavetype_dropdown
		);

 		/// Load all leave form page
		$this->layout->view("manage_forms/leave_form/create_leave", $data);
	}

	// compare date 
	function compareDate() {
		$startdate = strtotime($_POST['startdate']);
		$enddate = strtotime($_POST['enddate']);

		if ($enddate >= $startdate)
			return True;
		else {
			$this->form_validation->set_message('compareDate', '%s should be greater than Leave Start Date.');
			return False;
		}
	}

	public function view()
	{

		// Get leave id from url
		$leave_id = $this->uri->segment(3);

		// get data from db
		$leave = $this->LeaveFormModel->GetById($leave_id);
		$leaveapprovalallrecords = $this->LeaveFormModel->GetByIdAllRecords($leave_id);

		// get student data from db
		$student = $this->UomUserModel->GetByIdWithDetails($leave->uomUser_id);

		// upcomming meetings
		$meetings = $this->MeetingModel->Upcoming_meetings();
		
		$meeting_dropdown = array();
		$meeting_dropdown[''] = "-- Select a Meeting --";
		foreach ($meetings as $key => $meeting) {
			$meeting_dropdown[$meeting->id] = $meeting->meetingCode . ' : ' . $meeting->name;
		}

		// get approval history
		$aproval_history = $this->ApprovalProcessModel->getApprovalStatusByField('leaveForm_id', $leave_id);

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

				// update data into leave form table
				$form_data = array(
					'status' => $status,
					'meeting_id' => $_POST["meeting_id"]
				);

				$updated_leave_id = $this->LeaveFormModel->Update($leave_id,$form_data);

				// save data into approval process table
				if ($updated_leave_id) {
					$approval_data = array(
						'comment' => $_POST["comment"],
						'status' => $status,
						'uomUser_id' => $this->session->userdata('user_id'),
						'leaveForm_id' => $leave_id
					);

					$new_approvalprocess_id = $this->ApprovalProcessModel->Insert($approval_data);

				}

				$message = "Leave Approved Successfully! Leave ID: ";
				if (isset($_POST['reject'])) {
					$message = "Leave Rejected Successfully! Leave ID: ";
				}

				/// set flash message
				$this->session->set_flashdata('success', $message. $leave_id);

 				/// redirect to all leave form page
				redirect('leave_form');

			}

		}

		$data = array(
			'leave' => $leave,
			'leaveapprovalallrecords' => $leaveapprovalallrecords,
			'student' => $student,
			'meeting_dropdown' => $meeting_dropdown,
			'aproval_history' => $aproval_history
		);

		$this->layout->view("manage_forms/leave_form/view_leave", $data);
	}

	public function myview()
	{

		// Get leave id from url
		$leave_id = $this->uri->segment(3);

		// get data from db
		$leave = $this->LeaveFormModel->GetById($leave_id);
		$leaveapprovalallrecords = $this->LeaveFormModel->GetByIdAllRecords($leave_id);

		// get student data from db
		$student = $this->UomUserModel->GetByIdWithDetails($leave->uomUser_id);

		// get approval history
		$aproval_history = $this->ApprovalProcessModel->getApprovalStatusByField('leaveForm_id', $leave_id);

		$data = array(
			'leave' => $leave,
			'student' => $student,
			'leaveapprovalallrecords' => $leaveapprovalallrecords,
			'aproval_history' => $aproval_history
		);

		$this->layout->view("manage_forms/leave_form/my_view_leave", $data);
	}

	function delete()
	{

		$has_permision = $this->permission->has_permission("leaveform_delete");
		if(!$has_permision){
			echo "No permissions";
			return;
		}

		// Get id from url
		$leave_id = $this->uri->segment(3);

		if($leave_id){
			$isDeleted = $this->LeaveFormModel->Delete($leave_id);
			if($isDeleted){

				/// set flash data
				$this->session->set_flashdata('success', 'Leave Deleted successfully!');

				redirect("leave_form");
			}
		}

	}

	public function leavereport()
	{

		// Get leave id from url
		$leave_id = $this->uri->segment(3);

		// get data from db
		$leave = $this->LeaveFormModel->GetById($leave_id);
		$leaveapprovalallrecords = $this->LeaveFormModel->GetByIdAllRecords($leave_id);

		// get student data from db
		$student = $this->UomUserModel->GetByIdWithDetails($leave->uomUser_id);

		// get approval history
		$aproval_history = $this->ApprovalProcessModel->getApprovalStatusByField('leaveForm_id', $leave_id);

		$data = array(
			'leave' => $leave,
			'student' => $student,
			'leaveapprovalallrecords' => $leaveapprovalallrecords,
			'aproval_history' => $aproval_history
		);

		/// Load leave view
		$html = $this->layout->report_view("analysis_and_reporting/leave_list", $data, true);

		$this->pdfgenerator->Generate($html);
	}

}

?>