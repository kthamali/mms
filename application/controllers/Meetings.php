<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meetings extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		//Check is loggied in to system
		if ($this->session->is_loggedin == false) {
			redirect('login');
		}

		$this->load->model('MeetingModel');
		$this->load->model('RequestForAlternativeModuleModel');
		$this->load->model('ChangesToModuleRegistrationModel');
		$this->load->model('LeaveFormModel');
		$this->load->model('AppealFormModel');
		$this->load->model('CurriculamModel');
		$this->load->model('UomUserModel');
		$this->load->model('ApprovalProcessModel');
		$this->load->library("pdfgenerator");
	}

	public function index()
	{
		// load all meetings
		$meetings = $this->MeetingModel->GetAll();

		$data = array(
			'meetings' => $meetings
		);

		$this->layout->view('meetings/index', $data);
	}

	public function create()
	{
		if($_POST) {

			// run validation
			$this->form_validation->set_rules("name", "Name", "trim|required|max_length[256]");
			$this->form_validation->set_rules("code", "Code", "trim|required|max_length[15]");
			$this->form_validation->set_rules("date", "Date", "trim|required");
			$this->form_validation->set_rules("venue", "Venue", "trim|required|max_length[128]");
			
			$valid = $this->form_validation->run();

			if ($valid) {

				// assign post data into array
				$data = array(
					'meetingCode' => $_POST['code'], 
					'name' => $_POST['name'], 
					'meetingDate' => $_POST['date'], 
					'venue' => $_POST['venue']
				);

				// save data in db
				$meeting_id = $this->MeetingModel->Insert($data);

				/// set flash message
				$this->session->set_flashdata('success', "Meeting Created Successfully! New Meeting ID: ". $meeting_id);

 				/// redirect to all permission page
				redirect('meetings');
			}
		}

		$this->layout->view('meetings/create');
	}


	// Update
	function update()
	{
		if(!$this->permission->has_permission("meeting_update")){
			echo "No permissions";
			return;
		}

		// Get id from url
		$meeting_id = $this->uri->segment(3);

		/// get data from db
		$selected_meeting = $this->MeetingModel->GetById($meeting_id);

		if($_POST){

			$this->form_validation->set_rules("name", "Name", "trim|required|max_length[256]");
			$this->form_validation->set_rules("code", "Code", "trim|required|max_length[15]");
			$this->form_validation->set_rules("date", "Date", "trim|required");
			$this->form_validation->set_rules("venue", "Venue", "trim|required|max_length[128]");
			$this->form_validation->set_rules("status", "Status", "trim|max_length[45]");

			$isValid = $this->form_validation->run();

			if($isValid){ /// form valid
				$post_data = array(
					'meetingCode' => $_POST['code'], 
					'name' => $_POST['name'], 
					'meetingDate' => $_POST['date'], 
					'venue' => $_POST['venue'],
					'status' => $_POST['status']
				);

			// update record
				$isUpdated = $this->MeetingModel->Update($meeting_id, $post_data);

				if($isUpdated){
					$this->session->set_flashdata('success', 'Meeting Updated successfully!');

					redirect("meetings");
				}
		}else{ /// form invalid
			$this->session->set_flashdata('unsuccess', "Form Invalid");
			$this->form_validation->set_error_delimiters("<span class='alert alert-danger'>", "</span>");
		}
	}

	$data = array(
		'meeting_id' =>  $meeting_id,
		'meeting_details' => $selected_meeting
	);

	$this->layout->view("meetings/update", $data);
}

function viewagenda()
{

	// Get meeting id from url
	$meeting_id = $this->uri->segment(3);

	$meetings = $this->MeetingModel->GetById($meeting_id);
	$appealinmeeting = $this->MeetingModel->AppealGetByMeetingId($meeting_id);
	$changestomodreginmeeting = $this->MeetingModel->ChangesToModRegGetByMeetingId($meeting_id);
	$leaveinmeeting = $this->MeetingModel->LeaveGetByMeetingId($meeting_id);
	$requesttoaltmodinmeeting = $this->MeetingModel->RequestForAltModGetByMeetingId($meeting_id);
	$curriculuminmeeting = $this->MeetingModel->CurriculamGetByMeetingId($meeting_id);

	$data = array(
		"meetingsData" => $meetings,
		"appealinmeetingData" => $appealinmeeting,
		"changestomodreginmeetingData" => $changestomodreginmeeting,
		"leaveinmeetingData" => $leaveinmeeting,
		"requesttoaltmodinmeetingData" => $requesttoaltmodinmeeting,
		"curriculuminmeetingData" => $curriculuminmeeting
	);

		/// Load view
	$this->layout->view("meetings/view_agenda", $data);
}

