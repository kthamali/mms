<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uom_User extends CI_Controller {

	private $allowed_permissions;

	function __construct()
	{
		parent::__construct();

		// Check is loggied in to system
		if ($this->session->is_loggedin == false) {
			redirect('login');
		}

		$this->load->model("UomUserModel");
		$this->load->model("UserTypeUomUserModel");
		$this->load->model("UserTypeModel");
		$this->load->model("AcademicYearModel");
		$this->load->model("DegreeModel");
		$this->load->model("DepartmentModel");
		$this->load->model("FacultyModel");
		$this->load->model("LevelModel");
		$this->load->model("SpecializationModel");
	}

	public function index()
	{

		// Check permissions for user view page
		if(!$this->permission->has_permission("user_viewall")){
			echo "No permissions";
			return;
		}

		// Get all uomuser from db
		$uomuser = $this->UomUserModel->GetAll();

		// Define data array
		$data = array(
			"uomuser_list" => $uomuser
		);

		// Load uomuser view
		$this->layout->view('user/user',$data);
	}

	function view()
	{
		// Get uomuser id from url
		$uomuser_id = $this->uri->segment(3);

		$uomuser = $this->UomUserModel->GetById($uomuser_id);


		$data = array(
			"uomuserData" => $uomuser
		);

		// Load view
		$this->layout->view("user/view_user", $data);
	}

	function create()
	{

		$has_permision = $this->permission->has_permission("user_create");

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
				$this->form_validation->set_rules("userName", "Username", "trim|required|max_length[50]|is_unique[uomuser.userName]");
				$this->form_validation->set_rules("title", "Title", "trim|required|max_length[100]");
				$this->form_validation->set_rules("firstName", "First Name", "trim|max_length[200]");
				$this->form_validation->set_rules("lastName", "Last Name", "trim|max_length[200]");
				$this->form_validation->set_rules("nameWithInitials", "Name With Initials", "trim|required|max_length[250]");
				$this->form_validation->set_rules("dob", "Date of Birth", "trim|required");
				$this->form_validation->set_rules("nic", "NIC", "trim|required|max_length[10]");
				$this->form_validation->set_rules("primaryEmail", "Primary Email", "trim|required|max_length[250]|valid_email|is_unique[uomuser.primaryEmail]");
				$this->form_validation->set_rules("registrationNo", "Registration Number", "trim|max_length[50]");
				$this->form_validation->set_rules("permanentAddress", "Address", "trim|required");
				$this->form_validation->set_rules("permanentTelephone", "Contact Number", "trim|required|max_length[10]");
				$this->form_validation->set_rules("academicYearId", "Academic Year", "trim|required");
				$this->form_validation->set_rules("degreeId", "Degree", "trim|required");
				$this->form_validation->set_rules("levelId", "Level", "trim|required");
				$this->form_validation->set_rules("specializationId", "Specialization", "trim|required");
				$this->form_validation->set_rules("facultyId", "Faculty", "trim|required");
				$this->form_validation->set_rules("departmentId", "Department", "trim|required");
				$this->form_validation->set_rules("gender", "Gender", "trim|required");

				$valid = $this->form_validation->run();
				
				if ($valid == true) {
				// Save to database

				/// Get post data and assign to data array
					$post_data = array(
						'userName' => $_POST["userName"],
						'title' => $_POST["title"],
						'firstName' => $_POST["firstName"],
						'lastName' => $_POST["lastName"],
						'nameWithInitials' => $_POST["nameWithInitials"],
						'dob' => $_POST["dob"],
						'nic' => $_POST["nic"],
						'primaryEmail' => $_POST["primaryEmail"],
						'registrationNo' => $_POST["registrationNo"],
						'permanentAddress' => $_POST["permanentAddress"],
						'permanentTelephone' => $_POST["permanentTelephone"],
						'academicYear_id' => $_POST["academicYearId"],
						'degree_id' => $_POST["degreeId"],
						'level_id' => $_POST["levelId"],
						'specialization_id' => $_POST["specializationId"],
						'faculty_id' => $_POST["facultyId"],
						'department_id' => $_POST["departmentId"],
						'gender' => $_POST["gender"]
					);
					//if() - check
				// Save uomuser in db
					$new_uomuser_id = $this->UomUserModel->Insert($post_data);

				// set flash message
					$this->session->set_flashdata('success', "User Created Successfully! New User ID: ". $new_uomuser_id);

				// redirect to all uomuser page
					redirect('uom_user');

				}
			}

			// Get all academic year
			$allAcademicYear = $this->AcademicYearModel->GetAll();
			$academicyear_dropdown = array();
			$academicyear_dropdown[''] = '-- Select Academic Year --';
			foreach ($allAcademicYear as $key => $AcademicYear) {
				$academicyear_dropdown[$AcademicYear->id] = $AcademicYear->academicYearDescription;
			}

			// Get all degree
			$allDegree = $this->DegreeModel->GetAll();
			$degree_dropdown = array();
			$degree_dropdown[''] = '-- Select Degree --';
			foreach ($allDegree as $key => $Degree) {
				$degree_dropdown[$Degree->id] = $Degree->degreeDescription;
			}

			//Get all level
			$allLevel = $this->LevelModel->GetAll();
			$level_dropdown = array();
			$level_dropdown[''] = '-- Select Level --';
			foreach ($allLevel as $key => $Level) {
				$level_dropdown[$Level->id] = $Level->levelDescription;
			}

			//Get all specialization
			$allSpecialization = $this->SpecializationModel->GetAll();
			$specialization_dropdown = array();
			$specialization_dropdown[''] = '-- Select Specialization --';
			foreach ($allSpecialization as $key => $Specialization) {
				$specialization_dropdown[$Specialization->id] = $Specialization->specializationDescription;
			}

			//Get all faculty
			$allFaculty = $this->FacultyModel->GetAll();
			$faculty_dropdown = array();
			$faculty_dropdown[''] = '-- Select Faculty --';
			foreach ($allFaculty as $key => $Faculty) {
				$faculty_dropdown[$Faculty->id] = $Faculty->facultyName;
			}

			//Get all departments
			$allDepartments = $this->DepartmentModel->GetAll();
			$department_dropdown = array();
			$department_dropdown[''] = '-- Select Department --';
			foreach ($allDepartments as $key => $Department) {
				$department_dropdown[$Department->id] = $Department->departmentName;
			}

			$data = array(
				'allAcademicYear'=>$allAcademicYear,
				'academicyear_dropdown' => $academicyear_dropdown,
				'allDegree'=>$allDegree,
				'degree_dropdown' => $degree_dropdown,
				'allLevel'=>$allLevel,
				'level_dropdown' => $level_dropdown,
				'allSpecialization'=>$allSpecialization,
				'specialization_dropdown' => $specialization_dropdown,
				'allFaculty'=>$allFaculty,
				'faculty_dropdown' => $faculty_dropdown,
				'allDepartments'=>$allDepartments,
				'department_dropdown' => $department_dropdown
			);

		/// Load all uomuser page
			$this->layout->view("user/create_user",$data);
		}

