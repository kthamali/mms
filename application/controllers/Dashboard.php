<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	private $allowed_permissions;

	function __construct()
	{
		parent::__construct();

		// Check is loggied in to system
		if ($this->session->is_loggedin == false) {
			redirect('login');
		}

		$this->load->model("AppealFormModel");
		$this->load->model("ChangesToModuleRegistrationModel");
		$this->load->model("LeaveFormModel");
		$this->load->model("RequestForAlternativeModuleModel");

	}


	public function index()
	{

		$start_date = date('Y-m-01 00:00:00');
		$end_date = date('Y-m-t 23:59:59');

		// get appeals
		$apeals = $this->AppealFormModel->GetThisMonthAppeals($start_date, $end_date);
		$changestomodreg = $this->ChangesToModuleRegistrationModel->GetThisMonthChangestomodreg($start_date, $end_date);
		$leave = $this->LeaveFormModel->GetThisMonthLeave($start_date, $end_date);
		$alternativemodreg = $this->RequestForAlternativeModuleModel->GetThisMonthRequesttoaltmod($start_date, $end_date);

		$data["appeal_count"] = count($apeals);
		$data["module_changes_count"] = count($changestomodreg);
		$data["leave_count"] = count($leave);
		$data["alternative_module_count"] = count($alternativemodreg);

		$this->layout->view('dashboard/dashboard', $data);
	}
}
