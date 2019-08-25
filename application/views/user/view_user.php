<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("user_viewall")): ?>
				<a href="<?php echo base_url('uom_user') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			View User <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div class="col-md-6 col-md-offset-0">
	<ul class="list-group">
		<li class="list-group-item">Id : <?php echo $uomuserData->id ?></li>
		<li class="list-group-item">Faculty : <?php echo $uomuserData->facultyName ?></li>
		<li class="list-group-item">Department : <?php echo $uomuserData->departmentName ?></li>
		<li class="list-group-item">Title : <?php echo $uomuserData->title ?></li>
		<li class="list-group-item">First name : <?php echo $uomuserData->firstName ?></li>
		<li class="list-group-item">Last name : <?php echo $uomuserData->lastName ?></li>
		<li class="list-group-item">Name with Initials : <?php echo $uomuserData->nameWithInitials ?></li>
		<li class="list-group-item">Date of Birth : <?php echo $uomuserData->dob ?></li>
		<li class="list-group-item">NIC : <?php echo $uomuserData->nic ?></li>
		<li class="list-group-item">Email : <?php echo $uomuserData->primaryEmail ?></li>
		<li class="list-group-item">Gender : <?php echo $uomuserData->gender ?></li>
		<li class="list-group-item">Username : <?php echo $uomuserData->userName ?></li>
		<li class="list-group-item">Address : <?php echo $uomuserData->permanentAddress ?></li>
		<li class="list-group-item">Telephone : <?php echo $uomuserData->permanentTelephone ?></li>
	</ul>
</div>