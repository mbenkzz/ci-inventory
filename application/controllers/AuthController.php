<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User', 'user');
	}
    
    public function login() {
        $this->load->view('admin/auth/login');
    }

    public function login_process() {
        try {
			$query = $this->user->filtered_user(["username" => $this->input->post("username"), "password" => md5($this->input->post("password"))])->row();

			if(!empty($query)) {
				echo "OK";

				$this->session->set_userdata(["logged_user" => $query]);
				$_SESSION['logged_user'] = $query;
			}
			else {
				echo "Username atau Password Salah";
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
    }

    public function logout() {
		$this->session->unset_userdata('logged_user');
    }
}