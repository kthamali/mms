<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("permission_create")): ?>
				<a href="<?php echo base_url('permissions/create') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-plus fa-fw"></i>&nbsp; Add Permission
				</a>
			<?php endif ?>

			Permission <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>


<div>

	<?php 
	if($this->session->flashdata('success')){
		?>
		<div class="alert alert-success" role="alert">
			<?php echo $this->session->flashdata('success'); ?>
		</div>
		<?php
	}
	?>

	<?php 
	if($this->session->flashdata('error')){
		?>
		<div class="alert alert-danger" role="alert">
			<?php echo $this->session->flashdata('error'); ?>
		</div>
		<?php
	}
	?>

	<table id="permission_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
		<thead >
			<tr>
				<th>Id</th>
				<th>Permission Name</th>
				<th>Permission Code</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>

			<?php  foreach ($permission_list as $key => $value) {?>

				<tr>
					<td><?php echo $value->id ?></td>
					<td><?php echo $value->permissionName ?></td>
					<td><?php echo $value->code ?></td>
					<td>

						<?php if ($this->permission->has_permission("permission_view")): ?>
							<a class='btn btn-sm btn-info' title="View Permission" href="<?php echo base_url("permissions/view/".$value->id); ?>"'><i class="fa fa-eye fa-fw"></i></a>
						<?php endif ?>

						<?php if ($this->permission->has_permission("permission_update")): ?>
							<a class='btn btn-sm btn-primary' title="Update Permission" href='<?php echo base_url("permissions/update/".$value->id); ?>'><i class="fa fa-pencil fa-fw"></i></a>
						<?php endif ?>

						<?php if ($this->permission->has_permission("permission_delete")): ?>
							<a class='btn btn-sm btn-danger' title="Delete Permission" href='<?php echo base_url("permissions/delete/".$value->id); ?>' onclick="return confirm('Are you sure to remove Selected Permission?')"><i class="fa fa-trash fa-fw"></i></a> 
						<?php endif ?>

					</td>

				</tr>

				<?php

			}

			?>

		</tbody>
	</table>
</div>


<script type="text/javascript">
	$(document).ready(function () {
		$("#permission_table").DataTable();
	});
</script>