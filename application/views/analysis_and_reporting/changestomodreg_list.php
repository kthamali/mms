<hr class="hr">

<div>
	<h2 align="centre"><u>Changes to Module Registration Information</u></h2>
</div>

<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">

		<?php echo form_open(); ?>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="indexno">Index No : </label></div>
				<div class="col-md-8"><?php echo $changestomodreg->registrationNo; ?></div>
			</div>
		</div>

		<br>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="namewithinitials">Name with Initials : </label></div>
				<div class="col-md-8"><?php echo $changestomodreg->nameWithInitials; ?></div>
			</div>
		</div>

		<br>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="department">Department : </label></div>
				<div class="col-md-8"><?php echo $student->departmentName; ?></div>
			</div>
		</div>

		<br>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="email">Email : </label></div>
				<div class="col-md-8"><?php echo $student->primaryEmail; ?></div>
			</div>
		</div>

		<br>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="contactno">Contact No : </label></div>
				<div class="col-md-8"><?php echo $student->currentMobile; ?></div>
			</div>
		</div>

		<br>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="addOrDrop">Add or Drop : </label></div>
				<div class="col-md-8">
					<?php if ($changestomodreg->addOrDrop == "1")
					echo "Add"?>
					<?php if ($changestomodreg->addOrDrop == "0")
					echo "Drop"?>
				</div>
			</div>
		</div>

		<br>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="modulecode">Module Code : </label></div>
				<div class="col-md-8"><?php echo $changestomodreg->courseCode; ?></div>
			</div>
		</div>

		<br>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="modulename">Module Name : </label></div>
				<div class="col-md-8"><?php echo $changestomodreg->courseName; ?></div>
			</div>
		</div>

		<br>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="appealbrief">Reason for Changes : </label></div>
				<div class="col-md-8"><?php echo $changestomodreg->reasonForChanges; ?></div>
			</div>
		</div>

		<br>

		<div class="form-group">
			<div class="row">
				<div class="col-md-12">
					<label for="supdoc">Approval History : </label>
					<table class="thead-dark" class="table table-striped table-bordered table-hover table-sm">
						<tr>
							<th>Approved Person</th>
							<th>Comment</th>
							<th>Status</th>
						</tr>

						<?php foreach ($aproval_history as $key => $history): ?>
							<tr>
								<td><?php echo $history->nameWithInitials; ?></td>
								<td><?php echo $history->comment; ?></td>
								<td><?php echo $history->status; ?></td>
							</tr>
						<?php endforeach ?>
						
						
					</table>
				</div>		
			</div>
		</div>

		<?php echo form_close(); ?>

	</div>
	<div class="col-md-2"></div>
</div>





