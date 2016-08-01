<script type="text/javascript">
	document.getElementById('patient_overview_header').style.display = "";
	var cusid_ele = document.getElementsByClassName('patient_overview');
	for (var i = 0; i < cusid_ele.length; ++i) {
	document.getElementsByClassName('patient_overview')[i].style.display = "";
	}
	document.getElementsByClassName('patient_overview')[0].className = 'patient_overview active';
</script>
<script>

$(document).ready(function(){
<?php
if ($attachment [0]->active == '0') {
	
	echo "$('#myform :input:not(#active):not(.btn-primary)').attr('disabled', true); ";
}
?>
});
</script>


<div class="panel panel-info" style="margin-top: 8px;">
            <div class="panel-heading">
              <h3 class="panel-title">Attach File</h3>
            </div>

            <div class="panel-body">


	<div class="row">
		<!-- left column -->
		<div class="col-md-12">
			<div class="modal-example">
				<div class="box-header">
				
				</div>
			
				<div class="box-body">
					
					<!-- Message for operation status  ************************************************************** -->
					<?php
																									if ($status !== 0) {
																										if ((! preg_match ( '/Edit/', $title )) & $status == "True") {
					?>
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Successfull ! </strong> File attached successfully
					</div>
					<?php }else if(preg_match('/Edit/',$title) &$status == "True"){  ?>
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Successfull ! </strong> Attachment updated successfully
					</div>
					<?php } ?>
					<?php if((!preg_match('/Edit/',$title)) & $status == "False"){ ?>
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Fail !</strong> Failed to attach the file
					</div>
					<?php }else if(preg_match('/Edit/',$title) & $status == "False"){  ?>
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Fail !</strong> Failed to update the attachment
					</div>
					<?php } ?>
					<?php } ?>
					<!-- **************************************************************************************** -->
					<?php
									if (preg_match ( '/Edit/', $title )) {
										echo form_open_multipart ( 'attachment_c/update/' . $pid . "/" . $attachid, array (
												'name' => 'myform',
												'id' => 'myform'
										) );
									} else {
										echo form_open_multipart ( 'attachment_c/save/' . $pid, array (
												'name' => 'myform',
												'id' => 'myform'
										) );
									}
					?>
					<?php  if(preg_match('/Edit/',$title) && $attachment[0]->attachActive=='0'){  ?>
					<div class="alert alert-error">
						The record <strong> is not active </strong>
					</div>
					<?php } ?>
					
					<div class="panel panel-info">
						<div class="panel-body">
							
							<div class="row">
								<div class="col-xs-6">
									<div class="input-group">
										<span class="input-group-addon">File To Attach*</span> <input
										class="form-control" type="file" name="userfile"
										<?php 	if(!preg_match('/Edit/',$title)) echo 'required' ?> />
										<?php
											if (preg_match ( '/Edit/', $title )) {
													echo "<div 	class='form-control' name='uplddfnm'>" . basename ( $attachment [0]->attachLink ) . PHP_EOL . " </div>";
											}
										?>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-xs-6">
									<div class="input-group">
										<span class="input-group-addon">Attachment Type</span> <select
										class="form-control" name="filetype">
										<option value="scanimage">Scan Image</option>
										<option
											<?php if (preg_match('/Edit/', $title) && $attachment[0]->attachType == 'pdf') {echo 'selected';} ?>
										value="pdf">PDF</option>
										<option
											<?php if (preg_match('/Edit/', $title) && $attachment[0]->attachType == 'ecg') {echo 'selected';} ?>
										value="ecg">ECG</option>
										<option
											<?php if (preg_match('/Edit/', $title) && $attachment[0]->attachType == 'xray') {echo 'selected';} ?>
										value="xray">X-Ray</option>
										<option
											<?php if (preg_match('/Edit/', $title) && $attachment[0]->attachType == 'document') {echo 'selected';} ?>
										value="document">Document</option>
										<option
											<?php if (preg_match('/Edit/', $title) && $attachment[0]->attachType == 'other') {echo 'selected';} ?>
										value="other">Other</option>
									</select>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-xs-6">
								<div class="input-group">
									<span class="input-group-addon">Attachment Name*</span> <input
									class="form-control" type="text" required pattern="[A-Za-z ]+"
									id="attachname" name="attachname"
									value="<?php if(preg_match('/Edit/',$title)){ echo $attachment[0]->attachName;  }?>"
									placeholder="">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-xs-6">
								<div class="input-group">
									<span class="input-group-addon">Description/Remarks</span>
									<textarea class="form-control" type="text" id="inputRemarks"
									name="Remarks"
									value="<?php if(preg_match('/Edit/',$title)){ echo $attachment[0]->attachDescription;  }?>"
									placeholder=""></textarea>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-xs-6">
								<div class="input-group">
									<span class="input-group-addon">Attached By</span> <input
									class="form-control" readonly type="text" id="inputAttachedBy"
									name="AttachedBy"
									value="<?php if( preg_match('/Edit/',$title) & $attachment!=null) echo  $attachment[0]->attachedBy->hrEmployee->firstName."".$attachment[0]->attachedBy->hrEmployee->lastName; else echo $createduser; ?>"
									placeholder="">
								</div>
							</div>
						</div>
						<?php if(preg_match('/Edit/',$title)){?>
						<br>
						<div class="row">
							<div class="col-xs-6">
								<div class="input-group">
									<span class="input-group-addon">Active</span> <select
									id="active" name="active" class="form-control">
									<option
										<?php
											
											if ($attachment [0]->attachActive == '1') {
												echo 'selected';
											}
										?>
									value="1">Yes</option>
									<option
										<?php
											
											if ($attachment [0]->attachActive == '0') {
												echo 'selected';
											}
										?>
									value="0">No</option>
								</select>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-xs-6">
							<div class="input-group">
								<label class="lastmod">Last edit by <?php echo $attachment[0]->attachLastUpdateUser->hrEmployee->firstName." on ". $attachment[0]->attachLastUpdate; ?></label>
							</div>
						</div>
					</div>
					<?php } ?>
					<br> <br>
					<div class="row">
						<div class="col-xs-6">
							<div class="input-group">
								<input type="submit" class="btn btn-primary" value="Save" />
								&nbsp;
								<button type="reset" class='btn' onclick="history.go(-1);">Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</div>
