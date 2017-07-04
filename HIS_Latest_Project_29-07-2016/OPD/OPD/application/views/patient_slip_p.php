<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<style>
body
{

background-image:url("<?php echo base_url()."/assets/"?>img/presback.png");
}
</style>
<div class="container"  >

<div class="span10">

	<div id="header" style="text-align: center;line-height: 10px;margin-top: 10px" >
	
		<h2>Hospital Name</h2>
		<h3>Patient Slip</h3>
	</div>
	
	<hr>
	
	<div id="pdetails"  style="margin-left: 30px;">
		<table  >
		
			<tr>
				<td><strong> Patient Name </strong><td>
				<td> <?php echo $pprofile->patientTitle.$pprofile->patientFullName ;?> <td>
				
				<td><strong> Patient No </strong><td>
				<td> <?php echo $pprofile->patientID;?> <td>

			</tr>
			
			<tr>
				<td><strong> Address </strong><td>
				<td  style="width:200px"> <br><?php echo $pprofile->patientAddress;?> <td>
				
				<td><strong> Age </strong><td>
				<td>~<?php 
                    date_default_timezone_set('Asia/Colombo');
                    echo (date("Y") - date("Y",$pprofile->patientDateOfBirth/1000));  ?>Yrs <?php 
                    date_default_timezone_set('Asia/Colombo');
                    echo (date("m") - date("m",$pprofile->patientDateOfBirth/1000));  ?>Mths <?php 
                    date_default_timezone_set('Asia/Colombo');
                    echo (date("d") - date("d",$pprofile->patientDateOfBirth/1000));  ?>Dys</td>
				
			</tr>
			
		</table> 
	</div>
	<hr>
 
   
</div>

</div>