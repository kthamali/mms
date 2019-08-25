<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("level_viewall")): ?>
				<a href="<?php echo base_url('level') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			View Level <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div class="col-md-6 col-md-offset-0">
	<ul class="list-group">
		<li class="list-group-item">Id : <?php echo $levelData->id ?></li>
		<li class="list-group-item">Level Description : <?php echo $levelData->levelDescription ?></li>
		<li class="list-group-item">Constant : <?php echo $levelData->constant ?></li>
	</ul>
</div>