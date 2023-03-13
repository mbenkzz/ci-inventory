<?php
defined('BASEPATH') or exit('No direct script access allowed');

// https://www.chartjs.org/docs/2.8.0/
class DashboardController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dashboardQueries', 'dashboard');
	}

	public function index()
	{
		check_auth();
		$data['title'] = 'Dashboard';
		$this->load->view('admin/dashboard/index', $data);
	}

	public function get_chart_sales()
	{
		// ajax_only();
		// check_auth('ajax');

		$data = null;
		$type = $this->input->get('type');
		$month = $this->input->get('month') ?? date('m');

		$query = $this->dashboard->get_chart_sales($type)->result_array();
		$last_day_of_month = date_create_from_format('m', $month)->format('t');
		if ($type == 'recently') {

			foreach ($query as $key => $value) {
				$data[] = [
					'label' => $value['date'],
					'count' => (int) $value['count']
				];
			}
		}

		header('Content-Type: application/json');
		echo json_encode($data);
	}
}
