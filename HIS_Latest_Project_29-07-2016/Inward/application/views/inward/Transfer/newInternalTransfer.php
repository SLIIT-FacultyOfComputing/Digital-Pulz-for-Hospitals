<?php
foreach ($wardadmission as $value) {
    $patientitle = $value->patientID->patientTitle;
    $patientName = $value->patientID->patientFullName;
    $wardNo = $value->wardNo;
    $bedNo =  $value->bedNo;
    $bhtNo = $value->bhtNo;
    $patientGender = $value->patientID->patientGender;
    $patientDateOfBirth = $value->patientID->patientDateOfBirth;
    $patientCivilStatus = $value->patientID->patientCivilStatus;
    $patientID = $value->patientID->patientID;
}

function findage($dob) {
    $localtime = getdate();
    $today = $localtime['mday'] . "-" . $localtime['mon'] . "-" . $localtime['year'];
    $dob_a = explode("-", $dob);
    $today_a = explode("-", $today);
    $dob_d = $dob_a[0];
    $dob_m = $dob_a[1];
    $dob_y = $dob_a[2];
    $today_d = $today_a[0];
    $today_m = $today_a[1];
    $today_y = $today_a[2];
    $years = $today_y - $dob_y;
    $months = $today_m - $dob_m;
    if ($today_m . $today_d < $dob_m . $dob_d) {
        $years--;
        $months = 12 + $today_m - $dob_m;
    }

    if ($today_d < $dob_d) {
        $months--;
    }

    $firstMonths = array(1, 3, 5, 7, 8, 10, 12);
    $secondMonths = array(4, 6, 9, 11);
    $thirdMonths = array(2);

    if ($today_m - $dob_m == 1) {
        if (in_array($dob_m, $firstMonths)) {
            array_push($firstMonths, 0);
        } elseif (in_array($dob_m, $secondMonths)) {
            array_push($secondMonths, 0);
        } elseif (in_array($dob_m, $thirdMonths)) {
            array_push($thirdMonths, 0);
        }
    }
    echo "~$years years $months months";
}
?>

    <div class="panel panel-primary">
        <div class="panel-heading" style="height: 50px;">
            <h4>
                <b>
                    <?php
                    $oridate = date("d-m-Y ", $patientDateOfBirth / 1000);
                    echo "$patientitle $patientName / $patientGender / $patientCivilStatus /";
                    findage(date("d-m-Y", strtotime($oridate)));
                    ?><span style="padding:0 80px; " ></span>
                    <?php echo "Patient ID : $patientID "; ?><span style="padding:0 20px; " ></span>
                    <?php echo "DOB : $oridate "; ?>
                </b>
            </h4>
        </div>
    </div>

        
        
        <div class="panel panel-primary" >
    <div class="panel-heading" style="background-color:whitesmoke">
        <h4 class="panel-title" style="color:#428BCA">Internal Transfer</h4>
    </div>
    <div class="panel-body">
        
        
        <?php echo form_open('inward/patientBHTC/NewTransfer'); ?>
        <fieldset>
            <input  id="bhtNo" name="bhtNo" type="hidden" value="<?php echo $bhtNo; ?>" />
            <input  id="TransferFromWard" name="TransferFromWard" type="hidden" value="<?php echo $wardNo; ?>" />
            <input  id="bedNo" name="bedNo" type="hidden" value="<?php echo $bedNo; ?>" />
            <div class="form-group">

                <label style="color: #797979;" class="col-sm-3 control-label" for="transferWard">Transfer Ward</label>
                <div class="col-xs-4">
 <!--                <input  id="wardNo" name="wardNo" type="text" class="form-control" value="" required="required" />-->
                    <input list="Ward" id="transferWard" name="transferWard" class="form-control" required="required">


                    <datalist id="Ward">

                        <?php
                        foreach ($Wards as $value) {

                            if ($wardNo != $value->wardNo) {
                                ?>
                                <option value="<?php echo $value->wardNo; ?>">

                                    <?php
                                }
                            }
                            ?>
                    </datalist>


                </div>
            </div> 

            <div class="form-group">
                <br/>
                <label style="color: #797979;"   class="col-sm-3 control-label" for="reportOfSpacialExamination">Report Of Spacial Examination</label>
                <div class="col-xs-4">
                    <input id="reportOfSpacialExamination" name="reportOfSpacialExamination" type="text" class="form-control"  />

                </div>
            </div> 


            <div class="form-group">
                <br/>
                <label style="color: #797979;" class="col-sm-3 control-label" for="resonForTrasnsfer">Reason For Transfer</label>
                <div class="col-xs-4">
                    <input id="resonForTrasnsfer" name="resonForTrasnsfer" type="text" class="form-control" />
                </div>
            </div> 





            <div class="form-group">
                <br/>
                <label style="color: #797979;" class="col-sm-3 control-label" for="TreatmentSuggested">Treatment Suggested</label>
                <div class="col-xs-4">
                    <input id="TreatmentSuggested" name="TreatmentSuggested" type="text" class="form-control" value=""  />
                </div>
            </div> 

            <div class="form-group">
                <br/>
                <label style="color: #797979;" class="col-sm-3 control-label" for="TransferCreatedDate">Transfer Date & Time</label>
                <div class="col-xs-4">
                    <input id="TransferCreatedDate" name="TransferCreatedDate" class="form-control" type="datetime-local" value="" required="required" />
                </div>
            </div>
            <div class="form-group">
                <br/>
                <label style="color: #797979;" class="col-sm-3 control-label" for="TransferCreatedDate">Remark</label>
                <div class="col-xs-4">
                    <input id="remark" name="remark" class="form-control" type="text" />
                </div>
            </div>

            
            
            <br/> 
<input id="patientID" name="patientID"  type="hidden" value="<?php echo $patientID; ?>"  />
              
            <div class="form-group">
                &nbsp;&nbsp;&nbsp;
                <input type="submit" class="btn btn-large btn-info" value="Transfer Patient" name="btnSubmit" >
            </div>  
        </fieldset>


        <?php echo form_close(); ?>  


    </div>


</div>





