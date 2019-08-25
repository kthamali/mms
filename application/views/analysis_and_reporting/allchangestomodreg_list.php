<hr class="hr">

<div>
	<h2 align="centre"><u>All Changes to Module Registration Information</u></h2>
</div>

<div>
	<h4><u>Late Changes to Module Registration</u></h4>

	<table id="changestomodreginmeetingTable" class="table table-striped table-bordered table-hover table-sm" cellspacing="10">
		<thead class="thead-dark">
			<tr>
				<th>Meeting Code</th>
				<th>Registration No</th>
				<th>Name</th>
				<th>Module Code</th>
				<th>Module Name</th>
				<th>Add or Drop</th>
				<th>FAC Decision</th>
			</tr>
		</thead>

		<tbody>

			<?php  foreach ($allchangestomodreg as $key => $value) {?>

				<tr>
					<td><?php echo $value->meetingCode ?></td>
					<td><?php echo $value->registrationNo ?></td>
					<td><?php echo $value->nameWithInitials ?></td>
					<td><?php echo $value->courseCode ?></td>
					<td><?php echo $value->courseName ?></td>
					<td>
						<?php if ($value->addOrDrop == "1")
						echo "Add"?>
						<?php if ($value->addOrDrop == "0")
						echo "Drop"?>
					</td>
					<td><?php echo $value->facDecision ?></td>
				</tr>
				<?php
			}

			?>

		</tbody>
	</table>
</div>