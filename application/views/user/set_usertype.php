<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("user_viewall")): ?>
				<a href="<?php echo base_url('uom_user') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			Set User Types <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div>
	
	<?php echo form_open(); ?>
	<table id="setusertype_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
		
		<thead>
			<tr>
				<th></th>
				<th>Id</th>
				<th>User Type</th>
			</tr>
		</thead>
		<tbody>

			<?php foreach ($usertype_list as $key => $usertype): ?>
				<tr>
					<td>
						<?php 
						echo form_checkbox("usertypes[]", $usertype->id, in_array($usertype->id, $usertype_id_array));
						?>
					</td>
					<td><?php echo $usertype->id; ?></td>
					<td><?php echo $usertype->userTypeDescription; ?></td>
				</tr>
			<?php endforeach ?>
			
		</tbody>

	</table>
<br>
	<div class="text-right">
		<?php 
		echo form_submit('save', "Set Usertypes", array('class' => 'btn btn-success' ));
		?>

	</div>
	<?php echo form_close(); ?>

</div>

<script type="text/javascript">
	$(document).ready(function () {
		$("#setusertype_table").DataTable();
	});
</script>