<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_Search extends CI_Controller {

	private $allowed_permissions;

	function __construct()
	{
		parent::__construct();

		//Check is loggied in to system
		if ($this->session->is_loggedin == false) {
			redirect('login');
		}

		$this->load->model("UomUserModel");
		$this->load->model("AppealFormModel");
		$this->load->model("ChangesToModuleRegistrationModel");
		$this->load->model("LeaveFormModel");
		$this->load->model("RequestForAlternativeModuleModel");
		$this->load->library("pdfgenerator");


	}

	public function index()
	{

		// Check permissions for student view page
		if(!$this->permission->has_permission("studentsearch_viewall")){
			echo "No permissions";
			return;
		}

		// Load student view
		$this->layout->view('student/student_search');
	}

	public function search()
	{

		// Check permissions for student view page
		if(!$this->permission->has_permission("studentsearch_viewall")){
			echo "No permissions";
			return;
		}

		if($_POST){

			// set validation rules
			$this->form_validation->set_rules('studentsearch','Student Search', 'trim|required|max_length[7]');

			$valid = $this->form_validation->run();

			if($valid){

				$indexno = $_POST["studentsearch"];

				$this -> view($indexno);

			}
			else{
				$this->layout->view('student/student_search');
			}

		}
	}

	function view($indexno){

		// Get user details
		$student = $this->UomUserModel->GetByRegistrationNo($indexno);

		$data = array(
			'student' => $student
		);

				/// Load student search view page
		$this->layout->view("student/view_student_search", $data);

	}

	function appealreport(){

	// Get student id from url
		$student_id = $this->uri->segment(3);

		$allappeal = $this->AppealFormModel->GetAllAppealWithDetails($student_id);

		$data = array(
			"allappeal" => $allappeal
		);

		$html = $this->layout->report_view("analysis_and_reporting/allappeal_list", $data, true);

		$this->pdfgenerator->GenerateLan($html);
	}

	function changestomodregreport(){

	// Get student id from url
		$student_id = $this->uri->segment(3);

		$allchangestomodreg = $this->ChangesToModuleRegistrationModel->GetAllChangestomodregWithDetails($student_id);

		$data = array(
			"allchangestomodreg" => $allchangestomodreg
		);

		$html = $this->layout->report_view("analysis_and_reporting/allchangestomodreg_list", $data, true);

		$this->pdfgenerator->GenerateLan($html);
	}

	function leavereport(){

	// Get student id from url
		$student_id = $this->uri->segment(3);

		$allleave = $this->LeaveFormModel->GetAllLeaveWithDetails($student_id);

		$data = array(
			"allleave" => $allleave
		);

		$html = $this->layout->report_view("analysis_and_reporting/allleave_list", $data, true);

		$this->pdfgenerator->GenerateLan($html);
	}

	function requesttoalrmodreport(){

	// Get student id from url
		$student_id = $this->uri->segment(3);

		$allrequesttoaltmod = $this->RequestForAlternativeModuleModel->GetAllRequesttoaltmodWithDetails($student_id);

		$data = array(
			"allrequesttoaltmod" => $allrequesttoaltmod
		);

		$html = $this->layout->report_view("analysis_and_reporting/allrequesttoaltmod_list", $data, true);

		$this->pdfgenerator->GenerateLan($html);
	}

}

?>