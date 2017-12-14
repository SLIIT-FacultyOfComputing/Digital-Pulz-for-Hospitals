

<div class="panel panel-primary" >
    <div class="panel-heading" style="background-color:whitesmoke">
        <h4 class="panel-title" style="color:#428BCA">Diet Allocation</h4>
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

                        <th  style="text-align: center;" >Patient Diet Category</th>
                        <th  style="text-align: center;">Meal Time</th>
                        <th  style="text-align: center;">Diet</th>
                        <th  style="text-align: center;">Status</th>
                        <th  style="text-align: center;" colspan="1"></th>


                    </tr>
                </thead>
                <?php
                foreach ($diet as $val) {
                    ?>
                    <tr style="text-align: center; background-color: lightsalmon">

                        <td style=" vertical-align: middle"><?php echo $val->diet_category; ?></td>
                        <td style=" vertical-align: middle"><?php echo $val->time; ?></td>
                        <td style=" vertical-align: middle"><?php echo $val->patient_diet; ?></td>
                        <td style=" vertical-align: middle"><?php echo $val->status; ?></td>



                        <td style=" vertical-align: middle">
                            <?php if ($dischjType == "none") {?>
                            <?php echo form_open('inward/patientBHTC/InsertDiet'); ?>
                            <input type="hidden" id="patient_id" name="patient_id" value="<?php echo $val->patient_id; ?>" />
                            <input type="hidden" id="patient_diet" name="patient_diet" value="<?php echo $val->patient_diet ?>" />
                            <input type="hidden" id="quantity" name="quantity" value="<?php echo $val->quantity; ?>" />
                            <input type="hidden" id="patient_diet" name="diet_category" value="<?php echo $val->patient_diet; ?>" />
                            <input type="hidden" id="quantity" name="time" value="<?php echo $val->quantity; ?>" />
                            <input type="hidden" id="status" name="status" value="Given to the patient" />
                            
                            
                            
                            <button type="submit" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Diet Has Given">
                                <span  class="glyphicon glyphicon-pencil">Diet Given</span>
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