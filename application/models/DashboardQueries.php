<?php
defined ( 'BASEPATH' ) OR exit ( 'No direct script access allowed' );

class DashboardQueries extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get bar chart sales
	 * @param string $type recently, this_month, last_month
	 */
	public function get_chart_sales($type='recently') {
		$year = date('Y');

		if ($type == 'recently') {
			// pick last 14 days from today
			// date format (0 to 31)-(0 to 12)
			$sql = "SELECT DATE_FORMAT(created_at, '%e-%c') as `date`, day(created_at) as `day`, month(created_at) as `month`, year(created_at) as `year`, count(created_at) as `count` FROM transaction WHERE created_at >= DATE_SUB(NOW(), INTERVAL 14 DAY) GROUP BY day(created_at) ORDER BY `created_at` ASC";
		} else if ($type == 'this_month') {
			// this month
			$month = date('m');
			$sql = "SELECT day(created_at) as `day`, month(created_at) as `month`, year(created_at) as `year`, count(created_at) as `count` FROM transaction WHERE year(created_at) = $year AND month(created_at) = $month GROUP BY day(created_at)";
		} else if ($type == 'last_month') {
			// last month
			$month = date('m',strtotime('previous month'));
			$sql = "SELECT day(created_at) as `day`, month(created_at) as `month`, year(created_at) as `year`, count(created_at) as `count` FROM transaction WHERE year(created_at) = $year AND month(created_at) = $month GROUP BY day(created_at)";
		} 
		// $sql = "SELECT month(created_at), count(created_at) FROM transaction WHERE year(created_at) = 2023 GROUP BY month(created_at)";
		return $this->db->query($sql);
	}

	/**
	 * Get bar chart profit
	 * @param string $type recently, this_month, last_month
	 */
	public function get_chart_profit($type='recently') {
		$year = date('Y');

		if ($type == 'recently') {
			// pick last 14 days from today
			// date format (0 to 31)-(0 to 12)
			$sql = "SELECT DATE_FORMAT(t.created_at, '%e-%c') as `date`, day(t.created_at) as `day`, month(t.created_at) as `month`, year(t.created_at) as `year`, (t.total - sum(dt.buy_price*dt.amount)) as `total` FROM transaction t LEFT JOIN detail_transaction dt ON dt.trans_id = t.id WHERE t.created_at >= DATE_SUB(NOW(), INTERVAL 14 DAY) GROUP BY day(t.created_at) ORDER BY t.created_at ASC";
		} else if ($type == 'this_month') {
			// this month
			$month = date('m');
			$sql = "SELECT day(t.created_at) as `day`, month(t.created_at) as `month`, year(t.created_at) as `year`, count(t.created_at) as `count` FROM transaction WHERE year(t.created_at) = $year AND month(t.created_at) = $month GROUP BY day(t.created_at) ORDER BY t.created_at ASC";
		} else if ($type == 'last_month') {
			// last month
			$month = date('m',strtotime('previous month'));
			$sql = "SELECT day(t.created_at) as `day`, month(t.created_at) as `month`, year(t.created_at) as `year`, count(t.created_at) as `count` FROM transaction WHERE year(t.created_at) = $year AND month(t.created_at) = $month GROUP BY day(t.created_at) ORDER BY t.created_at ASC";
		} 

		return $this->db->query($sql);
	}

}
