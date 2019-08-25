<?php 

class ChangesToModuleRegistrationModel extends CI_Model
{

	// Define Table Name
	private $tableName = "changestomoduleregistration";

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
		$this->db->select('changestomoduleregistration.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name, course.courseCode, course.courseName');
		$this->db->from($this->tableName);
		$this->db->join('uomuser', 'changestomoduleregistration.uomUser_id = uomuser.id');
		$this->db->join('meeting', 'changestomoduleregistration.meeting_id = meeting.id', 'left');
		$this->db->join('course', 'changestomoduleregistration.course = course.id', 'left');
		$this->db->where("changestomoduleregistration.id", $id);

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

	// Get all data with details
	function GetAllWithDetails($user_id = null)
	{
		//SELECT changestomoduleregistration.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name FROM `changestomoduleregistration`
		// JOIN uomuser on changestomoduleregistration.uomUser_id = uomuser.id
		// LEFT JOIN meeting on changestomoduleregistration.meeting_id = meeting.id

		$this->db->select('changestomoduleregistration.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name, course.courseCode, course.courseName');
		$this->db->from($this->tableName);
		$this->db->join('uomuser', 'changestomoduleregistration.uomUser_id = uomuser.id');
		$this->db->join('meeting', 'changestomoduleregistration.meeting_id = meeting.id', 'left');
		$this->db->join('course', 'changestomoduleregistration.course = course.id', 'left');
		$this->db->order_by("FIELD (changestomoduleregistration.status, 'pending', 'chairman_rejected', 'semester_coordinator_recommended', 'hod_recommended', 'fac_rep_recommended', 'chairman_forwarded_to_FAC','fac_approved')");

		if ($user_id != null) {
			$this->db->where('changestomoduleregistration.uomUser_id', $user_id);
		}

		$query = $this->db->get();

		return $query->result();
	}

	// Get all data with details by status list
	function GetAllByStatusList($status_list)
	{
		$this->db->select('changestomoduleregistration.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name, course.courseCode, course.courseName');
		$this->db->from($this->tableName);
		$this->db->join('uomuser', 'changestomoduleregistration.uomUser_id = uomuser.id');
		$this->db->join('meeting', 'changestomoduleregistration.meeting_id = meeting.id', 'left');
		$this->db->join('course', 'changestomoduleregistration.course = course.id', 'left');
		$this->db->where_in('changestomoduleregistration.status', $status_list);

		$query = $this->db->get();

		return $query->result();
	}

	function GetByIdAllRecords($id)
	{
		/* select * from tableName where id = para */
		$this->db->select('changestomoduleregistration.*, approvalprocess.comment, approvalprocess.status');
		$this->db->from($this->tableName);
		$this->db->join('approvalprocess', 'approvalprocess.changesToModuleRegistration_id = changestomoduleregistration.id');
		$this->db->where("changestomoduleregistration.id", $id);

		$query = $this->db->get();

		return $query->result();
	}

	function GetAllChangestomodregWithDetails($user_id)
	{
		//SELECT changestomoduleregistration.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name FROM `changestomoduleregistration`
		// JOIN uomuser on changestomoduleregistration.uomUser_id = uomuser.id
		// LEFT JOIN meeting on changestomoduleregistration.meeting_id = meeting.id

		$this->db->select('changestomoduleregistration.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name, course.courseCode, course.courseName');
		$this->db->from($this->tableName);
		$this->db->join('uomuser', 'changestomoduleregistration.uomUser_id = uomuser.id');
		$this->db->join('meeting', 'changestomoduleregistration.meeting_id = meeting.id', 'left');
		$this->db->join('course', 'changestomoduleregistration.course = course.id', 'left');
		$this->db->where('changestomoduleregistration.uomUser_id', $user_id);

		$query = $this->db->get();

		return $query->result();
	}

	function GetThisMonthChangestomodreg($start_date, $end_date)
	{
		//SELECT changestomoduleregistration.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name FROM `changestomoduleregistration`
		// JOIN uomuser on changestomoduleregistration.uomUser_id = uomuser.id
		// LEFT JOIN meeting on changestomoduleregistration.meeting_id = meeting.id

		$this->db->select('changestomoduleregistration.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name, course.courseCode, course.courseName');
		$this->db->from($this->tableName);
		$this->db->join('uomuser', 'changestomoduleregistration.uomUser_id = uomuser.id');
		$this->db->join('meeting', 'changestomoduleregistration.meeting_id = meeting.id', 'left');
		$this->db->join('course', 'changestomoduleregistration.course = course.id', 'left');
		$this->db->where('changestomoduleregistration.created_date >=', $start_date);
		$this->db->where('changestomoduleregistration.created_date <=', $end_date);

		$query = $this->db->get();

		return $query->result();
	}

	function GetByMeetingId($meeting_id)
	{
		//SELECT changestomoduleregistration.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name FROM `changestomoduleregistration`
		// JOIN uomuser on changestomoduleregistration.uomUser_id = uomuser.id
		// LEFT JOIN meeting on changestomoduleregistration.meeting_id = meeting.id

		$this->db->select('changestomoduleregistration.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name, course.courseCode, course.courseName');
		$this->db->from($this->tableName);
		$this->db->join('uomuser', 'changestomoduleregistration.uomUser_id = uomuser.id');
		$this->db->join('meeting', 'changestomoduleregistration.meeting_id = meeting.id', 'left');
		$this->db->join('course', 'changestomoduleregistration.course = course.id', 'left');
		$this->db->where('changestomoduleregistration.meeting_id', $meeting_id);
		
		$query = $this->db->get();

		return $query->result();
	}
}

?>