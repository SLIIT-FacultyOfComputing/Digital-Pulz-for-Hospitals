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
<div class="container">
 
	<div id="header" style="text-align: center;line-height: 10px;margin-top: 10px" >
	
		<h2>Hospital Name</h2>
		<h3>Visit Summary </h3>
	</div>
	
	<hr>
	
<div class="span10 gray-col">
   <table class="table table-hover ">   
            <tr>
                <td style="border-style:none;">
					<?php echo "<h4>$pprofile->patientTitle$pprofile->patientFullName / $pprofile->patientGender / ".(date("Y") - date("Y",$pprofile->patientDateOfBirth/1000))."Yrs  / $pprofile->patientCivilStatus     &nbsp;   &nbsp;  &nbsp; &nbsp; &nbsp;    &nbsp;    &nbsp;    </h4>  PatientID :  $pprofile->patientID &nbsp; &nbsp; &nbsp; &nbsp;    &nbsp;    &nbsp;    &nbsp;   DOB : " .date('Y-m-d',$pprofile->patientDateOfBirth/1000). " &nbsp;    ";?> 
				</td>
            </tr>
        </table>
</div>


<div class="span10 gray-col">
<h5 align="left">
  
</h5>	
 
        <table class="table table-hover ">
            
            <tr>
                <td style="margin:0px 10px 0px 0px;">Type : <?php echo $visit->visitType; ?></td>
				<td style="margin:0px 30px 0px 0px;">Visit No : <?php echo $visit->visitID; ?> </td>
                <td style="margin:0px 10px 0px 0px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
				<td style="margin:0px 10px 0px 0px;">Date and Time : <?php echo date("Y-m-d h:i:s A",$visit->visitDate/1000); ?> </td>
            </tr>
           
		    <tr>
                <td style="margin:0px 10px 0px 0px;">Complaint : <?php echo $visit->visitComplaint; ?> </td>
				<td style="margin:0px 10px 0px 0px;"> </td>
				<td style="margin:0px 10px 0px 0px;"> </td>
				<td style="margin:0px 10px 0px 0px;">Remarks : <?php echo $visit->visitRemarks; ?> </td>
					 
			</tr> 
        </table>
</div>
</div>
 
<br>

<div class="container">
<div class="span10 gray-col">
  <h4> Prescriptions </h4>
	     <?php if($presitems != NULL & sizeof($presitems) > 0){?>
        <table class="table table-hover ">
            
            <tr>
 
				<td>Drug</td>
				<td>Dosage</td>
				<td>Frequancy</td>
				<td>Period</td>
				<td>Quantity</td>
				
            </tr>
            
			<?php foreach($presitems as $item){ ?>
			
            <tr>
                <td><?php echo 'Methyldopa'; ?></td>
				<td><?php echo $item['prescribeItemsDosage'] ?></td>
				<td><?php echo $item['prescribeItemsFrequency']; ?></td>
				<td><?php echo $item['prescribeItemsPeriod']; ?></td>
				<td><?php echo $item['prescribeItemsQuantity']; ?></td>
            </tr>
			
			<?php } ?>
        </table>
		<?php } ?>
      
</div>
</div>


<br>
 
<br>
 
<div class="container">
<div class="span10 gray-col"> 
 <h4> Exams </h4>
<form class="form-horizontal"   >
          <?php if(sizeof($exams) > 0){?>
		<table class="table table-hover">
             
            <tr>
					<td>Weight</td>
					<td>Height</td>
					<td>SYS_BP</td>
					<td>Diast_BP</td>
					<td>Temp.</td>
            </tr>

            <?php foreach($exams as $row) {?>
            <tr>
                  <td><?php echo $row['examWeight'];?></td>
                <td><?php echo $row['examHeight'];?></td>
				 <td><?php echo $row['examSysBP'];?></td>
				 <td><?php echo $row['examDisatBP'];?></td>
				<td><?php echo $row['examTemp'];?></td>
                	
            </tr>
           <?php }?>
            
        </table>
		<?php } ?> 
     
</div>
</div>
 
 

<br>
  
</body>
</html>
