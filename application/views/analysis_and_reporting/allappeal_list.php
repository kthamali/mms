<hr class="hr">

<div>
	<h2 align="centre"><u>All Appeal Information</u></h2>
</div>

<div>
	<h4><u>Appeals</u></h4>

	<table id="appealinmeetingTable" class="table table-striped table-bordered table-hover table-sm" cellspacing="10">
		<thead class="thead-dark">
			<tr>
				<th>Meeting Code</th>
				<th>Registration No</th>
				<th>Name</th>
				<th>Appeal In Brief</th>
				<th>FAC Decision</th>
			</tr>
		</thead>

		<tbody>

			<?php  foreach ($allappeal as $key => $value) {?>

				<tr>
					<td><?php echo $value->meetingCode ?></td>
					<td><?php echo $value->registrationNo ?></td>
					<td><?php echo $value->nameWithInitials ?></td>
					<td><?php echo $value->appealInBrief ?></td>
					<td><?php echo $value->facDecision ?></td>
				</tr>
				<?php
			}

			?>

		</tbody>
	</table>
</div>