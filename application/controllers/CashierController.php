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

        
        
        echo('<pre>');
        print_r($this->input->post());

        $data = $this->input->post();
        $ids = [];
        foreach ($data['items'] as $key => $value) {
            $ids[] = $value['id'];
        }

        $items = $this->cashier->getCartItems($ids);
        print_r($items->result());

        if(!empty($errors)) {
            $this->session->set_flashdata('error', $error);
            $this->session->set_flashdata('form_data', $this->input->post());
            redirect(admin_url('cashier'));
        }
    }
}