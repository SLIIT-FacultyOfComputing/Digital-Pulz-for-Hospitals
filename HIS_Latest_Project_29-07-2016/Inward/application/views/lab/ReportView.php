<script>
    $('document').ready(function(){
        $('.combobox').combobox({bsVersion: '2'});

        var reqID = GetPara('ReqID');
        var TestID = GetPara('TestID');
        var PID = GetPara('PID');



        function GetPara(name) {
            var GetReqID = new RegExp('[\?%&]' + name + '=([^%&#]*)').exec(window.location.href);
            if (GetReqID == null) {
                return null;
            } else {
                return GetReqID[1] || 0;
            }
        }

        function GetReport() {

            $.ajax({
                type: "POST",
                url: 'http://localhost/Inward/index.php/lab/ReportController/getAllReport',
                data: { 'ID': reqID},
                dataType: 'JSON',
                success: function (output) {

                    var count = 1;
                    $.each(output, function (key, val) {
                        $('#tbdy').append('<tr id=' + count + '><td colspan="7" style="width:179px;">' + val['fParentF_ID']['parent_FieldName'] + '</td><td colspan="7" style="width:179px;">' + val['parent_FieldName'] + '</td><td colspan="7" style="width:179px;">'+val['mainResult']+'</td></tr>');
                        $("#fname").text(val['fTestRequest_ID']['fpatient_ID']['patientFullName']);
                        $("#PID").text(val['fTestRequest_ID']['fpatient_ID']['patientID']);
                        $("#DOB").text(val['fTestRequest_ID']['fpatient_ID']['patientDateOfBirth']);
                        $("#gender").text(val['fTestRequest_ID']['fpatient_ID']['patientGender']);
                        $("#TestName").text(val['fTestRequest_ID']['ftest_ID']['test_Name']+" "+"REPORT");
                        count++;
                    });
                }
            });
        }
        $('#Print').click(function(){
            var docprint = window.open("about:blank", "_blank");
            var oTable = document.getElementById("panel");
            docprint.document.open();
            docprint.document.write('<html><head><title>HIS - Print</title><link href="css/bootstrap.min.css" rel="stylesheet"><link href="css/bootstrap.css" rel="stylesheet"><link href="css/style.css" rel="stylesheet"><link href="css/font-awesome.min.css" rel="stylesheet"><link href="css/bootstrap-combobox.css" rel="stylesheet">');
            docprint.document.write('<style>.dataTables_length,.dataTables_filter,.dataTables_info,.dataTables_paginate { display: none;}</style>');
            docprint.document.write('</head><body><center>');
            docprint.document.write('<div STYLE="width: 60%;">');
            docprint.document.write(oTable.parentNode.innerHTML);
            docprint.document.write('</div>');
            docprint.document.write('</center></body></html>');
            docprint.document.close();
            docprint.print();
            docprint.close();
        });



        $('#Email').click(function(){
            var address=$('#Email_Address').val();
            if(address==''||address==null){
                alert('enter an email address');
            }
            else{
                $.ajax({
                    type: "POST",
                    url: 'Ajax_calls/Add_sub_Feild_ranges',
                    data: {'email': address},
                    success: function(output) {
                        alert('suddessfully send');
                        //$('#save_Range').prop('disabled', true);
                    }
                });
            }
        });

        GetReport();




    });


