<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// https://www.chartjs.org/docs/2.8.0/
class DashboardController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

    public function index() {
		check_auth();
		$data['title'] = 'Dashboard';
        $this->load->view('admin/dashboard/index', $data);
    }
}