<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

    public function index() {
		check_auth();
		$data['title'] = 'Dashboard - Dapurbude';
        $this->load->view('admin/dashboard/index', $data);
    }
}