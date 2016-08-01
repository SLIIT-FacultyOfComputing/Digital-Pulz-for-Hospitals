<script type="text/javascript">
	document.getElementById('patient_info_header').style.display = "";

	var cusid_ele = document.getElementsByClassName('patient_info');  
	for (var i = 0; i < cusid_ele.length; ++i) {
	       document.getElementsByClassName('patient_info')[i].style.display = "";
	}
	document.getElementsByClassName('patient_info')[0].className = 'patient_info active';
</script>

<section class="content-header">
	<h1>
		Info <small> Patient Information</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#"><i class="fa fa-stack-exchange"></i> Information</a></li>
		<li class="active">Patient Information
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
	</ol>
</section>
</br>

<!-- Main content -->
<section class="content">

	<div class="row">
		<div class="col-md-6 col-md-offset-3">

			<div class="container">

				<div class="row">
					<div class="col-md-8 col-lg-6">

						<!-- /.box-header -->
						<div class="well profile">
							<div class="box-header with-border">
								<i class="fa  fa-wheelchair"></i>
								<h3 class="box-title">Patient Profile</h3>
								<a
									href="<?php echo base_url() . 'index.php/patient_c/edit/' . $pprofile->patientID; ?>"
									class="btn btn-app pull-right"> <i class="fa fa-edit"></i> Edit
								</a>
							</div>
							<hr>
							<div class="col-sm-12">
								<div class="col-xs-12 col-sm-8">
									<h2><?php
									if ($pprofile->patientTitle == "Baby")
										echo "$pprofile->patientTitle $pprofile->patientFullName";
									else
										echo "$pprofile->patientTitle $pprofile->patientFullName";
									?> </h2>
									<table>
										<tr>
											<td style="padding-right: 40px"><strong>HIN</strong></td>
											<td style="padding-left: 10px">
                    <?php echo "$pprofile->patientHIN"; ?></td>
										</tr>

										<tr>
											<td><strong>Gender</strong></td>
											<td style="padding-left: 10px">
                    <?php echo "$pprofile->patientGender"; ?></td>
										</tr>
										<tr>
											<td style="width: 90px"><strong>Civil Status</strong></td>
											<td style="padding-left: 10px">
				<?php echo "$pprofile->patientCivilStatus";?></td>

										</tr>
										<tr>
											<td style="width: 50px"><strong>Date of Birth</strong></td>
											<td style="padding-left: 10px">   
				<?php echo date("d-m-Y",$pprofile->patientDateOfBirth/1000);  ?></td>
										</tr>

									</table>
								</div>
							</div>
							<div class="row">
								<div class="pull-right col-xs-12 col-sm-4 emphasis"></div>
							</div>
						</div>
					</div>
				</div>
				<!-- /.box -->
			</div>
			<!-- ./col -->
		</div>

	</div>
	<!-- ./row -->


	<div class="row">
		<div class='box-body'>
			<!-- Custom Tabs -->

			<!-- /.box-header -->
			<div class="nav-tabs-custom">
				<div class="box-header with-border">
					<i class="fa fa-book"></i>
					<h3 class="box-title">Patient Information</h3>
				</div>
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab_1" data-toggle="tab">Visits</a></li>
					<li><a href="#tab_2" data-toggle="tab">Previous Prescriptions</a></li>
					<li><a href="#tab_3" data-toggle="tab">Lab Orders</a></li>
					<li><a href="#tab_4" data-toggle="tab">Examinations</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="tab_1">
						<div class="box">
							<div class="box-body">
								<table class="table table-bordered table-striped table-hover"
									id="tabletestp_1">
									<br>
									<thead>
										<tr>
											<th>Visit Type</th>
											<th>Visit No</th>
											<th>Date and Time</th>
											<th>Complaint</th>
											<th>Remarks</th>
											<th></th>
										</tr>

									</thead>
									<tbody>
										
									    <tr>
										<td><?php echo $visit[0]->visitType; ?></td>
											<td> <?php echo $visit[0]->visitID; ?> </td>

											<td> <?php echo date("Y-m-d h:i:s A", $visit[0]->visitDate / 1000); ?> </td>

											<td><?php echo $visit[0]->visitComplaint; ?> </td>
											<td><?php echo $visit[0]->visitRemarks; ?> </td>
										
										<td><a style="color: white"
                                                  button type="submit" class="btn btn-primary"
													
														href="<?php echo base_url() . 'index.php/visit_c/edit/' . $pprofile->patientID . "/" . $visit[0]->visitID; ?>">Edit
													</a>
												</button></td>
                            
										
										</tr>
									</tbody>

								</table>
							</div>
						</div>

					</div>
					<!-- /.tab-pane -->
					<div class="tab-pane" id="tab_2">


						<div class="box">
							<div class="box-body">
							
							<?php
							if (sizeof ( $presitems ) == NULL) {
							} else {
								?>
								<button type="submit" class="btn btn-primary pull-right ">
									<a
										href="<?php echo base_url() . "index.php/prescription_c/edit/" . $pprofile->patientID . "/" . $visit[0]->prescriptions[0]->prescriptionID . "/" . $visit[0]->visitID . "/" . TRUE; ?>">Edit</a>
								</button>
                        <?php } ?>
					
						<br>
								<table class="table table-bordered table-striped table-hover"
									id="tabletestp_2">
									<br>
									<thead>
										<tr>
											<th width="25px">#</th>
											<th>Time</th>
											<th>Drug</th>
											<th>Dosage</th>
											<th>Frequency</th>
											<th>Period</th>
											<th>Quantity</th>
											<th></th>
										</tr>

									</thead>
									<tbody>
									     <?php $i=0; if ($presitems != NULL) foreach ($presitems as $item) { ?>
                                                <tr>
											<td><?php echo ++$i; ?></td>

											<td><?php echo date('h:i:s A', $visit[0]->prescriptions[0]->prescriptionDate / 1000); ?></td>
											<td><?php echo $item['drugID']['dName']; ?></td>
											<td><?php echo $item['prescribeItemsDosage'] ?></td>
											<td><?php echo $item['prescribeItemsFrequency']; ?></td>
											<td><?php echo $item['prescribeItemsPeriod']; ?></td>
											<td><?php echo $item['prescribeItemsQuantity']; ?></td>
											<td><span class="label"><?php
																if ($visit [0]->prescriptions [0]->prescriptionStatus == '0')
																	echo "Not Issued";
																else
																	echo "Issued";
																?> </span></td>
										</tr>
                                            <?php } ?>
    								</tbody>

								</table>
							</div>
						</div>


					</div>

					<div class="tab-pane" id="tab_3">
						<div class="box">

							<div class="box-body">
								<table class="table table-bordered table-striped table-hover"
									id="tabletestp_2">
									<br>
									<thead>
										<tr>
											<th width="25px">#</th>
											<th>Name</th>
											<th>Date</th>
											<th>Status</th>
										</tr>

									</thead>
									<tbody>
									     <?php $i=0; if ($laborders != NULL) foreach ($laborders as $row) { ?>
                                                <tr>
											<td><?php echo ++$i; ?></td>

											<td id="tddate"><?php echo date('Y-m-d h:i:s A', $row->orderCreateDate / 1000); ?></td>
											<td id="tdtest"><?php echo $row->orderTestID->testName; ?></td>
											<td id="tdstatus"><?php echo $row->orderStatus; ?></td>
										</tr>
                                            <?php } ?>
    								</tbody>

								</table>
							</div>
						</div>
					</div>

					<div class="tab-pane" id="tab_4">
					<div class="box">
							<div class="box-body">
								<table class="table table-bordered table-striped table-hover"
									id="tabletestp_4">
									<br>
									<thead>
										<tr>
											<th width="25px">#</th>
											<th>Date</th>
											<th>Weight ( kg )</th>
											<th>Height ( cm )</th>
											<th>SysBp</th>
											<th>DiastBp</th>
											<th>Temperature ( &#8457 )</th>
											<th></th>
										</tr>

									</thead>
									<tbody>
									     <?php $i=0; if ($exams != NULL) foreach ($exams as $row) { ?>
                                                <tr>
											<td><?php echo ++$i; ?></td>

											<td><?php echo date('Y-m-d', $row['examDate'] / 1000); ?> </td>

											<td><?php echo $row['examWeight']; ?></td>
											<td><?php echo $row['examHeight']; ?></td>
											<td><?php echo $row['examSysBP']; ?></td>
											<td><?php echo $row['examDisatBP']; ?></td>
											<td><?php echo $row['examTemp']; ?></td>

											<td><button type="submit" class="btn btn-primary">
													<a style="color: white"
														href="#">View</a>
												</button></td>
										</tr>
                                            <?php } ?>
    								</tbody>


								</table>
							</div>
						</div>
					</div>

				</div>
				<!-- nav-tabs-custom -->
			</div>
			<!-- /.col -->
		</div>
	</div>

</section>

