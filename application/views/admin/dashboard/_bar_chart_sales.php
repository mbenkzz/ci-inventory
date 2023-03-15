<div class="card mb-4">
	<div class="card-header">
		<i class="fas fa-chart-bar mr-1"></i>
		Jumlah Penjualan per Hari (Daily Sales Count)
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-12">
				<select id="filter_sales_select_time">
					<option value="recently">10 hari terakhir</option>
					<option value="this_month">Bulan ini</option>
					<option value="last_month">Bulan lalu</option>
				</select>
			</div>
		</div>
	</div>
	<div class="card-body"><canvas id="bar_chart_sales" width="100%" height="40"></canvas></div>
</div>
<script>
	var salesChart;

	// Function to update chart data
	function updateSalesChart() {
		// Clear existing data
		salesChart.data.labels = [];
		salesChart.data.datasets[0].data = [];

		$.ajax({
			url : "<?= admin_url('dashboard/api/chart_sales') ?>",
			method : "GET",
			data : {
				type : $('#filter_sales_select_time').val()
			},
			success : function(data) {
				// Add new data
				data.forEach(function(datum) {
					salesChart.data.labels.push(datum.label);
					salesChart.data.datasets[0].data.push(datum.count);
				});

				// Update chart
				salesChart.update();
			}
		});
	}

	window.addEventListener('load', function() {
		// Update chart on filter change
		// Initialize chart data
		var salesData = {
			labels: [],
			datasets: [{
				label: 'Penjualan',
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

		updateSalesChart();

		$('#filter_sales_select_time').on('change', function() {
			updateSalesChart();
		});

	});
</script>
