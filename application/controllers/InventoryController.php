<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InventoryController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

    public function index() {
		$data['title'] = 'Inventaris - Dapurbude';
        $this->load->view('admin/inventory/index', $data);
    }
}