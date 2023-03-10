<div class="card mb-4">
	<div class="card-header">
		<i class="fas fa-chart-bar mr-1"></i>
		Bar Chart Example
	</div>
	<div class="card-body"><canvas id="bar_chart_sales" width="100%" height="40"></canvas></div>
</div>
<script>
	var salesChart;

	// Function to update chart data
	function updateSalesChart(data) {
		// Clear existing data
		salesChart.data.labels = [];
		salesChart.data.datasets[0].data = [];

		// Add new data
		data.forEach(function(datum) {
			salesChart.data.labels.push(datum.label);
			salesChart.data.datasets[0].data.push(datum.value);
		});

		// Update chart
		salesChart.update();
	}

	// Example usage: update chart with daily sales data
	var dailySalesData = [{
			label: '2022-02-21',
			value: 100
		},
		{
			label: '2022-02-22',
			value: 150
		},
		{
			label: '2022-02-23',
			value: 200
		},
		{
			label: '2022-02-24',
			value: 175
		},
		{
			label: '2022-02-25',
			value: 225
		},
		{
			label: '2022-02-26',
			value: 300
		},
		{
			label: '2022-02-27',
			value: 250
		}
	];

	// Example usage: update chart with monthly sales data
	var monthlySalesData = [{
			label: 'January 2022',
			value: 1500
		},
		{
			label: 'February 2022',
			value: 2250
		},
		{
			label: 'March 2022',
			value: 3000
		},
		{
			label: 'April 2022',
			value: 2800
		},
		{
			label: 'May 2022',
			value: 3500
		},
		{
			label: 'June 2022',
			value: 4000
		}
	];

	window.addEventListener('load', function() {
		// $.ajax({
		// 	url: "<?= base_url('admin/dashboard/get_bar_chart_sales') ?>",
		// 	method: "GET",
		// 	success: function(data) {
		// 		var month = [];
		// 		var total = [];
		// 		for (var i in data) {
		// 			month.push(data[i].month);
		// 			total.push(data[i].total);
		// 		}
		// 		var chartdata = {
		// 			labels: month,
		// 			datasets: [{
		// 				label: 'Total Penjualan',
		// 				backgroundColor: 'rgba(2,117,216,1)',
		// 				borderColor: 'rgba(2,117,216,1)',
		// 				data: total
		// 			}]
		// 		};
		// 		var ctx = $("#bar_chart_sales");
		// 		var barGraph = new Chart(ctx, {
		// 			type: 'bar',
		// 			data: chartdata,
		// 			options: {
		// 				scales: {
		// 					xAxes: [{
		// 						time: {
		// 							unit: 'month'
		// 						},
		// 						gridLines: {
		// 							display: false
		// 						},
		// 						ticks: {
		// 							maxTicksLimit: 6
		// 						}
		// 					}],
		// 					yAxes: [{
		// 						ticks: {
		// 							min: 0,
		// 							max: 100000,
		// 							maxTicksLimit: 5
		// 						},
		// 						gridLines: {
		// 							display: true
		// 						}
		// 					}],
		// 				},
		// 				legend: {
		// 					display: false
		// 				}
		// 			}
		// 		});
		// 	},
		// 	error: function(data) {
		// 		console.log(data);
		// 	}
		// });

		// 	var ctx = $("#bar_chart_sales");
		// 	var barGraph = new Chart(ctx, {
		// 		type: 'bar',
		// 		data: {
		// 			labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
		// 			datasets: [{
		// 				label: 'Jumlah Penjualan',
		// 				backgroundColor: 'rgba(2,117,216,1)',
		// 				borderColor: 'rgba(2,117,216,1)',
		// 				data: [10000, 20000, 30000, 40000, 50000, 60000, 70000, 80000, 90000, 100000, 110000, 120000]
		// 			}]
		// 		},
		// 		options: {
		// 			scales: {
		// 				xAxes: [{
		// 					time: {
		// 						unit: 'month'
		// 					},
		// 					gridLines: {
		// 						display: false
		// 					},
		// 					ticks: {
		// 						maxTicksLimit: 6
		// 					}
		// 				}],
		// 				yAxes: [{
		// 					ticks: {
		// 						min: 0,
		// 						max: 100000,
		// 						maxTicksLimit: 5
		// 					},
		// 					gridLines: {
		// 						display: true
		// 					}
		// 				}],
		// 			},
		// 			legend: {
		// 				display: false
		// 			}
		// 		}
		// 	});

		// Initialize chart data
		var salesData = {
			labels: [],
			datasets: [{
				label: 'Sales',
				data: [],
				backgroundColor: 'rgba(54, 162, 235, 0.5)',
				borderColor: 'rgba(54, 162, 235, 1)',
				borderWidth: 1
			}]
		};

		// Initialize chart options
		var salesOptions = {
			scales: {
				xAxes: [{
					time: {
						unit: 'month'
					},
					gridLines: {
						display: false
					},
					ticks: {
						maxTicksLimit: 6
					}
				}],
				yAxes: [{
					ticks: {
						min: 0,
						maxTicksLimit: 5
					},
					gridLines: {
						display: true
					}
				}],
			},
			legend: {
				display: false
			}
		};

		// Initialize chart
		salesChart = new Chart(document.getElementById('bar_chart_sales').getContext('2d'), {
			type: 'bar',
			data: salesData,
			options: salesOptions
		});

		updateSalesChart(monthlySalesData);
		updateSalesChart(dailySalesData);
	});
</script>
