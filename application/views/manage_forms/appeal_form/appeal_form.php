<style type="text/css">
.sub-heading{
	padding: 5px 10px;
}
</style>

<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("appealform_create")): ?>
				<a href="<?php echo base_url('appeal_form/create') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-plus fa-fw"></i>&nbsp; Add Appeal
				</a>
			<?php endif ?>
			Appeals <small class="sub-header-custom">MMS - University of Moratuwa</small>
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

<!-- My Appeals -->
<?php if ($this->permission->has_permission("view_my_appeals_grid")): ?>
	<div>
		<h4 class="bg bg-info sub-heading">My Appeals</h4>

		<table id="my_appeal_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			<thead >
				<tr>
					<th>Id</th>
					<th>Appeal in Brief</th>
					<th>Summary</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>

			<tbody>

				<?php  foreach ($my_appeal as $key => $value) {?>

					<tr>
						<td><?php echo $value->id ?></td>
						<td><?php echo $value->appealInBrief ?></td>
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

							<?php if ($this->permission->has_permission("appealform_view")): ?>
								<a class='btn btn-sm btn-info' title="View Appeal" href="<?php echo base_url("appeal_form/myview/".$value->id); ?>"'><i class="fa fa-eye fa-fw"></i></a>
							<?php endif ?>

							<?php if ($this->permission->has_permission("appealform_delete") && $value->status == 'pending'): ?>
								<a class='btn btn-sm btn-danger' title="Delete Appeal" href='<?php echo base_url("appeal_form/delete/".$value->id); ?>' onclick="return confirm('Are you sure to remove Selected Appeal?')"><i class="fa fa-trash fa-fw"></i></a> 
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

<?php if ($this->permission->has_permission("view_all_appeals_grid")): ?>
	
	<div>
		<h4 class="bg bg-info sub-heading">All Appeals</h4>

		<table id="all_appeal_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			<thead >
				<tr>
					<th>Id</th>
					<th>Registration No</th>
					<th>Name</th>
					<th>Appeal in Brief</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>

			<tbody>

				<?php  foreach ($appeal_list as $key => $value) {?>

					<tr>
						<td><?php echo $value->id ?></td>
						<td><?php echo $value->registrationNo ?></td>
						<td><?php echo $value->nameWithInitials ?></td>
						<td><?php echo $value->appealInBrief ?></td>
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

							<?php if ($this->permission->has_permission("appealform_view")): ?>
								<a class='btn btn-sm btn-info' title="View Appeal" href="<?php echo base_url("appeal_form/view/".$value->id); ?>"'><i class="fa fa-eye fa-fw"></i></a>
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
		$("#all_appeal_table").DataTable({
			"ordering": false
		});
		$("#my_appeal_table").DataTable({
			"ordering": false
		});
	});
</script>
