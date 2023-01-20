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
		$data['title'] = 'Pengguna - Dapurbude';
		$this->load->view('admin/user/index');
	}

	public function create()
	{
		$data['title'] = 'Pengguna - Dapurbude';
		$this->load->view('admin/user/create');
	}

	public function insert()
	{
		// if session expired
		if(!getSession())
			echo json_encode(['status' => 'expired', 'message' => 'Sesi Anda telah berakhir, silahkan login kembali']);
		// Role check
		if(getSession()->role != 'admin')
			echo json_encode(['status' => 'error', 'message' => 'Anda tidak memiliki akses untuk menambahkan pengguna']);
		
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
}
