<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo "DPH | ",$template['title']; ?></title>

 

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/dist/css/AdminLTE.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/iCheck/square/blue.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/datepicker/datepicker3.css'); ?>"> 
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url('public/assets/img/backgrounds01.png'); ?>" />
  <!-- Include Bootstrap Datepicker -->


  </head>
  <body class="login-page">
    <?php echo $template['body']; ?>

   

    <!-- jQuery 2.1.3 -->
	  <script src="<?php echo base_url('public/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url('public/plugins/jQueryUI/jquery-ui-1.10.3.js'); ?>"></script>
	  <script type="text/javascript" src="<?php echo base_url('public/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <!-- iCheck --> 
	<script type="text/javascript" src="<?php echo base_url('public/plugins/iCheck/icheck.min.js'); ?>"></script>
    <!-- datepicker -->
  <script type="text/javascript" src="<?php echo base_url('public/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script> 

    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>