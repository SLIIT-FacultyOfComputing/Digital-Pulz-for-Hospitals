<section class="content-header">
	<h1>
		<small> Patient Information</small>
	</h1>
	
</section>
</br>

<!-- Main content -->
<section class="content">

	<div class="row" >
		<div class="col-md-6" >

			<div class="container" >

				<div class="row">
					<div class="col-lg-12" style="width:1180px margin-right:5px">
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
									
								<h4><?php
									if ($pprofile->patientTitle == "Baby")
										echo "$pprofile->patientTitle $pprofile->patientFullName";
									else
										echo "$pprofile->patientTitle $pprofile->patientFullName";
									?> </h4>

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
										

											<?php 

                                               	echo $row['allergyName'].",";
	
											?>

									
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
</section>
				