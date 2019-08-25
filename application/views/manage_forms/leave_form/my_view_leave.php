<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("leaveform_viewall")): ?>
				<a href="<?php echo base_url('leave_form') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			View Leave <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div>
	<a target="_blank" class="btn btn-info" href="<?php echo base_url("leave_form/leavereport/".$leave->id); ?>">Print</a>
</div>

<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">

		<?php echo form_open(); ?>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="indexno">Index No : </label></div>
				<div class="col-md-8"><?php echo $leave->registrationNo; ?></div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="namewithinitials">Name with Initials : </label></div>
				<div class="col-md-8"><?php echo $leave->nameWithInitials; ?></div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="department">Department : </label></div>
				<div class="col-md-8"><?php echo $student->departmentName; ?></div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="email">Email : </label></div>
				<div class="col-md-8"><?php echo $student->primaryEmail; ?></div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="contactno">Contact No : </label></div>
				<div class="col-md-8"><?php echo $student->currentMobile; ?></div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="appealsummary">Leave Type : </label></div>
				<div class="col-md-8"><?php echo $leave->leaveTypeName; ?></div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="appealsummary">Summary of the leave : </label></div>
				<div class="col-md-8"><?php echo $leave->summary; ?></div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="startdate">Leave start date : </label></div>
				<div class="col-md-8"><?php echo $leave->startDate; ?></div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="enddate">Leave end date : </label></div>
				<div class="col-md-8"><?php echo $leave->endDate; ?></div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="supdoc">Supporting Documents : </label></div>
				<div class="col-md-8">
					<?php if ($leave->supportingDocuments && $leave->supportingDocuments != ''): ?>
						<a href="<?php echo base_url('uploads/'.$leave->supportingDocuments); ?>" target="_blank">View Document</a>
						<?php else: ?>
							No documents uploaded !
						<?php endif ?>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<label for="supdoc">Approval History : </label>
						<table class="table">
							<tr>
								<th>Approved Person</th>
								<th>Comment</th>
								<th>Status</th>
							</tr>

							<?php foreach ($aproval_history as $key => $history): ?>
								<tr>
									<td><?php echo $history->nameWithInitials; ?></td>
									<td><?php echo $history->comment; ?></td>
									<td><?php echo $history->status; ?></td>
								</tr>
							<?php endforeach ?>
						</table>
					</div>		
				</div>
			</div>

			<?php echo form_close(); ?>

		</div>
		<div class="col-md-2"></div>
	</div>





