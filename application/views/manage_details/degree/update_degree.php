<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("degree_viewall")): ?>
				<a href="<?php echo base_url('degree') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			Update Degree <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<?php echo form_open(); ?>

		<div class="form-group">
			<label for="degreedescription">Degree Description  <span class="text-red">*</span></label>
			<?php echo form_input('degreeDescription', set_value('degreedescription',$degree_details->degreeDescription) , array('class' => 'form-control', 'placeholder' => 'Degree Description', 'id' => 'degreedescription')); ?>
			<div class="text-error"><?php echo form_error('degreeDescription'); ?></div>
		</div>

		<div class="form-group">
			<label for="intake">Intake  <span class="text-red">*</span></label>
			<?php echo form_input('intake', set_value('intake',$degree_details->intake) , array('class' => 'form-control', 'placeholder' => 'Intake', 'id' => 'intake')); ?>
			<div class="text-error"><?php echo form_error('intake'); ?></div>
		</div>

		<div class="form-group">
			<label for="printname">Print Name  <span class="text-red">*</span></label>
			<?php echo form_input('printName', set_value('printname',$degree_details->printName) , array('class' => 'form-control', 'placeholder' => 'Print Name', 'id' => 'printname')); ?>
			<div class="text-error"><?php echo form_error('printName'); ?></div>
		</div>

		<div class="form-group">
			<label for="active">Active  <span class="text-red">*</span></label>
			<?php echo form_input('active', set_value('active',$degree_details->active) , array('class' => 'form-control', 'placeholder' => 'Active', 'id' => 'active')); ?>
			<div class="text-error"><?php echo form_error('active'); ?></div>
		</div>

		<div class="form-group">
			<label for="facultyId">Faculty  <span class="text-red">*</span></label>
			<?php echo form_dropdown('facultyId', $faculty_dropdown, set_value('facultyId', $degree_details->faculty_id), array('class'=> 'form-control')); ?>
			<div class="text-error"><?php echo form_error('facultyId'); ?></div>
		</div>

		<div class="form-group">
			<?php echo form_submit('submit', 'Update' , array('class' => 'btn btn-primary pull-right')); ?>
		</div>

		<?php echo form_close(); ?>
	</div>
	<div class="col-md-3"></div>
</div>