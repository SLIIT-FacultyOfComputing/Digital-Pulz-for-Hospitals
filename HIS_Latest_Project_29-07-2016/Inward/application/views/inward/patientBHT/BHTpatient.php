<!-- jQuery -->
    <script src="<?php echo base_url(); ?>css/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="<?php echo base_url(); ?>css/plugins/jQueryUI/jquery-ui-1.10.3.js"></script>
<?php
foreach ($wardadmission as $value) {
    $patientitle = $value->patientID->patientTitle;
    $patientName = $value->patientID->patientFullName;
    $wardNo = $value->wardNo;
    $bhtNo = $value->bhtNo;
    $patientID = $value->patientID->patientID;
    $bedNo = $value->bedNo;
    $dailyNo = $value->dailyNo;
    $monthlyNo = $value->monthlyNo;
    $yearlyNo = $value->yearlyNo;
    $Doctnametitle = $value->doctorID->title;
    $Doctfname = $value->doctorID->firstName;
    $Doctlname = $value->doctorID->lastName;
    $admitDate = date("Y-m-d ", $value->admitDateTime / 1000);
    $admitTime = date(" h:ia", $value->admitDateTime / 1000);
    $patientComplain = $value->patientComplain;
    $previousHistory = $value->previousHistory;
    $discharjType = $value->dischargeType;
    $remark = $value->remark;
    $lastUpdatedDate = date("Y-m-d ", $value->lastUpdatedDateTime / 1000);
    $lastUpdatedTime = date(" h:ia", $value->lastUpdatedDateTime / 1000);


    $patientPersonalUsedName = $value->patientID->patientPersonalUsedName;
    $patientNIC = $value->patientID->patientNIC;
    $patientGender = $value->patientID->patientGender;
    $patientDateOfBirth = $value->patientID->patientDateOfBirth;
    $patientTelephone = $value->patientID->patientTelephone;
    $patientCivilStatus = $value->patientID->patientCivilStatus;
    $patientPreferredLanguage = $value->patientID->patientPreferredLanguage;
    $patientCitizenship = $value->patientID->patientCitizenship;
    $patientAddress = $value->patientID->patientAddress;
    $patientContactPName = $value->patientID->patientContactPName;
    $patientContactPNo = $value->patientID->patientContactPNo;
}

