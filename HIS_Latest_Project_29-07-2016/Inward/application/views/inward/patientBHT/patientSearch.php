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
?>
<br/>

<div class="panel panel-primary" >
    <div class="panel-heading" style="height: 50px;">

        <h4>
            <b>
                <?php
                $oridate = date("d-m-Y ", $patients->patientDateOfBirth / 1000);
                echo "$patients->patientTitle $patients->patientFullName / $patients->patientGender / $patients->patientCivilStatus /";
                findage(date("d-m-Y", strtotime($oridate)));
                ?><span style="padding:0 80px; " ></span>
                <?php echo "Patient ID : $patients->patientID "; ?><span style="padding:0 20px; " ></span>
                <?php echo "DOB : $oridate "; ?>
            </b>
        </h4>
    </div>
</div>

<div>
    <div id="accordion" class="panel panel-primary">
        <?php
        foreach ($WardAdmission as $value) {
            $discharjType = $value->dischargeType;
            ?>

            <div class="panel-heading" style="background-color:whitesmoke; cursor:pointer " >
                <h6 class="panel-title" >

                    <span  style="color:#428BCA" class="pull-left text-primary small "><em>
                            BHT No:<?php echo $value->bhtNo; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                            <?php echo $value->wardNo; ?>&nbsp;-&nbsp;Bed :
                            
                            <?php
                    if ($value->bedNo == -99) {
                        echo "None";
                    } else {
                        echo $value->bedNo;
                    }
                    ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        </em></span>
                    <span  style="color:#428BCA" class="pull-left text-primary  "><em>
                            <?php
                            if ($discharjType != 'none') {

                                echo "--Discharged BHT--";
                            }
                            ?>
                        </em></span>

                    <span  style="color:#428BCA" class="pull-right text-primary small "><em>Admitted Date & Time : <?php echo date("Y-m-d ", $value->admitDateTime / 1000); ?> 
                            &nbsp;    <?php echo date(" h:ia", $value->admitDateTime / 1000); ?></em> </span>
                </h6>
            </div>
            <div style="background-color:#F0F0F0  ">

                <div class="row">
                    <div class="col-md-5">
                        <b>Admission Unit : </b><?php echo $value->admissionUnit; ?><br/>     
                        <b>Doctor : </b> <?php echo $value->doctorID->title . ". " . $value->doctorID->firstName . " " . $value->doctorID->lastName; ?><br/>     
                        <b>Diagnosis : </b><?php echo $value->previousHistory; ?><br/>  
                        <b>Previous History : </b><?php echo $value->previousHistory; ?><br/>     
                        <b>Patient Complain : </b><?php echo $value->patientComplain; ?>
                    </div>
                    <div class="col-md-5"> 
                        <?php
                        if ($discharjType == "IT") {
                            ?>

                            <b>Discharge Type :</b> Internal Transfer
                            <?php
                        }
                        ?> 

                        <?php
                        if ($discharjType == "ET") {
                            ?>

                            <b>Discharge Type :</b> External Transfer
                            <?php
                        }
                        ?> 


                        <?php
                        if ($discharjType == "L") {
                            ?>

                            <b>Discharge Type :</b> LAMA(Leaving Against Medical Advice)
                            <?php
                        }
                        ?> 


                        <?php
                        if ($discharjType == "M") {
                            ?>

                            <b>Discharge Type :</b> Missing Patient 
                            <?php
                        }
                        ?> 


                        <?php
                        if ($discharjType == "ND") {
                            ?>

                            <b>Discharge Type :</b> Normal Discharge
                            <?php
                        }
                        ?> 
                        <?php
                        if ($discharjType == "D") {
                            ?>

                            <b>Discharge Type :</b> Death Patient
                            <?php
                        }
                        ?>
                        <br/>
                        <?php
                        if ($discharjType == "IT") {
                            $this->load->model('/inward/transfer/InternalTrasferModel', 'internaltransfer');
                            $internal = $this->internaltransfer->getInternalTransferByBHTNo($value->bhtNo);

                            foreach ($internal as $v) {
                                $InternalAdmission = $v;
                                ?>
                                <br/>
                                <b>Transfer Ward :  </b><?php echo $InternalAdmission->transferWard->wardNo; ?>  <br/>
                                <b> Reason For Transfer :  </b><?php echo $InternalAdmission->resonForTrasnsfer; ?>  <br/>
                                <b> Transfer Date&Time :  </b><?php echo date("Y-m-d ", $InternalAdmission->transferCreatedDate / 1000); ?> 
                                &nbsp;    <?php echo date(" h:ia", $InternalAdmission->transferCreatedDate / 1000); ?>  <br/>
                                <b> Transfer BHT No :  </b><?php echo $InternalAdmission->new_bht_no->bhtNo; ?> 
                                <?php
                            }
                        }
                        ?>

                        <?php
                        if ($discharjType == "ET") {
                             $this->load->model('/inward/transfer/InternalTrasferModel', 'internaltransfer');
                            $Externall = $this->internaltransfer->getExternalTransferByBHTNo($value->bhtNo);
                        foreach ($Externall as $v) {
                                $ExternalAdmission = $v;
                                ?>
                                <br/>
                                <b>Transfer Hospital :  </b><?php echo $ExternalAdmission->transferTo; ?>  <br/>
                                <b> Reason For Transfer :  </b><?php echo $ExternalAdmission->resonForTrasnsfer; ?>  <br/>
                                <b> Transfer Date&Time :  </b><?php echo date("Y-m-d ", $ExternalAdmission->transferCreatedUser / 1000); ?> 
                                &nbsp;    <?php echo date(" h:ia", $ExternalAdmission->transferCreatedUser / 1000); ?> 

                            <?php }
                        }
                        ?>
                        <br/>
                        <?php
                        if ($discharjType == "") {
                            ?>

                            <b>Discharge Remark :</b><?php echo $value->remark; ?>
                            <?php
                        }
                        ?>

                    </div>
                    <div class="col-md-2"> 
                        <button  class="btn btn-success btn-xs "  type="button" onclick="loadBHT(<?php echo $value->bhtNo ?>,<?php echo $value->patientID->patientID; ?>);" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Open Patient BHT">
                            <span class="glyphicon glyphicon-new-window">Open BHT</span>
                        </button>
                    </div>

                </div>





            </div>

            <?php
        }
        ?>
    </div></div>

<script>
    function loadBHT(bhtNo,patient)
    {
        window.open("<?php echo base_url(); ?>index.php/inward/patientBHTC/BHT/"+bhtNo+"/"+patient);
    }
</script>

<!--<script>

    var icons = {
        header: "ui-icon-circle-arrow-e",
        activeHeader: "ui-icon-circle-arrow-s"
    };
    $( "#accordion" ).accordion({
        icons: icons,
        heightStyle: "content"
    });
</script>-->