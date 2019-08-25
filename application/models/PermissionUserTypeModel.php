<?php 

class PermissionUserTypeModel extends CI_Model
{

	// Define Table Name
	private $tableName = "permission_has_usertype";

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

	// Get permissions by usertype id
	public function GetPermissionIdByUserTypeId($usetype_id)
	{
		/*
		SELECT * FROM permission_has_usertype WHERE usetype_id = $usetype_id;
		*/

		$this->db->where("usertype_id", $usetype_id);
		$query = $this->db->get($this->tableName);
		return $query->result();

	}


	function DeleteByUserType($usetype_id)
	{
		/* delete from 'table' where id = $id */
		try {
			$this->db->where('usertype_id', $usetype_id);
			$this->db->delete($this->tableName);
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
}

?>