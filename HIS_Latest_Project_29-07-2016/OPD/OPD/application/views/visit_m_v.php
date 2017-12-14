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
//	document.getElementById('patient_overview_header').style.display = "";
//
//	var cusid_ele = document.getElementsByClassName('patient_overview');
//	for (var i = 0; i < cusid_ele.length; ++i) {
//	       document.getElementsByClassName('patient_overview')[i].style.display = "";
//	}
//	document.getElementsByClassName('patient_overview')[0].className = 'patient_overview active';
</script>
<script src="<?= base_url('/Bootstrap/js/jquery-3.2.1.min.js'); ?>"></script>
<script src="<?= base_url('/Bootstrap/js/jquery-ui.min.js'); ?>"></script>
<script>


    function extractLast(term) {
        return split(term).pop();
    }
    function split(val) {
        return val.split(/,\s*/);
    }

    $(document).ready(function() {

		var availableTags = [];
    $("#inputInjury").autocomplete({
        minLength: 2,
        source: function(request, response) {
            $.ajax({
            	type: 'GET',
                url: '<?php echo base_url();?>index.php/visit_c/getComplainsOnSearch/'+extractLast($("#inputInjury").val()),
                data: {
                    term: extractLast(request.term)
                },
                dataType: "json",
                type: "POST",
                success: function(data) {
                	var text = [];
	 		    	jQuery.each(data, function(index, value){
	 		    		text.push(value.name);
	 		    	});
	 		        //availableTags.push(text);
                    response(text);
                },
                error: function() {
                    // added an error handler for the sake of the example
                    response($.ui.autocomplete.filter(
                        availableTags
                        , extractLast(request.term)));
                }
            });
        },
        focus: function() {
            // prevent value inserted on focus
            return false;
        },
        select: function(event, ui) {
            var terms = split(this.value);
            // remove the current input
            terms.pop();
            // add the selected item
            terms.push(ui.item.value);
            // add placeholder to get the comma-and-space at the end
            terms.push("");
            this.value = terms.join(", ");
            return false;
        }
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
            <section class="content-header">
                <h1>
                    New Visits
                </h1>
                <div class="col-md-9">
                    <h4><small><b><?php
                                if ($pprofile->patientTitle == "Baby")
                                    echo "$pprofile->patientTitle $pprofile->patientFullName";
                                else
                                    echo "$pprofile->patientTitle $pprofile->patientFullName";
                                ?> </b> / <?php echo "$pprofile->patientGender"; ?> / <?php
                            date_default_timezone_set('Asia/Colombo');
                            echo (date("Y") - date("Y",$pprofile->patientDateOfBirth/1000));  ?>Yrs <?php
                            date_default_timezone_set('Asia/Colombo');
                            echo (date("m") - date("m",$pprofile->patientDateOfBirth/1000));  ?>Mths <?php
                            date_default_timezone_set('Asia/Colombo');
                            echo (date("d") - date("d",$pprofile->patientDateOfBirth/1000));  ?>Dys /
                            <?php echo "$pprofile->patientCivilStatus";?> /
                            <?php echo "$pprofile->patientAddress" ;?>
                        </small></h4></div>
                <div class="col-md-3" align="right"><h4><small><?php echo "$pprofile->patientHIN"; ?></small></h4></div>
                <br>
                <br>
            </section>

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
						if ($status != 0) {
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
									type="text" class="form-control ui-widget" id="inputInjury" name="Injury"
									 
									required
									value="<?php
									if (preg_match ( '/Edit/', $title )) {
										echo $visit [0]->visitComplaint;
									}
									?>" />
								<script>
								//list="companyList" onclick="loadAllergy();"
                            // function loadAllergy()
                            // {
                            //     $.ajax({
                            //         url: "http://localhost:8080/HIS_API/rest/LiveSearch/injuryLivesearch",
                            //         type: 'GET',
                            //         crossDomain: true,
                            //         success: function (data) {
                            //             for (var i = 0; i < data.length; i++)
                            //             {
                            //                 $("#companyList").append("<option value='" + data[i]['injuryname'] + "'></option>");
                            //             }

                            //         }
                            //     });
                            // }
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


