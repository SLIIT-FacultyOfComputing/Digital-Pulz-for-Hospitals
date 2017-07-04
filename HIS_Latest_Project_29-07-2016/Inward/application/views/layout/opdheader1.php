<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <title>HIS</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo base_url(); ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- Datatables -->
    <link href="<?php echo base_url(); ?>js/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css" />

    <!-- jQuery -->
   
    <script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
    <body>
        <div id="wrapper">

            <!-- Sidebar -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: #FAFAFA; min-height:100px;">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">

                    <ul class="nav nav-pills" STYLE="position:absolute; TOP:50px; LEFT:126px;" >
                        <li ><a href="index.html">Home</a></li>
                        <li ><a href="Preference.html">New Patient</a></li>
                        <li ><a href="#">Search</a></li>
                        <li class="active"><a href="<?php echo base_url(); ?>index.php/inward/wardAdmissionC/index">Inward</a></li>
                        <li ><a href="#">Pharmacy</a></li>
                        <li ><a href="#">Laboratory</a></li>
                        <li ><a href="<?php echo base_url(); ?>index.php/inward/AdmissionRequestC/index">OPD</a></li>
                        <li ><a href="#">Clinic</a></li>
                        <li ><a href="#">Reports</a></li>
                    </ul>

                    <script src="js/jquery-1.11.1.min.js"></script>
                    <script type="text/javascript">
                        $('document').ready(function(){
                            resizeDiv();
                            window.onresize = function(event) {
                                resizeDiv();
                            }
                            function resizeDiv() {
                                //vph = $(window).height()-150;
                                vpw = $(window).width()-114;
                                //$('#content').css({'height':vph+'px'})
                                $('#log').css({'margin-left':vpw+'px','top':'50px'});
                            }
                        });
                    </script>

                    <span class="text-info" STYLE="position:absolute; TOP:50px; left:1250px;">
                        <ul class="nav nav-pills">

                            <li class="dropdown" id="log">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="<?php echo base_url(); ?>index.php/Inward/LoggedUser/index"><i class="fa fa-user fa-fw"></i> User Profile</a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Employee Details</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="<?php echo base_url(); ?>index.php/Login/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                    </li>
                                </ul>
                                <!-- /.dropdown-user -->
                            </li>
                            <!-- /.dropdown -->
                        </ul>
                    </span>
                    <!-- Caption-->
                    <span class="text-info" STYLE="position:absolute; TOP:9px; left:135px;"><h4>SRI LANKA HEALTH INFORMATION SYSTEM</h4></span>
                    <!--logo-->
                    <IMG STYLE="position:absolute; TOP:2px; LEFT:2px; WIDTH:100px; HEIGHT:100px" SRC="../../../bootstrap/HIS log.png">
                    <!-- User Image-->
                    <IMG STYLE="position:absolute; TOP:2px; right:150px; WIDTH:100px; HEIGHT:95px" SRC="../../../bootstrap/doctor-Image.jpg">
                    <!-- User Name-->
                    <span class="label label-primary" STYLE="position:absolute; TOP:20px; right:35px;"><?php echo $_SESSION['empName']; ?></span>
                    <!--sign out-->

                    <a class="navbar-brand" href="#" style="color: #ffffff;"> </a>

                </div>



                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav" style="top:100px;">

                        <li style="color: darkblue; left: 50px; text-align:center"><h4><i class="text-primary"></i></h4></li>
                        OPD 

                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
            <br/>
            <br/>
            <br/>
