
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
    $status=$value->status;
    $sign=$value->sign;

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


    <div class="row">
<div class="container">
<div class="panel panel-default" style="width:90%">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> Patient's Discharged Details
        
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
       
    
        
         <?php echo form_open('inward/patientBHTC/DischargePDF/'.$bhtNo.'/'.$patientID); ?>
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
        <br>
        <br>
          <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Patient Discharged Type : </label> <?php echo "$discharjType "; ?>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Patient Discharged Date : </label> <?php echo "$lastUpdatedDate"; ?>
                        </div>
                                                       
                    </div>
        <!-- <input id="patientID" name="patientID" type="text" class="form-control" value="<?php echo "$patientID"; ?>" required="required" />-->
        
        <?php
           if ($value->status == "Confirmed") {
         ?>
        <br>
        
         <h4>Patient Discharged Confirmation: Confirmed</h4>
         <br>

        <input type="Submit" value="Discharged Receipt" >

<?php
    }
?>
        
       <?php echo form_close(); ?>   
        
    </div>
    <!-- /.panel-body -->
    

</div>
</div>
</div>

    
    
    
    
    
    
    
<!--<?php echo "$value->status"; ?>-->
<!--<?php echo "$value->sign"; ?>-->


<!--<?php print_r($wardadmission)?>-->

