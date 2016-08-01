<script type="text/javascript">
	document.getElementById('patient_overview_header').style.display = "";

	var cusid_ele = document.getElementsByClassName('patient_overview');
	for (var i = 0; i < cusid_ele.length; ++i) {
	       document.getElementsByClassName('patient_overview')[i].style.display = "";
	}
	document.getElementsByClassName('patient_overview')[0].className = 'patient_overview active';
</script>

<script>
    $(function() {
        var availableTags = <?php echo $complaints; ?>;
        $("#inputInjury").autocomplete({
            source: availableTags
        });
    });
</script>


<!-- <section class="content-header">
	<h1>
		Patient <small> Patient Visits</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#"><i class="fa fa-wheelchair"></i> Patient</a></li>
		<li class="active">Patient Visits
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
	</ol>
</section> -->
</br>

<section class="content">
	<div class="row">
		<!-- left column -->
		<div class="col-md-12">


			<div class="box box-default">
				<div class="box-header">
					<h3 class="box-title">Patient Visits</h3>
				</div>
<?php
if (preg_match ( '/Edit/', $title )) {
	echo form_open ( 'visit_c/update/' . $pid . "/" . $visitid, array (
			'name' => 'myform' 
	) );
} else {
	echo form_open ( 'visit_c/save/' . $pid, array (
			'name' => 'myform' 
	) );
}
?>

<!-- Message for operation status  ************************************************************** --> 
                    <?php
																				if ($status !== 0) {
																					if ((! preg_match ( '/Edit/', $title )) & $status == "True") {
																						?>
                    
                    <div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Successful ! </strong> Visit created Successfully
				</div>
                    
                    <?php } else if (preg_match('/Edit/', $title) & $status == "True") { ?>

                    <div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Successful ! </strong> Visit updated Successfully
				</div>

                    <?php } ?>


                    <?php if ((!preg_match('/Edit/', $title)) & $status == "False") { ?>

                    <div class="alert alert-error">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Fail !</strong> Failed to create the visit
				</div>


                    <?php } else if (preg_match('/Edit/', $title) & $status == "False") { ?>

                    <div class="alert alert-error">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Fail !</strong> Failed to update the visit
				</div>
                    <?php } ?>
                <?php } ?>
                    <!-- **************************************************************************************** -->


				<div class="box-body">
					<br>
					<div class="row">
						<div class="col-xs-6">
							<div class="input-group">

								<span class="input-group-addon">Complaints/Injury *</span> <input
									type="text" class="form-control" id="inputInjury"
									list="companyList" onclick="loadAllergy();" name="Injury"
									pattern="[A-Za-z ]+" required
									value="<?php
									if (preg_match ( '/Edit/', $title )) {
										echo $visit [0]->visitComplaint;
									}
									?>" />
								<script>
                            function loadAllergy()
                            {
                                $.ajax({
                                    url: "http://localhost:8080/HIS_API/rest/LiveSearch/injuryLivesearch",
                                    type: 'GET',
                                    crossDomain: true,
                                    success: function (data) {
                                        for (var i = 0; i < data.length; i++)
                                        {
                                            $("#companyList").append("<option value='" + data[i]['injuryname'] + "'></option>");
                                        }

                                    }
                                });
                            }
                        </script>
								<datalist id="companyList"></datalist>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-xs-6">
							<div class="input-group">

								<span class="input-group-addon">Visit Type *</span><select
									class="form-control" name="VisitType" required>
									<option
										<?php
										if (preg_match ( '/Edit/', $title ) && $visit [0]->visitType == 'OPD') {
											echo 'selected';
										}
										?>
										value="OPD">OPD</option>
									<option
										<?php
										if (preg_match ( '/Edit/', $title ) && $visit [0]->visitType == 'Clinic') {
											echo 'selected';
										}
										?>
										value="Clinic">Clinic</option>
									<option
										<?php
										if (preg_match ( '/Edit/', $title ) && $visit [0]->visitType == 'Other') {
											echo 'selected';
										}
										?>
										value="Other">Other</option>

								</select>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-xs-6">
							<div class="input-group">

								<span class="input-group-addon">Remarks</span>
								<textarea type="text" class="form-control" id="inputRemarks"
									name="Remarks" placeholder=""><?php
									if (preg_match ( '/Edit/', $title )) {
										echo $visit [0]->visitRemarks;
									}
									?>
                            </textarea>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-xs-6">
							<div class="input-group">

								<span class="input-group-addon">Date and Time</span> <input
									class="form-control" type="text" id="inputDateandTime" readonly
									name="DateandTime" placeholder=""
									value="<?php
									if (preg_match ( '/Edit/', $title )) {
										// echo date ( 'Y-m-d H:i:s a', $visit [0]->visitDate / 1000 );
										   date_default_timezone_set('Asia/Colombo');
                                           $date = date('Y-m-d H:i:s ');
                                           echo date ( $date);
									} else {
										// echo date ( 'Y-m-d H:i:s a' );
										   date_default_timezone_set('Asia/Colombo');
                                           $date = date('Y-m-d H:i:s ');
                                           echo date ( $date);
									}
									?>" />
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-xs-6">
							<div class="input-group">

								<span class="input-group-addon">Doctor</span><input
									class="form-control" type="text" id="inputDoctor" readonly
									name="Doctor" placeholder=""
									value="<?php echo $this->session->userdata("userfullname"); ?>">
							</div>
						</div>
					</div>
					
					<?php if (preg_match('/Edit/', $title)) { ?> 
					<br>
					<div class="row">
						<div class="col-xs-6">
							<div class="input-group">
								<label class="lastmod">Last edit by <?php echo $visit[0]->visitLastUpDateUser->hrEmployee->firstName." ".$visit[0]->visitLastUpDateUser->hrEmployee->lastName . " on " . date('Y-m-d', $visit[0]->visitLastUpdate / 1000); ?></label>
							</div>
						</div>
					</div>
					  <?php } ?> 
					  <br> <br>
					<div class="row">
						<div class="col-xs-6">
							<div class="input-group">
								<button type="submit" class="btn btn-primary"><?php
								if (preg_match ( '/Edit/', $title )) {
									echo 'Update';
								} else {
									echo 'Create';
								}
								?></button>&nbsp;
								<button type="reset" class='btn' onclick="history.go(-1);">Cancel</button>
                            <?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>


