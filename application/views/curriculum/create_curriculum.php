<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">
            <?php if ($this->permission->has_permission("curriculum_viewall")): ?>
                <a href="<?php echo base_url('curriculum') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
                    <i class="fa fa-reply fa-fw"></i>&nbsp; Back
                </a>
            <?php endif ?>
            New Curriculum Revision <small class="sub-header-custom">MMS - University of Moratuwa</small>
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">

        <?php echo form_open_multipart(); ?>

        <div class="form-group">
            <label for="departmentId">Department  <span class="text-red">*</span></label>
            <?php echo form_dropdown('departmentId', $department_dropdown, set_value('departmentId', ''), array('class'=> 'form-control')); ?>
            <div class="text-error"><?php echo form_error('departmentId'); ?></div>
        </div>

        <div class="form-group">
            <label for="curriculamDescription">Curriculam Description <span class="text-red">*</span></label>
            <?php echo form_textarea('curriculamDescription', set_value('curriculamDescription') , array('class' => 'form-control', 'placeholder' => 'Curriculam Description', 'id' => 'curriculamDescription')); ?>
            <div class="text-error"><?php echo form_error('curriculamDescription'); ?></div>
        </div>

        <hr class="hr">

        <div class="form-group">
            <label for="supdoc">Supporting Documents </label>

            <?php echo "<input type='file' name='userfile' size='20' accept='application/pdf'/>"; ?>

            <div class="text-error"><?php echo form_error('supdoc'); ?></div>
        </div>

        <hr class="hr">

        <div class="form-group">
            
            <label for="is_verified"><?php echo form_checkbox('is_verified', true, false , array('id' => 'is_verified')); ?> Submit Curriculam Revision </label>
            <div class="text-error"><?php echo form_error('is_verified'); ?></div>
        </div>

        <div class="form-group">
            <?php echo form_submit('submit', 'Save' , array('class' => 'btn btn-primary pull-right')); ?>
        </div>

        <?php echo form_close(); ?>

    </div>
    <div class="col-md-3"></div>
</div>