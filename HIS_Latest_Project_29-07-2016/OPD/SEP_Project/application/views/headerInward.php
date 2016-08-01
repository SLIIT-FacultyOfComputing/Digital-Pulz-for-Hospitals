<!DOCTYPE html>
<html>
<head>
     
     <link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/bootstrap.css'); ?>" media="all"/>
  <link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/bootstrap.min.css'); ?>" media="all"/>
  <link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/style.css'); ?>" media="all"/>
   
    <!--custom css added to panel slider-->
    <link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/coda-slider.css'); ?>" media="all"/>
    
    <link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/font-awesome.min.css'); ?>" media="all"/>
   <link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/datepicker.css'); ?>" media="all"/>
    
    <link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/bootstrap-combobox.css'); ?>" media="all"/>
 
  
<!--    <link rel="stylesheet" type="text/css" href="<?php  //echo base_url('/Bootstrap/css/calendar.css'); ?>" media="all"/>
    <link rel="stylesheet" type="text/css" href="<?php // echo base_url('/Bootstrap/css/fullcalendar.css'); ?>" media="all"/>
    <link rel="stylesheet" type="text/css" href="<?php  //echo base_url('/Bootstrap/css/docs.css'); ?>" media="all"/>
    <link rel="stylesheet" type="text/css" href="<?php  //echo base_url('/Bootstrap/css/colorpicker.css'); ?>" media="all"/>
    <link rel="stylesheet" type="text/css" href="<?php // echo base_url('/Bootstrap/css/jquery.gritter.css'); ?>" media="all"/>
    <link rel="stylesheet" type="text/css" href="<?php // echo base_url('/Bootstrap/css/jquery-ui.css'); ?>" media="all"/>
    <link rel="stylesheet" type="text/css" href="<?php  //echo base_url('/Bootstrap/css/select2.css'); ?>" media="all"/>
    <link rel="stylesheet" type="text/css" href="<?php // echo base_url('/Bootstrap/css/uniform.css'); ?>" media="all"/>-->
    

    <script src="<?= base_url('/Bootstrap/js/jquery-1.11.1.min.js'); ?>"></script>
    <script src="<?= base_url('/Bootstrap/js/jquery-1.9.1.min.js'); ?>"></script>
    <script src="<?= base_url('/Bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('/Bootstrap/js/bootstrap.js'); ?>"></script>
    <script src="<?= base_url('/Bootstrap/js/bootstrap-combobox.js'); ?>"></script>
    <script src="<?= base_url('/Bootstrap/js/jquery.easing.1.3.js'); ?>"></script>
    <script src="<?= base_url('/Bootstrap/js/jquery.coda-slider-3.0.min.js'); ?>"></script>

<script src="<?= base_url('/Bootstrap/js/rangeslider.min.js'); ?>"></script>
    
      
     <script type="text/javascript">
	var role_id = <?php echo $_SESSION['role_id']; ?>;
        //alert(role_id);
        $(document).ready(function() {
            var pressed = false; 
			
            var chars = []; 
            $(window).keypress(function(e) {
                if (e.which >= 48 && e.which <= 57) {
                    chars.push(String.fromCharCode(e.which));
					//alert("sdfd");
                }
                console.log(e.which + ":" + chars.join("|"));
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
    


    <!-- Custom JavaScript for the Menu Toggle -->
 
    <style>
            section .required
            {
                color: #f00;
            }                        
                   
    </style>

    
</head>
<body>
    <div id="wrapper">

        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: #FAFAFA; min-height:100px;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">

<!--                 <ul class="nav nav-pills" STYLE="position:absolute; TOP:50px; LEFT:126px;" >
                        
                        
                        <li ><a href="#">Laboratory</a></li>
                        
                        <li ><a href="#">Clinic</a></li>
                        <li ><a href="#">In wards</a></li>
                    </ul>-->

                
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
                <!-- Caption-->
                <span class="text-info" STYLE="position:absolute; TOP:9px; left:135px;"><h4>SRI LANKA HEALTH INFORMATION SYSTEM</h4></span>
                <!--logo-->
                                                    <IMG STYLE="position:absolute; TOP:2px; LEFT:2px; WIDTH:100px; HEIGHT:100px" SRC="<?php  echo base_url('/application/images/HIS log.png'); ?>">
                                        <!-- User Image-->
                                        <IMG STYLE="position:absolute; TOP:2px; right:150px; WIDTH:100px; HEIGHT:95px" SRC="<?php  echo base_url('/application/images/doctor-Image.jpg'); ?>">
                <!-- User Name-->
                <span class="label label-primary" STYLE="position:absolute; TOP:20px; right:50px;">Logged in as <?php echo $this->session->userdata('username') ?></span>
                <!--sign out-->
                <!--<span class="control-label" STYLE="position:absolute; TOP:70px; right:50px;"><a href="#">Sign out</a></span>-->
                <span class="control-label" STYLE="position:absolute; TOP:70px; right:50px;"><a href="<?php echo base_url().'index.php/'?>login/logout">LogOut</a></span>
                <a class="navbar-brand" href="#" style="color: #ffffff;"> </a>

            </div>

            

        </nav>
           <br/>
        <br/>
        <br/>