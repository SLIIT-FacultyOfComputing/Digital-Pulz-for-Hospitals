<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
body
{
 
}
</style>

<!--Bootstrap file link-->
 <link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/bootstrap.css'); ?>" media="all"/>
 
 <!--function to print the patient card-->
<script>
function printCard() {
window.print();
}
</script>

<!--***********************************************************************-->
<title> Patient Card </title>
<div id="slip">

	<div id="header" style="background-color: #0088cc;width: 100%;height: 20px;color:white;">  </div>
	<center>
	<div id="top_text">
            Patient Name &nbsp; : <?php echo $pprofile->patientTitle.$pprofile->patientFullName;?>  
		<br>Patient Hin : <?php echo $pprofile->patientHIN;?>  
	</div>
	<br>
        
	<div id="bar_code_img">
	
		<!--<img src="http://localhost/barcodes/barcode_libs/get_barcode.php?TEXT=<?echo $pprofile->patientHIN;?>" />-->
		 <img alt="12345" src="<?php echo base_url('/Barcode/barcode.php'); ?>?codetype=Code39&size=40&text=<?php echo $pprofile->patientHIN;?>" />
	 </div>
	
        <div  style="margin-left: -305px;margin-top: -75px" >
                <img style="width: 135px; height: 120px; padding-left: 2px;" src="<?php
                if ((strpos($pprofile->patientPhoto, 'null') !== FALSE) | $pprofile->patientPhoto == "" | $pprofile->patientPhoto == null) {
                    //echo base_url() . '/assets/ico/proimage.jpg';
                    {
                        if ($pprofile->patientGender == 'Male')
                            echo base_url() . "/assets/ico/proimage.jpg";
                        else if($pprofile->patientGender == 'Female')
                            echo base_url() . "/assets/ico/proimagefemale.png";
                        else {
                            echo base_url() . "/assets/ico/proimage.jpg";
                        }
                    }
                } else
                    echo base_url() . '/uploads/patient_photos/'.$pprofile->patientPhoto;
                ?>" />
            </div>
        
        <div src="<?php
                if ((strpos($pprofile->patientPhoto, 'null') !== FALSE) | $pprofile->patientPhoto == "" | $pprofile->patientPhoto == null) {
                    //echo base_url() . '/assets/ico/proimage.jpg';
                    {
                        if ($pprofile->patientGender == 'Male')
                            echo base_url() . "/assets/ico/proimage.jpg";
                        else if($pprofile->patientGender == 'Female')
                            echo base_url() . "/assets/ico/proimagefemale.png";
                        else {
                            echo base_url() . "/assets/ico/proimage.jpg";
                        }
                    }
                } else
                    echo base_url() . '/uploads/patient_photos/'.$pprofile->patientPhoto;
                ?>" 
            </div>
        
	<div id="bottom_text">
		<p>Bring this card with you on every visit to the hospital.
		<br>රෝහලට පැමිණෙන සැම විටම මෙම කාඩ්පත රැගෙන එන්න.</p>
                </div>
      
		<div id="footer" style="background-color: #0088cc;width: 100%;height: 20px;color:white;position:relative;top:-4px"> </div>
        </center>
                <br><br><br>
                <div style="position:relative; float:right; margin-top:-40px;">
                    <input type="button" class="btn  btn-primary"value="Print" name="btnPrint" id="btnPrint" onclick="printCard()">
                </div>
</div>

 
