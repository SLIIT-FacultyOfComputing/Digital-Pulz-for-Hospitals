<?php echo form_open('login/signup_validate'); ?>

<style type="text/css">
  .login-box,.register-box {
  width:360px;
  margin:2% auto
    }
</style>  

<script type="text/javascript">
  $('#datepicker').datepicker({
   orientation: "top right"
})
</script>
<script type="text/javascript">

 function  check_password() {
   
    if (document.getElementById('password').value != document.getElementById('conf_password').value) {
      var displayMessage = document.getElementById('error_message');
      displayMessage.style.display = "block";

    } 

   else {
      $("#error_message").hide();
   }

 }
 
</script>

<div class="login-box">
      <div class="login-logo">
        <img src="<?php echo base_url('public/assets/img/logo.png'); ?>" height="30%" width="75%"/>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form method="post">
        
      <div class="form-group input-group" >
                <span style="width: 100px"  class="input-group-addon">Gender</span>
               
                <select class="form-control" name="gender" required="required" style="width: 240px;">
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                        
                 </select>              
            </div>

      <div class="form-group has-feedback">
      <input id="username" class="form-control" placeholder="User Full Name" name="username" type="text" required="Required" autofocus>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div id="datepicker" class="input-group date" data-provide="datepicker">
   <input id="datepicker" type="text" type="text" name="datepicker" class="form-control datepicker input-sm" />
    <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
    </div>
</div><br>

         
         <div class="form-group input-group" >
                <span style="width: 100px"  class="input-group-addon">Priority</span>
               
                <select class="form-control" name="priority" required="required" style="width: 240px;">
                        <option value="D">Dr.</option>
                        <option value="N">Nurse</option>
                        
                 </select>              
            </div>

          <div class="form-group input-group" >
                <span style="width: 100px"  class="input-group-addon">Civil Status</span>
               
                <select class="form-control" name="civil_status" required="required" style="width: 220px;">
                        <option value="S">Single</option>
                        <option value="M">Married</option>
                        
                 </select>              
            </div>

          <div class="form-group has-feedback">
      <input id="password" class="form-control" placeholder="Password" name="password" type="password" required="Required" value="">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
        <input id="conf_password" onkeyup="check_password()" type="password" class="form-control" placeholder="Confirm Password" name="conf_password" type="text" required="Required" value="">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
           
           <div id="error_message" class="text-center"  style = "display : none">
             <font color="red"> passwords dont match </font>
           </div><br>

          <div class="row">
            <div class="col-xs-4">    
              <div class="checkbox icheck">
                <label>
                <!--   <input name="remember" type="checkbox" value="Remember Me"> Remember Me -->
                </label>
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div><!-- /.col -->    
          </div>
        </form>
        
    <div class="social-auth-links text-center">
          <font color="red"> <?php echo $status; ?></font>
        </div><!-- /.social-auth-links -->

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->



<?php echo form_close(); ?>


        <!-- Core Scripts - Include with every page -->
       

