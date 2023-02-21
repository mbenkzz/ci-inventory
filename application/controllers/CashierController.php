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
        $this->db->trans_start();

        $trans_id = $this->cashier->insertTransaction($insert);

        $ids = [];
        foreach ($data['items'] as $key => $value) {
            $ids[] = $value['id'];
        }

        $items = $this->cashier->getCartItems($ids);

        // put query result to $data['items']
        $details = [];
        foreach ($items->result() as $item) {
            // assign it into table transaction detail
            $row = [];
            $row['trans_id'] = $trans_id;
            $row['item_code'] = $item->item_code;
            $row['item_name'] = $item->name;
            $amount = $data['items'][$item->item_code]['amount'];
            $row['amount'] = $amount;
            $row['buy_price'] = $item->buy_price;
            $row['sell_price'] = $item->sell_price;
            $details[] = $row;

            // pick stock
            $this->item->stock_out($item->id, $amount);
        }

        // dd($items->result());    

        // insert into transaction_detail table
        $this->cashier->insertTransactionDetail($details);

        if(!empty($errors)) {
            $this->session->set_flashdata('error', $error);
            $this->session->set_flashdata('form_data', $this->input->post());
            redirect(admin_url('transaction/cashier'));
            die;
        }

        $this->db->trans_complete();

        redirect(admin_url('transaction/cashier'));
    }

    public function history() {
        check_auth();
        $data['title'] = 'Riwayat Transaksi';
        $this->load->view('admin/cashier/transaction_history', $data);
    }

    public function data_history() {
        ajax_only();
        check_auth('ajax');

        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        if (empty($start_date) || empty($end_date)) {
            $response['status'] = 'error';
            $response['message'] = 'Tanggal awal dan akhir harus diisi';
            echo json_encode($response);
            die;
        }

        if($start_date > $end_date) {
            $response['status'] = 'error';
            $response['message'] = 'Tanggal awal tidak boleh lebih besar dari tanggal akhir';
            echo json_encode($response);
            die;
        }

        // $start_date has format dd/mm/yyyy
        if(!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $start_date)) {
            $response['status'] = 'error';
            $response['message'] = 'Format tanggal awal salah';
            echo json_encode($response);
            die;
        } else {
            $start_date = date_create_from_format('d/m/Y', $start_date)->format('Y-m-d') . ' 00:00:00';
        }

        // $end_date has format dd/mm/yyyy
        if(!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $end_date)) {
            $response['status'] = 'error';
            $response['message'] = 'Format tanggal akhir salah';
            echo json_encode($response);
            die;
        } else {
            $end_date = date_create_from_format('d/m/Y', $end_date)->format('Y-m-d') . ' 23:59:59';
        }

        $response = [];

        $transactions = $this->cashier->getTransactionHistory($start_date, $end_date)->result();
        $id = [];

        foreach ($transactions as $transaction) {
            $id[] = $transaction->id;
        }

        $details = $this->cashier->getDetailTransaction($id)->result();
        
        $items = [];
        $total_buy = 0;
        foreach ($details as $item) {
            $item->string_buy_price = number_format($item->buy_price, 0, ',', '.');
            $item->string_sell_price = number_format($item->sell_price, 0, ',', '.');
            $items[$item->transaction_code][] = $item;
            $total_buy += $item->buy_price * $item->amount;
        }
        $response['total_buy'] = $total_buy;

        $total_sell = 0;
        foreach ($transactions as $transaction) {
            $transaction->items = $items[$transaction->code];
            $transaction->created_at = date_create_from_format('Y-m-d H:i:s', $transaction->created_at)->format('d/m/Y H:i');
            $total_sell += $transaction->total;
        }
        $response['total_sell'] = $total_sell;

        $response['data'] = $transactions;
        $response['status'] = 'success';
        echo json_encode($response);
    }
}