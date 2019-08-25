<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Type extends CI_Controller {

	private $allowed_permissions;

	function __construct()
	{
		parent::__construct();
		$this->load->model("UserTypeModel");
		$this->load->model("PermissionModel");
		$this->load->model("PermissionUserTypeModel");

		/// Check is loggied in to system
		if ($this->session->is_loggedin == false) {
			redirect('login');
		}

	}

	function index()
	{
		if(!$this->permission->has_permission("usertype_viewall")){
			echo "No permissions";
			return;
		}

		$usertypes = $this->UserTypeModel->GetAll();

		$data = array('usertype_list' => $usertypes);


		$this->layout->view("usertype/usertype", $data);
	}

	function set_permission()
	{

		$usertype_id =  $this->uri->segment(3);

		if ($_POST) {
			$selected_permissions = $_POST["permissions"];

			$this->PermissionUserTypeModel->DeleteByUserType($usertype_id);

			foreach ($selected_permissions as $key => $permission_id) {

				$data_set = array(
					'usertype_id' => $usertype_id, 
					'permission_id' => $permission_id,
					'created_user_id' => $this->session->user_id
				);

				$this->PermissionUserTypeModel->Insert($data_set);
			}
			$this->session->set_flashdata('success', "Permission Added Successfully!");
			redirect('user_type');

		}

		// load all permission list
		$permission_list = $this->PermissionModel->GetAll();


		// Load all existing permissions
		$selected_permissions = $this->PermissionUserTypeModel->GetPermissionIdByUserTypeId($usertype_id);

		$permission_id_array = array();
		foreach ($selected_permissions as $key => $permission) {
			array_push($permission_id_array, $permission->permission_id);
		}

		$data = array(
			'permission_list' => $permission_list,
			'permission_id_array' => $permission_id_array
		);

		$this->layout->view("usertype/set_permission", $data);

		
	}

	function view()
	{
		// Get usertype id from url
		$usertype_id = $this->uri->segment(3);

		$usertype = $this->UserTypeModel->GetById($usertype_id);

		$data = array(
			"usertypeData" => $usertype
		);

		/// Load view
		$this->layout->view("usertype/view_usertype", $data);
	}

	function create()
	{

		$has_permision = $this->permission->has_permission("usertype_create");

		if(!$has_permision){
			echo "No permissions";
			return;
		}

		// Check is form submitted or not
		if ($_POST) {
/*
				$this->form_validation->set_message('required', 'CUSTOM NESSAGE:  %s is required!');
*/
			// Set validaiton rules
				$this->form_validation->set_rules("userTypeDescription", "User Type Description", "trim|required|max_length[100]");
				$this->form_validation->set_rules("code", "Code", "trim|required|max_length[256]");

				$valid = $this->form_validation->run();
				
				if ($valid == true) {
				// Save to database

				/// Get post data and assign to data array
					$post_data = array(
						'userTypeDescription' => $_POST["userTypeDescription"],
						'code' => $_POST["code"]
					);
					//if() - check
				// Save usertype in db
					$new_usertype_id = $this->UserTypeModel->Insert($post_data);

				// set flash message
					$this->session->set_flashdata('success', "User Type Created Successfully! New User Type ID: ". $new_usertype_id);

				// redirect to all usertype page
					redirect('user_type');

				}
			}

		// Load all usertype page
			$this->layout->view("usertype/create_usertype");
		}

// Update
		function update()
		{
			if(!$this->permission->has_permission("usertype_update")){
				echo "No permissions";
				return;
			}

		// Get usertype id from url
			$usertype_id = $this->uri->segment(3);

		/// get usertype data from db
			$selected_usertype = $this->UserTypeModel->GetById($usertype_id);

			if($_POST){

				$this->form_validation->set_rules("userTypeDescription", "User Type Description", "trim|required|max_length[100]");
				$this->form_validation->set_rules("code", "Code", "trim|required|max_length[256]");

				$isValid = $this->form_validation->run();

			if($isValid){ /// form valid
				$post_data = array(
					'userTypeDescription' => $_POST["userTypeDescription"],
					'code' => $_POST["code"]
					
				);

			// update record
				$isUpdated = $this->UserTypeModel->Update($usertype_id, $post_data);

				if($isUpdated){
					$this->session->set_flashdata('success', 'User Type Updated successfully!');

					redirect("user_type");
				}
			}
		}

		$data = array(
			'usertype_id' =>  $usertype_id,
			'usertype_details' => $selected_usertype
		);

		$this->layout->view("usertype/update_usertype", $data);
	}

	function delete()
	{
			// Check permissions for usertype delete page
		if(!$this->permission->has_permission("usertype_delete")){
			echo "No permissions";
			return;
		}

		// Get usertype id from url
		$usertype_id = $this->uri->segment(3);

		if($usertype_id){
			$isDeleted = $this->UserTypeModel->Delete($usertype_id);
			if($isDeleted){

				// set flash data
				$this->session->set_flashdata('success', 'User Type Deleted successfully!');

				redirect("user_type");
			}
		}

	}




}