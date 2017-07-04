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
  <body class="skin-blue">
    <!-- Site wrapper -->
    <div class="wrapper">
      
      <header class="main-header">
        <a href="../../index2.html" class="logo"><h3>HIS</h3></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
    
        <ul class="nav navbar-nav">
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
          <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">


              <!-- Messages: style can be found in dropdown.less-->
             
              <!-- Notifications: style can be found in dropdown.less -->
              
              <!-- Tasks: style can be found in dropdown.less -->
              
              <!-- User Account: style can be found in dropdown.less -->
             
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->