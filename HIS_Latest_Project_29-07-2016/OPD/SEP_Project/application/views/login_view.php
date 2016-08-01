<?php echo form_open('login/login_validate'); ?>

<div class="login-box">
      <div class="login-logo">
        <img src="<?php echo base_url('public/assets/img/logo.png'); ?>" height="30%" width="75%"/>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form method="post">
          <div class="form-group has-feedback">
			<input id="username" class="form-control" placeholder="User Name" name="username" type="text" required="Required" autofocus><br>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
			<input id="password" class="form-control" placeholder="Password" name="password" type="password" required="Required" value=""><br>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck">
                <label>
                  <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                </label>
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->		
          </div>
        </form>
        <a href="#">I forgot my password</a><br>
		<div class="social-auth-links text-center">
          <font color="red"> <?php echo $status; ?></font>
            <br>
           <a href="<?php echo base_url('index.php/login/signup'); ?>">Sign Up for new user</a><br>
        </div><!-- /.social-auth-links -->

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->




        <!-- Core Scripts - Include with every page -->
       

