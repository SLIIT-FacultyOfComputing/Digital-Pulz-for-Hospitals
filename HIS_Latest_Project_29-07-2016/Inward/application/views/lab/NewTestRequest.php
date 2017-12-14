<script type="text/javascript">
function getFeildsValue()
    {
         
        var test_name = $('#TestName option:selected').attr("itemid");
        var patient_id = $('#PatientID').text();
        
        var lab_id = $('#LabID option:selected').attr("itemid");
        var comment = $('#Comment').val();
        var priority = $('#Priority option:selected').text();
        var due_date = $('#datetimepicker1').val();
        var doc = $('#Uid').text();
       
        if (due_date.length === 0 || comment.length === 0)
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

            alert(Request);

             // var Request = {"test_name": test_name, "patient_id": patient_id , "lab_id": lab_id , "comment": comment , "priority": priority , "due_date": due_date , "doc": doc};
             //alert(Request);
             if (Request != '')
            {
                $.ajax({
                    
                    type: "POST",
                    url: 'http://localhost/Inward/index.php/lab/NewTestRequest/AddRequest',
                    crossDomain: true,
                    // data: {"test_name": test_name,
                    // "patient_id": patient_id,
                    // "lab_id": lab_id,
                    // "comment": comment,
                    // "priority": priority,
                    // "due_date": due_date,
                    // "doc": doc,
                      data: {'Request': JSON.stringify(Request)},
              
                    success: function (output) {
                        alert(output);
                    }
                });
                alert("abc");
                
                 //echo "<script> // <script>";
                 //alert('test alert');
            }
        }

    }

</script>

<section class="content-header">
    <h1>
        Laboratory <small> Lab Request</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-wheelchair"></i> Laboratory</a></li>
        <li class="active">Lab Request
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
    </ol>
</section>
</br>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">Lab Request</h3>
                </div>
                <hr>
                <br>
                <div class="box-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon">Test Name </span> <select
                                        id="TestName" class="form-control">
                                        <option selected="selected" value="" itemid="0">Select Test</option>
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
                           
                          
                                <label id="PatientID" class="form-control" type="text"><?php echo($patient_id); ?></label>
                           
                                   </div>
                                </div>
                            </div>
                        </div>
                           <br>

                       <!--  <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon">Specimen ID </span> <select
                                        id="SpecimenID" class="form-control">
                                        <option selected="selected" value="" itemid="0">Select
                                            Specimen ID</option>

                                        <option itemid="1">blood</option>
                                        <option itemid="2">tissue biopsies</option>
                                        <option itemid="3">urine</option>
                                    </select>
                                </div>
                            </div>
                        </div> -->
                       <!--  <br> -->
                        <!-- <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon">Laboratory </span> <select
                                        id="LabID" class="form-control">
                                        <option selected="selected" value="" itemid="0">Select
                                            Laboratory</option>
                                        <option itemid="1">Hospital</option>
                                        <option itemid="2">Asiri</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br> -->
                      
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon">Priority </span> <select
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
                                <div class="input-group">
                                    <span class="input-group-addon">Due Date </span> <input
                                        type="text" placeholder="click to Select Due Date"
                                        class="form-control" id="datetimepicker1" name="Due_date" />

                                </div>
                            </div>

                        </div>
                        <br>
                         <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon">Comment </span>
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
                        
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <input type='submit' value='show' onclick='getFeildsValue()' />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

