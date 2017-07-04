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
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
        <meta charset="UTF-8">
        <title>HIS | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url('public/dist/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url('public/dist/css/ionicons.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('public/dist/css/AdminLTE.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
        -->
        <link href="<?php echo base_url('public/dist/css/skins/_all-skins.min.css') ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/datepicker/datepicker3.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/datatables/dataTables.bootstrap.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/dist/css/jquery-ui.css'); ?>">
         
        
        <!--custom css added to panel slider-->        
      
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
       
       <!--to load search function this must be needed-->
        <script src="<?= base_url('/Bootstrap/js/jquery-1.9.1.min.js'); ?>"></script>
        <!--<script src="<?= base_url('/Bootstrap/js/jquery-3.2.1.min.js'); ?>"></script>-->
        <script src="<?= base_url('/Bootstrap/js/bootstrap.min.js'); ?>"></script>
        <script src="<?= base_url('/Bootstrap/js/bootbox.min.js'); ?>"></script>
        <script src="<?= base_url('/Bootstrap/js/jquery-ui.min.js'); ?>"></script>
        
    <!--<script src="<?= base_url('/Bootstrap/js/jquery-1.11.1.min.js'); ?>"></script>-->
    
    <!--<script src="<?= base_url('/Bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('/Bootstrap/js/bootstrap.js'); ?>"></script>
    <script src="<?= base_url('/Bootstrap/js/bootstrap-combobox.js'); ?>"></script>
    <script src="<?= base_url('/Bootstrap/js/jquery.easing.1.3.js'); ?>"></script>
    <script src="<?= base_url('/Bootstrap/js/jquery.coda-slider-3.0.min.js'); ?>"></script>-->
      <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/jquery.dataTables.js'); ?>"></script>
    <!--<script src="<?= base_url('/Bootstrap/js/rangeslider.min.js'); ?>"></script>-->

       <script type="text/javascript">
        $(function () {
            $('#tabletestp,#tabletestp_1,#tabletestp_2,#tabletestp_3,#tabletestp_4,#tabletestp_5,#tabletestp_6').dataTable({
                "bPaginate": true,
                "bLengthChange": true,
                "bFilter": true,
                "bSort": true,
                "bInfo": true,
                "bAutoWidth": true
            });
           // $( "#patientview" ).hide();
        });
    </script>
 
        
        <script type="text/javascript">
    var role_id = "<?php echo $this->session->userdata('userlevel') ?>";
        //alert(role_id);
        $(document).ready(function() {
            var pressed = false; 
            
            var chars = []; 
            $(window).keypress(function(e) {
                if (e.which >= 48 && e.which <= 57) {
                    chars.push(String.fromCharCode(e.which));
                    //alert("sdfd");
                }
                //console.log(e.which + ":" + chars.join("|"));
                if (pressed == false) {
                    setTimeout(function(){
                        // check we have a long length e.g. it is a barcode
                        if (chars.length >= 7) {
                            // join the chars array to make a string of the barcode scanned
                            var scanned = chars.join(""); //1234000022-1
                            var sliced = scanned.slice(4, 10);//000022 hAve to change this according to input
                            var patientID="";
                            //alert("Scanned "+scanned);
                                                       // alert("Sliced "+sliced);
                            
                            if(sliced.charAt(0)!=0){
                                    patientID=sliced;
                                    //alert("patientID is "+patientID);
                            }
                            else if(sliced.charAt(1)!=0 ){                                  
                                patientID=sliced.slice(1, sliced.length);
                                //alert("patientID is "+patientID);
                            }
                            else if(sliced.charAt(2)!=0 ){                                  
                                patientID=sliced.slice(2, sliced.length);
                                //alert("patientID is "+patientID);
                            }
                            else if(sliced.charAt(3)!=0 ){                                  
                                patientID=sliced.slice(3, sliced.length);
                                //alert("patientID is "+patientID);
                            }
                            else if(sliced.charAt(4)!=0 ){                                  
                                patientID=sliced.slice(4, sliced.length);
                                //alert("patientID is "+patientID);
                            }
                            else if(sliced.charAt(5)!=0 ){                                  
                                patientID=sliced.slice(5, sliced.length);
                                //alert("patientID is "+patientID);
                            }
                            else{
                                alert("Invalid Patient HIN");
                            }
                            //alert("patientID is "+patientID);
                            
                            // This is for nurse view-> patient_full_view_v.php
                            // view-> patients_full_search_v.php
                            //window.location="../../operator_home_c/viewpatient/" + patientID;
                            
                            // for the doctor
                            //view-> doctor_p_queue_v
                                                       if(role_id == 1){
                                                           var url = "<?=site_url('patient_overview_c/view')?>"+"/"+patientID;
                                                           window.location = url;
                                                       } else {
                                                           var url = "<?=site_url('operator_home_c/viewpatient')?>"+"/"+patientID;
                                                           window.location = url;
                                                       }
                                                             
                                                       
                                                        
                                                        
                            
                        }
                        chars = [];
                        pressed = false;
                    },300);
                }
                pressed = true;
            });
        });
    
    
    
    </script>
    

    </head>

    <body class="skin-blue">
        <div class="wrapper">
            <!-- Main Header -->
            <header class="main-header">
                <!-- Logo -->
                <a href="<?php echo base_url('index.php/operator_home_c/view/3')?>" class="logo">HIS</a>
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->
                                    <li><a href= '#'><span class="hidden-xs">Date: <?php date_default_timezone_set('Asia/Colombo'); echo date("Y-m-d")?></span></a></li>
                                    <!-- User Account Menu -->
                                    <li class="dropdown user user-menu">
                                        <!-- Menu Toggle Button -->
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <!-- The user image in the navbar-->
                                            <img src="<?php  echo base_url('public/assets/img/ico_doctor.png'); ?>" class="user-image" alt="User Image"/>
                                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                            <span class="hidden-xs"><?php echo $this->session->userdata('username') ?></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <!-- The user image in the menu -->
                                            <li class="user-header">
                                                <img src="<?php  echo base_url('public/assets/img/ico_doctor.png'); ?>" class="img-circle" alt="User Image" />
                                                <p>
                                                   <?php echo $this->session->userdata('username') ?>
                                                </p>
                                            </li>
                                    
                                            <li class="user-footer">
                                                <div class="pull-left">
                                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                                </div>
                                                <div class="pull-right">
                                                    <a href="<?php echo base_url().'index.php/'?>login/logout" class="btn btn-default btn-flat">Sign out</a>
                                                </div>
                                            </li>
                                        </ul>
                                        <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
                                        </li>
                                        </ul>
                                        <ul class="nav nav-pills" STYLE="position:absolute; TOP:50px; LEFT:126px;" >
                    <?php
                    if($this->session->userdata("logged_in")==TRUE)
                    {
                    ?>
                        <?php
                        if($this->session->userdata("userlevel")==1) // doctor
                        {
                        ?><!--
                            <li><a href="<?php echo site_url("/doctor_home_c/view/1"); ?>">Home</a></li>     
                            <li><a href="<?php echo site_url("/questionnaire_c/add"); ?>">Preferences</a></li>
                            <li><a href="<?php echo site_url("/BNF_c/bnf"); ?>">View BNF</a> -->
                                                            
                                            
                        <?php } else if ($this->session->userdata("userlevel")==2) // operator
                        {
                        ?> 
                            
                        <?php
                        }?>
                     
                    <?php 
                    } ?>
                
                </ul>
                                    
                                
                            </div>
                        </nav>
                    </header>
                
