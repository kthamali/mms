<?php 

class MeetingModel extends CI_Model
{

	// Define Table Name
	private $tableName = "meeting";

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

	// Get all pending meetings
	function GetPendingMeetings()
	{
		try {
			$this->db->where('status', 'pending');
			$query = $this->db->get($this->tableName);
			return $query->result();
		} catch (Exception $e) {
			return false;
		}
	}

	// get upcoming meetings
	function Upcoming_meetings()
	{
		$this->db->where('meetingDate > ', date('Y-m-d 00:00:00'));
		$query = $this->db->get($this->tableName);
		return $query->result();
	}

	// Get By Meeting Id
	function AppealGetByMeetingId($id)
	{
		/* select * from tableName where id = para */
		$this->db->select('meeting.*, appealform.*, uomuser.nameWithInitials, uomuser.registrationNo, uomuser.department_id, department.departmentCode');
		$this->db->from($this->tableName);
		$this->db->join('appealform', 'appealform.meeting_id = meeting.id');
		$this->db->join('uomuser', 'appealform.uomUser_id = uomuser.id', 'left');
		$this->db->join('department', 'uomuser.department_id = department.id', 'left');
		$this->db->where("meeting.id", $id);

		$query = $this->db->get();

		return $query->result();
	}

	function ChangesToModRegGetByMeetingId($id)
	{
		/* select * from tableName where id = para */
		$this->db->select('meeting.*, changestomoduleregistration.*, uomuser.nameWithInitials, uomuser.registrationNo, uomuser.department_id, department.departmentCode, course.courseCode, course.courseName');
		$this->db->from($this->tableName);
		$this->db->join('changestomoduleregistration', 'changestomoduleregistration.meeting_id = meeting.id');
		$this->db->join('uomuser', 'changestomoduleregistration.uomUser_id = uomuser.id', 'left');
		$this->db->join('department', 'uomuser.department_id = department.id', 'left');
		$this->db->join('course', 'changestomoduleregistration.course = course.id', 'left');
		$this->db->where("meeting.id", $id);

		$query = $this->db->get();

		return $query->result();
	}

	function LeaveGetByMeetingId($id)
	{
		/* select * from tableName where id = para */
		$this->db->select('meeting.*, leaveform.*, uomuser.nameWithInitials, uomuser.registrationNo, uomuser.department_id, department.departmentCode, leavetype.leaveTypeName');
		$this->db->from($this->tableName);
		$this->db->join('leaveform', 'leaveform.meeting_id = meeting.id');
		$this->db->join('uomuser', 'leaveform.uomUser_id = uomuser.id', 'left');
		$this->db->join('department', 'uomuser.department_id = department.id', 'left');
		$this->db->join('leavetype', 'leaveform.leaveType_id = leavetype.id', 'left');
		$this->db->where("meeting.id", $id);

		$query = $this->db->get();

		return $query->result();
	}

	function RequestForAltModGetByMeetingId($id)
	{
		/* select * from tableName where id = para */
		$this->db->select('meeting.*, requestforalternativemodule.*, uomuser.nameWithInitials, uomuser.registrationNo, uomuser.department_id, department.departmentCode, dis_c.courseCode as dis_course_code, dis_c.courseName as dis_course_name, eq_c.courseCode as eq_course_code, eq_c.courseName as eq_course_name');
		$this->db->from($this->tableName);
		$this->db->join('requestforalternativemodule', 'requestforalternativemodule.meeting_id = meeting.id');
		$this->db->join('uomuser', 'requestforalternativemodule.uomUser_id = uomuser.id', 'left');
		$this->db->join('department', 'uomuser.department_id = department.id', 'left');
		$this->db->join('course dis_c', 'requestforalternativemodule.discontinueCourse = dis_c.id', 'left');
		$this->db->join('course eq_c', 'requestforalternativemodule.equivalentCourse = eq_c.id', 'left');
		$this->db->where("meeting.id", $id);

		$query = $this->db->get();

		return $query->result();
	}

	function CurriculamGetByMeetingId($id)
	{
		/* select * from tableName where id = para */
		$this->db->select('meeting.*, curriculam.*, department.departmentCode');
		$this->db->from($this->tableName);
		$this->db->join('curriculam', 'curriculam.meeting_id = meeting.id');
		$this->db->join('department', 'curriculam.department_id = department.id', 'left');
		$this->db->where("meeting.id", $id);

		$query = $this->db->get();

		return $query->result();
	}

	// get upcomming meeting
	public function UpcomminMeeting()
	{

		/*SELECT meeting.* FROM meeting 
		WHERE meeting.status = 'pending'
		order BY meeting.meetingDate ASC*/

		$this->db->select('meeting.*');
		$this->db->from('meeting');
		$this->db->where('meeting.status', 'pending');
		$this->db->order_by('meeting.meetingDate');

		$q = $this->db->get();

		return $q->row();

	}

	public function GetThisMonthOnwordsMeeting($start_date, $end_date)
	{
		$this->db->select('meeting.*');
		$this->db->from($this->tableName);
		$this->db->where('meeting.meetingDate >=', $start_date);
		$this->db->where('meeting.meetingDate <=', $end_date);

		$query = $this->db->get();

		return $query->result();
	}
}

?>