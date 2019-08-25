<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("meeting_view")): ?>
				<a href="<?php echo base_url('meetings/viewagenda/'.$requestforaltmod->meeting_id) ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			View Request for alternative modules <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">

		<?php echo form_open(); ?>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="indexno">Index No : </label></div>
				<div class="col-md-8"><?php echo $requestforaltmod->registrationNo; ?></div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="namewithinitials">Name with Initials : </label></div>
				<div class="col-md-8"><?php echo $requestforaltmod->nameWithInitials; ?></div>
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
				<div class="col-md-4"><label for="dismodulecode">Discontinued Module Code : </label></div>
				<div class="col-md-8"><?php echo $requestforaltmod->dis_course_code; ?></div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="dismodulename">Discontinued Module Name : </label></div>
				<div class="col-md-8"><?php echo $requestforaltmod->dis_course_name; ?></div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="equmodulecode">Recommended Module Code : </label></div>
				<div class="col-md-8"><?php echo $requestforaltmod->eq_course_code; ?></div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="equmodulename">Recommended Module Name : </label></div>
				<div class="col-md-8"><?php echo $requestforaltmod->eq_course_name; ?></div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="comments">Comments : </label></div>
				<div class="col-md-8"><?php echo $requestforaltmod->comments; ?></div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="supdoc">Supporting Documents : </label></div>
				<div class="col-md-8">
					<?php if ($requestforaltmod->supportingDocuments && $requestforaltmod->supportingDocuments != ''): ?>
						<a href="<?php echo base_url('uploads/'.$requestforaltmod->supportingDocuments); ?>" target="_blank">View Document</a>
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

			<!-- chairman_forwarded_to_FAC | approve_chairman_forwarded_to_FAC_requestforaltmod -->
			<?php if ($requestforaltmod->status == 'chairman_forwarded_to_FAC'): ?>
				<?php echo form_open(); ?>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4"><label for="facdecision">FAC Decision : </label></div>
						<div class="col-md-8"><?php echo form_textarea('facdecision') ?></div>
						<div class="text-danger"><?php echo form_error('facdecision'); ?></div>
					</div>
					<div class="row">
						<?php echo form_hidden('status', 'fac_approved'); ?>
						<?php echo form_hidden('meeting_id',$requestforaltmod->meeting_id); ?>
						<button type="submit" name="approve" class="btn btn-primary pull-right">Save</button>
					</div>
				</div>
				
				<?php echo form_close(); ?>
			<?php endif ?>

		</div>
		<div class="col-md-2"></div>
	</div>





