<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<script type="text/javascript">
	document.getElementById('patient_overview_header').style.display = "";

	var cusid_ele = document.getElementsByClassName('patient_overview');
	for (var i = 0; i < cusid_ele.length; ++i) {
		document.getElementsByClassName('patient_overview')[i].style.display = "";
	}
	document.getElementsByClassName('patient_overview')[0].className = 'patient_overview active';



</script>

<script type="text/javascript">

                       
						function disabledpop()
						{
							document.getElementById("visit").style.visibility = "hidden";
							
						}
</script>

<script type="text/javascript">

                       
						function disabledpopallergy()
						{
							document.getElementById("allergy").style.visibility = "hidden";
							
						}
</script>
<script type="text/javascript">

                       
						function disabledex()
						{
							document.getElementById("ex").style.visibility = "hidden";
							
						}
</script>
<script type="text/javascript">

                       
						function disablednote()
						{
							document.getElementById("note").style.visibility = "hidden";
							
						}
</script>
<script type="text/javascript">

                       
						function disabledtodo()
						{
							document.getElementById("todo").style.visibility = "hidden";
							
						}
</script>
<script type="text/javascript">

                       
						function disabledlab()
						{
							document.getElementById("lab").style.visibility = "hidden";
							
						}
</script>
<script type="text/javascript">

                       
						function disabledattach()
						{
							document.getElementById("attach").style.visibility = "hidden";
							
						}
</script>
<script type="text/javascript">

                       
						function disabledqu()
						{
							document.getElementById("qu").style.visibility = "hidden";
							
						}
</script>
<script type="text/javascript">

                       
						function disabledaln()
						{
							document.getElementById("allergyn").style.visibility = "hidden";
							
						}
</script>



<style type="text/css">
	.badge-notify{
   background:red;
   position:relative;
   top: -15px;
   left: 15px;
  }
</style>	
<section class="content">
	<div class = "modal-example">
 
 <div class = "row" >

  <div class="col-md-12" style = "margin-top:10px ; margin-left:-20px">


<br/>


<div class="panel panel-info" style="margin-left: 40px; "><!-- starting point of panel-->
            <div class="panel-heading"><!-- starting point of panel head-->
            </div><!-- Ending point of panel head-->
    <div class="panel-body"><!-- starting point of body-->

