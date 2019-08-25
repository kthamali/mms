<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("faculty_viewall")): ?>
				<a href="<?php echo base_url('faculty') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			View Faculty <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div class="col-md-6 col-md-offset-0">
	<ul class="list-group">
		<li class="list-group-item">Id : <?php echo $facultyData->id ?></li>
		<li class="list-group-item">Faculty Name : <?php echo $facultyData->facultyName ?></li>
	</ul>
</div>