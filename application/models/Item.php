<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Model {

    // list of column as add_items.sql
    public $columns = [
        'id',
        'item_code',
        'name',
        'stock',
        'unit',
        'buy_price',
        'sell_price',
        'category_id'
    ];

    public $select_columns = [
        
    ];

    public $table = 'items';

    public function __construct()
    {
        parent::__construct();
    }

    public function getItemTable() {
        $this->db->select('items.*, categories.name as category_name');
        $this->db->join('categories', 'categories.id = items.category_id');
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