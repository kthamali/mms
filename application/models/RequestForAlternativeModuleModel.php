<?php 

class RequestForAlternativeModuleModel extends CI_Model
{

	// Define Table Name
	private $tableName = "requestforalternativemodule";

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
		$this->db->select('requestforalternativemodule.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name, dis_c.courseCode as dis_course_code, dis_c.courseName as dis_course_name, eq_c.courseCode as eq_course_code, eq_c.courseName as eq_course_name');
		$this->db->from($this->tableName);
		$this->db->join('uomuser', 'requestforalternativemodule.uomUser_id = uomuser.id');
		$this->db->join('meeting', 'requestforalternativemodule.meeting_id = meeting.id', 'left');
		$this->db->join('course dis_c', 'requestforalternativemodule.discontinueCourse = dis_c.id', 'left');
		$this->db->join('course eq_c', 'requestforalternativemodule.equivalentCourse = eq_c.id', 'left');
		$this->db->where("requestforalternativemodule.id", $id);

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
		//SELECT requestforalternativemodule.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name FROM `requestforalternativemodule`
		// JOIN uomuser on requestforalternativemodule.uomUser_id = uomuser.id
		// LEFT JOIN meeting on requestforalternativemodule.meeting_id = meeting.id

		$this->db->select('requestforalternativemodule.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name, dis_c.courseCode as dis_course_code, dis_c.courseName as dis_course_name, eq_c.courseCode as eq_course_code, eq_c.courseName as eq_course_name');
		$this->db->from($this->tableName);
		$this->db->join('uomuser', 'requestforalternativemodule.uomUser_id = uomuser.id');
		$this->db->join('meeting', 'requestforalternativemodule.meeting_id = meeting.id', 'left');
		$this->db->join('course dis_c', 'requestforalternativemodule.discontinueCourse = dis_c.id', 'left');
		$this->db->join('course eq_c', 'requestforalternativemodule.equivalentCourse = eq_c.id', 'left');
		$this->db->order_by("FIELD (requestforalternativemodule.status, 'pending', 'chairman_rejected', 'semester_coordinator_recommended', 'hod_recommended', 'fac_rep_recommended', 'chairman_forwarded_to_FAC','fac_approved')");

		if ($user_id != null) {
			$this->db->where('requestforalternativemodule.uomUser_id', $user_id);
		}

		$query = $this->db->get();

		return $query->result();
	}

	// Get all data with details by status list
	function GetAllByStatusList($status_list)
	{
		$this->db->select('requestforalternativemodule.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name, dis_c.courseCode as dis_course_code, dis_c.courseName as dis_course_name, eq_c.courseCode as eq_course_code, eq_c.courseName as eq_course_name');
		$this->db->from($this->tableName);
		$this->db->join('uomuser', 'requestforalternativemodule.uomUser_id = uomuser.id');
		$this->db->join('meeting', 'requestforalternativemodule.meeting_id = meeting.id', 'left');
		$this->db->join('course dis_c', 'requestforalternativemodule.discontinueCourse = dis_c.id', 'left');
		$this->db->join('course eq_c', 'requestforalternativemodule.equivalentCourse = eq_c.id', 'left');
		$this->db->where_in('requestforalternativemodule.status', $status_list);

		$query = $this->db->get();

		return $query->result();
	}

	function GetByIdAllRecords($id)
	{
		/* select * from tableName where id = para */
		$this->db->select('requestforalternativemodule.*, approvalprocess.comment, approvalprocess.status');
		$this->db->from($this->tableName);
		$this->db->join('approvalprocess', 'approvalprocess.requestForAlternativeModule_id = requestforalternativemodule.id');
		$this->db->where("requestforalternativemodule.id", $id);

		$query = $this->db->get();

		return $query->result();
	}

	function GetAllRequesttoaltmodWithDetails($user_id)
	{
		//SELECT requestforalternativemodule.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name FROM `requestforalternativemodule`
		// JOIN uomuser on requestforalternativemodule.uomUser_id = uomuser.id
		// LEFT JOIN meeting on requestforalternativemodule.meeting_id = meeting.id

		$this->db->select('requestforalternativemodule.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name, dis_c.courseCode as dis_course_code, dis_c.courseName as dis_course_name, eq_c.courseCode as eq_course_code, eq_c.courseName as eq_course_name');
		$this->db->from($this->tableName);
		$this->db->join('uomuser', 'requestforalternativemodule.uomUser_id = uomuser.id');
		$this->db->join('meeting', 'requestforalternativemodule.meeting_id = meeting.id', 'left');
		$this->db->join('course dis_c', 'requestforalternativemodule.discontinueCourse = dis_c.id', 'left');
		$this->db->join('course eq_c', 'requestforalternativemodule.equivalentCourse = eq_c.id', 'left');
		$this->db->where('requestforalternativemodule.uomUser_id', $user_id);

		$query = $this->db->get();

		return $query->result();
	}

	function GetThisMonthRequesttoaltmod($start_date, $end_date)
	{
		//SELECT requestforalternativemodule.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name FROM `requestforalternativemodule`
		// JOIN uomuser on requestforalternativemodule.uomUser_id = uomuser.id
		// LEFT JOIN meeting on requestforalternativemodule.meeting_id = meeting.id

		$this->db->select('requestforalternativemodule.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name, dis_c.courseCode as dis_course_code, dis_c.courseName as dis_course_name, eq_c.courseCode as eq_course_code, eq_c.courseName as eq_course_name');
		$this->db->from($this->tableName);
		$this->db->join('uomuser', 'requestforalternativemodule.uomUser_id = uomuser.id');
		$this->db->join('meeting', 'requestforalternativemodule.meeting_id = meeting.id', 'left');
		$this->db->join('course dis_c', 'requestforalternativemodule.discontinueCourse = dis_c.id', 'left');
		$this->db->join('course eq_c', 'requestforalternativemodule.equivalentCourse = eq_c.id', 'left');
		$this->db->where('requestforalternativemodule.created_date >=', $start_date);
		$this->db->where('requestforalternativemodule.created_date <=', $end_date);

		$query = $this->db->get();

		return $query->result();
	}

	function GetByMeetingId($meeting_id)
	{
		//SELECT requestforalternativemodule.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name FROM `requestforalternativemodule`
		// JOIN uomuser on requestforalternativemodule.uomUser_id = uomuser.id
		// LEFT JOIN meeting on requestforalternativemodule.meeting_id = meeting.id

		$this->db->select('requestforalternativemodule.*, uomuser.nameWithInitials, uomuser.registrationNo, meeting.meetingCode, meeting.name, dis_c.courseCode as dis_course_code, dis_c.courseName as dis_course_name, eq_c.courseCode as eq_course_code, eq_c.courseName as eq_course_name');
		$this->db->from($this->tableName);
		$this->db->join('uomuser', 'requestforalternativemodule.uomUser_id = uomuser.id');
		$this->db->join('meeting', 'requestforalternativemodule.meeting_id = meeting.id', 'left');
		$this->db->join('course dis_c', 'requestforalternativemodule.discontinueCourse = dis_c.id', 'left');
		$this->db->join('course eq_c', 'requestforalternativemodule.equivalentCourse = eq_c.id', 'left');
		$this->db->where('requestforalternativemodule.meeting_id', $meeting_id);

		$query = $this->db->get();

		return $query->result();
	}
}

?>