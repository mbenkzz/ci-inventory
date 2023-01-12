<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

	public $column = array(
		"id",
		"username",
		"password",
        "nama"
	);

	public $searchColumn = array(
		"nama",
		"username",
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
		return $this->db->get();
	}

	public function getSingleUser($id) {
		$this->__complete_query();
		$this->db->where($this->pk, $id);
		return $this->db->get();
	}

	public function filtered_user($where = [], $method = "AND") {
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

}