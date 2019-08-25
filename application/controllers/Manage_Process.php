<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_Process extends CI_Controller {

	public function index()
	{
		$this->layout->view('manage_process/manage_process');
	}

}

?>