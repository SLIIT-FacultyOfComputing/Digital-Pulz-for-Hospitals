<?php echo form_open('inward/PrescrptionC/ChangeDrug'); ?>
<input name="auto_id" id="auto_id" type="hidden" value="<?php echo $auto_id ?>" >
<input name="Term_id" id="Term_id" type="hidden" value="<?php echo $Term_id; ?>" >
<input name="bht_no" id="bhtno" type="hidden" value="<?php echo $bht_no; ?>" >
<input name="patient_id" id="patientID" type="hidden" value="<?php echo $patient_id; ?>" >
<input name="change" id="change" type="hidden" value="<?php echo $change ?>" >

<?php
if ($change == "item") {
    $kk = new PrescrptionC();
    $itmsList = $kk->getPrescrptionItemsByTermID($Term_id);

    foreach ($itmsList as $item) {
        if ($item->auto_id == $auto_id) {
            $dose = $item->dose;
            $frq = $item->frequency;
            $drugName = $item->drug_id->dName;
            $DrugID = $item->drug_id->dSrNo;
        }
    }
} elseif ($change == "temp") {
    $kk = new PrescrptionC();
    $itmsList = $kk->getPrescrptionTempsByTermID($Term_id);

    foreach ($itmsList as $item) {
        if ($item->auto_id == $auto_id) {
            $dose = $item->dose;
            $frq = $item->frequency;
            $drugName = $item->drug_id->dName;
            $DrugID = $item->drug_id->dSrNo;
        }
    }
}
?>
<div class="form-group">
    <br/>
    <label for="category"  class="col-sm-3 control-label">Drug </label>
    <div class="col-xs-4">
        <input  type="text" class="form-control" value="<?php echo $drugName; ?>" readonly />
        <input name="DrugID" id="DrugID" type="hidden" value="<?php echo $DrugID ?>" >
    </div>
</div>
<div class="form-group">
    <br/>
    <label style="color: #797979;"   class="col-sm-3 control-label" >Dose</label>
    <div class="col-xs-4">
        <select   id="Dose" name="Dose" class="form-control" required="required">
            <option id="Dose" name="Dose"  value="<?php echo $dose; ?>"><?php echo $dose; ?></option>
            <?php if ($dose != "1") { ?>
                <option id="Dose" name="Dose"  value="1">1</option>
            <?php } ?>
            <?php if ($dose != "2") { ?>
                <option id="Dose" name="Dose"  value="2">2</option>
            <?php } ?>
            <?php if ($dose != "3") { ?>
                <option id="Dose" name="Dose"  value="3">3</option>
            <?php } ?>



        </select>

    </div>
</div> 
<div class="form-group">
    <br/>
    <label style="color: #797979;"   class="col-sm-3 control-label" >Frequency</label>
    <div class="col-xs-4">
        <select   id="Frequency" name="Frequency" class="form-control" required="required">

            <option id="Frequency" name="Frequency"  value="<?php echo $frq; ?>"><?php echo $frq; ?></option>
            <?php if ($frq != "Once a Day") { ?>
                <option id="Frequency" name="Frequency"  value="Once a Day">Once a Day</option>
            <?php } ?>
            <?php if ($frq != "Twice a Day") { ?>
                <option id="Frequency" name="Frequency"  value="Twice a Day">Twice a Day</option>
            <?php } ?>
            <?php if ($frq != "Thrice a Day") { ?>
                <option id="Frequency" name="Frequency"  value="Thrice a Day">Thrice a Day</option>
            <?php } ?>





        </select>

    </div>
</div> 
<br/><br/>
<div class="row">
    <div class="col-md-5"></div>
    <div class="col-md-1">
        <button  type="submit" class="btn btn-success " data-toggle="tooltip" data-placement="top" title="Save ">
            <span class=" glyphicon glyphicon-check">Save</span>
        </button>
        <?php echo form_close(); ?>
    </div>
    <div class="col-md-6">
        <?php echo form_open('inward/PrescrptionC/prescribeDurg/' . $bht_no . '/' . $patient_id); ?>

        <button  type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Prescribe Drugs">
            <span class="glyphicon glyphicon-remove-circle">Cancel</span>
        </button>
        <?php echo form_close(); ?>
    </div>
</div>





