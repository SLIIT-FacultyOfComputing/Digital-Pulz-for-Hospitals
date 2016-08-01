 
<div class="panel panel-info" >
              <div class="panel-heading">
               <h5 class="panel-title"><?php echo $title; ?></h5>
              </div>
    <div class="panel-body">
        
   

    <div class="form-horizontal">     
          
            <!-- Message for operation status  ************************************************************** --> 
            <?php
            if ($status == "True") {
                ?>

                <div class="alert alert-success">

                    <button onClick="<?php echo "javascript:window.open('../../print_c/print_token/" . $pid . "/" . $isonq->queueTokenNo . "','patientToken','width=490,height=250');"; ?>" style="float:right" class="btn btn-default"><i class='glyphicon glyphicon-print'> </i> Print Token</button>
                    <strong> Token Number : <?php echo $isonq->queueTokenNo; ?></strong>  <br>
                    <br>
                </div>
    </div>
    </div>
</div>
            <?php
            }

if($status != "True"){ 
		  

if(preg_match('/Edit/',$title))
{
 //	echo form_open('visit_c/update/'.$pid."/".$visitid, array('name' => 'myform'));
}else
{
	echo form_open('queue_c/save/'.$pid, array('name' => 'myform'));
}
 ?>
 <!-- **************************************************************************************** --> 		
	
            <br>


                <div class="form-group input-group" style="margin-top: 10px">
                    <span style="width: 155px"  class="input-group-addon">Assigned To*</span>
                    
                        <select class="form-control" style="width: 350px" readonly name="doctor" required >

                                <?php foreach ($doctors as $doctor) { ?>

                                    <option <?php if ($doctor->hrEmployee->empId == $assigndoc->userId) echo "selected"; ?>  value=" <?php echo $doctor->hrEmployee->empId; ?>" > <?php echo "Dr." . $doctor->hrEmployee->firstName." ".$doctor->hrEmployee->lastName; ?> </option>

                                <?php } ?>
                        </select>                    
                </div>
            
                 <div class="form-group input-group" style="margin-top: 10px">
                     <span style="width: 155px"  class="input-group-addon">Date and Time </span>
                    
                     <input class="form-control" style="width: 350px" type="text" id="inputDateandTime" readonly name="DateandTime" placeholder="" value="<?php if(preg_match('/Edit/',$title)){  echo date('Y-m-d H:i:s a',$visit[0]->dateOfVisit/1000);  }else{ echo date('Y-m-d H:i:s a');}?>">
                    
                </div>
			  
               
                 <div class="form-group input-group" style="margin-top: 10px">
                     <span style="width: 155px"  class="input-group-addon">Assign By </span>

                            <input class="form-control" style="width: 350px" type="text" id="inputDoctor" readonly name="Doctor" placeholder="" value="<?php echo  $this->session->userdata("userfullname");?>">

                </div>

                
				 
				
				
                <div class="form-group input-group" style="margin-top: 10px">
                    <span style="width: 155px"  class="input-group-addon">Remarks</span>
                    <div class="controls">
                        <textarea class="form-control" style="min-width: 350px;max-width: 350px;min-height: 60px;height:auto" id="inputRemarks" name="Remarks" placeholder=""><?php  if(preg_match('/Edit/',$title)){ echo $visit[0]->remarks ; } ?></textarea>
                    </div>
                </div>
            

    			
            <div id="queuetable" style='float: right;    height: 4px;    top: -336px;    margin-left: 591px; margin-top: 80px;   position: relative;' >
                    <h5 align="left">Available Doctors</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th >Doctor</th>
                                <th>Patient Count</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($docpatients as $row) { ?>
                                <tr>
                                    <td><?php echo "Dr." . $row[0].$row[1]; ?></td>
                                    <td><?php echo $row[2]; ?></td>
                                </tr>
                            <?php } ?>

                        </tbody>

                    </table> 

                </div>
 
 
				
				
	<?php if(preg_match('/Edit/',$title)){?> 
            

                        <div class="form-group input-group" style="margin-top: 10px">
                            <span style="width: 155px"  class="input-group-addon">Last edit by </span>
                                 <input class ="form-control" style="width: 350px" readonly type="text" value= "<?php echo $lastmodusername . " on " . date('Y-m-d', $visit[0]->lastUpDate / 1000); ?>" placeholder="">
                                                      
                        </div>
            
	<?php } ?> 	
 

            <div class="container-fluid">
                    <div class="form-actions">

                        <button type="submit" class="btn btn-primary"><?php echo 'Add'; ?></button>

                        <button type="reset" class='btn'  onclick="history.go(-1);">Cancel</button>


                        <?php echo form_close(); ?>

                    </div>
                </div>
</div>
<!--Ending point of panel body-->
 <?php } ?> 	
 

</div>

