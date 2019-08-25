<?php 

class Permission
{

	private $CI;
	private $allowed_permissions;

	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->model("PermissionModel");

		$this->allowed_permissions = $this->CI->PermissionModel->GetPermissionCodesByUserId($this->CI->session->user_id);
	}

	/// Check user has permissions
	function has_permission($permission_code)
	{
		$has_permision = in_array($permission_code, $this->allowed_permissions);
		return $has_permision;
	}
}


?>