<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<!-- Bootstrap Date-Picker Plugin -->

 <script src="<?= base_url('/Bootstrap/js/bootstrap-datepicker.min.js'); ?>"></script>
<script type="text/javascript">
function getFeildsValue()
    {
        var test_name = $('#TestName option:selected').attr("itemid");
        var patient_id = $('#PatientID').text();
        
        var lab_id = $('#LabID option:selected').attr("itemid");
        var comment = $('#Comment').val();
        var priority = $('#Priority option:selected').text();
        var due_date = $('#dob').val();
        var doc = $('#Uid').text();
        var visit_Id = $('#visitId').val();
       
        if (due_date.length === 0 || comment.length === 0 ||document.getElementById("TestName").value=== "1")
        {
           alert('Please Fill the Required Feilds');
        
        
        }
        else {


            var Request = [];
            Request.push(test_name);
            Request.push(patient_id);
        
            Request.push(13);
            Request.push(comment);
            Request.push(priority);
            Request.push("Sample Required");
            Request.push(due_date);
            Request.push(doc);
            Request.push(visit_Id);

            //alert(Request);

             // var Request = {"test_name": test_name, "patient_id": patient_id , "lab_id": lab_id , "comment": comment , "priority": priority , "due_date": due_date , "doc": doc};
             //alert(Request);
             if (Request != '')
            {
                $.ajax({
                    
                    type: "POST",
                    url: '<?php echo base_url() ?>/index.php/Lab/newtestrequest/AddRequest',
                    crossDomain: true,
                   
                      data: {'Request': JSON.stringify(Request)},
              
                    success: function (output) {
                        $('#dob').val("");
                        
                 $('#Comment').val("");
                       // alert(output);
                     $(".alert").removeClass("in").show();
    $ (".alert").delay(200).addClass("in").fadeOut(2010);
                       // alert("Successful");
  // redirect('patient_visit_c/view1/'.$pid.'/'.$recentvisit[0]->visitID);

             }
                });
               
            }
        }

    }

</script>

<section class="content-header">
    <h1>
        Laboratory <small> Lab Request</small>
    </h1>
    
    <div class="col-md-8">
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
    <div class="col-md-4" align="right"><h4><small><?php echo "$pprofile->patientHIN"; ?></small></h4></div>
</section>
</br>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">Lab Request</h3>
                    <input type="text" id="visitId" value="<?php echo $visitid?>" hidden/>
                    

                </div>
                <hr>
                <div class="box-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon">Test Name *</span> <select
                                        id="TestName" class="form-control">
                                        <option selected="selected" value="1" itemid="0" disabled>Select Test</option>
                                <?php foreach ( $TestNames as $row ) { ?>
                                    <option
                                            itemid=<?php echo $row->test_ID; ?>> <?php echo $row->test_Name; ?>
                                    </option> 

                                    <?php } ?>
                            </select>
                                </div>
                            </div>
                        </div>
                        <br>
                      

                           <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon">Patient ID</span> 
                                    <div class="form-group">
                           
                          
                                <label id="PatientID" class="form-control" type="text"><?php echo($patientDetalis); ?></label>
                           
                                   </div>
                                </div>
                            </div>
                        </div>
                           <br>

                   
                      
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon">Priority * </span> <select
                                        id="Priority" class="form-control">
                                        <option selected="selected" value="" itemid="1">High</option>
                                        <option itemid="2">Medium</option>
                                        <option itemid="3">low</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-6">
                            <?php 
                date_default_timezone_set('Asia/Colombo');?>
                <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                    <span class="input-group-addon">Due Date *</span> <input
                                        type="text" placeholder="click to Select Due Date" 
                                        class="form-control" type="text" id="dob" name="Due_date"  required="required"/>

                                </div>
                            </div>

                        </div>
                        <br>
                         <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon">Comment *</span>
                                    <textarea class="form-control" id="Comment" name="fullname"
                                        required="required" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <!-- <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon">Sample Centre </span> <select
                                        id="SCID" class="form-control">
                                        <option selected="selected" value="" itemid="0">Select Sample
                                            Centre</option>
                                        <option itemid="1">OPD</option>
                                        <option itemid="2">Ward</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <br> -->
                       <div class="row" hidden>
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon">Patient ID</span> 
                                    <div class="form-group">
                           
                          
                                <label id="Uid" class="form-control" type="text"> <?php echo $this->session->userdata('userid') ?></label>
                           
                                   </div>
                                </div>
                            </div>
                     </div>
                    
                     <div><b>Fields marked with an asterisk must be filled</b></div><br/>

                        <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <input type='submit' value='Save' class="btn btn-primary" onclick='getFeildsValue()'  />
                                     </div>
                                         
                                    <br/>
    <div class="alert alert-success fade" >
      <button type="button" class="close" data-dismiss="alert" id="x">×</button>
      <strong>Alert!</strong> successfully added..
    </div>
  
  


  </div>





                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