function viewrequesttoaltmoddetails()
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

	if ($_POST) {

			// set validation rules
		$this->form_validation->set_rules('facdecision','FAC Decision', 'trim|required|max_length[250]');

		$valid = $this->form_validation->run();

		if ($valid) {

				// save data into request for alt mod form table
			$form_data = array(
				'facDecision' => $_POST["facdecision"],
				'status' => $_POST["status"]
			);

			$updated_requestforaltmod_id = $this->RequestForAlternativeModuleModel->Update($requestforaltmod_id,$form_data);

				//save data into approval process table
			if ($updated_requestforaltmod_id) {
				$approval_data = array(
					'comment' => $_POST["facdecision"],
					'status' => $_POST["status"],
					'uomUser_id' => $this->session->userdata('user_id'),
					'requestForAlternativeModule_id' => $requestforaltmod_id
				);
				var_dump($updated_requestforaltmod_id);

				$new_approvalprocess_id = $this->ApprovalProcessModel->Insert($approval_data);
			}

				/// set flash message
			$this->session->set_flashdata('success', "Request For Alternative Modules FAC Decision saved Successfully! Request For Alternative Modules Registration ID: ". $requestforaltmod_id);

 				/// redirect to all permission page
			redirect('meetings/viewagenda/'.$requestforaltmod->meeting_id);
		}

	}

	$data = array(
		'requestforaltmod' => $requestforaltmod,
		'student' => $student,
		'requestforaltmodapprovalallrecords' => $requestforaltmodapprovalallrecords,
		'aproval_history' => $aproval_history
	);

	$this->layout->view("meetings/view_requesttoaltmod", $data);
}

function viewchangestomodregdetails()
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

	if ($_POST) {

			// set validation rules
		$this->form_validation->set_rules('facdecision','FAC Decision', 'trim|required|max_length[250]');

		$valid = $this->form_validation->run();

		if ($valid) {

				// save data into request for alt mod form table
			$form_data = array(
				'facDecision' => $_POST["facdecision"],
				'status' => $_POST["status"]
			);

			$updated_changestomodreg_id = $this->ChangesToModuleRegistrationModel->Update($changestomodreg_id,$form_data);

				//save data into approval process table
			if ($updated_changestomodreg_id) {
				$approval_data = array(
					'comment' => $_POST["facdecision"],
					'status' => $_POST["status"],
					'uomUser_id' => $this->session->userdata('user_id'),
					'changesToModuleRegistration_id' => $changestomodreg_id
				);

				$new_approvalprocess_id = $this->ApprovalProcessModel->Insert($approval_data);
			}

				/// set flash message
			$this->session->set_flashdata('success', "Changes to Module Registration FAC Decision saved Successfully! Changes to Module Registration Registration ID: ". $changestomodreg_id);

 				/// redirect to all permission page
			redirect('meetings/viewagenda/'.$changestomodreg->meeting_id);
		}

	}

	$data = array(
		'changestomodreg' => $changestomodreg,
		'student' => $student,
		'changestomodregapprovalallrecords' => $changestomodregapprovalallrecords,
		'aproval_history' => $aproval_history
	);

	$this->layout->view("meetings/view_changestomodreg", $data);
}

function viewleavedetails()
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

	if ($_POST) {

			// set validation rules
		$this->form_validation->set_rules('facdecision','FAC Decision', 'trim|required|max_length[250]');

		$valid = $this->form_validation->run();

		if ($valid) {

				// save data into request for alt mod form table
			$form_data = array(
				'facDecision' => $_POST["facdecision"],
				'status' => $_POST["status"]
			);

			$updated_leave_id = $this->LeaveFormModel->Update($leave_id,$form_data);

				//save data into approval process table
			if ($updated_leave_id) {
				$approval_data = array(
					'comment' => $_POST["facdecision"],
					'status' => $_POST["status"],
					'uomUser_id' => $this->session->userdata('user_id'),
					'leaveForm_id' => $leave_id
				);

				$new_approvalprocess_id = $this->ApprovalProcessModel->Insert($approval_data);
			}

				/// set flash message
			$this->session->set_flashdata('success', "Leave FAC Decision saved Successfully! Leave Registration ID: ". $leave_id);

 				/// redirect to all permission page
			redirect('meetings/viewagenda/'.$leave->meeting_id);
		}

	}

	$data = array(
		'leave' => $leave,
		'student' => $student,
		'leaveapprovalallrecords' => $leaveapprovalallrecords,
		'aproval_history' => $aproval_history
	);

	$this->layout->view("meetings/view_leave", $data);
}

