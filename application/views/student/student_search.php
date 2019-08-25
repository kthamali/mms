<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			Student Details <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		
		<?php echo form_open('student_search/search'); ?>

		<div class="form-group">
			<label for="studentsearch">Student Search <span class="text-red">*</span></label>
			<?php echo form_input('studentsearch', set_value('studentsearch') , array('class' => 'form-control', 'placeholder' => 'Registration Number', 'id' => 'studentsearch')); ?>
			<div class="text-error"><?php echo form_error('studentsearch'); ?></div>
		</div>

		<div class="form-group">
			<?php echo form_submit('submit', 'Search' , array('class' => 'btn btn-primary pull-right')); ?>
		</div>

		<?php echo form_close(); ?>

	</div>
	<div class="col-md-3"></div>
</div>

