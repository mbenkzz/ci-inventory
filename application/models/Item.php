<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Model {

    // list of column as add_items.sql
    public $columns = [
        'i.id',
        'i.item_code',
        'i.name',
        'i.stock',
        'i.unit',
        'i.buy_price',
        'i.sell_price',
        'i.category_id',
        'c.name AS category_name'
    ];

    public $search_columns = [
        'i.item_code',
        'i.name',
        'i.stock',
        'i.unit',
        'i.buy_price',
        'i.sell_price',
        ''
    ];

    public $table = 'items';

    public function __construct()
    {
        parent::__construct();
    }

    // Start Datatable Items

    private function __complete_query() {
        $this->db->select($this->columns);
        $this->db->from($this->table . ' i');
        $this->db->join('categories c', 'c.id = i.category_id');
    }

    public function get_datatables() {
        $this->__complete_query();
        return $this->datatables->get_datatables($this->search_columns);
    }

    public function count_filtered() {
        $this->__complete_query();
        $this->datatables->get_datatables_query($this->search_columns);
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_data() {
        $this->__complete_query();
		return $this->db->count_all_results();
    }

    // End of datatable items

    public function getItems() {
        $this->db->select('items.*, categories.name as category_name');
        $this->db->join('categories', 'categories.id = items.category_id');
        $query = $this->db->get('items');
        return $query->result();
    }

    public function getSelect2($q = '') {
        $this->db->like('name', $q);
        $query = $this->db->get('items');
        return $query->result();
    }

    public function getById($id) {
        $this->db->select('items.*, categories.name as category_name');
        $this->db->where('items.id', $id);
        $this->db->join('categories', 'categories.id = items.category_id');
        return $this->db->get('items');
    }

    public function getLastItemCode() {
        $this->db->select('item_code');
        $this->db->order_by('item_code', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('items');
        $result = $query->row_array();
        if ($result) {
            $last_item_code = $result['item_code'];
            $last_item_code = (int) substr($last_item_code, 4);
            $last_item_code++;
            $last_item_code = 'ITEM' . str_pad($last_item_code, 4, '0', STR_PAD_LEFT);
        } else {
            $last_item_code = 'ITEM0001';
        }
        return $last_item_code;
    }

    public function insert($data) {
        $data['item_code'] = $this->getLastItemCode();
        $this->db->insert('items', $data);
    }

    public function update_stock($data) {
        $this->db->set('stock', 'stock + ' . $data['stock'], FALSE);
        $this->db->where('id', $data['id']);
        $this->db->update('items');
    }

    public function update($data) {
        $this->db->where('id', $data['id']);
        $this->db->update('items', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('items');
    }

}