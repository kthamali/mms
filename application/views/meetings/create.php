<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("meetings_viewall")): ?>
				<a href="<?php echo base_url('meetings') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			Create Meeting <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		
		<?php echo form_open(); ?>

		<div class="form-group">
			<label for="name">Name  <span class="text-red">*</span></label>
			<?php echo form_input('name', set_value('name') , array('class' => 'form-control', 'placeholder' => 'Name', 'id' => 'name')); ?>
			<div class="text-error"><?php echo form_error('name'); ?></div>
		</div>

		<div class="form-group">
			<label for="code">Code  <span class="text-red">*</span></label>
			<?php echo form_input('code', set_value('code') , array('class' => 'form-control', 'placeholder' => 'Code', 'id' => 'code')); ?>
			<div class="text-error"><?php echo form_error('code'); ?></div>
		</div>

		<div class="form-group">
			<label for="datetimepicker">Date  <span class="text-red">*</span></label>
			<?php echo form_input('date', set_value('date') , array('class' => 'form-control', 'placeholder' => 'Date', 'id' => 'datetimepicker')); ?>
			<div class="text-error"><?php echo form_error('date'); ?></div>
		</div>

		<div class="form-group">
			<label for="venue">Venue  <span class="text-red">*</span></label>
			<?php echo form_input('venue', set_value('venue') , array('class' => 'form-control', 'placeholder' => 'Venue', 'id' => 'venue')); ?>
			<div class="text-error"><?php echo form_error('venue'); ?></div>
		</div>

		<div class="form-group">
			<?php echo form_submit('submit', 'Save' , array('class' => 'btn btn-primary pull-right')); ?>
		</div>

		<?php echo form_close(); ?>

	</div>
	<div class="col-md-3"></div>
</div>

<script type="text/javascript">

	$(document).ready(function () {
		jQuery('#datetimepicker').datetimepicker();
	});

</script>