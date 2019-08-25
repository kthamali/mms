<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">
            <?php if ($this->permission->has_permission("leaveform_viewall")): ?>
                <a href="<?php echo base_url('leave_form') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
                    <i class="fa fa-reply fa-fw"></i>&nbsp; Back
                </a>
            <?php endif ?>
            New Leave <small class="sub-header-custom">MMS - University of Moratuwa</small>
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">

        <?php echo form_open_multipart(); ?>

        <div class="form-group">
            <div class="row">
                <div><label for="note1">Please upload supporting documents for your application.</label></div>
                <div><label for="note2">Leave will not be granted during the examination periods. If the student is unable to sit for examinations due to medical reasons he/she should apply to the SAR/Examiations on the form available at the Examinations Division.</label></div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-4"><label for="indexno">Index No : </label></div>
                <div class="col-md-8"><?php echo $student->registrationNo; ?></div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-4"><label for="namewithinitials">Name with Initials : </label></div>
                <div class="col-md-8"><?php echo $student->nameWithInitials; ?></div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-4"><label for="department">Department : </label></div>
                <div class="col-md-8"><?php echo $student->departmentName; ?></div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-4"><label for="email">Email : </label></div>
                <div class="col-md-8"><?php echo $student->primaryEmail; ?></div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-4"><label for="contactno">Contact No : </label></div>
                <div class="col-md-8"><?php echo $student->currentMobile; ?></div>
            </div>
        </div>


        <hr class="hr">

        <div class="form-group">
            <div class="row">
                <div><label for="note3">1. Leave on Medical / Compassionate / Official Representation Grounds</label></div>
                <div><label for="note4">2. Leave for Long Duration (Maximum one academic year)</label></div>
                <div><label for="note4">3. Leave for Short Duration (Maximum 15 working days per semester for BSc Eng / BSc TLM, maximum 12 working days per term for BDes)</label></div>
            </div>
        </div>

        <div class="form-group">
            <label for="leavetype">Leave Type  <span class="text-red">*</span></label>
            <?php echo form_dropdown('leavetype', $leavetype_dropdown, set_value('leavetype', ''), array('class'=> 'form-control')); ?>
            <div class="text-error"><?php echo form_error('leavetype'); ?></div>
        </div>

        <div class="form-group">
            <label for="leavesummary">Summary of the leave  <span class="text-red">*</span></label>
            <?php echo form_textarea('leavesummary', set_value('leavesummary') , array('class' => 'form-control', 'placeholder' => 'Summary of the leave', 'id' => 'leavesummary')); ?>
            <div class="text-error"><?php echo form_error('leavesummary'); ?></div>
        </div>

        <div class="form-group">
            <label for="startdatetimepicker">Start Date  <span class="text-red">*</span></label>
            <?php echo form_input('startdate', set_value('startdate') , array('class' => 'form-control', 'placeholder' => 'Start Date', 'id' => 'startdatetimepicker')); ?>
            <div class="text-error"><?php echo form_error('startdate'); ?></div>
        </div>

        <div class="form-group">
            <label for="enddatetimepicker">End Date  <span class="text-red">*</span></label>
            <?php echo form_input('enddate', set_value('enddate') , array('class' => 'form-control', 'placeholder' => 'End Date', 'id' => 'enddatetimepicker')); ?>
            <div class="text-error"><?php echo form_error('enddate'); ?></div>
        </div>

        <hr class="hr">

        <div class="form-group">
            <label for="supdoc">Supporting Documents  </label>

            <?php echo "<input type='file' name='userfile' size='20' accept='application/pdf'/>"; ?>

            <div class="text-error"><?php echo form_error('supdoc'); ?></div>
        </div>

        <hr class="hr">

        <div class="form-group">

            <label for="is_verified"><?php echo form_checkbox('is_verified', true, false , array('id' => 'is_verified')); ?> I hereby certify that, I have reviewed my application and everything stated is true and correct to the best of my knowledge, I understand, accept and agree that it is my responsibility to cover any academic activities missed during my period of leave.  </label>
            <div class="text-error"><?php echo form_error('is_verified'); ?></div>
        </div>

        <div class="form-group">
            <?php echo form_submit('submit', 'Save' , array('class' => 'btn btn-primary pull-right')); ?>
        </div>

        <?php echo form_close(); ?>

    </div>
    <div class="col-md-3"></div>
</div>

<script type="text/javascript">

    $(document).ready(function () {
        jQuery('#startdatetimepicker').datetimepicker();
        jQuery('#enddatetimepicker').datetimepicker();
    });

</script>