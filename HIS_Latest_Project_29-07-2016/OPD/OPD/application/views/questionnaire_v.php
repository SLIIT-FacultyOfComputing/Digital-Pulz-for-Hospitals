<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<section class="content-header">
	<h1>
		Questionnaire <small> View Questionnaire</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#"><i class="fa fa-th-list"></i> Questionnaire</a></li>
		<li class="active">View Questionnaire
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
	</ol>
</section>
</br>
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
								<th>Name</th>
								<th>Type</th>
								<th>Remarks</th>
							</tr>

						</thead>
						<tbody>
   <?php $i=0;foreach($questionnaire as $row){?>
				</tr>
							<tr
								onClick=<?php echo "window.location='".base_url()."index.php/questionnaire_c/edit/".$row->questionnaireID."/true'"; ?>>
								<td ><?php echo ++$i; ?></td>
								<td id="tdname"><?php echo  $row->questionnaireName ;?></td>
								<td id="tdtype"><?php echo    $row->questionnaireRelateTo ;?></td>
								<td id="tdremarks"><?php echo   $row->questionnaireRemarks;  ?></td>
							</tr> 
				<?php } ?>
    </tbody>

					</table>
				</div>
			</div>
		</div>
	</div>


	<br>
	<br>


</section>
