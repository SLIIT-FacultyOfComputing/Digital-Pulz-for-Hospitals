<script>
    function showDiv() {
        document.getElementById('welcomeDiv').style.display = "block";
    }
    $('html').click(function() {
    $('welcomeDiv').style.display="none";
 })
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


<?php
foreach ($wardadmission as $value) {
    $patientitle = $value->patientID->patientTitle;
    $patientName = $value->patientID->patientFullName;
    $wardNo = $value->wardNo;
    $bedNo = $value->bedNo;
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
<div class="modal-example">
    <div class="container">

        <div class="panel panel-primary" style="width:90%">
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
        <!--load beds-->

        <!--        <div class="form-group">
        
                    <label style="color: #797979;"  for="wardNo" class="col-sm-2 control-label">Ward No</label>
                    <div class="col-xs-4">
                        <input  id="wardNo" name="wardNo" type="text" class="form-control" value="" required="required" />
                        <select  id="wardNo" name="wardNo" class="form-control" required="required" onchange="loadBeds(this.value)">
        
                            <option>---Select Ward---</option>
                       
        <?php
        foreach ($Wards as $value) {
            ?>
                    
                                            <option id="wardNo" name="wardNo" value="<?php echo $value->wardNo; ?>"> <?php echo $value->wardNo; ?></option>
             
            <?php
        }
        ?>
                        </select>
                    </div>
                </div>-->



        <!--load -->

        <div class="panel panel-primary" style="width:90%">
            <div class="panel-heading" style="background-color:whitesmoke">
                <h4 class="panel-title" style="color:#428BCA">Patient Discharge</h4>
            </div>
            <div class="panel-body">
                <!-- the method which is going to redirect to the bht-->
                <?php echo form_open('inward/patientBHTC/DischargePatientView'); ?>

                <fieldset style=" width: 742px; border-style: solid">

                    <input  id="bhtNo" name="bhtNo" type="hidden" value="<?php echo $bhtNo; ?>" />
                    <input  id="patientID" name="patientID" type="hidden" value="<?php echo $patientID; ?>" />
                    <input  id="wardNo" name="wardNo" type="hidden" value="<?php echo $wardNo; ?>" />
                    <input  id="bedNo" name="bedNo" type="hidden" value="<?php echo $bedNo; ?>" />
                    <div class="form-group">
                        <br/>
                        <label style="color: #797979;"   class="col-sm-3 control-label" >Discharge Type</label>
                        <div class="col-xs-4">
                            <select   id="dischargeType" name="dischargeType" class="form-control" required="required">
                                <option id="dischargeType" name="dischargeType"  value="ND">Normal Discharge</option>
                                <option id="dischargeType" name="dischargeType"  value="L">LAMA(Leaving Against Medical Advice)</option>
                                <option id="dischargeType" name="dischargeType"  value="M">Missing Patient</option>
                                <option id="dischargeType" name="dischargeType"  value="D">Death Patient</option>
                            </select>
                        </div>
                    </div> 

                    <div class="form-group">
                        <br/>
                        <label style="color: #797979;" class="col-sm-3 control-label" >Discharge Date & Time</label>
                        <div class="col-xs-4">
                            <input id="DischargedCreatedDate" name="DischargedCreatedDate" class="form-control" type="datetime-local" value="" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <br/>
                        <label style="color: #797979;" class="col-sm-3 control-label">Remark</label>
                        <div class="col-xs-4">
                            <input id="remark" name="remark" class="form-control" type="text" value="Direct damage to the kidneys themselves" />
                        </div>
                    </div>

                    <div class="form-group">
                        <br/>
                        <label style="color: #797979;" class="col-sm-3 control-label" >Out Comes</label>
                        <div class="col-xs-4">
                            <input id="outcomes" name="outcomes" class="form-control" type="text" value="successful kidney operation" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <br/>
                        <label style="color: #797979;" class="col-sm-3 control-label" >Refered To</label>
                        <div class="col-xs-4">
                            <input id="referredto" name="referredto" class="form-control" type="text" value="clinic" required="required"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <br/>
                        <label style="color: #797979;" class="col-sm-3 control-label" >Discharge Diagnosis</label>
                        <div class="col-xs-4">
                            <input id="dischargediagnosis" name="dischargediagnosis" class="form-control" type="text" value="Injury to the kidney" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <br/>
                        <label style="color: #797979;" class="col-sm-3 control-label" >Discharge eImmr</label>
                        <div class="col-xs-4">
                            <input id="dischargeImmr" name="dischargeImmr" class="form-control" type="text" value="J45" required="required" />
                        </div>   
                    </div>
                    <div class="form-group">
                        <br/>
                        <label style="color: #797979;" class="col-sm-3 control-label" >ICD Code</label>
                        <div class="col-xs-4">
                            <input id="icdCode" name="icdCode" class="form-control" type="text" value="015- Asthma" required="required" />
                        </div>
                        <div class="form-group">        
                            <input type="button" name="answer" value="CDI codes" onclick="showDiv()" />
                        </div>
                    </div>

                    <br/> 
                    <div class="form-group">
                        &nbsp;&nbsp;&nbsp;
                        <input type="submit" class="btn btn-large btn-info" value="Discharge Patient" name="btnSubmit" >
                    </div>  
                </fieldset>
                <?php echo form_close(); ?> 

                <div style="font-weight: bold;color:gray; margin-left: 15px;"> Store the Patient Details as a Archived Document In here</div>

                <!------------------------------------------------------------------------------------------------>
                <?php echo form_open('History/PatientArchiveC/SearchPatientDownload/' . $bhtNo . '/' . $patientID); ?>
                <div class="form-group">
                    &nbsp;&nbsp;&nbsp;
                    <input type="submit" class="btn btn-large btn-info" value="Save Patient Archived Detatis" name="btnSubmit" >
                </div> 
                <?php echo form_close(); ?> 

            </div> 
            <div id="welcomeDiv" style="position: relative; left: 553px; bottom: 394px; border-style: groove; border-color: buttonface;width: 462px;height: 319px; display: none">
                <ul>
                    <li> 001–139: infectious and parasitic diseases</li>
                    <li>140–239: neoplasms</li>
                    <li>240–279: endocrine, nutritional and metabolic diseases, and immunity disorders</li>
                    <li>280–289: diseases of the blood and blood-forming organs</li>
                    <li>290–319: mental disorders</li>
                    <li>320–359: diseases of the nervous system</li>
                    <li>360–389: diseases of the sense organs</li>
                    <li>390–459: diseases of the circulatory system</li>
                    <li>460–519: diseases of the respiratory system</li>
                    <li>520–579: diseases of the digestive system</li>
                    <li>580–629: diseases of the genitourinary system</li>
                </ul>
            </div>
            <!--------------------------------------------------------------------------------- /-->

        </div>
    </div>
</div>











