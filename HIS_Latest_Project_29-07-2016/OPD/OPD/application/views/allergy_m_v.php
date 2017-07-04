<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<script>
    //document.getElementById('patient_overview_header').style.display = "";

    var cusid_ele = document.getElementsByClassName('patient_overview');
    for (var i = 0; i < cusid_ele.length; ++i) {
           document.getElementsByClassName('patient_overview')[i].style.display = "";
    }
   // document.getElementsByClassName('patient_overview')[0].className = 'patient_overview active';
</script>

<script>
//    $(function() {
//        var availableTags = <?php //echo $complaints; ?>//;
//        $("#inputInjury").autocomplete({
//            source: availableTags
//        });
//    });
//
//
//// Start Ready
//    $(document).ready(function () {
<?php
//if ($allergy[0]->active == '0') {
//
//    echo "$('#myform :input:not(#active):not(.btn-primary)').attr('disabled', true); ";
//}
//?>
        

</script>


<div class="row">
        <!-- left column -->
        <div class="col-md-12">

    <div class="span10">

        <?php
        if (preg_match('/Edit/', $title)) {
            echo form_open('allergies_c/update/' . $pid . "/" . $alid, array('name' => 'myform', 'id' => 'myform'));
        } else {
            echo form_open('allergies_c/save/' . $pid . "/" . $visitid, array('name' => 'myform', 'id' => 'myform'));
        }
        ?>

        <section class="content-header">
            <h1>
                Add Allergy
            </h1>
            <div class="col-md-9">
                <h4><small><b><?php
                            if ($pprofile->patientTitle == "Baby")
                                echo "$pprofile->patientTitle $pprofile->patientFullName";
                            else
                                echo "$pprofile->patientTitle $pprofile->patientFullName";
                            ?> </b> / <?php echo "$pprofile->patientGender"; ?> / <?php
                        date_default_timezone_set('Asia/Colombo');
                        echo (date("Y") - date("Y",$pprofile->patientDateOfBirth/1000));  ?>Yrs <?php
                        date_default_timezone_set('Asia/Colombo');
                        echo (date("m") - date("m",$pprofile->patientDateOfBirth/1000));  ?>Mths <?php
                        date_default_timezone_set('Asia/Colombo');
                        echo (date("d") - date("d",$pprofile->patientDateOfBirth/1000));  ?>Dys /
                        <?php echo "$pprofile->patientCivilStatus";?> /
                        <?php echo "$pprofile->patientAddress" ;?>
                    </small></h4></div>
            <div class="col-md-3" align="right"><h4><small><?php echo "$pprofile->patientHIN"; ?></small></h4></div>
            <br>
            <br>
        </section>
<div class="modal-example">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Allergy</h3>

            </div>

            <div class="panel-body">

                <div>

                    <!-- Message for operation status  ************************************************************** --> 
                    <?php
                    if ($status !== 0) {
                        if ((!preg_match('/Edit/', $title)) & $status == "True") {
                            ?>
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong> Successful !  </strong> Allergy Added Successfully
                            </div>
                        <?php } else if (preg_match('/Edit/', $title) & $status == "True") { ?>

                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong> Successful !  </strong> Allergy updated Successfully
                            </div>

                        <?php } ?>


                        <?php if ((!preg_match('/Edit/', $title)) & $status == "False") { ?>

                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Fail !</strong> Failed to add the Allergy
                            </div>


                        <?php } else if (preg_match('/Edit/', $title) & $status == "False") { ?>

                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Fail !</strong> Failed to update the Allergy
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <!-- **************************************************************************************** --> 		

                    <?php if (preg_match('/Edit/', $title) && $allergy[0]->allergyActive == '0') { ?>
                        <div class="alert alert-warning">
                            The record <strong> is not active  </strong>  
                        </div>
                    <?php } ?>


                    <div class="form-group input-group" style="margin-top: 10px">
                        <span style="width: 125px"  class="input-group-addon">Allergy*</span>

                        <input type="text" class="form-control" list="companyList" onclick="loadAllergy();"  style="width: 350px" id="alname" name="alname" pattern="[A-Za-z ]+" required="required" value="<?php
                        if (preg_match('/Edit/', $title)) {
                            echo $allergy[0]->allergyName;
                        }
                        ?>" >
                        <script>
                            function loadAllergy()
                            {   
                                $.ajax({
                                    url: "http://localhost:8080/HIS_API/rest/LiveSearch/allergyLivesearch",
                                    type: 'GET',
                                    crossDomain: true,
                                    success: function (data) {
                                        for (var i = 0; i < data.length; i++)
                                        {
                                            $("#companyList").append("<option value='" + data[i]['allergyname'] + "'></option>");
                                        }

                                    }
                                });
                            }
                        </script>
                        <datalist id="companyList"></datalist>
                    </div>
                </div>

                <div class="form-group input-group" style="margin-top: 10px">
                    <span style="width: 125px"  class="input-group-addon">Status</span>

                    <select id="status" style="width: 350px" name="status" class="form-control">
                        <option  <?php
                        if (preg_match('/Edit/', $title) && $allergy[0]->allergyStatus == 'Past') {
                            echo 'selected';
                        }
                        ?> value="Past">Past</option>
                        <option  <?php
                        if (preg_match('/Edit/', $title) && $allergy[0]->allergyStatus == 'Current') {
                            echo 'selected';
                        }
                        ?>   value="Current">Current</option>

                    </select>

                </div>


                <div class="form-group input-group" style="margin-top: 10px">
                    <span style="width: 125px" for="remarks" class="input-group-addon">Remarks</span>
                    <div class="controls">
                        <textarea class="form-control" style="min-width: 350px;max-width: 350px;min-height: 60px;height:auto" id="remarks" name="remarks"   rows="3"><?php
                            if (preg_match('/Edit/', $title)) {
                                echo $allergy[0]->allergyRemarks;
                            }
                            ?></textarea>
                    </div>
                </div>


                <?php if (preg_match('/Edit/', $title)) { ?> 

                    <div class="control-group">
                        <div class="form-group input-group" style="margin-top: 10px">
                            <span style="width: 80px"  class="input-group-addon">Active</span>
                            <select id="active" name="active" class="form-control">
                                <option  <?php
                                if ($allergy[0]->allergyActive == '1') {
                                    echo 'selected';
                                }
                                ?>   value="1">Yes</option>
                                <option   <?php
                                if ($allergy[0]->allergyActive == '0') {
                                    echo 'selected';
                                }
                                ?>  value="0">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">

                        <div class="controls">
                            <label  class="lastmod">Last edit by <?php echo $allergy[0]->allergyLastUpdateUser->userName . " on " . $allergy[0]->allergyLastUpdate; ?></label>
                        </div>
                    </div>

                <?php } ?> 	

                <div class="form-actions">
                    <input  name="submit" type="submit"  class="btn btn-primary"  value="Save"/>
                    <button type="reset" class='btn'  onclick="history.go(-1);">Cancel</button>
                </div>


            </div>

            <?php echo form_close(); ?>

            <!--Ending point of panel body-->
        </div>
    </div>
    <!--ending point of panel-->
</div>
</div>
