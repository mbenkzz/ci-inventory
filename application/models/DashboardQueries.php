<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardQueries extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get bar chart sales
	 * @param string $type recently, this_month, last_month
	 */
	public function get_chart_sales($type = 'recently')
	{
		$year = date('Y');

		if ($type == 'recently') {
			// pick last 14 days from today
			// date format (0 to 31)-(0 to 12)
      $select = "DATE_FORMAT(created_at, '%e-%c') as `date`, day(created_at) as `day`, month(created_at) as `month`, year(created_at) as `year`";
      $where = "WHERE created_at >= DATE_SUB(NOW(), INTERVAL 14 DAY)";
		} else if ($type == 'this_month' || $type == 'last_month') {
			// this month
			$month = $type == 'this_month' ? date('m') : date('m', strtotime('previous month'));
			$select = "day(created_at) as `day`, month(created_at) as `month`, year(created_at) as `year`";
      $where = "WHERE year(created_at) = $year AND month(created_at) = $month";
		} else {
      return false;
    }
		$sql = "SELECT 
          {$select},
          count(created_at) as `count`
        FROM 
          transaction 
        {$where}
        GROUP BY 
          day(created_at) 
        ORDER BY
          `created_at` ASC";
		return $this->db->query($sql);
	}

	/**
	 * Get bar chart profit
	 * @param string $type recently, this_month, last_month
	 */
	public function get_chart_profit($type = 'recently')
	{
		$year = date('Y');

		if ($type == 'recently') {
			$select = "DATE_FORMAT(created_at, '%e-%c') as `date`, day(created_at) as `day`, month(created_at) as `month`, year(created_at) as `year`";
      $where = "WHERE created_at >= DATE_SUB(NOW(), INTERVAL 14 DAY)";
		} else if ($type == 'this_month' || $type == 'last_month') {
			// this month
      $month = $type == 'this_month' ? date('m') : date('m', strtotime('previous month'));
      $select = "day(created_at) as `day`, month(created_at) as `month`, year(created_at) as `year`";
			$where = "WHERE year(created_at) = $year AND month(created_at) = $month";
		} else {
      return false;
    }

    $sql = "SELECT
		  	{$select},
		  	sum(t.total) as total,
		  	sum(i.worth) as expense,
        sum(t.total) - sum(i.worth) as `count`
		  from
		  	`transaction` as t
		  left join
		  (
		  	select
		  		trans_id,
		  		sum(amount * buy_price) as worth
		  	from
		  		detail_transaction
		  	group by
		  		trans_id ) as i
		  on
		  	i.trans_id = t.id
      {$where}
		  group by
		  	date_format(t.created_at, '%d-%m-%Y')
		  order by
		  	date_format(t.created_at, '%Y%m%d')";

		return $this->db->query($sql);
	}
}
