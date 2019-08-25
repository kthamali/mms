<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("specialization_viewall")): ?>
				<a href="<?php echo base_url('specialization') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			Create New Specialization <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<?php echo form_open(); ?>

		<div class="form-group">
			<label for="specializationdescription">Specialization Description  <span class="text-red">*</span></label>
			<?php echo form_input('specializationDescription', set_value('specializationdescription') , array('class' => 'form-control', 'placeholder' => 'Specialization Description', 'id' => 'specializationdescription')); ?>
			<div class="text-error"><?php echo form_error('specializationDescription'); ?></div>
		</div>

		<div class="form-group">
			<label for="degreeId">Degree  <span class="text-red">*</span></label>
			<?php echo form_dropdown('degreeId', $degree_dropdown, set_value('degreeId', ''), array('class'=> 'form-control')); ?>
			<div class="text-error"><?php echo form_error('degreeId'); ?></div>
		</div>

		<div class="form-group">
			<?php echo form_submit('submit', 'Save' , array('class' => 'btn btn-primary pull-right')); ?>
		</div>

		<?php echo form_close(); ?>
	</div>
	<div class="col-md-3"></div>
</div>