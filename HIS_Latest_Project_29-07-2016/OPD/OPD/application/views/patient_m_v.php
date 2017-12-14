<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<script type="text/javascript">
	document.getElementById('patient_overview_header').style.display = "";
	document.getElementById('patient_info_header').style.display = "";
	document.getElementById('patient_prof_header').style.display = "";
	
	document.getElementsByClassName('patient_overview')[0].style.display = "";
	document.getElementsByClassName('patient_info')[0].style.display = "";

	var cusid_ele = document.getElementsByClassName('patient_prof');  
	for (var i = 0; i < cusid_ele.length; ++i) {
	       document.getElementsByClassName('patient_prof')[i].style.display = "";
	}
	document.getElementsByClassName('patient_prof')[0].className = 'patient_prof active';
</script>


<!-- <script
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyALHNMgTwlPonpGFR5QvnZcn4BvNcE8uoc&v=3.exp&libraries=places"></script> -->
<script type="text/javascript">
				function initialize() {
					
					//var input = document.getElementById('address');
//					var options = {componentRestrictions: {country: 'SL'}};
					//new google.maps.places.Autocomplete(input);
				}
             
				//google.maps.event.addDomListener(window, 'load', initialize);
			</script>


<script>
    $("#title").change(function() {
    	$("#cstatus").attr("disabled", this.value=="Baby"); 
  
	});

    function extractLast(term) {
        return split(term).pop();
    }
    function split(val) {
        return val.split(/,\s*/);
    }

	$(document).ready(function() {

		var availableTags = [];

	    $("#village").keydown(function()
	    {
	    	if($("#village").val().length >= 3)
	    	{
	    		availableTags = [];
	    		$.ajax({ 

	             	 type: 'GET',
	                 url: '<?php echo base_url();?>index.php/patient_c/getVillageOnSearch/'+$('#village').val(),
	                 dataType:'json',  //'http://localhost:8080/HIS_API/rest/PharmacyServices/drugStockTable',
	                 success: function(result) {
	                 	//console.log(result);
	                 	var res=result;
					    jQuery.each(res, function(index, value){
					    	var text = value.gndivision +", "+ value.dsdivision;
					        availableTags.push(text);
					    });
	                 	//availableTags = result;
						$( "#village" ).autocomplete({
					      source: availableTags,
					      minLength:2
					    });
					},
					// error: function (xhr, ajaxOptions, thrownError) {
			  //       alert(xhr.status);
			  //       alert(thrownError);
			  //     }
				});
	    	}
	    });
	});

	function setDob($years=0, $months=0, $days=0)
	{
		if($years=="")
		{
			$years=0;
		}
		if($months=="")
		{
			$months=0;
		}
		if($days=="")
		{
			$days=0;
		}
		var now = new Date();

		var yearNow = now.getFullYear();
		var monthNow = now.getMonth()+1;
		var dateNow = now.getDate();

		var yearDob = yearNow-$years;

		if (monthNow >= $months)
		{
			var monthDob = monthNow - $months;
		}
		else
		{	
			yearDob--;
			var monthDob = 12 + monthNow - $months;
		}
		if (dateNow >= $days)
		{
			var dateDob = dateNow - $days;
		}
		else
		{
			monthDob--;
			var dateDob = 31 + dateNow - $days;
		}

		if (monthDob == 0) 
		{
			monthDob=12;
			yearDob--;
		}

		if(dateDob == 0)
	  	{
	  		dateDob=31;
	  		monthDob--;
	  	}

	  	if(monthDob.toString().length < 2)
	  	{
	  		monthDob = "0"+monthDob;
	  	}
	  	if(dateDob.toString().length < 2)
	  	{
	  		dateDob = "0"+dateDob;
	  	}
		//console.log(yearDob+"-"+monthDob+"-"+dateDob);
		$('#dob').val(yearDob+"-"+monthDob+"-"+dateDob);
	}

	function setDates()
	{
		var now = new Date();

				var yearNow = now.getFullYear();
				var monthNow = now.getMonth();
				var dateNow = now.getDate();
				//date must be mm/dd/yyyy
				var dob = new Date($('#dob').val());

				var yearDob = dob.getFullYear();
				var monthDob = dob.getMonth();
				var dateDob = dob.getDate();
				var age = {};
				var ageString = "";
				var yearString = "";
				var monthString = "";
				var dayString = "";


				var yearAge = yearNow - yearDob;

				if (monthNow >= monthDob)
				  var monthAge = monthNow - monthDob;
				else {
				  yearAge--;
				  var monthAge = 12 + monthNow - monthDob;
				}

				if (dateNow >= dateDob)
				  var dateAge = dateNow - dateDob;
				else {
				  monthAge--;
				  var dateAge = 31 + dateNow - dateDob;

				  if (monthAge <= 0) {
				    monthAge = 11;
				    yearAge--;
				  }
				  if(dateAge <= 0)
				  {
				  	dateAge = 31;
				  	monthAge--;
				  }
				}

				$('#ageY').val(yearAge);
				$('#ageM').val(monthAge);
				$('#ageD').val(dateAge);
	}
    
    $(document).ready(function() {

    	setDates();

    	$('#dob').change(function(){
    		if($('#dob').val()!="")
			{
				setDates();
			}
		});

    	$('#ageY').change(function(){
    		setDob($('#ageY').val(),$('#ageM').val(),$('#ageD').val());
    		if($('#ageY').val() != "")
    		{
    			$('#dob').attr("required", false);
    		}
    		else
    		{
    			$('#dob').attr("required", true);
    		}

    	});

    	$('#ageM').change(function(){
    		setDob($('#ageY').val(),$('#ageM').val(),$('#ageD').val());
    		if($('#ageM').val() != "")
    		{
    			$('#dob').attr("required", false);
    		}
    		else
    		{
    			$('#dob').attr("required", true);
    		}
    	});

    	$('#ageD').change(function(){
    		setDob($('#ageY').val(),$('#ageM').val(),$('#ageD').val());
    		if($('#ageD').val() != "")
    		{
    			$('#dob').attr("required", false);
    		}
    		else
    		{
    			$('#dob').attr("required", true);
    		}
    	});

        $("#fullname").keypress(function(event) {
            if ((event.which > 47 && event.which < 58))
            {
                event.preventDefault();
            }
        });


        $("#btnsave").click(function(){

        	//alert($('#webcamImg').attr('src'));
        	var img = $('#webcamImg').attr('src');
			
			patient_name = $('#fullname').val();
			patient_name = patient_name.replace(" ", "_"); 
			var file = $('#hiddenInput').val()+patient_name+'_image.png';
			$('#imageName').val(patient_name+'_image.png');
			//alert(file + "/n   " + img);

			$.ajax({ 

             	 type: 'POST',
                 url: '<?php echo base_url(); ?>index.php/patient_c/saveImage',
                 data:{'img': img, 'path': file},
                 success: function(result) { 
						alert("Image saved " + result);           
                 }

            }); 
        });


        var allempty = true;
        $('#nic,#hin ,#contactpname, #photo, #uplddfnm').change(function() {

            $('#nic,#hin ,#contactpname, #photo, #uplddfnm').each(function() {

                if ($(this).val() != '') {

                    allempty = false;
                }
                if (allempty) {

                    $('#nic,#hin ,#contactpname, #photo, #uplddfnm').attr('required', 'required');
                } else
                {
                    $('#nic,#hin ,#contactpname, #photo, #uplddfnm').removeAttr('required');
                }
            });
            allempty = true;
        });


        $('#nic,#hin ,#contactpname,#photo, #uplddfnm').each(function() {

            if ($(this).val() != '') {

                allempty = false;
            }
            if (allempty) {

                $('#nic,#hin,#contactpname, #photo, #uplddfnm').attr('required', 'required');
            } else
            {
                $('#nic,#hin ,#contactpname, #photo, #uplddfnm').removeAttr('required');
            }
        });


        var previousTitle;

        $("#title").focus(function() {
            previousTitle = this.value;
        }).change(function() {

            if (this.value == "Unknown")
            {
                $('#myform :input').removeAttr('required');
                $('#myform :input').attr('readonly', 'readonly');
                $('#gender').removeAttr('readonly');
                $('#photo').removeAttr('readonly');
                $('#remarks').removeAttr('readonly');
                  $('#cstatus').attr('disabled', 'disabled');
                $('#gender').attr('required', 'required');
                $('#photo').attr('required', 'required');
                $('#remarks').attr('required', 'required');
                $(this).removeAttr('readonly');
            }

            if (this.value == "Rev")
            {
                $('#myform :input').removeAttr('readonly');
                 $('#cstatus').attr('disabled', 'disabled');
            }

            if (this.value == "Miss.")
            {
                $('#myform :input').removeAttr('readonly');
                 $('#cstatus').attr('disabled', 'disabled');
            }

            if (this.value == "Baby")
            {

                $('#myform :input').removeAttr('readonly');
                $("#lblnic").html("Guardians NIC");

                $('#guarname').attr('required', 'required');
                $('#nic').attr('readonly', 'readonly');//.attr('required', 'required');
                $('#dob').attr('required', 'required');
                $("#dob").html("Date of Birth*");

                $("#lblcontactname").html("Guardians Name*");
                $("#lblcontactno").html("Guardians Telephone*");
                $("#lblpassport").html("Guardians Passport");
                $("#lblhin").html("Childs HIN");
                $("#lblphoto").html("Guardians Photo");

                $('#contactpname').attr('required', 'required');
                $('#contactpno').attr('required', 'required');

                $("#lbladdress").html("Guardians Address*");
                $("#village").attr('required', 'required');

                $("#contactorguardian").insertAfter($("#grpcivil"));

                $("#grplang").hide();
                $("#grptel").hide();
          		  $('#cstatus').attr('disabled', 'disabled');
               // $('#cstatus').attr('readonly', 'readonly');
            } else
            {
                // refresh
                if (previousTitle == "Baby" | previousTitle == "Rev" | previousTitle == "Unknown" | previousTitle == "Miss.") {
                    document.location.reload(true);
                }
            }
            previousTitle = this.value;
        });

        function makeform(title) {

            if (title == "Rev")
            {
                  $('#cstatus').attr('disabled', 'disabled');
            }


            if (title == "Baby")
            {

                $("#lblnic").html("Guardians NIC*");

                //$('#nic').attr('required', 'required');
                $('#dob').attr('required', 'required');
                $("#dob").html("Date of Birth*");
                $('#nic').attr('readonly', 'readonly');
                $("#lblcontactname").html("Guardians Name*");
                $("#lblcontactno").html("Guardians Telephone*");

                $('#contactpname').attr('required', 'required');
                $('#contactpno').attr('required', 'required');

                $("#lbladdress").html("Guardians Address*");
                $("#village").attr('required', 'required');

                $("#contactorguardian").insertAfter($("#grpcivil"));

                $("#grplang").hide();
                $("#grptel").hide();


                $('#cstatus').attr('disabled', 'disabled');

            }

        }

        // $(function() {
            
        //     $("#dob").datepicker();
        //     $("#dob").datepicker("option", "dateFormat", "yy-mm-dd");
        //     $("#dob").datepicker("option", "changeMonth", "true");
        //     $("#dob").datepicker("option", "changeYear", "true");

        // });


 /*       $('#dob').change(function() {

            if ($('#title').val() != "Baby" & $('#nic').val() != "") {
                var nic = $('#nic').val();
                var dob = $('#dob').val();
                if (nic[0] != dob[2] | nic[1] != dob[3])
                {
                    alert("NIC doesn't match the value given for Date of Birth");
                    $('#dob').val('');
                }
            }
        });

        $('#nic').change(function() {

            if ($('#title').val() != "Baby" & $('#dob').val() != "") {
                var nic = $('#nic').val();
                var dob = $('#dob').val();
                if (nic[0] != dob[2] | nic[1] != dob[3])
                {
                    alert("NIC doesn't match the value given for Date of Birth");
                    $('#nic').val('');
                }
            }
        });*/

<?php
if (preg_match ( '/Edit/', $title )) {
	/*
	echo "
	$('#dob').datepicker({ 
   
     }).datepicker('setDate',  '" . date("Y-m-d",$pprofile->patientDateOfBirth/1000). "' )";*/
  
	
	if ($pprofile->patientPhoto != NULL & $pprofile->patientPhoto != "null") {
		echo "
                                        $('#nic').removeAttr('required');
                                        $('#passport').removeAttr('required');
                                        $('#hin').removeAttr('required');
                                        $('#photo').removeAttr('required');
                                         $('#contactpname').removeAttr('required');
                                ";
	}
}
?>

<?php
if (preg_match ( '/Edit/', $title ) && ($pprofile->patientTitle == 'Baby' | $pprofile->patientTitle == 'Rev')) {
	echo "makeform('" . $pprofile->patientTitle . "')";
}

if (preg_match ( '/Edit/', $title ) && $pprofile->patientActive == '0') {
	echo "$('#myform :input:not(#active):not(.btn-primary)').attr('disabled', true); ";
}
?>


<?php
if (! preg_match ( '/Edit/', $title )) {
	if ($status != null && $status != '0' && $status != "False") {
		$pid = $status;
		echo "window.open('../../index.php/print_c/print_patient_card/" . $pid . "','patientSlip','width=490,height=250');";
		echo "window.location = '../operator_home_c/viewpatient/" . $pid . "';";
	}
}
?>


    });

