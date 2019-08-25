<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("meeting_view")): ?>
				<a href="<?php echo base_url('meetings/viewagenda/'.$curriculum->meeting_id) ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			View Curriculum Revision <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">

		<?php echo form_open(); ?>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="department">Department : </label></div>
				<div class="col-md-8"><?php echo $curriculum->departmentName; ?></div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="email">Curriculum Description : </label></div>
				<div class="col-md-8"><?php echo $curriculum->curriculamDescription; ?></div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="supdoc">Supporting Documents : </label></div>
				<div class="col-md-8">
					<?php if ($curriculum->supportingDocuments && $curriculum->supportingDocuments != ''): ?>
						<a href="<?php echo base_url('uploads/'.$curriculum->supportingDocuments); ?>" target="_blank">View Document</a>
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

			<!-- chairman_forwarded_to_FAC | approve_chairman_forwarded_to_FAC_curriculum -->
			<?php if ($curriculum->status == 'chairman_forwarded_to_FAC'): ?>
				<?php echo form_open(); ?>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4"><label for="facdecision">FAC Decision : </label></div>
						<div class="col-md-8"><?php echo form_textarea('facdecision') ?></div>
						<div class="text-danger"><?php echo form_error('facdecision'); ?></div>
					</div>
					<div class="row">
						<?php echo form_hidden('status', 'fac_approved'); ?>
						<?php echo form_hidden('meeting_id',$curriculum->meeting_id); ?>
						<button type="submit" name="approve" class="btn btn-primary pull-right">Save</button>
					</div>
				</div>
				
				<?php echo form_close(); ?>
			<?php endif ?>

		</div>
		<div class="col-md-2"></div>
	</div>





