<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Profile extends CI_Controller {

	private $allowed_permissions;

	function __construct()
	{
		parent::__construct();

		//Check is loggied in to system
		if ($this->session->is_loggedin == false) {
			redirect('login');
		}

		$this->load->model("UomUserModel");

	}

	//view user profile
	function index(){
		if(!$this->permission->has_permission("userprofile_view")){
				echo "No permissions";
				return;
			}

		// Get user id from url
			$uomuser_id = $this->session->userdata('user_id');

		/// get user data from db
			$selected_uomuser = $this->UomUserModel->GetByIdUpdateProfile($uomuser_id);

			$data = array(
				'uomuser_id' =>  $uomuser_id,
				'uomuser_details' => $selected_uomuser
			);

			$this->layout->view("user/view_userprofile", $data);
	}

	//update user profile
		function update()
		{
			if(!$this->permission->has_permission("userprofile_update")){
				echo "No permissions";
				return;
			}

		// Get user id from url
			$uomuser_id = $this->session->userdata('user_id');

		/// get user data from db
			$selected_uomuser = $this->UomUserModel->GetByIdUpdateProfile($uomuser_id);

			if($_POST){

				// Set validaiton rules
				$this->form_validation->set_rules("title", "Title", "trim|required|max_length[100]");
				$this->form_validation->set_rules("firstName", "First Name", "trim|max_length[200]");
				$this->form_validation->set_rules("lastName", "Last Name", "trim|max_length[200]");
				$this->form_validation->set_rules("dob", "Date of Birth", "trim|required");
				$this->form_validation->set_rules("permanentAddress", "Address", "trim|required");
				$this->form_validation->set_rules("permanentTelephone", "Contact Number", "trim|required|max_length[10]");

				$isValid = $this->form_validation->run();

				if($isValid){ /// form valid
					$post_data = array(
						'title' => $_POST["title"],
						'firstName' => $_POST["firstName"],
						'lastName' => $_POST["lastName"],
						'dob' => $_POST["dob"],
						'permanentAddress' => $_POST["permanentAddress"],
						'permanentTelephone' => $_POST["permanentTelephone"]
					);

			// update record
					$isUpdated = $this->UomUserModel->Update($uomuser_id, $post_data);

					if($isUpdated){
						$this->session->set_flashdata('success', 'User Updated successfully!');
						redirect("user_profile");
					}
				}
			}

			$data = array(
				'uomuser_id' =>  $uomuser_id,
				'uomuser_details' => $selected_uomuser
			);

			$this->layout->view("user/update_userprofile", $data);
		}

		function changePassword()
		{
			$uomuser_id = $this->session->userdata('user_id');

			if ($_POST) {
				// Set validaiton rules
				$this->form_validation->set_rules("password", "Password", "trim|required");
				$this->form_validation->set_rules("conf_password", "Confirm Password", "trim|required|matches[password]'");

				$isValid = $this->form_validation->run();
				if ($isValid) {
					$data = array(
						'userPassword' => md5($_POST["password"])
					);

					$isUpdated = $this->UomUserModel->Update($uomuser_id, $data);

					if($isUpdated){
						$this->session->set_flashdata('success', 'Password changed successfully!');
						redirect("user_profile");
					}
				}
			}

			$this->layout->view("user/change_psw");
		}

	}

	?>