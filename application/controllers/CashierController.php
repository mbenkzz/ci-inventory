<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CashierController extends CI_Controller 
{

    public function index() {
        $data['title'] = 'Kasir';
        $this->load->view('admin/cashier/index', $data);
    }
}