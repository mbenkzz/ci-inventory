<div class="card mb-4">
	<div class="card-header">
		<i class="fas fa-chart-bar mr-1"></i>
		Jumlah Keuntungan per Hari (Daily Profit Count)
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-12">
				<select id="filter_profit_select_time">
					<option value="recently">10 hari terakhir</option>
					<option value="this_month">Bulan ini</option>
					<option value="last_month">Bulan lalu</option>
				</select>
			</div>
		</div>
	</div>
	<div class="card-body"><canvas id="bar_chart_profit" width="100%" height="40"></canvas></div>
</div>
<script>
	var profitChart;

	// Function to update chart data
	function updateprofitChart() {
		// Clear existing data
		profitChart.data.labels = [];
		profitChart.data.datasets[0].data = [];

		$.ajax({
			url : "<?= admin_url('dashboard/api/chart_profit') ?>",
			method : "GET",
			data : {
				type : $('#filter_profit_select_time').val()
			},
			success : function(data) {
				// Add new data
				data.forEach(function(datum) {
					profitChart.data.labels.push(datum.label);
					profitChart.data.datasets[0].data.push(datum.count);
				});

				// Update chart
				profitChart.update();
			}
		});
	}

	window.addEventListener('load', function() {
		// Update chart on filter change
		// Initialize chart data
		var profitData = {
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
		var profitOptions = {
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
		profitChart = new Chart(document.getElementById('bar_chart_profit').getContext('2d'), {
			type: 'bar',
			data: profitData,
			options: profitOptions
		});

		updateprofitChart();

		$('#filter_select_time').on('change', function() {
			updateprofitChart();
		});

	});
</script>
