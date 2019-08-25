<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("meeting_create")): ?>
				<a href="<?php echo base_url('meetings/create') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-plus fa-fw"></i>&nbsp; Add Meeting
				</a>
			<?php endif ?>
			Meetings <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div>
	<a target="_blank" class="btn btn-info pull-right" href="<?php echo base_url('meetings/twomonthsmeetingreport'); ?>">Print Two Months Meeting Report</a>
</div>

<div>
	<a target="_blank" class="btn btn-info" href="<?php echo base_url('meetings/meetingreport'); ?>">Print</a>
</div>

<div class="row">
	<div class="col-md-12">

		<!-- show success message -->
		<?php if ($this->session->flashdata('success')): ?>
			<div class="alert alert-success" role="alert">
				<?php echo $this->session->flashdata('success'); ?>
			</div>
		<?php endif ?>

		<table class="table" id="meeting-table">
			<thead>
				<tr>
					<th>Code</th>
					<th>Name</th>
					<th>Date</th>
					<th>Venue</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>

			<tbody>

				<?php foreach ($meetings as $key => $meeting): ?>
					<tr>
						<td><?php echo $meeting->meetingCode ?></td>
						<td><?php echo $meeting->name ?></td>
						<td><?php echo $meeting->meetingDate ?></td>
						<td><?php echo $meeting->venue ?></td>
						<td><?php echo $meeting->status ?></td>
						<td>

							<?php if ($this->permission->has_permission("meeting_view")): ?>
								<a class='btn btn-sm btn-info' title="View Agenda" href="<?php echo base_url("meetings/viewagenda/".$meeting->id); ?>"'><i class="fa fa-eye fa-fw"></i></a>
							<?php endif ?>

							<?php if ($meeting->status != 'pending' && $this->permission->has_permission("meeting_view")): ?>
								<a class='btn btn-sm btn-info' title="View Minute" href="<?php echo base_url("meetings/viewminute/".$meeting->id); ?>"'><i class="fa fa-list-alt fa-fw"></i></a>
							<?php endif ?>

							<?php if ($meeting->status == 'pending'): ?>
								
								<?php if ($this->permission->has_permission("meeting_update")): ?>
									<a class='btn btn-sm btn-primary' title="Update Meeting" href='<?php echo base_url("meetings/update/".$meeting->id); ?>'><i class="fa fa-pencil fa-fw"></i></a>
								<?php endif ?>

								<?php if ($this->permission->has_permission("meeting_delete")): ?>
									<a class='btn btn-sm btn-danger' title="Delete Meeting" href='<?php echo base_url("meetings/delete/".$meeting->id); ?>' onclick="return confirm('Are you sure to remove Selected Meeting?')"><i class="fa fa-trash fa-fw"></i></a> 
								<?php endif ?>

							<?php endif ?>
						</td>
					</tr>
				<?php endforeach ?>
				
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		$("#meeting-table").DataTable();
	});
</script>