<!-- Main content -->


	<div class="row">
		<div class="col-md-6">

			<div class="container">

				<div class="row">
					<div class="col-lg-11" style="width:950px ; margin-right:5px">
						<div class="well well-sm">
							<div class="row">
							<div class="col-md-3">
								<div class="col-sm-10 ">
									<img class="img-rounded img-responsive"
									src="<?php
									if ((strpos ( $pprofile->patientPhoto, 'null' ) !== FALSE) | $pprofile->patientPhoto == "" | $pprofile->patientPhoto == null) {
												// echo base_url() . '/assets/ico/proimage.jpg';
										{
											if ($pprofile->patientGender == 'Male')
												echo base_url () . "/assets/ico/proimage.jpg";
											else if ($pprofile->patientGender == 'Female')
												echo base_url () . "/assets/ico/proimagefemale.png";
											else {
												echo base_url () . "/assets/ico/proimage.jpg";
											}
										}
									} else
									echo base_url () . '/uploads/patient_photos/' . $pprofile->patientPhoto;
									?>" />

								</div>
								</div>
								<div class="col-sm-6 col-md-5">
									
								<h4><b><?php
									if ($pprofile->patientTitle == "Baby")
										echo "$pprofile->patientTitle $pprofile->patientFullName";
									else
										echo "$pprofile->patientTitle $pprofile->patientFullName";
									?> </b></h4>

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
											<?php 
											date_default_timezone_set('Asia/Colombo');
											echo date("d-m-Y",$pprofile->patientDateOfBirth/1000);  ?></td>
										</tr>
										<tr>
											<td style="width: 50px"><strong>Age</strong></td>
											<td style="padding-left: 10px">~
											<?php 
											date_default_timezone_set('Asia/Colombo');
											echo (date("Y") - date("Y",$pprofile->patientDateOfBirth/1000));  ?>Yrs <?php 
											date_default_timezone_set('Asia/Colombo');
											echo (date("m") - date("m",$pprofile->patientDateOfBirth/1000));  ?>Mths <?php 
											date_default_timezone_set('Asia/Colombo');
											echo (date("d") - date("d",$pprofile->patientDateOfBirth/1000));  ?>Dys
											</td>
										</tr>
										<tr>
											<td><strong>Phone </strong></td>
											<td style="padding-left: 10px"> 
												<?php echo "$pprofile->patientTelephone";?></td>

										</tr>
										<tr>
											<td><strong>Address </strong></td>
											<td style="padding-left: 10px">
											<?php echo "$pprofile->patientAddress" ;?>
											</td>


										</tr>

															
									</table>
														<!-- Split button -->
														
													</div>
													<div class="col-md-4">

													<div class="btn-group pull-right">
										<a
										href="<?php echo base_url() . 'index.php/patient_c/edit/' . $pprofile->patientID; ?>"
										class="btn-xs btn-primary pull-right"> <i class="fa fa-edit"></i> Edit
									</a>
									<br>

								</div>
								<h4>
								<br>
										
									
								</h4>
													<table >

														<tr style="padding-top: 40px">
															<td><strong>Blood Group </strong></td>
															<td style="padding-left: 25px ">
																<font color="red">

																	<?php 
																try{
																if($pprofile->patientblood != null)
																{
																	
																echo "$pprofile->patientblood" ;
																
																} 
																else
																{
																	//echo "Not Calculated";
																	echo "<font color=\"red\">Not Availabe</font>";  
																}
															}
															catch(Exception $e)
															{
																
																echo "<font color=\"red\">Not Available</font>";  
															}

																; ?>

																
																</font>
															</td>

													</tr>
													<tr>
															<td><strong>BMI </strong></td>
															<td style="padding-left: 25px ">
															<font color="red">
																<?php 
																try{
																if($pprofilebmi['exams'] != null)
																{
																	
																echo $pprofilebmi['exams'][0]['exambmi'];
																
																} 
																else
																{
																	//echo "Not Calculated";
																	echo "<font color=\"red\">Not Calculated</font>";  
																}
															}
															catch(Exception $e)
															{
																
																echo "<font color=\"red\">Not Calculated</font>";  
															}

																; ?>
																</font>
															</td>


													</tr>
														<tr>
															<td><strong>Resent Allergies </strong></td>
															<td style="padding-left: 25px ">
																<?php sort($allergy); if ($allergy != NULL) foreach ($allergy as $row) { ?>	
																<?php echo $row['allergyName'].",";?>
																<?php } else echo "No Recent Allergies"; ?>
														</td>
													</tr>
													
													</table>
                                                    </div>
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

                        	<?php if ($this->session->userdata("userlevel") == 2) { ?>
                     			<div class="col-md-6">
							<div class="box box-solid box-default collapsed-box">
								<div class="box-header with-border">
									<h3 class="box-title">Allergies</h3>
									<div class="box-tools pull-right">
										<button class="btn btn-box-tool" onclick="disabledaln()" data-widget="collapse"><i class="fa fa-plus"></i></button>
									</div><!-- /.box-tools -->

									<?php $x= 0 ;?>
								<?php $l=0; rsort($allergy);  if ($allergy != NULL) foreach ($allergy as $row) { ?>
										
											<?php  ++$l; 


                                               $t = 0;

                                              
                                               if (date("Y-m-d") ==  date("Y-m-d", $row['allergyCreateDate'] / 1000)) 
                                               {
                                               	 $t++;
                                               	 $x = $x + $t;

                                               }
                                              
											?>

								
										<?php } ?>
										<?php if($x > 0) {?>
										<span class="badge badge-notify pull-right" id="allergyn" style="background:#2196F3"><?php echo  $x?></span>
                                        <?php } else { ?>
                                        <span class="badge badge-notify pull-right" id="allergyn" ></span>
										<?php } ?>


								</div><!-- /.box-header -->
								<div class="box-body">
									<table class="table table-bordered table-striped table-hover"
									id="tabletestp">
									<br>
									<thead>
										<tr>
											<th width="25px">#</th>
											<th>Allergy</th>
											<th>Status</th>
											<th>Remarks</th>
											
										</tr>

									</thead>
									<tbody>
										<?php $i=0; if ($allergy != NULL) foreach ($allergy as $row) { ?>
										<tr>
											<td><?php echo ++$i; ?></td>

											<td><?php echo $row['allergyName']; ?></td>
											<td><?php echo $row['allergyStatus']; ?></td>

											<td><?php echo $row['allergyRemarks']; ?></td>

											<!-- <td><button type="submit" class="btn-xs btn-primary">
												<a style="color: white"
												href="<?php echo base_url() . 'index.php/allergies_c/edit/' . $pprofile->patientID . "/" . $row['allergyID']; ?>">Edit</a>
											</button></td> -->
										</tr>
										<?php } ?>
									</tbody>

								</table>
							</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div><!-- /.col -->
<?php } ?>



						<!-- Message for last checkIN status  ************************************************************** -->
						<?php if ($checkoutlast != NULL) { ?>
						<div class="row">
							<div class='box-body'>
								<div id="w1" class="alert alert-danger" style='height: 55px; position: relative; left: 250px; top: 10px; width: 74%;'>
                                    The last patient<strong> is still in the queue </strong> &nbsp;
                                    <input type="button" value="CheckOut" onClick="window.location = '<?php echo "../../queue_c/remove/" . $checkoutlast; ?>'" class='btn' /></div>

							</div>
						</div>
					</div>
					<?php } ?>
					<!-- **************************************************************************************** -->
					<?php if ($this->session->userdata("userlevel") == 1) { ?>
					<div class="col-md-6">

                    
                    
						<div class="box box-solid box-default collapsed-box">
				            
							<div class="box-header with-border">
                                
								<h3 class="box-title">Visits</h3>

								<div class="box-tools pull-right">
  
									<button class="btn btn-box-tool" data-widget="collapse" onclick="disabledpop()" ><i class="fa fa-plus"></i></button>
									
								</div><!-- /.box-tools -->		
							<?php $x= 0 ;?>

								<?php $l=0; sort($visits); if ($visits != NULL) foreach ($visits as $row) { ?>
										
											<?php  ++$l; 


                                               $t = 0;
                                              
                                               if (date("Y-m-d") ==  date("Y-m-d", $row['visitDate'] / 1000)) 
                                               {
                                               	 $t++;
                                               	 $x=$x+$t;
                                               }
                                              
											?>

								
										<?php } ?>
										<?php if($x > 0) {?>
										<span class="badge badge-notify pull-right" id="visit" style="background:#2196F3"><?php echo  $x?></span>
                                        <?php } else { ?>
                                        <span class="badge badge-notify pull-right" id="visit" ></span>
										<?php } ?>

							</div><!-- /.box-header -->



							<div class="box-body">
								<table class="table table-bordered table-striped table-hover"
								id="tabletestp_1">
								<br>
								<thead>
									<tr>
										<th width="25px">#</th>
										<th>Date</th>
										<th>Complaint</th>
										<th>Remark</th>
										<th></th>
									</tr>

								</thead>
								<tbody>
								
									<?php $i=0; rsort($visits); if ($visits != NULL) foreach ($visits as $row) { ?>

									<tr>
										<td><?php echo ++$i; ?></td>


										<td><?php echo date("Y-m-d h:i:s A", $row['visitDate'] / 1000); ?></td>
										<td><?php echo $row['visitComplaint']; ?></td>
										<td><?php echo $row['visitRemarks']; ?></td>


										<td>
											<a style="color: white" button type="submit" class="btn btn-primary"
											   href="<?php echo base_url().'index.php/patient_visit_c/view1/'.$pprofile->patientID . "/" . $row['visitID'];?>">View
											</a>
										</button></td>
                                        
										
									</tr>
									<?php } ?>
								</tbody>

							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div><!-- /.col -->
                 
				
						<div class="col-md-6">
							<div class="box box-solid box-default collapsed-box">
								<div class="box-header with-border">
									<h3 class="box-title">Allergies</h3>
									<div class="box-tools pull-right">
										<button class="btn btn-box-tool" data-widget="collapse" onclick="disabledpopallergy()"><i class="fa fa-plus"></i></button>
									</div><!-- /.box-tools -->


								 <?php $x= 0 ;?>
								<?php $l=0; rsort($allergy);  if ($allergy != NULL) foreach ($allergy as $row) { ?>
										
											<?php  ++$l; 


                                               $t = 0;

                                              
                                               if (date("Y-m-d") ==  date("Y-m-d", $row['allergyCreateDate'] / 1000)) 
                                               {
                                               	 $t++;
                                               	 $x = $x + $t;

                                               }
                                              
											?>

								
										<?php } ?>
										<?php if($x > 0) {?>
										<span class="badge badge-notify pull-right" id="allergy" style="background:#2196F3"><?php echo  $x?></span>
                                        <?php } else { ?>
                                        <span class="badge badge-notify pull-right" id="allergy" ></span>
										<?php } ?>

									
								</div><!-- /.box-header -->
								<div class="box-body">
									<table class="table table-bordered table-striped table-hover"
									id="tabletestp">
									<br>
									<thead>
										<tr>
											<th width="25px">#</th>
											<th>Allergy</th>
											<th>Status</th>
											<th>Create Date</th>
											<th>Remarks</th>
											
										</tr>

									</thead>
									<tbody>

										<?php $r=0; if ($allergy != NULL) foreach ($allergy as $row) { ?>
										<tr>
											<td><?php echo ++$r; ?></td>

											<td><?php echo $row['allergyName']; ?></td>
											<td><?php echo $row['allergyStatus']; ?></td>
											
											<td><?php echo date('Y-m-d', $row['allergyCreateDate'] / 1000); ?> </td>

											<td><?php echo $row['allergyRemarks']; ?></td>

											

											<!-- <td><button type="submit" class="btn-xs btn-primary">
												<a style="color: white"
												href="<?php echo base_url() . 'index.php/allergies_c/edit/' . $pprofile->patientID . "/" . $row['allergyID']; ?>">Edit</a>
											</button></td> -->
										</tr>
										<?php } ?>
									</tbody>

								</table>
							</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div><!-- /.col -->

					<div class="col-md-6">
	<div class="box box-solid box-default collapsed-box">
		<div class="box-header with-border">
			<h3 class="box-title">Lab Orders</h3>
			<div class="box-tools pull-right">
				<button class="btn btn-box-tool" onclick="disabledlab()" data-widget="collapse"><i class="fa fa-plus"></i></button>
			</div><!-- /.box-tools -->
			

			 <?php $x= 0 ;?>
		<?php $l=0;  if ($labs != NULL) foreach ($labs as $row) { ?>
										
											<?php  ++$l; 


                                               $t = 0;

                                              
                                               if (date("Y-m-d") == ($row->test_RequestDate))
                                               {
                                               	 $t++;
                                               	 $x = $x + $t;
                                               }
                                              
											?>
	
									
								
										<?php } ?>
										<?php if($x > 0) {?>
										<span class="badge badge-notify pull-right" id="lab" style="background:#2196F3"><?php echo  $x?></span>
                                        <?php } else { ?>
                                        <span class="badge badge-notify pull-right" id="lab" ></span>
										<?php } ?>



		</div><!-- /.box-header -->
		

		<div class="box-body">
			<table class="table table-bordered table-striped table-hover"
			id="tabletestp_6">
			<br>
			<thead>
				<tr>
					<th width="25px">#</th>
					<th>Test Name</th>
					<th>Test Status</th>
					<th>Requested Date</th>
					<th></th>
				</tr>

			</thead>
			<tbody>
				<?php $i=0; if ($labs != NULL) foreach ($labs as $row) { ?>
				<tr>
					<td><?php echo ++$i; ?></td>

					<td ><?php echo $row->ftest_ID->test_Name ?></td>
					<td ><?php echo $row->status ?></td>
					<td ><?php echo $row->test_RequestDate ?></td>

					<td align='center'>
						<button type="submit" class="btn-xs btn-primary">
							<a style="color: white" href="#">Edit</a>
						</button>
					</td>
				</tr>
				<?php }  ?>
			</tbody>


		</table>
	</div><!-- /.box-body -->
</div><!-- /.box -->
</div><!-- /.col -->

	<div class="col-md-6">
		<div class="box box-solid box-default collapsed-box">
			<div class="box-header with-border">
				<h3 class="box-title">Examinations</h3>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" onclick="disabledex()" data-widget="collapse"><i class="fa fa-plus"></i></button>
				</div><!-- /.box-tools -->


									 <?php $x= 0 ;?>
											<?php $l=0; if ($exams != NULL) foreach ($exams as $row) { ?>
										
											<?php  ++$l; 


                                               $t = 0;

                                              
                                               if (date("Y-m-d") ==  date("Y-m-d", $row['examDate'] / 1000)) 
                                               {
                                               	 $t++;
                                               	 $x = $x + $t;
                                               }
                                              
											?>

								
										<?php } ?>
										<?php if($x > 0) {?>
										<span class="badge badge-notify pull-right" id="ex" style="background:#2196F3"><?php echo  $x?></span>
                                        <?php } else { ?>
                                        <span class="badge badge-notify pull-right" id="ex" ></span>
										<?php } ?>




				<!-- <span class="badge badge-notify pull-right" style="background:#2ECC40">1</span> -->
			</div><!-- /.box-header -->
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
						<!-- <th></th> -->
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

						<!--  <td><button type="submit" class="btn-xs btn-primary">
							<a style="color: white"
							href="<?php echo base_url() . 'index.php/exams_c/edit/' . $pprofile->patientID . "/" . $row['examID']; ?>">Edit</a>
						</button></td>  -->
					</tr>
					<?php } ?>
				</tbody>


			</table>
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</div><!-- /.col -->
					




				
<div class="col-md-6">
				<div class="box box-solid box-default collapsed-box">
					<div class="box-header with-border">
						<h3 class="box-title">Notes</h3>
						<div class="box-tools pull-right">
							<button class="btn btn-box-tool" onclick="disablednote()" data-widget="collapse"><i class="fa fa-plus"></i></button>
						</div><!-- /.box-tools -->

							
                        <?php $x= 0 ;?>
						<?php $l=0; if ($records != NULL) foreach ($records as $row) { ?>
										
											<?php  ++$l; 

                                               $t = 0;

                                               if (($row ['recordType'] == "0") && (date("Y-m-d") ==  date("Y-m-d", $row['recordCreateDate'] / 1000)))
                                               {
                                               	 $t++;
                                                 $x = $x + $t;
                                               }
                                            
											?>

										<?php } ?>
										<?php if($x > 0) {?>
										<span class="badge badge-notify pull-right" id="note" style="background:#2196F3"><?php echo  $x?></span>
                                        <?php } else { ?>
                                        <span class="badge badge-notify pull-right" id="note" ></span>
										<?php } ?>

					</div><!-- /.box-header -->
					<div class="box-body">
						<table class="table table-bordered table-striped table-hover"
						id="tabletestp_3">
						<br>
						<thead>
							<tr>
								<th width="25px">#</th>
								<th>Description</th>
								<th></th>
							</tr>

						</thead>
						<tbody>
							<?php

							$i = 0;
							foreach ( $records as $row ) {
								if ($row ['recordType'] == "0" & $row ['recordVisibility'] == "all") {
									?>
									<tr>

										<td width="25px"><?php echo ++$i; ?></td>
										<td style="white-space: normal"><?php echo $row['recordText']; ?>

											<br> <small style="color: #888888;"><i> <?php echo "Dr." . $row['recordCreateUser']['hrEmployee']['firstName'] . " " . $row['recordCreateUser']['hrEmployee']['lastName'] . " on " . date('Y-m-d', $row['recordCreateDate'] / 1000); ?> </i></small>
										</td>

										<td>
											<?php if ($row['recordCreateUser']['adminUserroles']['roleId'] == $_SESSION["user"]) { ?>
											<button type="submit"
											class="btn-xs btn-primary">
											<a style="color: white"
											href="<?php echo base_url() . 'index.php/history_c/edit/' . $pprofile->patientID . "/" . $row['patientRecordID']; ?>">Edit</a>
										</button>
										<?php } ?>
									</td>

								</tr>

								<?php
							}
						}
						
						?>					
					</tbody>

				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div><!-- /.col -->

	
