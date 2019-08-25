<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("department_create")): ?>
				<a href="<?php echo base_url('department/create') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-plus fa-fw"></i>&nbsp; Add Department
				</a>
			<?php endif ?>
			Department <small class="sub-header-custom">MMS - University of Moratuwa</small>
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
	
	<table id="department_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
		<thead >
			<tr>
				<th>Id</th>
				<th>Department Name</th>
				<th>Department Code</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>

			<?php  foreach ($department_list as $key => $value) {?>

				<tr>
					<td><?php echo $value->id ?></td>
					<td><?php echo $value->departmentName ?></td>
					<td><?php echo $value->departmentCode ?></td>
					<td>

						<?php if ($this->permission->has_permission("department_view")): ?>
							<a class='btn btn-sm btn-info' title="View Department" href="<?php echo base_url("department/view/".$value->id); ?>"'><i class="fa fa-eye fa-fw"></i></a>
						<?php endif ?>

						<?php if ($this->permission->has_permission("department_update")): ?>
							<a class='btn btn-sm btn-primary' title="Update Department" href='<?php echo base_url("department/update/".$value->id); ?>'><i class="fa fa-pencil fa-fw"></i></a>
						<?php endif ?>

						<?php if ($this->permission->has_permission("department_delete")): ?>

							<a class='btn btn-sm btn-danger' title="Delete Department" href='<?php echo base_url("department/delete/".$value->id); ?>' onclick="return confirm('Are you sure to remove Selected Department?')"><i class="fa fa-trash fa-fw"></i></a> 
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
		$("#department_table").DataTable();
	});
</script>