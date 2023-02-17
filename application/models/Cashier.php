<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cashier extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getCartItems($ids = []) {
        $this->db->select('*');
        $this->db->from('items');
        $this->db->where_in('id', $ids);
        $order = sprintf('FIELD(id, %s)', implode(', ', $ids));
        $this->db->order_by($order);

        $sql = $this->db->get_compiled_select();
        // echo $sql;
        return $this->db->query($sql); 
    }

    public function generateTransactionCode() {
        // the format is TR20230213-008
        $date = date('Ymd');
        $this->db->select('COUNT(*) as total');
        $this->db->from('transaction');
        $this->db->like('code', 'TR'.$date, 'after');
        $sql = $this->db->get_compiled_select();
        $result = $this->db->query($sql)->row();
        $total = $result->total + 1;
        $total = str_pad($total, 3, '0', STR_PAD_LEFT);
        return 'TR'.$date.'-'.$total;
    }

    public function insertTransaction($data = []) {
        $this->db->insert('transaction', $data);
        return $this->db->insert_id();
    }

    public function insertTransactionDetail($data = []) {
        $this->db->insert_batch('transaction_detail', $data);
        return $this->db->affected_rows();
    }
}