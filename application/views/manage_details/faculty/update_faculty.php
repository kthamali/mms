<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("faculty_viewall")): ?>
				<a href="<?php echo base_url('faculty') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			Update Faculty <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<?php echo form_open(); ?>

		<div class="form-group">
			<label for="facultyname">Faculty Name  <span class="text-red">*</span></label>
			<?php echo form_input('facultyName', set_value('facultyname',$faculty_details->facultyName) , array('class' => 'form-control', 'placeholder' => 'Faculty Name', 'id' => 'facultyname')); ?>
			<div class="text-error"><?php echo form_error('facultyName'); ?></div>
		</div>

		<div class="form-group">
			<?php echo form_submit('submit', 'Update' , array('class' => 'btn btn-primary pull-right')); ?>
		</div>
		
		<?php echo form_close(); ?>
	</div>
	<div class="col-md-3"></div>
</div>