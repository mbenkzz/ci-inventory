<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
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
		
	}
}
