<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Model {

	public $column = array(
		'id',
        'name',
        'description',
	);

	public $searchColumn = array(
		'id',
        'name',
	);

	private $table = "categories";
	private $pk = "id";

	public function __construct()
	{
		parent::__construct();
	}

	private function __complete_query() {
		$this->db->select($this->column);
		$this->db->from("$this->table");
	}

	public function getAllCategory() {
		$this->__complete_query();
		return $this->db->get();
	}

	public function getSingleCategory($id) {
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

    public function getCategoriesTable()
	{
		// with count of items
		$this->db->select('categories.*, COUNT(items.id) as items_count');
		$this->db->from('categories');
		$this->db->join('items', 'items.category_id = categories.id', 'left');
		$this->db->group_by('categories.id');
		$this->db->order_by('categories.name', 'ASC');
		return $this->db->get();
	}
}