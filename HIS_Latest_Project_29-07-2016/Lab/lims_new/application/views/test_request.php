<script>

$(document).ready( function () {
	
    $('#tbl_1').DataTable({
		"dom": 'T<"clear">lfrtip'
	});
} );

$(document).ready( function () {
    $('#tbl_2').DataTable({
		"dom": 'T<"clear">lfrtip'
	});
} );

$(document).ready( function () {
    $('#tbl_3').DataTable({
		"dom": 'T<"clear">lfrtip'
	});
} );

$(document).ready( function () {
    $('#tbl_4').DataTable({
		"dom": 'T<"clear">lfrtip'
	});
} );

</script>

<div class="col-md-12">
	<!-- general form elements -->
	<br>
	<div class="box box-primary">
		<div class="box-header">
		</div><!-- /.box-header -->
	<!-- Custom Tabs -->
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
		  <li class="active"><a href="#tab_3" data-toggle="tab">OPD</a></li>
		  <li><a href="#tab_1" data-toggle="">Inward</a></li>
          <li><a href="#tab_2" data-toggle="">PCU</a></li>
          <li><a href="#tab_4" data-toggle="">Clinic</a></li>
		</ul>

		<div class="tab-content">
			
			<!-- OPD tab -->
			<div class="tab-pane active" id="tab_3">
		      <table class="table table-bordered table-striped dataTable" id="tbl_3">
				<thead>
					<tr>

					    <th>Action</th>
						<th>Priority</th>
						<th>Status</th>
						<th>Request ID</th>
						<th>Patient's HIN</th>
						<th>Test Name</th>
						<th>Req.Date</th>
						<th>Due Date</th>
						<th>Req.person</th>
					    <th>Comment</th>
					</tr>
					</thead>
					<tbody>
					<?php

					date_default_timezone_set("Asia/Colombo");

				    if($Requests != null){
					foreach ($Requests as $value) {
					  if($value[9]=="OPD")
					  {
						$action = "";
						switch ($value[1]) {
							case "Sample Required":
								$action = anchor(base_url().'specimen_info/index/ReqID/'.$value[2].'/TestID/'.$value[10].'/PID/'.$value[11].'/HIN/'.$value[3], '<i class="text-primary"> Add Sample Details');
								break;
							case "Sample Collected":
								$action = anchor(base_url().'test_results/index/ReqID/'.$value[2].'/TestID/'.$value[10].'/PID/'.$value[11].'/HIN/'.$value[3], '<i class="text-warning"> Add Results');
								break;
							case "Report Issued":
								$action .= anchor(base_url().'report_view/index/ReqID/'.$value[2].'/TestID/'.$value[10].'/PID/'.$value[11].'/HIN/'.$value[3], '<i class="text-success"> View Report', array('target' => '_blank'));                            
								$action .=  '<br/><br/>';
								$action .= anchor(base_url().'specimen_info/index/ReqID/'.$value[2].'/TestID/'.$value[10].'/PID/'.$value[11].'/status/complete'.'/HIN/'.$value[3], '<i class="text-muted"> View Sample Details');
								break;
							default:
								break;
						}
						?>
						<tr id="<?php echo $value[10] ?>">
							<td><?php echo $action;?></td>
							<td><?php echo $value[0]; ?></td>
							<td><?php echo $value[1]; ?></td>
							<td><?php echo $value[2]; ?></td>
							<td><?php echo $value[3]; ?></td>
							<td><?php echo $value[4]; ?></td>
							<td><?php echo $value[5]; ?></td>
                            <td><?php echo $value[6]; ?></td>
							<td><?php echo $value[7]; ?></td>
							<td><?php echo $value[8]; ?></td>
						</tr>

					<?php
					}
				}
			}
					?>
					</tbody>
				</table>
			</div>

		<!-- Inward tab -->
			<div class="tab-pane" id="tab_1">
              <table class="table table-bordered table-striped dataTable" id="tbl_1">
					
					<thead>
					<tr>
						<th>Action</th>
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
					<tbody>
					<?php
					date_default_timezone_set("Asia/Colombo");
					foreach ($Requests as $value) {
					  if($value->flab_ID->lab_Name=="Inward")
					  {
						$action = "";
						switch ($value->status) {
							case "Sample Required":
								$action = anchor(base_url().'specimen_info/index/ReqID/'.$value->labTestRequest_ID.'/TestID/'.$value->ftest_ID->test_ID.'/PID/'.$value->fpatient_ID->patientID, '<i class="text-primary"> Add Sample Details');
								break;
							case "Sample Collected":
								$action = anchor(base_url().'test_results/index/ReqID/'.$value->labTestRequest_ID.'/TestID/'.$value->ftest_ID->test_ID.'/PID/'.$value->fpatient_ID->patientID, '<i class="text-warning"> Add Results');
								break;
							case "Report Issued":
								$action .= anchor(base_url().'report_view/index/ReqID/'.$value->labTestRequest_ID.'/TestID/'.$value->ftest_ID->test_ID.'/PID/'.$value->fpatient_ID->patientID, '<i class="text-success"> View Report', array('target' => '_blank'));                            
								$action .= " & ";
								$action .= anchor(base_url().'specimen_info/index/ReqID/'.$value->labTestRequest_ID.'/TestID/'.$value->ftest_ID->test_ID.'/PID/'.$value->fpatient_ID->patientID.'/status/complete', '<i class="text-success"> View Sample Details');
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
				}
					?>
					</tbody>
			 </table>
			</div><!-- /.tab-pane -->

		<!-- PCU tab -->
			<div class="tab-pane" id="tab_2">
				<table class="table table-bordered table-striped dataTable" id="tbl_2">
					
				<thead>
					<tr>
						<th>Action</th>
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
					<tbody>
					<?php
					date_default_timezone_set("Asia/Colombo");

						
					foreach ($Requests as $value) {
					  if($value->flab_ID->lab_Name=="PCU")
					  {
						$action = "";
						switch ($value->status) {
							case "Sample Required":
								$action = anchor(base_url().'specimen_info/index/ReqID/'.$value->labTestRequest_ID.'/TestID/'.$value->ftest_ID->test_ID.'/PID/'.$value->fpatient_ID->patientID, '<i class="text-primary"> Add Sample Details');
								break;
							case "Sample Collected":
								$action = anchor(base_url().'test_results/index/ReqID/'.$value->labTestRequest_ID.'/TestID/'.$value->ftest_ID->test_ID.'/PID/'.$value->fpatient_ID->patientID, '<i class="text-warning"> Add Results');
								break;
							case "Report Issued":
								$action .= anchor(base_url().'report_view/index/ReqID/'.$value->labTestRequest_ID.'/TestID/'.$value->ftest_ID->test_ID.'/PID/'.$value->fpatient_ID->patientID, '<i class="text-success"> View Report', array('target' => '_blank'));                             
								$action .= " & ";
								$action .= anchor(base_url().'specimen_info/index/ReqID/'.$value->labTestRequest_ID.'/TestID/'.$value->ftest_ID->test_ID.'/PID/'.$value->fpatient_ID->patientID.'/status/complete', '<i class="text-success"> View Sample Details');
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
				}
					?>

				</tbody>
				</table>
			</div><!-- /.tab-pane -->

		<!-- Clinic tab -->
			<div class="tab-pane" id="tab_4">
				<table class="table table-bordered table-striped dataTable" id="tbl_4">
				<thead>
					<tr>
						<th>Action</th>
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
					<tbody>
					<?php
					date_default_timezone_set("Asia/Colombo");

						
					foreach ($Requests as $value) {
					  if($value->flab_ID->lab_Name=="Clinic")
					  {
						$action = "";
						switch ($value->status) {
							case "Sample Required":
								$action = anchor(base_url().'specimen_info/index/ReqID/'.$value->labTestRequest_ID.'/TestID/'.$value->ftest_ID->test_ID.'/PID/'.$value->fpatient_ID->patientID, '<i class="text-primary"> Add Sample Details');
								break;
							case "Sample Collected":
								$action = anchor(base_url().'test_results/index/ReqID/'.$value->labTestRequest_ID.'/TestID/'.$value->ftest_ID->test_ID.'/PID/'.$value->fpatient_ID->patientID, '<i class="text-warning"> Add Results');
								break;
							case "Report Issued":
								$action .= anchor(base_url().'report_view/index/ReqID/'.$value->labTestRequest_ID.'/TestID/'.$value->ftest_ID->test_ID.'/PID/'.$value->fpatient_ID->patientID, '<i class="text-success"> View Report', array('target' => '_blank'));                            
								$action .= " & ";
								$action .= anchor(base_url().'specimen_info/index/ReqID/'.$value->labTestRequest_ID.'/TestID/'.$value->ftest_ID->test_ID.'/PID/'.$value->fpatient_ID->patientID.'/status/complete', '<i class="text-success"> View Sample Details');
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
				}
					?>

					</tbody>
				</table>
			</div>

		</div><!-- /.tab-content -->

	</div><!-- nav-tabs-custom -->
</div>
</div>