</script>
<div id="page-wrapper">

    <div class="row" STYLE="position:absolute; TOP:120px;">


	
        <div class="panel panel-primary" style="width: 185%;    ">
            <div id="panel" class="panel-heading" style="height:50px; background-color:whitesmoke">
                <h3 class="panel-title" style="color:#428BCA;  text-align: center; font-size:28px;">BASE HOSPITAL HOMAGAMA</h3>
            </div>
            <div class="panel-body">
                <center><label id="TestName" style="color:#000000;font-size:24px;" type="text"></label><center>
                <br><br>
                <br><br>
                <div class="col-sm-4">
                    <div class="panel panel-primary" style="width: 125%; border-color:#ffffff">

                        <div class="panel-body">
                            <div class="form-group">
							
							  <?php
                                                    date_default_timezone_set("Asia/Colombo");
                                                    foreach ($Report as $value) {
                                                        ?>
                                <label for="PID" class="col-sm-2 control-label" style="text-align: left;width:120px; font-size:12px">Patient
                                    ID</label>
                                <label id="PID" type="text"><?php echo $value->fTestRequest_ID->fpatient_ID->patientID;  ?></label>
                                <br><br>
                                <label for="fname" class="col-sm-2 control-label" style="text-align: left;width:120px; font-size:12px">Patient
                                    Name</label>
                                <label id="fname" type="text"><?php echo $value->fTestRequest_ID->fpatient_ID->patientFullName;  ?></label>
                                <br><br>
                                <label for="DOB" class="col-sm-2 control-label" style="text-align: left;width:120px; font-size:12px">DOB</label>
                                <label id="DOB" type="text"><?php echo $value->fTestRequest_ID->fpatient_ID->patientDateOfBirth ; ?></label>
                                <br><br>
                                <label for="gender" class="col-sm-2 control-label"
                                       style="text-align: left; width:120px; font-size:12px">Gender</label>
                                <label id="gender" type="text" ><?php echo $value->fTestRequest_ID->fpatient_ID->test_Name." "."REPORT";?></label>
                                <br><br>
								
								<?php }  ?>
								
                            </div>

                        </div>
                    </div> <!---Patient Details Panel close ---->

                </div>

                <div class="col-sm-4">
                    <div class="panel panel-primary" style="width: 125%; position: absolute; left: 150px; border-color:#ffffff" >

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="ref" class="col-sm-2 control-label" style="width:120px; font-size:12px; text-align: left">Reference
                                    No</label>
                                <label id="ref" style="text-align: left" type="text">F/57/14</label>
                                <br><br>
                                <label for="fname" class="col-sm-2 control-label" style="width:120px; font-size:12px; text-align: left">Date
                                </label>
                                <label id="fname" style="text-align: left" type="text">26/07/2014</label>
                                <br><br>
                                <label for="DOB" class="col-sm-2 control-label" style="width:120px; font-size:12px; text-align: left ">Ref By</label>
                                <label id="DOB" style="text-align: left" type="text">Dr. C.K.Pathirana</label>
                                <br><br>

                            </div>

                        </div>
                    </div> <!---Patient Details Panel close ---->

                </div>

                <table id="tbl" class="table table-bordered  table-hover" border='0' width='50%' align='center'
                       style="border-collapse:collapse " cellspacing='3' cellpadding='5'>
                    <tr>
                        <th colspan="7" bgcolor="black"
                            style="width:179px; text-align:center; color: #797979;background-color:#D8D8D8;  font-size:12px">
                            Parameter
                        </th>
                        <th colspan="7" bgcolor="black"
                            style="width:179px; text-align:center; color: #797979;background-color:#D8D8D8;  font-size:12px">
                            Reference Range
                        </th>
                        <th colspan="7" bgcolor="black"
                            style="width:179px; text-align:center; color: #797979;background-color:#D8D8D8;  font-size:12px">
                            Result
                        </th>

                        <!--<th colspan="7" bgcolor="black" style="color: #797979;background-color:#D8D8D8;  font-size:12px">Specimen</th> -->
                    </tr>

                    <tbody id='tbdy'>


                    </tbody>


                </table>
                <!--<div>
                    <button id="save" type="button" class="btn btn-primary">Save Report</button>
                    <button type="button" class="btn btn-primary">Print</button>

                </div>-->

            </div>
            <!--Main panel -->

        </div>
        <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="maxVal" class="col-sm-3 control-label">Email Address</label>
            <div class="col-sm-5">
                <input id="Email_Address" type="email" class="form-control" placeholder="Email Address">
            </div>
        </div>

    </form>
            <div>

                <button id="Print" type="button" class="btn btn-primary">Print</button>
                <button id="Email" type="button" class="btn btn-primary">Send as a E-Mail</button>
                <button id="PDF" type="button" class="btn btn-primary">Convert to PDF</button>
        </div>
    </div>
</div>

</body>
</html>
