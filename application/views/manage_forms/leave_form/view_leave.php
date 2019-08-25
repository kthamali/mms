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

			<!-- pending | approve_pending_leaves -->
			<?php if ($leave->status == 'pending' && $this->permission->has_permission("approve_pending_leaves")): ?>
				<?php echo form_open(); ?>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4"><label for="comments">Comments : </label></div>
						<div class="col-md-8"><?php echo form_textarea('comment') ?></div>
						<div class="text-danger"><?php echo form_error('comment'); ?></div>
					</div>
					<div class="row">
						<?php echo form_hidden('status', 'semester_coordinator_recommended'); ?>
						<button type="submit" name="recommend" class="btn btn-primary pull-right">Recommend</button>
					</div>
				</div>
				<?php echo form_close(); ?>
			<?php endif ?>

			<!-- semester_coordinator_recommended | approve_semester_coordinator_approved_leaves -->
			<?php if ($leave->status == 'semester_coordinator_recommended' && $this->permission->has_permission("approve_semester_coordinator_approved_leaves")): ?>
				<?php echo form_open(); ?>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4"><label for="comments">Comments : </label></div>
						<div class="col-md-8"><?php echo form_textarea('comment') ?></div>
						<div class="text-danger"><?php echo form_error('comment'); ?></div>
					</div>
					<div class="row">
						<?php echo form_hidden('status', 'hod_recommended'); ?>
						<button type="submit" name="recommend" class="btn btn-primary pull-right">Recommend</button>
					</div>
				</div>
				<?php echo form_close(); ?>
			<?php endif ?>

			<!-- hod_recommended | approve_hod_approved_leaves -->
			<?php if ($leave->status == 'hod_recommended' && $this->permission->has_permission("approve_hod_approved_leaves")): ?>
				<?php echo form_open(); ?>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4"><label for="comments">Comments : </label></div>
						<div class="col-md-8"><?php echo form_textarea('comment') ?></div>
						<div class="text-danger"><?php echo form_error('comment'); ?></div>
					</div>
					<div class="row">
						<?php echo form_hidden('status', 'fac_rep_recommended'); ?>
						<button type="submit" name="recommend" class="btn btn-primary pull-right">Recommend</button>
					</div>
				</div>
				<?php echo form_close(); ?>
			<?php endif ?>


			<!-- fac_rep_recommended | approve_fac_approved_leaves -->
			<?php if ($leave->status == 'fac_rep_recommended' && $this->permission->has_permission("approve_fac_approved_leaves")): ?>
				<?php echo form_open(); ?>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4"><label for="comments">Comments : </label></div>
						<div class="col-md-8">
							<?php echo form_textarea('comment', set_value('comment', ''), array('class' => 'form-control')) ?>
							<div class="text-danger"><?php echo form_error('comment'); ?></div>
						</div>
						<div class="row">
							<div class="col-md-4"><label for="meeting">Meeting : </label></div>
							<?php echo form_hidden('status', 'chairman_forwarded_to_FAC'); ?>
							<div class="col-md-8">
								<?php echo form_dropdown('meeting_id', $meeting_dropdown, set_value('meeting_id'),  array('class' => 'form-control' )); ?>
								<div class="text-danger"><?php echo form_error('meeting_id'); ?></div>
							</div>
							<button type="submit" name="recommend" class="btn btn-primary pull-right">Recommend</button>

							<button type="submit" name="reject" class="btn btn-danger pull-right">Reject</button>
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>
			<?php endif ?>

		</div>
		<div class="col-md-2"></div>
	</div>