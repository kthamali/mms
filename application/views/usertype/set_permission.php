<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("usertype_viewall")): ?>
				<a href="<?php echo base_url('user_type') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			Set Permissions <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div>	
	<?php echo form_open(); ?>
	<table id="setpermission_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th></th>
				<th>Id</th>
				<th>Name</th>
				<th>Description</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($permission_list as $key => $permission){ ?>
				<tr>
					<td>
						<?php 
						echo form_checkbox("permissions[]", $permission->id, in_array($permission->id, $permission_id_array));
						?>
					</td>
					<td><?php echo $permission->id; ?></td>
					<td><?php echo $permission->permissionName; ?></td>
					<td><?php echo $permission->permissionDescription; ?></td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
	<div class="text-right">
		<?php 
		echo form_submit('save', "Set Permissions", array('class' => 'btn btn-success' ));
		?>
	</div>
	<?php echo form_close(); ?>
</div>