<div class="col-md-6">
				<div class="box box-solid box-default collapsed-box">
					<div class="box-header with-border">
						<h3 class="box-title">To Do</h3>
						<div class="box-tools pull-right">
							<button class="btn btn-box-tool" onclick="disabledtodo()" data-widget="collapse"><i class="fa fa-plus"></i></button>
						</div><!-- /.box-tools -->



                        <?php $x= 0 ;?>
						<?php $l=0; if ($records != NULL) foreach ($records as $row) { ?>
										
											<?php  ++$l; 

                                               $t = 0;

                                               if (($row ['recordType'] == "1") && (date("Y-m-d") ==  date("Y-m-d", $row['recordCreateDate'] / 1000)))
                                               {
                                               	 $t++;
                                                 $x = $x + $t;
                                               }
                                            
											?>
	                       
									
                      
										<?php } ?>
										<?php if($x > 0) {?>
										<span class="badge badge-notify pull-right" id="todo" style="background:#2196F3"><?php echo  $x?></span>
                                        <?php } else { ?>
                                        <span class="badge badge-notify pull-right" id="todo" ></span>
										<?php } ?>

					</div><!-- /.box-header -->
					<div class="box-body">
						<table class="table table-bordered table-striped table-hover"
						id="tabletestp_3">
						<br>
						<thead>
							<tr>
								<th width="25px">#</th>
								<th>Description</th>
								<th></th>
							</tr>

						</thead>
						<tbody>
							<?php

							$i = 0;
							foreach ( $records as $row ) {
								if ($row ['recordType'] == "1" & $row ['recordVisibility'] == "all") {
									?>
									<tr>

										<td width="25px"><?php echo ++$i; ?></td>
										<td style="white-space: normal"><?php echo $row['recordText']; ?>

											<br> <small style="color: #888888;"><i> <?php echo "Dr." . $row['recordCreateUser']['hrEmployee']['firstName'] . " " . $row['recordCreateUser']['hrEmployee']['lastName'] . " on " . date('Y-m-d', $row['recordCreateDate'] / 1000); ?> </i></small>
										</td>

										<td>
											<?php if ($row['recordCreateUser']['adminUserroles']['roleId'] == $_SESSION["user"]) { ?>
											<button type="submit"
											class="btn-xs btn-primary">
											<a style="color: white"
											href="<?php echo base_url() . 'index.php/history_c/edit/' . $pprofile->patientID . "/" . $row['patientRecordID']; ?>">Edit</a>
										</button>
										<?php } ?>
									</td>

								</tr>

								<?php
							}
						}
						
						?>					
					</tbody>

				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div><!-- /.col -->



	<div class="col-md-6">
					<div class="box box-solid box-default collapsed-box">
						<div class="box-header with-border">
							<h3 class="box-title">Questionnaires</h3>
							<div class="box-tools pull-right">
								<button class="btn btn-box-tool" onclick="disabledqu()" data-widget="collapse"><i class="fa fa-plus"></i></button>
							</div><!-- /.box-tools -->


										<?php $x= 0 ;?>
						<?php $l=0; if ($answerSet != NULL) foreach ($answerSet as $row) { ?>
										
											<?php  ++$l; 

                                               $t = 0;

                                               if (date("Y-m-d") ==  date("Y-m-d", $row['answerSetCreateDate'] / 1000))
                                               {
                                               	 $t++;
                                                 $x = $x + $t;
                                               }
                                            
											?>
	                       
									
                      
										<?php } ?>
										<?php if($x > 0) {?>
										<span class="badge badge-notify pull-right" id="qu" style="background:#2196F3"><?php echo  $x?></span>
                                        <?php } else { ?>
                                        <span class="badge badge-notify pull-right" id="qu" ></span>
										<?php } ?>

							
						</div><!-- /.box-header -->
						<div class="box-body">

							<div class="box">
								<div class="box-body">
									<table class="table table-bordered table-striped table-hover"
									id="tabletestp_2">
									<br>
									<thead>
										<tr>
											<th width="25px">#</th>
											<th>Name</th>
											<th>Relate To</th>
											<th>Date</th>
											<th></th>
										</tr>

									</thead>
									<tbody>
										<?php $i=0; if ($answerSet != NULL) foreach ($answerSet as $row) { ?>
										<tr>
											<td><?php echo ++$i; ?></td>

											<td><?php echo $row['questionnaire']['questionnaireName']; ?></td>
											<td><?php echo $row['questionnaire']['questionnaireRelateTo']; ?></td>
											<td><?php echo date("Y-m-d", $row['answerSetCreateDate'] / 1000); ?> </td>
											<td><button type="submit" class="btn-xs btn-primary">
												<a style="color: white"
												href="<?php echo base_url() . 'index.php/questionnaire_c/view_ques_answer/' . $pprofile->patientID . "/" . $row['questionnaire']['questionnaireID'] . "/" . $row['answerSetId']; ?>">View</a>
											</button></td>
										</tr>
										<?php } ?>
									</tbody>

								</table>
							</div>
						</div>

					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!-- /.col -->



