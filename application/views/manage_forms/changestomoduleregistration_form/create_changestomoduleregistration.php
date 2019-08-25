<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">
            <?php if ($this->permission->has_permission("changestomoduleregistrationform_viewall")): ?>
                <a href="<?php echo base_url('changes_to_module_registration_form') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
                    <i class="fa fa-reply fa-fw"></i>&nbsp; Back
                </a>
            <?php endif ?>
            New Changes to module registration <small class="sub-header-custom">MMS - University of Moratuwa</small>
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">

        <?php echo form_open_multipart(); ?>

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
                <div class="col-md-4"><label for="courses">Course : <span class="text-red">*</span></label></div>
            </div>

            <div class="row">

                <div class="col-md-4">

                    <?php 
                    $dropdown_values[''] = '-- Select Option --';
                    $dropdown_values['1'] = 'Add';
                    $dropdown_values['0'] = 'Drop';
                    ?>

                    <?php echo form_dropdown('module_action', $dropdown_values,null,  array('id' => 'module_action', 'class' => 'form-control')); ?>
                </div>

                <div class="col-md-8">
                    <?php echo form_dropdown('course', null,null, array('class' => 'form-control', 'id' => 'course')); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 text-error"><?php echo form_error('module_action'); ?></div>
                <div class="col-md-8 text-error"><?php echo form_error('course'); ?></div>
            </div>
        </div>

        <div class="form-group">
            <label for="reasonForChanges">Reason for Changes  <span class="text-red">*</span></label>
            <?php echo form_textarea('reasonForChanges', set_value('reasonForChanges') , array('class' => 'form-control', 'placeholder' => 'Reason for Changes', 'id' => 'reasonForChanges')); ?>
            <div class="text-error"><?php echo form_error('reasonForChanges'); ?></div>
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

<script type="text/javascript">

    $(document).ready(function () {
        $("#module_action").on('change', function (event) {
            var module_action = $('#module_action').val();
            $("#course").html('');

            if (module_action != '') {
                getModules();
            }else{

            }

        });
    });

    
    function getModules() {
        var module_action = $('#module_action').val();
        $.ajax({
            type    : "GET",
            url     : "<?php echo base_url('course/getactoincourses/'); ?>" + module_action,
            success : function (response) {

                var courses = JSON.parse(response);
                var options = "<option value=''> -- Select Course -- </option>";

                $.each(courses, function (index, course) {
                    options += "<option value='"+course.id+"'> "+course.courseCode + " - " + course.courseName+" </option>";
                });

                $("#course").html(options);
            }, 
            error : function (error) {
                console.log(error);
            }
        });
    }

</script>