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


    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?php echo base_url("assets/vendor/bootstrap/css/bootstrap.min.css");?>">

    <!-- MetisMenu CSS -->
    <link rel="stylesheet" href="<?php echo base_url("assets/vendor/metisMenu/metisMenu.min.css");?>">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url("assets/dist/css/sb-admin-2.css");?>">

    <!-- Morris Charts CSS -->
    <link rel="stylesheet" href="<?php echo base_url("assets/vendor/morrisjs/morris.css");?>">



    <!-- Custom Fonts -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendor/font-awesome/css/font-awesome.min.css");?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
    body {
        background-color: #f8f8f8;
        background: url("assets/images/login/bg2.jpg");
    }
</style>

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-body">
                        <div class="text-center"><h2>University of Moratuwa <br> Meeting Management System</h2></div>
                        <div class="text-center">
                            <img src="<?php echo base_url("assets/images/logo/logo.png");?>" alt="UOM LOGO" style="height: 13em;"/>
                        </div>
                        <div class="panel-heading">
                            <h3 class="panel-title">Please Enter Your Information</h3>
                        </div>

                        <form role="form" method="POST" action="<?php echo base_url("login");?>" >
                            <fieldset>
                                <div class="form-group">
                                    <i class="fa fa-user fa-fw"></i>
                                    <input class="form-control" placeholder="Username" name="username" type="username" required autofocus>

                                </div>
                                <div class="form-group">
                                    <i class="fa fa-lock fa-fw"></i>
                                    <input class="form-control" placeholder="Password" name="password" type="password" required>
                                </div>

                                <div class="text-danger"><b>
                                    <?php
                                    if ($this->session->flashdata('error_message')) {
                                        echo $this->session->flashdata('error_message');
                                    } 
                                    ?></b>
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>



                            </fieldset>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url("assets/vendor/jquery/jquery.min.js"); ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("assets/vendor/bootstrap/js/bootstrap.min.js"); ?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url("assets/vendor/metisMenu/metisMenu.min.js"); ?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url("assets/dist/js/sb-admin-2.js"); ?>"></script>

</body>

</html>