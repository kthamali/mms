<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("academicyear_viewall")): ?>
				<a href="<?php echo base_url('academic_year') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			Update Academic Year <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<?php echo form_open(); ?>

		<div class="form-group">
			<label for="academicyeardescription">Academic Year Description  <span class="text-red">*</span></label>
			<?php echo form_input('academicYearDescription', set_value('academicyeardescription',$academicyear_details->academicYearDescription) , array('class' => 'form-control', 'placeholder' => 'Academic Year Description', 'id' => 'academicyeardescription')); ?>
			<div class="text-error"><?php echo form_error('academicYearDescription'); ?></div>
		</div>

		<div class="form-group">
			<label for="academicyearcode">Academic Year Code  <span class="text-red">*</span></label>
			<?php echo form_input('academicYearCode', set_value('academicyearcode',$academicyear_details->academicYearCode) , array('class' => 'form-control', 'placeholder' => 'Academic Year Code', 'id' => 'academicyearcode')); ?>
			<div class="text-error"><?php echo form_error('academicYearCode'); ?></div>
		</div>

		<div class="form-group">
			<label for="intake">Intake  <span class="text-red">*</span></label>
			<?php echo form_input('intake', set_value('intake',$academicyear_details->intake) , array('class' => 'form-control', 'placeholder' => 'Intake', 'id' => 'intake')); ?>
			<div class="text-error"><?php echo form_error('intake'); ?></div>
		</div>

		<div class="form-group">
			<?php echo form_submit('submit', 'Update' , array('class' => 'btn btn-primary pull-right')); ?>
		</div>

		<?php echo form_close(); ?>
	</div>
	<div class="col-md-3"></div>
</div>