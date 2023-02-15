<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cashier extends CI_Model {

    public function getCartItems($ids = []) {
        print_r($ids);
        $this->db->select('*');
        $this->db->from('items');
        $this->db->where_in('id', $ids);
        $order = sprintf('FIELD(id, %s)', implode(', ', $ids));
        $this->db->order_by($order);

        $sql = $this->db->get_compiled_select();
        // echo $sql;
        return $this->db->query($sql); 
    }
}