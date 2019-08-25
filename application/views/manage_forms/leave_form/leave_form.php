<style type="text/css">
.sub-heading{
	padding: 5px 10px;
}
</style>

<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("leaveform_create")): ?>
				<a href="<?php echo base_url('leave_form/create') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-plus fa-fw"></i>&nbsp; Add Leave
				</a>
			<?php endif ?>
			Leave <small class="sub-header-custom">MMS - University of Moratuwa</small>
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

<!-- My Leave -->
<?php if ($this->permission->has_permission("view_my_leaves_grid")): ?>
	<div>
		<h4 class="bg bg-info sub-heading">My Leaves</h4>

		<table id="my_leave_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			<thead >
				<tr>
					<th>Id</th>
					<th>Summary</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>

			<tbody>

				<?php  foreach ($my_leave as $key => $value) {?>

					<tr>
						<td><?php echo $value->id ?></td>
						<td><?php echo $value->summary ?></td>
						<td>
							<?php 
							switch ($value->status) {
								case 'pending':
								echo "<label class='label label-primary'>$value->status</label>";
								break;
								case 'semester_coordinator_recommended':
								echo "<label class='label label-info'>$value->status</label>";
								break;
								case 'hod_recommended':
								echo "<label class='label label-info'>$value->status</label>";
								break;
								case 'fac_rep_recommended':
								echo "<label class='label label-info'>$value->status</label>";
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

							<?php if ($this->permission->has_permission("leaveform_view")): ?>
								<a class='btn btn-sm btn-info' title="View Leave" href="<?php echo base_url("leave_form/myview/".$value->id); ?>"'><i class="fa fa-eye fa-fw"></i></a>
							<?php endif ?>

							<?php if ($this->permission->has_permission("leaveform_delete") && $value->status == 'pending'): ?>
								<a class='btn btn-sm btn-danger' title="Delete Leave" href='<?php echo base_url("leave_form/delete/".$value->id); ?>' onclick="return confirm('Are you sure to remove Selected Leave?')"><i class="fa fa-trash fa-fw"></i></a> 
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

<?php if ($this->permission->has_permission("view_all_leaves_grid")): ?>
	
	<div>
		<h4 class="bg bg-info sub-heading">All Leaves</h4>

		<table id="all_leave_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			<thead >
				<tr>
					<th>Id</th>
					<th>Registration No.</th>
					<th>Name</th>
					<th>Summary</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>

			<tbody>

				<?php  foreach ($leave_list as $key => $value) {?>

					<tr>
						<td><?php echo $value->id ?></td>
						<td><?php echo $value->registrationNo ?></td>
						<td><?php echo $value->nameWithInitials ?></td>
						<td><?php echo $value->summary ?></td>
						<td>
							<?php 
							switch ($value->status) {
								case 'pending':
								echo "<label class='label label-primary'>$value->status</label>";
								break;
								case 'semester_coordinator_recommended':
								echo "<label class='label label-info'>$value->status</label>";
								break;
								case 'hod_recommended':
								echo "<label class='label label-info'>$value->status</label>";
								break;
								case 'fac_rep_recommended':
								echo "<label class='label label-info'>$value->status</label>";
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

							<?php if ($this->permission->has_permission("leaveform_view")): ?>
								<a class='btn btn-sm btn-info' title="View Leave" href="<?php echo base_url("leave_form/view/".$value->id); ?>"'><i class="fa fa-eye fa-fw"></i></a>
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
		$("#all_leave_table").DataTable({
			"ordering": false
		});
		$("#my_leave_table").DataTable({
			"ordering": false
		});
	});
</script>