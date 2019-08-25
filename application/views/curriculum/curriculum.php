<style type="text/css">
.sub-heading{
	padding: 5px 10px;
}
</style>

<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("curriculum_create")): ?>
				<a href="<?php echo base_url('curriculum/create') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-plus fa-fw"></i>&nbsp; Add Curriculum Revision
				</a>
			<?php endif ?>
			Curriculums <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<?php 
if($this->session->flashdata('success')){
	?>
	<div class="alert alert-success" role="alert">
		<?php echo $this->session->flashdata('success'); ?>
	</div>
	<?php
}
?>

<?php if ($this->permission->has_permission("view_my_curriculum_grid")): ?>
	
	<div>
		<h4 class="bg bg-info sub-heading">Curriculum Revisions</h4>

		<table id="my_curriculum_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			<thead >
				<tr>
					<th>Id</th>
					<th>Description</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>

			<tbody>

				<?php foreach ($curriculum_list as $key => $value) {?>

					<tr>
						<td><?php echo $value->id ?></td>
						<td><?php echo $value->curriculamDescription ?></td>
						<td>
							<?php 
							switch ($value->status) {
								case 'pending':
								echo "<label class='label label-primary'>$value->status</label>";
								break;
								case 'chairman_forwarded_to_FAC':
								echo "<label class='label label-success'>$value->status</label>";
								break;
								case 'chairman_rejected':
								echo "<label class='label label-danger'>$value->status</label>";
								break;
								case 'fac_approved':
								echo "<label class='label label-default'>$value->status</label>";
								break;
							}
							?>
						</td>
						<td>
							<?php if ($this->permission->has_permission("curriculum_view")): ?>
								<a class='btn btn-sm btn-info' title="View Curriculum" href="<?php echo base_url("curriculum/myview/".$value->id); ?>"'><i class="fa fa-eye fa-fw"></i></a>
							<?php endif ?>

							<?php if ($this->permission->has_permission("curriculum_delete") && $value->status == 'pending'): ?>
								<a class='btn btn-sm btn-danger' title="Delete Curriculum" href='<?php echo base_url("curriculum/delete/".$value->id); ?>' onclick="return confirm('Are you sure to remove Selected Curriculum?')"><i class="fa fa-trash fa-fw"></i></a> 
							<?php endif ?>
						</td>

					</tr>

					<?php

				}

				?>

			</tbody>
		</table>
	</div>
<?php endif ?>

<?php if ($this->permission->has_permission("view_all_curriculum_grid")): ?>
	
	<div>
		<h4 class="bg bg-info sub-heading">All Curriculum Revisions</h4>

		<table id="all_curriculum_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			<thead >
				<tr>
					<th>Id</th>
					<th>Description</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>

			<tbody>

				<?php foreach ($curriculum_list as $key => $value) {?>

					<tr>
						<td><?php echo $value->id ?></td>
						<td><?php echo $value->curriculamDescription ?></td>
						<td>
							<?php 
							switch ($value->status) {
								case 'pending':
								echo "<label class='label label-primary'>$value->status</label>";
								break;
								case 'chairman_forwarded_to_FAC':
								echo "<label class='label label-success'>$value->status</label>";
								break;
								case 'chairman_rejected':
								echo "<label class='label label-danger'>$value->status</label>";
								break;
								case 'fac_approved':
								echo "<label class='label label-default'>$value->status</label>";
								break;
							}
							?>
						</td>
						<td>
							<?php if ($this->permission->has_permission("curriculum_view")): ?>
								<a class='btn btn-sm btn-info' title="View Curriculum" href="<?php echo base_url("curriculum/view/".$value->id); ?>"'><i class="fa fa-eye fa-fw"></i></a>
							<?php endif ?>
						</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
<?php endif ?>

<script type="text/javascript">
	$(document).ready(function () {
		$("#my_curriculum_table").DataTable({
			"ordering": false
		});
		$("#all_curriculum_table").DataTable({
			"ordering": false
		});
	});
</script>