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
		

		$query = $this->dashboard->get_chart_sales($type)->result_array();
		if ($type == 'recently') {

			foreach ($query as $value) {
				$month = getMonthName($value['month']);
				$data[] = [
					'label' => "{$value['day']} {$month} {$value['year']}",
					'count' => (int) $value['count']
				];
			}
		} else if ($type == 'this_month' || $type == 'last_month') {
			$month = $type == 'this_month' ? date('m') : date('m', strtotime('previous month'));
			$last_day_of_month = date_create_from_format('m', $month)->format('t');
			$data = array_fill(1, $last_day_of_month-1, 0);
			foreach ($query as $value) {
				$day = $value['day'];
				$month = getMonthName($value['month']);
				$data[($day - 1)] = [
					'label' => "{$day} {$month} {$value['year']}",
					'count' => (int) $value['count']
				];
			}

			ksort($data);
			
			// fill array to default value where the value is 0
			$data = array_map(function ($value, $index) {
				if ($value == 0) {
					return [
						'label' => $index + 1,
						'count' => 0
					];
				}
				return $value;
			}, $data, array_keys($data));
		} else {
			$data = [];
		}

		// echo "<pre>";
		// print_r($data);

		// die;

		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function get_chart_profit()
	{
		// ajax_only();
		// check_auth('ajax');

		$data = null;
		$type = $this->input->get('type');
		

		$query = $this->dashboard->get_chart_profit($type)->result_array();
		if ($type == 'recently') {

			foreach ($query as $value) {
				$month = getMonthName($value['month']);
				$data[] = [
					'label' => "{$value['day']} {$month} {$value['year']}",
					'count' => (int) $value['total']
				];
			}
		} else if ($type == 'this_month' || $type == 'last_month') {
			$month = $type == 'this_month' ? date('m') : date('m', strtotime('previous month'));
			$last_day_of_month = date_create_from_format('m', $month)->format('t');
			$data = array_fill(1, $last_day_of_month-1, 0);
			foreach ($query as $value) {
				$day = $value['day'];
				$month = getMonthName($value['month']);
				$data[($day - 1)] = [
					'label' => "{$day} {$month} {$value['year']}",
					'count' => (int) $value['count']
				];
			}

			ksort($data);
			
			// fill array to default value where the value is 0
			$data = array_map(function ($value, $index) {
				if ($value == 0) {
					return [
						'label' => $index + 1,
						'count' => 0
					];
				}
				return $value;
			}, $data, array_keys($data));
		} else {
			$data = [];
		}

		// echo "<pre>";
		// print_r($data);

		// die;

		header('Content-Type: application/json');
		echo json_encode($data);
	}
}
