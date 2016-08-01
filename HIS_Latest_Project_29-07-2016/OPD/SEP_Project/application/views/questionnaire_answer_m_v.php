
<script>
 $(document).ready(function(){
 
 	$(function() {

			$( "#date" ).datepicker();
			$( "#date" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			$( "#date" ).datepicker( "option", "changeMonth", "true" );
			$( "#date" ).datepicker( "option", "changeYear","true" );

		});
 	 
 });
</script>

<section class="content-header">
	<h1>
		Questionnaire <small> <?php echo $title; ?></small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#"><i class="fa fa-wheelchair"></i> Questionnaire </a></li>
		<li class="active"><?php echo $title; ?>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
	</ol>
</section>
</br>

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
	<div class="row">
		<!-- left column -->
		<div class="col-md-3 col-md-offset-4">

<?php

if (! preg_match ( '/View/', $title2 )) {
	echo form_open ( 'questionnaire_c/save_answer/' . $pid . "/" . $qid . "/" . $visitid, array (
			'name' => 'myform',
			'id' => 'myform' 
	) );
} else {
	echo form_open ( 'questionnaire_c/update_answer/' . $pid . "/" . $qid . "/" . $visitid . "/" . $asid, array (
			'name' => 'myform',
			'id' => 'myform' 
	) );
}
?>

<div class="box box-default">
				<div class="box-header">
					<h3 class="box-title"><?php echo $title; ?></h3>
				</div>
				<hr>
				<div class="box-body">
					<div class="row">


						<!-- Message for operation status  ************************************************************** --> 
		<?php
		
		if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
			if ($status == "True") {
				?>
			<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Successfull ! </strong> Answer Saved Successfully
						</div>
	
		<?php } ?>
		 
		<?php if(  $status == "False"){ ?>
		
			<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Fail !</strong> Faild to save the Answers
						</div>
		  
	<?php } } ?>
 <!-- **************************************************************************************** --> 		
		
	
		<?php foreach($questions as $quesion) { ?>
		
         <div class="form-group input-group"
							style="margin-top: 10px; margin-left: 10px">
							<span style="width: 155px" class="input-group-addon"
								for="<?php echo $quesion->questionID; ?>">
             <?php echo $quesion->questionText; ?></span>

							<div class="controls">
		
			<?php
			$answerValue = "";
			$answerID = "";
			if (preg_match ( '/View/', $title2 )) {
				foreach ( $answers as $answer ) {
					if ($answer ['questionID'] ['questionID'] == $quesion->questionID) {
						$answerValue = $answer ['answerText'];
						$answerID = $answer ['answerID'];
					}
				}
			}
			?>
			
			<?php if( $quesion->questionAnswerType == 'text') { ?>
              <input type="text" class="form-control"
									style="width: 450px"
									name="<?php  if(preg_match('/View/',$title2)) echo $answerID; else echo $quesion->questionID; ?>"
									value="<?php if(preg_match('/View/',$title2)) echo $answerValue;?>">
			<?php }  ?>
			  
			  <?php if( $quesion->questionAnswerType == 'number') { ?>
              <input type="text" class="form-control"
									style="width: 450px"
									name="<?php  if(preg_match('/View/',$title2)) echo $answerID; else echo $quesion->questionID; ?>"
									pattern="[0-9]*"
									value="<?php if(preg_match('/View/',$title2)) echo $answerValue;?>">
			<?php }  ?>
			
			 <?php if( $quesion->questionAnswerType == 'date') { ?>
              <input type="date" class="form-control"
									style="width: 450px"
									name="<?php  if(preg_match('/View/',$title2)) echo $answerID; else  echo $quesion->questionID; ?>"
									value="<?php if(preg_match('/View/',$title2)) echo $answerValue;?>">
			<?php }  ?>

			  
			 <?php if( $quesion->questionAnswerType == 'choice') { ?>
              
				<select class="form-control" style="width: 450px"
									name="<?php if(preg_match('/View/',$title2)) echo $answerID ;else  echo $quesion->questionID; ?>">
					<?php
				$vals = explode ( ",", $quesion->questionAnswerValue );
				foreach ( $vals as $val ) {
					?>
						<option
										<?php if (preg_match('/View/',$title2) && $val == $answerValue) echo 'selected'; ?>
										class="" value="<?php echo $val; ?>"> <?php echo $val; ?> </option>
					<?php }  ?>
				</select>
			  
			<?php }  ?>
			
			
            </div>

						</div>
		     
		<?php } ?>
		  
		   
			
	<?php if(preg_match('/View/',$title2)){?> 
	 	
		
	 
		  <div class="form-group input-group"
							style="margin-top: 10px; margin-left: 10px">
							<span style="width: 155px" class="input-group-addon">Last edit by <?php echo $lastmodusername." on ". date('Y-m-d', $answers[0]['answerSetId']['answerSetLastUpDate'] /1000); ?></span>
						</div>
		
		  
	<?php } ?> 	
	<div class="col-md-12">

							<button type="submit"
								class="btn btn-block btn-success btn-lg pull-right"><?php if(preg_match('/View/',$title2)) echo "Update"; else echo "Save"; ?></button>


							<button type="reset"
								class="btn btn-block btn-default btn-lg pull-left"
								onclick="history.go(-1);">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php echo form_close(); ?>

