<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("academicyear_viewall")): ?>
				<a href="<?php echo base_url('academic_year') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			View Academic Year <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div class="col-md-6 col-md-offset-0">
	<ul class="list-group">
		<li class="list-group-item">Id : <?php echo $academicyearData->id ?></li>
		<li class="list-group-item">Academic Year Description : <?php echo $academicyearData->academicYearDescription ?></li>
		<li class="list-group-item">Academic Year Code : <?php echo $academicyearData->academicYearCode ?></li>
		<li class="list-group-item">Intake : <?php echo $academicyearData->intake ?></li>
	</ul>
</div>