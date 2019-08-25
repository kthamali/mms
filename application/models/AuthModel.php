<?php 

class AuthModel extends CI_Model
{
	function Login($username, $password)
	{

		$encrypted_password = md5($password);

		$this->db->where('username', $username);
		$this->db->where('userpassword', $encrypted_password);
		$this->db->select('id,firstName, lastName, userName');
		$result = $this->db->get('uomuser');

		if ($result->num_rows() == 1) {
			return $result->row();
		}else{
			return null;
		}
	}
}