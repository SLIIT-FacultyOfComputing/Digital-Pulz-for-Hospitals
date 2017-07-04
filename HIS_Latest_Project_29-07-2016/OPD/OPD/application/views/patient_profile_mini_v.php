<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<script type="text/javascript" src="<?php echo base_url().'assets/js/divSwitch.js'?>"></script>

     

<!--Starting point of patient profile mini panel-->
<div class="panel panel-info" style="margin-top: 8px;">
            <div class="panel-heading">
              <h3 class="panel-title">Patient Information</h3>
            </div>
            <div class="panel-body"><!--Starting point of patient profile mini panel body-->
                  

        <table class="table table-hover ">
            
            <tr>
                 
                <td style="border-style:none;">

                    <?php 

                        date_default_timezone_set('Asia/Colombo');
                    
                    if ($pprofile->patientTitle == "Baby") echo "<h4>$pprofile->patientTitle $pprofile->patientFullName";
                    else echo "<h4>$pprofile->patientTitle$pprofile->patientFullName";
                    echo "/ $pprofile->patientGender / " . (date("Y") - date("Y", $pprofile->patientDateOfBirth / 1000)) . "Yrs  / $pprofile->patientCivilStatus     &nbsp;   &nbsp;  &nbsp; &nbsp; &nbsp;    &nbsp;    &nbsp;    </h4>  PatientID :  $pprofile->patientHIN &nbsp; &nbsp; &nbsp; &nbsp;    &nbsp;    &nbsp;    &nbsp;   DOB : " . date('Y-m-d', $pprofile->patientDateOfBirth / 1000) . " &nbsp;    "; ?> 

                    <a style="float:right;" href="<?php echo base_url() . 'index.php/patient_c/edit/' . $pprofile->patientID; ?>"><img src="<?php echo base_url() . "/assets/" ?>ico/edit.png" title="Edit Patient Profile"/></a> 

                </td>
            </tr>
        </table>
 
</div>
  </div><!--Ending point of patient profile mini panel body-->
          </div><!--Ending point of patient profile mini panel-->






