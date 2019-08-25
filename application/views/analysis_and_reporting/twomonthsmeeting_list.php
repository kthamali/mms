<hr class="hr">

<div>
	<h2 align="centre"><u>Meeting Details</u></h2>
</div>

<table id="meetingsTable" class="table table-striped table-bordered table-hover table-sm ">
	<thead  class="thead-dark">
		<tr>
			<th>Code</th>
			<th>Meeting name</th>
			<th>Date</th>
			<th>Venue</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>

		<?php 
		foreach ($meetings as $key => $value) {
			?>

			<tr>
				<td><?php echo $value->meetingCode ?></td>
				<td><?php echo $value->name ?></td>
				<td><?php echo $value->meetingDate ?></td>
				<td><?php echo $value->venue ?></td>
				<td><?php echo $value->status ?></td>
			</tr>

			<?php
		}
		?>

	</tbody>
</table>