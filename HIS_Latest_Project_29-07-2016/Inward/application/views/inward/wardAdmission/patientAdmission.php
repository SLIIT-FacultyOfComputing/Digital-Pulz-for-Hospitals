<script>

    function loadBeds(ward_no){
        //console.log(ward_no);
        if (ward_no != ""){
            var url = "http://localhost:8080/HIS_API/rest/Bed/getFreeBedByWardNo/"+ward_no;
      
            $.ajax({
          
                url: url,
                success: function(result) 
                {
                    $('#bedNo').empty();
                    
                            
                
                    for (var i = 0; i < result.length; i++)  
                    {
                        var bed =  result[i];
                        var opt = $('<option />'); 
                        //console.log(bed.bedNo);
                        opt.val(bed.bedNo);
                        opt.text('Bed - '+bed.bedNo);
                        $('#bedNo').append(opt); 
                    }
                    
                     var opt = $('<option />'); 
                              opt.val('-99');
                              opt.text('None Bed Allocation');
                                $('#bedNo').append(opt); 
                       
                } //end success
            }); //end AJAX
        } else {
            $('#bedNo').empty();
      
        }//end if
    } //end change 
    
    
    function loadDoctors(designature){
       
        
        var wardNo=document.getElementById("wardNo").value ;
         console.log(designature);
                 
        if (designature != ""){
            var url = "http://localhost:8080/HIS_API/rest/HrEmployee/getEmployeesByDeptDesig/"+wardNo+"/"+designature;
      
            $.ajax({
          
                url: url,
                success: function(result) 
                {
                    $('#DoctorID').empty();
                    if(result.length == 0)
                        {
                             var opt = $('<option />'); 
                              opt.val('');
                              opt.text('No Doctor Available');
                                $('#DoctorID').append(opt); 
                        }
                
                    for (var i = 0; i < result.length; i++)  
                    {
                        var doc =  result[i];
                        var opt = $('<option />'); 
                        //console.log(doc[1]);
                        opt.val(doc[0]);
                        //   console.log(doc[2]);
                         //  console.log(doc[3]);
                        opt.text(doc[1]+' '+doc[2]+' '+doc[3]);
                        $('#DoctorID').append(opt); 
                    }
                } //end success
            }); //end AJAX
        } else {
            $('#DoctorID').empty();
      
        }//end if
           
       
    } //end change 
</script>
<div class="container">
<div class="panel panel-default">

    <?php echo form_open('inward/wardAdmissionC/InsertwardAdmission'); ?>
    <legend>&nbsp;&nbsp;&nbsp; New Ward Admission</legend>
    <fieldset>
        <input id="patientID" name="patientID" type="hidden" class="text" value="<?php echo $pid ?>" />


        <div class="form-group">

            <label style="color: #797979;"  for="wardNo" class="col-sm-2 control-label">Ward No</label>
            <div class="col-xs-4">
<!--                <input  id="wardNo" name="wardNo" type="text" class="form-control" value="" required="required" />-->
                <select  id="wardNo" name="wardNo" class="form-control" required="required" onchange="loadBeds(this.value)">

                    <option>---Select Ward---</option>
               

                    <?php
                    foreach ($Wards as $value) {
                        ?>

                        <option id="wardNo" name="wardNo" value="<?php echo $value->wardNo; ?>"> <?php echo $value->wardNo; ?></option>

                            <?php
                        }
                        ?>
             
                </select>


            </div>
        </div>


        <div class="form-group">
            <br/>
            <label style="color: #797979;"   class="col-sm-2 control-label" for="bedNo">Bed No</label>
            <div class="col-xs-4">
                <select  id="bedNo" name="bedNo" type="text" class="form-control" id="bedNo_label" value="" required="required" >
                    <option value=""></option>
                </select>
            </div>
        </div> 
        
        <div class="form-group">
            <br/>
            <label style="color: #797979;"   class="col-sm-2 control-label" for="Designation">Designation</label>
            <div class="col-xs-4">
                <select  id="Designation" name="Designation" type="text" class="form-control" id="bedNo_label" value="" onchange="loadDoctors(this.value)" required="required" >
                          <option>---Select Designation---</option>     
 <?php
                              
                    for ($i=0;$i<sizeof($designature);$i++) {
                        ?>

                        <option id="Designation" name="Designation" value="<?php echo $designature[$i][0]; ?>" > <?php echo $designature[$i][1]; ?></option>

    <?php
}
?>
                </select>
            </div>
        </div> 


        <div class="form-group">
            <br/>
            <label style="color: #797979;"   class="col-sm-2 control-label" for="DoctorID">Consultant's Name</label>
            <div class="col-xs-4">
    <!--        <input id="DoctorID" name="DoctorID" type="text" class="form-control" value="" required="required" />-->
    <!--        <input list="Doctor" id="DoctorID" name="DoctorID" class="form-control" required="required">-->
                <select  id="DoctorID" name="DoctorID" class="form-control" required="required">


                    <!--        <datalist id="Doctor">-->

                    <?php
                   // foreach ($doctor as $value) {
                        ?>

                    <option value=""> </option>

    <?php
//}
?>
                    <!--       </datalist>-->
                </select>

            </div>
        </div> 



        <div class="form-group">
            <br/>
            <label style="color: #797979;"   class="col-sm-2 control-label" for="admitDateTime">Admitted Date Time </label>
            &nbsp;&nbsp;<label style="color: #797979;"   class="col-sm-4 control-label" for="admitDateTime">Date format as dd/mm/yy </label>
            <br/>
            <br/>
       
           
            <div class="nirmani">
                <input id="admitDateTime" name="admitDateTime" class="form-control" type="datetime-local" value="" required="required" />
                
                
            
            </div>
        </div> 


        <div class="form-group">
            <br/>
            <label style="color: #797979;"   class="col-sm-2 control-label" for="patientComplain">Patient Complain</label>
            <div class="col-xs-4">
                <input id="patientComplain" name="patientComplain" class="form-control" type="text"  value="" />
            </div>
        </div> 

        <div class="form-group">
            <br/>
            <label style="color: #797979;"  class="col-sm-2 control-label" for="previousHistory">Previous History</label>
            <div class="col-xs-4">
                <input id="previousHistory" name="previousHistory" type="text" class="form-control" value=""  />
            </div>
        </div> 


        <div class="form-group">
            <br/>&nbsp;&nbsp;&nbsp;
            <input type="submit" class="btn btn-large btn-info" value="Admit Patient" name="btnSubmit" >
        </div>  
    </fieldset>


<?php echo form_close(); ?>  
</div>
</div>