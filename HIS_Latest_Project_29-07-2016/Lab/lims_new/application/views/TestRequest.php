

    <!-- Custom JavaScript for the Menu Toggle -->
    <script>
        $('document').ready(function(){
            resizeDiv();
            window.onresize = function(event) {
                resizeDiv();
            }
            function resizeDiv() {
                vph = $(window).height()-150;
                vpw = $(window).width()-300;
                $('#content').css({'height':vph+'px'})
                $('#content').css({'width':vpw+'px'})
                $('#container').css({'width':vpw-200+'px'})
            }

            $('#tbl').dataTable( {
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "<?php echo base_url(); ?>swf/copy_csv_xls_pdf.swf"
                }
            } );
            $('#tbl2').dataTable( {
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "<?php echo base_url(); ?>swf/copy_csv_xls_pdf.swf"
                }
            } );
            $('#tbl3').dataTable( {
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "<?php echo base_url(); ?>swf/copy_csv_xls_pdf.swf"
                }
            } );
            $('#tbl4').dataTable( {
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "<?php echo base_url(); ?>swf/copy_csv_xls_pdf.swf"
                }
            } );


            $('#datetimepicker2').datepicker({
                format: "dd/mm/yyyy"
            });
            $('#datetimepicker1').datepicker({
                format: "dd/mm/yyyy"
            });

          });


    </script>

