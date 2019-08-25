<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faculty extends CI_Controller {

	private $allowed_permissions;

	function __construct()
	{
		parent::__construct();

		//Check is loggied in to system
		if ($this->session->is_loggedin == false) {
			redirect('login');
		}

		$this->load->model("FacultyModel");

	}

	public function index()
	{

		// Check permissions for faculty view page
		if(!$this->permission->has_permission("faculty_viewall")){
			echo "No permissions";
			return;
		}

		// Get all faculty from db
		$faculty = $this->FacultyModel->GetAll();

		// Define data array
		$data = array(
			"faculty_list" => $faculty
		);

		// Load faculty view
		$this->layout->view('manage_details/faculty/faculty',$data);
	}

	function view()
	{
		// Get faculty id from url
		$faculty_id = $this->uri->segment(3);

		$faculty = $this->FacultyModel->GetById($faculty_id);

		$data = array(
			"facultyData" => $faculty
		);

		/// Load view
		$this->layout->view("manage_details/faculty/view_faculty", $data);
	}

	function create()
	{

		$has_permision = $this->permission->has_permission("faculty_create");

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
				$this->form_validation->set_rules("facultyName", "Faculty Name", "trim|required|max_length[100]");

				$valid = $this->form_validation->run();
				
				if ($valid == true) {
 				// Save to database

 				/// Get post data and assign to data array
					$post_data = array(
						'facultyName' => $_POST["facultyName"]
					);

 				/// Save faculty in db
					$new_faculty_id = $this->FacultyModel->Insert($post_data);

 				/// set flash message
					$this->session->set_flashdata('success', "Faculty Created Successfully! New Faculty ID: ". $new_faculty_id);

 				/// redirect to all faculty page
					redirect('faculty');

				}
			}

 		/// Load all faculty page
			$this->layout->view("manage_details/faculty/create_faculty");
		}

 		// Update
		function update()
		{
			if(!$this->permission->has_permission("faculty_update")){
				echo "No permissions";
				return;
			}

		// Get degree id from url
			$faculty_id = $this->uri->segment(3);

		/// get degree data from db
			$selected_faculty = $this->FacultyModel->GetById($faculty_id);

			if($_POST){

				$this->form_validation->set_rules("facultyName", "Faculty Name", "trim|required|max_length[100]");

				$isValid = $this->form_validation->run();

			if($isValid){ /// form valid
				$post_data = array(
					'facultyName' => $_POST["facultyName"]
				);

			// update record
				$isUpdated = $this->FacultyModel->Update($faculty_id, $post_data);

				if($isUpdated){
					$this->session->set_flashdata('success', 'Faculty Updated successfully!');

					redirect("faculty");
				}
			}
		}

		$data = array(
			'faculty_id' =>  $faculty_id,
			'faculty_details' => $selected_faculty
		);

		$this->layout->view("manage_details/faculty/update_faculty", $data);
	}

	function delete()
	{

		$has_permision = $this->permission->has_permission("faculty_delete");
		if(!$has_permision){
			echo "No permissions";
			return;
		}

		// Get faculty id from url
		$faculty_id = $this->uri->segment(3);

		if($faculty_id){
			$isDeleted = $this->FacultyModel->Delete($faculty_id);
			if($isDeleted){

				/// set flash data
				$this->session->set_flashdata('success', 'Faculty Deleted successfully!');

				redirect("faculty");
			}
		}

	}

}

?>