<?php

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

foreach ($Ward as $value) {
    $wardNo = $value->wardNo;
    $bhtNo = $value->bhtNo;
    $patientID = $value->patientID->patientID;
    $patienttitle = $value->patientID->patientTitle;
    $patientname = $value->patientID->patientFullName;
    $patientGender = $value->patientID->patientGender;
    $patientCivilStatus = $value->patientID->patientCivilStatus;
    $dob = $value->patientID->patientDateOfBirth;
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
}
?>
<?php date_default_timezone_set("Asia/Colombo"); ?>
<div>
       <a href="#" class="close" data-dismiss="alert">
        &times;
    </a>
    
    <div class="panel panel-primary" >
        <div class="panel-heading" style="height: 50px">
            <h4>
                <b>
                    <?php
                    $oridate = date("d-m-Y ", $dob / 1000);
                    echo "$patienttitle $patientname / $patientGender / $patientCivilStatus /";
                    findage(date("d-m-Y", strtotime($oridate)));
                    ?><span style="padding:0 80px; " ></span>
                    <?php echo "Patient ID : $patientID "; ?><span style="padding:0 20px; " ></span>
                    <?php echo "DOB : $oridate "; ?>
                </b>
            </h4>
    </div>
    <div class="panel-body">
    

    <!--    <h5><u>Initial Admission Details</u></h5>-->
    <div class="row">    


        <div class="col-xs-2">
            <label for="bhtNo" > BHT No : </label><?php echo $bhtNo; ?>

        </div>
        <div class="col-xs-2">
            <label for="bhtNo" >Ward No : </label><?php echo $wardNo; ?>
        </div>


        <div class="col-xs-2">
            <label for="bedno" > Bed No : </label>
             <?php if($bedNo==-99){
                                        echo "None";
                                }else{
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
      <?php if ($discharjType == "none") { ?>
    <div class="row">
        <div class="col-md-10">
            
        </div>
        <div class="col-md-2">
            <span style=" padding: 0 36px;" ></span>
            <button class="btn btn-success btn-xs "  type="button" onclick="loadBHT(<?php echo $bhtNo; ?>,<?php echo $patientID; ?>);" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Open Patient BHT">
            <span class="glyphicon glyphicon-new-window">Open BHT</span>
        </button>
        </div>
        
        
    </div>
    <?php } ?>
    <?php if ($discharjType != "none") {
        ?>
        <div class="row"><br/>
            <div class="col-md-1">

                <IMG STYLE=" WIDTH:101px; HEIGHT:89px" SRC="../../../bootstrap/dischrge.jpg">
            </div>

            <div class="col-md-9">
                <div class="row">
                    <?php
                    if ($discharjType == "IT") {
                        ?>

                        <label for="bhtNo" > <span style=" padding: 0 13px;" ></span> Discharge Type : Internal Transfer</label> 
                        <?php
                    }
                    ?> 

                    <?php
                    if ($discharjType == "ET") {
                        ?>

                        <label for="bhtNo" ><span style=" padding: 0 13px;" ></span> Discharge Type : External Transfer</label> 
                        <?php
                    }
                    ?> 


                    <?php
                    if ($discharjType == "L") {
                        ?>

                        <label for="bhtNo" > <span style=" padding: 0 13px;" ></span> Discharge Type : LAMA(Leaving Against Medical Advice)</label> 
                        <?php
                    }
                    ?> 


                    <?php
                    if ($discharjType == "M") {
                        ?>

                        <label for="bhtNo" ><span style=" padding: 0 13px;" ></span>  Discharge Type : Missing Patient</label> 
                        <?php
                    }
                    ?> 


                    <?php
                    if ($discharjType == "ND") {
                        ?>

                        <label for="bhtNo" ><span style=" padding: 0 13px;" ></span>  Discharge Type : Normal Discharge</label> 
                        <?php
                    }
                    ?> 

                    <?php
                    if ($discharjType == "D") {
                        ?>

                        <label for="bhtNo" > <span style=" padding: 0 13px;" ></span> Discharge Type : Death Patient</label> 
                        <?php
                    }
                    ?>
                </div>
                <div class="row">
                    <label for="bhtNo" ><span style=" padding: 0 13px;" ></span>   Discharge Date & Time : </label>    <?php echo $lastUpdatedDate; ?><?php echo $lastUpdatedTime; ?>
                </div>
                <div class="row">
                    <label for="bhtNo" ><span style=" padding: 0 13px;" ></span>   Remark : </label>   <?php echo $remark; ?>
                </div>
            </div>
            <div class="col-md-2">
                <br/><br/><br/><span style=" padding: 0 36px;" ></span>
                <button class="btn btn-success btn-xs "  type="button" onclick="loadBHT(<?php echo $bhtNo; ?>,<?php echo $patientID; ?>);" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Open Patient BHT">
                    <span class="glyphicon glyphicon-new-window">Open BHT</span>
                </button>

            </div>

        </div>
        <?php
    }
    ?> 
</div>
    </div>

<script>
    function loadBHT(bhtNo,patient)
    {
        window.open("<?php echo base_url(); ?>index.php/inward/patientBHTC/BHT/"+bhtNo+"/"+patient);
    }
</script>
</div>