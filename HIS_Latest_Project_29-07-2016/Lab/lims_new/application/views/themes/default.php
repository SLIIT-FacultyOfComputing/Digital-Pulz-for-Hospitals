<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php if($title!='') {echo $title;} else {echo 'HIS';}  ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url('assets'); ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('assets'); ?>/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url('assets'); ?>/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- Plugins Styles -->
    <link href="<?php echo base_url('assets'); ?>/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets'); ?>/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- jQuery 2.1.3 -->
        <script src="<?php echo base_url('assets'); ?>/plugins/jQuery/jQuery-2.1.3.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<?php
	if(!empty($meta))
	foreach($meta as $name=>$content){
		echo "\n\t\t";
		?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
			 }
	echo "\n";

	if(!empty($canonical))
	{
		echo "\n\t\t";
		?><link rel="canonical" href="<?php echo $canonical?>" /><?php

	}
	echo "\n\t";

	foreach($css as $file){
	 	echo "\n\t\t";
		?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
	} echo "\n\t";

	foreach($js as $file){
			echo "\n\t\t";
			?><script src="<?php echo $file; ?>"></script><?php
	} echo "\n\t";
	?>
      <style>
          .skin-blue .main-header .logo {
              background-color: #ffffff;
          }
      </style>
  </head>
  <body class="skin-blue">
    <!-- Site wrapper -->
    <div class="wrapper">
      
      <header class="main-header">
        <a href="#" class="logo">
            <img src="<?php echo base_url(); ?>assets/images/newlogofinal.png" style="width:200px;"/>
        </a>
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
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url('assets'); ?>/img/avatar5.png" class="user-image" alt="User Image"/>
                  <span class="hidden-xs">
                      <?php
                      $name = $this->session->userdata('userfullname');
                      if(isset($name) && !empty($name)){
                          echo ($name);
                      } else {
                          echo ('HIS');
                      }
                      ?>
                  </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url('assets'); ?>/img/avatar5.png" class="img-circle" alt="User Image" />
                    <p>
                        <?php
                        $name = $this->session->userdata('userfullname');
                        $level = $this->session->userdata('username');
                        if(isset($name) && !empty($name)){
                            echo ($name);
                            echo ('<small>Hello '.$level.'</small>');
                        } else {
                            echo ('HIS');
                            echo ('<small>Please Login</small>');
                        }
                        ?>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url().'login/logout'; ?>" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->
		<?php echo $this->load->get_section('sidebar'); ?>
      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
             <!--  <?php if($title!='') {echo $title;} else {echo 'HIS';}  ?> -->
          </h1>
          <?php echo $this->breadcrumbs->show(); ?>
        </section>

        <!-- Main content -->
        <section class="content">
			<div class="row">
				<?php echo $output;?>
			</div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="#">SLIIT HIS</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->


    <!-- Bootstrap 3.3.2 JS -->

    <script src="<?php echo base_url('assets'); ?>/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url('assets'); ?>/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url('assets'); ?>/plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url('assets'); ?>/plugins/fastclick/fastclick.min.js'></script>
     
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets'); ?>/js/app.min.js" type="text/javascript"></script>
    <!-- Plugins -->
    <script src='<?php echo base_url('assets'); ?>/plugins/datepicker/bootstrap-datepicker.js'></script>
        
  </body>
</html>