<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("studentsearch_viewall")): ?>
				<a href="<?php echo base_url('student_search') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			View Student Details <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<table id="student_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead >
		<tr>
			<th>Registration No</th>
			<th>Appeal Form Records</th>
			<th>Changes to Module Registration Form Records</th>
			<th>Leave Form Records</th>
			<th>Request for Alternative Module Form Records</th>
		</tr>
	</thead>

	<tbody>

		<tr>
			<td><?php echo $student->registrationNo ?></td>
			<td>
				<a target="_blank" class="btn btn-info" href="<?php echo base_url("student_search/appealreport/".$student->id); ?>">Print</a>
			</td>
			<td>
				<a target="_blank" class="btn btn-info" href="<?php echo base_url("student_search/changestomodregreport/".$student->id); ?>">Print</a>
			</td>
			<td>
				<a target="_blank" class="btn btn-info" href="<?php echo base_url("student_search/leavereport/".$student->id); ?>">Print</a>
			</td>
			<td>
				<a target="_blank" class="btn btn-info" href="<?php echo base_url("student_search/requesttoalrmodreport/".$student->id); ?>">Print</a>
			</td>
		</tr>

	</tbody>
</table>