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
				<td>  <?php  echo (date("Y") - date("Y",$pprofile->patientDateOfBirth/1000))."Yrs" ?> <td>
				
			</tr>
			
		</table> 
	</div>
	<hr>
 
   
</div>

</div>