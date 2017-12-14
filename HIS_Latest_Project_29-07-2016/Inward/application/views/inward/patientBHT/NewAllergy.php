<?php
foreach ($wardadmission as $value) {
    $bhtNo = $value->bhtNo;
    $patientID = $value->patientID->patientID;
}
?>

<div class="panel panel-primary">
    <div class="panel-heading" style="background-color:green"> 
        <h4 class="panel-title"  style="color:#428BCA">Add New Allergy</h4>
    </div>
    <div class="panel-body">
        

        <div id="panel">
 <?php echo form_open('inward/patientBHTC/AddAllergyView/'.$bhtNo.'/'.$patientID); ?>
             
                
                    <fieldset>

                        <div class="form-group">
                            <label for="AllergyName"  class="col-sm-2 control-label">Allergy Name<span class="required">*</span></label>
                            <div class="col-xs-4">
                                <input id="AllergyName" name="AllergyName" type="text" class="form-control" value="" required="required" />
                            </div>

                        </div>
                        <div class="form-group">
                            <br/>
                            <label for="Remark"  class="col-sm-2 control-label">Remark<span class="required">*</span></label>
                            <div class="col-xs-4">
                                <input  id="Remark" name="Remark" type="text" class="form-control" value="" required="required" />
                            </div>
                        </div>

                        <div class="form-group">
                            <br/>
                            <label for="Status" class="col-sm-2 control-label">Status<span class="required">*</span></label>
                            <div class="col-xs-4">

                                <div class="radio">
                                    <label class="radio-inline">
                                        <input  type="radio" name="Status" value="Current" required="required"/>Current
                                    </label>
                                </div> 

                                <div class="radio">
                                    <label class="radio-inline">
                                        <input  type="radio" name="Status" value="Past" required="required"/>Past<br />
                                    </label>
                                </div> 

                            </div>

                        </div>
<br/>
                        <div class="form-group">
                            
                            <input type="submit" class="btn btn-large btn-info " value="Insert Allergy" name="btnSubmit" >
                        </div>
                    </fieldset>             
            <?php echo form_close(); ?> 
        </div>
    </div>
</div>

       

