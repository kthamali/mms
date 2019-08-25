<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("user_create")): ?>
				<a href="<?php echo base_url('uom_user/create') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-plus fa-fw"></i>&nbsp; Add User
				</a>
			<?php endif ?>
			User Management <small class="sub-header-custom">MMS - University of Moratuwa</small>
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

	<table id="uomuser_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
		<thead >
			<tr>
				<th>Id</th>
				<th>Username</th>
				<th>Name With Initials</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php  foreach ($uomuser_list as $key => $value) {?>
				<tr>
					<td><?php echo $value->id ?></td>
					<td><?php echo $value->userName ?></td>
					<td><?php echo $value->nameWithInitials ?></td>
					<td>
						<?php if ($this->permission->has_permission("user_view")): ?>
							<a class='btn btn-sm btn-info' title="View UomUser" href="<?php echo base_url("uom_user/view/".$value->id); ?>"'><i class="fa fa-eye fa-fw"></i></a>
						<?php endif ?>	

						<?php if ($this->permission->has_permission("user_update")): ?>
							<a class='btn btn-sm btn-primary' title="Update UomUser" href="<?php echo base_url("uom_user/update/".$value->id); ?>"'><i class="fa fa-pencil"></i></a>
						<?php endif ?> 

						<?php if ($this->permission->has_permission("user_delete")): ?>
							<a class='btn btn-sm btn-danger' title="Delete UomUser" href='<?php echo base_url("uom_user/delete/".$value->id); ?>' onclick="return confirm('Are you sure to remove Selected User?')"><i class="fa fa-trash fa-fw"></i></a> 
						<?php endif ?>

						<?php if ($this->permission->has_permission("usertype_set")): ?>
							<a class='btn btn-sm btn-info' title="Set User Type" href='<?php echo base_url("uom_user/set_usertype/".$value->id); ?>'><i class="fa fa-pencil-square-o fa-fw"></i></a> 
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
		$("#uomuser_table").DataTable();
	});
</script>