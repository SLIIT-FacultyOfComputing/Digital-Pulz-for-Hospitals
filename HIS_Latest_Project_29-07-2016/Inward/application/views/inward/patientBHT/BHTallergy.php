<?php
foreach ($wardadmission as $value) {

    $bhtNo = $value->bhtNo;
    $patientID = $value->patientID->patientID;
}
?>
<div class="panel panel-primary" >
    <div class="panel-heading" style="background-color:whitesmoke">
        <h4 class="panel-title" style="color:#428BCA">Patient Allergies</h4>
    </div>
    <div class="panel-body">
        <div class="tables">
            <!--class="table table-bordered table-striped table-hover" -->
            <table style="width: 100%;"   class="table table-hover table table-striped" >
                <col style="width: 22%;">
                <col style="width: 23%;">
                <col style="width: 23%;">
              <!--  <col style="width: 23%;">-->
                <col style="width: 3%;">



                <thead>
                    <tr >

                        <th  style="text-align: center;" >Allergy Name</th>
                        <th  style="text-align: center;">Status</th>
                        <th  style="text-align: center;">Remark</th>
                        <th  style="text-align: center;" colspan="1"></th>


                    </tr>
                </thead>
                <?php
                foreach ($allergies as $val) {
                    ?>
                    <tr style="text-align: center;  ">

                        <td style=" vertical-align: middle"><?php echo $val->allergyName; ?></td>
                        <td style=" vertical-align: middle"><?php echo $val->allergyStatus; ?></td>
                        <td style=" vertical-align: middle"><?php echo $val->allergyRemarks; ?></td>




                        <td style=" vertical-align: middle">
                            <?php if ($dischjType == "none") {?>
                            <?php echo form_open('inward/patientBHTC/UpdateAllergy/' . $bhtNo . '/' . $patientID); ?>
                            <input type="hidden" id="allergyid" name="allergyid" value="<?php echo $val->allergyID; ?>" />
                            <input type="hidden" id="bhtNo" name="bhtNo" value="<?php echo $bhtNo; ?>" />
                            <input type="hidden" id="patientID" name="patientID" value="<?php echo $patientID; ?>" />

                            <button type="submit" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Edit">
                                <span  class="glyphicon glyphicon-pencil">Edit</span>
                            </button>
                            <?php echo form_close(); 
                            }?>
                            
                        </td>
                    </tr> 

                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>