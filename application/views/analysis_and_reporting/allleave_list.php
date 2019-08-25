<hr class="hr">

<div>
	<h2 align="centre"><u>All Leave Information</u></h2>
</div>

<div>
	<h4><u>Leaves</u></h4>

	<table id="leaveinmeetingTable" class="table table-striped table-bordered table-hover table-sm" cellspacing="10">
		<thead class="thead-dark">
			<tr>
				<th>Meeting Code</th>
				<th>Registration No</th>
				<th>Name</th>
				<th>Leave Start Date</th>
				<th>Leave End Date</th>
				<th>Reason</th>
				<th>FAC Decision</th>
			</tr>
		</thead>

		<tbody>

			<?php  foreach ($allleave as $key => $value) {?>

				<tr>
					<td><?php echo $value->meetingCode ?></td>
					<td><?php echo $value->registrationNo ?></td>
					<td><?php echo $value->nameWithInitials ?></td>
					<td><?php echo $value->startDate ?></td>
					<td><?php echo $value->endDate ?></td>
					<td><?php echo $value->summary ?></td>
					<td><?php echo $value->facDecision ?></td>
				</tr>
				<?php
			}

			?>

		</tbody>
	</table>
</div>