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
     
     <link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/bootstrap.css'); ?>" media="all"/>
  <link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/bootstrap.min.css'); ?>" media="all"/>
  <link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/style.css'); ?>" media="all"/>
   
    <!--custom css added to panel slider-->
    <link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/coda-slider.css'); ?>" media="all"/>
    <link rel="stylesheet" type="text/css" href="<?php  echo base_url('/public/dist/css/AdminLTE.css'); ?>" media="all"/>
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
                                        <IMG STYLE="position:absolute; TOP:2px; right:150px; WIDTH:100px; HEIGHT:95px" SRC="<?php  echo base_url('/application/images/doctor-Image.jpg'); ?>"/>
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
            ?>
<div class=""
    style="top: 40px; width: 100%; height: 20px; background-color: #0088cc; position: fixed">

</div>


<div class="nav navbar-nav side-nav "> 
         
        <?php if($leftnavpage == 'doctor_home_v') { ?>
                        <li><a
        href="<?php echo site_url("/doctor_home_c/view/5"); ?>">Home</a></li>
    <li class=" <?php if($visit_type == '1') echo 'active';?> "><a
        href="<?php echo site_url("/doctor_home_c/view/1"); ?> "><i
            class="icon-list"></i> My OPD Patients</a></li>

    <hr>
    <hr>
    <li class="<?php if($visit_type == '5') echo 'active';?>"><a
        href="<?php echo site_url("/doctor_home_c/view/5"); ?>  "><i
            class="icon-tasks"></i>My Queue <strong> <?php if(isset($qpatients))echo sizeof($qpatients); ?>  </strong>
    </a></li>
    <li><a href="<?php echo site_url("/questionnaire_c/add"); ?>">Questionnaire</a></li>
    <!--<li><a href="<?php echo site_url("/BNF_c/bnf"); ?>" target="_blank">View BNF</a> -->

    <br>
        <?php } ?>
        
        <?php if($leftnavpage == 'operator_home_v') { ?>
 
                        <li><a
        href="<?php echo site_url("/operator_home_c/view/1"); ?>">Home</a></li>
    <li><a href="<?php echo site_url("/patient_c/add"); ?>">New Patient</a></li>
    <li><a href="<?php echo site_url("/patient_c/search"); ?>">Search</a></li>
    <li><a href="<?php echo site_url("/reports_c/view"); ?>">Reports</a></li>

    <li class="<?php if($visit_type == '1') echo 'active';?> "><a
        href="<?php echo site_url("/operator_home_c/view/1"); ?>" class=""><i
            class="text-primary"></i> Patients </a></li>
    <hr>
    <li class="<?php if($visit_type == '3') echo 'active';?> "><a
        href="<?php echo site_url("/operator_home_c/view/3"); ?>" class=""><i
            class="text-primary"></i> Queue </a></li>

    <!--</i>-->
 
        <?php } ?>
        
     
         <?php if($leftnavpage == 'operator_home_view_patient') { ?>
<!--                        <i class="nav navbar-nav side-nav" style="top:100px">-->
    <li class=""><a
        href="<?php echo site_url("/operator_home_c/view/1"); ?>"><i
            class="icon-home"></i> Back to Home </a></li>
    <hr>
    <li class=""><a href=" "><i class=" icon-th-list"></i><strong> Commands
        </strong></a></li>

    <li class=""><a href="<?php echo site_url("/queue_c/add/".$pid); ?>"><i
            class="icon-chevron-right"></i> Add to Queue </a></li>
    <li class=""><a href="<?php echo site_url("/patient_c/edit/".$pid); ?>"><i
            class="icon-"></i> Edit Patient Details</a></li>
    <hr>
    <li class=""><a
        href="<?php echo site_url("/allergies_c/add/".$pid."/0"); ?>"> <i
            class="icon-chevron-right"></i> Add allergy
    </a></li>
    <li class=""><a
        href="<?php echo site_url("/attachment_c/add/".$pid."/0"); ?>"><i
            class="icon-chevron-right"></i> Attach File </a></li>
    <hr>
    <li class=""><a
        href=" <?php echo site_url("/inward/AdmissionRequestC/index/".$pid); ?>"><i
            class="icon-book"></i> Give an Admission </a></li>
    <hr>
    <li class=""><a href=" "><i class="icon-print"></i><strong> Prints </strong></a></li>
    <li class=""><a
        href="<?php echo "javascript:window.open('../../print_c/print_patient_card/".$pid."','patientSlip','width=490,height=250')"; ?>"><i
            class="icon-chevron-right"></i> Patient Card </a></li> </i>
        <?php } ?>
        
        
        
        <?php if($leftnavpage == 'patient_visit_v') { ?>
                        
                        
                        
                        
                        
                        
                        <!--<i class="nav navbar-nav side-nav" style="top:100px">-->
    <li class=""><a
        href="<?php echo site_url('/patient_overview_c/view/'.$pid); ?>"
        class=""> Patient Overview </a></li>

    <hr>
            
            <?php $isRecentVisit = ($recentvisit[0]->visitID == $visit[0]->visitID); ?>
            <li class=""><a href=" "><i class=" icon-th-list"></i><strong>
                Commands </strong></a></li>
    <li class=""><a
        <?php if(!$isRecentVisit  | sizeof($visit[0]->prescriptions) > 0){echo 'class=link-disabled';} ?>
        href="<?php if($isRecentVisit){   @session_start();if(isset($_SESSION['prescription'])){unset($_SESSION['prescription']);} echo site_url(  "/prescription_c/add/".$pid."/".$visit[0]->visitID); } ?>">
            <i class="icon-chevron-right"></i> Prescibe Drugs
    </a></li>
    <li class=""><a
        <?php if(!$isRecentVisit){echo 'class=link-disabled';} ?>
        href="<?php if($isRecentVisit) {echo site_url("/exams_c/add/".$pid."/".$visit[0]->visitID);}?>"><i
            class="icon-chevron-right"></i> Examination </a></li>
    <li class=""><a
        <?php if(!$isRecentVisit){echo 'class=link-disabled';} ?>
        href="<?php echo site_url("/Lab/NewTestRequest/index/"); ?>"><i
            class="icon-chevron-right"></i> Order LabTest </a></li>
    <!--$visit[0]->visitID-->
    <hr>
    <li class=""><a href=" "><i class="icon-question-sign"></i><strong>
                Questionnaire </strong></a></li>
            
                        <?php if($questionnaire != NULL && sizeof($questionnaire) >0 ) {  ?>
                <?php foreach($questionnaire as $ques) {  ?>
                        
                    <li class=""><a
        href="<?php echo site_url("/questionnaire_c/answer/".$pid."/".$ques->questionnaireID."/".$visit[0]->visitID ); ?>">
            <i class="icon-chevron-right"></i> <?php echo $ques->questionnaireName; ?> </a>
    </li>
                                       
                <?php } ?>
            <?php } ?>
                        
            <hr>
    <li class=""><a href=" "><i class="icon-print"></i><strong> Prints </strong></a></li>
            <?php if($laborders !=NULL){ ?>
                <li class=""><a href=" "><i class="icon-chevron-right"></i> LabTests
    </a></li>
            <?php } ?>
        
            <li class=""><a
        href="<?php echo "javascript:window.open('../../../print_c/print_PatientSlip/".$pid."','patientSlip','width=530,height=620')"; ?>"><i
            class="icon-chevron-right"></i> Patient slip </a></li>
    <li class=""><a
        href="<?php echo "javascript:window.open('../../../print_c/print_patient_card/".$pid."','patientCard','width=490,height=250')"; ?>"><i
            class="icon-chevron-right"></i> Patient card </a></li>
    <li class=""><a
        href="<?php echo "javascript:window.open('../../../print_c/print_visitSummary/".$pid."/".$visit[0]->visitID."','visitSummary','width=530,height=662')"; ?>"><i
            class="icon-chevron-right"></i> Visit Summary </a></li> </i> <br>
            
        <?php } ?>
         
         
        <?php if($leftnavpage == 'patient_overview_v') { ?>
                        <!--<i class="nav navbar-nav side-nav" style="top:100px">-->
             <?php  if( isset($onq) && $onq != NULL & $onq->queueStatus == "In") { ?>
                <li class=""><a
        href="<?php echo site_url("/queue_c/remove/".$pid); ?>"> <i
            class="icon-ok-sign"></i> Check Out
    </a></li>
    <hr>
             <?php } ?>
                        
            <li class=""><a href=" "><i class="icon-th-list"></i><strong>
                Commands </strong></a></li>
    <li class=""><a href="<?php echo site_url("/visit_c/add/".$pid); ?>"> <i
            class="icon-chevron-right"></i> Create a visit
    </a></li>

    <li class=""><a
        href="<?php echo  site_url("/history_c/add/".$pid."/0");?>"><i
            class="icon-chevron-right"></i> Add Note | ToDo </a></li>
    <li class=""><a
        href="<?php echo site_url("/allergies_c/add/".$pid."/0"); ?>"> <i
            class="icon-chevron-right"></i> Add Allergy
    </a></li>
    <li class=""><a
        href="<?php echo site_url("/attachment_c/add/".$pid."/0"); ?>"><i
            class="icon-chevron-right"></i> Attach File </a></li>
    <li class=""><a
        href="<?php echo site_url("/inward/AdmissionRequestC/index/".$pid); ?>"><i
            class="icon-book"></i> Give an Admission </a></li>

    <hr>
    <li class=""><a href=" "><i class="icon-print"></i><strong> Prints </strong></a></li>
    <li class=""><a
        href="<?php echo "javascript:window.open('../../print_c/print_PatientSlip/".$pid."','patientSlip','width=530,height=620')"; ?>"><i
            class="icon-chevron-right"></i> Patient slip </a></li>
    <li class=""><a
        href="<?php echo "javascript:window.open('../../print_c/print_patient_card/".$pid."','patientSlip','width=490,height=250')"; ?>"><i
            class="icon-chevron-right"></i> Patient card </a></li> <br> </i>
        <?php } ?>
        
                        
                        <?php if($leftnavpage == 'admission') { ?>
                        
            
                        
            <!--<li class=""><a href="<?php //echo site_url("/operator_home_c/view/1"); ?>"><i class="icon-home"></i> Back to Home </a></li>-->

    <li class=""><a
        href="<?php
                                                                                                    
        if ($this->session->userdata ( "userlevel" ) == 1) { // doctor
        echo site_url ( "/doctor_home_c/view/5/" );
         } else {
                 echo site_url ( "/operator_home_c/view/1" );}?>"
        class="">Back to Home</a></li>
        <?php } ?>
                        <?php if($leftnavpage == 'lab') { ?>
                        
            
                        
            <!--<li class=""><a href="<?php //echo site_url("/operator_home_c/view/1"); ?>"><i class="icon-home"></i> Back to Home </a></li>-->

    <li class=""><a
        href="<?php  
// doctor
echo site_url ( "/patient_overview_c/view/" . $patientDetalis );               ?>"
        class="">Back Patient Visit</a></li>
        <?php } ?>
        
        
        <?php if($leftnavpage == '') { ?>
            
                        <li class=""><a
        href="<?php
            if ($visitid == '0') {
                if ($this->session->userdata ( "userlevel" ) == 1) { // doctor
                    echo site_url ( '/patient_overview_c/view/' . $pid );
                } else {
                    echo site_url ( '/operator_home_c/viewpatient/' . $pid );
                }
            } else {
                echo site_url ( '/patient_visit_c/view/' . $pid . "/" . $visitid );
            }
            ?>"
        class=""> <i class="icon-chevron-left"></i>
                               <?php
            if ($visitid == '0') {
                echo " Patient Overview";
            } else {
                echo " Back to Visit";
            }
            ?> </a></li>
 
            
        <?php } ?>
     
        
        <?php if($leftnavpage == 'preferences_v') { ?>
<!--         <i class="nav navbar-nav side-nav" style="top:100px">-->
    <li><a href="<?php echo site_url("/doctor_home_c/view/5"); ?>">Home</a></li>

    <li class=""><a href="<?php echo site_url("/questionnaire_c/add"); ?>"><i
            class="icon-chevron-right"></i> Add Questionnaire </a></li>
    <li class=""><a
        href="<?php echo site_url("/preferences_c/view_questionnaire"); ?>"><i
            class="icon-chevron-right"></i> View Questionnaires </a></li>
            
        <?php } ?>
        
        <?php if($leftnavpage == 'new_patient') { ?>
                  
            <li class=""><a
        href="<?php echo site_url("/operator_home_c/view/1"); ?>" class=""><i
            class="icon-chevron-left"></i> Home </a></li>
  
        <?php } ?>
        
        <?php if($leftnavpage == 'patient_search') { ?>
         
            <li class=""><a
        href="<?php echo site_url("/operator_home_c/view/1"); ?>" class=""><i
            class="icon-chevron-left"></i> Home </a></li>
  
        <?php } ?>
        
        
        <?php if($leftnavpage == 'reports_v') { ?>
 
            <li class=""><a
        href="<?php echo site_url("/operator_home_c/view/1" ); ?>" class=""><i
            class="icon-chevron-left"></i> Home </a></li>
  
        <?php } ?>
 
        <?php if($leftnavpage == 'qans_v') { ?>
 
        <li class=""><a
        href="<?php echo site_url('/patient_overview_c/view/'.$pid); ?>"
        class=""><i class="icon-chevron-left"></i> Patient OverView </a></li>

  
        <?php } ?>
     
</div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
 
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
    
    <link href="<?php echo base_url()."assets/"?>css/jquery-ui.css" rel="stylesheet" type="text/css"/>


</body>
</html>