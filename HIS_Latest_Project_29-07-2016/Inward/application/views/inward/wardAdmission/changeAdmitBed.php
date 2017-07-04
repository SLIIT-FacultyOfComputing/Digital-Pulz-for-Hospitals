
<div class="panel panel-info" id="panel">
    <div class="panel-heading" style="height: 125px;">
        <h4 class="panel-title"  >
            <b>
                BHT No : <?php echo $BHT; ?>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; 
                <?php echo $ward; ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <?php
                if ($bed == "-99") {
                    echo "None Bed Allcation Patient ";
                } else {
                    ?>
                    Bed No :  <?php echo $bed; ?>

                <?php } ?>


            </b>
        </h4>
        <hr/>
       

        <?php echo form_open('inward/MyWardsC/ChangeBed'); ?>



        <fieldset>

            <div class="form-group">
                <label for="newbed"  class="col-sm-1 control-label">Bed No : </label>
                <div class="row">
                    <div class="col-xs-4">
                        <select id="bedNo" name="bedNo" type="text" class="form-control" value="" required="required" >
                            <?php
                            foreach ($freeBedList as $val) {
                                ?>

                                <option  id="bedNo" name="bedNo" value="<?php echo $val->bedNo; ?>"> <?php echo "Bed -" . $val->bedNo; ?></option>

                                <?php
                            }
                            ?>  
                            <?php if ($bed != "-99") { ?>
                                <option  id="bedNo" name="bedNo" value="-99"> <?php echo "None Bed Allocation"; ?></option>
                            <?php } ?>
                        </select>

                    </div>
                    <div class="col-xs-4">
                        <input name="bhtno" id="bhtno" type="hidden" value="<?php echo $BHT; ?>" >
                         <input name="ward" id="ward" type="hidden" value="<?php echo $ward; ?>" >
                         <input name="old" id="old" type="hidden" value="<?php echo $bed; ?>" >
                           <input name="pid" id="pid" type="hidden" value="<?php echo $pid; ?>" >
                        <input type="submit" class="btn btn-large btn-info " value="Change Bed" name="btnSubmit" >
                    </div>
                </div>
                 </div>
        </fieldset>  
   
    <?php echo form_close(); ?> 
</div>
</div>
