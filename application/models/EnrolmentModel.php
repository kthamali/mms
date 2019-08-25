<?php 

class EnrolmentModel extends CI_Model
{

	// Define Table Name
	private $tableName = "enrolment";

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
		$this->db->where("id", $id);
		$query = $this->db->get($this->tableName);

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

	function Enrolments($id)
	{
		//SELECT enrolment.offering_id, offering.course_id, course.courseCode, course.courseName FROM `enrolment`
		//JOIN offering on enrolment.offering_id = offering.id
		//LEFT JOIN course on offering.course_id = course.id

		$this->db->select('enrolment.offering_id, offering.course_id, course.courseCode, course.courseName');
		$this->db->from($this->tableName);
		$this->db->join('offering', 'enrolment.offering_id = offering.id');
		$this->db->join('course', 'offering.course_id = course.id', 'left');
		$this->db->where("enrolment.uomUser_id", $id);

		$query = $this->db->get();

		return $query->result();
	}

}

?>