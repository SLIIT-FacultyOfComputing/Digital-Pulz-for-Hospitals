<script>

    $(document).ready(function () {

        $('#answertype').change(function () {
            if ($('#answertype').val() == "choice")
            {
                $('#answervals').removeAttr("readonly");
                $('#answervals').attr("required", "required");
                $('#answervals').val("Enter comma (,) seperated values");
            } else
            {
                $('#answervals').removeAttr("required");
                $('#answervals').attr("readonly", "readonly");
                $('#answervals').val("");
            }
        });

    });

</script>

<script type="text/javascript">
       document.getElementsByClassName('navsidebar')[0].className = "navsidebar active";
</script>




<section class="content-header">
	<h1>
		Questionnaire <small> Add Questionnaire</small>
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
	<!-- COLOR PALETTE -->
	<div class='box box-default'>
		<div class='box-header with-border'>
			<h3 class='box-title'>
				<i class="fa  fa-th-list"></i> Add Questionnaire
			</h3>
		</div>
		<div class='box-body'>

			<div class="row">
				<div class="col-md-6">
					<div class="box box-default">
						<div class="box-body">
                   <?php
																			if (preg_match ( '/Edit/', $title )) {
																				echo form_open ( 'questionnaire_c/add_question/' . $qid, array (
																						'name' => 'qform',
																						'id' => 'qform' 
																				) );
																			} else {
																				echo form_open ( 'questionnaire_c/add_question', array (
																						'name' => 'qform',
																						'id' => 'qform' 
																				) );
																			}
																			?> 
																				
																				
					  <div class="form-group input-group">
								<span class="input-group-addon">Name*</span> <input type="text"
									class="form-control" id="name" name="name" required="required"
									value="<?php if ($questionnaire != null) echo $questionnaire->name; ?>">

							</div>


							<div class="form-group input-group">
								<span class="input-group-addon">Relate To</span>

								<select id="relateto" class="form-control" name="relateto"
									class="form-control">
									<option value="opd">OPD Visit</option>
									<option value="clinic">Clinic</option>
								</select>

							</div>


							<div class="form-group input-group">
								<span  class="input-group-addon">Remarks</span>
								<textarea rows="7" class="form-control" id="remarks" name="remarks">
                            <?php if ($questionnaire != null) echo $questionnaire->remarks; ?>
                        </textarea>

							</div>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->

				<div class="col-md-6">
					<div class="box box-default">
						<div class="box-header with-border">
							<i class="fa  fa-plus-square-o"></i>
							<h3 class="box-title">Add Questions</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">

							<div class="form-group input-group">
								<span class="input-group-addon">Question Text*</span> <input
									type="text" class="form-control" id="text" name="text"
									required="required" value="">

							</div>


							<div class="form-group input-group">
								<span class="input-group-addon">Answer Type</span> <select
									id="answertype" name="answertype" class="form-control">
									<option value="text">Text</option>
									<option value="number">Number</option>
									<option value="date">Date</option>
									<option value="choice">Choice</option>
								</select>

							</div>



							<div class="form-group input-group">
								<span class="input-group-addon">Answer Values</span>

								<textarea class="form-control" readonly id="answervals"
									name="answervals" rows="2"> </textarea>

							</div>
							<div class="form-group input-group">
								<button type="submit" class="btn btn-primary">Add</button>
							</div>



                    <?php echo form_close(); ?>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->


			<div class='row'>
				<div class='col-xs-12'>

					<hr>
                    
                    
                      <?php
																						if ($question_list != null && sizeof ( $question_list ) > 0) {
																							?> 

                        <table class="table table-hover">

						<tr>

							<td style="color: #2aabd2"><strong>Text</strong></td>
							<td style="color: #2aabd2"><strong>Answer Type</strong></td>
							<td style="color: #2aabd2"><strong>Answer Value</strong></td>
							<td></td>
						</tr>

                            <?php foreach ($question_list as $question) { ?>
                                <tr>

							<td><?php echo $question->text; ?></td>
							<td><?php echo $question->answertype; ?></td>
							<td><?php echo $question->answervals; ?></td>

                                    <?php
																								if (preg_match ( '/Edit/', $title )) {
																									echo form_open ( 'questionnaire_c/remove_question/' . $question->index . "/" . $qid, array (
																											'name' => 'qform' 
																									) );
																									?>
                                        <td>
								<button type="submit" class="btn btn-mini btn-delete">Remove</button>
							</td>

                                    <?php } echo form_close(); ?>

                                </tr>
                            <?php } ?>

                        </table>
                    <?php } ?>
                    
                    
                    
                    
                    
				<div class="form-actions" style="margin-top: 20px;">

                    <?php if (preg_match('/Edit/', $title)) { ?> 

                        <div class="form-group input-group">
							<span class="input-group-addon">Active </span> <select
								id="active" name="active" class="form-control">
								<option
									<?php
																					if ($questionnaire->active == '1') {
																						echo 'selected';
																					}
																					?>
									value="1">Yes</option>
								<option
									<?php
																					if ($questionnaire->active == '0') {
																						echo 'selected';
																					}
																					?>
									value="0">No</option>
							</select>

						</div>

						<div class="control-group">

							<div class="form-group input-group">
								<span  class="input-group-addon">Last edit by <?php echo $lastmodusername . " on " . date('Y-m-d', $questionnaire->lastupdate / 1000); ?></span>
							</div>
						</div>

                    <?php } ?> 

                    <?php
																				if (preg_match ( '/Edit/', $title )) {
																					echo form_open ( 'questionnaire_c/update/' . $qid, array (
																							'name' => 'myform' 
																					) );
																				} else {
																					echo form_open ( 'questionnaire_c/save', array (
																							'name' => 'myform' 
																					) );
																				}
																				?>
                    <div class="form-group input-group">
							<button type="submit" class="btn btn-success pull-left"><?php
							if (preg_match ( '/Edit/', $title ))
								echo "Update";
							else
								echo "Save";
							?>
							</button>&nbsp
                        <?php echo form_close(); ?>
                        <button type="reset" class='btn'
								onclick="history.go(-1);">Cancel</button>
						</div>



<?php
if ($status !== 0) {
	if ((! preg_match ( '/Edit/', $title )) & $status == "True") {
		?> 
                            <div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Successfull ! </strong> Questionnaire Added Successfully
						</div>
                        <?php } else if (preg_match('/Edit/', $title) & $status == "True") { ?>

                            <div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Successfull ! </strong> Questionnaire updated
							Successfully
						</div>

                        <?php } ?>


                        <?php if ((!preg_match('/Edit/', $title)) & $status == "False") { ?>

                            <div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Fail !</strong> Faild to add the Questionnaire
						</div>


                        <?php } else if ((!preg_match('/Edit/', $title)) & $status == "FalseNoQ") { ?>

                            <div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong> Faild </strong> to add the Questionnaire. Please add
							atleast one question.
						</div>


                        <?php } else if (preg_match('/Edit/', $title) & $status == "False") { ?>

                            <div class="alert alert-warning">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Fail !</strong> Faild to update the Questionnaire
						</div>
                        <?php } ?>



                    <?php } ?>


				</div>
					<!-- /.col -->
				</div>
			</div>

</section>
<!-- /.content -->








