<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User', 'user');
	}

	public function index()
	{
		check_auth();
		$data['title'] = 'Pengguna - Dapurbude';
		$data['users'] = $this->user->getAllUser()->result();
		$this->load->view('admin/user/index', $data);
	}

	public function create()
	{
		check_auth();
		$data['title'] = 'Pengguna - Dapurbude';
		$this->load->view('admin/user/add', $data);
	}

	public function insert()
	{
		check_auth('ajax');
		// Role check
		if(getSession()->role != 'admin')
			die(json_encode(['status' => 'error', 'message' => 'Anda tidak memiliki akses untuk menambahkan pengguna']));
		
		// Validate input
		$this->load->library('validator'); // Load custom validator library in application/libraries/Validator.php
		$this->validator->set_rules('username', 'Username', 'required|user_unique');
		$this->validator->set_rules('fullname', 'Nama', 'required');
		$this->validator->set_rules('password', 'Password', 'required|min_length[6]');
		$this->validator->set_rules('role', 'Role', 'required');
		if ($this->validator->run()) {
			$data = $this->validator->get_data();
			$data['password'] = md5($data['password']);
			$this->user->insert($data);
			echo json_encode(['status' => 'success', 'message' => 'Berhasil menambahkan pengguna']);
		} else {
			echo json_encode(['status' => 'error', 'message' => $this->validator->get_errors()]);
		}
	}

	public function edit($id)
	{
		$data['title'] = 'Pengguna - Dapurbude';
		$data['user'] = $this->user->getSingleUser($id)->row();
		$this->load->view('admin/user/edit', $data);
	}

	public function update($id)
	{
		check_auth('ajax');
		// Role check
		if(getSession()->role != 'admin')
			die(json_encode(['status' => 'error', 'message' => 'Anda tidak memiliki akses untuk mengubah pengguna']));
		
		// Validate input
		$this->load->library('validator'); // Load custom validator library in application/libraries/Validator.php
		$this->validator->set_rules('username', 'Username', 'required|user_unique['.$id.']');
		$this->validator->set_rules('password', 'Password', 'nullable|min_length[6]');
		$this->validator->set_rules('fullname', 'Nama', 'required');
		$this->validator->set_rules('role', 'Role', 'required');
		if ($this->validator->run()) {
			$data = $this->validator->get_data();
			$this->user->update($data, $id);
			echo json_encode(['status' => 'success', 'message' => 'Berhasil mengubah pengguna']);
		} else {
			echo json_encode(['status' => 'error', 'message' => $this->validator->get_errors()]);
		}
	}

	public function delete($id)
	{
		check_auth('ajax');
		// Role check
		if(getSession()->role != 'admin')
			die(json_encode(['status' => 'error', 'message' => 'Anda tidak memiliki akses untuk menghapus pengguna']));
		
		$this->user->delete($id);
		echo json_encode(['status' => 'success', 'message' => 'Berhasil menghapus pengguna']);
	}
}