<script type="text/javascript">
        $(document).ready(function() {
            var pressed = false; 
            var chars = []; 
            $(window).keypress(function(e) {
                if (e.which >= 48 && e.which <= 57) {
                    chars.push(String.fromCharCode(e.which));
                }
                console.log(e.which + ":" + chars.join("|"));
                if (pressed == false) {
                    setTimeout(function(){
                        
                        if (chars.length >= 1) {
                            var barcode = chars.join("");
                           //alert(barcode);
                            console.log("Barcode Scanned: " + barcode);
                            
			document.getElemenById("search").value=barcode;
                           
                                                 
                        chars = [];
                        pressed = false;
                    },100); //100 mili seconds
                }
                pressed = true;
            });
        });
    </script>

<body>
<div id="wrapper">

    <div id="page-wrapper">

        <div class="row" STYLE="position:absolute; TOP:120px;">
        <h2>Laboratory Test Requests</h2>
            <div class="col-lg-12" style="margin-left: -251px;"  >

                                    <div id="content">
                                        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                                            <li class="active"><a href="#Ward" data-toggle="tab">Ward</a></li>
                                            <li><a href="#OPD" data-toggle="tab">OPD</a></li>
                                            <li><a href="#Clinic" data-toggle="tab">Clinic</a></li>
                                            <li><a href="#Pcu" data-toggle="tab">Pcu</a></li>

                                        </ul>
                                        <div id="my-tab-content" class="tab-content">
                                            <div class="tab-pane active" id="Ward">
                                                <table id="tbl" class="display" cellspacing="0">

                                                    <thead>
                                                    <tr >
                                                        <th>/</th>
                                                        <th>Request ID</th>
                                                        <th>Test ID</th>
                                                        <th>Patient ID</th>
                                                        <th>Lab Name</th>
                                                        <th>Comment</th>
                                                        <th>Priority</th>
                                                        <th>Status</th>
                                                        <th>Req.Date</th>
                                                        <th>Due Date</th>
                                                        <th>Req.person</th>
                                                        
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr >
                                                        <th>/</th>
                                                        <th>Request ID</th>
                                                        <th>Test ID</th>
                                                        <th>Patient ID</th>
                                                        <th>Lab Name</th>
                                                        <th>Comment</th>
                                                        <th>Priority</th>
                                                        <th>Status</th>
                                                        <th>Req.Date</th>
                                                        <th>Due Date</th>
                                                        <th>Req.person</th>
                                                       
                                                    </tr>

                                                    </tfoot>



                                                    <tbody>
                                                    <?php
                                                    date_default_timezone_set("Asia/Colombo");
                                                    foreach ($Requests as $value) {
                                                        $action = "";
                                                        switch ($value->status) {
                                                            case "Sample Required":
                                                                $action = anchor('SpecimenInfo?ReqID='.$value->labTestRequest_ID.'&TestID='.$value->ftest_ID->test_ID.'&PID='.$value->fpatient_ID->patientID, '<i class="text-primary"> Add Sample Details');
                                                                break;
                                                            case "Sample Collected":
                                                                $action = anchor('AddTestResults?ReqID='.$value->labTestRequest_ID.'&TestID='.$value->ftest_ID->test_ID.'&PID='.$value->fpatient_ID->patientID, '<i class="text-warning"> Add Results');
                                                                break;
                                                            case "Report Issued":
                                                                $action .= anchor('ReportView?ReqID='.$value->labTestRequest_ID.'&TestID='.$value->ftest_ID->test_ID.'&PID='.$value->fpatient_ID->patientID, '<i class="text-success"> View Report', array('target' => '_blank'));                            
                                                                $action .= " & ";
                                                                $action .= anchor('SpecimenInfo?ReqID='.$value->labTestRequest_ID.'&TestID='.$value->ftest_ID->test_ID.'&PID='.$value->fpatient_ID->patientID.'&status=complete', '<i class="text-success"> View Sample Details');
                                                                break;
                                                            default:
                                                                break;
                                                        }
                                                        ?>
                                                            <tr id="<?php echo $value->ftest_ID->test_ID; ?>">
                                                            <td><?php echo $action;?></td>
                                                            <td><?php echo $value->labTestRequest_ID; ?></td>
                                                            <td><?php echo $value->ftest_ID->test_IDName.$value->ftest_ID->test_ID; ?></td>
                                                            <td><?php echo $value->fpatient_ID->patientID; ?></td>
                                                            <td><?php echo $value->flab_ID->lab_Name; ?></td>
                                                            <td><?php echo $value->comment; ?></td>
                                                            <td><?php echo $value->priority; ?></td>
                                                            <td><?php echo $value->status; ?></td>
                                                            <td><?php echo $value->test_RequestDate; ?></td>
                                                            <td><?php echo $value->test_DueDate; ?></td>
                                                            <td><?php echo $value->ftest_RequestPerson->userName; ?></td>
                                                            
                                                        </tr>

                                                    <?php
                                                    }

                                                    ?>
                                                    </tbody>


                                                </table>
                                            </div>
                                            <div class="tab-pane" id="OPD">
                                                <table id="tbl2" class="display" cellspacing="0">

                                                    <thead>
                                                    <tr >
                                                        <th>/</th>
                                                        <th>Request ID</th>
                                                        <th>Test ID</th>
                                                        <th>Patient ID</th>
                                                        <th>Lab Name</th>
                                                        <th>Comment</th>
                                                        <th>Priority</th>
                                                        <th>Status</th>
                                                        <th>Req.Date</th>
                                                        <th>Due Date</th>
                                                        <th>Req.person</th>
                                                       
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr >
                                                        <th>/</th>
                                                        <th>Request ID</th>
                                                        <th>Test ID</th>
                                                        <th>Patient ID</th>
                                                        <th>Lab Name</th>
                                                        <th>Comment</th>
                                                        <th>Priority</th>
                                                        <th>Status</th>
                                                        <th>Req.Date</th>
                                                        <th>Due Date</th>
                                                        <th>Req.person</th>
                                                       
                                                    </tr>

                                                    </tfoot>



                                                    <tbody>
                                                    <?php
                                                    date_default_timezone_set("Asia/Colombo");
                                                    foreach ($Requests as $value) {
                                                        $action = "";
                                                        switch ($value->status) {
                                                            case "Sample Required":
                                                                $action = anchor('SpecimenInfo?ReqID='.$value->labTestRequest_ID.'&TestID='.$value->ftest_ID->test_ID.'&PID='.$value->fpatient_ID->patientID, '<i class="text-primary"> Add Sample Details');
                                                                break;
                                                            case "Sample Collected":
                                                                $action = anchor('AddTestResults?ReqID='.$value->labTestRequest_ID.'&TestID='.$value->ftest_ID->test_ID.'&PID='.$value->fpatient_ID->patientID, '<i class="text-warning"> Add Results');
                                                                break;
                                                            case "Report Issued":
                                                                $action .= anchor('ReportView?ReqID='.$value->labTestRequest_ID.'&TestID='.$value->ftest_ID->test_ID.'&PID='.$value->fpatient_ID->patientID, '<i class="text-success"> View Report', array('target' => '_blank'));                            
                                                                $action .= " & ";
                                                                $action .= anchor('SpecimenInfo?ReqID='.$value->labTestRequest_ID.'&TestID='.$value->ftest_ID->test_ID.'&PID='.$value->fpatient_ID->patientID.'&status=complete', '<i class="text-success"> View Sample Details');
                                                                break;
                                                            default:
                                                                break;
                                                        }
                                                        ?>
                                                        <tr id="<?php echo $value->ftest_ID->test_ID; ?>">
                                                            <td><?php echo $action;?></td>
                                                            <td><?php echo $value->labTestRequest_ID; ?></td>
                                                            <td><?php echo $value->ftest_ID->test_IDName.$value->ftest_ID->test_ID; ?></td>
                                                            <td><?php echo $value->fpatient_ID->patientID; ?></td>
                                                            <td><?php echo $value->flab_ID->lab_Name; ?></td>
                                                            <td><?php echo $value->comment; ?></td>
                                                            <td><?php echo $value->priority; ?></td>
                                                            <td><?php echo $value->status; ?></td>
                                                            <td><?php echo date("Y-m-d ", $value->test_RequestDate/1000); ?></td>
                                                            <td><?php echo date("Y-m-d ", $value->test_DueDate/1000); ?></td>
                                                            <td><?php echo $value->ftest_RequestPerson->userName; ?></td>
                                                           
                                                        </tr>

                                                    <?php
                                                    }

                                                    ?>
                                                    </tbody>


                                                </table>
                                            </div>
                                            <div class="tab-pane" id="Clinic">
                                                <table id="tbl3" class="display" cellspacing="0">

                                                    <thead>
                                                    <tr >
                                                        <th>/</th>
                                                        <th>Request ID</th>
                                                        <th>Test ID</th>
                                                        <th>Patient ID</th>
                                                        <th>Lab Name</th>
                                                        <th>Comment</th>
                                                        <th>Priority</th>
                                                        <th>Status</th>
                                                        <th>Req.Date</th>
                                                        <th>Due Date</th>
                                                        <th>Req.person</th>
                                                       
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr >
                                                        <th>/</th>
                                                        <th>Request ID</th>
                                                        <th>Test ID</th>
                                                        <th>Patient ID</th>
                                                        <th>Lab Name</th>
                                                        <th>Comment</th>
                                                        <th>Priority</th>
                                                        <th>Status</th>
                                                        <th>Req.Date</th>
                                                        <th>Due Date</th>
                                                        <th>Req.person</th>
                                                       
                                                    </tr>

                                                    </tfoot>



                                                    <tbody>
                                                    <?php
                                                    date_default_timezone_set("Asia/Colombo");
                                                    foreach ($Requests as $value) {
                                                        $action = "";
                                                        switch ($value->status) {
                                                            case "Sample Required":
                                                                $action = anchor('SpecimenInfo?ReqID='.$value->labTestRequest_ID.'&TestID='.$value->ftest_ID->test_ID.'&PID='.$value->fpatient_ID->patientID, '<i class="text-primary"> Add Sample Details');
                                                                break;
                                                            case "Sample Collected":
                                                                $action = anchor('AddTestResults?ReqID='.$value->labTestRequest_ID.'&TestID='.$value->ftest_ID->test_ID.'&PID='.$value->fpatient_ID->patientID, '<i class="text-warning"> Add Results');
                                                                break;
                                                            case "Report Issued":
                                                                $action .= anchor('ReportView?ReqID='.$value->labTestRequest_ID.'&TestID='.$value->ftest_ID->test_ID.'&PID='.$value->fpatient_ID->patientID, '<i class="text-success"> View Report', array('target' => '_blank'));                            
                                                                $action .= " & ";
                                                                $action .= anchor('SpecimenInfo?ReqID='.$value->labTestRequest_ID.'&TestID='.$value->ftest_ID->test_ID.'&PID='.$value->fpatient_ID->patientID.'&status=complete', '<i class="text-success"> View Sample Details');
                                                                break;
                                                            default:
                                                                break;
                                                        }
                                                        ?>
                                                        <tr id="<?php echo $value->ftest_ID->test_ID; ?>">
                                                            <td><?php echo $action;?></td>
                                                            <td><?php echo $value->labTestRequest_ID; ?></td>
                                                            <td><?php echo $value->ftest_ID->test_IDName.$value->ftest_ID->test_ID; ?></td>
                                                            <td><?php echo $value->fpatient_ID->patientID; ?></td>
                                                            <td><?php echo $value->flab_ID->lab_Name; ?></td>
                                                            <td><?php echo $value->comment; ?></td>
                                                            <td><?php echo $value->priority; ?></td>
                                                            <td><?php echo $value->status; ?></td>
                                                            <td><?php echo date("Y-m-d ", $value->test_RequestDate/1000); ?></td>
                                                            <td><?php echo date("Y-m-d ", $value->test_DueDate/1000); ?></td>
                                                            <td><?php echo $value->ftest_RequestPerson->userName; ?></td>
                                                           
                                                        </tr>

                                                    <?php
                                                    }

                                                    ?>
                                                    </tbody>


                                                </table>
                                            </div>
                                            <div class="tab-pane" id="Pcu">
                                                <table id="tbl4" class="display" cellspacing="0">

                                                    <thead>
                                                    <tr >
                                                        <th>/</th>
                                                        <th>Request ID</th>
                                                        <th>Test ID</th>
                                                        <th>Patient ID</th>
                                                        <th>Lab Name</th>
                                                        <th>Comment</th>
                                                        <th>Priority</th>
                                                        <th>Status</th>
                                                        <th>Req.Date</th>
                                                        <th>Due Date</th>
                                                        <th>Req.person</th>
                                                      
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr >
                                                        <th>/</th>
                                                        <th>Request ID</th>
                                                        <th>Test ID</th>
                                                        <th>Patient ID</th>
                                                        <th>Lab Name</th>
                                                        <th>Comment</th>
                                                        <th>Priority</th>
                                                        <th>Status</th>
                                                        <th>Req.Date</th>
                                                        <th>Due Date</th>
                                                        <th>Req.person</th>
                                                      
                                                    </tr>

                                                    </tfoot>



                                                    <tbody>
                                                    <?php
                                                    date_default_timezone_set("Asia/Colombo");
                                                    foreach ($Requests as $value) {
                                                        $action = "";
                                                        switch ($value->status) {
                                                            case "Sample Required":
                                                                $action = anchor('SpecimenInfo?ReqID='.$value->labTestRequest_ID.'&TestID='.$value->ftest_ID->test_ID.'&PID='.$value->fpatient_ID->patientID, '<i class="text-primary"> Add Sample Details');
                                                                break;
                                                            case "Sample Collected":
                                                                $action = anchor('AddTestResults?ReqID='.$value->labTestRequest_ID.'&TestID='.$value->ftest_ID->test_ID.'&PID='.$value->fpatient_ID->patientID, '<i class="text-warning"> Add Results');
                                                                break;
                                                            case "Report Issued":
                                                                $action .= anchor('ReportView?ReqID='.$value->labTestRequest_ID.'&TestID='.$value->ftest_ID->test_ID.'&PID='.$value->fpatient_ID->patientID, '<i class="text-success"> View Report', array('target' => '_blank'));                            
                                                                $action .= " & ";
                                                                $action .= anchor('SpecimenInfo?ReqID='.$value->labTestRequest_ID.'&TestID='.$value->ftest_ID->test_ID.'&PID='.$value->fpatient_ID->patientID.'&status=complete', '<i class="text-success"> View Sample Details');
                                                                break;
                                                            default:
                                                                break;
                                                        }
                                                        ?>
                                                        <tr id="<?php echo $value->ftest_ID->test_ID; ?>">
                                                            <td><?php echo $action;?></td>
                                                            <td><?php echo $value->labTestRequest_ID; ?></td>
                                                            <td><?php echo $value->ftest_ID->test_IDName.$value->ftest_ID->test_ID; ?></td>
                                                            <td><?php echo $value->fpatient_ID->patientID; ?></td>
                                                            <td><?php echo $value->flab_ID->lab_Name; ?></td>
                                                            <td><?php echo $value->comment; ?></td>
                                                            <td><?php echo $value->priority; ?></td>
                                                            <td><?php echo $value->status; ?></td>
                                                            <td><?php echo date("Y-m-d ", $value->test_RequestDate/1000); ?></td>
                                                            <td><?php echo date("Y-m-d ", $value->test_DueDate/1000); ?></td>
                                                            <td><?php echo $value->ftest_RequestPerson->userName; ?></td>
                                                          
                                                        </tr>

                                                    <?php
                                                    }

                                                    ?>
                                                    </tbody>


                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    
                    </div>
                    </div> <!--Main panel -->
                </div>
            </div>
        </div>
        </div>
    </div>
</body>
</html>












