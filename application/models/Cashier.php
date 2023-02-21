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
        $this->db->insert_batch('detail_transaction', $data);
        return $this->db->affected_rows();
    }

    public function getTransactionHistory($start, $end) {
        $this->db->select('t.*, u.fullname as cashier');
        $this->db->from('transaction t');
        $this->db->join('users u', 'u.id = t.created_by');
        $this->db->where('t.deleted_at', null);
        $this->db->where('t.created_at >=', $start);
        $this->db->where('t.created_at <=', $end);
        if(getSession()->role != 'admin'){
            $this->db->where('t.created_by', getSession()->id);
        }
        $this->db->order_by('t.created_at', 'DESC');
        $sql = $this->db->get_compiled_select();

        return $this->db->query($sql);
    }

    public function getDetailTransaction($id = null) {
        $this->db->select('dt.*, t.code as transaction_code');
        $this->db->from('detail_transaction dt');
        // left join
        $this->db->join('transaction t', 't.id = dt.trans_id', 'left');
        if (!is_null($id) && !empty($id)) {
            if(is_array($id)){
                $this->db->where_in('trans_id', $id);
            } else {
                $this->db->where('trans_id', $id);
            }
        } else {
            $this->db->where(1, 0);
        }
        
        $sql = $this->db->get_compiled_select();

        return $this->db->query($sql);
    }
}