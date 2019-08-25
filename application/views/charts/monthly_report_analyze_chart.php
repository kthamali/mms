<div class="row">
	<div class="col-md-12">
		<div id="monthly_report_analyziz_chart"></div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {


		$.ajax({
			type : "GET",
			url : "<?php echo base_url('/chart_data/GetYearlyDataAnalysisChartData'); ?>",
			dataType : 'json',
			success : function (response) {
				console.log(response);

				Highcharts.chart('monthly_report_analyziz_chart', {
					chart: {
						type: 'column'
					},
					title: {
						text: 'Student Request Analysis Data'
					},
					subtitle: {
						text: ''
					},
					xAxis: {
						categories: response.months,
						crosshair: true
					},
					yAxis: {
						min: 0,
						title: {
							text: 'Count'
						}
					},
					tooltip: {
						headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
						pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						'<td style="padding:0"><b>{point.y}</b></td></tr>',
						footerFormat: '</table>',
						shared: true,
						useHTML: true
					},
					plotOptions: {
						column: {
							pointPadding: 0.2,
							borderWidth: 0
						}
					},
					series: response.chart_data,
					credits: {
						enabled: false
					}
				});

			}, 
			error : function (error) {
				console.log(error);
			}
		});
	});


</script>