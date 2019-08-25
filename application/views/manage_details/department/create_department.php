<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("department_viewall")): ?>
				<a href="<?php echo base_url('department') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			Create New Department <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		
		<?php echo form_open(); ?>

		<div class="form-group">
			<label for="departmentName">Department Name <span class="text-red">*</span></label>
			<?php echo form_input('departmentName', set_value('departmentname') , array('class' => 'form-control', 'placeholder' => 'Department Name', 'id' => 'departmentname')); ?>
			<div class="text-error"><?php echo form_error('departmentName'); ?></div>
		</div>

		<div class="form-group">
			<label for="departmentCode">Department Code <span class="text-red">*</span></label>
			<?php echo form_input('departmentCode', set_value('departmentcode') , array('class' => 'form-control', 'placeholder' => 'Department Code', 'id' => 'departmentcode')); ?>
			<div class="text-error"><?php echo form_error('departmentCode'); ?></div>
		</div>

		<div class="form-group">
			<label for="offerModules">Offer Modules <span class="text-red">*</span></label>
			<?php echo form_input('offerModules', set_value('offermodules') , array('class' => 'form-control', 'placeholder' => 'Offer Modules', 'id' => 'offermodules')); ?>
			<div class="text-error"><?php echo form_error('offerModules'); ?></div>
		</div>

		<div class="form-group">
			<label for="facultyId">Faculty <span class="text-red">*</span></label>
			<?php echo form_dropdown('facultyId', $faculty_dropdown, set_value('facultyId', ''), array('class'=> 'form-control')); ?>
			<div class="text-error"><?php echo form_error('facultyId'); ?></div>
		</div>

		<div class="form-group">
			<?php echo form_submit('submit', 'Save' , array('class' => 'btn btn-primary pull-right')); ?>
		</div>

		<?php echo form_close(); ?>

	</div>
	<div class="col-md-3"></div>
</div>