function viewappealdetails()
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

	if ($_POST) {

			// set validation rules
		$this->form_validation->set_rules('facdecision','FAC Decision', 'trim|required|max_length[250]');

		$valid = $this->form_validation->run();

		if ($valid) {

				// save data into request for alt mod form table
			$form_data = array(
				'facDecision' => $_POST["facdecision"],
				'status' => $_POST["status"]
			);

			$updated_appeal_id = $this->AppealFormModel->Update($appeal_id,$form_data);

				//save data into approval process table
			if ($updated_appeal_id) {
				$approval_data = array(
					'comment' => $_POST["facdecision"],
					'status' => $_POST["status"],
					'uomUser_id' => $this->session->userdata('user_id'),
					'appealForm_id' => $appeal_id
				);

				$new_approvalprocess_id = $this->ApprovalProcessModel->Insert($approval_data);
			}

				/// set flash message
			$this->session->set_flashdata('success', "Appeal FAC Decision saved Successfully! Appeal Registration ID: ". $appeal_id);

 				/// redirect to all permission page
			redirect('meetings/viewagenda/'.$appeal->meeting_id);
		}

	}

	$data = array(
		'appeal' => $appeal,
		'student' => $student,
		'appealapprovalallrecords' => $appealapprovalallrecords,
		'aproval_history' => $aproval_history
	);

	$this->layout->view("meetings/view_appeal", $data);
}

function viewcurriculumdetails()
{

	// Get curriculum id from url
	$curriculum_id = $this->uri->segment(3);

	// get data from db
	$curriculum = $this->CurriculamModel->GetById($curriculum_id);
	$curriculumapprovalallrecords = $this->CurriculamModel->GetByIdAllRecords($curriculum_id);
	// get approval history
	$aproval_history = $this->ApprovalProcessModel->getApprovalStatusByField('curriculam_id', $curriculum_id);

	if ($_POST) {

			// set validation rules
		$this->form_validation->set_rules('facdecision','FAC Decision', 'trim|required|max_length[250]');

		$valid = $this->form_validation->run();

		if ($valid) {

				// save data into request for alt mod form table
			$form_data = array(
				'facDecision' => $_POST["facdecision"],
				'status' => $_POST["status"]
			);

			$updated_curriculum_id = $this->CurriculamModel->Update($curriculum_id,$form_data);

				//save data into approval process table
			if ($updated_curriculum_id) {
				$approval_data = array(
					'comment' => $_POST["facdecision"],
					'status' => $_POST["status"],
					'uomUser_id' => $this->session->userdata('user_id'),
					'curriculam_id' => $curriculum_id
				);

				$new_approvalprocess_id = $this->ApprovalProcessModel->Insert($approval_data);
			}

				/// set flash message
			$this->session->set_flashdata('success', "Curriculum Revision FAC Decision saved Successfully! Curriculum Revision Registration ID: ". $curriculum_id);

 				/// redirect to all permission page
			redirect('meetings/viewagenda/'.$curriculum->meeting_id);
		}

	}

	$data = array(
		'curriculum' => $curriculum,
		'curriculumapprovalallrecords' => $curriculumapprovalallrecords,
		'aproval_history' => $aproval_history
	);

	$this->layout->view("meetings/view_curriculum", $data);
}

function viewminute()
{

	// Get meeting id from url
	$meeting_id = $this->uri->segment(3);

	$meetings = $this->MeetingModel->GetById($meeting_id);
	$appealinmeeting = $this->MeetingModel->AppealGetByMeetingId($meeting_id);
	$changestomodreginmeeting = $this->MeetingModel->ChangesToModRegGetByMeetingId($meeting_id);
	$leaveinmeeting = $this->MeetingModel->LeaveGetByMeetingId($meeting_id);
	$requesttoaltmodinmeeting = $this->MeetingModel->RequestForAltModGetByMeetingId($meeting_id);
	$curriculuminmeeting = $this->MeetingModel->CurriculamGetByMeetingId($meeting_id);

	$data = array(
		"meetingsData" => $meetings,
		"appealinmeetingData" => $appealinmeeting,
		"changestomodreginmeetingData" => $changestomodreginmeeting,
		"leaveinmeetingData" => $leaveinmeeting,
		"requesttoaltmodinmeetingData" => $requesttoaltmodinmeeting,
		"curriculuminmeetingData" => $curriculuminmeeting
	);

		/// Load view
	$this->layout->view("meetings/view_minute", $data);
}

