<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {

	private $allowed_permissions;

	function __construct()
	{
		parent::__construct();
		$this->load->model('EnrolmentModel');
		$this->load->model('CourseModel');
	}	

	// get action courses
	public function getactoincourses($module_action)
	{

		$courses = array();

		if ($module_action == 0) {

			$student_id = $this->session->userdata('user_id');

			// get enrolled courses
			$data = $this->EnrolmentModel->Enrolments($student_id);
			echo json_encode($data);
		}

		if ($module_action == 1) {

			// get enrolled courses
			$data = $this->CourseModel->GetAll();
			echo json_encode($data);
		}

	}

	// get action courses
	public function getcourses()
	{

		$courses = array();

			// get enrolled courses
			$data = $this->CourseModel->GetAll();
			echo json_encode($data);

	}

	
}

?>