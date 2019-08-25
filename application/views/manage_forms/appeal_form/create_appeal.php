<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">
            <?php if ($this->permission->has_permission("appealform_viewall")): ?>
                <a href="<?php echo base_url('appeal_form') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
                    <i class="fa fa-reply fa-fw"></i>&nbsp; Back
                </a>
            <?php endif ?>
            New Appeal <small class="sub-header-custom">MMS - University of Moratuwa</small>
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">

        <?php echo form_open_multipart(); ?>

        <div class="form-group">
            <div class="row">
                <div><label for="note">This form should not be used for appeals for leave, withdrawal of module/s, requesting alternative module/s for discontinued module/s or changes of module registration.</label></div>
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
            <label for="appealbrief">Appeal in Brief (One sentence) <span class="text-red">*</span></label>
            <?php echo form_textarea('appealbrief', set_value('appealbrief') , array('class' => 'form-control', 'placeholder' => 'Appeal in Brief', 'id' => 'appealbrief')); ?>
            <div class="text-error"><?php echo form_error('appealbrief'); ?></div>
        </div>

        <div class="form-group">
            <label for="appealsummary">Summary of the appeal  <span class="text-red">*</span></label>
            <?php echo form_textarea('appealsummary', set_value('appealsummary') , array('class' => 'form-control', 'placeholder' => 'Summary of the appeal', 'id' => 'appealsummary')); ?>
            <div class="text-error"><?php echo form_error('appealsummary'); ?></div>
        </div>

        <hr class="hr">

        <div class="form-group">
            <label for="supdoc">Supporting Documents  </label>

            <?php echo "<input type='file' name='userfile' size='20' accept='application/pdf'/>"; ?>

            <div class="text-error"><?php echo form_error('supdoc'); ?></div>
        </div>

        <hr class="hr">

        <div class="form-group">
            
            <label for="is_verified"><?php echo form_checkbox('is_verified', true, false , array('id' => 'is_verified')); ?> I understand that the submission of this form does not mean that the request is accepted or recommended by the University. Further I have reviewed my application and certify that everything I have stated is true.  </label>
            <div class="text-error"><?php echo form_error('is_verified'); ?></div>
        </div>

        <div class="form-group">
            <?php echo form_submit('submit', 'Save' , array('class' => 'btn btn-primary pull-right')); ?>
        </div>

        <?php echo form_close(); ?>

    </div>
    <div class="col-md-3"></div>
</div>