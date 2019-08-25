<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curriculum extends CI_Controller {

	private $allowed_permissions;

	function __construct()
	{
		parent::__construct();

		//Check is loggied in to system
		if ($this->session->is_loggedin == false) {
			redirect('login');
		}

		$this->load->model("CurriculamModel");
		$this->load->model("UomUserModel");
		$this->load->model("ApprovalProcessModel");
		$this->load->model("MeetingModel");
		$this->load->model("DepartmentModel");
		$this->load->library("pdfgenerator");
	}

	public function index()
	{

		// Check permissions for curriculam view page
		if(!$this->permission->has_permission("curriculum_viewall")){
			echo "No permissions";
			return;
		}

		$curriculum = array();
		if ($this->permission->has_permission("view_all_curriculums")) {
			// Get all curriculum form from db
			$curriculum = $this->CurriculamModel->GetAllWithDetails();
		}else{

			$status = array();

			// Get curriculum by status list
			$this->permission->has_permission("approve_pending_curriculum") ? array_push($status, 'pending') : null;
			$this->permission->has_permission("approve_chairman_approved_curriculum") ? array_push($status, 'chairman_forwarded_to_FAC') : null;
			$this->permission->has_permission("view_chairman_rejected_appeals") ? array_push($status, 'chairman_rejected') : null;

			if (count($status) > 0) {
				$curriculum = $this->CurriculamModel->GetAllByStatusList($status);
			}
		}

		// Define data array
		$data = array(
			"curriculum_list" => $curriculum
		);

		$this->layout->view('curriculum/curriculum',$data);
	}

	function create()
	{

		$has_permision = $this->permission->has_permission("curriculum_create");

		if(!$has_permision){
			echo "No permissions";
			return;
		}

		$uomuser_id = $this->session->userdata('user_id');

		if ($_POST) {

			// set validation rules
			$this->form_validation->set_rules('departmentId','Department Id', 'trim|required');
			$this->form_validation->set_rules('curriculamDescription','Curriculam Description', 'trim|required|max_length[100]');
			$this->form_validation->set_rules('supdoc','Supporting Documents');
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
					'department_id' => $_POST["departmentId"],
					'curriculamDescription' => $_POST["curriculamDescription"],
					'uomUser_id' => $uomuser_id 
				);

				$new_curriculam_id = $this->CurriculamModel->Insert($form_data);

				/// set flash message
				$this->session->set_flashdata('success', "Curriculum Revision Created Successfully! Curriculum Revision ID: ". $new_curriculam_id);

 				/// redirect to all permission page
				redirect('curriculum');
			}
		}

		// Get all departments
		$allDepartments = $this->DepartmentModel->GetAll();
		$department_dropdown = array();
		$department_dropdown[''] = '-- Select Department --';
		foreach ($allDepartments as $key => $Department) {
			$department_dropdown[$Department->id] = $Department->departmentName;
		}

		$data = array(
			'allDepartments'=>$allDepartments,
			'department_dropdown' => $department_dropdown
		);

 		/// Load all curriculum form page
		$this->layout->view("curriculum/create_curriculum",$data);
	}

	public function view()
	{

		// Get curriculum id from url
		$curriculum_id = $this->uri->segment(3);

		// get data from db
		$curriculum = $this->CurriculamModel->GetById($curriculum_id);
		$curriculumapprovalallrecords = $this->CurriculamModel->GetByIdAllRecords($curriculum_id);

		// upcomming meetings
		$meetings = $this->MeetingModel->Upcoming_meetings();
		
		$meeting_dropdown = array();
		$meeting_dropdown[''] = "-- Select a Meeting --";
		foreach ($meetings as $key => $meeting) {
			$meeting_dropdown[$meeting->id] = $meeting->meetingCode . ' : ' . $meeting->name;
		}

		// get approval history
		$aproval_history = $this->ApprovalProcessModel->getApprovalStatusByField('curriculam_id', $curriculum_id);

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

				// update data into curriculum form table
				$form_data = array(
					'status' => $status,
					'meeting_id' => $_POST["meeting_id"]
				);

				$updated_curriculum_id = $this->CurriculamModel->Update($curriculum_id,$form_data);

				// save data into approval process table
				if ($updated_curriculum_id) {
					$approval_data = array(
						'comment' => $_POST["comment"],
						'status' => $status,
						'uomUser_id' => $this->session->userdata('user_id'),
						'curriculam_id' => $curriculum_id
					);

					$new_approvalprocess_id = $this->ApprovalProcessModel->Insert($approval_data);

				}

				$message = "Curriculum Revision Approved Successfully! Curriculum Revision ID: ";
				if (isset($_POST['reject'])) {
					$message = "Curriculum Revision Rejected Successfully! Curriculum Revision ID: ";
				}

				/// set flash message
				$this->session->set_flashdata('success', $message. $curriculum_id);

 				/// redirect to all curriculum form page
				redirect('curriculum');

			}

		}

		$data = array(
			'curriculum' => $curriculum,
			'curriculumapprovalallrecords' => $curriculumapprovalallrecords,
			'meeting_dropdown' => $meeting_dropdown,
			'aproval_history' => $aproval_history
		);

		$this->layout->view("curriculum/view_curriculum", $data);
	}

	public function myview()
	{

		// Get curriculum id from url
		$curriculum_id = $this->uri->segment(3);

		// get data from db
		$curriculum = $this->CurriculamModel->GetById($curriculum_id);
		$curriculumapprovalallrecords = $this->CurriculamModel->GetByIdAllRecords($curriculum_id);

		// get approval history
		$aproval_history = $this->ApprovalProcessModel->getApprovalStatusByField('curriculam_id', $curriculum_id);

		$data = array(
			'curriculum' => $curriculum,
			'curriculumapprovalallrecords' => $curriculumapprovalallrecords,
			'aproval_history' => $aproval_history
		);

		$this->layout->view("curriculum/my_view_curriculum", $data);
	}

	function delete()
	{

		$has_permision = $this->permission->has_permission("curriculum_delete");
		if(!$has_permision){
			echo "No permissions";
			return;
		}

		// Get id from url
		$curriculum_id = $this->uri->segment(3);

		if($curriculum_id){
			$isDeleted = $this->CurriculamModel->Delete($curriculum_id);
			if($isDeleted){

				/// set flash data
				$this->session->set_flashdata('success', 'Curriculum Deleted successfully!');

				redirect("curriculum");
			}
		}

	}

	public function curriculumreport()
	{

		// Get curriculum id from url
		$curriculum_id = $this->uri->segment(3);

		// get data from db
		$curriculum = $this->CurriculamModel->GetById($curriculum_id);
		$curriculumapprovalallrecords = $this->CurriculamModel->GetByIdAllRecords($curriculum_id);

		// get approval history
		$aproval_history = $this->ApprovalProcessModel->getApprovalStatusByField('curriculam_id', $curriculum_id);

		$data = array(
			'curriculum' => $curriculum,
			'curriculumapprovalallrecords' => $curriculumapprovalallrecords,
			'aproval_history' => $aproval_history
		);

		/// Load curriculum view
		$html = $this->layout->report_view("analysis_and_reporting/curriculum_list", $data, true);

		$this->pdfgenerator->Generate($html);
	}

}

?>