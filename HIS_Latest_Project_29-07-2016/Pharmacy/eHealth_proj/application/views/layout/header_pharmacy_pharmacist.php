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
    <title>HIS</title>
    
    
    <link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/bootstrap.min.css'); ?>" media="all"/>
    <link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/bootstrap.css'); ?>" media="all"/>
   
    <!-- Add custom CSS here -->
   
    <link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/style.css'); ?>" media="all"/>
   
    <link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/font-awesome.min.css'); ?>" media="all"/>
   
    <link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/bootstrap-combobox.css'); ?>" media="all"/>
   
    <!--link href="css/font-awesome.css" rel="stylesheet"-->
    <link rel="icon" href="<?php echo base_url('/Bootstrap/img/favicon.ico'); ?>" type="image/ico">
    <!-- JavaScript -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap-combobox.js"></script>

    


    <!-- Custom JavaScript for the Menu Toggle -->
    <script>
        $('document').ready(function(){
            $('.combobox').combobox({bsVersion: '2'});
        });
    </script>



    <div id="wrapper">

        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: #FAFAFA; min-height:100px;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                
                  <!--custom javascript for ADMIN deropdown--> 
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

<!--                  <ul class="nav nav-pills"> 
                      <li class="dropdown" id="log">
                          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                              <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                          </a>
                          <ul class="dropdown-menu dropdown-user">
                              <li><a href="LoggedUser"><i class="fa fa-user fa-fw"></i> User Profile</a>
                              </li>
                              <li><a href="#"><i class="fa fa-gear fa-fw"></i> Employee Details</a>
                              </li>
                              <li class="divider"></li>
                              <li><a href="http://localhost/eHealth_proj"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                              </li>
                          </ul>
                           /.dropdown-user 
                      </li>
                       /.dropdown 
                  </ul>-->
                
                <!-- Caption-->
                <span class="text-info" STYLE="position:absolute; TOP:9px; left:135px;"><h4>SRI LANKA HEALTH INFORMATION SYSTEM</h4></span>
                <!--logo-->
			    <IMG STYLE="position:absolute; TOP:2px; LEFT:2px; WIDTH:100px; HEIGHT:100px" SRC="<?php echo base_url('/images/img_pharmacy/logo.png'); ?>">
                <!-- User Image-->
                <IMG STYLE="position:absolute; TOP:2px; right:150px; WIDTH:100px; HEIGHT:95px" SRC="<?php echo base_url('/images/img_pharmacy/pharmacist.png'); ?>">
                <!-- User Name-->
                <span class="label label-primary" STYLE="position:absolute; TOP:20px; right:50px;">Logged in as <?php echo $this->session->userdata('username') ?></span>
                <!--sign out-->
                <span class="control-label" STYLE="position:absolute; TOP:70px; right:50px;"><a href="http://localhost/eHealth_proj">Sign out</a></span>

                
                <a class="navbar-brand" href="#" style="color: #ffffff;"> </a>

            </div>

            

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav " style="top:100px;">

                    <!--<li ><a href="<?php echo base_url('/index.php/Report_Controller/report'); ?>"><i class="text-primary"></i>Home</a></li>-->
                    
                    <li><a href="<?php echo base_url('/index.php/Prescribe_Controller'); ?>"><i class="text-primary"></i>Home</a></li>

                    <li><a href="<?php echo base_url('/index.php/Request_Controller/addRequestDrug'); ?>"><i class="text-primary"></i>Send Requests</a></li>
                    
<!--                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Reports <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('/index.php/Report_Controller'); ?>">Drug report</a></li>
                            <li><a href="<?php echo base_url('/index.php/Dispense_Drug_Reports'); ?>">Dispense log</a></li>
                            <li><a href="<?php echo base_url('/index.php/Report_Controller/report'); ?>">Low drug report</a></li>
                        </ul>
                    </li>-->
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
        
<!--        <div id="header" class="container">
                    <div id="logo">
                        <h1><a href="#"></a></h1>
                    </div>
                    <?php // $this->load->view('layout/navigation');?>
            <?php // rumy lage navigation eka ?>
</div>-->

<br/>
<div id="banner">
    <!--<div class="content"><img src="<?php // echo base_url('/Contents/images/imagehospital.jpg'); ?>" width="1194" height="300" alt="" />              </div>-->
</div>
