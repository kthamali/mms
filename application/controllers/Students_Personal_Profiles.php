<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students_Personal_Profiles extends CI_Controller {

	private $allowed_permissions;

	function __construct()
	{
		parent::__construct();

		//Check is loggied in to system
		if ($this->session->is_loggedin == false) {
			redirect('login');
		}

	}

	public function index()
	{
		$this->layout->view('student/students_personal_profiles');
	}

}

?>