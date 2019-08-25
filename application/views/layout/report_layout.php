<!DOCTYPE html>
<html>
<head>
	<title>Report View</title>

	<link rel="stylesheet" href="">

    <script type="text/javascript" src="<?php echo base_url("assets/Libraries/highchart/highcharts.js"); ?>"></script>

	<style type="text/css">
	.header,
	.footer {
		width: 100%;
		position: fixed;
	}
	.header {
		top: 0px;
		border-bottom: 1px solid #DEE2E6;
	}
	.footer {
		bottom: 0px;
		border-top: 1px solid #DEE2E6;
		text-align: right;
	}
	.pagenum:before {
		content: counter(page);
	}

	/*table{
		font-size: 10px;
	}

	td, th{
		padding: 5px;
	}
	*/

	@page { margin: 1cm 20px 1.2cm 20px; }
	body { margin: 3cm 20px 1cm 20px; }

	</style>

</head>

<body>
	<div class="header">
		<table width="100%">
			<tr>

				<td width="40%">
					<img width="100px" src="<?php echo base_url("assets/images/logo/logo.png"); ?>">
				</td>
				<td width="20%">

				</td>
				<td width="40%">
					Faculty Academic Committee <br>
					Undergraduate Studies Division <br>
					Faculty of Engineering <br>
					University of Moratuwa <br>

			</tr>
		</table>
	</div>


	<?php echo $report_view; ?>

	<div class="footer">
		Prepared by - Meeting Management System - University of Moratuwa.
		Page <span class="pagenum"></span>
	</div>
</body>
</html>