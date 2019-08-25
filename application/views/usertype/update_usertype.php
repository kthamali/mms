<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("usertype_viewall")): ?>
				<a href="<?php echo base_url('user_type') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			Update User Type<small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<?php echo form_open(); ?>

		<div class="form-group">
			<label for="usertypedescription">User Type Description <span class="text-red">*</span></label>
			<?php echo form_input('userTypeDescription', set_value('usertypedescription', $usertype_details->userTypeDescription) , array('class' => 'form-control', 'placeholder' => 'User Type', 'id' => 'usertypedescription')); ?>
			<div class="text-error"><?php echo form_error('userTypeDescription'); ?></div>
		</div>

		<div class="form-group">
			<label for="code">Code <span class="text-red">*</span></label>
			<?php echo form_input('code', set_value('code' , $usertype_details->code) , array('class' => 'form-control', 'placeholder' => 'Code', 'id' => 'code')); ?>
			<div class="text-error"><?php echo form_error('code'); ?></div>
		</div>

		<div class="form-group">
			<?php echo form_submit('submit', 'Update' , array('class' => 'btn btn-primary pull-right')); ?>
		</div>

		<?php echo form_close(); ?>
	</div>
	<div class="col-md-3"></div>
</div>