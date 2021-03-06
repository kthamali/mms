<hr class="hr">

<div>
	<h2 align="centre"><u>Minutes of the Meeting</u></h2>
</div>

<div>
	<h4><?php echo $meetingsData->meetingCode. " - " . $meetingsData->name. " - " . $meetingsData->meetingDate; ?></h4>
</div>

<div>
	<h4><u>Alternative Modules for Discontinued Modules</u></h4>

	<table id="requesttoaltmodinmeetingTable" class="table table-striped table-bordered table-hover table-sm" cellspacing="10">
		<thead class="thead-dark">
			<tr>
				<th>Dept.</th>
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

			<?php  foreach ($requesttoaltmodinmeetingData as $key => $value) {?>

				<tr>
					<td><?php echo $value->departmentCode ?></td>
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

<div>
	<h4><u>Late Changes to Module Registration</u></h4>

	<table id="changestomodreginmeetingTable" class="table table-striped table-bordered table-hover table-sm" cellspacing="10">
		<thead class="thead-dark">
			<tr>
				<th>Dept.</th>
				<th>Registration No</th>
				<th>Name</th>
				<th>Module Code</th>
				<th>Module Name</th>
				<th>Add or Drop</th>
				<th>FAC Decision</th>
			</tr>
		</thead>

		<tbody>

			<?php  foreach ($changestomodreginmeetingData as $key => $value) {?>

				<tr>
					<td><?php echo $value->departmentCode ?></td>
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

<div>
	<h4><u>Leaves</u></h4>

	<table id="leaveinmeetingTable" class="table table-striped table-bordered table-hover table-sm" cellspacing="10">
		<thead class="thead-dark">
			<tr>
				<th>Dept.</th>
				<th>Registration No</th>
				<th>Name</th>
				<th>Leave Start Date</th>
				<th>Leave End Date</th>
				<th>Leave Type</th>
				<th>Reason</th>
				<th>FAC Decision</th>
			</tr>
		</thead>

		<tbody>

			<?php  foreach ($leaveinmeetingData as $key => $value) {?>

				<tr>
					<td><?php echo $value->departmentCode ?></td>
					<td><?php echo $value->registrationNo ?></td>
					<td><?php echo $value->nameWithInitials ?></td>
					<td><?php echo $value->startDate ?></td>
					<td><?php echo $value->endDate ?></td>
					<td><?php echo $value->leaveTypeName ?></td>
					<td><?php echo $value->summary ?></td>
					<td><?php echo $value->facDecision ?></td>
				</tr>
				<?php
			}

			?>

		</tbody>
	</table>
</div>

<div>
	<h4><u>Appeals</u></h4>

	<table id="appealinmeetingTable" class="table table-striped table-bordered table-hover table-sm" cellspacing="10">
		<thead class="thead-dark">
			<tr>
				<th>Dept.</th>
				<th>Registration No</th>
				<th>Name</th>
				<th>Appeal In Brief</th>
				<th>FAC Decision</th>
			</tr>
		</thead>

		<tbody>

			<?php  foreach ($appealinmeetingData as $key => $value) {?>

				<tr>
					<td><?php echo $value->departmentCode ?></td>
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

<div>
	<h4><u>Curriculum Revisions</u></h4>

	<table id="curriculuminmeetingTable" class="table table-striped table-bordered table-hover table-sm" cellspacing="10">
		<thead class="thead-dark">
			<tr>
				<th>Dept.</th>
				<th>Description</th>
				<th>FAC Decision</th>
			</tr>
		</thead>

		<tbody>

			<?php  foreach ($curriculuminmeetingData as $key => $value) {?>

				<tr>
					<td><?php echo $value->departmentCode ?></td>
					<td><?php echo $value->curriculamDescription ?></td>
					<td><?php echo $value->facDecision ?></td>
				</tr>
				<?php
			}

			?>

		</tbody>
	</table>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div>
	..............................
	<div>
		Convener
	</div>
						
</div>