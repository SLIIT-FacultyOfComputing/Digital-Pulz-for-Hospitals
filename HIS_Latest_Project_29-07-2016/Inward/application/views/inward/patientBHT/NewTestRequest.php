

<script>
    $('document').ready(function(){
        $('.combobox').combobox({bsVersion: '2'});

        $('#datetimepicker1').datepicker({
            format: "dd/mm/yyyy"
        });

        var TestID=0;
        $("#TestName").change(function() {
            TestID = $(this).children(":selected").attr("id");

        });

        var PID=0;
        $("#PatientID").change(function() {
            PID = $(this).children(":selected").attr("id");
        });

        var LabID=0;
        $("#LabID").change(function() {
            LabID = $(this).children(":selected").attr("id");
        });

        var SCID=0;
        $("#SCID").change(function() {
            SCID = $(this).children(":selected").attr("id");
        });



//Test Name drop down
        function GetTestNames()
        {
            $.ajax({
                url: 'lab/NewTestRequest/GetAllTestNames',
                dataType: 'JSON',
                success: function(test) {
                    $.each(test, function(key, val) {
                        //alert(JSON.stringify(val['test_Name']));
                        $('#TestName').append($('<option ID=' + val['test_ID'] + '>').text(val['test_Name']).attr('test_Name', val['test_Name']));

                    });
                },
                async: false
            });
        }
        function GetPatients()
        {
            $.ajax({
                url: 'lab/NewTestRequest/GetAllPatients',
                dataType: 'JSON',
                success: function(test) {
                    $.each(test, function(key, val) {
                        //alert(JSON.stringify(val));
                        $('#PatientID').append($('<option ID=' + val['patientID'] + '>').text( + val['patientID'] +"________"+val['patientFullName']).attr('PatientName', val['patientFullName']));

                    });
                },
                async: false
            });
        }



        function GetAllLabs()
        {
            $.ajax({
                url: 'lab/NewTestRequest/GetAllLabs',
                dataType: 'JSON',
                success: function(test) {
                    $.each(test, function(key, val) {
                        //alert(JSON.stringify(val));
                        $('#LabID').append($('<option ID=' + val['lab_ID'] + '>').text( + val['lab_ID'] +"________"+val['lab_Name']).attr('lab_Name', val['lab_Name']));

                    });
                },
                async: false
            });
        }



        function GetAllSampleCentres()
        {
            $.ajax({
                url: 'lab/NewTestRequest/GetAllSampleCentres',
                dataType: 'JSON',
                success: function(test) {
                    $.each(test, function(key, val) {
                        //alert(JSON.stringify(val));
                        $('#SCID').append($('<option ID=' + val['sampleCenter_ID'] + '>').text( + val['sampleCenter_ID'] +"________"+val['sampleCenter_Name']).attr('sampleCenter_Name', val['sampleCenter_Name']));

                    });
                },
                async: false
            });
        }

        $('#SendReequest').click(function() {


            var new_val = $('#SendReequest').val();

            var Request = []
            Request.push(TestID);
            Request.push(PID);
            Request.push($('#SpecimenID  :selected').text());
            Request.push(LabID);
            Request.push(1);
            Request.push(1);
            Request.push($('#Comment').val());
            Request.push($('#Priority  :selected').text());
            Request.push("SNC");
            Request.push($('#datetimepicker1').val());

            if (Request != '')
            {
                $.ajax({
                    type: "POST",
                    url: 'lab/NewTestRequest/AddRequest',
                    data: {'Request': Request},
                    success: function(output) {
                        alert('Test Added');
                    }
                });
            }
        });







        GetTestNames();
        GetPatients();
        GetAllLabs();
        GetAllSampleCentres();



    });
</script>
<div >


    

            <div class="panel panel-primary">
                <div class="panel-heading" style="background-color:whitesmoke">
                    <h4 class="panel-title" style="color:#428BCA">Laboratory Request</h4>
                </div>
                <div class="panel-body"> 

                    <div class="form-group">
                        <br/>
                        <label for="TestName" class="col-sm-3 control-label">Laboratory Test Name</label>
                        <div class="col-xs-4">
                            <select id="TestName" class="form-control">
                                <option selected="selected" value="">Select Test</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <br/>
                        <label  class="col-sm-3 control-label" for="PatientID">Patient ID</label>
                        <div class="col-xs-4">
                            <select id="PatientID" class="form-control">
                                <option selected="selected" value="">Select Patient ID</option>
                            </select>

                        </div>
                    </div>


                    <div class="form-group">
                        <br/>
                        <label  class="col-sm-3 control-label" for="SpecimenID">Specimen ID</label>
                        <div class="col-xs-4">
                            <select id="SpecimenID" class="form-control">
                                <option selected="selected" value="">Select Specimen ID</option>
                                <option selected="selected" value="">1 </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <br/>
                        <label  class="col-sm-3 control-label" for="LabID">Laboratory</label>
                        <div class="col-xs-4">
                            <select id="LabID" class="form-control">
                                <option selected="selected" value="">Select Laboratory</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <br/>
                        <label  class="col-sm-3 control-label" for="Comment">Comment</label>
                        <div class="col-xs-4">
                            <textarea class="form-control" id="Comment" name="fullname" required="required" rows="3"></textarea>
                        </div>
                    </div>


                    <br><br><br><br>
                    <div class="form-group">
                        <br/>
                        <label  class="col-sm-3 control-label" for="Priority">Priority</label>
                        <div class="col-xs-4">
                            <select id="Priority" class="form-control">
                                <option selected="selected" value="">High</option>
                                <option >Medium</option>
                                <option >low</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <br/>
                        <label for="datetimepicker1" class="col-sm-3 control-label">Due date</label>
                        <div class="col-xs-4"
                        <div class='input-group' >
                            <input  type="text" placeholder="click to Select Due Date" class="form-control"  id="datetimepicker1" name="Due_date">
                        </div>
                        </div>


                    <div class="form-group">
                        <br/>
                        <label class="col-sm-3 control-label" for="SCID">Sample Centre</label>
                        <div class="col-xs-4">
                            <select id="SCID" class="form-control">
                                <option selected="selected" value="">Select Sample Centre</option>
                            </select>
                        </div>
                    </div

                    <br/> <br/> <br/>
                    <div class="form-group">
                        <br/>

                        <div class="col-xs-4">
                                <input name="add_button" style="position: absolute; left: 80%;" type="button" id="SendReequest" class="btn btn-info" size="20" value="Send Request" />
                                <input name="history" style="position: absolute; left: 115%;" type="button" id="TestHistory" class="btn btn-info" size="20" value="Test History" />
                            </select>
                        </div>
                    </div>
                    <br/> <br/> <br/>
                    </div>
                </div>
                </div>
    




