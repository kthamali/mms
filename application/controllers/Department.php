<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

	private $allowed_permissions;

	function __construct()
	{
		parent::__construct();

		//Check is loggied in to system
		if ($this->session->is_loggedin == false) {
			redirect('login');
		}

		$this->load->model("DepartmentModel");
		$this->load->model("FacultyModel");

	}

	public function index()
	{

		// Check permissions for department view page
		if(!$this->permission->has_permission("department_viewall")){
			echo "No permissions";
			return;
		}

		// Get all department from db
		$department = $this->DepartmentModel->GetAll();

		// Define data array
		$data = array(
			"department_list" => $department
		);

		// Load department view
		$this->layout->view('manage_details/department/department',$data);
	}

	function view()
	{
		// Get department id from url
		$department_id = $this->uri->segment(3);

		$department = $this->DepartmentModel->GetById($department_id);

		$data = array(
			"departmentData" => $department
		);

		/// Load view
		$this->layout->view("manage_details/department/view_department", $data);
	}

	function create()
	{

		$has_permision = $this->permission->has_permission("department_create");

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
				$this->form_validation->set_rules("departmentName", "Department Name", "trim|required|max_length[100]");
				$this->form_validation->set_rules("departmentCode", "Department Code", "trim|required|max_length[20]");
				$this->form_validation->set_rules("offerModules", "Offer Modules", "trim|required");
				$this->form_validation->set_rules("facultyId", "Faculty Id", "trim|required");

				$valid = $this->form_validation->run();
				
				if ($valid == true) {
 				// Save to database

 				/// Get post data and assign to data array
					$post_data = array(
						'departmentName' => $_POST["departmentName"],
						'departmentCode' => $_POST["departmentCode"],
						'offerModules' => $_POST["offerModules"],
						'faculty_id' => $_POST["facultyId"]
					);

 				/// Save department in db
					$new_department_id = $this->DepartmentModel->Insert($post_data);

 				/// set flash message
					$this->session->set_flashdata('success', "Department Created Successfully! New Department ID: ". $new_department_id);

 				/// redirect to all department page
					redirect('department');

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
 		/// Load all department page
			$this->layout->view("manage_details/department/create_department",$data);
		}

 		// Update
		function update()
		{
			if(!$this->permission->has_permission("department_update")){
				echo "No permissions";
				return;
			}

			// Get department id from url
			$department_id = $this->uri->segment(3);

			if($_POST){

				// Set validation rules
				$this->form_validation->set_rules("departmentName", "Department Name", "trim|required|max_length[100]");
				$this->form_validation->set_rules("departmentCode", "Department Code", "trim|required|max_length[20]");
				$this->form_validation->set_rules("offerModules", "Offer Modules", "trim|required");
				$this->form_validation->set_rules("facultyId", "Faculty Id", "trim|required");

				$isValid = $this->form_validation->run();

				if($isValid){ 
					/// form valid
					$post_data = array(
						'departmentName' => $_POST["departmentName"],
						'departmentCode' => $_POST["departmentCode"],
						'offerModules' => $_POST["offerModules"],
						'faculty_id' => $_POST["facultyId"]
					);

					// update record
					$isUpdated = $this->DepartmentModel->Update($department_id, $post_data);

					if($isUpdated){
						$this->session->set_flashdata('success', 'Department Updated successfully!');

						redirect("department");
					}
				}
			}


			// Get department id from url
			$allFaculties = $this->FacultyModel->GetAll();

			$faculty_dropdown = array();
			foreach ($allFaculties as $key => $faculty) {
				$faculty_dropdown[$faculty->id] = $faculty->facultyName;
			}

			/// get department data from db
			$department_details = $this->DepartmentModel->GetById($department_id);

			$data = array(
				'department_id' =>  $department_id,
				'department_details' => $department_details,
				'faculty_dropdown' => $faculty_dropdown
			);

			$this->layout->view("manage_details/department/update_department", $data);
		}

		function delete()
		{

			$has_permision = $this->permission->has_permission("department_delete");
			if(!$has_permision){
				echo "No permissions";
				return;
			}

		// Get degree id from url
			$department_id = $this->uri->segment(3);

			if($department_id){
				$isDeleted = $this->DepartmentModel->Delete($department_id);
				if($isDeleted){

				/// set flash data
					$this->session->set_flashdata('success', 'Department Deleted successfully!');

					redirect("department");
				}
			}

		}

	}

	?>