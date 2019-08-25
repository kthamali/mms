<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<?php if ($this->permission->has_permission("user_viewall")): ?>
				<a href="<?php echo base_url('uom_user') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
					<i class="fa fa-reply fa-fw"></i>&nbsp; Back
				</a>
			<?php endif ?>
			Update User <small class="sub-header-custom">MMS - University of Moratuwa</small>
		</h2>
	</div>
</div>

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		
		<?php echo form_open(); ?>

		<div class="form-group">
			<label for="title">Title  <span class="text-red">*</span></label>
			<?php echo form_input('title', set_value('title',$uomuser_details->title) , array('class' => 'form-control', 'placeholder' => 'Title', 'id' => 'title')); ?>
			<div class="text-error"><?php echo form_error('title'); ?></div>
		</div>

		<div class="form-group">
			<label for="firstname">First Name </label>
			<?php echo form_input('firstName', set_value('firstname',$uomuser_details->firstName) , array('class' => 'form-control', 'placeholder' => 'First Name', 'id' => 'firstname')); ?>
			<div class="text-error"><?php echo form_error('firstName'); ?></div>
		</div>

		<div class="form-group">
			<label for="lastname">Last Name </label>
			<?php echo form_input('lastName', set_value('lastname',$uomuser_details->lastName) , array('class' => 'form-control', 'placeholder' => 'Last Name', 'id' => 'lastname')); ?>
			<div class="text-error"><?php echo form_error('lastName'); ?></div>
		</div>

		<div class="form-group">
			<label for="namewithinitials">Name With Initials  <span class="text-red">*</span></label>
			<?php echo form_input('nameWithInitials', set_value('namewithinitials',$uomuser_details->nameWithInitials) , array('class' => 'form-control', 'placeholder' => 'Name With Initials', 'id' => 'namewithinitials')); ?>
			<div class="text-error"><?php echo form_error('nameWithInitials'); ?></div>
		</div>

		<div class="form-group">
			<label for="datetimepicker">Date of Birth  <span class="text-red">*</span></label>
			<?php echo form_input('dob', set_value('dob',$uomuser_details->dob) , array('class' => 'form-control', 'placeholder' => 'Date of Birth', 'id' => 'datetimepicker')); ?>
			<div class="text-error"><?php echo form_error('dob'); ?></div>
		</div>

		<div class="form-group">
			<label for="nic">NIC  <span class="text-red">*</span></label>
			<?php echo form_input('nic', set_value('nic',$uomuser_details->nic) , array('class' => 'form-control', 'placeholder' => 'NIC', 'id' => 'nic')); ?>
			<div class="text-error"><?php echo form_error('nic'); ?></div>
		</div>

		<div class="form-group">
			<label for="primaryemail">Primary Email  <span class="text-red">*</span></label>
			<?php echo form_input('primaryEmail', set_value('primaryemail',$uomuser_details->primaryEmail) , array('class' => 'form-control', 'placeholder' => 'Primary Email', 'id' => 'primaryemail')); ?>
			<div class="text-error"><?php echo form_error('primaryEmail'); ?></div>
		</div>

		<div class="form-group">
			<label for="registrationno">Registration Number  </label>
			<?php echo form_input('registrationNo', set_value('registrationno',$uomuser_details->registrationNo) , array('class' => 'form-control', 'placeholder' => 'Registration Number', 'id' => 'registrationno')); ?>
			<div class="text-error"><?php echo form_error('registrationNo'); ?></div>
		</div>

		<div class="form-group">
			<label for="permanentaddress">Address  <span class="text-red">*</span></label>
			<?php echo form_input('permanentAddress', set_value('permanentaddress',$uomuser_details->permanentAddress) , array('class' => 'form-control', 'placeholder' => 'Address', 'id' => 'permanentaddress')); ?>
			<div class="text-error"><?php echo form_error('permanentAddress'); ?></div>
		</div>

		<div class="form-group">
			<label for="permanenttelephone">Contact Number  <span class="text-red">*</span></label>
			<?php echo form_input('permanentTelephone', set_value('permanenttelephone',$uomuser_details->permanentTelephone) , array('class' => 'form-control', 'placeholder' => 'Contact Number', 'id' => 'permanenttelephone')); ?>
			<div class="text-error"><?php echo form_error('permanentTelephone'); ?></div>
		</div>

		<div class="form-group">
            <label for="facultyId">Faculty  <span class="text-red">*</span></label>
            <?php echo form_dropdown('facultyId', $faculty_dropdown, set_value('facultyId',$uomuser_details->faculty_id), array('class'=> 'form-control')); ?>
            <div class="text-error"><?php echo form_error('facultyId'); ?></div>
        </div>

        <div class="form-group">
            <label for="degreeId">Degree  <span class="text-red">*</span></label>
            <?php echo form_dropdown('degreeId', $degree_dropdown, set_value('degreeId',$uomuser_details->degree_id), array('class'=> 'form-control')); ?>
            <div class="text-error"><?php echo form_error('degreeId'); ?></div>
        </div>

		<div class="form-group">
            <label for="departmentId">Department  <span class="text-red">*</span></label>
            <?php echo form_dropdown('departmentId', $department_dropdown, set_value('departmentId',$uomuser_details->department_id), array('class'=> 'form-control')); ?>
            <div class="text-error"><?php echo form_error('departmentId'); ?></div>
        </div>

        <div class="form-group">
            <label for="specializationId">Specialization  <span class="text-red">*</span></label>
            <?php echo form_dropdown('specializationId', $specialization_dropdown, set_value('specializationId',$uomuser_details->specialization_id), array('class'=> 'form-control')); ?>
            <div class="text-error"><?php echo form_error('specializationId'); ?></div>
        </div>

		<div class="form-group">
            <label for="academicYearId">Academic Year  <span class="text-red">*</span></label>
            <?php echo form_dropdown('academicYearId', $academicyear_dropdown, set_value('academicYearId',$uomuser_details->academicYear_id), array('class'=> 'form-control')); ?>
            <div class="text-error"><?php echo form_error('academicYearId'); ?></div>
        </div>

        <div class="form-group">
            <label for="levelId">Level  <span class="text-red">*</span></label>
            <?php echo form_dropdown('levelId', $level_dropdown, set_value('levelId',$uomuser_details->level_id), array('class'=> 'form-control')); ?>
            <div class="text-error"><?php echo form_error('levelId'); ?></div>
        </div>

		<div class="form-group">
			<label for="username">User Name  <span class="text-red">*</span></label>
			<?php echo form_input('userName', set_value('username',$uomuser_details->userName) , array('class' => 'form-control', 'placeholder' => 'Username', 'id' => 'username')); ?>
			<div class="text-error"><?php echo form_error('userName'); ?></div>
		</div>

		<div class="form-group">
			<?php echo form_submit('submit', 'Update' , array('class' => 'btn btn-primary pull-right')); ?>
		</div>

		<?php echo form_close(); ?>

	</div>
	<div class="col-md-3"></div>
</div>

<script type="text/javascript">

	$(document).ready(function () {
		jQuery('#datetimepicker').datetimepicker({
			timepicker:false,
		});
	});

</script>