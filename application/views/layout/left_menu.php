<ul class="nav" id="side-menu">

    <div class="text-center" style="padding: 10px">
        <img src="<?php echo base_url("assets/images/logo/logo.png");?>" alt="UOM LOGO" style="height: 8em;"/>
    </div>

    <?php if ($this->permission->has_permission("dashboard_viewall")): ?>
        <li>
            <a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
        </li>
    <?php endif ?>

    <?php if ($this->permission->has_permission("permission_viewall")): ?>
        <li>
            <a href="<?php echo base_url('permissions'); ?>"><i class="fa fa-check-square-o fa-fw"></i>Permissions</a>
        </li>
    <?php endif ?>

    <?php if ($this->permission->has_permission("usertype_viewall")): ?>
        <li>
            <a href="<?php echo base_url('user_type'); ?>"><i class="fa fa-user fa-fw"></i>User Types</a>
        </li>
    <?php endif ?>

    <?php if ($this->permission->has_permission("user_viewall")): ?>
        <li>
            <a href="<?php echo base_url('uom_user'); ?>"><i class="fa fa-users fa-fw"></i>User Management</a>
        </li>
    <?php endif ?>

    <?php if ($this->permission->has_permission("meetings_viewall")): ?>
        <li>
            <a href="<?php echo base_url('meetings'); ?>">

                <?php if ($meeting_count > 0): ?>
                    <span class="label label-danger pull-right"><?php echo $meeting_count;  ?></span>
                <?php endif ?>

                <i class="fa fa-calendar-o fa-fw"></i>FAC Meetings
            </a>
        </li>
    <?php endif ?>

    <?php if ($this->permission->has_permission("manageforms_viewall")): ?>
        <li>
            <a href="#"><i class="fa fa-edit fa-fw"></i>Manage Forms<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <?php if ($this->permission->has_permission("appealform_viewall")): ?>
                    <li>
                        <a href="<?php echo base_url('appeal_form'); ?>">Appeal form</a>
                    </li>
                <?php endif ?>
                <?php if ($this->permission->has_permission("changestomoduleregistrationform_viewall")): ?>
                    <li>
                        <a href="<?php echo base_url('changes_to_module_registration_form'); ?>">Changes to module registration form</a>
                    </li>
                <?php endif ?>
                <?php if ($this->permission->has_permission("leaveform_viewall")): ?>
                    <li>
                        <a href="<?php echo base_url('leave_form'); ?>">Leave form</a>
                    </li>
                <?php endif ?>
                <?php if ($this->permission->has_permission("requestforalternativemodulesform_viewall")): ?>
                    <li>
                        <a href="<?php echo base_url('request_for_alternative_modules_form'); ?>">Request for alternative modules form</a>
                    </li> 
                <?php endif ?>
            </ul>
        </li>
    <?php endif ?>

    <?php if ($this->permission->has_permission("curriculum_viewall")): ?>
        <li>
            <a href="<?php echo base_url('curriculum'); ?>"><i class="fa fa-file-text-o fa-fw"></i>Curriculum Revisions</a>
        </li>
    <?php endif ?>

    <?php if ($this->permission->has_permission("studentsearch_viewall")): ?>
        <li>
            <a href="<?php echo base_url('student_search') ?>"><i class="fa fa-list-alt fa-fw"></i>Student Details</a>
        </li>
    <?php endif ?>

    <?php if ($this->permission->has_permission("managedetails_viewall")): ?>
        <li>
            <a href="#"><i class="fa fa-wrench fa-fw"></i>Manage Details<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">

                <?php if ($this->permission->has_permission("faculty_viewall")): ?>
                    <li>
                        <a href="<?php echo base_url('faculty'); ?>">Faculty</a>
                    </li>
                <?php endif ?>

                <?php if ($this->permission->has_permission("department_viewall")): ?>
                    <li>
                        <a href="<?php echo base_url('department'); ?>">Department</a>
                    </li>
                <?php endif ?>

                <?php if ($this->permission->has_permission("degree_viewall")): ?>
                    <li>
                        <a href="<?php echo base_url('degree'); ?>">Degree</a>
                    </li>
                <?php endif ?>

                <?php if ($this->permission->has_permission("academicyear_viewall")): ?>
                    <li>
                        <a href="<?php echo base_url('academic_year'); ?>">Academic year</a>
                    </li>
                <?php endif ?>

                <?php if ($this->permission->has_permission("level_viewall")): ?>
                    <li>
                        <a href="<?php echo base_url('level'); ?>">Level</a>
                    </li>
                <?php endif ?>

                <?php if ($this->permission->has_permission("specialization_viewall")): ?>
                    <li>
                        <a href="<?php echo base_url('specialization'); ?>">Specialization</a>
                    </li>
                <?php endif ?>

            </ul>
            <!-- /.nav-second-level -->
        </li>
    <?php endif ?>

   <!--  <?php if ($this->permission->has_permission("analysisandreporting_viewall")): ?>
        <li>
            <a href="<?php echo base_url('analysis_and_reporting'); ?>"><i class="fa fa-line-chart fa-fw"></i>Analysis and Reporting</a>
        </li>
    <?php endif ?> -->
</ul>
