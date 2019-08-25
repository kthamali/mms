<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			View User profile <small class="sub-header-custom">MMS - University of Moratuwa</small>
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

<div class="col-md-6 col-md-offset-0">
	<ul class="list-group">
		<li class="list-group-item">Title : <?php echo $uomuser_details->title ?></li>
		<li class="list-group-item">First name : <?php echo $uomuser_details->firstName ?></li>
		<li class="list-group-item">Last name : <?php echo $uomuser_details->lastName ?></li>
		<li class="list-group-item">Date of Birth : <?php echo $uomuser_details->dob ?></li>
		<li class="list-group-item">Address : <?php echo $uomuser_details->permanentAddress ?></li>
		<li class="list-group-item">Telephone : <?php echo $uomuser_details->permanentTelephone ?></li>
	</ul>
	<div class="form-group">
		<a class="btn btn-primary pull-right" href="<?php echo base_url('/user_profile/changePassword'); ?>">Change Password</a>
		<a class="btn btn-primary pull-right" href="<?php echo base_url('/user_profile/update'); ?>" style="margin-right:10px;">Edit</a>&nbsp;&nbsp;	
	</div>
</div>