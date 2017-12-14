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
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Open HMS</title>
    
    <!-- Le styles -->
 
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
<!--		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">-->
		<!--<link rel="shortcut icon" href="assets/ico/favicon.png">-->


</head>
<body>
    
<?php echo form_open('login_c/login', array('name' => 'myform')); ?>
<div class="container" style='position: fixed;left: 50%;top: 50%;height: 400px;margin-top: -200px;width: 600px;margin-left: -300px;'>
<div class="form-signin">  		
<h2 class="form-signin-heading">Please sign in</h2>
<!-- Message for login status  ************************************************************** --> 
		<?php 
				if($status == "error"){ 
		 ?>
		<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Invalid username or password
		</div>
	 
	<?php } ?>
 <!-- **************************************************************************************** --> 		

        <input type="text" id="uname" name="uname" class="input-block-level" placeholder="User Name">
        <input type="password" id="pass" name="pass" class="input-block-level" placeholder="Password">
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-primary" type="submit">Sign in</button>
</div>     
</div>
<?php echo form_close(); ?>

    <script src="<?php echo base_url()."assets/"?>js/bootstrap-transition.js"></script>
    <script src="<?php echo base_url()."assets/"?>js/bootstrap-alert.js"></script>
    <script src="<?php echo base_url()."assets/"?>js/bootstrap-modal.js"></script>
    <script src="<?php echo base_url()."assets/"?>js/bootstrap-dropdown.js"></script>
    <script src="<?php echo base_url()."assets/"?>js/bootstrap-scrollspy.js"></script>
    <script src="<?php echo base_url()."assets/"?>js/bootstrap-tab.js"></script>
    <script src="<?php echo base_url()."assets/"?>js/bootstrap-tooltip.js"></script>
    <script src="<?php echo base_url()."assets/"?>js/bootstrap-popover.js"></script>
    <script src="<?php echo base_url()."assets/"?>js/bootstrap-button.js"></script>
    <script src="<?php echo base_url()."assets/"?>js/bootstrap-collapse.js"></script>
    <script src="<?php echo base_url()."assets/"?>js/bootstrap-carousel.js"></script>
    <script src="<?php echo base_url()."assets/"?>js/bootstrap-typeahead.js"></script>

</body>
</html>