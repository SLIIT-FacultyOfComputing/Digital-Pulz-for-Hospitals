<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<?php
	
header ( 'Content-type: text/html;charset=utf-8' );
	
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
																										echo site_url ( "/operator_home_c/view/1" );
																									}
																									
																									?>"
		class="">Back to Home</a></li>
		<?php } ?>
                        <?php if($leftnavpage == 'lab') { ?>
                        
			
                        
		 	<!--<li class=""><a href="<?php //echo site_url("/operator_home_c/view/1"); ?>"><i class="icon-home"></i> Back to Home </a></li>-->

	<li class=""><a
		href="<?php
																									
																									// doctor
																									echo site_url ( "/patient_overview_c/view/" . $patientDetalis );
																									
																									?>"
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
<!--		 <i class="nav navbar-nav side-nav" style="top:100px">-->
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
