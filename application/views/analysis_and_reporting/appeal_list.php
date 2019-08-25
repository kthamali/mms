<hr class="hr">

<div>
	<h2 align="centre"><u>Appeal Information</u></h2>
</div>

<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">

		<?php echo form_open(); ?>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="indexno">Index No : </label></div>
				<div class="col-md-8"><?php echo $appeal->registrationNo; ?></div>
			</div>
		</div>

		<br>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="namewithinitials">Name with Initials : </label></div>
				<div class="col-md-8"><?php echo $appeal->nameWithInitials; ?></div>
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
				<div class="col-md-4"><label for="appealbrief">Appeal in Brief : </label></div>
				<div class="col-md-8"><?php echo $appeal->appealInBrief; ?></div>
			</div>
		</div>

		<br>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="appealsummary">Summary of the appeal : </label></div>
				<div class="col-md-8"><?php echo $appeal->summary; ?></div>
			</div>
		</div>

		<br>

			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<label for="apphis">Approval History : </label>
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