<div class="col-md-6">
	<div class="box box-solid box-default collapsed-box">
		<div class="box-header with-border">
			<h3 class="box-title">Attachments</h3>
			<div class="box-tools pull-right">
				<button class="btn btn-box-tool" onclick="disabledattach()" data-widget="collapse"><i class="fa fa-plus"></i></button>
			</div><!-- /.box-tools -->


			<?php $x= 0 ;?>
						<?php $l=0; rsort($attachment); if ($attachment != NULL) foreach ($attachment as $row) { ?>
										
											<?php  ++$l; 

                                               $t = 0;

                                               if (date("Y-m-d") ==  date("Y-m-d", $row['attachCreateDate'] / 1000))
                                               {
                                               	 $t++;
                                                 $x = $x + $t;
                                               }
                                            
											?>
	                       
									
                      
										<?php } ?>
										<?php if($x > 0) {?>
										<span class="badge badge-notify pull-right" id="attach" style="background:#2196F3"><?php echo  $x?></span>
                                        <?php } else { ?>
                                        <span class="badge badge-notify pull-right" id="attach" ></span>
										<?php } ?>

		</div><!-- /.box-header -->
		<div class="box-body">
			<table class="table table-bordered table-striped table-hover"
			id="tabletestp_4">
			<br>
			<thead>
				<tr>
					<th width="25px">#</th>
					<th>Date</th>
					<!-- <th>ID</th> -->
					<th>Name</th>
					<th>Active</th>
					<!-- <th></th> -->
				</tr>

			</thead>
			<tbody>
			 
				<?php $i=0; if ($attachment != NULL) foreach ($attachment as $row) { ?>
				<tr>
					<td><?php echo ++$i; ?></td>

					<td><?php echo date('Y-m-d', $row['attachCreateDate'] / 1000); ?> </td>

					<!-- <td><?php echo $row['attachID']; ?></td> -->
					<td><?php echo $row['attachName']; ?></td>
					<td><?php  
                         if( $row['attachActive'] == 1)
                         	echo "Active";
                         else
                         	echo "Inactive";
					     ?></td>

					<!-- <td><button type="submit" class="btn-xs btn-primary">
						<a style="color: white"
						href="<?php echo base_url() . 'index.php/exams_c/edit/' . $pprofile->patientID . "/" . $row['examID']; ?>">Edit</a>
					</button></td> -->
				</tr>
				<?php } ?>
			</tbody>


		</table>
	</div><!-- /.box-body -->
</div><!-- /.box -->
</div><!-- /.col -->


			<?php } ?>

</div>

</div>

</section> 