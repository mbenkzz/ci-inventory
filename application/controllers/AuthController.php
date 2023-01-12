<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User', 'user');
	}

	public function redirect_admin() {
		if(getSession())
			redirect( admin_url('dashboard') );
		else
			redirect( admin_url('login') );
	}
    
    public function login() {
		if(getSession()) {
			redirect( admin_url('dashboard') );
			die;
		}
        $this->load->view('admin/auth/login');
    }

    public function login_process() {
        try {
			$query = $this->user->filtered_user(["username" => $this->input->post("username"), "password" => md5($this->input->post("password"))])->row();

			if(!empty($query)) {
				echo json_response('success', "Sukses Login");

				$this->session->set_userdata(["logged_user" => $query]);
				$_SESSION['logged_user'] = $query;
			}
			else {
				echo json_response('error', "Username atau Password salah");
			}
		} catch (\Exception $e) {
			echo json_response('error', $e->getMessage());
		}
    }

    public function logout() {
		$this->session->unset_userdata('logged_user');
		redirect( admin_url('login') );
    }
}