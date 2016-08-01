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

                <ul class="nav nav-pills" STYLE="position:absolute; TOP:50px; LEFT:126px;" >
                   
                    <li class="disabled"><a href="Preference.html">OPD</a></li>
                    <li class="disabled"><a href="#">Clinic</a></li>
                    <li class="disabled"><a href="#">Laboratory</a></li>
                    <li ><a href="#">Pharmacy</a></li>
                    <li class="disabled"><a href="#">Inward</a></li>
                    <li class="disabled"><a href="#">BHT</a></li>
                   
                </ul>
                <!-- Caption-->
                <span class="text-info" STYLE="position:absolute; TOP:9px; left:135px;"><h4>SRI LANKA HEALTH INFORMATION SYSTEM</h4></span>
                <!--logo-->
			    <IMG STYLE="position:absolute; TOP:2px; LEFT:2px; WIDTH:100px; HEIGHT:100px" SRC="<?php echo base_url('/images/img_pharmacy/logo.png'); ?>">
                <!-- User Image-->
                <IMG STYLE="position:absolute; TOP:2px; right:150px; WIDTH:100px; HEIGHT:95px" SRC="<?php echo base_url('/images/img_pharmacy/doctor-Image.jpg'); ?>">
                <!-- User Name-->
                <span class="label label-primary" STYLE="position:absolute; TOP:20px; right:50px;">Dr. Haresh Perea</span>
                <!--sign out-->
                <span class="control-label" STYLE="position:absolute; TOP:70px; right:50px;"><a href="http://localhost/eHealth_proj">Sign out</a></span>

                <a class="navbar-brand" href="#" style="color: #ffffff;"> </a>

            </div>

            

           <?php $this->load->view('layout/opd_sideBar'); ?>
        
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

