<script>
    function loadDoctors(designature){
       
        
        var wardNo=document.getElementById("wardNo").value ;
        console.log(wardNo);
                 
        if (designature != ""){
            var url = "http://localhost:8080/HIS_API/rest/HrEmployee/getEmployeesByDeptDesig/"+wardNo+"/"+designature;
      
            $.ajax({
          
                url: url,
                success: function(result) 
                {
                    $('#DoctorID').empty();
                    if(result.length == 0)
                    {
                        var opt = $('<option />'); 
                        opt.val('');
                        opt.text('No Doctor Available');
                        $('#DoctorID').append(opt); 
                    }
                
                    for (var i = 0; i < result.length; i++)  
                    {
                        var doc =  result[i];
                        var opt = $('<option />'); 
                        console.log(doc.bedNo);
                        opt.val(doc[0]);
                        opt.text(doc[1]+' '+doc[2]+' '+doc[3]);
                        $('#DoctorID').append(opt); 
                    }
                } //end success
            }); //end AJAX
        } else {
            $('#DoctorID').empty();
      
        }//end if
           
       
    } //end change 
</script>

<?php
foreach ($transview as $value) {
    $auto_id = $value->auto_id;


    $patientID = $value->patient_id->patientID;
    $patienttitle = $value->patient_id->patientTitle;
    $patientname = $value->patient_id->patientFullName;
    $patientGender = $value->patient_id->patientGender;
    $patientCivilStatus = $value->patient_id->patientCivilStatus;
    $dob = $value->patient_id->patientDateOfBirth;

    $title = $value->create_user->hrEmployee->title;
    $fname = $value->create_user->hrEmployee->firstName;
    $lname = $value->create_user->hrEmployee->lastName;

    $isdoctor = $value->is_user_doctor;
    $createEmp_ID = $value->create_user->hrEmployee->empId;

    $request_unit = $value->request_unit;
    $transfer_ward = $value->transfer_ward->wardNo;
    $remark = $value->remark;
    $TransferDate = date("Y-m-d ", $value->create_date_time / 1000);
    $TransferTime = date(" h:ia", $value->create_date_time / 1000);
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

<div class="panel panel-primary" >
    <div class="panel-heading" style="height: 50px;">
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
</div>
<?php echo form_open('inward/transferAdmissionC/WardRequestAdmission'); ?>
<div class="panel panel-primary">
    <div class="panel-heading" style="background-color:whitesmoke"> 
        <h4 class="panel-title"  style="color:#428BCA">Ward Admission Request</h4>
    </div>
    <div class="panel-body">

        <div class="row">
            <div class=" col-sm-4">
                <label  > Admission Ward : </label> <?php echo "$transfer_ward"; ?>
            </div>

            <div class=" col-sm-4">
                <label  >  Transfer Unit : </label>   <?php echo "$request_unit"; ?>
            </div>

            <div class="col-sm-4">
                <label  >  Transfer Date&Time : </label>   <?php echo $TransferDate; ?><?php echo $TransferTime; ?>
            </div>

        </div>    

        <div class="row">
            <div class=" col-sm-12">
                <?php if ($isdoctor == 0) {
                    ?>

                    <label >  Request Send User : </label>   <?php echo $title . ". " . $fname . " " . $lname; ?>

                <?php } else {
                    ?>
                    <label >  Consultant's Name : </label>   <?php echo $title . ". " . $fname . " " . $lname; ?>
                    <input type="hidden" id="DoctorID" name="DoctorID" value="<?php echo $createEmp_ID; ?>" />


                    <?php
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class=" col-sm-12">
                <label >  Remark : </label>   <?php echo $remark; ?>
            </div>
        </div>


        <div class="alert alert-info" id="panel">
            <legend>&nbsp;&nbsp;&nbsp;  Ward Admission</legend>

            <fieldset>
                <?php
                if ($isdoctor == 0) {
                    ?>
                    <div class="form-group">
                        <label style="color: #797979;"   class="col-sm-2 control-label" for="Designation">Designation</label>
                        <div class="col-xs-4">
                            <select  id="Designation" name="Designation" type="text" class="form-control" id="bedNo_label" value="" onchange="loadDoctors(this.value)" required="required" >
                                <option>---Select Designation---</option>     
                                <?php
                                for ($i = 0; $i < sizeof($designature); $i++) {
                                    ?>

                                    <option id="Designation" name="Designation" value="<?php echo $designature[$i][0]; ?>" > <?php echo $designature[$i][1]; ?></option>

                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group"> <br/>
                        <label style="color: #797979;" class="col-sm-2 control-label" for="DoctorID">Consultant's Name</label>
                        <div class="col-xs-4">
                            <select  id="DoctorID" name="DoctorID" class="form-control" required="required">

                                <option value="" ></option>


                            </select>

                        </div>
                    </div> 
                    <?php
                }
                ?>
                <div class="form-group">
                    <br/>
                    <label style="color: #797979;"  class="col-sm-2 control-label" for="bedNo">Bed No</label>
                    <div class="col-xs-4">
                        <select id="bedNo" name="bedNo" type="text" class="form-control" value="" required="required" >
                            <?php
                            foreach ($beds as $bed) {
                                ?>

                                <option  id="bedNo" name="bedNo" value="<?php echo $bed->bedNo; ?>"> <?php echo "Bed -" . $bed->bedNo; ?></option>

                                <?php
                            }
                            ?>  
                            <option  id="bedNo" name="bedNo" value="-99"> <?php echo "None Bed Allocation"; ?></option>


                        </select>
                    </div>
                </div> 

                <div class="form-group">
                    <br/>
                    <label style="color: #797979;"  class="col-sm-2 control-label" for="admitDateTime">Admitted Date Time</label>
                    <div class="col-xs-4">
                        <input id="admitDateTime" name="admitDateTime" class="form-control" type="datetime-local" value="" required="required" />
                    </div>
                </div> 


                <div class="form-group">
                    <br/>
                    <label style="color: #797979;"  class="col-sm-2 control-label" for="patientComplain">Patient Complain</label>
                    <div class="col-xs-4">
                        <input id="patientComplain" name="patientComplain" class="form-control" type="text"  value="" />
                    </div>
                </div> 

                <div class="form-group">
                    <br/>
                    <label style="color: #797979;"  class="col-sm-2 control-label" for="previousHistory">Previous History</label>
                    <div class="col-xs-4">
                        <input id="previousHistory" name="previousHistory" type="text" class="form-control" value=""  />
                    </div>
                </div> 


                <div class="form-group">
                    <br/>&nbsp;&nbsp;&nbsp;
                    <input type="submit" class="btn btn-large btn-info" value="Admit Patient" name="btnSubmit" >
                </div>  

                <input type="hidden" id="wardNo" name="wardNo" value="<?php echo $transfer_ward; ?>" />
                <input type="hidden" id="patientID" name="patientID" value="<?php echo $patientID; ?>" />
                <input type="hidden" id="autoid" name="autoid" value="<?php echo $auto_id; ?>" />
                <input type="hidden" id="request_unit" name="request_unit" value="<?php echo $request_unit; ?>" />
            </fieldset>
            <?php echo form_close(); ?> 
        </div>
    </div>
</div>

