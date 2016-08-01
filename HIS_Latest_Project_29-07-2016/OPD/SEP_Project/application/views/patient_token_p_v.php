<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/bootstrap.css'); ?>" media="all"/>
  <link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/bootstrap.min.css'); ?>" media="all"/>
<script>
function printCard() {
window.print();
}
</script>
  <title> Token </title>
<div id="slip">
	<center>
	<div id="top_text">
		Patient Name &nbsp; : <?php echo $queue->patient->patientTitle."".$queue->patient->patientFullName;?>  
		<br>Patient Number : <?php echo $pprofile->patientHIN;?>  
	</div>
	<br>
 
	<div id="bar_code_img">
	
		<!--<img src="http://localhost/barcodes/barcode_libs/get_barcode.php?TEXT=<?echo $pprofile->patientHIN;?>" />-->
		 <img alt="12345" src="<?php echo base_url('/Barcode/barcode.php'); ?>?codetype=Code39&size=40&text=<?php echo $pprofile->patientHIN;?>" />
	 </div>

	
	<div id="middle_text">
			Token  <br> <h1> <?php echo $queue->queueTokenNo; ?> </h1>  
	</div>
	
	<br>
	 
	<div id="middle_text">
		
			Dr. <?php echo  $queue->queueAssignedTo->hrEmployee->firstName." ".$queue->queueAssignedTo->hrEmployee->lastName;?>
			<br>
			Date & Time  <?php 
			date_default_timezone_set('Asia/Colombo');
                                           $date = date('Y-m-d H:i:s ');
                                           echo date ( $date);

			?>  
	</div>
	<div style=" float:right; margin-top:-40px; margin-right:40px">
            <input type="button" class="btn btn-primary"value="Print" name="btnPrint" id="btnPrint" onclick="printCard()" >
                </div>
</div>

 