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
		$data['items'] = $this->item->getItems();
		$data['categories'] = $this->category->getAllCategory()->result();
        $this->load->view('admin/item/index', $data);
    }

	public function datatables_items() {
		ajax_only();
		check_auth('ajax');

		$data = [];
		foreach ($this->item->get_datatables() as $key) {

			$button_edit_stock = $this->html->generate(
				'button', 
				// '<i class="fas fa-box fa-fw"></i><i class="fas fa-plus fa-fw"></i>', 
				'<i class="fas fa-plus fa-fw"></i>', 
				array(
					'class' => 'btn btn-success',
					'onclick' => "edit_stock({$key->id})",
					'title' => 'Tambah Stok'
				)
			);

			$button_edit = $this->html->generate(
				'a', 
				'<i class="fas fa-pen fa-fw"></i>',
				array(
					'class' => 'btn btn-primary',
					'href' => admin_url('items/edit/'.$key->id),
					'title' => 'Edit',
					'target' => '_blank'
				));

			$button_group = $this->html->generate(
				'div', 
				$button_edit_stock . $button_edit,
				array(
					'class' => 'btn-group btn-group-sm'
				)
			);

			$row = array();
			$row[] = $key->item_code;
			$row[] = $key->name;
			$row[] = $key->stock;
			$row[] = $key->unit;
			$row[] = $key->buy_price;
			$row[] = $key->sell_price;
			$row[] = $button_group;
			$data[] = $row;
		}

		$json = array(
			'draw' => $this->input->post('draw'),
			'recordsTotal' => $this->item->count_data(),
			'recordsFiltered' => $this->item->count_filtered(),
			'data' => $data
		);
		echo json_encode($json);
	}

	public function select2_items() {
		ajax_only();
		check_auth('ajax');

		$search = $this->input->get('q') ?? '';
		$items = $this->item->getSelect2($search);
		$data = [];
		foreach ($items as $key) {
			$data[] = [
				'id' => $key->id,
				'text' => "{$key->name}",
				'name' => $key->name,
				'code' => $key->item_code,
				'stock' => $key->stock,
				'unit' => $key->unit,
				'price' => $key->sell_price,
			];
		}
		echo json_encode($data);
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

	public function edit($id) {
		check_auth();

		$this->load->model('Category', 'category');

		$data['title'] = 'Inventaris';
		$data['item'] = $this->item->getById($id)->row();
		$data['categories'] = $this->category->getAllCategory()->result();
		$this->load->view('admin/item/edit', $data);
	}

	public function update($id) {
		ajax_only();
		check_auth('ajax');

		if(!empty($_POST['stock'])) {
			$_POST['stock'] = str_replace('.', '', $_POST['stock']);
			$_POST['stock'] = str_replace(',', '.', $_POST['stock']);
		}

		// validator
		$this->load->library('validator');
		$this->validator->set_rules('id', 'Barang', 'required');
		$this->validator->set_rules('name', 'Nama Barang', 'required');
		$this->validator->set_rules('unit', 'Satuan', 'required');
		$this->validator->set_rules('buy_price', 'Harga Beli', 'required|numeric|min[0]');
		$this->validator->set_rules('sell_price', 'Harga Jual', 'required|numeric|min[0]');
		$this->validator->set_rules('stock', 'Stok', 'required|numeric|min[0]');
		$this->validator->set_rules('category_id', 'Kategori', 'required');
		$this->validator->set_rules('description', 'Deskripsi / Keterangan', 'nullable');
		if($this->validator->run()) {
			$data = $this->validator->get_data();
			$this->item->update($data);
			echo json_encode(['status' => 'success', 'message' => 'Berhasil mengupdate barang']);
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
