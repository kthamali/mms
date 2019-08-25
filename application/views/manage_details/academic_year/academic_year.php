<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("academicyear_create")): ?>
				<a href="<?php echo base_url('academic_year/create') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-plus fa-fw"></i>&nbsp; Add Academic Year
				</a>
			<?php endif ?>
			Academic Year <small class="sub-header-custom">MMS - University of Moratuwa</small>
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
	
	<table id="academicyear_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
		<thead >
			<tr>
				<th>Id</th>
				<th>Academic Year Description</th>
				<th>Academic Year Code</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>

			<?php  foreach ($academicyear_list as $key => $value) {?>

				<tr>
					<td><?php echo $value->id ?></td>
					<td><?php echo $value->academicYearDescription ?></td>
					<td><?php echo $value->academicYearCode ?></td>
					<td>

						<?php if ($this->permission->has_permission("academicyear_view")): ?>
							<a class='btn btn-sm btn-info' title="View Academic Year" href="<?php echo base_url("academic_year/view/".$value->id); ?>"'><i class="fa fa-eye fa-fw"></i></a>
						<?php endif ?>

						<?php if ($this->permission->has_permission("academicyear_update")): ?>
							<a class='btn btn-sm btn-primary' title="Update Academic Year" href='<?php echo base_url("academic_year/update/".$value->id); ?>'><i class="fa fa-pencil fa-fw"></i></a>
						<?php endif ?>

						<?php if ($this->permission->has_permission("academicyear_delete")): ?>

							<a class='btn btn-sm btn-danger' title="Delete Academic Year" href='<?php echo base_url("academic_year/delete/".$value->id); ?>' onclick="return confirm('Are you sure to remove Selected Academic Year?')"><i class="fa fa-trash fa-fw"></i></a> 
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
		$("#academicyear_table").DataTable();
	});
</script>