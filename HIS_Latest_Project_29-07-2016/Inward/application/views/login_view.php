<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>HIS</title>

        <link href="<?php echo base_url(); ?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>/bootstrap/css/sb-admin.css" rel="stylesheet">

    </head>

    <body>
        <?php echo validation_errors(); ?>
        <?php echo form_open('Login/login_validate'); ?>
<br/>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Please Sign In</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form">
                                <fieldset>
                                    <div class="form-group">
                                        <input id="username" class="form-control" placeholder="User Name" name="username" type="text" required="Required" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input id="password" class="form-control" placeholder="Password" name="password" type="password" required="Required" value="">
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                        </label>
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Core Scripts - Include with every page -->
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

        <!-- SB Admin Scripts - Include with every page -->
        <script src="js/sb-admin.js"></script>

    </body>

</html>

