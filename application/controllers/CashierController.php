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

        $data = $this->input->post();
        if ($data['pay'] < $data['total']) {}
        $data['code'] = $transaction_code;
        $data['discount'] = !empty($data['discount']) ? $data['discount'] : 0;

        // insert into transaction table
        $insert = [
            'code' => $transaction_code,
            'total' => $data['total'],
            'disc' => $data['discount'],
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => getSession()->id,
            'deleted_at' => null,
            'deleted_by' => null,
            'delete_reason' => null
        ];

        // begin transaction
        $this->db->trans_start(TRUE);

        $trans_id = $this->cashier->insertTransaction($insert);

        $ids = [];
        foreach ($data['items'] as $key => $value) {
            $ids[] = $value['id'];
        }

        $items = $this->cashier->getCartItems($ids);

        // put query result to $data['items']
        $details = [];
        foreach ($items->result() as $item) {
            $row = [];
            $row['trans_id'] = $trans_id;
            $row['item_code'] = $item->item_code;
            $row['item_name'] = $item->name;
            $row['amount'] = $data['items'][$item->item_code]['amount'];
            $row['buy_price'] = $item->buy_price;
            $row['sell_price'] = $item->sell_price;
            $details[] = $row;
        }

        // dd($details);

        // insert into transaction_detail table
        $this->cashier->insertTransactionDetail($details);

        // update stock
        foreach ($details as $key => $value) {
            $this->item->stock_out($value['id'], $value['amount']);
        }

        $this->db->trans_complete();

        if(!empty($errors)) {
            $this->session->set_flashdata('error', $error);
            $this->session->set_flashdata('form_data', $this->input->post());
            redirect(admin_url('cashier'));
        }
    }
}