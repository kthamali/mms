<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Academic_Year extends CI_Controller {

	private $allowed_permissions;

	function __construct()
	{
		parent::__construct();

		//Check is loggied in to system
		if ($this->session->is_loggedin == false) {
			redirect('login');
		}

		$this->load->model("AcademicYearModel");

	}

	public function index()
	{

		// Check permissions for academic year view page
		if(!$this->permission->has_permission("academicyear_viewall")){
			echo "No permissions";
			return;
		}

		// Get all academic year from db
		$academicyear = $this->AcademicYearModel->GetAll();

		// Define data array
		$data = array(
			"academicyear_list" => $academicyear
		);

		// Load academicyear view
		$this->layout->view('manage_details/academic_year/academic_year',$data);
	}

	function view()
	{
		// Get academicyear id from url
		$academicyear_id = $this->uri->segment(3);

		$academicyear = $this->AcademicYearModel->GetById($academicyear_id);

		$data = array(
			"academicyearData" => $academicyear
		);

		/// Load view
		$this->layout->view("manage_details/academic_year/view_academicyear", $data);
	}

	function create()
	{

		$has_permision = $this->permission->has_permission("academicyear_create");

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
				$this->form_validation->set_rules("academicYearDescription", "Academic Year Description", "trim|required|max_length[100]");
				$this->form_validation->set_rules("academicYearCode", "Academic Year Code", "trim|required|max_length[20]");
				$this->form_validation->set_rules("intake", "Intake", "trim|required");

				$valid = $this->form_validation->run();
				
				if ($valid == true) {
 				// Save to database

 				/// Get post data and assign to data array
					$post_data = array(
						'academicYearDescription' => $_POST["academicYearDescription"],
						'academicYearCode' => $_POST["academicYearCode"],
						'intake' => $_POST["intake"]
					);

 				/// Save academicyear in db
					$new_academicyear_id = $this->AcademicYearModel->Insert($post_data);

 				/// set flash message
					$this->session->set_flashdata('success', "Academic 
						year Created Successfully! New Academic year ID: ". $new_academicyear_id);

 				/// redirect to all academicyear page
					redirect('academic_year');

				}
			}

 		/// Load all academicyear page
			$this->layout->view("manage_details/academic_year/create_academicyear");
		}

 		// Update
		function update()
		{
			if(!$this->permission->has_permission("academicyear_update")){
				echo "No permissions";
				return;
			}

		// Get academicyear id from url
			$academicyear_id = $this->uri->segment(3);

		/// get academicyear data from db
			$selected_academicyear = $this->AcademicYearModel->GetById($academicyear_id);

			if($_POST){

				$this->form_validation->set_rules("academicYearDescription", "Academic Year Description", "trim|required|max_length[100]");
				$this->form_validation->set_rules("academicYearCode", "Academic Year Code", "trim|required|max_length[20]");
				$this->form_validation->set_rules("intake", "Intake", "trim|required");

				$isValid = $this->form_validation->run();

			if($isValid){ /// form valid
				$post_data = array(
					'academicYearDescription' => $_POST["academicYearDescription"],
					'academicYearCode' => $_POST["academicYearCode"],
					'intake' => $_POST["intake"]
				);

			// update record
				$isUpdated = $this->AcademicYearModel->Update($academicyear_id, $post_data);

				if($isUpdated){
					$this->session->set_flashdata('success', 'Academic Year Updated successfully!');

					redirect("academic_year");
				}
			}
		}

		$data = array(
			'academicyear_id' =>  $academicyear_id,
			'academicyear_details' => $selected_academicyear
		);

		$this->layout->view("manage_details/academic_year/update_academicyear", $data);
	}

	function delete()
	{

		$has_permision = $this->permission->has_permission("academicyear_delete");
		if(!$has_permision){
			echo "No permissions";
			return;
		}

		// Get academicyear id from url
		$academicyear_id = $this->uri->segment(3);

		if($academicyear_id){
			$isDeleted = $this->AcademicYearModel->Delete($academicyear_id);
			if($isDeleted){

				/// set flash data
				$this->session->set_flashdata('success', 'Academic Year Deleted successfully!');

				redirect("academic_year");
			}
		}

	}

}

?>