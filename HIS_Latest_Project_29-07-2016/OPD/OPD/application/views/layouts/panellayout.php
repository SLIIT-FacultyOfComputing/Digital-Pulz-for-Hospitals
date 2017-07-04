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
<meta charset="UTF-8">
<title><?php echo "DPH | ", $template['title']; ?></title>

<meta
	content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'
	name='viewport'>


<link rel="stylesheet" type="text/css"
	href="<?php echo base_url('public/plugins/datatables/dataTables.bootstrap.css'); ?>">

<link rel="shortcut icon" type="image/png"
	href="<?php echo base_url('public/assets/img/minlogo.png'); ?>" />
<link rel="stylesheet" type="text/css"
	href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" type="text/css"
	href="<?php echo base_url('public/dist/css/AdminLTE.min.css'); ?>">
<link rel="stylesheet" type="text/css"
	href="<?php echo base_url('public/dist/css/ionicons.min.css'); ?>">
<link rel="stylesheet" type="text/css"
	href="<?php echo base_url('public/dist/css/font-awesome.min.css'); ?>">
<link rel="stylesheet" type="text/css"
	href="<?php echo base_url('public/dist/css/skins/_all-skins.min.css'); ?>">
<link rel="stylesheet" type="text/css"
	href="<?php echo base_url('public/dist/css/DT_bootstrap.css'); ?>">
<link rel="stylesheet" type="text/css"
	href="<?php echo base_url('public/plugins/datepicker/datepicker3.css'); ?>"> 
<link rel="stylesheet" type="text/css" 
	href="<?php echo base_url('public/dist/css/jquery-ui.css'); ?>">
	<!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> -->
	
<!-- demo style -->


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
            <![endif]-->
    <script src="<?= base_url('/Bootstrap/js/jquery-1.9.1.min.js'); ?>"></script>
<script src="<?= base_url('/public/dist/js/barcode.js'); ?>">


</script>

<script type="text/javascript">
                    function getElementsByClassName(classname, node)  {
                            if(!node) node = document.getElementsByTagName("body")[0];
                            var a = [];
                            var re = new RegExp('\\b' + classname + '\\b');
                            var els = node.getElementsByTagName("*");
                            
                            for(var i=0,j=els.length; i<j; i++)
                                if(re.test(els[i].className))a.push(els[i]);
                            
                            return a;
                    }
            </script>


<script type="text/javascript">
                function showsidenav(classname, idmain) {
                    document.getElementById(idmain).style.display = 'block';
                   // document.getElementById(idmain).style.display = '';
                   //document.getElementsByClassName(classname)[0].style.display = 'block';

                    var elements = new Array();
                    elements = getElementsByClassName(classname);
                
                    for(i in elements ){
                        elements[i].style.display = 'block';
                    }
                }
                </script>




    



