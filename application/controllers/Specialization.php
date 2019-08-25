<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Specialization extends CI_Controller {

	private $allowed_permissions;

	function __construct()
	{
		parent::__construct();

		//Check is loggied in to system
		if ($this->session->is_loggedin == false) {
			redirect('login');
		}

		$this->load->model("SpecializationModel");
		$this->load->model("DegreeModel");

	}

	public function index()
	{

		// Check permissions for specialization view page
		if(!$this->permission->has_permission("specialization_viewall")){
			echo "No permissions";
			return;
		}

		// Get all specialization from db
		$specialization = $this->SpecializationModel->GetAll();

		// Define data array
		$data = array(
			"specialization_list" => $specialization
		);

		// Load specialization view
		$this->layout->view('manage_details/specialization/specialization',$data);
	}

	function view()
	{
		// Get specialization id from url
		$specialization_id = $this->uri->segment(3);

		$specialization = $this->SpecializationModel->GetById($specialization_id);

		$data = array(
			"specializationData" => $specialization
		);

		/// Load view
		$this->layout->view("manage_details/specialization/view_specialization", $data);
	}

	function create()
	{

		$has_permision = $this->permission->has_permission("specialization_create");

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
				$this->form_validation->set_rules("specializationDescription", "Specialization Description", "trim|required|max_length[100]");
				$this->form_validation->set_rules("degreeId", "Degree Id", "trim|required");

				$valid = $this->form_validation->run();
				
				if ($valid == true) {
 				// Save to database

 				/// Get post data and assign to data array
					$post_data = array(
						'specializationDescription' => $_POST["specializationDescription"],
						'degree_id' => $_POST["degreeId"]
					);

 				/// Save specialization in db
					$new_specialization_id = $this->SpecializationModel->Insert($post_data);

 				/// set flash message
					$this->session->set_flashdata('success', "Specialization Created Successfully! New Specialization ID: ". $new_specialization_id);

 				/// redirect to all specialization page
					redirect('specialization');

				}
			}

			// Get all degrees
			$allDegrees = $this->DegreeModel->GetAll();
			$degree_dropdown = array();
			$degree_dropdown[''] = '-- Select Degree --';
			foreach ($allDegrees as $key => $degree) {
				$degree_dropdown[$degree->id] = $degree->degreeDescription;
			}

			$data = array(
				'allDegrees'=>$allDegrees,
				'degree_dropdown' => $degree_dropdown
			);

 		/// Load all specialization page
			$this->layout->view("manage_details/specialization/create_specialization",$data);
		}

 		// Update
		function update()
		{
			if(!$this->permission->has_permission("specialization_update")){
				echo "No permissions";
				return;
			}

		// Get degree id from url
			$specialization_id = $this->uri->segment(3);

		/// get degree data from db
			$selected_specialization = $this->SpecializationModel->GetById($specialization_id);

			if($_POST){

				$this->form_validation->set_rules("specializationDescription", "Specialization Description", "trim|required|max_length[100]");
				$this->form_validation->set_rules("degreeId", "Degree Id", "trim|required");

				$isValid = $this->form_validation->run();

			if($isValid){ /// form valid
				$post_data = array(
					'specializationDescription' => $_POST["specializationDescription"],
					'degree_id' => $_POST["degreeId"]
				);

			// update record
				$isUpdated = $this->SpecializationModel->Update($specialization_id, $post_data);

				if($isUpdated){
					$this->session->set_flashdata('success', 'Specialization Updated successfully!');

					redirect("specialization");
				}
			}
		}

		// Get degree
		$allDegrees = $this->DegreeModel->GetAll();

		$degree_dropdown = array();
		foreach ($allDegrees as $key => $degree) {
			$degree_dropdown[$degree->id] = $degree->degreeDescription;
		}

		$data = array(
			'specialization_id' =>  $specialization_id,
			'specialization_details' => $selected_specialization,
			'degree_dropdown' => $degree_dropdown
		);

		$this->layout->view("manage_details/specialization/update_specialization", $data);
	}

	function delete()
	{

		$has_permision = $this->permission->has_permission("specialization_delete");
		if(!$has_permision){
			echo "No permissions";
			return;
		}

		// Get specialization id from url
		$specialization_id = $this->uri->segment(3);

		if($specialization_id){
			$isDeleted = $this->SpecializationModel->Delete($specialization_id);
			if($isDeleted){

				/// set flash data
				$this->session->set_flashdata('success', 'Specialization Deleted successfully!');

				redirect("specialization");
			}
		}

	}

}

?>