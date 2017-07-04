<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>

<div class="container" style="margin-left: 13px">
<div class="row">
     <!--Starting point of panel--> 
    <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $title; ?></h3>
            </div>
            <div class="panel-body">
              
       
<div>
	
		  
<!-- Message for operation status  ************************************************************** --> 
		<?php if($status !== 0){
				if( (!preg_match('/Edit/',$title)) & $status != "0"){ 
		 ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Successfull !  </strong> LabOrder created successfully
		</div>
		<?php }else if( preg_match('/Edit/',$title) &  $status == "True"){  ?>
		
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Successfull !  </strong> LabOrder updated successfully
		</div>
		
		<?php } ?>
 
	<?php } ?>
 <!-- **************************************************************************************** --> 		
	 	  
 
 <table class="table table-hover table-striped">

     <tr>
         <td>Visit : <?php echo $vist->visitType; ?></td>
         <td>Date and Time : <?php echo date("d-m-Y", $vist->visitDate / 1000); ?> </td>

         <td>Complaint : <?php echo $vist->visitComplaint; ?> </td>

         <td>Remarks : <?php echo $vist->visitRemarks; ?> </td>

     </tr>

 </table>
        
 <hr>

	    <?php echo form_open('laborder_c/save/'.$pid."/".$visitid, array('name' => 'myform')); ?>
        <div >
		 					 
            <div class="form-group input-group" style="margin-top: 10px">
                <span style="width: 155px"  class="input-group-addon">Test Name</span>
                
                <!--<select multiple="multiple" class="form-control" required rows="8" name="TestName" style="width:350px;">-->
		 <select class="form-control"  name="TestName" style="width:350px;">			
						<?php foreach($labtests as $test){ ?>
						  <option value="<?php echo $test->testID; ?>"> <?php echo $test->testName; ?> </option>	 
						<?php } ?>
					 
                </select>               
            </div>

            <div class="form-group input-group" style="margin-top: 10px">
                <span style="width: 155px"  class="input-group-addon">Location</span>
               
                <select class="form-control" name="location" style="width:350px;">
                        <option value="InHospital">In Hospital</option>
                        <option value="Private">Private</option>
                    </select>               
            </div>
			
            <div class="form-group input-group" style="margin-top: 10px">
                <span style="width: 155px"  class="input-group-addon">Priority</span>
               
                <select class="form-control" name="Priority" required="required" style="width: 350px;">
                        <option value="0">High</option>
                        <option value="1">Medium</option>
                        <option value="2">Low</option>
                 </select>              
            </div>

            <div class="form-group input-group ,input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd"  style="margin-top: 10px">
                <span style="width: 155px"  class="input-group-addon">Due date</span>
                
                <input type="text" class="form-control "id="duedate" required name="duedate" style="width: 350px;"/>              
                                      
            </div>

        <div class="form-group input-group" style="margin-top: 10px">
                <span style="width: 155px"  class="input-group-addon">Remarks</span>
           
                <textarea type="text" class="form-control" name="Remarks" placeholder="" style="min-width: 350px;max-width: 350px;min-height: 60px;height:auto"></textarea>
            
        </div>
 </div>

   
<div class="container-fluid">
    <div class="form-actions span4 offset1" style="margin-top: 10px">
        &nbsp;&nbsp;&nbsp;&nbsp;
        <button type="submit" class="btn btn-success">Send To Lab</button>
        &nbsp;&nbsp;&nbsp;&nbsp;
 
			<button type="reset" class='btn'  onclick="history.go(-1);">Cancel</button>
		</div>
</div>
  <?php echo form_close(); ?>
       

    </div>


    
    </div> <!--Ending point of panel body--> 
          </div> <!--Ending point of panel--> 
</div>
</div>
