<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("department_viewall")): ?>
				<a href="<?php echo base_url('department') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			View Department <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div class="col-md-6 col-md-offset-0">
	<ul class="list-group">
		<li class="list-group-item">Id : <?php echo $departmentData->id ?></li>
		<li class="list-group-item">Department Name : <?php echo $departmentData->departmentName ?></li>
		<li class="list-group-item">Department Code : <?php echo $departmentData->departmentCode ?></li>
		<li class="list-group-item">Offer Modules : <?php echo $departmentData->offerModules ?></li>
		<li class="list-group-item">Faculty Id : <?php echo $departmentData->faculty_id ?></li>
	</ul>
</div>