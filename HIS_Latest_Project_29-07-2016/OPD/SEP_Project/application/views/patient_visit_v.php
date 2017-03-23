<script type="text/javascript">
 

	document.getElementById('patient_info_header').style.display = "";

	var cusid_ele = document.getElementsByClassName('patient_info');  
	for (var i = 0; i < cusid_ele.length; ++i) {
	       document.getElementsByClassName('patient_info')[i].style.display = "";
	}
	document.getElementsByClassName('patient_info')[0].className = 'patient_info active';


function uri(pid,date){

     
     var x = JSON.parse(pid);
     // alert(x);	
     var y = eval(JSON.stringify(date));
     // alert(y);
    
     var a = 'Prescription/getPrescriptionsByPatientIDAfterprescribe/'+x+'/'+y;
     // alert(a);

      $.ajax({
                url:'http://172.16.21.251:8080/HIS_API/rest/Prescription/getPrescriptionsByPatientIDAfterprescribe/'+x+'/'+y,
                dataType: 'json',

                success: function (data) {
                   //alert(data[0]['prescribeItems'][0]['drugID']['categories']['dCategory']);
                   
                   //alert(data.length);
                   
var tableRef = document.getElementById('tb').getElementsByTagName('tbody')[0];
tableRef.innerHTML = ""
                   for (var i = 0; i < data.length; i++) {
                   	  // Insert a row in the table at row index 0
  var newRow   = tableRef.insertRow(tableRef.rows.length);

  // Insert a cell in the row at index 0
  
  
  newRow.insertCell(0).appendChild(document.createTextNode(data[0]['prescribeItems'][0]['drugID']['categories']['dCategory'])); 
  newRow.insertCell(1).appendChild(document.createTextNode(data[0]['prescribeItems'][0]['drugID']['categories']['dCategory'])); 
  newRow.insertCell(2).appendChild(document.createTextNode(data[0]['prescribeItems'][0]['drugID']['categories']['dCategory'])); 
 newRow.insertCell(3).appendChild(document.createTextNode(data[0]['prescribeItems'][0]['drugID']['categories']['dCategory'])); 
  newRow.insertCell(4).appendChild(document.createTextNode(data[0]['prescribeItems'][0]['drugID']['categories']['dCategory'])); 
  newRow.insertCell(5).appendChild(document.createTextNode(data[0]['prescribeItems'][0]['drugID']['categories']['dCategory'])); 



                   };

                   

                 $("#Prescription").show();
                },
                async: false
            });

	 
	    $('#ab').click(function(){
		     $("#Prescription").hide();
		});

}
</script>
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
					<div class="col-lg-11" style="width:1180px">
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
																
																<?php $l=0; sort($allergy); if ($allergy != NULL) foreach ($allergy as $row) { ?>
										

											<?php  /*++$l;*/ 


                                           /*    $t = 0;*/

                                              
                                               /*if (date("Y-m-d") ==  date("Y-m-d", $row['allergyCreateDate'] / 1000)) 
                                               {
                                               	 $t++;
                                               	 $x = $x + $t;

                                               }*/

                                               
 								  				echo $row['allergyName'].",";

											?>

									
										<?php } else echo "No Recent Allergies";?>

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
									
										<?php $i=0; if ($visits != NULL) foreach ($visits as $row) { ?>
									    <tr>
										<?php ++$i; ?>
                                        
										<td><?php echo $row['visitType']; ?></td>
										<td><?php echo $row['visitID']; ?> </td>
										<td><?php echo date("Y-m-d h:i:s A", $row['visitDate'] / 1000); ?></td>
										<td><?php echo $row['visitComplaint']; ?></td>
										<td><?php echo $row['visitRemarks']; ?></td>
											

											<td><a style="color: white"
                                                  button type="submit" class="btn btn-primary"
													
														href="<?php echo base_url() . 'index.php/visit_c/edit/' . $pprofile->patientID . "/" . $visit[0]->visitID; ?>">Edit
													</a>
												</button></td>

											<?php }?>	
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
						<br>
								<table class="table table-bordered table-striped table-hover"
									id="tabletestp_2">
									<br>
									<thead>
										<tr>
											<th width="25px">#</th>
											<th>Date</th>
											<th>Illness</th>
											<th>Docter</th>
											<th></th>
										<!-- 	<th>Frequency</th>
											<th>Period</th>
											<th>Updated</th>
											<th>Doctor</th>
											<th>Status</th> -->
										</tr>

									</thead>
									<tbody>
									<?php  ?>
								            <?php $presitems = array_map("unserialize", array_unique(array_map("serialize", $presitems))); ?>
									     <?php $i=0; if ($presitems != NULL) foreach ($presitems as $item) { ?>
									    
                                                <tr>
											<td><?php echo ++$i; ?></td>
                                            <?php $date = date_create($item[0]);
                                              $a = date_format($date, 'Y-m-d'); ?>
											<td><?php echo  $item[0]; ?></td>
											<td><?php echo  $item[1]; ?></td>
											<td><?php echo  $item[2]; ?></td>
											<!--<td><?php //echo $item['prescribeItems'][0]['prescribeItemsFrequency']; ?></td>
											<td><?php //echo $item['prescribeItems'][0]['prescribeItemsPeriod']; ?></td>
											<td><?php //echo date("Y-m-d",$item['prescribeItems'][0]['drugID']['dLastUpdate']/1000); ?></td>
										    <td><?php// echo  $item['prescribeItems'][0]['drugID']['dCreateUser']; ?></td>
											<td><?php
																//if ( $item['prescriptionStatus']== '0')
																	//echo "Not Issued";
																//else
																	//echo "Issued";
																?> </td>!-->
                                            
                                            <?php $array = array( 'index.php' => 'patient_visit_c', 'view3' => $pid , $vid => $a ); ?>

                                             <?php $str = $this->uri->assoc_to_uri($array);	?>
                                              <!-- <?php var_dump((($str))); ?> -->
                                             															
											<td><button id="abc" type="button" class="rmv" onclick="uri('<?php echo $pid; ?>','<?php echo $a; ?>');" >
													
														<a  style="color: #1A2226 " data-toggle='modal'  >View
													</a>
												</button></td>





										</tr>
                                            <?php } ?>
                                    <?php ?>
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
									     <?php $i=0; if ($labs != NULL) foreach ($labs as $row) { ?>
                                                <tr>
											<td><?php echo ++$i; ?></td>
                                            <td id="tdtest"><?php echo $row->ftest_ID->test_Name; ?></td>
											<td id="tddate"><?php echo $row->test_RequestDate; ?></td>
											
											<td id="tdstatus"><?php echo $row->status; ?></td>
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

											<!-- <td><button type="submit" class="btn btn-primary">
													<a style="color: white"
														href="#">View</a>
												</button></td> -->
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


	 <div class="modal modal-info" id="Prescription" > 

    <div class="modal-dialog" style="width:700px">
        <div class="modal-content">
            <div class="modal-header">
                <div class="box-tools pull-right">
                <button id="ab" type="button" class="btn btn-info btn-sm" data-widget="remove" ><i class = "fa fa-times"></i></button>
                </div>
                <h4 class="modal-title">Patient's Prescriptions</h4>
            </div>

                <div class="box">
							<div class="box-body">
						<br>
								<table class="table table-bordered table-striped table-hover"
									id="tb">
									<br>
									<thead>
										<tr>
											<th width="25px">#</th>
											<th>Date</th>
											<th>Illness</th>
											
											<th>Frequency</th>
											<th>Period</th>
											<th>Updated</th>
											<th>Doctor</th>
											<th>Status</th>
										</tr>

									</thead>
									<tbody>
									
								            <?php $presitems = array_map("unserialize", array_unique(array_map("serialize", $presitems))); ?>
									     <?php $i=0; if ($presitems != NULL) foreach ($presitems as $item) { ?>
									    
                                                <tr id="ts">
											<td id="index"><?php echo ++$i; ?></td>
                                            
											<td id="tb1"> <?php echo  $item['prescriptionDate'];	 ?></td>
											<td id="tb2"><?php echo  $item['prescribeItems'][0]['drugID']['categories']['dCategory']; ?></td>
											<td id="tb3"><?php echo $item['prescribeItems'][0]['prescribeItemsFrequency']; ?></td>
											<td id="tb4"><?php echo $item['prescribeItems'][0]['prescribeItemsPeriod']; ?></td>
											<td id="tb5"><?php echo date("Y-m-d",$item['prescribeItems'][0]['drugID']['dLastUpdate']/1000); ?></td>
										    <td id="tb6"><?php echo  $item['prescribeItems'][0]['drugID']['dCreateUser']; ?></td>
											<td><?php
																if ( $item['prescriptionStatus']== '0')
																	echo "Not Issued";
																else
																	echo "Issued";
																?> </td>
											




										</tr id="te">
                                            <?php } ?>


                                            <?php $r=0; if ($allergy != NULL) foreach ($allergy as $row) { ?>
										<tr>
											<td><?php echo ++$r; ?></td>

											<td><?php echo $row['allergyName']; ?></td>
											<!-- <td><?php echo $row['allergyStatus']; ?></td> -->
											
											<td><?php echo date('Y-m-d', $row['allergyCreateDate'] / 1000); ?> </td>

											<!-- <td><?php echo $row['allergyRemarks']; ?></td> -->

											

											<!-- <td><button type="submit" class="btn-xs btn-primary">
												<a style="color: white"
												href="<?php echo base_url() . 'index.php/allergies_c/edit/' . $pprofile->patientID . "/" . $row['allergyID']; ?>">Edit</a>
											</button></td> -->
										</tr>
										<?php } ?>

    								</tbody>

								</table>
							</div>
						</div>


                
        </div>
    </div>
</div>

</section>






