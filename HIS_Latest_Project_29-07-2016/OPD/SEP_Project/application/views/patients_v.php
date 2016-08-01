
<script type="text/javascript">
       document.getElementsByClassName('navsidebar')[1].className = "navsidebar active";
</script>

<section class="content-header">
	<h1>
		My OPD <small>My OPD Patients</small>
	</h1>
	
</section>
<br>
<section class="content">

	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body">
					<table class="table table-bordered table-striped table-hover"
						id="tabletestp">
						<br>
						<thead>
							<tr>
								<th width="25px">#</th>
								<th>HIN</th>
								<th>Name</th>
								<th>Visit Date</th>
								<th>Complaint</th>
								<th>Details</th>
							</tr>

						</thead>
						<tbody>
    <?php $i=0; foreach($patients as $row){ ?>
       <tr
								onClick=<?php $i++; echo "window.location='".base_url()."index.php/patient_visit_c/view/".$row->patient->patientID."/".$row->visitID."'"; ?>>
								<td><?php echo $i; ?></td>
								<td><?php echo $row->patient->patientHIN; ?></td>
								<td><?php   if($row->patient->patientTitle=="Baby" | $row->patient->patientTitle=="Rev") echo  $row->patient->patientTitle." ".$row->patient->patientFullName;else echo $row->patient->patientTitle.$row->patient->patientFullName; ?></td>
								<td><?php echo date('Y-m-d H:i:s a',$row->visitDate/1000);  ?></td>
								<td><?php echo  $row->visitComplaint ;  ?></td>

								<td><?php echo (date('Y') - date('Y',strtotime($row->patient->patientDateOfBirth)))."Yrs / ". $row->patient->patientGender." / ".$row->patient->patientCivilStatus." / ".$row->patient->patientAddress ?></td>
							</tr>
          <?php }  ?>
    </tbody>

					</table>
				</div>
			</div>
		</div>
	</div>


	<br>
	<br>


</section>