</script>
<!-- <div class="modal-example">
<section class="content-header">
	<h1>
		Patient <small> <?php echo $title; ?></small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#"><i class="fa fa-wheelchair"></i> Patient</a></li>
		<li class="active"><?php echo $title; ?>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
	</ol>
</section> -->
 	<div class="row">
<?php if($title=="Edit Patient"){?>

		<div class="col-md-6 col-md-offset-3">

			<div class="container">

				<div class="row">
					<div class="col-md-8 col-lg-6">

						<!-- /.box-header -->
						<div class="panel panel-primary" style="margin-top: 8px;">
            <div class="panel-heading">
              <h3 class="panel-title">Patient Information</h3>
            </div>
            <div class="panel-body">
							<div class="box-header with-border">
								<i class="fa  fa-wheelchair"></i>
								<h3 class="box-title">Patient Profile</h3>
							</div>
							<hr>
							<div class="col-sm-12">
								<div class="col-xs-12 col-sm-8">
									<h2><?php
	if ($pprofile->patientTitle == "Baby")
		echo "$pprofile->patientTitle $pprofile->patientFullName";
	else
		echo "$pprofile->patientTitle $pprofile->patientFullName";
	?> </h2>
									<table>
										<tr>
											<td style="padding-right: 40px"><strong>HIN</strong></td>
											<td style="padding-left: 10px">
                    <?php echo "$pprofile->patientHIN"; ?></td>
										</tr>

										<tr>
											<td><strong>Gender</strong></td>
											<td style="padding-left: 10px">
                    <?php echo "$pprofile->patientGender"; ?></td>
										</tr>
										<tr>
											<td style="width: 90px"><strong>Civil Status</strong></td>
											<td style="padding-left: 10px">
				<?php echo "$pprofile->patientCivilStatus";?></td>

										</tr>
										<tr>
											<td style="width: 50px"><strong>Date of Birth</strong></td>
											<td style="padding-left: 10px">   
				<?php 
				date_default_timezone_set('Asia/Colombo');
				
				echo date("Y-m-d",$pprofile->patientDateOfBirth/1000);  ?></td>
										</tr>

									</table>
								</div>
							</div>
							<div class="row">
								<div class="pull-right col-xs-12 col-sm-4 emphasis"></div>
							</div>
						</div>
					</div>
				</div>
				<!-- /.box -->
			</div>
			<!-- ./col -->
		</div>

	</div>
	<?php }?>


			

			
		<!-- left column -->
		<div class=" col-md-12 ">
     
 <div class = 'modal-example'>
  <div class="panel panel-info">
			<div class="panel-heading">
			
					<h3 class="panel-title"><?php echo $title; ?></h3>
				</div>
				 <div class="panel-body">
				
