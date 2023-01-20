<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function getSession() {
	$that = &get_instance();
	if(!$that->session->has_userdata("logged_user"))
		return FALSE;

	return $_SESSION['logged_user'];
}

function show_login() {
	$that = &get_instance();
	return $that->load->view("admin/login");
}

/**
 * Checks authentication
 * @param  string $act redirect|ajax
 * @return void
 */
function check_auth($act = 'redirect') {
	if(!getSession()) {
		if($act == 'redirect')
			redirect(admin_url('login'));
		else
			die(json_encode(['status' => 'expired', 'message' => 'Sesi Anda telah berakhir, silahkan login kembali']));
	}
}