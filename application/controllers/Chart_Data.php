<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart_Data extends CI_Controller {

	private $allowed_permissions;

	function __construct()
	{
		parent::__construct();

		// Check is loggied in to system
		if ($this->session->is_loggedin == false) {
			redirect('login');
		}

		$this->load->model('AppealFormModel');
		$this->load->model('ChangesToModuleRegistrationModel');
		$this->load->model('LeaveFormModel');
		$this->load->model('RequestForAlternativeModuleModel');
		$this->load->model('CurriculamModel');

	}

	public function index()
	{
		$this->layout->view('');
	}

	// get yearly data analysis
	public function GetYearlyDataAnalysisChartData()
	{
		$months = array(
			'Jan' => array('start_date' => date('Y-01-01 00:00:00'), 'end_date' => date('Y-01-t 23:59:59') ), 
			'Feb' => array('start_date' => date('Y-02-01 00:00:00'), 'end_date' => date('Y-02-t 23:59:59') ), 
			'Mar' => array('start_date' => date('Y-03-01 00:00:00'), 'end_date' => date('Y-03-t 23:59:59') ), 
			'Apr' => array('start_date' => date('Y-04-01 00:00:00'), 'end_date' => date('Y-04-t 23:59:59') ), 
			'May' => array('start_date' => date('Y-05-01 00:00:00'), 'end_date' => date('Y-05-t 23:59:59') ), 
			'Jun' => array('start_date' => date('Y-06-01 00:00:00'), 'end_date' => date('Y-06-t 23:59:59') ), 
			'Jul' => array('start_date' => date('Y-07-01 00:00:00'), 'end_date' => date('Y-07-t 23:59:59') ), 
			'Aug' => array('start_date' => date('Y-08-01 00:00:00'), 'end_date' => date('Y-08-t 23:59:59') ), 
			'Sep' => array('start_date' => date('Y-09-01 00:00:00'), 'end_date' => date('Y-09-t 23:59:59') ), 
			'Oct' => array('start_date' => date('Y-10-01 00:00:00'), 'end_date' => date('Y-10-t 23:59:59') ), 
			'Nov' => array('start_date' => date('Y-11-01 00:00:00'), 'end_date' => date('Y-11-t 23:59:59') ), 
			'Dec' => array('start_date' => date('Y-12-01 00:00:00'), 'end_date' => date('Y-12-t 23:59:59') )
		);

		$months_string_list = array();
		$appeal_count_list = array();
		$module_changes_count_list = array();
		$leave_count_list = array();
		$alternative_modules_count_list = array();

		foreach ($months as $key => $value) {
			// set month name list
			array_push($months_string_list, $key);

			$start_date = $value['start_date'];
			$end_date = $value['end_date'];

			// get appeal count
			$appeal_count = count($this->AppealFormModel->GetThisMonthAppeals($start_date,$end_date));
			array_push($appeal_count_list, $appeal_count);

			// get module changes count
			$module_changes_count = count($this->ChangesToModuleRegistrationModel->GetThisMonthChangestomodreg($start_date,$end_date));
			array_push($module_changes_count_list, $module_changes_count);

			// get leave count
			$leave_count = count($this->LeaveFormModel->GetThisMonthLeave($start_date,$end_date));
			array_push($leave_count_list, $leave_count);

			// get alternative module
			$alternative_module_count = count($this->RequestForAlternativeModuleModel->GetThisMonthRequesttoaltmod($start_date,$end_date));
			array_push($alternative_modules_count_list, $alternative_module_count);
		}

		$chart_data = array(
			array('name' => 'Appeal', 'data' => $appeal_count_list),
			array('name' => 'Module Changes', 'data' => $module_changes_count_list),
			array('name' => 'Leave', 'data' => $leave_count_list),
			array('name' => 'Alternative Module', 'data' => $alternative_modules_count_list)
		);

		echo json_encode(array(
			'months' => $months_string_list,
			'chart_data' => $chart_data
		));
	}

	// Upcomming meeting
	public function UpCommingMeeting()
	{
		$upcomming_meeting = $this->MeetingModel->UpcomminMeeting();

		$appeal_count = 0;
		$module_changes_count = 0;
		$leave_count = 0;
		$alternative_module_count = 0;
		$curriculum_count = 0;

		if ($upcomming_meeting) {
			$appeal_count = count($this->AppealFormModel->GetByMeetingId($upcomming_meeting->id));
			$module_changes_count = count($this->ChangesToModuleRegistrationModel->GetByMeetingId($upcomming_meeting->id));
			$leave_count = count($this->LeaveFormModel->GetByMeetingId($upcomming_meeting->id));
			$alternative_module_count = count($this->RequestForAlternativeModuleModel->GetByMeetingId($upcomming_meeting->id));
			$curriculum_count = count($this->CurriculamModel->GetByMeetingId($upcomming_meeting->id));
		}

		$chart_data = array(
			array('name' => 'Appeal', 'y' => $appeal_count),
			array('name' => 'Module Changes', 'y' => $module_changes_count),
			array('name' => 'Leave', 'y' => $leave_count),
			array('name' => 'Alternative Module', 'y' => $alternative_module_count),
			array('name' => 'Curriculum Revision', 'y' => $curriculum_count),
		);

		echo json_encode(array('upcomming_meeting' => $upcomming_meeting, 'chart_data' => $chart_data));
	}
}