//update
		function update()
		{
			if(!$this->permission->has_permission("user_update")){
				echo "No permissions";
				return;
			}

		// Get user id from url
			$uomuser_id = $this->uri->segment(3);

		/// get user data from db
			$selected_uomuser = $this->UomUserModel->GetById($uomuser_id);

			if($_POST){

				// Set validaiton rules
				$this->form_validation->set_rules("userName", "Username", "trim|required|max_length[50]");
				$this->form_validation->set_rules("title", "Title", "trim|required|max_length[100]");
				$this->form_validation->set_rules("firstName", "First Name", "trim|max_length[200]");
				$this->form_validation->set_rules("lastName", "Last Name", "trim|max_length[200]");
				$this->form_validation->set_rules("nameWithInitials", "Name With Initials", "trim|required|max_length[250]");
				$this->form_validation->set_rules("dob", "Date of Birth", "trim|required");
				$this->form_validation->set_rules("nic", "NIC", "trim|required|max_length[15]");
				$this->form_validation->set_rules("primaryEmail", "Primary Email", "trim|required|max_length[250]|valid_email");
				$this->form_validation->set_rules("registrationNo", "Registration Number", "trim|max_length[50]");
				$this->form_validation->set_rules("permanentAddress", "Address", "trim|required");
				$this->form_validation->set_rules("permanentTelephone", "Contact Number", "trim|required|max_length[10]");
				$this->form_validation->set_rules("academicYearId", "Academic Year", "trim|required");
				$this->form_validation->set_rules("degreeId", "Degree", "trim|required");
				$this->form_validation->set_rules("levelId", "Level", "trim|required");
				$this->form_validation->set_rules("specializationId", "Specialization", "trim|required");
				$this->form_validation->set_rules("facultyId", "Faculty", "trim|required");
				$this->form_validation->set_rules("departmentId", "Department", "trim|required");

				$isValid = $this->form_validation->run();

				if($isValid){ /// form valid
					$post_data = array(
						'userName' => $_POST["userName"],
						'title' => $_POST["title"],
						'firstName' => $_POST["firstName"],
						'lastName' => $_POST["lastName"],
						'nameWithInitials' => $_POST["nameWithInitials"],
						'dob' => $_POST["dob"],
						'nic' => $_POST["nic"],
						'primaryEmail' => $_POST["primaryEmail"],
						'registrationNo' => $_POST["registrationNo"],
						'permanentAddress' => $_POST["permanentAddress"],
						'permanentTelephone' => $_POST["permanentTelephone"],
						'academicYear_id' => $_POST["academicYearId"],
						'degree_id' => $_POST["degreeId"],
						'level_id' => $_POST["levelId"],
						'specialization_id' => $_POST["specializationId"],
						'faculty_id' => $_POST["facultyId"],
						'department_id' => $_POST["departmentId"]
					);

			// update record
					$isUpdated = $this->UomUserModel->Update($uomuser_id, $post_data);

					if($isUpdated){
						$this->session->set_flashdata('success', 'User Updated successfully!');

						redirect("uom_user");
					}
				}
			}

		// Get all academic year
			$allAcademicYear = $this->AcademicYearModel->GetAll();
			$academicyear_dropdown = array();
			foreach ($allAcademicYear as $key => $AcademicYear) {
				$academicyear_dropdown[$AcademicYear->id] = $AcademicYear->academicYearDescription;
			}

			// Get all degree
			$allDegree = $this->DegreeModel->GetAll();
			$degree_dropdown = array();
			foreach ($allDegree as $key => $Degree) {
				$degree_dropdown[$Degree->id] = $Degree->degreeDescription;
			}

			//Get all level
			$allLevel = $this->LevelModel->GetAll();
			$level_dropdown = array();
			foreach ($allLevel as $key => $Level) {
				$level_dropdown[$Level->id] = $Level->levelDescription;
			}

			//Get all specialization
			$allSpecialization = $this->SpecializationModel->GetAll();
			$specialization_dropdown = array();
			foreach ($allSpecialization as $key => $Specialization) {
				$specialization_dropdown[$Specialization->id] = $Specialization->specializationDescription;
			}

			//Get all faculty
			$allFaculty = $this->FacultyModel->GetAll();
			$faculty_dropdown = array();
			foreach ($allFaculty as $key => $Faculty) {
				$faculty_dropdown[$Faculty->id] = $Faculty->facultyName;
			}

			//Get all departments
			$allDepartments = $this->DepartmentModel->GetAll();
			$department_dropdown = array();
			foreach ($allDepartments as $key => $Department) {
				$department_dropdown[$Department->id] = $Department->departmentName;
			}

			$data = array(
				'uomuser_id' =>  $uomuser_id,
				'uomuser_details' => $selected_uomuser,
				'allAcademicYear'=>$allAcademicYear,
				'academicyear_dropdown' => $academicyear_dropdown,
				'allDegree'=>$allDegree,
				'degree_dropdown' => $degree_dropdown,
				'allLevel'=>$allLevel,
				'level_dropdown' => $level_dropdown,
				'allSpecialization'=>$allSpecialization,
				'specialization_dropdown' => $specialization_dropdown,
				'allFaculty'=>$allFaculty,
				'faculty_dropdown' => $faculty_dropdown,
				'allDepartments'=>$allDepartments,
				'department_dropdown' => $department_dropdown
			);

			$this->layout->view("user/update_user", $data);
		}

		function delete()
		{
			// Check permissions for uomuser view page
			if(!$this->permission->has_permission("user_delete")){
				echo "No permissions";
				return;
			}

		// Get uomuser id from url
			$uomuser_id = $this->uri->segment(3);

			if($uomuser_id){
				$isDeleted = $this->UomUserModel->Delete($uomuser_id);
				if($isDeleted){

				// set flash data
					$this->session->set_flashdata('success', 'Uom User Deleted successfully!');

					redirect("uom_user");
				}
			}

		}

		function set_usertype()
		{

			$uomuser_id =  $this->uri->segment(3);

			if ($_POST) {
				$selected_usertypes = $_POST["usertypes"];

				$this->UserTypeUomUserModel->DeleteByUomUser($uomuser_id);

				foreach ($selected_usertypes as $key => $usertype_id) {

					$data_set = array(
						'uomuser_id' => $uomuser_id,
						'usertype_id' => $usertype_id, 
						'created_user_id' => $this->session->user_id
					);

					$this->UserTypeUomUserModel->Insert($data_set);
				}
				$this->session->set_flashdata('success', "User Type Added Successfully!");
				redirect('uom_user');

			}

		// load all user type
			$usertype_list = $this->UserTypeModel->GetAll();


		// Load all existing usertypes
			$selected_usertypes = $this->UserTypeUomUserModel->GetUserTypeIdByUomUserId($uomuser_id);

			$usertype_id_array = array();
			foreach ($selected_usertypes as $key => $usertype) {
				array_push($usertype_id_array, $usertype->userType_id);
			}

			$data = array(
				'usertype_list' => $usertype_list,
				'usertype_id_array' => $usertype_id_array
			);

			$this->layout->view("user/set_usertype", $data);


		}

	}

	?>