</head>
<body class="skin-blue">

	<div class="wrapper">

		<header class="main-header">
			<a href= '#' class="logo"> HIS </a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top" role="navigation">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas"
					role="button"> <span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
				</a>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li><a href= '#'><span class="hidden-xs">Date: <?php date_default_timezone_set('Asia/Colombo'); echo date("Y-m-d")?></span></a></li>
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu"><a href="#"
							class="dropdown-toggle" data-toggle="dropdown"> <img
								src="<?php echo base_url('public/assets/img/ico_doctor.png'); ?>"
								class="user-image" alt="User Image" /> <span class="hidden-xs">Dr. <?php echo $this->session->userdata('username') ?></span>
						</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header"><img
									src="<?php echo base_url('public/assets/img/ico_doctor.png'); ?>"
									class="img-circle" alt="User Image" />
									<p>
                                        <?php echo "Dr. ", $this->session->userdata('username') ?> - <?php echo $this->session->userdata('userid')?>
                                        <small>Member since Nov. 2012</small>
									</p></li>
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-right">
										<a href="<?php echo base_url() . 'index.php/' ?>login/logout"
											class="btn btn-default btn-flat">Sign out</a>
									</div>
								</li>
							</ul></li>
					</ul>
				</div>
			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				<div class="user-panel">

					<div class="pull-left image">
						<img
							src="<?php echo base_url('public/assets/img/ico_doctor.png'); ?>"
							class="img-circle" alt="User Image" />
					</div>
					<div class="pull-left info">
						<a href="<?php echo site_url("/doctor_home_c/view/5"); ?>">
						<p><?php echo "Dr. ", $this->session->userdata('username') ?></p>
						</a>

						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>
				<!-- search form -->
				<!-- /.search form -->
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu">

				<?php if($leftnavpage != 'patient_overview_v' && $leftnavpage != 'history_m_v' && $leftnavpage != 'patient_visit_v' && $leftnavpage != 'lab' && $leftnavpage != 'create_visit') { ?>

					<li class="header">MAIN NAVIGATION</li>
					<li class="navsidebar"><a
						href="<?php echo site_url("/doctor_home_c/view/5"); ?>"> <i
							class="fa fa-dashboard"></i> <span>Dashboard</span>
					</a></li>
					<li class="navsidebar"><a
						href="<?php echo site_url("/doctor_home_c/view/1"); ?> "> <i
							class="fa fa-stethoscope"></i> <span>My OPD Patients</span>
					</a></li>
					<li class="navsidebar"><a
						href="<?php echo site_url("/doctor_home_c/view/5"); ?>"> <i
							class="fa fa-sort-amount-asc"></i> <span>My Queue</span> <small
							class="label pull-right bg-yellow"><?php if (isset($qpatients)) echo sizeof($qpatients); ?></small>
					</a></li>
					<li class="treeview"><a href="#"> <i class="fa fa-th-list"></i> <span>Questionnaire</span>
							<i class="fa fa-angle-left pull-right"></i>
					</a>
						<ul class="treeview-menu">
							<li class="navsidebar"><a
								href="<?php echo site_url("/questionnaire_c/add"); ?>"><i
									class="fa fa-circle-o"></i> Add Questionnaire</a></li>
							<li class="navsidebar"><a
								href="<?php echo site_url("/preferences_c/view_questionnaire"); ?>"><i
									class="fa fa-circle-o"></i> View Questionnaire</a></li>
						</ul></li>
                 	<?php } ?>

		<?php if($leftnavpage == 'patient_overview_v') { ?>
                        <!--<i class="nav navbar-nav side-nav" style="top:100px">-->


					<li class="header" id="patient_overview_header"
						style="display: none;">PATIENT OVERVIEW</li>
					 <?php  if( isset($onq) && $onq != NULL & $onq->queueStatus == "In") { ?>
					<li class="patient_overview" style="display: none;"><a
						href="<?php echo site_url("/queue_c/remove/".$pid); ?>"> <i
							class="fa  fa-stack-exchange"></i> <span>CheckOut</span>
					</a></li>
					<?php } ?>
					<li class="patient_overview" style="display: none;"><a
						href="<?php echo site_url("/visit_c/add/".$pid); ?>"> <i
							class="fa fa-level-up"></i> <span>Create A Visit</span>
					</a></li>
					<li class="patient_overview" style="display: none;"><a
						href="<?php echo  site_url("/history_c/add/".$pid."/0");?>"> <i
							class="fa fa-file-text-o"></i> <span>Add Note</span>
					</a></li>
					<li class="patient_overview" style="display: none;"><a
						href="<?php echo site_url("/allergies_c/add/".$pid."/0"); ?>"> <i
							class="fa fa-h-square"></i> <span>Add Allergy</span>
					</a></li>
					<li class="patient_overview" style="display: none;"><a
						href="<?php echo site_url("/attachment_c/add/".$pid."/0"); ?>"> <i
							class="fa fa-paperclip"></i> <span>Add Attachment</span>
					</a></li>
					<li class="patient_overview" style="display: none;"><a
						href="<?php echo site_url("/inward/AdmissionRequestC/index/".$pid); ?>">
							<i class="fa fa-crosshairs"></i> <span>Give Admission</span>
					</a></li>
					<!-- <li class="patient_overview" style="display: none;"><a
						onclick="<?php echo "javascript:window.open('../../print_c/print_PatientSlip/".$pid."','patientSlip','width=530,height=620')"; ?>">
							<i class="fa fa-list-alt"></i> <span>Patient Slip</span>
					</a></li> -->
					<li class="patient_overview" style="display: none;"><a
						onclick="<?php echo "javascript:window.open('../../print_c/print_patient_card/".$pid."','patientSlip','width=490,height=250')"; ?>" >
							<i class="fa fa-barcode"></i> <span>Patient Card</span>
					</a></li>
					<?php } ?>
                    

                      <?php if($leftnavpage == 'lab') { ?>
                        
			
                        <li class="header">MAIN MENU</li>
		 	<li class=""><a href="<?php //echo site_url("/operator_home_c/view/1"); ?>"><i class="icon-home"></i> Back to Home </a></li>-->

	<li class=""><a
		href="<?php								
		if ($this->session->userdata ( "userlevel" ) == 1) { // doctor
		echo site_url ( "/patient_overview_c/view/".$patientDetalis );
	    } else {
			echo site_url ( "/operator_home_c/view/1" );
		}
		?>"
		class="">Patient Overview</a></li>
		<?php } ?>

                    <?php if($leftnavpage == 'history_m_v') { ?>
                        
			
                        <li class="header">MAIN MENU</li>
		 	<!--<li class=""><a href="<?php //echo site_url("/operator_home_c/view/1"); ?>"><i class="icon-home"></i> Back to Home </a></li>-->

	<li class=""><a
		href="<?php								
		if ($this->session->userdata ( "userlevel" ) == 1) { // doctor
		echo site_url ( "/patient_overview_c/view/" . $pid );
	    } else {
			echo site_url ( "/operator_home_c/view/1" );
		}
		?>"
		class="">Patient Overview</a></li>
		<?php } ?>
                    <?php if($leftnavpage == 'create_visit') { ?>


                        <li class="header">MAIN MENU</li>
                        <!--<li class=""><a href="<?php //echo site_url("/operator_home_c/view/1"); ?>"><i class="icon-home"></i> Back to Home </a></li>-->

                        <li class=""><a
                                    href="<?php
                                    if ($this->session->userdata ( "userlevel" ) == 1) { // doctor
                                        echo site_url ( "/patient_overview_c/view/" . $pid );
                                    } else {
                                        echo site_url ( "/operator_home_c/view/1" );
                                    }
                                    ?>"
                                    class="">Patient Overview</a></li>
                    <?php } ?>

					<?php if($leftnavpage == 'patient_visit_v') { ?>
                    <?php //var_dump($visit[0]->visitID); ?>
					<?php $isRecentVisit = ($recentvisit[0]->visitID == $visit[0]->visitID); ?>
					<li class="header" id="patient_info_header" style="display: none;">PATIENT
						INFORMATION</li>
					<li class="patient_info" style="display: none;"><a
						href="<?php echo site_url('/patient_overview_c/view/'.$pid); ?>">
							<i class="fa fa-level-up"></i> <span>Patient Overview</span>
					</a></li>
					<li class="header"> <span>Commands</span>
					</a></li>
					<?php if($isRecentVisit) {?>
					<li class="patient_info" style="display: none;"><a
						<?php if(!$isRecentVisit  | sizeof($visit[0]->prescriptions) > 0){echo 'class=link-disabled';} ?>
						href="<?php if($isRecentVisit){   @session_start();if(isset($_SESSION['prescription'])){unset($_SESSION['prescription']);} echo site_url(  "/prescription_c/add/".$pid."/".$visit[0]->visitID); } ?>">
							<i class="fa fa-level-up"></i> <span>Prescribe Drugs</span>
					</a></li>
					<li class="patient_info" style="display: none;"><a
						<?php if(!$isRecentVisit){echo 'class=link-disabled';} ?>
						href="<?php if($isRecentVisit) {echo site_url("/exams_c/add/".$pid."/".$visit[0]->visitID);}?>">
							<i class="fa fa-file-text-o"></i> <span>Examinations</span>
					</a></li>
					<li class="patient_info" style="display: none;"><a
						<?php if(!$isRecentVisit){echo 'class=link-disabled';} ?>
						href="<?php echo site_url("/Lab/newtestrequest/index/".$pid."/".$visit[0]->visitID); ?>"> <i
							class="fa fa-h-square"></i> <span>Order Lab Tests</span>
					</a></li>
					<li class="patient_info" style="display: none;"><a
						<?php if(!$isRecentVisit){echo 'class=link-disabled';} ?>
						href="<?php if($isRecentVisit) {echo site_url("/treatment_c/add/".$pid."/".$visit[0]->visitID);}?>">
							<i class="fa fa-medkit"></i> <span>Treatments</span>
					</a></li>
					<li class="patient_info" style="display: none;"><a
						<?php if(!$isRecentVisit){echo 'class=link-disabled';} ?>
						href="<?php if($isRecentVisit) {echo site_url("/injection_c/add/".$pid."/".$visit[0]->visitID);}?>">
							<i class="fa fa-thumb-tack"></i> <span>Order an Injection</span>
					</a></li>
					<?php } ?>
					<li class="treeview"><a href="#"> <i class="fa fa-th-list"></i> <span>Questionnaire</span>
							<i class="fa fa-angle-left pull-right"></i>
					</a>
						<ul class="treeview-menu">
							<li class="navsidebar"><a
								href="<?php echo site_url("/questionnaire_c/add"); ?>"><i
									class="fa fa-circle-o"></i> Add Questionnaire</a></li>
							<li class="navsidebar"><a
								href="<?php echo site_url("/preferences_c/view_questionnaire"); ?>"><i
									class="fa fa-circle-o"></i> View Questionnaire</a></li>
						</ul></li>
					
                        <?php if($questionnaire != NULL && sizeof($questionnaire) >0 ) {  ?>
					<?php foreach($questionnaire as $ques) {  ?>
					<!--<li class="patient_info" style="display: none;"><a
						href="<?php echo site_url("/questionnaire_c/answer/".$pid."/".$ques->questionnaireID."/".$visit[0]->visitID ); ?>">
							<i class="fa fa-th-list"></i> <?php echo $ques->questionnaireName; ?> </a></li>-->

							<?php } ?>
			<?php } ?>
			
			<!-- <?php if($labs !=NULL){ ?>
			<li class="patient_info" style="display: none;"><a href="#"> <i
							class="fa fa-barcode"></i> <span>Lab Orders</span>
					</a></li>
					<?php } ?> -->

					<li class="header"><span>Prints</span>
					</a></li>
					<li class="patient_info" style="display: none;"><a onclick="<?php echo "javascript:window.open('../../../print_c/print_PatientSlip/".$pid."','patientSlip','width=530,height=620')"; ?>"> <i
							class="fa fa-barcode"></i> <span>Patient Slip</span>
					</a></li>
					<li class="patient_info" style="display: none;"><a onclick="<?php echo "javascript:window.open('../../../print_c/print_patient_card/".$pid."','patientCard','width=490,height=250')"; ?>"> <i
							class="fa fa-barcode"></i> <span>Patient Card</span>
					</a></li>
					<!-- <li class="patient_info" style="display: none;"><a href="<?php echo "javascript:window.open('../../../print_c/print_visitSummary/".$pid."/".$visit[0]->visitID."','visitSummary','width=530,height=662')"; ?>"> <i
							class="fa fa-barcode"></i> <span>Visit Summary</span>
					</a></li> -->
					<?php } ?>

					<li class="header" id="patient_prof_header" style="display: none;">PATIENT
						PROFILE</li>
					<li class="patient_prof" style="display: none;"><a href="#"> <i
							class="fa  fa-stack-exchange"></i> <span>Profile</span>
					</a></li>
					<li class="patient_prof" style="display: none;"><a href="#"> <i
							class="fa fa-level-up"></i> <span>Edit Profile</span>
					</a></li>
				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper" >
			<!-- Content Header (Page header) -->

            <?php echo $template['body']; ?>

        </div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Version</b> 1.5
			</div>
			<strong>Copyright &copy; 2014-2017 <a href="http://sliit.lk">Digital
					Pulz</a>.
			</strong> All rights reserved.
		</footer>
	</div>
	<!-- ./wrapper -->


    <!-- jQuery 2.1.3 -->
	<!--<script type="text/javascript"
		src="<?php /*echo base_url('public/plugins/jQuery/jQuery-2.1.3.min.js'); */?>"></script>-->
	 <!-- <script src="<?= base_url('/Bootstrap/js/jquery-3.2.1.min.js'); ?>"></script> -->

	 <script src="<?= base_url('/Bootstrap/js/jquery-ui.min.js'); ?>"></script>

	<!-- Bootstrap 3.3.2 JS -->
	<script type="text/javascript"
		src="<?php echo base_url('public/bootstrap/js/bootstrap.min.js'); ?>"></script>
	<!-- FastClick -->
	<script type="text/javascript"
		src="<?php echo base_url('public/plugins/fastclick/fastclick.min.js'); ?>"></script>
	<script type="text/javascript"
		src="<?php echo base_url('public/dist/js/app.min.js'); ?>"></script>
	<script type="text/javascript"
		src="<?php echo base_url('public/dist/js/demo.js'); ?>"></script>
