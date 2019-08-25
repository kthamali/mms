<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model("AuthModel");
	}
	
	public function index()
	{
		// Check logged in to system
		if ($this->session->is_loggedin == true) {
			redirect('dashboard');
		}

		// If form submitted

		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$isvalid = $this->form_validation->run();

		// Is form valid
		if ($isvalid) {


			// Get username and passwords from form data
			$username = $_POST["username"];
			$password = $_POST["password"];

			// Check user in db
			$user = $this->AuthModel->Login($username, $password);

			if ($user == null) {
				// Invalid user
				$this->session->set_flashdata('error_message', 'Invalid username or password');

			}else{
				// User valid

				// set session for logged user
				$userdata = array(
					'is_loggedin' => true,
					'user_id' => $user->id,
					'first_name' => $user->firstName,
					'last_name' => $user->lastName,
					'username' => $user->userName
				);

				$this->session->set_userdata($userdata);

				// rediredct to home page
				redirect('dashboard');
				return;
			}

		}else{

				// Is form invalid
			$this->form_validation->set_error_delimiters('<div>', '</div>');
		}

		$this->load->view('login/login');
	}


	// Logout
	function Logout()
	{
		$this->session->sess_destroy();
		redirect("Login");
	}
}
