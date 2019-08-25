<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("userprofile_view")): ?>
				<a href="<?php echo base_url('user_profile') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			Update User <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		
		<?php echo form_open(); ?>

		<div class="form-group">
			<label for="title">Title  <span class="text-red">*</span></label>
			<?php echo form_input('title', set_value('title',$uomuser_details->title) , array('class' => 'form-control', 'placeholder' => 'Title', 'id' => 'title')); ?>
			<div class="text-error"><?php echo form_error('title'); ?></div>
		</div>

		<div class="form-group">
			<label for="firstname">First Name </label>
			<?php echo form_input('firstName', set_value('firstname',$uomuser_details->firstName) , array('class' => 'form-control', 'placeholder' => 'First Name', 'id' => 'firstname')); ?>
			<div class="text-error"><?php echo form_error('firstName'); ?></div>
		</div>

		<div class="form-group">
			<label for="lastname">Last Name </label>
			<?php echo form_input('lastName', set_value('lastname',$uomuser_details->lastName) , array('class' => 'form-control', 'placeholder' => 'Last Name', 'id' => 'lastname')); ?>
			<div class="text-error"><?php echo form_error('lastName'); ?></div>
		</div>

		<div class="form-group">
			<label for="datetimepicker">Date of Birth  <span class="text-red">*</span></label>
			<?php echo form_input('dob', set_value('dob',$uomuser_details->dob) , array('class' => 'form-control', 'placeholder' => 'Date of Birth', 'id' => 'datetimepicker')); ?>
			<div class="text-error"><?php echo form_error('dob'); ?></div>
		</div>

		<div class="form-group">
			<label for="permanentaddress">Address  <span class="text-red">*</span></label>
			<?php echo form_input('permanentAddress', set_value('permanentaddress',$uomuser_details->permanentAddress) , array('class' => 'form-control', 'placeholder' => 'Address', 'id' => 'permanentaddress')); ?>
			<div class="text-error"><?php echo form_error('permanentAddress'); ?></div>
		</div>

		<div class="form-group">
			<label for="permanenttelephone">Contact Number  <span class="text-red">*</span></label>
			<?php echo form_input('permanentTelephone', set_value('permanenttelephone',$uomuser_details->permanentTelephone) , array('class' => 'form-control', 'placeholder' => 'Contact Number', 'id' => 'permanenttelephone')); ?>
			<div class="text-error"><?php echo form_error('permanentTelephone'); ?></div>
		</div>

		<div class="form-group">
			<?php echo form_submit('submit', 'Update' , array('class' => 'btn btn-primary pull-right')); ?>
		</div>

		<?php echo form_close(); ?>

	</div>
	<div class="col-md-3"></div>
</div>

<script type="text/javascript">

	$(document).ready(function () {
		jQuery('#datetimepicker').datetimepicker({
			timepicker:false,
		});
	});

</script>