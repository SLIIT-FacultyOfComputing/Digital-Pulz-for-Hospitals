<script type="text/javascript" src="lib/jquery.tabletojson.js"></script>
<script>
    $('document').ready(function() {

        check_href = function() {

            return false;
        }



        $('.combobox').combobox({bsVersion: '2'});


        $('#datetimepicker2').datepicker({
            format: "dd/mm/yyyy"
        });
        $('#datetimepicker1').datepicker({
            format: "dd/mm/yyyy"
        });

        var reqID = GetPara('ReqID');
        var TestID = GetPara('TestID');
        var PID = GetPara('PID');

        $.ajax({
                    type: "POST",
                    url: 'lab/ReportController/getAllReport',
                    data: {'ID': reqID},
                    dataType: 'JSON',
                    success: function(output) {

                        var count = 1;
                        $.each(output, function(key, val) {
                            $("#fname").text(val['fTestRequest_ID']['fpatient_ID']['patientFullName']);
                            $("#PID").text(val['fTestRequest_ID']['fpatient_ID']['patientID']);
                            $("#DOB").text(val['fTestRequest_ID']['fpatient_ID']['patientDateOfBirth']);
                            count++;
                        });

                    }
                });







        function GetPara(name) {
            var GetReqID = new RegExp('[\?%&]' + name + '=([^%&#]*)').exec(window.location.href);
            if (GetReqID == null) {
                return null;
            } else {
                return GetReqID[1] || 0;
            }
        }

        $('#reportView').click(function() {

            // alert(reqID);
            window.location.href = "http://localhost/lims/ReportView?ReqID=" + reqID + "&TestID=" + TestID + "&PID=" + PID + "";
        });




        var fields;
        //Get Fields
        function GetFields() {

            $.ajax({
                type: "POST",
                url: 'lab/TestResultsController/getAllFields',
                data: {'ID': TestID},
                dataType: 'JSON',
                success: function(output) {
                    /*alert(JSON.stringify(output));*/
                    var count = 1;
                    $.each(output, function(key, val) {

                        // alert(val['parent_FieldID']);
                        $('#tbdy').append('<tr id=' + count + '><td colspan="7" style="width:179px;">' + val['parent_FieldID'] + '</td><td colspan="7" style="width:179px;">' + val['parent_FieldName'] + '</td><td colspan="7" style="width:179px;"><input id="text' + count + '" type="text" class="text-primary"></td></tr>');
                        count++;
                    });

                }
            });
        }

        GetFields();


        $('#save').click(function() {
            var count = 0;
            var json = [];

            var mainResult;
            //$("#text" + number + "").val();
            $('#tbl tbody tr').each(function(i, el) {
                if (count != 0) {
                    var key = $.trim($(this).find('td:eq(0)').text()),
                            val = $.trim($(this).find('#text' + count + '').val()),
                            obj = {};

                    obj['fParentF_ID'] = key;
                    obj['fTestRequest_ID'] = reqID;
                    obj['mainResult'] = val;
                    // alert(obj['fTestRequest_ID']);
                    json.push(obj);

                }
                count++;
            });
            var myJSONObject = {"Parentresults": json};
            //alert(JSON.stringify(myJSONObject));
            $.ajax({
                type: "POST",
                url: 'lab/TestResultsController/AddMainResults',
                data: {'results': myJSONObject},
                success: function(output) {
                    alert("Test Results Added");
                }
            });

        });

    });
</script>
<div class="row">
<div class="container">
<div class="panel panel-default" style="width:90%">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> Patient's Laboratory Test Results
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="list-group">

            <?php
            date_default_timezone_set("Asia/Colombo");
            foreach ($history as $value) {
                ?>

                <a href="http://localhost/Inward/index.php/lab/ReportController/index/<?php echo $value->BHT->bhtNo;?>/<?php echo $value->BHT->patientID->patientID;?>?ReqID=<?php echo $value->labTestRequest_ID; ?>&TestID=<?php echo $value->ftest_ID->test_ID; ?>&PID=<?php echo $value->fpatient_ID->patientID; ?>" class="list-group-item" <?php echo ($value->status == 'Report Issued' ) ? "" : "onclick='return check_href();'"; ?>>

                    <i  <?php echo ($value->status == 'Report Issued' ) ? "class='glyphicon glyphicon-ok '  style='color:green'" : "class='glyphicon glyphicon-remove'  style='color:red'"; ?>></i> <?php echo $value->ftest_ID->test_Name; ?>

<em><?php echo "(Status:".$value->status.")"; ?></em>

                    <span class="pull-right text-muted small "><em><?php echo $value->test_RequestDate; ?></em>
                    </span>
                   </a>






                <?php
            }
            ?>   
        </div>
        <!-- /.list-group -->
        <a href="#" class="btn btn-default btn-block">View All Alerts</a>
    </div>
    <!-- /.panel-body -->

</div>
</div>
</div>

