<?php

class CategoryController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category', 'category');
    }

    public function index()
	{
		check_auth();
		$data['title'] = 'Kategori - Dapurbude';
		$data['categories'] = $this->category->getCategoriesTable()->result();
		$this->load->view('admin/kategori/index', $data);
	}

    public function create()
	{
		check_auth();
		$data['title'] = 'Tambah Kategori - Dapurbude';
		$this->load->view('admin/kategori/add', $data);
	}

    public function insert()
    {
        check_auth('ajax');
        $this->load->library('validator');
        $this->validator->set_rules('name', 'Nama Kategori', 'required|max_length[64]');
        $this->validator->set_rules('description', 'Keterangan', 'nullable');
        if ($this->validator->run()) {
            $data = $this->validator->get_data();
            $this->category->insert($data);
            echo json_encode(['status' => 'success', 'message' => 'Berhasil menambahkan kategori']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $this->validator->get_errors()]);
        }
    }

    public function edit($id)
    {
        check_auth();
        $data['title'] = 'Kategori - Dapurbude';
        $data['category'] = $this->category->getSingleCategory($id)->row();
        $this->load->view('admin/kategori/edit', $data);
    }

    public function update($id)
    {
        check_auth('ajax');
        $this->load->library('validator');
        $this->validator->set_rules('name', 'Nama Kategori', 'required|max_length[64]');
        $this->validator->set_rules('description', 'Keterangan', 'nullable');

        if ($this->validator->run()) {
            $data = $this->validator->get_data();
            $this->category->update($data, $id);
            echo json_encode(['status' => 'success', 'message' => 'Berhasil mengubah kategori']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $this->validator->get_errors()]);
        }
    }

    public function delete()
    {
        check_auth('ajax');
        $id = $this->input->post('id');
        $this->category->delete($id);
        echo json_encode(['status' => 'success', 'message' => 'Berhasil menghapus kategori']);
    }
}