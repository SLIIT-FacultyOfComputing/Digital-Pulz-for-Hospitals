<div class="alert alert-warning">
     <a href="#" class="close" data-dismiss="alert">
      &times;
   </a>
<section>
            <?php echo form_open('inward/wardManageC/UpdateBedDetails'); ?>
                <legend>Update Bed Details</legend>
                <fieldset>
                    
             <div class="row"> 
                   <input id="bedID" name="bedID" type="hidden" value="<?php echo $bedID; ?>">
                    <input id="wardNo" name="wardNo" type="hidden" value="<?php echo $wardNo; ?>">
                     <input id="availability" name="availability" type="hidden" value="<?php echo $availability; ?>">
                    <input id="patientID" name="patientID" type="hidden" value="<?php echo $patientID; ?>">
                   
               
                <div class="form-group">
                      
                    <label style="color: #797979;" for="bedNo"  class="col-sm-2 control-label">Bed No</label>
                     <div class="col-xs-2">
                    <input id="bedNo" name="bedNo" type="number" min="1" class="form-control" value="<?php echo $bedNo; ?>" required="required" />
                     
                     </div>
                </div>
               
                 <div class="form-group">
                      <br/>
                    <label style="color: #797979;" for="bedType"  class="col-sm-2 control-label">Bed Type</label>
                     <div class="col-xs-2">
                    <input id="bedType" name="bedType" type="text" class="form-control" value="<?php echo $bedType; ?>" required="required" />
                    <br/>   
                    <input type="submit" class="btn btn-large btn-info msgbox-confirm" value="Update" name="btnSubmit" >
           
                     </div>
                   
                   
                </div>
               
             
               </fieldset>

        <?php echo form_close(); ?>     



  </section>
</div>
