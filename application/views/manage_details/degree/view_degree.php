<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("degree_viewall")): ?>
				<a href="<?php echo base_url('degree') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			View Degree <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div class="col-md-6 col-md-offset-0">
	<ul class="list-group">
		<li class="list-group-item">Id : <?php echo $degreeData->id ?></li>
		<li class="list-group-item">Degree Description : <?php echo $degreeData->degreeDescription ?></li>
		<li class="list-group-item">Intake : <?php echo $degreeData->intake ?></li>
		<li class="list-group-item">Print Name : <?php echo $degreeData->printName ?></li>
		<li class="list-group-item">Active : <?php echo $degreeData->active ?></li>
		<li class="list-group-item">Faculty Id : <?php echo $degreeData->faculty_id ?></li>
	</ul>
</div>