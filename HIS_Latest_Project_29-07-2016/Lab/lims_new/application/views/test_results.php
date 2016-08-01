<style>
    .form-horizontal .control-label{
        text-align:left;
    }
</style>

<script>
    $('document').ready(function() {

        check_href = function() {
            return false;
        }


        $('#datetimepicker2').datepicker({
            format: "dd/mm/yyyy"
        });
        $('#datetimepicker1').datepicker({
            format: "dd/mm/yyyy"
        });

        <?php
        $array = $this->uri->uri_to_assoc(3);
        $pid = $array['PID'];
        $testid = $array['TestID'];
        $reqid = $array['ReqID'];
        $hin = $array['HIN'];
        ?>

        var reqID = '<?php echo $reqid; ?>';
        var TestID = '<?php echo $testid; ?>';
        var PID = '<?php echo $pid; ?>';


        var fields;
        //Get Fields
        function GetFields() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>test_results/getAllFields',
                data: {'ID': TestID},
                dataType: 'json',
                success: function(output) {

                    var count = 1;
                    $.each(output, function(key, val) {

                       // alert(val['parent_FieldID'] );
                        $('#tbdy').append('<tr id=' + count + '><td colspan="7" style="width:33.33%;">' + val['parent_FieldID'] + '</td><td colspan="7" style="width:33.33%;">' + val['parent_FieldName'] + '</td><td colspan="7" style="width:33.33%;"><input id="text' + count + '" type="text" size=8  class="text-primary" ></td></tr>');
                        count++;
                    });

                }
            });
        }

        GetFields();

        function getPatientDetails() {
            $.ajax({
                method: "POST",
                url: "<?php echo base_url(); ?>test_results/getAllPatientTestsAjax",
                data: { pid: "<?php echo $pid ?>" },
                dataType:'json'
            })
                .done(function( msg ) {
                    if(msg!=false){
                        var name = msg[0].admintionID.patientId.patientFullName;
                        $('#fname').text(name);
                        var dobTimeStamp = msg[0].admintionID.patientId.patientDateOfBirth;
                        var date = new Date(dobTimeStamp);
                        var dob = date.toYMD();
                        $('#DOB').text(dob);
                        var gender = msg[0].admintionID.patientId.patientGender;
                        $('#gender').text(gender);
                    }
                });
        }

        getPatientDetails();


        (function() {
            Date.prototype.toYMD = Date_toYMD;
            function Date_toYMD() {
                var year, month, day;
                year = String(this.getFullYear());
                month = String(this.getMonth() + 1);
                if (month.length == 1) {
                    month = "0" + month;
                }
                day = String(this.getDate());
                if (day.length == 1) {
                    day = "0" + day;
                }
                return year + "-" + month + "-" + day;
            }
        })();

        $('#save').click(function() {
            var count = 0;
            var json = [];

            var mainResult;
            $('#tbl tbody tr').each(function(i, el) {
                if (count != 0) {
                    var key = $.trim($(this).find('td:eq(0)').text()),
                            val = $.trim($(this).find('#text' + count + '').val()),
                            obj = {};

                    obj['fParentF_ID'] = key;
                    obj['fTestRequest_ID'] = reqID;
                    obj['mainResult'] = val;
                    json.push(obj);

                }
                count++;
            });

            var myJSONObject = {"Parentresults": json};
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>test_results/AddMainResults',
                data: {'results': myJSONObject,'ReqID':'<?php echo $reqid; ?>'},
                success: function(output) {
                    alert("Test Results Added");

                    window.location.href = "http://localhost/lims_new/test_request";

                  // window.location.href = 'localhost/lims_new/application/viewsreport_view/index/ReqID/'.$reqid.'/TestID/'.$testid.'/PID/'.pid.'/HIN/'.$hin'';
                }
                // 
            });

        });

    });
</script>

<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <!-- Primary box -->
            <div class="box box-solid box-primary">
                <div data-original-title="Header tooltip" class="box-header" data-toggle="tooltip" title="">
                    <h3 class="box-title">Test Results input </h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-primary btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="PID" class="col-sm-4 control-label">Patient HIN</label>
                            <div class="col-sm-8">
                                <label id="PID" class="form-control" type="text"><?php echo($hin); ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fname" class="col-sm-4 control-label">Patient Name</label>
                            <div class="col-sm-8">
                                <label id="fname" name="fname" class="form-control" type="text" ><?php echo $specimen->fpatient_ID->patientFullName; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="DOB" class="col-sm-4 control-label">DOB</label>
                            <div class="col-sm-8">
                                <label id="DOB" class="form-control" type="text" ><?php echo date('Y-m-d', $specimen->fpatient_ID->patientDateOfBirth/1000); ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gender" class="col-sm-4 control-label">Gender</label>
                            <div class="col-sm-8">
                                <label id="gender" class="form-control" type="text" ><?php echo ucfirst($specimen->fpatient_ID->patientGender); ?></label>
                            </div>
                        </div>
                    </form>
                    <table id="tbl" class="table table-bordered  table-hover" border='0' align='center'
                           style="border-collapse:collapse " cellspacing='3' cellpadding='5'>
                        <tr>
                            <th colspan="7" bgcolor="black"
                                style="width:33.33%; text-align:center; color: #797979;background-color:#D8D8D8;  font-size:12px">
                                Field ID
                            </th>
                            <th colspan="7" bgcolor="black"
                                style="width:33.33%; text-align:center; color: #797979;background-color:#D8D8D8;  font-size:12px">
                                Test Field Name
                            </th>
                            <th colspan="7" bgcolor="black"
                                style="width:33.33%; text-align:center; color: #797979;background-color:#D8D8D8;  font-size:12px">
                                Main result
                            </th>

                        </tr>

                        <tbody id='tbdy'>


                        </tbody>


                    </table>
                </div>
                <div class="box-footer">
                    <div class="btn-group">
                        <button id="save" type="button" class="btn btn-primary">Save & Generate Report </button>
                     </div>
                </div>
            </div><!-- /.box -->
        </div>
        <div class="col-md-6">
            <!-- Primary box -->
            <div class="box box-solid box-primary">
                <div data-original-title="Header tooltip" class="box-header" data-toggle="tooltip" title="">
                    <h3 class="box-title">Patients' Recent Tests</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-primary btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="list-group">

                        <?php
                        date_default_timezone_set("Asia/Colombo");
                        foreach ($history as $value) {
                            ?>
                            <a href="<?php echo base_url(); ?>report_view/index/ReqID/<?php echo $value->labTestRequest_ID; ?>/TestID/<?php echo $value->ftest_ID->test_ID; ?>/PID/<?php echo $value->fpatient_ID->patientID; ?>" class="list-group-item" <?php echo ($value->status == 'Report Issued' ) ? "" : "onclick='return check_href();'"; ?>>

                                <i  <?php echo ($value->status == 'Report Issued' ) ? "class='glyphicon glyphicon-ok '  style='color:green'" : "class='glyphicon glyphicon-remove'  style='color:red'"; ?>></i> <?php echo $value->ftest_ID->test_Name; ?>
                                <span class="pull-right text-muted small"><em><?php echo $value->test_RequestDate; ?></em>
                                </span>
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                 </div>
            </div><!-- /.box -->
        </div>
    </div>
</div>