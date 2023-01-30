<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ItemsController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Item', 'item');
	}

    public function index() {
		check_auth();
		// load category model
		$this->load->model('Category', 'category');
		$data['title'] = 'Inventaris';
		$data['items'] = $this->item->getItemTable();
		$data['categories'] = $this->category->getAllCategory()->result();
        $this->load->view('admin/item/index', $data);
    }

	public function insert() {
		check_auth('ajax');
		// validator
		$this->load->library('validator');
		$this->validator->set_rules('name', 'Nama Barang', 'required');
		$this->validator->set_rules('stock', 'Stok', 'required|numeric|min[0]');
		$this->validator->set_rules('unit', 'Satuan', 'required');
		$this->validator->set_rules('buy_price', 'Harga Beli', 'required|numeric|min[0]');
		$this->validator->set_rules('sell_price', 'Harga Jual', 'required|numeric|min[0]');
		$this->validator->set_rules('category_id', 'Kategori', 'required');
		if ($this->validator->run()) {
			// begin transaction
			$this->db->trans_start();
			// item_code format is ITEMXXXX
			$last_item_code = $this->item->getLastItemCode(); 

            $data = $this->validator->get_data();
			$data['item_code'] = $last_item_code;
			$this->item->insert($data);

			$this->db->trans_complete();
            echo json_encode(['status' => 'success', 'message' => 'Berhasil menambahkan kategori']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $this->validator->get_errors()]);
        }

	}

	public function edit_stock() {
		ajax_only();
		check_auth('ajax');

		$id = $this->input->get('id');
		if(!$id) {
			echo json_encode(['status' => 'error', 'message' => 'Barang tidak ditemukan']);
			return;
		}
		
		$data['item'] = $this->item->getById($id)->row();
		$html = $this->load->view('admin/item/_part_edit_stock', $data, true);
		echo json_encode(['status' => 'success', 'html' => $html]);
	}

	public function update_stock() {
		ajax_only();
		check_auth('ajax');

		// validator
		$this->load->library('validator');
		$this->validator->set_rules('id', 'Barang', 'required');
		$this->validator->set_rules('stock', 'Stok', 'required|numeric|min[1]'); // minimal 1, ya masa nambah cuma 0
		if($this->validator->run()) {
			$data = $this->validator->get_data();
			$this->item->update_stock($data);
			echo json_encode(['status' => 'success', 'message' => 'Berhasil mengubah stok barang']);
		} else {
			echo json_encode(['status' => 'error', 'message' => $this->validator->get_errors()]);
		}
	}

	public function delete() {
		ajax_only();
		check_auth('ajax');
		
        $id = $this->input->post('id');
        $this->item->delete($id);
        echo json_encode(['status' => 'success', 'message' => 'Berhasil menghapus barang']);
	}
}