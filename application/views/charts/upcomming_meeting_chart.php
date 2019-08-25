<div class="row">
	<div class="col-md-12">
		<div style="padding: 20px" id="upcomming_meeting_details">
			
		</div>
		<div id="upcomming_meeting"></div>
	</div>
</div>

<script type="text/javascript">
	
	$(document).ready(function () {

		$.ajax({
			type : "GET",
			url : "<?php echo base_url('/chart_data/UpCommingMeeting'); ?>",
			dataType : 'json',
			success : function (response) {

				var upcomming_meeting = response.upcomming_meeting

				if (upcomming_meeting) {
					$("#upcomming_meeting_details").addClass('alert alert-info');
					$("#upcomming_meeting_details").html(`<h4>${upcomming_meeting.meetingCode} : ${upcomming_meeting.name}</h4>
						<span class="small">Venue : ${upcomming_meeting.venue}</span><br>
						<span class="small">Time : <span class="text-muted">${upcomming_meeting.meetingDate}</span> </span> `);
				}else{
					$("#upcomming_meeting_details").addClass('alert alert-info');
					$("#upcomming_meeting_details").html('No upcomming event');
				}

				// Build the chart
				Highcharts.chart('upcomming_meeting', {
					chart: {
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false,
						type: 'pie'
					},
					title: {
						text: 'Upcomming Meeting Analysis'
					},
					tooltip: {
						pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: false
							},
							showInLegend: true
						}
					},
					series: [{
						name: 'Brands',
						colorByPoint: true,
						data: response.chart_data
					}]
				});
			},
			error : function (error) {
				console.log(error);
			}
		});
	});

</script>