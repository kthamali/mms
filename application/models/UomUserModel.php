<?php 

class UomUserModel extends CI_Model
{

	// Define Table Name
	private $tableName = "uomuser";

	// Get all data
	function GetAll()
	{
		/* select * from tableName */
		$query = $this->db->get($this->tableName);
		return $query->result();
	}

	// Get By Id
	function GetById($id)
	{
		/* select * from tableName where id = para */

		/*SELECT uomuser.*, academicyear.academicYearDescription, degree.degreeDescription, department.departmentName, faculty.facultyName, level.levelDescription, specialization.specializationDescription FROM `uomuser`
		JOIN academicyear on uomuser.academicYear_id = academicyear.id
		LEFT JOIN degree on uomuser.degree_id = degree.id
		LEFT JOIN department on uomuser.department_id = department.id
		LEFT JOIN faculty on uomuser.faculty_id = faculty.id
		LEFT JOIN level on uomuser.level_id = level.id
		LEFT JOIN specialization on uomuser.specialization_id = specialization.id*/

		$this->db->select('uomuser.*, academicyear.academicYearDescription, degree.degreeDescription, department.departmentName, faculty.facultyName, level.levelDescription, specialization.specializationDescription');
		$this->db->from($this->tableName);
		$this->db->join('faculty', 'uomuser.faculty_id = faculty.id');
		$this->db->join('degree', 'uomuser.degree_id = degree.id', 'left');
		$this->db->join('department', 'uomuser.department_id = department.id', 'left');
		$this->db->join('academicyear', 'uomuser.academicYear_id = academicyear.id', 'left');
		$this->db->join('level', 'uomuser.level_id = level.id', 'left');
		$this->db->join('specialization', 'uomuser.specialization_id = specialization.id', 'left');
		$this->db->where("uomuser.id", $id);

		$query = $this->db->get();

		return $query->row();
	}

	// Insert Data
	function Insert($data)
	{
		/* Insert into 'tablename' values (1,2,3,4) */
		$this->db->insert($this->tableName, $data);
		return $this->db->insert_id();
	}

	// Update Data
	function Update($id, $data)
	{
		/*UPDATE table_name SET column1 = value1, column2 = value2, ... WHERE condition;*/
		try {
			$this->db->where("id", $id);
			$this->db->Update($this->tableName, $data);
			return true;
		} catch (Exception $e) {
			return false;
		}
		
	}

	// Delete Data
	function Delete($id)
	{
		/* delete from 'table' where id = $id */
		try {
			$this->db->where('id', $id);
			$this->db->delete($this->tableName);
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	function GetByRegistrationNo($id)
	{
		/* select * from tableName where id = para */
		$this->db->where("registrationNo", $id);
		$query = $this->db->get($this->tableName);

		return $query->row();
	}

	// Get By Id With Details
	function GetByIdWithDetails($id)
	{
		// SELECT uomuser.*, department.departmentName FROM `uomuser` 
		// JOIN department on 

		$this->db->select('uomuser.*, department.departmentName');
		$this->db->from($this->tableName);
		$this->db->join('department', 'uomuser.department_id = department.id');
		$this->db->where("uomuser.id", $id);
		$query = $this->db->get();

		return $query->row();
	}

	function GetByIdUpdateProfile($id)
	{
		/* select * from tableName where id = para */
		$this->db->where("id", $id);
		$query = $this->db->get($this->tableName);

		return $query->row();
	}
}

?>