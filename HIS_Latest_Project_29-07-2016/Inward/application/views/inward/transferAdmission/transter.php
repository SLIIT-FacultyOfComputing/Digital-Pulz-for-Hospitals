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
    $tranferId = $value->transferId;
    $bhtNo = $value->bhtNo->bhtNo;

    $patientID = $value->bhtNo->patientID->patientID;
    $patienttitle = $value->bhtNo->patientID->patientTitle;
    $patientname = $value->bhtNo->patientID->patientFullName;
    $patientGender = $value->bhtNo->patientID->patientGender;
    $patientCivilStatus = $value->bhtNo->patientID->patientCivilStatus;
    $dob = $value->bhtNo->patientID->patientDateOfBirth;

    $transferFromWard = $value->transferFromWard->wardNo;
    $transferWard = $value->transferWard->wardNo;
    $resonForTrasnsfer = $value->resonForTrasnsfer;
    $reportOfSpacialExamination = $value->reportOfSpacialExamination;
    $treatmentSuggested = $value->treatmentSuggested;
    $TransferDate = date("Y-m-d ", $value->transferCreatedDate / 1000);
    $TransferTime = date(" h:ia", $value->transferCreatedDate / 1000);
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

<div class="panel panel-primary">
    <div class="panel-heading" style="background-color:whitesmoke"> 
        <h4 class="panel-title"  style="color:#428BCA">Internal Transfer Admission</h4>
    </div>
    <div class="panel-body">
            
            <div class="row">
                <div class=" col-sm-4">
                    <label  > BHT No : </label> <?php echo "$bhtNo"; ?>
                </div>

                <div class=" col-sm-4">
                    <label  >  Transfer : </label>   <?php echo "$transferFromWard to $transferWard"; ?>
                </div>

                <div class="col-sm-4">
                    <label  >  Transfer Date&Time : </label>   <?php echo $TransferDate; ?><?php echo $TransferTime; ?>
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


      <div class="alert alert-info" id="panel">
                <legend>&nbsp;&nbsp;&nbsp;  Ward Admission</legend>
                <?php echo form_open('inward/transferAdmissionC/InsertwardAdmission'); ?>
                <fieldset>
                    <div class="form-group">
                        <label style="color: #797979;"   class="col-sm-2 control-label" for="Designation">Designation</label>
            <div class="col-xs-4">
                <select  id="Designation" name="Designation" type="text" class="form-control" id="bedNo_label" value="" onchange="loadDoctors(this.value)" required="required" >
                          <option>---Select Designation---</option>     
 <?php
                              
                    for ($i=0;$i<sizeof($designature);$i++) {
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
                    <div class="form-group">
                        <br/>
                        <label style="color: #797979;"  class="col-sm-2 control-label" for="bedNo">Bed No</label>
                        <div class="col-xs-4">
                            <select id="bedNo" name="bedNo" type="text" class="form-control" value="" required="required" >
                                 <?php
                                foreach ($beds as $bed) {
                                    ?>

                                    <option  id="bedNo" name="bedNo" value="<?php echo $bed->bedNo; ?>"> <?php echo "Bed -".$bed->bedNo; ?></option>

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
                    
                     <input type="hidden" id="wardNo" name="wardNo" value="<?php echo $transferWard; ?>" />
                       <input type="hidden" id="patientID" name="patientID" value="<?php echo $patientID; ?>" />
                       <input type="hidden" id="TransferId" name="TransferId" value="<?php echo $tranferId; ?>" />
                      
                </fieldset>
                <?php echo form_close(); ?> 
            </div>
        </div>
</div>

