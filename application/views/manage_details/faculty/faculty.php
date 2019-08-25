<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("faculty_create")): ?>
				<a href="<?php echo base_url('faculty/create') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-plus fa-fw"></i>&nbsp; Add Faculty
				</a>
			<?php endif ?>
			Faculty <small class="sub-header-custom">MMS - University of Moratuwa</small>
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
	
	<table id="faculty_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
		<thead >
			<tr>
				<th>Id</th>
				<th>Faculty Name</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>

			<?php  foreach ($faculty_list as $key => $value) {?>

				<tr>
					<td><?php echo $value->id ?></td>
					<td><?php echo $value->facultyName ?></td>
					<td>

						<?php if ($this->permission->has_permission("faculty_view")): ?>
							<a class='btn btn-sm btn-info' title="View Faculty" href="<?php echo base_url("faculty/view/".$value->id); ?>"'><i class="fa fa-eye fa-fw"></i></a>
						<?php endif ?>

						<?php if ($this->permission->has_permission("faculty_update")): ?>
							<a class='btn btn-sm btn-primary' title="Update Faculty" href='<?php echo base_url("faculty/update/".$value->id); ?>'><i class="fa fa-pencil fa-fw"></i></a>
						<?php endif ?>

						<?php if ($this->permission->has_permission("faculty_delete")): ?>

							<a class='btn btn-sm btn-danger' title="Delete Faculty" href='<?php echo base_url("faculty/delete/".$value->id); ?>' onclick="return confirm('Are you sure to remove Selected Faculty?')"><i class="fa fa-trash fa-fw"></i></a> 
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
		$("#faculty_table").DataTable();
	});
</script>