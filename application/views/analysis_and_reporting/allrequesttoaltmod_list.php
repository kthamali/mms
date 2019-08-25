<hr class="hr">

<div>
	<h2 align="centre"><u>All Request for Alternative Modules Information</u></h2>
</div>

<div>
	<h4><u>Alternative Modules for Discontinued Modules</u></h4>

	<table id="requesttoaltmodinmeetingTable" class="table table-striped table-bordered table-hover table-sm" cellspacing="10">
		<thead class="thead-dark">
			<tr>
				<th>Meeting Code</th>
				<th>Registration No</th>
				<th>Name</th>
				<th>Discontinued Module Code</th>
				<th>Discontinued Module Name</th>
				<th>Recommended Module Code</th>
				<th>Recommended Module Name</th>
				<th>FAC Decision</th>
			</tr>
		</thead>

		<tbody>

			<?php  foreach ($allrequesttoaltmod as $key => $value) {?>

				<tr>
					<td><?php echo $value->meetingCode ?></td>
					<td><?php echo $value->registrationNo ?></td>
					<td><?php echo $value->nameWithInitials ?></td>
					<td><?php echo $value->dis_course_code ?></td>
					<td><?php echo $value->dis_course_name ?></td>
					<td><?php echo $value->eq_course_code ?></td>
					<td><?php echo $value->eq_course_name ?></td>
					<td><?php echo $value->facDecision ?></td>
				</tr>
				<?php
			}

			?>

		</tbody>
	</table>
</div>