if ($dischjType == "IT") {
    foreach ($transviewData as $v) {
        $transferFromWard = $v->transferFromWard->wardNo;
        $transferWard = $v->transferWard->wardNo;
        $resonForTrasnsfer = $v->resonForTrasnsfer;
        $reportOfSpacialExamination = $v->reportOfSpacialExamination;
        $treatmentSuggested = $v->treatmentSuggested;
        $transferCreatedDate = date("Y-m-d ", $v->transferCreatedDate / 1000);
        $transferCreatedTime = date("h:ia", $v->transferCreatedDate / 1000);
    }
} elseif ($dischjType == "ET") {
    foreach ($transviewData as $vs) {
        $transferFrom = $vs->transferFrom;
        $transferTo = $vs->transferTo;
        $resonForTrasnsfer = $vs->resonForTrasnsfer;
        $reportOfSpacialExamination = $vs->reportOfSpacialExamination;
        $treatmentSuggested = $vs->treatmentSuggested;
        $transferCreatedDate = date("Y-m-d ", $vs->transferCreatedDate / 1000);
        $transferCreatedTime = date("h:ia", $vs->transferCreatedDate / 1000);
        $nameOfGuardian = $vs->nameOfGuardian;
        $addressOfGuardian = $vs->addressOfGuardian;
    }
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
<script> 
    $(document).ready(function(){
        $("#flip").click(function(){
            $("#panel").slideToggle("slow");
        });
    });
    
    
    $(document).ready(function(){
        $("#flip2").click(function(){
            $("#panel2").slideToggle("slow");
        });
    });
    
    $(document).ready(function(){
        $("#flip3").click(function(){
            $("#panel3").slideToggle("slow");
        });
    });
    
    $(document).ready(function(){
        $("#flip4").click(function(){
            $("#panel4").slideToggle("slow");
        });
    });
    
    $(document).ready(function(){
        $("#flip5").click(function(){
            $("#panel5").slideToggle("slow");
        });
    });
</script>
<style>
    span.tab{
        padding: 0 425px; /* Or desired space*/

    </style>
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
                <h4 class="panel-title" style="color:#428BCA">Patient Details</h4>
            </div>
            <div class="panel-body">
                <div class="panel-body" id="panel2">


                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Patient ID : </label> <?php echo "$patientID"; ?>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Full Name : </label> <?php echo "$patientitle $patientName"; ?>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > NIC No: </label> <?php echo "$patientNIC"; ?>
                        </div>                                
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Gender : </label> <?php echo "$patientGender"; ?>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Date of Birth : </label>   <?php echo date("Y-m-d", $patientDateOfBirth / 1000); ?>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Civil Status : </label> <?php echo "$patientCivilStatus"; ?>
                        </div>                                
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Preferred Language : </label> <?php echo "$patientPreferredLanguage"; ?>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Full Name : </label> <?php echo "$patientCitizenship"; ?>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Address: </label> <?php echo "$patientAddress"; ?>
                        </div>                                
                    </div>


                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Telephone : </label> <?php echo "$patientTelephone"; ?>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Contact Person Name : </label> <?php echo "$patientContactPName"; ?>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Contact Person No : </label> <?php echo "$patientContactPNo"; ?>
                        </div>                                
                    </div>


                </div>
            </div>
        </div>




        <div class="panel panel-primary" >
            <div class="panel-heading" style="background-color:whitesmoke">
                <h4 class="panel-title" style="color:#428BCA">Initial Admission Details</h4>
            </div>
            <div class="panel-body">


                <div class="panel-body" id="panel">


                    <div class="row">    


                        <div class="col-xs-2">
                            <label for="bhtNo" > BHT No : </label><?php echo $bhtNo; ?>

                        </div>
                        <div class="col-xs-2">
                            <label for="bhtNo" >Ward No : </label><?php echo $wardNo; ?>
                        </div>


                        <div class="col-xs-2">
                            <label for="bedno" > Bed No : </label> <?php
                    if ($bedNo == -99) {
                        echo "None";
                    } else {
                        echo $bedNo;
                    }
                    ?>

                        </div>

                        <div class="col-xs-2">
                            <label for="dailyNo" > Daily No : </label><?php echo $dailyNo; ?>

                        </div> 

                        <div class="col-xs-2">
                            <label for="monthlyNo" >Monthly No : </label><?php echo $monthlyNo; ?>

                        </div> 

                        <div class="col-xs-2">
                            <label for="yearlyNo" >Yearly No : </label><?php echo $yearlyNo; ?>

                        </div>
                    </div>
                    <legend></legend>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="bhtNo" > Doctor : </label> <?php echo "$Doctnametitle $Doctfname $Doctlname"; ?>
                        </div>

                        <div class="col-md-6">
                            <label for="bhtNo" >  Admitted Date & Time : </label>   <?php echo $admitDate; ?><?php echo $admitTime; ?>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="bhtNo" > Patient Complains : </label> <?php echo "$patientComplain"; ?>
                        </div>

                        <div class="col-md-6">
                            <label for="bhtNo" >  Patient Previous History : </label>   <?php echo $previousHistory; ?>
                        </div>

                    </div>


                </div>
            </div>
        </div>

<!--    Patient Archived Infomation div starts from here-->
 <div class="panel panel-primary" >
            <div class="panel-heading" style="background-color:whitesmoke">
                <h4 class="panel-title" style="color:#428BCA">Patient Details Archiving for Patient History</h4>
            </div>
            <div class="panel-body">


                <div class="panel-body" id="panel">


                    <div class="row">    


                        <div class="col-xs-2">
                            <label for="Name" > Name : </label>

                        </div>
                        <div class="col-xs-2">
                            <label for="bhtNo" >Ward No : </label><?php echo $wardNo; ?>
                        </div>


                        <div class="col-xs-2">
                            <label for="bedno" > Bed No : </label>

                        </div>

                        <div class="col-xs-2">
                            <label for="dailyNo" > Daily No : </label><?php echo $dailyNo; ?>

                        </div> 

                        <div class="col-xs-2">
                            <label for="monthlyNo" >Monthly No : </label><?php echo $monthlyNo; ?>

                        </div> 

                        <div class="col-xs-2">
                            <label for="yearlyNo" >Yearly No : </label><?php echo $yearlyNo; ?>

                        </div>
                    </div>
                    <legend></legend>
                    <div class="row">
                        <input id="patientID" name="patientID" type="text"  value="" required="required"   />
                        <input type="Submit" value="Download">
                    </div>
                    <div class="row">
                        

                    </div>


                </div>
            </div>
        </div>


        <!--The rest of the part starts here-->
        <?php if ($discharjType != "none") {
            ?>


            <div class="panel panel-primary" >
                <div class="panel-heading" style="background-color:whitesmoke">
                    <h4 class="panel-title" style="color:#428BCA">Patient Discharge Details</h4>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <?php
                            if ($discharjType == "IT") {
                                ?>

                                <label for="bhtNo" > Discharge Type : Internal Transfer</label> 
                                <?php
                            }
                            ?> 

                            <?php
                            if ($discharjType == "ET") {
                                ?>

                                <label for="bhtNo" > Discharge Type : External Transfer</label> 
                                <?php
                            }
                            ?> 


                            <?php
                            if ($discharjType == "L") {
                                ?>

                                <label for="bhtNo" > Discharge Type : LAMA(Leaving Against Medical Advice)</label> 
                                <?php
                            }
                            ?> 


                            <?php
                            if ($discharjType == "M") {
                                ?>

                                <label for="bhtNo" > Discharge Type : Missing Patient</label> 
                                <?php
                            }
                            ?> 


                            <?php
                            if ($discharjType == "ND") {
                                ?>

                                <label for="bhtNo" > Discharge Type : Normal Discharge</label> 
                                <?php
                            }
                            ?> 
                            <?php
                            if ($discharjType == "D") {
                                ?>

                                <label for="bhtNo" > Discharge Type : Death Patient</label> 
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Discharged Date & Time: </label> <?php echo $lastUpdatedDate; ?><?php echo $lastUpdatedTime; ?>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Remark : </label> <?php echo "$remark"; ?>
                        </div>                                
                    </div>


                </div>
            </div>

    <?php if ($discharjType == "IT") { ?>



                <div class="panel panel-primary" >
                    <div class="panel-heading" style="background-color:whitesmoke">
                        <h4 class="panel-title" style="color:#428BCA">Internal Transfer Details</h4>
                    </div>
                    <div class="panel-body">


                        <div class="row">


                            <div class=" col-sm-6">
                                <label  >  Transfer : </label>   <?php echo "$transferFromWard to $transferWard"; ?>
                            </div>

                            <div class="col-sm-6">
                                <label  >  Transfer Date&Time : </label>   <?php echo $transferCreatedDate; ?><?php echo $transferCreatedTime; ?>
                            </div>

                        </div>    
                        <div class="row">
                            <div class=" col-sm-12">
                                <label >  Report Of Spacial Examination : </label>   <?php echo $reportOfSpacialExamination; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class=" col-sm-12">
                                <label  > Reason For Transfer : </label> <?php echo "$resonForTrasnsfer"; ?>
                            </div>
                        </div>


                        <div class="row">
                            <div class=" col-sm-12">
                                <label  > Treatment Suggested : </label> <?php echo "$treatmentSuggested"; ?>
                            </div>
                        </div>

                    </div>

                </div>

            <?php } ?>

    <?php if ($discharjType == "ET") { ?>



                <div class="panel panel-primary" >
                    <div class="panel-heading" style="background-color:whitesmoke">
                        <h4 class="panel-title" style="color:#428BCA">External Transfer Details</h4>
                    </div>
                    <div class="panel-body">



                        <div class="row">


                            <div class=" col-sm-6">
                                <label  >  Transfer : </label>   <?php echo "$transferFrom to $transferTo"; ?>
                            </div>

                            <div class="col-sm-6">
                                <label  >  Transfer Date&Time : </label>   <?php echo $transferCreatedDate; ?><?php echo $transferCreatedTime; ?>
                            </div>

                        </div>    
                        <div class="row">
                            <div class=" col-sm-12">
                                <label >  Report Of Spacial Examination : </label>   <?php echo $reportOfSpacialExamination; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class=" col-sm-12">
                                <label  > Reason For Transfer : </label> <?php echo "$resonForTrasnsfer"; ?>
                            </div>
                        </div>


                        <div class="row">
                            <div class=" col-sm-12">
                                <label  > Treatment Suggested : </label> <?php echo "$treatmentSuggested"; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class=" col-sm-12">
                                <label  > Name Of Guardian : </label> <?php echo "$nameOfGuardian"; ?>
                            </div>
                        </div>


                        <div class="row">
                            <div class=" col-sm-12">
                                <label  > Address Of Guardian: </label> <?php echo "$addressOfGuardian"; ?>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

    <?php } ?>



        <?php
    }
    ?>

