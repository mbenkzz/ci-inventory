<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CashierController extends CI_Controller 
{

    public function __construct() {
        parent::__construct();
        $this->load->model('Item', 'item');
    }

    public function index() {
        $data['title'] = 'Kasir';
        $data['items'] = $this->item->getItems();
        $this->load->view('admin/cashier/index', $data);
    }
}