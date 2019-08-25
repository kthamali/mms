<hr class="hr">

<div>
	<h2 align="centre"><u>Curriculum Revision Information</u></h2>
</div>

<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">

		<?php echo form_open(); ?>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="department">Department : </label></div>
				<div class="col-md-8"><?php echo $curriculum->departmentName; ?></div>
			</div>
		</div>

		<br>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4"><label for="email">Curriculum Description : </label></div>
				<div class="col-md-8"><?php echo $curriculum->curriculamDescription; ?></div>
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





