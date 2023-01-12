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
	return $that->load->view("admin/login", ["title"=> "Digital MTQ"]);
}