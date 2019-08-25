<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("level_create")): ?>
				<a href="<?php echo base_url('level/create') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-plus fa-fw"></i>&nbsp; Add Level
				</a>
			<?php endif ?>
			Level <small class="sub-header-custom">MMS - University of Moratuwa</small>
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
	
	<table id="level_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
		<thead >
			<tr>
				<th>Id</th>
				<th>Level Description</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>

			<?php  foreach ($level_list as $key => $value) {?>

				<tr>
					<td><?php echo $value->id ?></td>
					<td><?php echo $value->levelDescription ?></td>
					<td>

						<?php if ($this->permission->has_permission("level_view")): ?>
							<a class='btn btn-sm btn-info' title="View Level" href="<?php echo base_url("level/view/".$value->id); ?>"'><i class="fa fa-eye fa-fw"></i></a>
						<?php endif ?>

						<?php if ($this->permission->has_permission("level_update")): ?>
							<a class='btn btn-sm btn-primary' title="Update Level" href='<?php echo base_url("level/update/".$value->id); ?>'><i class="fa fa-pencil fa-fw"></i></a>
						<?php endif ?>

						<?php if ($this->permission->has_permission("level_delete")): ?>

							<a class='btn btn-sm btn-danger' title="Delete Level" href='<?php echo base_url("level/delete/".$value->id); ?>' onclick="return confirm('Are you sure to remove Selected Level?')"><i class="fa fa-trash fa-fw"></i></a> 
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
		$("#level_table").DataTable();
	});
</script>