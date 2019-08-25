  <!DOCTYPE html>
  <html lang="en">

  <head>

    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="<?php echo base_url("assets/images/logo/icon.png");?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Meeting Management System - University of Moratuwa</title>

    <!-- Link Css Libraries -->
    <link rel="stylesheet" href="<?php echo base_url("assets/vendor/bootstrap/css/bootstrap.min.css");?>"> 

    <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    
    <!-- MetisMenu CSS -->
    <!-- <link rel="stylesheet" href="<?php //echo base_url("assets/vendor/metisMenu/metisMenu.min.css");?>"> -->
    <link rel="stylesheet" href="<?php echo base_url("assets/dist/css/sb-admin-2.css");?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendor/font-awesome/css/font-awesome.min.css");?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/vendor/datatables/css/jquery.dataTables.min.css");?>"> 
    <link rel="stylesheet" href="<?php echo base_url("assets/datepicker/datepicker3.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/daterangepicker/daterangepicker-bs3.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/Libraries/jquery-datetime/jquery.datetimepicker.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/custom.css"); ?>">

    <!-- Link javascript libraries -->
    <script src="<?php echo base_url("assets/vendor/jquery/jquery.min.js");?>"></script>
    <script src="<?php echo base_url("assets/vendor/bootstrap/js/bootstrap.min.js");?>"></script>
    <script src="<?php echo base_url("assets/vendor/datatables/js/jquery.dataTables.js");?>"></script>
    <script src="<?php echo base_url("assets/vendor/metisMenu/metisMenu.min.js");?>"></script>
    <script src="<?php echo base_url("assets/dist/js/sb-admin-2.js");?>"></script>
    <script src="<?php echo base_url("assets/wizard/jquery.steps.min.js");?>"></script>

    <script src="<?php echo base_url("assets/Libraries/jquery-datetime/jquery.datetimepicker.full.js");?>"></script>
    <script type="text/javascript" src="<?php echo base_url("assets/Libraries/highchart/highcharts.js"); ?>"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">

        function check_session_init() {
            recheck = setTimeout(check_session_init, 10000);
        }

        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('time').innerHTML = " " + h + ":" + m + ":" + s;
            var t = setTimeout(startTime, 500);
        }

        function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }

        window.onload = function() {
            //activateMenu();
            var d = new Date();
            document.getElementById('date').innerHTML =  d.toDateString();
            startTime();
            check_session_init();
        };
    </script>

    <style type="text/css">
    .ui-datepicker{
        z-index: 9999 !important;
    }

    #time {
        font-weight: lighter;
    }
</style>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="<?php echo base_url('dashboard'); ?>">MMS - University of Moratuwa</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <!-- date view -->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span id="date"> </span> |
                        <span id="time"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <div id="datepicker" ></div>
                    </ul>
                </li>

                <!-- User Account Menu -->
                <li class="user user-menu">
                  <!-- Menu Toggle Button -->
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- The user image in the navbar-->
                    <i class="fa fa-user fa-fw"></i>
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span class="hidden-xs">Welcome <?php echo $this->session->userdata('username'); ?></span>
                </a>
            </li>

            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <?php if ($this->permission->has_permission("userprofile_view")): ?>
                    <li><a href="<?php echo base_url('user_profile'); ?>"><i class="fa fa-user fa-fw"></i>User Profile</a>
                    </li>
                    <?php endif ?>
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url('login/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <!-- Left Manu -->
                <?php $this->load->view('layout/left_menu'); ?>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row" style="height: calc(88vh);">
                    <div class="col-lg-12">
                        <!-- Right Manu -->
                        <?php echo $sub_view; ?>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <footer class="footer">
                            <div class="container-fluid"><b>
                                &copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>, Meeting Management System - University of Moratuwa.</b>
                            </div>
                        </footer>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /#page-wrapper -->



    </div>
    <!-- /#wrapper -->

</body>

</html>
