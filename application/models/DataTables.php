<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataTables extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_datatables_query($columns) {
        $cari = $_REQUEST['search']['value'];

        if ($cari) {
            $this->db->group_start();
        }
        $i = 0;
        foreach ($columns as $key => $item) {
            if (strpos($item, "AS") > 0) {
                $item = substr($item, 0, strpos($item, "AS"));
            }

            if ($cari and ! empty($item)) {
                if (is_string($cari))
                    $i === 0 ? $this->db->like("LOWER($item)", strtolower($cari)) : $this->db->or_like("LOWER($item)", strtolower($cari));
                else
                    $i === 0 ? $this->db->like("$item", $cari) : $this->db->or_like($item, $cari);
            }
            $column[$i] = $item;
            $i++;
        }

        if ($cari) {
            $this->db->group_end();
        }

        if (isset($_REQUEST['order'])) {
            $order = $_REQUEST['order'];

            $fieldOrder = $columns[$order[0]['column']];
            $typeOrder = $order[0]['dir'];

            if (!empty($fieldOrder)) {
                $this->db->order_by($fieldOrder, $typeOrder);
            }
        }
    }

    function get_datatables($columns) {
        $this->get_datatables_query($columns);
        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        }
        $query = $this->db->get();
        return $query->result();
    }

    function get_datatables_string($columns) {
        $this->get_datatables_query($columns);
        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        } return $this->db->get_compiled_select();
    }

    function get_query_string($columns) {
        $this->get_datatables_query($columns);
        return $this->db->get_compiled_select();
    }

    function get_limit_datatables() {
        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        }
    }

}