<?php
if (preg_match ( '/Edit/', $title )) {
	
	echo form_open_multipart ( 'patient_c/update/' . $pid, array (
			'name' => 'myform',
			'id' => 'myform' 
	) );
} else {
	echo form_open_multipart ( 'patient_c/save', array (
			'name' => 'myform',
			'id' => 'myform' 
	) );
}
?>




				<!-- Message for operation status  ************************************************************** --> 
        <?php
								if ($status != '0') {
									echo "<div class='row'>	<div class='container'>	<div class='col-xs-12'>";
									if (! preg_match ( '/Edit/', $title ) & $status == "True") {
										?>
                    <div class="alert alert-success"
					style="margin-right: 5%">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Successfull ! Patient added successfully</strong>

				</div>
                <?php } else if (preg_match('/Edit/', $title) & $status == "True") { ?>

                    <div class="alert alert-success"
					style="margin-right: 5%">
					<strong>Successfull ! </strong> Patient updated Successfully
					<button type="button" class="close" data-dismiss="alert">&times;</button>

				</div>

    <?php } ?>


                <?php if ((!preg_match('/Edit/', $title)) & $status == "False") { ?>

                    <div class="alert alert-danger"
					style="height: 50px; margin-right: 5%">
					<strong>Fail !</strong> Failed to add the patient
					<button type="button" class="close" data-dismiss="alert">&times;</button>

				</div>


    <?php } else if (preg_match('/Edit/', $title) & $status == "False") { ?>

            <div class="alert alert-danger"
					style="height: 50px; margin-right: 5%">
					<strong>Fail !</strong> Faild to update the patient
					<button type="button" class="close" data-dismiss="alert">&times;</button>

				</div>
    <?php } ?>
<?php echo "</div></div></div>";} ?>
            <!-- **************************************************************************************** --> 		
            <?php if (preg_match('/Edit/', $title) && $pprofile->patientActive == '0') { ?>
            <div class='row'>
					<div class='modal-example'>
						<div class='col-xs-12'>
							<div class="alert alert-danger">
								The record <strong> is not active </strong>
							</div>
						</div>
					</div>
				</div>
<?php } ?>


				<div class="modal-example">
					<div class="box-header with-border">
						<h3 class="box-title">Patient Personal Details </h3>
						<input id="hiddenInput" type="text" value="/uploads/patient_photos/" hidden>
						<input id="imageName" name="imageName" type="text" value="" hidden>
					</div>
					<br>
					<div class="row">
						<div class="col-xs-3">
							<div class="input-group">

								<span class="input-group-addon" >Title <span style="color:red">*</span></span> <select
									class="form-control" id="title" name="title"
									required="required">
									<option
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientTitle == 'Mr.') {
											echo 'selected';
										}
										?>
										value="Mr.">Mr.</option>
									<option
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientTitle == 'Miss.') {
											echo 'selected';
										}
										?>
										value="Miss.">Miss.</option>
									<option
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientTitle == 'Mrs.') {
											echo 'selected';
										}
										?>
										value="Mrs.">Mrs.</option>
									<option
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientTitle == 'Rev.') {
											echo 'selected';
										}
										?>
										value="Rev">Rev</option>
									<option
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientTitle == 'Baby') {
											echo 'selected';
										}
										?>
										value="Baby">Baby</option>
									<option
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientTitle == 'Unknown') {
											echo 'selected';
										}
										?>
										value="Unknown">Unknown</option>
								</select>


							</div>


						</div>
						<div class="col-xs-4" >
							<div class="input-group"  >
								<span class="input-group-addon" >Name In Full <span style="color:red">*</span></span> <input
									type="text" class="form-control" pattern="[A-Za-z\s]*"
									id="fullname" name="fullname" required="required"
									value="<?php
									
									if (preg_match ( '/Edit/', $title )) {
										echo $pprofile->patientFullName;
									}
									?>" />
							</div>

						</div>

						<div class="col-xs-4">
							<div class="input-group">
								<span class="input-group-addon">Other Names </span> <input
									type="text" class="form-control" pattern="[A-Za-z]+"
									id="personalname" name="personalname"
									value="<?php
									
									if (preg_match ( '/Edit/', $title )) {
										echo $pprofile->patientPersonalUsedName;
									}
									?>" />
							</div>

						</div>
					</div>
					<br>
					<div class="row">

					
						<div class="col-xs-3">
							<div class="input-group ,input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd"  >
							
								<span class="input-group-addon">Date Of Birth <span style="color:red ">*</span></span> 
					
								<input class="form-control"  type="text" id="dob" name="dob"   required="required"  
								 value="<?php

									if (preg_match ( '/Edit/', $title )) {
										echo date("Y-m-d",$pprofile->patientDateOfBirth/1000);
									}
									?>" />
								
									
							</div>
						</div>

						<div class="col-xs-2">
							<div class="input-group">
								<span class="input-group-addon" >Gender <span style="color:red">*</span></span> <select
									class="form-control" id="gender" name="gender"
									required="required">
									<option class=""
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientGender == 'Male') {
											echo 'selected';
										}
										?>
										value="Male">Male</option>
									<option class=""
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientGender == 'Female') {
											echo 'selected';
										}
										?>
										value="Female">Female</option>
									<option class=""
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientGender == 'Other') {
											echo 'selected';
										}
										?>
										value="Other">Other</option>
								</select>
							</div>

						</div>
						<div class="col-xs-3">
							<div class="input-group" >
								<span class="input-group-addon" >Civil Status <span style="color:red">*</span></span> <select
									class="form-control " id="cstatus" name="cstatus"
									required="required">
									<option
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientCivilStatus == 'Single') {
											echo 'selected';
										}
										?>
										value="Single">Single</option>
									<option
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientCivilStatus == 'Married') {
											echo 'selected';
										}
										?>
										value="Married">Married</option>
									<option
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientCivilStatus == 'Divorced') {
											echo 'selected';
										}
										?>
										value="Divorced">Divorced</option>
									<option
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientCivilStatus == 'Widow') {
											echo 'selected';
										}
										?>
										value="Widow">Widow</option>
									<option
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientCivilStatus == 'Unknown') {
											echo 'selected';
										}
										?>
										value="UnKnown">Unknown</option>
								</select>
							</div>

						</div>
					</div>
					<br>
					<div class="row">

					
						<div class="col-xs-5">
							<div class="input-group">
							
								<span class="input-group-addon">Age of Patient</span> 
					
								<input class="form-control"  type="number" id="ageY" name="ageY" min="0" 
								 value="<?php

									if (preg_match ( '/Edit/', $title )) {
										echo (date("Y") - date("Y",$pprofile->patientDateOfBirth/1000));
									}
									?>" /><span class="input-group-addon">Years</span> 
								<input class="form-control form-inline"  type="number" id="ageM" name="ageM" min="0" max="11"
								 value="<?php

									if (preg_match ( '/Edit/', $title )) {
										echo (date("m") - date("m",$pprofile->patientDateOfBirth/1000));
									}
									?>" /><span class="input-group-addon">Months</span> 
								<input class="form-control form-inline"  type="number" id="ageD" name="ageD" min="0" max="31"
								 value="<?php

									if (preg_match ( '/Edit/', $title )) {
										echo (date("d") - date("d",$pprofile->patientDateOfBirth/1000));
									}
									?>" /><span class="input-group-addon">Days</span> 
								
									
							</div>
						</div>
					</div>
					<div class="box-header with-border">
						<h3 class="box-title">Patient Identity Details</h3>
					</div>
					<br>
					<div class="row">
						<div class="col-xs-3">
							<div class="input-group" >
								<span class="input-group-addon" >NIC <span style="color:red">*</span></span><input type="text"
									class="form-control" required="required" id="nic" name="nic"
									value="<?php
									
									if (preg_match ( '/Edit/', $title )) {
										echo $pprofile->patientNIC;
									}
									?>"
									pattern="[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][vV]" />
							</div>

						</div>
						<div class="col-xs-3">
							<div class="input-group">
								<span class="input-group-addon">Passport</span><input
									type="text" class="form-control" id="passport" name="passport" />
							</div>

						</div>

						<div class="col-xs-3">
							<div class="input-group" >
								<span class="input-group-addon" >Citizenship <span style="color:red">*</span></span><input
									type="text" class="form-control" required="required" id="citizen" name="citizen" 
									
									value="<?php
								
									if (preg_match ( '/Edit/', $title )) {
										echo $pprofile->patientCitizenship;

									}
									?>"pattern="[A-Z a-z]+"/>
							</div>

						</div>

                        
						<div class="col-xs-3">
							<div class="input-group" >
								<span class="input-group-addon" >Blood Group <span style="color:red">*</span></span><select
									class="form-control" id="blood" name="blood">
									<option class=""
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientblood == 'A+') {
											echo 'selected';
										}
										?>
										value="A+">A+</option>
									<option class=""
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientblood == 'A-') {
											echo 'selected';
										}
										?>
										value="A-">A-</option>
										<option class=""
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientblood == 'B+') {
											echo 'selected';
										}
										?>
										value="B+">B+</option>
										<option class=""
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientblood == 'B-') {
											echo 'selected';
										}
										?>
										value="B-">B-</option>
										<option class=""
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientblood == 'AB') {
											echo 'selected';
										}
										?>
										value="AB">AB</option>
										<option class=""
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientblood == 'O+') {
											echo 'selected';
										}
										?>
										value="O+">O+</option>
										<option class=""
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientblood == 'O-') {
											echo 'selected';
										}
										?>
										value="O-">O-</option>
									
								</select>
							</div>

						</div>
                        
                        <br>
                        <br>
                        <br>

						<div class="col-xs-3">
							<div class="input-group" >
								<span class="input-group-addon" >Preffered Language <span style="color:red">*</span></span> <select
									class="form-control" id="lang" name="lang" required="required">
									<option class=""
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientPreferredLanguage == 'Sinhala') {
											echo 'selected';
										}
										?>
										value="Sinhala">Sinhala</option>
									<option class=""
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientPreferredLanguage == 'Tamil') {
											echo 'selected';
										}
										?>
										value="Tamil">Tamil</option>
									<option class=""
										<?php
										
										if (preg_match ( '/Edit/', $title ) && $pprofile->patientPreferredLanguage == 'English') {
											echo 'selected';
										}
										?>
										value="English">English</option>
								</select>
							</div>

						</div>

					</div>
					 <br>
					<div class="box-header with-border">
						<h3 class="box-title">Patient Contact Details</h3>
					</div>
					<br>
					<div class="row">
						<div class="col-xs-5">
							<div class="input-group" >
								<span class="input-group-addon" >Address 1</span></span><input
									class="form-control" id="address1" name="address1"
									required="required"
									value="<?php
									
									if (preg_match ( '/Edit/', $title )) {
										$pieces = explode(", ", $pprofile->patientAddress);
										
										if(sizeof($pieces)==3 || sizeof($pieces)==4)
											echo $pieces[0];
									}
									?>" />
							</div>

						</div>
						<div class="col-xs-3">
							<div class="input-group" >
								<span class="input-group-addon">Phone <span style="color:red">*</span></span><input type="text"
									class="form-control" id="telephone" pattern="^[0-9]{10}$"
									name="telephone" required="required"
									value="<?php
									
									if (preg_match ( '/Edit/', $title )) {
										echo $pprofile->patientTelephone;
									}
									?>">
							</div>

						</div>
					</div>
					<br/>
					<div class="row">
						<div class="col-xs-5">
							<div class="input-group" >
								<span class="input-group-addon" >Address 2</span></span><input
									class="form-control" id="address2" name="address2"
									required="required"
									value="<?php
									
									if (preg_match ( '/Edit/', $title )) {
										$pieces = explode(", ", $pprofile->patientAddress);

										if(sizeof($pieces)==4)
											echo $pieces[1];
									}
									?>" />
							</div>

						</div>
						<div class="col-xs-4">
							<div class="input-group">
							<span class="input-group-addon">Guardian Tel</span><input
									type="text" class="form-control" id="contactpno"
									name="contactpno" pattern="^[0-9]{10}$"
									value="<?php
									
									if (preg_match ( '/Edit/', $title )) {
										echo $pprofile->patientContactPNo;
									}
									?>" />
							</div>

						</div>
					</div>
					<br/>
					<div class="row">
						<div class="col-xs-5">
							<div class="input-group" >
								<span class="input-group-addon" >Village <span style="color:red">*</span></span><input
									class="form-control ui-widget" id="village" name="village"
									required="required"
									value="<?php
									
									if (preg_match ( '/Edit/', $title )) {
										$pieces = explode(", ", $pprofile->patientAddress);
										if(sizeof($pieces)==4)
											echo $pieces[2].", ".$pieces[3];
										else if(sizeof($pieces)==3)
											echo $pieces[1] .", ".$pieces[2];
										else
											echo $pprofile->patientAddress;
									}
									?>" />
							</div>

						</div>
						

					</div>
					<br>
					<div class="row">
						<div class="col-xs-4">
							<div class="input-group">
								<span class="input-group-addon">Guardian</span><input
									type="text" class="form-control" pattern="[A-Z a-z]+"
									id="contactpname" name="contactpname"
									value="<?php
									
									if (preg_match ( '/Edit/', $title )) {
										echo $pprofile->patientContactPName;
									}
									?>" />
							</div>

						</div>

						
					</div>
					<br> <br>
					<div class="box-header with-border">
						<h3 class="box-title">Patient Other Details</h3>
					</div>
					<br>
					<div class="row">
						<div class="col-xs-4">
							<div class="input-group">
								<span class="input-group-addon">Remarks</span>
								<textarea class="form-control" id="remarks" name="remarks"
									rows="3"><?php
									
									if (preg_match ( '/Edit/', $title )) {
										echo $pprofile->patientRemarks;
									}
									?></textarea>

							</div>

						</div>
						<div class="col-xs-3">
							<div class="input-group">
								<span class="input-group-addon">Photo</span> <?php
								if (preg_match ( '/Edit/', $title ) && ($pprofile->patientPhoto != NULL & $pprofile->patientPhoto != "null")) {
									echo "<a href=" . base_url () . "/uploads/patient_photos/" . basename ( $pprofile->patientPhoto ) . PHP_EOL . "><div name='uplddfnm' id='uplddfnm'  class='form-control'>" . basename ( $pprofile->patientPhoto ) . PHP_EOL . " </div></a>";
								}
								?>
                				<div class="controls">
									<input type="file" class="form-control" id="photo"
										name="userfile" value="">
									<br/>
									<span class="input-group-addon">
										<button type="button" data-toggle="modal" data-target="#myModal">Take Photo</button>
									</span>

									<!-- Modal -->
									<div id="myModal" class="modal fade" role="dialog">
									  <div class="modal-dialog">

									    <!-- Modal content-->
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="btn btn-default btn-sm close" data-dismiss="modal">&times;</button>
									        <h4 class="modal-title">Take Photo</h4>
									      </div>
									      <div class="modal-body">
									        <div id="my_photo_booth">
												<div id="my_camera" style="width:800px; margin:0 auto;"></div>
												
												<!-- First, include the Webcam.js JavaScript Library -->
												 <script src="<?= base_url('/Bootstrap/js/webcam.min.js'); ?>"></script>
												<!-- Configure a few settings and attach camera -->
												<script language="JavaScript">
													Webcam.set({
														// live preview size
														width: 320,
														height: 240,
														
														// device capture size
														dest_width: 640,
														dest_height: 480,
														
														// final cropped size
														crop_width: 480,
														crop_height: 480,
														
														// format and quality
														image_format: 'jpeg',
														jpeg_quality: 90,
														
														// flip horizontal (mirror mode)
														flip_horiz: false
													});
													Webcam.attach( '#my_camera' );
												</script>
												
												<!-- A button for taking snaps -->
												<form>
													<br>
													<div id="pre_take_buttons">
														<!-- This button is shown before the user takes a snapshot -->
														<input type=button value="Take Snapshot" class="btn btn-info btn-sm" onClick="preview_snapshot()">
													</div>
													<div id="post_take_buttons" style="display:none; ">
														<!-- These buttons are shown after a snapshot is taken -->
														<input type=button value="&lt; Take Another" class="btn btn-info btn-sm" onClick="cancel_preview()">
														<input type=button value="Save Photo &gt;" class="btn btn-info btn-sm" onClick="save_photo()" style="font-weight:bold;">
													</div>
												</form>
											</div>
											
											<div id="results" style="display:none; width:800px; margin:0 auto;">
												<!-- Your captured image will appear here... -->
												<img id="webcamImg" src=""/><br/></br>
												<input type="button" id="btnsave" class="btn btn-default" value="Save">
											</div>
											
											<!-- Code to handle taking the snapshot and displaying it locally -->

											<script language="JavaScript">
												// preload shutter audio clip
												var shutter = new Audio();
												shutter.autoplay = false;
												shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';
												
												function preview_snapshot() {
													// play sound effect
													try { shutter.currentTime = 0; } catch(e) {;} // fails in IE
													shutter.play();
													
													// freeze camera so user can preview current frame
													Webcam.freeze();
													
													// swap button sets
													document.getElementById('pre_take_buttons').style.display = 'none';
													document.getElementById('post_take_buttons').style.display = '';
												}
												
												function cancel_preview() {
													// cancel preview freeze and return to live camera view
													Webcam.unfreeze();
													
													// swap buttons back to first set
													document.getElementById('pre_take_buttons').style.display = '';
													document.getElementById('post_take_buttons').style.display = 'none';
												}
												
												function save_photo() {
													// actually snap photo (from preview freeze) and display it
													Webcam.snap( function(data_uri) {
														// display results in page
														//saveimage(data_uri);
														document.getElementById('webcamImg').src = data_uri;
															//'<h2>Here is your large, cropped image:</h2>' + 
															//'<img id="webcamImg" src="'+data_uri+'"/><br/></br>';
															
														
														// shut down camera, stop capturing
														Webcam.reset();
														
														// show results, hide photo booth
														document.getElementById('results').style.display = '';
														document.getElementById('my_photo_booth').style.display = 'none';
													} );
												}

												function saveimage($data){

										        	alert($data);
										        	var $img = $data;//$('#webcamImg').attr('src');
										        	$img = $img.replace('data:image/png;base64,', '');
													$img = $img.replace(' ', '+');
													$data = btoa($img);
													$patient_name= $('#fullname').val();
													$file = $('hiddenInput').val()+$patient_name+'_image.png';
													$success = file_put_contents($file, $data);
										        };
											</script>
									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									      </div>
									    </div>

									  </div>
									 </div>
								</div>

							</div>
						</div>


					</div>


					<br>
					<br>
					
					<?php if (preg_match('/Edit/', $title)) { ?> 
					<div class="row">

						<div class="col-xs-3">
							<div class="input-group">
								<span class="input-group-addon">Active</span> <select
									id="active" name="active" class="form-control"
									style="width: 80px">
									<option
										<?php
						
						if ($pprofile->patientActive == '1') {
							echo 'selected';
						}
						?>
										value="1">Yes</option>
									<option
										<?php
						
						if ($pprofile->patientActive == '0') {
							echo 'selected';
						}
						?>
										value="0">No</option>
								</select>

							</div>

						</div>


					</div>
					<br>
					<div class="row">
						<div class="col-xs-3">
							<div class="input-group">
								<label class="lastmod">Last edit by <?php echo $pprofile->patientLastUpdateUser->userName . " on " . date('Y-m-d h:i:s A', $pprofile->patientLastUpdate / 1000); ?></label>
							</div>
						</div>
					</div>
					<?php } ?>	
					<br> <br>
					<div class="row">
						<div class="col-xs-3">
							<div class="input-group">
								<button type="submit" id="btnsubmit" class="btn btn-primary">   <?php
								if (preg_match ( '/Edit/', $title )) {
									echo "Update";
								} else {
									echo "Save";
								}
								?> </button>
					
					
					<!-- /.box-body -->
		
					<?php echo form_close(); ?>
			

</div>
</div>
</div>
</div>
</div>


