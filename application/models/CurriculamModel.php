<?php 

class CurriculamModel extends CI_Model
{

	// Define Table Name
	private $tableName = "curriculam";

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
		$this->db->select('curriculam.*, department.departmentName, meeting.meetingCode, meeting.name');
		$this->db->from($this->tableName);
		$this->db->join('department', 'curriculam.department_id = department.id');
		$this->db->join('meeting', 'curriculam.meeting_id = meeting.id', 'left');
		$this->db->where("curriculam.id", $id);

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

	function GetAllWithDetails($user_id = null)
	{
		// SELECT curriculam.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name FROM `curriculam`
		// JOIN uomuser on curriculam.uomUser_id = uomuser.id
		// LEFT JOIN meeting on curriculam.meeting_id = meeting.id

		$this->db->select('curriculam.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name');
		$this->db->from($this->tableName);
		$this->db->join('uomuser', 'curriculam.uomUser_id = uomuser.id');
		$this->db->join('meeting', 'curriculam.meeting_id = meeting.id', 'left');
		$this->db->order_by("FIELD (curriculam.status, 'pending', 'chairman_rejected', 'chairman_forwarded_to_FAC','fac_approved')");

		if ($user_id != null) {
			$this->db->where('curriculam.uomUser_id', $user_id);
		}

		$query = $this->db->get();

		return $query->result();
	}

	// Get all data with details by status list
	function GetAllByStatusList($status_list)
	{
		$this->db->select('curriculam.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name');
		$this->db->from($this->tableName);
		$this->db->join('uomuser', 'curriculam.uomUser_id = uomuser.id');
		$this->db->join('meeting', 'curriculam.meeting_id = meeting.id', 'left');
		$this->db->where_in('curriculam.status', $status_list);

		$query = $this->db->get();

		return $query->result();
	}

	function GetByIdAllRecords($id)
	{
		/* select * from tableName where id = para */
		$this->db->select('curriculam.*, approvalprocess.comment, approvalprocess.status');
		$this->db->from($this->tableName);
		$this->db->join('approvalprocess', 'approvalprocess.curriculam_id = curriculam.id');
		$this->db->where("curriculam.id", $id);

		$query = $this->db->get();

		return $query->result();
	}

	function GetByMeetingId($meeting_id)
	{
		/* select * from tableName where id = para */
		$this->db->select('curriculam.*, approvalprocess.comment, approvalprocess.status');
		$this->db->from($this->tableName);
		$this->db->join('approvalprocess', 'approvalprocess.curriculam_id = curriculam.id');
		$this->db->where('curriculam.meeting_id', $meeting_id);

		$query = $this->db->get();

		return $query->result();
	}
}

?>