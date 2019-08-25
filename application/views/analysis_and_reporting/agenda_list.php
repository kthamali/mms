<hr class="hr">

<div>
	<h2 align="centre"><u>Agenda of the Meeting</u></h2>
</div>

<div>
	<h4><?php echo $meetingsData->meetingCode. " - " . $meetingsData->name. " - " . $meetingsData->meetingDate; ?>am</h4>
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
						</tr>
						<?php
					}

					?>

				</tbody>
			</table>
		</div>

		<div>
			<h4><u>Leaves</u></h4>

			<table id="leaveinmeeting_table" class="table table-striped table-bordered table-hover table-sm" cellspacing="10">
				<thead class="thead-dark">
					<tr>
						<th>Dept.</th>
						<th>Registration No</th>
						<th>Name</th>
						<th>Leave Start Date</th>
						<th>Leave End Date</th>
						<th>Leave Type</th>
						<th>Reason</th>
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
						</tr>
						<?php
					}

					?>

				</tbody>
			</table>
		</div>

		<div>
			<h4><u>Appeals</u></h4>

			<table id="appealinmeeting_table" class="table table-striped table-bordered table-hover table-sm" cellspacing="10">
				<thead class="thead-dark">
					<tr>
						<th>Dept.</th>
						<th>Registration No</th>
						<th>Name</th>
						<th>Appeal In Brief</th>
					</tr>
				</thead>

				<tbody>

					<?php  foreach ($appealinmeetingData as $key => $value) {?>

						<tr>
							<td><?php echo $value->departmentCode ?></td>
							<td><?php echo $value->registrationNo ?></td>
							<td><?php echo $value->nameWithInitials ?></td>
							<td><?php echo $value->appealInBrief ?></td>
						</tr>
						<?php
					}

					?>

				</tbody>
			</table>
		</div>

		<div>
			<h4><u>Curriculum Revisions</u></h4>

			<table id="curriculuminmeeting_table" class="table table-striped table-bordered table-hover table-sm" cellspacing="10">
				<thead class="thead-dark">
					<tr>
						<th>Dept.</th>
						<th>Description</th>
					</tr>
				</thead>

				<tbody>

					<?php  foreach ($curriculuminmeetingData as $key => $value) {?>

						<tr>
							<td><?php echo $value->departmentCode ?></td>
							<td><?php echo $value->curriculamDescription ?></td>
						</tr>
						<?php
					}

					?>

				</tbody>
			</table>
		</div>