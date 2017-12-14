<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>

<div class="box">
    
    <div class="panel panel-info" >
        <div class="panel-heading">
            <h3 class="panel-title">View Reports</h3>
        </div>
        <div class="panel-body">
           
       
    
<div class="span10 "> 

<?php
echo form_open('reports_c/generateReport', array('name' => 'myform','id' => 'myform'));
 ?>
 
  <div class="form-horizontal">
	
	 
	     <div class="control-group">
                 
           <div class="form-group input-group" style="margin-top: 10px; margin-left: 10px">
               <span style="width: 155px"  class="input-group-addon">Report For</span>

                                        <select id="reportType" name="reportType" class="form-control" style="width: 450px" >
                                            <option>Visits</option>
                                            <option>Lab Orders</option>
                                            <option>Admissions & Discharges</option>
                                            </select>

            </div>
	   
          <div class="form-group input-group" style="margin-top: 10px; margin-left: 10px">
              <span style="width: 155px"  class="input-group-addon">From Date</span>
            
              <input type="date" class="input-xmedium" id="fromdate" name="fromdate" required="required" value="" class="form-control" style="width: 450px" >
          
          </div>
		  
         <div class="form-group input-group" style="margin-top: 10px; margin-left: 10px">
             <span style="width: 155px"  class="input-group-addon">To Date</span>
                
                     <input type="date" class="input-xmedium" id="todate" class="form-control" style="width: 450px" name="todate" required="required" value="" >
                
         </div>
		    
<!--			<div class="form-group input-group" style="margin-top: 10px; margin-left: 10px">
                        <span style="width: 155px"  class="input-group-addon">Doctor </span>
				
                                    
				<select id="doctor" name="doctor" class="form-control" style="width: 450px">
                                    <option>All Doctors</option>
                                    <option>1</option>
                                    <option>2</option>
                                     <option>3</option>
				</select>
				
			</div>-->

          <div class="form-group input-group" style="margin-top: 10px; margin-left: 10px">
              <span style="width: 155px"  class="input-group-addon">Output Type</span>
           
              <select id="outtype" name="outtype" class="form-control" style="width: 450px">
                <option>HTML format</option>
                <option>PDF format</option>
		<!--<option>Excel format</option>-->
              </select>
            
          </div>
		  
                    
                 <div class="form-actions" style="margin-top: 15px;margin-left: 15px">
            <input  name="submit" type="submit"  class="btn btn-primary"  value="Show"/> 
			<button type="reset" class='btn'  onclick="history.go(-1);">Cancel</button>
          </div>
        

      </div>
	   
</div>
 
<?php echo form_close(); ?>
	   

</div>
    </div>
    </div> 
</div>
 