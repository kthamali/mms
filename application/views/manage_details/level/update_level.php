<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("level_viewall")): ?>
				<a href="<?php echo base_url('level') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			Update Level <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		
		<?php echo form_open(); ?>

		<div class="form-group">
			<label for="leveldescription">Level Description  <span class="text-red">*</span></label>
			<?php echo form_input('levelDescription', set_value('leveldescription',$level_details->levelDescription) , array('class' => 'form-control', 'placeholder' => 'Level Description', 'id' => 'leveldescription')); ?>
			<div class="text-error"><?php echo form_error('levelDescription'); ?></div>
		</div>

		<div class="form-group">
			<label for="constant">Constant  <span class="text-red">*</span></label>
			<?php echo form_input('constant', set_value('constant',$level_details->constant) , array('class' => 'form-control', 'placeholder' => 'Constant', 'id' => 'constant')); ?>
			<div class="text-error"><?php echo form_error('constant'); ?></div>
		</div>

		<div class="form-group">
			<?php echo form_submit('submit', 'Update' , array('class' => 'btn btn-primary pull-right')); ?>
		</div>

		<?php echo form_close(); ?>

	</div>
	<div class="col-md-3"></div>
</div>