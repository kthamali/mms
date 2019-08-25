<style type="text/css">
.sub-heading{
	padding: 5px 10px;
}
</style>

<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("meetings_viewall")): ?>
				<a href="<?php echo base_url('meetings') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			View Minutes of the Meeting <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div>
	<a target="_blank" class="btn btn-info" href="<?php echo base_url("meetings/minutereport/".$meetingsData->id); ?>">Print</a>
</div>

<div>
	<h4 class="bg bg-info sub-heading"><?php echo $meetingsData->meetingCode. " - " . $meetingsData->name. " - " . $meetingsData->meetingDate; ?></h4>
</div>

<div>
	<h4 class="bg bg-info sub-heading">Alternative Modules for Discontinued Modules</h4>

	<table id="requesttoaltmodinmeeting_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
		<thead >
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
	<h4 class="bg bg-info sub-heading">Late Changes to Module Registration</h4>

	<table id="changestomodreginmeeting_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
		<thead >
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
	<h4 class="bg bg-info sub-heading">Leaves</h4>

	<table id="leaveinmeeting_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
		<thead >
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
	<h4 class="bg bg-info sub-heading">Appeals</h4>

	<table id="appealinmeeting_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
		<thead >
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
	<h4 class="bg bg-info sub-heading">Curriculum Revisions</h4>

	<table id="curriculuminmeeting_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
		<thead >
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