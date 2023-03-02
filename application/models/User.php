<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

	public $column = array(
		"id",
		"username",
		"password",
        "fullname",
		"role"
	);

	public $searchColumn = array(
		"fullname",
		"username",
		"role"
	);

	private $table = "users";
	private $pk = "id";

	public function __construct()
	{
		parent::__construct();
	}

	private function __complete_query() {
		$this->db->select($this->column);
		$this->db->from("$this->table");
	}

	public function getAllUser() {
		$this->__complete_query();
    // hide username superuser
    $this->db->where('username !=', 'superuser');
		return $this->db->get();
	}

	public function getSingleUser($id) {
		$this->__complete_query();
		$this->db->where($this->pk, $id);
		return $this->db->get();
	}

	public function getFiltered($where = [], $method = "AND") {
		$this->__complete_query();
		if($method == "OR") {
			$this->db->or_where($where);
		} else {
			$this->db->where($where);
		}
		return $this->db->get();
	}

	public function insert($data) {
		try{
			$this->db->insert("$this->table", $data);
			return $this->db->insert_id();
		} catch(Exception $e) {
			die($e->getMessage());
		}
		return FALSE;
	}

	public function update($data, $id) {
		try {
			$this->db->where($this->pk, $id);
			return $this->db->update("$this->table", $data);
		} catch(Exception $e) {
			die($e->getMessage());
		}
		return FALSE;
	}

	public function delete($id) {
		try {
			$this->db->where($this->pk, $id);
			return $this->db->delete("$this->table");
		} catch(Exception $e) {
			die($e->getMessage());
		}
		return FALSE;
	}
}