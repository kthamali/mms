<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("permission_viewall")): ?>
				<a href="<?php echo base_url('permissions') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			Create New Permission <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		
		<?php echo form_open(); ?>

		<div class="form-group">
			<label for="permissionName">Permission Name <span class="text-red">*</span></label>
			<?php echo form_input('permissionName', set_value('permissionname') , array('class' => 'form-control', 'placeholder' => 'Permission Name', 'id' => 'permissionname')); ?>
			<div class="text-error"><?php echo form_error('permissionName'); ?></div>
		</div>

		<div class="form-group">
			<label for="permissionDescription">Permission Description <span class="text-red">*</span></label>
			<?php echo form_input('permissionDescription', set_value('permissiondescription') , array('class' => 'form-control', 'placeholder' => 'Permission Description', 'id' => 'permissiondescription')); ?>
			<div class="text-error"><?php echo form_error('permissionDescription'); ?></div>
		</div>

		<div class="form-group">
			<label for="code">Permission Code <span class="text-red">*</span></label>
			<?php echo form_input('code', set_value('code') , array('class' => 'form-control', 'placeholder' => 'Code', 'id' => 'code')); ?>
			<div class="text-error"><?php echo form_error('code'); ?></div>
		</div>

		<div class="form-group">
			<?php echo form_submit('submit', 'Save' , array('class' => 'btn btn-primary pull-right')); ?>
		</div>

		<?php echo form_close(); ?>

	</div>
	<div class="col-md-3"></div>
</div>


