<script>

 
$(document).ready(function(){
 	$('#rectype').change(function(){
	 
		if ( $('#rectype').val() == "0" ){
	 
			 $('#rectypedev').css('visibility','hidden');
		}
		
		if ( $('#rectype').val() == "1" ){
		 
			 $('#rectypedev').css('visibility','visible');
		}
	});
 });
</script>
 <section class="content">
<div class = "modal-example">
 
 <div class = "row" >

  <div class="col-md-12" style = "margin-top:10px">


   <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $title; ?></h3>
            </div>
            <div class="panel-body">
              <!--starting point of panel body-->
           
    
<?php
if(preg_match('/Edit/',$title))
{
 	echo form_open('history_c/update/'.$pid."/".$hid, array('name' => 'myform','id' => 'myform'));
}else
{
	echo form_open('history_c/save/'.$pid."/".$visitid, array('name' => 'myform','id' => 'myform'));
}
 ?>
	
		  
		  
<!-- Message for operation status  ************************************************************** --> 
		<?php 
			if($status !== 0){
				if((!preg_match('/Edit/',$title)) &  $status == "True"){ 
		 ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Successfull !  </strong> Record Added Successfully
		</div>
		<?php }else if(  preg_match('/Edit/',$title)  &  $status == "True"){  ?>
		
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Successfull !  </strong> Record updated Successfully
		</div>
		
		<?php } ?>
		
		
		<?php if((!preg_match('/Edit/',$title)) &  $status == "False"){ ?>
		
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Fail !</strong> Faild to add the Record
			</div>
		
		
		<?php }else if(  preg_match('/Edit/',$title) &  $status == "False"){  ?>

			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Fail !</strong> Faild to update the Record
			</div>
		<?php } ?>
	<?php } ?>
 <!-- **************************************************************************************** --> 		
		  
        

  <div class="form-group input-group" style="margin-top: 10px">
      <span style="width: 125px"  class="input-group-addon">Record Type*</span>
     
      <select id="rectype" class="form-control" name="rectype" required="required" style="width: 200px;">
             <option <?php if (preg_match('/Edit/', $title) && $record[0]->recordType == "0") echo "selected"; ?> value="0">Note</option>
             <option  <?php if (preg_match('/Edit/', $title) && $record[0]->recordType == "1") echo "selected"; ?> value="1">To Do</option>
         </select>
    
 </div>
				
 <div class="form-group input-group" style="margin-top: 10px">
     <span style="width: 125px"  class="input-group-addon">Record*</span>
     
     <textarea type="text" class="form-control" style="min-width: 200px;max-width: 200px;min-height: 60px;height:auto" id="RecordText"  required name="RecordText" placeholder="">
         <?php if (preg_match('/Edit/', $title)) echo $record[0]->recordText; ?>
     </textarea>
     
 </div>
                  

 <div class="form-group input-group" style="margin-top: 10px">
     <span style="width: 125px"  for="recvisible" class="input-group-addon">Visible To*</span> 
     
     <select id="recvisible" class="form-control" name="recvisible" required="required" style="width: 200px;">
             <option <?php if (preg_match('/Edit/', $title) && $record[0]->recordVisibility == "all") echo "selected"; ?> value="all">For all</option>
             <option  <?php if (preg_match('/Edit/', $title) && $record[0]->recordVisibility == "me") echo "selected"; ?> value="me">Only Me</option>
         </select>
     
 </div>
				
	
	
 <div id="rectypedev" class="form-group input-group" style="margin-top: 10px" <?php if (preg_match('/Edit/', $title) && $record[0]->recordType == '1') echo "style='visibility:visible'";
 else echo "style='visibility:hidden'"; ?> >
     <span style="width: 125px"  for="recvisible" class="input-group-addon"> Completed </span>
     
         <select id="completed" name="completed" class="form-control" style="width: 200px;">
             <option  <?php if (preg_match('/Edit/', $title) && $record[0]->recordCompleted == '1') echo 'selected'; ?>   value="1">Yes</option>
             <option   <?php if (preg_match('/Edit/', $title) && $record[0]->recordCompleted == '0') echo 'selected'; ?>  value="0">No</option>
         </select>
    
 </div>
					  
	
	 
	<?php if(preg_match('/Edit/',$title)) {?>
			
		
	 
		  <div class="controls">
			<label  class="lastmod">Last edit by <?php  echo $record[0]->recordLastUpdateUser->hrEmployee->firstName." ".$record[0]->recordLastUpdateUser->hrEmployee->lastName." on ". date('Y-m-d', $record[0]->recordLastUpdate/1000); ?></label>
	       </div>
		
		  
	<?php } ?> 	
	
 <div class="container-fluid">
     <div class="form-actions">
         &nbsp;&nbsp;&nbsp;&nbsp;
         <button type="submit" class="btn btn-primary"><?php if (preg_match('/Edit/', $title)) echo "Update";
 else echo "Save"; ?></button>
         &nbsp;&nbsp;&nbsp;&nbsp;

         <button type="reset" class='btn'  onclick="history.go(-1);">Cancel</button>
         &nbsp;&nbsp;&nbsp;&nbsp;
     </div>
 </div>
	

</div>
    
     </div><!--Ending point of panel body-->
         

</div>
</section>