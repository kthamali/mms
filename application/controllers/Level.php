<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Level extends CI_Controller {

	private $allowed_permissions;

	function __construct()
	{
		parent::__construct();

		//Check is loggied in to system
		if ($this->session->is_loggedin == false) {
			redirect('login');
		}

		$this->load->model("LevelModel");

	}

	public function index()
	{

		// Check permissions for level view page
		if(!$this->permission->has_permission("level_viewall")){
			echo "No permissions";
			return;
		}

		// Get all level from db
		$level = $this->LevelModel->GetAll();

		// Define data array
		$data = array(
			"level_list" => $level
		);

		// Load level view
		$this->layout->view('manage_details/level/level',$data);
	}

	function view()
	{
		// Get level id from url
		$level_id = $this->uri->segment(3);

		$level = $this->LevelModel->GetById($level_id);

		$data = array(
			"levelData" => $level
		);

		/// Load view
		$this->layout->view("manage_details/level/view_level", $data);
	}

	function create()
	{

		$has_permision = $this->permission->has_permission("level_create");

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
				$this->form_validation->set_rules("levelDescription", "Level Description", "trim|required|max_length[100]");
				$this->form_validation->set_rules("constant", "Constant", "trim|required");

				$valid = $this->form_validation->run();
				
				if ($valid == true) {
 				// Save to database

 				/// Get post data and assign to data array
					$post_data = array(
						'levelDescription' => $_POST["levelDescription"],
						'constant' => $_POST["constant"]
					);

 				/// Save level in db
					$new_level_id = $this->LevelModel->Insert($post_data);

 				/// set flash message
					$this->session->set_flashdata('success', "Level Created Successfully! New Level ID: ". $new_level_id);

 				/// redirect to all Level page
					redirect('level');

				}
			}

 		/// Load all Level page
			$this->layout->view("manage_details/level/create_level");
		}

 		// Update
		function update()
		{
			if(!$this->permission->has_permission("level_update")){
				echo "No permissions";
				return;
			}

		// Get degree id from url
			$level_id = $this->uri->segment(3);

		/// get degree data from db
			$selected_level = $this->LevelModel->GetById($level_id);

			if($_POST){

				$this->form_validation->set_rules("levelDescription", "Level Description", "trim|required|max_length[100]");
				$this->form_validation->set_rules("constant", "Constant", "trim|required");

				$isValid = $this->form_validation->run();

			if($isValid){ /// form valid
				$post_data = array(
					'levelDescription' => $_POST["levelDescription"],
					'constant' => $_POST["constant"]
				);

			// update record
				$isUpdated = $this->LevelModel->Update($level_id, $post_data);

				if($isUpdated){
					$this->session->set_flashdata('success', 'Level Updated successfully!');

					redirect("level");
				}
		}
	}

	$data = array(
		'level_id' =>  $level_id,
		'level_details' => $selected_level
	);

	$this->layout->view("manage_details/level/update_level", $data);
}

function delete()
{

	$has_permision = $this->permission->has_permission("level_delete");
	if(!$has_permision){
		echo "No permissions";
		return;
	}

		// Get level id from url
	$level_id = $this->uri->segment(3);

	if($level_id){
		$isDeleted = $this->LevelModel->Delete($level_id);
		if($isDeleted){

				/// set flash data
			$this->session->set_flashdata('success', 'Level Deleted successfully!');

			redirect("level");
		}
	}

}

}

?>