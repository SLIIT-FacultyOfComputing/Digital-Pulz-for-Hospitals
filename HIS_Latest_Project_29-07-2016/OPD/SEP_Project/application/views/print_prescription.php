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
.sansserif {
    font-family: Arial, sans-serif;
    font-size: 75%;
}
</style>
<script>
function printCard() {

    document.getElementById("btnPrint").style.display="none";
    window.print();
    window.close();
}
</script>
<div style="width:500px; height:auto; margin:0px 0px 25px 100px; border-style: solid; border-width: 1.5px; padding: 25px">
			<!-- <IMG STYLE="position:absolute; TOP:20px; right:210px; WIDTH:100px; HEIGHT:120px" SRC="<?php  echo base_url('/application/images/Emblem_of_Sri_Lanka.svg.png'); ?>"> -->

            <div class="container">
                <div class="row" >
                    <div class="col" align="right">
                        <img align="left" src="<?php echo base_url () . '/assets/ico/presicon.png'; ?>" height="24" width="24">
                        <b class="sansserif">Homagama Base Hospital</b><br/>
        			    <b style="font-size: 75%; font-style: italic; font-family: Arial;">OPD Prescription - <?php date_default_timezone_set('Asia/Colombo'); echo date("Y-m-d h:i:s A")?></b><br/>
                    </div>
    			</div>
            </div>
            <div>
                <span class="sansserif"><?php echo "$pdetails->patientTitle $pdetails->patientFullName" ?> (<?php echo "$pdetails->patientGender" ?>)</span>
                <br/>
                <span class="sansserif"><b>HIN: </b><?php echo $pdetails->patientHIN;  ?></span>
                <span class="sansserif"><b>Age: </b><?php 
                                    date_default_timezone_set('Asia/Colombo');
                                    echo (date("Y") - date("Y",$pdetails->patientDateOfBirth/1000));  ?>Y <?php 
                                     date_default_timezone_set('Asia/Colombo');
                                    echo (date("m") - date("m",$pdetails->patientDateOfBirth/1000));  ?>M <?php 
                                    date_default_timezone_set('Asia/Colombo');
                                    echo (date("d") - date("d",$pdetails->patientDateOfBirth/1000));  ?>D</span>

                
	        </div>
            <hr/>
            <table class="table table-hover sansserif" style="width:500px; margin:0px 0px 0px 0px;">
            <tr>
                <td></td>
                <td style="color: #888888"><strong>Drug Name</strong> </td>
				<td style="color: #888888"><strong>Dosage</strong> </td>			
                <td style="color: #888888"><strong>Frequency</strong> </td>
				<td style="color: #888888"><strong>Period</strong></td>
                <td></td>
               
            </tr>
            

           
            <?php foreach($drug as $row) { ?>
            <tr style="border:1px solid;">
                <td style="padding-left: 5px"></td>
		<td style="padding-left: 5px"><?php echo  $row->drugname;?></td>
		<td style="padding-left: 5px"><?php echo  $row->dosage;?></td>
                <td style="padding-left: 5px"><?php echo  $row->freq;?></td>
		<td style="padding-left: 5px"><?php echo $row->period;?></td>
                
                
				 <td></td>
            </tr>
           <?php }?> 
            
        </table>
        <div class="sansserif" align="right" style='margin-left: 210px'>
        <br/><br/>
            ....................................................................<br/>
            Prescribed by: Dr. <?php echo $this->session->userdata('username') ?>

            
        </div>
        <input type="button" class="btn btn-primary" value="Print" name="btnPrint" id="btnPrint" onclick="printCard()" >
        <script src="<?= base_url('/Bootstrap/js/jquery-1.11.1.min.js'); ?>"></script>
        <script type="text/javascript">
            function printCard() {
                $('#btnPrint').hide();
                window.print();
            }
        </script>
        
        