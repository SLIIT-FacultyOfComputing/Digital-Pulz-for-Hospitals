<?php
foreach ($wardadmission as $value) {

    $bhtNo = $value->bhtNo;
    $patientID = $value->patientID->patientID;
}
?>

<div align="left"><a href="<?php echo base_url(); ?>index.php/inward/patientBHTC/PrescriptionView/<?php echo "$bhtNo/$patientID" ?>">Add New Drug</a></div>

<div class="alert alert-warning">
    <h4>Update Drug Details</h4>
    <legend></legend>
    
</div>