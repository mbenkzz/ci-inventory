<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ItemsController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

    public function index() {
		$data['title'] = 'Inventaris';
        $this->load->view('admin/item/index', $data);
    }
}