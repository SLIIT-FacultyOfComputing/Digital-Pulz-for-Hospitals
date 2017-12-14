<?php
foreach ($allergyView as $value) {

    $allergyID = $value->allergyID;
    $allergyName = $value->allergyName;
    $allergyRemarks=$value->allergyRemarks;
    $allergyStatus=$value->allergyStatus;
}
?>
<?php
foreach ($wardadmission as $value) {

    $bhtNo = $value->bhtNo;
    $patientID = $value->patientID->patientID;
}
?>
<div class="container">
<div class="panel panel-primary">
    <div class="panel-heading" style="background-color:whitesmoke"> 
        <h4 class="panel-title"  style="color:#428BCA">Update Allergy Details</h4>
    </div>
    <div class="panel-body">
        
<section>
         <?php echo form_open('inward/patientBHTC/UpdateAllergyDetails/'.$bhtNo.'/'.$patientID); ?>
    <fieldset>

        <div class="form-group">
            <label style="color: #797979;" for="allergyName"  class="col-sm-2 control-label">Allergy Name<span class="required">*</span></label>
            <div class="col-xs-4">
                <input id="allergyName" name="allergyName" type="text" class="form-control" value="<?php echo $allergyName; ?>" required="required" />                
            </div>
            <br/>
            <div class="form-group">
                <br/>
                <label style="color: #797979;" for="Remark"  class="col-sm-2 control-label">Remark</label>
                <div class="col-xs-4">
                    <input id="Remark" name="Remark" type="text" class="form-control" value="<?php echo $allergyRemarks; ?>"  />
                </div>
            </div>

            <div class="form-group">
                <br/>
                <label style="color: #797979;" for="Status" class="col-sm-2 control-label">Status<span class="required">*</span></label>
                <div class="col-xs-4">

                    <?php
                    if ($allergyStatus == 'Current') {
                        ?>

                        <div class="radio">
                            <label style="color: #797979;" class="radio-inline">
                                <input  type="radio" name="Status" value="Current" required="required" checked/>Current
                            </label>
                        </div> 

                        <div class="radio">
                            <label style="color: #797979;" class="radio-inline">
                                <input  type="radio" name="Status" value="Past" required="required"/>Past<br />
                            </label>
                        </div> 
                        <?php
                    } else {
                        ?>
                        <div class="radio">
                            <label class="radio-inline">
                                <input  type="radio" name="Status" value="Current" required="required"/>Current
                            </label>
                        </div> 

                        <div class="radio">
                            <label class="radio-inline">
                                <input  type="radio" name="Status" value="Past" required="required" checked/>Past<br />
                            </label>
                        </div> 

                        <?php
                    }
                    ?>

                </div>
            </div> 

            <br/>

            <div class="form-group">
                <input id="allergyID" name="allergyID" type="hidden" class="form-control" value="<?php echo $allergyID; ?>" />
                
                <input type="submit" class="btn btn-large btn-info msgbox-confirm" value="Update Allergy Details" name="btnSubmit" >
            </div>
    </fieldset>
    <?php echo form_close(); ?>     
</section>
</div>
        </div>
        </div>
