<script>

    function fillAllWard(){
        //console.log(ward_no);
        
            var url = "http://localhost:8080/HIS_API/rest/Ward/getWard";
      
            $.ajax({
          
                url: url,
                success: function(result) 
                {
                    $('#ward').empty();
                    if(result.length == 0)
                        {
                             var opt = $('<option />'); 
                              opt.val('');
                              opt.text('No Wards Available');
                                $('#ward').append(opt); 
                        }
                
                    for (var i = 0; i < result.length; i++)  
                    {
                        var w =  result[i];
                        var opt = $('<option />'); 
                        //console.log(bed.bedNo);
                        opt.val(w.wardNo);
                        opt.text(w.wardNo);
                        $('#ward').append(opt); 
                    }
                } //end success
            }); //end AJAX
        
          
       
    } //end change 
    
    
    function fillMyward(user){
        //console.log(ward_no);
        
            var url = "http://localhost:8080/HIS_API/rest/HrEmployee/getEmployeesWard/"+user;
      
            $.ajax({
          
                url: url,
                success: function(result) 
                {
                    $('#ward').empty();
                    if(result.length == 0)
                        {
                             var opt = $('<option />'); 
                              opt.val('');
                              opt.text('No Wards Available');
                                $('#ward').append(opt); 
                        }
                
                    for (var i = 0; i < result.length; i++)  
                    {
                        var w =  result[i];
                        var opt = $('<option />'); 
                        //console.log(bed.bedNo);
                        opt.val(w.wardNo);
                        opt.text(w.wardNo);
                        $('#ward').append(opt); 
                    }
                } //end success
            }); //end AJAX
        
          
       
    } //end change 
</script>

<div class="panel panel-primary">
    <div class="panel-heading" style="background-color:whitesmoke"> 
        <h4 class="panel-title"  style="color:#428BCA">Ward Admission Request</h4>
    </div>
    <div class="panel-body">


        <div id="panel">
            <?php echo form_open('inward/AdmissionRequestC/RequestAdmission'); ?>


            <fieldset>

                <div class="form-group">
                    <label for="AllergyName"  class="col-sm-2 control-label">Patient ID<span class="required">*</span></label>
                    <div class="col-xs-4">
                        <input id="pid" name="pid" type="text" class="form-control" value="" required="required" />
                    </div>

                </div>
                <div class="form-group">
                    <br/> 
                    <label for="Status" class="col-sm-2 control-label">Admission Ward<span class="required">*</span></label>
                    <div class="col-xs-4">

                        <div class="radio">
                            <label class="radio-inline">
                                <input  type="radio" name="is_user_doctor" value="1" required="required" onchange="fillMyward(<?php echo  $_SESSION['EmpId']; ?>);"/>My Ward
                            </label>
                        </div> 

                        <div class="radio">
                            <label class="radio-inline">
                                <input  type="radio" name="is_user_doctor" value="0" required="required" onchange="fillAllWard();"/>Other
                            </label>
                        </div> 

                    </div>

                </div>
                <div class="form-group">
                    <br/> <br/> <br/> 
                    <label class="col-sm-2 control-label" >Transfer Ward</label>
                    <div class="col-xs-4">
                        <select   id="ward" name="ward" class="form-control" required="required">                            
                            <option id="ward" name="ward"  >--Select Ward--</option>                        

                        </select>

                    </div>
                </div> 
                <div class="form-group">
                    <br/>
                    <label for="Remark"  class="col-sm-2 control-label">Remark</label>
                    <div class="col-xs-4">
                        <textarea class="form-control" id="Remark" name="Remark" rows="3"></textarea>
                    </div>
                </div>

                
                <br/>  <br/>    <br/>  <br/>
                <div class="form-group">

                    <input type="submit" class="btn btn-large btn-info " value="Transfer Patient" name="btnSubmit" >
                </div>
            </fieldset>             
            <?php echo form_close(); ?> 
        </div>
    </div>
</div>



