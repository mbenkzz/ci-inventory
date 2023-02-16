<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CashierController extends CI_Controller 
{

    public function __construct() {
        parent::__construct();
        $this->load->model('Item', 'item');
        $this->load->model('Cashier', 'cashier');
    }

    public function index() {
        check_auth();
        $data['title'] = 'Kasir';
        $this->load->view('admin/cashier/index', $data);
    }

    public function insert() {
        check_auth();
        $errors = [];

        // generate invoice number
        $transaction_code = $this->cashier->generateTransactionCode();
        
        echo('<pre>');

        $data = $this->input->post();
        if ($data['pay'] < $data['total']) {}
        $data['code'] = $transaction_code;
        $data['discount'] = !empty($data['discount']) ? $data['discount'] : 0;
        
        $ids = [];
        foreach ($data['items'] as $key => $value) {
            $ids[] = $value['id'];
        }

        $items = $this->cashier->getCartItems($ids);

        // put query result to $data['items']
        foreach ($items->result_array() as $item) {
            $data['items'][$item['item_code']] = array_merge($data['items'][$item['item_code']], $item);
        }



        if(!empty($errors)) {
            $this->session->set_flashdata('error', $error);
            $this->session->set_flashdata('form_data', $this->input->post());
            redirect(admin_url('cashier'));
        }
    }
}