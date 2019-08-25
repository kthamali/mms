<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">
            <?php if ($this->permission->has_permission("requestforalternativemodulesform_viewall")): ?>
                <a href="<?php echo base_url('request_for_alternative_modules_form') ?>" class="btn btn-sm btn-primary btn-sm pull-right">
                    <i class="fa fa-reply fa-fw"></i>&nbsp; Back
                </a>
            <?php endif ?>
            New Request for alternative modules <small class="sub-header-custom">MMS - University of Moratuwa</small>
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
                <div class="col-md-5"><label for="discourses">Discontinued Course : <span class="text-red">*</span></label></div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <?php echo form_dropdown('discourses', $enrolledcourses_dropdown, set_value('discourses', ''), array('class'=> 'form-control', 'id' => 'discourses')); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-error"><?php echo form_error('discourses'); ?></div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-5"><label for="equcourses">Equivalent Course : <span class="text-red">*</span></label></div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <?php echo form_dropdown('equcourses', null,null, array('class' => 'form-control', 'id' => 'equcourses')); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-error"><?php echo form_error('equcourses'); ?></div>
            </div>
        </div>

        <hr class="hr">

        <div class="form-group">
            <label for="supdoc">Supporting Documents  </label>

            <?php echo "<input type='file' name='userfile' size='20' accept='application/pdf'/>"; ?>

            <div class="text-error"><?php echo form_error('supdoc'); ?></div>
        </div>

        <hr class="hr">

        <div class="form-group">
            <div class="row">
                <div>
                    <label for="note1">1. Examinations of the discontinued modules will be offered 3 times by the department. A student can register as a repeat candidate for the old module if the module is offered less than 3 times by the department. Please check it from UGS Division.</label>
                    <label for="note2">2. Students who have received grade "F" for a discontinued module required to request an equivalent module.</label>
                    <label for="note3">3. Student may need to register for an additional module when the credit rating is lower in the equivalent module.</label>
                    <label for="note4">4. Form applicable for the modules which equilent modules have not been assigned in the curriculum revision.</label>
                </div>
            </div>
        </div>

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
        $("#discourses").on('change', function (event) {
            var discourses = $('#discourses').val();
            $("#equcourses").html('');

            if (discourses != '') {
                getModules();
            }else{

            }

        });

         function getModules() { 
            $.ajax({

                type    : "GET",
                url     : "<?php echo base_url('course/getcourses/'); ?>",
                success : function (response) {

                    var courses = JSON.parse(response);
                    var options = "<option value=''> -- Select Course -- </option>";

                    $.each(courses, function (index, course) {
                        options += "<option value='"+course.id+"'> "+course.courseCode + " - " + course.courseName+" </option>";
                    });

                    $("#equcourses").html(options);
                }, 
                error : function (error) {
                    console.log(error);
                }
            });
        }
    });

   
       
    

</script>