<!--	<script type="text/javascript"-->
<!--		src="--><?php //echo base_url('public/dist/js/DT_bootstrap.js'); ?><!--"></script>-->
	<!-- AdminLTE for demo purposes -->
	<script type="text/javascript"
		src="<?php echo base_url('public/plugins/datatables/jquery.dataTables.js'); ?>"></script>
	<script type="text/javascript"
		src="<?php echo base_url('public/plugins/datatables/dataTables.bootstrap.js'); ?>"></script>
	<script type="text/javascript"
		src="<?php echo base_url('public/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
    <script type="text/javascript"
		src="<?php echo base_url('public/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
<!--	<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.0.0/js/bootstrap-datetimepicker.min.js"></script>	-->
		

	<script type="text/javascript">
        $(function () {
            $('#tabletestp,#tabletestp_1,#tabletestp_2,#tabletestp_3,#tabletestp_4,#tabletestp_5,#tabletestp_6').dataTable({
                "bPaginate": true,
                "bLengthChange": true,
                "bFilter": true,
                "bSort": true,
                "bInfo": true,
                "bAutoWidth": true
            });
           // $( "#patientview" ).hide();
        });
    </script>

<script type="text/javascript">
    var noOfgradeLoad = 0;
    $('document').ready(function () {


        //$('.combobox').combobox({bsVersion: '2'});


        var TestID = 0;
        $("#TestName").change(function () {
            TestID = $(this).children(":selected").attr("id");

        });


        var PID = 0;
        $("#PatientID").change(function () {
            PID = $(this).children(":selected").attr("id");
        });


        var LabID = 0;
        $("#LabID").change(function () {
            LabID = $(this).children(":selected").attr("id");
        });


        var SCID = 0;
        $("#SCID").change(function () {
            SCID = $(this).children(":selected").attr("id");
        });


//Test Name drop down
        function GetTestNames() {
            $.ajax()({
                url: 'Lab/newtestrequest/GetAllTestNames',
                dataType: 'JSON',
                success: function (test) {
                    $.each(test, function (key, val) {

                        // alert(JSON.stringify(val['test_Name']));
                        $('#TestName').append($('<option ID=' + val['test_ID'] + '>').text(val['test_Name']).attr('test_Name', val['test_Name']));

                    });

                },
                async: false
            });


        }

        function getTest() {
            if (noOfgradeLoad === 0) {
                noOfgradeLoad = noOfgradeLoad + 1;
                document.getElementById('TestName').options.length = 0;
                $.ajax({
                    url: 'http://localhost/OPD/index.php/Lab/NewTestRequest/GetAllTestNames',
                    type: 'POST',
                    crossDomain: true,
                    success: function (data) {

                        var json_parsed = $.parseJSON(data);
                        for (var i = 0; i < json_parsed.length; i++) {
                            var newOption = $('<option>');
                            newOption.attr('value', json_parsed[i]['test_Name']).text(json_parsed[i]['test_Name']);
                            $('#TestName').append(newOption);
                        }
                    }
                });

            }
        }


        function GetPatients() {
            $.ajax({
                url: 'Lab/newtestrequest/GetAllPatients',
                dataType: 'JSON',
                success: function (test) {
                    alert(test);
                    $.each(test, function (key, val) {
                        //alert(JSON.stringify(val));
                        $('#PatientID').append($('<option ID=' + val['patientID'] + '>').text(+val['patientID'] + "________" + val['patientFullName']).attr('PatientName', val['patientFullName']));

                    });
                },
                async: false
            });
        }


        function GetAllLabs() {
            $.ajax({
                url: 'Lab/newtestrequest/GetAllLabs',
                dataType: 'JSON',
                success: function (test) {
                    $.each(test, function (key, val) {
                        //alert(JSON.stringify(val));
                        $('#LabID').append($('<option ID=' + val['lab_ID'] + '>').text(+val['lab_ID'] + "________" + val['lab_Name']).attr('lab_Name', val['lab_Name']));

                    });
                },
                async: false
            });
        }


        function GetAllSampleCentres() {
            $.ajax({
                url: 'Lab/newtestrequest/GetAllSampleCentres',
                dataType: 'JSON',
                success: function (test) {
                    $.each(test, function (key, val) {
                        //alert(JSON.stringify(val));
                        $('#SCID').append($('<option ID=' + val['sampleCenter_ID'] + '>').text(+val['sampleCenter_ID'] + "________" + val['sampleCenter_Name']).attr('sampleCenter_Name', val['sampleCenter_Name']));

                    });
                },
                async: false
            });
        }

    });
 // $('#datetimepicker1').datepicker({
 //            changeMonth: true,
 //            changeYear: true,
 //            dateonly: true,
 //            dateFormat: 'yyyy-mm-dd'
 //        });
           
   
 // });

     
</script>


</body>
</html>