function delete()
{

	$has_permision = $this->permission->has_permission("meeting_delete");
	if(!$has_permision){
		echo "No permissions";
		return;
	}

		// Get id from url
	$meeting_id = $this->uri->segment(3);

	if($meeting_id){
		$isDeleted = $this->MeetingModel->Delete($meeting_id);
		if($isDeleted){

				/// set flash data
			$this->session->set_flashdata('success', 'Meeting Deleted successfully!');

			redirect("meetings");
		}
	}

}

function meetingreport()
{
		/// Get all meetings from db
	$meetings = $this->MeetingModel->GetAll();

		/// Define data array
	$data = array(
		"meeting_list" => $meetings
	);

		/// Load meetings view
	$html = $this->layout->report_view("analysis_and_reporting/meetings_list", $data, true);

	$this->pdfgenerator->Generate($html);

}

function agendareport()
{
	// Get meeting id from url
	$meeting_id = $this->uri->segment(3);

	$meetings = $this->MeetingModel->GetById($meeting_id);
	$appealinmeeting = $this->MeetingModel->AppealGetByMeetingId($meeting_id);
	$changestomodreginmeeting = $this->MeetingModel->ChangesToModRegGetByMeetingId($meeting_id);
	$leaveinmeeting = $this->MeetingModel->LeaveGetByMeetingId($meeting_id);
	$requesttoaltmodinmeeting = $this->MeetingModel->RequestForAltModGetByMeetingId($meeting_id);
	$curriculuminmeeting = $this->MeetingModel->CurriculamGetByMeetingId($meeting_id);

	$data = array(
		"meetingsData" => $meetings,
		"appealinmeetingData" => $appealinmeeting,
		"changestomodreginmeetingData" => $changestomodreginmeeting,
		"leaveinmeetingData" => $leaveinmeeting,
		"requesttoaltmodinmeetingData" => $requesttoaltmodinmeeting,
		"curriculuminmeetingData" => $curriculuminmeeting
	);

	$html = $this->layout->report_view("analysis_and_reporting/agenda_list", $data, true);

	$this->pdfgenerator->GenerateLan($html);
}

function minutereport(){

	// Get meeting id from url
	$meeting_id = $this->uri->segment(3);

	$meetings = $this->MeetingModel->GetById($meeting_id);
	$appealinmeeting = $this->MeetingModel->AppealGetByMeetingId($meeting_id);
	$changestomodreginmeeting = $this->MeetingModel->ChangesToModRegGetByMeetingId($meeting_id);
	$leaveinmeeting = $this->MeetingModel->LeaveGetByMeetingId($meeting_id);
	$requesttoaltmodinmeeting = $this->MeetingModel->RequestForAltModGetByMeetingId($meeting_id);
	$curriculuminmeeting = $this->MeetingModel->CurriculamGetByMeetingId($meeting_id);

	$data = array(
		"meetingsData" => $meetings,
		"appealinmeetingData" => $appealinmeeting,
		"changestomodreginmeetingData" => $changestomodreginmeeting,
		"leaveinmeetingData" => $leaveinmeeting,
		"requesttoaltmodinmeetingData" => $requesttoaltmodinmeeting,
		"curriculuminmeetingData" => $curriculuminmeeting
	);

	$html = $this->layout->report_view("analysis_and_reporting/minute_list", $data, true);

	$this->pdfgenerator->GenerateLan($html);

		/// Load view
	$this->layout->view("meetings/view_minute", $data);
}

function twomonthsmeetingreport()
{

	$start_date = date('Y-09-01 00:00:00');
	$end_date = date('Y-10-t 23:59:59');

			/// Get all meetings from db
	$meetings = $this->MeetingModel->GetThisMonthOnwordsMeeting($start_date,$end_date);

	$meeting_list = array(
		'meetings' => $meetings
	);


		/// Load meetings view
	$html = $this->layout->report_view("analysis_and_reporting/twomonthsmeeting_list", $meeting_list, true);

	$this->pdfgenerator->Generate($html);

}

}

?>