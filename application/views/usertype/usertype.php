<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("usertype_create")): ?>
				<a href="<?php echo base_url('user_type/create') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-plus fa-fw"></i>&nbsp; Add User Type
				</a>
			<?php endif ?>
			User Types <small class="sub-header-custom">MMS - University of Moratuwa</small>
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

	<table id="usertype_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
		<thead >
			<tr>
				<th>Id</th>
				<th>User Type</th>
				<th>Code</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>

			<?php  foreach ($usertype_list as $key => $value) {?>

				<tr>
					<td><?php echo $value->id ?></td>
					<td><?php echo $value->userTypeDescription ?></td>
					<td><?php echo $value->code ?></td>
					<td>

						<?php if ($this->permission->has_permission("usertype_view")): ?>
							<a class='btn btn-sm btn-info' title="View User Type" href="<?php echo base_url("user_type/view/".$value->id); ?>"'><i class="fa fa-eye fa-fw"></i></a>
						<?php endif ?>

						<?php if ($this->permission->has_permission("usertype_update")): ?>
							<a class='btn btn-sm btn-primary' title="Update User Type" href='<?php echo base_url("user_type/update/".$value->id); ?>'><i class="fa fa-pencil fa-fw"></i></a>
						<?php endif ?>

						<?php if ($this->permission->has_permission("usertype_delete")): ?>
							<a class='btn btn-sm btn-danger' title="Delete UserType" href='<?php echo base_url("user_type/delete/".$value->id); ?>' onclick="return confirm('Are you sure to remove Selected User Type?')"><i class="fa fa-trash fa-fw"></i></a> 
						<?php endif ?>

						<?php if ($this->permission->has_permission("permission_set")): ?>
							<a class='btn btn-sm btn-info' title="Set Permission" href='<?php echo base_url("user_type/set_permission/".$value->id); ?>'><i class="fa fa-pencil-square-o fa-fw"></i></a> 
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
		$("#usertype_table").DataTable();
	});
</script>