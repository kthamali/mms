<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("userprofile_view")): ?>
				<a href="<?php echo base_url('user_profile') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			Change Password <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<?php echo form_open(); ?>
<div class="row">
	<div class="col-md-3"></div>

	<div class="col-md-6">
		<div class="form-group">
			<label for="password">Password  <span class="text-red">*</span></label>
			<?php echo form_password('password', set_value('password') , array('class' => 'form-control', 'placeholder' => 'Password', 'id' => 'password')); ?>
			<div class="text-error"><?php echo form_error('password'); ?></div>
		</div>

		<div class="form-group">
			<label for="conf_password">Confirm Password  <span class="text-red">*</span></label>
			<?php echo form_password('conf_password', set_value('conf_password') , array('class' => 'form-control', 'placeholder' => 'Confirm Password', 'id' => 'conf_password')); ?>
			<div class="text-error"><?php echo form_error('conf_password'); ?></div>
		</div>
		<div class="form-group">
			<?php echo form_submit('submit', "Update Password", array('class' => 'btn btn-primary pull-right')); ?>
		</div>
	</div>
	<div class="col-md-3"></div>
</div>