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
		<h3>Prescription</h3>
	</div>
	
	<hr>
	
	<div id="pdetails"  style="margin-left: 30px;">
		<table  >
		
			<tr>
				<td><strong> Patient Name </strong><td>
				<td> <?php echo $pprofile->pTitle.$pprofile->pFullName ;?> <td>
				
				<td><strong> Patient No </strong><td>
				<td> <?php echo $pprofile->PID;?> <td>

			</tr>
			
			<tr>
				<td><strong> Address </strong><td>
				<td  style="width:200px"> <br><?php echo $pprofile->pAddress;?> <td>
				
				<td><strong> Age </strong><td>
				<td>  <?php  echo (date("Y") - date("Y",$pprofile->pDateOfBirth/1000))."Yrs" ?> <td>
				
			</tr>
			
		</table>
		<br>
		<img src="<?php echo base_url()."/assets/"?>ico/presicon.png" />
	</div>
	<hr>
	
	<div id="pres"  style="margin-top:-10px;margin-left: 30px;">
	  <table class="table table-hover" cellspacing="30" style="line-height:5px">
            
            <tr>
              
				<td> <strong>Drug</td>
				<td> <strong>Dosage</td>
				<td> <strong>Frequancy</td>
				<td> <strong>Period</td>
				 
            </tr>
            
			<?php foreach($presitems as $item){ ?>
			
            <tr>
                 
				<td><?php echo $item->drugName?></td>
				<td><?php echo $item->dosage ?></td>
				<td><?php echo $item->frequency ?></td>
				<td><?php echo $item->period ?></td>
			 
            </tr>
			
			<?php } ?>
        </table>
		</div>
	
	<div id="footer" style="margin-top:20%;margin-left: 30px;" >
	
	<p style="float:left"> <?php echo date('Y-m-d'); ?><br> .......................... <br><strong> Date</strong>  </p>
	<br>
	<p style="float:right;margin-right:10px">.......................... <br> <strong> Signature & Designation </strong> <br> <?php echo $username; ?></p>
	 
	</div>
	
</div>

</div>