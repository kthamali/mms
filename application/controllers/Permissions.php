<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions extends CI_Controller {

	private $allowed_permissions;

	function __construct()
	{
		parent::__construct();

		//Check is loggied in to system
		if ($this->session->is_loggedin == false) {
			redirect('login');
		}

		$this->load->model("PermissionModel");

	}

	public function index()
	{

		// Check permissions for permission view page
		if(!$this->permission->has_permission("permission_viewall")){
			echo "No permissions";
			return;
		}

		// Get all permission from db
		$permission = $this->PermissionModel->GetAll();

		// Define data array
		$data = array(
			"permission_list" => $permission
		);

		// Load permission view
		$this->layout->view('permission/permission',$data);
	}

	function view()
	{
		// Get permission id from url
		$permission_id = $this->uri->segment(3);

		$permission = $this->PermissionModel->GetById($permission_id);

		$data = array(
			"permissionData" => $permission
		);

		/// Load view
		$this->layout->view("permission/view_permission", $data);
	}

	function create()
	{

		$has_permision = $this->permission->has_permission("permission_create");

		if(!$has_permision){
			echo "No permissions";
			return;
		}

		/// Check is form submitted or not
		if ($_POST) {
 /*
				$this->form_validation->set_message('required', 'CUSTOM NESSAGE:  %s is required!');
 */
 			// Set validaiton rules
				$this->form_validation->set_rules("permissionName", "Permission Name", "trim|required|max_length[100]");
				$this->form_validation->set_rules("permissionDescription", "Permission Description", "trim|required|max_length[250]");
				$this->form_validation->set_rules("code", "Permission Code", "trim|required|max_length[50]");

				$valid = $this->form_validation->run();
				
				if ($valid == true) {
 				// Save to database

 				/// Get post data and assign to data array
					$post_data = array(
						'permissionName' => $_POST["permissionName"],
						'permissionDescription' => $_POST["permissionDescription"],
						'code' => $_POST["code"]
					);

 				/// Save permission in db
					$new_permission_id = $this->PermissionModel->Insert($post_data);

 				/// set flash message
					$this->session->set_flashdata('success', "Permission Created Successfully! New Permission ID: ". $new_permission_id);

 				/// redirect to all permission page
					redirect('permissions');

				}
			}

 		/// Load all permission page
			$this->layout->view("permission/create_permission");
		}

 		// Update
		function update()
		{
			if(!$this->permission->has_permission("permission_update")){
				echo "No permissions";
				return;
			}

		// Get permission id from url
			$permission_id = $this->uri->segment(3);

		/// get permission data from db
			$selected_permission = $this->PermissionModel->GetById($permission_id);

			if($_POST){

				$this->form_validation->set_rules("permissionName", "Permission Name", "trim|required|max_length[100]");
				$this->form_validation->set_rules("permissionDescription", "Permission Description", "trim|required|max_length[250]");
				$this->form_validation->set_rules("code", "Permission Code", "trim|required|max_length[50]");

				$isValid = $this->form_validation->run();

			if($isValid){ /// form valid
				$post_data = array(
					'permissionName' => $_POST["permissionName"],
					'permissionDescription' => $_POST["permissionDescription"],
					'code' => $_POST["code"]
				);

			// update record
				$isUpdated = $this->PermissionModel->Update($permission_id, $post_data);

				if($isUpdated){
					$this->session->set_flashdata('success', 'Permission Updated successfully!');

					redirect("permissions");
				}
			}
		}

		$data = array(
			'permission_id' =>  $permission_id,
			'permission_details' => $selected_permission
		);

		$this->layout->view("permission/update_permission", $data);
	}

	function delete()
	{
		$has_permision = $this->permission->has_permission("permission_delete");
		if(!$has_permision){
			echo "No permissions";
			return;
		}

		// Get permission id from url
		$permission_id = $this->uri->segment(3);

		if($permission_id){

			$isDeleted = $this->PermissionModel->Delete($permission_id);

				// check has db errors
			$has_error = $this->db->error();
			if ($has_error && $has_error['code'] == 1451) {
				$this->session->set_flashdata('error', 'Unable to delete permission! This permission is used in other modules.');
				redirect("permissions");
			}else{
				if($isDeleted){
					$this->session->set_flashdata('success', 'Permission Deleted successfully!');
					redirect("permissions");
				}
			}
		}

	}

}

?>