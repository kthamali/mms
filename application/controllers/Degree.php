<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Degree extends CI_Controller {

	private $allowed_permissions;

	function __construct()
	{
		parent::__construct();

		//Check is loggied in to system
		if ($this->session->is_loggedin == false) {
			redirect('login');
		}

		$this->load->model("DegreeModel");
		$this->load->model("FacultyModel");

	}

	public function index()
	{

		// Check permissions for degree view page
		if(!$this->permission->has_permission("degree_viewall")){
			echo "No permissions";
			return;
		}

		// Get all degree from db
		$degree = $this->DegreeModel->GetAll();

		// Define data array
		$data = array(
			"degree_list" => $degree
		);

		// Load degree view
		$this->layout->view('manage_details/degree/degree',$data);
	}

	function view()
	{
		// Get degree id from url
		$degree_id = $this->uri->segment(3);

		$degree = $this->DegreeModel->GetById($degree_id);

		$data = array(
			"degreeData" => $degree
		);

		/// Load view
		$this->layout->view("manage_details/degree/view_degree", $data);
	}

	function create()
	{

		$has_permision = $this->permission->has_permission("degree_create");

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
				$this->form_validation->set_rules("degreeDescription", "Degree Description", "trim|required|max_length[200]");
				$this->form_validation->set_rules("intake", "Intake", "trim|required|max_length[1]");
				$this->form_validation->set_rules("printName", "Print Name", "trim|required|max_length[500]");
				$this->form_validation->set_rules("active", "Active", "trim|required");
				$this->form_validation->set_rules("facultyId", "Faculty Id", "trim|required");

				$valid = $this->form_validation->run();
				
				if ($valid == true) {
 				// Save to database

 				/// Get post data and assign to data array
					$post_data = array(
						'degreeDescription' => $_POST["degreeDescription"],
						'intake' => $_POST["intake"],
						'printName' => $_POST["printName"],
						'active' => $_POST["active"],
						'faculty_id' => $_POST["facultyId"]
					);

 				/// Save degree in db
					$new_degree_id = $this->DegreeModel->Insert($post_data);

 				/// set flash message
					$this->session->set_flashdata('success', "Degree Created Successfully! New Degree ID: ". $new_degree_id);

 				/// redirect to all degree page
					redirect('degree');
				}
			}

			// Get all faculties
			$allFaculties = $this->FacultyModel->GetAll();
			$faculty_dropdown = array();
			$faculty_dropdown[''] = '-- Select Faculty --';
			foreach ($allFaculties as $key => $faculty) {
				$faculty_dropdown[$faculty->id] = $faculty->facultyName;
			}

			$data = array(
				'allFaculties'=>$allFaculties,
				'faculty_dropdown' => $faculty_dropdown
			);

 		/// Load all degree page
			$this->layout->view("manage_details/degree/create_degree",$data);
		}

 		// Update
		function update()
		{
			if(!$this->permission->has_permission("degree_update")){
				echo "No permissions";
				return;
			}

		// Get degree id from url
			$degree_id = $this->uri->segment(3);

		/// get degree data from db
			$selected_degree = $this->DegreeModel->GetById($degree_id);

			if($_POST){

				$this->form_validation->set_rules("degreeDescription", "Degree Description", "trim|required|max_length[200]");
				$this->form_validation->set_rules("intake", "Intake", "trim|required|max_length[1]");
				$this->form_validation->set_rules("printName", "Print Name", "trim|required|max_length[500]");
				$this->form_validation->set_rules("active", "Active", "trim|required");
				$this->form_validation->set_rules("facultyId", "Faculty Id", "trim|required");

				$isValid = $this->form_validation->run();

			if($isValid){ /// form valid
				$post_data = array(
					'degreeDescription' => $_POST["degreeDescription"],
					'intake' => $_POST["intake"],
					'printName' => $_POST["printName"],
					'active' => $_POST["active"],
					'faculty_id' => $_POST["facultyId"]
				);

			// update record
				$isUpdated = $this->DegreeModel->Update($degree_id, $post_data);

				if($isUpdated){
					$this->session->set_flashdata('success', 'Degree Updated successfully!');

					redirect("degree");
				}
			}
		}

		// Get faculty
		$allFaculties = $this->FacultyModel->GetAll();

		$faculty_dropdown = array();
		foreach ($allFaculties as $key => $faculty) {
			$faculty_dropdown[$faculty->id] = $faculty->facultyName;
		}

		$data = array(
			'degree_id' =>  $degree_id,
			'degree_details' => $selected_degree,
			'faculty_dropdown' => $faculty_dropdown
		);

		$this->layout->view("manage_details/degree/update_degree", $data);
	}

	function delete()
	{

		$has_permision = $this->permission->has_permission("degree_delete");
		if(!$has_permision){
			echo "No permissions";
			return;
		}

		// Get degree id from url
		$degree_id = $this->uri->segment(3);

		if($degree_id){
			$isDeleted = $this->DegreeModel->Delete($degree_id);
			if($isDeleted){

				/// set flash data
				$this->session->set_flashdata('success', 'Degree Deleted successfully!');

				redirect("degree");
			}
		}

	}

}

?>