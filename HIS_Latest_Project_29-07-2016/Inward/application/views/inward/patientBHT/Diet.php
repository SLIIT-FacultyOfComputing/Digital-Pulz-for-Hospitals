<?php


foreach ($wardadmission as $value) {
    $patientitle = $value->patientID->patientTitle;
    $patientName = $value->patientID->patientFullName;
    $wardNo = $value->wardNo;
    $bhtNo = $value->bhtNo;
    $patientID = $value->patientID->patientID;
    $bedNo = $value->bedNo;
    $previousHistory = $value->previousHistory;
}
?>
<?php
foreach ($diet as $value) {

    $diet_id = $value->diet_id;
    $patient_id = $value->patient_id;
    $patient_diet = $value->patient_diet;
    $quantity = $value->quantity;
    $diet_category = $value->diet_category;
    $time = $value->time;
}
?>

<div class="panel panel-primary" style="width:90%">
    <div class="panel-heading" style="background-color:whitesmoke">
        <h4 class="panel-title" style="color:#428BCA">Diet Details of Patient</h4>
    </div>
    <div class="panel-body">
        <?php echo form_open('inward/patientBHTC/InsertDiet'); ?>
        <fieldset>
            <input  id="diet_id" name="diet_id" type="hidden" value="" />
            <input  id="patient_id" name="patient_id" type="hidden" value="" />
            <input  id="patient_diet" name="patient_diet" type="hidden" value="" />
            <input  id="quantity" name="quantity" type="hidden" value="" />
            <input  id="diet_category" name="diet_category" type="hidden" value="" />
            <input  id="time" name="time" type="hidden" value="" />

            <div class="form-group" style="display: none" >
                <br/>
                <label style="color: #797979;" class="col-sm-3 control-label">Diet ID:</label>
                <div class="col-xs-4">
                    <input id="patient_id" name="diet_id" class="form-control" type="text" value="1" />
                </div>
            </div>
            <br>
            <div class="form-group">
                <br/>
                <label style="color: #797979;" class="col-sm-3 control-label">Patient ID:</label>
                <div class="col-xs-4">
                    <input id="patient_id" name="patient_id" class="form-control" type="text" value="<?php echo "$patientID"; ?>" />
                </div>
            </div>
            <br>

            <div class="form-group">
                <br/>
                <label style="color: #797979;" class="col-sm-3 control-label">Patient Diet :</label>
                <div class="col-xs-4">
                    <input id="patient_diet" name="patient_diet" class="form-control" type="text" value="Brown rice or wild rice" />
                </div>
            </div>
            <br>
            <div class="form-group">
                <br/>
                <label style="color: #797979;" class="col-sm-3 control-label">Quantity of the Diet :</label>
                <div class="col-xs-4">
                    <input id="quantity" name="quantity" class="form-control" type="text" value="1 bowl"/>
                </div>
            </div>
            <br>
            <div class="form-group">
                <br/>
                <label style="color: #797979;" class="col-sm-3 control-label">Diet Category :</label>
                <div class="col-xs-4">
                    <input id="diet_category" name="diet_category" class="form-control" type="text" value="Diabetic patient diet" />
                </div>
            </div>
            <br>
            <div class="form-group">
                <br/>
                <label style="color: #797979;" class="col-sm-3 control-label">Meal Time :</label>
                <div class="col-xs-4">
                    <input id="time" name="time" class="form-control" type="text" value="Breakfast"/>
                </div>
            </div>

            <br>
            <div class="form-group">

                <input type="submit" class="btn btn-large btn-info" value="Insert Diet Details" name="btnSubmit" >
                <?php echo form_close(); ?>
                &nbsp;&nbsp;&nbsp;
            </div>      
    </div>  
</fieldset>

</div>





















