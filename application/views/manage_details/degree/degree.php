<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("degree_create")): ?>
				<a href="<?php echo base_url('degree/create') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-plus fa-fw"></i>&nbsp; Add Degree
				</a>
			<?php endif ?>
			Degree <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div>
	<!-- display success message -->
	<?php 
	if($this->session->flashdata('success')){
		?>
		<div class="alert alert-success" role="alert">
			<?php echo $this->session->flashdata('success'); ?>
		</div>
		<?php
	}
	?>
	
	<!-- display data table -->
	<table id="degree_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
		<thead >
			<tr>
				<th>Id</th>
				<th>Degree Description</th>
				<th>Print Name</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>

			<?php  foreach ($degree_list as $key => $value) {?>

				<tr>
					<td><?php echo $value->id ?></td>
					<td><?php echo $value->degreeDescription ?></td>
					<td><?php echo $value->printName ?></td>
					<td>

						<!-- view data -->
						<?php if ($this->permission->has_permission("degree_view")): ?>
							<a class='btn btn-sm btn-info' title="View Degree" href="<?php echo base_url("degree/view/".$value->id); ?>"'><i class="fa fa-eye fa-fw"></i></a>
						<?php endif ?>

						<!-- update data -->
						<?php if ($this->permission->has_permission("degree_update")): ?>
							<a class='btn btn-sm btn-primary' title="Update Degree" href='<?php echo base_url("degree/update/".$value->id); ?>'><i class="fa fa-pencil fa-fw"></i></a>
						<?php endif ?>

						<!-- delete data -->
						<?php if ($this->permission->has_permission("degree_delete")): ?>

							<a class='btn btn-sm btn-danger' title="Delete Degree" href='<?php echo base_url("degree/delete/".$value->id); ?>' onclick="return confirm('Are you sure to remove Selected Degree?')"><i class="fa fa-trash fa-fw"></i></a> 
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
		$("#degree_table").DataTable();
	});
</script>