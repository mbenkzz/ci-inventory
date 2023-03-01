<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CashierController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Item', 'item');
    $this->load->model('Cashier', 'cashier');
  }

  public function index()
  {
    check_auth();
    $data['title'] = 'Kasir';
    $this->load->view('admin/cashier/index', $data);
  }

  public function insert()
  {
    check_auth();
    $errors = [];

    // generate invoice number
    $transaction_code = $this->cashier->generateTransactionCode();

    $data = $this->input->post();
    if ($data['paid'] < $data['total']) {
    }
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
      'delete_reason' => null,
      'paid' => $data['paid'],
      'change' => $data['change']
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

    if (!empty($errors)) {
      $this->session->set_flashdata('error', $error);
      $this->session->set_flashdata('form_data', $this->input->post());
      redirect(admin_url('transaction/cashier'));
      die;
    }

    $this->db->trans_complete();

    redirect(admin_url('transaction/cashier'));
  }

  public function history()
  {
    check_auth();
    $data['title'] = 'Riwayat Transaksi';
    $this->load->view('admin/cashier/transaction_history', $data);
  }

  public function data_history()
  {
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

    if ($start_date > $end_date) {
      $response['status'] = 'error';
      $response['message'] = 'Tanggal awal tidak boleh lebih besar dari tanggal akhir';
      echo json_encode($response);
      die;
    }

    // $start_date has format dd/mm/yyyy
    if (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $start_date)) {
      $response['status'] = 'error';
      $response['message'] = 'Format tanggal awal salah';
      echo json_encode($response);
      die;
    } else {
      $start_date = date_create_from_format('d/m/Y', $start_date)->format('Y-m-d') . ' 00:00:00';
    }

    // $end_date has format dd/mm/yyyy
    if (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $end_date)) {
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

  public function print($code)
  {
    check_auth();

    $transaction = $this->cashier->getSingleTransaction($code)->row();
    if($transaction->created_by != getSession()->id && getSession()->role != 'admin') {
      redirect(admin_url('transaction/cashier'));
      die;
    }

    $this->load->library('pdf', ['unit' => 'mm', 'size' => 'A5', 'orientation' => 'P'], 'fpdf');

    $this->fpdf->AddPage();
    $this->fpdf->SetFont('Arial', 'B', 16);
    $this->fpdf->Cell(0, 5, 'Dapurbude', 0, 1, 'C');
    $this->fpdf->setY($this->fpdf->getY() + 5);

    $this->fpdf->SetFont('Courier', 'B', 12);
    $this->fpdf->Cell(0, 5, $transaction->code, 0, 1, 'L');
    $this->fpdf->Cell(50, 5, date_create_from_format('Y-m-d H:i:s', $transaction->created_at)->format('d.m.Y-H:i'), 0, 0, 'L');
    $this->fpdf->Cell(0, 5, 'Kasir: ' . $transaction->cashier, 0, 1, 'R');

    $w = array(70, 20, 10, 0);
    $header = array('Nama Barang', 'Harga', 'Jumlah', 'Total');

    $x = $this->fpdf->getX();
    $this->fpdf->Line($x, $this->fpdf->getY(), $x + 128, $this->fpdf->getY());

    $this->fpdf->SetFont('Courier', '', 10);
    // for ($i = 0; $i < count($header); $i++) {
    //     $this->fpdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
    // }

    $details = $this->cashier->getDetailTransaction($transaction->id)->result();
    $subtotal = 0;
    foreach ($details as $item) {
      $this->fpdf->Cell($w[0], 5, $item->item_name, 0, 0, 'L');
      $this->fpdf->Cell($w[1], 5, number_format($item->sell_price, 0, ',', '.'), 0, 0, 'R');
      $this->fpdf->Cell($w[2], 5, $item->amount, 0, 0, 'R');
      $this->fpdf->Cell($w[3], 5, number_format($item->sell_price * $item->amount, 0, ',', '.'), 0, 1, 'R');
      $subtotal += $item->sell_price * $item->amount;
    }
    $this->fpdf->Line($x, $this->fpdf->getY(), $x + 128, $this->fpdf->getY());

    $this->fpdf->Cell(105, 5, 'Subtotal:', 0, 0, 'R');
    $this->fpdf->Cell(0, 5, number_format($subtotal, 0, ',', '.'), 0, 1, 'R');
    $this->fpdf->Cell(105, 5, 'Diskon:', 0, 0, 'R');
    $this->fpdf->Cell(0, 5, number_format($transaction->disc, 0, ',', '.'), 0, 1, 'R');
    $this->fpdf->Cell(105, 5, 'Total:', 0, 0, 'R');
    $this->fpdf->Cell(0, 5, number_format($transaction->total, 0, ',', '.'), 0, 1, 'R');
    $this->fpdf->Cell(105, 5, 'Bayar:', 0, 0, 'R');
    $this->fpdf->Cell(0, 5, number_format($transaction->paid, 0, ',', '.'), 0, 1, 'R');
    $this->fpdf->Cell(105, 5, 'Kembali:', 0, 0, 'R');
    $this->fpdf->Cell(0, 5, number_format($transaction->change, 0, ',', '.'), 0, 1, 'R');

    $this->fpdf->setY($this->fpdf->getY() + 5);
    $this->fpdf->Cell(0, 5, '----------------------------------------', 0, 1, 'C');
    $this->fpdf->Cell(0, 5, 'Barang yang telah dibeli', 0, 1, 'C');
    $this->fpdf->Cell(0, 5, 'tidak dapat ditukar atau dikembalikan', 0, 1, 'C');
    $this->fpdf->SetFont('Courier', '', 12);
    $this->fpdf->Cell(0, 5, 'Terima Kasih', 0, 1, 'C');

    $this->fpdf->setTitle($transaction->code);

    $this->fpdf->Output();
  }
}
