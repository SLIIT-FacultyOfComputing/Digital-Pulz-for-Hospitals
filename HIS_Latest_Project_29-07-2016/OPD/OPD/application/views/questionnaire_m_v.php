<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<script type="text/javascript"
		src="<?php echo base_url('public/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script type="text/javascript">
       document.getElementsByClassName('navsidebar')[0].className = "navsidebar active";
</script>

<script type="text/javascript">
    

    $(document).ready(function() {

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

        $('#gtablerows').val($('#questiontable tbody tr').length-1);
    	//add guardians to the temp table
    	$('#btnAdd').click(function(){
    		$('#questionList').prop('hidden', false);
    		var text = $('#text').val();
    		var answertype = $('#answertype').val();
    		var answervals= $('#answervals').val();
    		
    		

    		var QuestionAppend = '<tr><td><input type="checkbox" name="record"></td>'+
            '<td><input class="form-control" type="hidden" name="tableText[]" value="'+text+'" />'+text+'</td>'+
    		'<td><input class="form-control" type="hidden" name="tableAnswerType[]" value="'+answertype+'" />' + answertype + '</td>'+
    		'<td><input class="form-control" type="hidden" name="tableAnswervals[]" value="'+answervals+'" />' + answervals + '</td>'+
            '</tr>';

    		$('#gtablerows').val($('#questiontable tbody tr').length);


    		$('#questiontable tbody').append(QuestionAppend);

    		$('#text').val("");
    		$('#answertype').val("");
    		$('#answervals').val("");
          
    	});

    	// Find and remove selected table rows
        $("#removeQues").click(function(){
            $("#questiontable tbody").find('input[name="record"]').each(function(){
            	if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });

            $('#gtablerows').val($('#questiontable tbody tr').length-1);

            if($('#gtablerows').val() == 0)
            {
            	$('#questionList').prop('hidden', true);
            }
            
        });

        

   
           
        }); 
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
							<input type="text" id="gtablerows" name="gtablerows" hidden >


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
								<textarea rows="7" class="form-control" id="remarks" name="remarks"><?php if ($questionnaire != null) echo $questionnaire->remarks; ?></textarea>

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
									 value="">

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
								<button type="button" id="btnAdd" name="btnAdd" class="btn btn-primary">Add</button>
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
				<div class='col-xs-12' >
				<?php if(isset($question_list)) { ?>
					<div id="questionList">
					<table class="table table-hover" name="questiontable" id="questiontable">

						<tr>
							<th></th>
							<th style="color: #2aabd2"><strong>Text</strong></th>
							<th style="color: #2aabd2"><strong>Answer Type</strong></th>
							<th style="color: #2aabd2"><strong>Answer Value</strong></th>

						</tr>
						<?php foreach ($question_list as $question) { ?>
                        <tr>
                            <td></td>
							<td><?php echo $question->text; ?></td>
							<td><?php echo $question->answertype; ?></td>
							<td><?php echo $question->answervals; ?></td>
						</tr>
                        <?php } ?>
                    </table>
				<?php } else {?>
					<div id="questionList" hidden>
					<table class="table table-hover" name="questiontable" id="questiontable">

						<tr>
							<th></th>
							<th style="color: #2aabd2"><strong>Text</strong></th>
							<th style="color: #2aabd2"><strong>Answer Type</strong></th>
							<th style="color: #2aabd2"><strong>Answer Value</strong></th>

						</tr>
						
                    </table>

                    <button type="button"  id="removeQues" name="removeQues" class="btn btn-mini btn-delete">Remove</button>
				<?php } ?>
					
						

                    
                    
                </div>
                    
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

                    
                    <div class="form-group input-group">
							<button type="submit" id="submitButton" class="btn btn-success pull-left"><?php
							if (preg_match ( '/Edit/', $title ))
								echo "Update";
							else
								echo "Save";
							?>
							</button>&nbsp
                        
                        <button type="reset" class='btn'
								onclick="history.go(-1);">Cancel</button>
						</div>


					<?php echo form_close(); ?>	
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








