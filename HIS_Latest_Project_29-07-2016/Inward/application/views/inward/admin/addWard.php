<div class="alert alert-info" id="panel">

<section>
<!--  <form id="addward" name="addward" method="post" action="../../../controllers/inward/wardManageC.php" >-->
            <?php echo form_open('inward/wardManageC/inserWardDetails'); ?>
                <legend>Add New Ward</legend>
                <fieldset>
                    
                <div class="form-group">
                    <label for="wardNo"  class="col-sm-2 control-label">Ward No<span class="required">*</span></label>
                     <div class="col-xs-4">
                    <input id="wardNo" name="wardNo" type="text" class="form-control" value="" required="required" />
                </div>
                  
                </div>
                <div class="form-group">
                      <br/>
                    <label for="category"  class="col-sm-2 control-label">Ward Category <span class="required">*</span></label>
                     <div class="col-xs-4">
                    <input  id="category" name="category" type="text" class="form-control" value="" required="required" />
                     </div>
                </div>
                  
                <div class="form-group">
                      <br/>
                    <label for="wardGender" class="col-sm-2 control-label">Ward Type<span class="required">*</span></label>
                    <div class="col-xs-4">
                        
                       <div class="radio">
                            <label class="radio-inline">
                                <input  type="radio" name="wardGender" value="Male" required="required"/>Male
                            </label>
                       </div> 
                        
                        <div class="radio">
                            <label class="radio-inline">
                               <input  type="radio" name="wardGender" value="Female" required="required"/>Female<br />
                            </label>
                       </div> 
                       
                     </div>
                </div>
               
<!--                <div class="form-group">
                    <br/>  <br/>  <br/>
                    <label for="noOfBed" class="col-sm-2 control-label">No Of Beds<span class="required">*</span></label>
                    <div class="col-xs-4">
                    <input id="noOfBed" name="noOfBed" type="number" min="1"  class="form-control" value="" required="required"/>
                    </div>
               </div>-->
                    <br/><br/>
                <div class="form-group">
  <br/>
                      <input type="submit" class="btn btn-large btn-info " value="Create Ward" name="btnSubmit" >
                </div>
                </fieldset>
                 
                 <legend></legend>
<!--        </form>-->
        <?php //echo form_submit('action','Create New Ward'); ?>
        <?php echo form_close(); ?>     



  </section>
</div>