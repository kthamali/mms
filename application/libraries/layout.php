<?php 

	class Layout
	{

		private $CI;

		private $meeting_count = 0;
		
		function __construct()
		{
			$this->CI =& get_instance();
			$this->CI->load->library('permission');
			$this->CI->load->model('MeetingModel');

			// If has permission for view all meetings, get available meeting count
			if ($this->CI->permission->has_permission("meetings_viewall")) {
				$this->get_meeting_count();
			}
		}

		function view($view, $data = array())
		{
			$sub_view_html = $this->CI->load->view($view, $data, true);

			$master_data = array(
				'sub_view' => $sub_view_html,
				'meeting_count' => $this->meeting_count
			);

			$this->CI->load->view("layout/layout", $master_data);
		}

		public function get_meeting_count()
		{
			$meetings = $this->CI->MeetingModel->GetPendingMeetings();
			$this->meeting_count = count($meetings);
		}

		function report_view($view, $data = array(), $is_html = false)
		{
			$sub_view_html = $this->CI->load->view($view, $data, true);

			$master_data = array(
				'report_view' => $sub_view_html
			);

			return $this->CI->load->view("layout/report_layout", $master_data, $is_html);
		}
	}

 ?>