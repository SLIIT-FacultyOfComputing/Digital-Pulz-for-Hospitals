<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo "DPH | ", $template['title']; ?></title>

        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>


        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/datatables/dataTables.bootstrap.css'); ?>">

        <link rel="shortcut icon" type="image/png" href="<?php echo base_url('public/assets/img/minlogo.png'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/dist/css/AdminLTE.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/dist/css/ionicons.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/dist/css/font-awesome.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/dist/css/skins/_all-skins.min.css'); ?>">
<!--        <link rel="stylesheet" type="text/css" href="--><?php //echo base_url('public/dist/css/DT_bootstrap.css'); ?><!--">-->
        
        <!-- demo style -->


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/Bootstrap/css/bootstrap.css'); ?>" media="all"/>

        
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>common.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jq_pharmacy.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jqPharmacyRC.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jqPharmacyDC.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jqPharmacyBC.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jqPharmacyUC.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>validation.js"></script>

        <!-- jQuery 2.1.3 -->
        <script type="text/javascript" src="<?php echo base_url('public/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>



        <script type="text/javascript">
            $(document).ready(function(){

                        $('treeviewpatientview').hide();

            });

           // function showmanu(id, element) {
            //        if(id=="patientview"){

             //           $('#patientview:visible');
                // document.getElementById(element).style.display = '';
                // hide the lorem ipsum text
                //document.getElementById(text).style.display = 'none';
                // hide the link
                //btn.style.display = 'none';
            //}
             //function disableallnav() {
               //         $('#patientview:hidden');
       // }
        </script>


    </head>
    <body class="skin-blue" >
    
        <div class="wrapper">

            <header class="main-header">
                <a href="<?php echo base_url("index.php/Report_Controller/report")?>" class="logo"><img src="<?php echo base_url('public/assets/img/logof.png'); ?>" height="50" width="200"/></a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li><a href= '#'><span class="hidden-xs">Date: <?php date_default_timezone_set('Asia/Colombo'); echo date("Y-m-d")?></span></a></li>
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo base_url('public/assets/img/ico_doctor.png'); ?>" class="user-image" alt="User Image"/>
                                    <span class="hidden-xs"><?php echo $this->session->userdata('username') ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo base_url('public/assets/img/ico_doctor.png'); ?>" class="img-circle" alt="User Image" />
                                        <p>
                                            <?php echo $this->session->userdata('username') ?> - <?php echo $this->session->userdata('userlevel') ?>
                                            <small>Member since Nov. 2012</small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-right">
                                            <a href="<?php echo base_url().'index.php/' ?>login/logout" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>


<!-- -->



<!-- -->



                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url('public/assets/img/ico_doctor.png'); ?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?php echo "Dr. ", $this->session->userdata('username') ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">MAIN NAVIGATION</li>
                        <li>
                            <a href="<?php echo site_url("/Report_Controller/report"); ?>">
                                <i class="fa fa-dashboard"></i> <span>Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url("/Drug_Controller/drugNameview"); ?> ">
                                <i class="fa fa-stethoscope"></i> <span>Add Drugs</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url("/Drug_Controller"); ?>">
                                <i class="fa fa-sort-amount-asc"></i> <span>Update Drugs</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url("/Batch_Controller"); ?>">
                                <i class="fa fa-sort-amount-asc"></i> <span>Add New Batch</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url("/Request_Controller/requestDrugsView"); ?>">
                                <i class="fa fa-sort-amount-asc"></i> <span>View Requests</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url("/Drug_Controller/drugInformationview"); ?>">
                                <i class="fa fa-sort-amount-asc"></i> <span>Drug Information</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-th-list"></i> <span>Reports</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo site_url("/Report_Controller"); ?>"><i class="fa fa-circle-o"></i>Drugs to be expired</a></li>
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <br>
                <?php echo $template['body']; ?>

            </div><!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.5
                </div>
                <strong>Copyright &copy; 2014-2017 <a href="http://sliit.lk">Digital Pulz</a>.</strong> All rights reserved.
            </footer>
        </div><!-- ./wrapper -->

        <!-- jQuery 2.1.3 -->
      <script type="text/javascript" src="<?php echo base_url('public/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script type="text/javascript" src="<?php echo base_url('public/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <!-- FastClick -->
        <script type="text/javascript" src="<?php echo base_url('public/plugins/fastclick/fastclick.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/dist/js/app.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/dist/js/demo.js'); ?>"></script>
<!--        <script type="text/javascript" src="--><?php //echo base_url('public/dist/js/DT_bootstrap.js'); ?><!--"></script>-->
        <!-- AdminLTE for demo purposes -->
        <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/jquery.dataTables.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/dataTables.bootstrap.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
       



       <script type="text/javascript">



            $(function () {
                $('#tabletestp').dataTable({
                    "bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": true
                });
                $( "#patientview" ).hide();
            });




    </body>
</html>
