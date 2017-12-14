<script>
    function loadBHT(bhtNo,patient)
    {
        window.open("<?php echo base_url(); ?>index.php/inward/patientBHTC/BHT/"+bhtNo+"/"+patient);
    }
</script>

<?php
foreach ($wards as $value) {
    $wardNo = $value->wardNo;
    $category = $value->category;
    $gender = $value->wardGender;
}
?> 


<div class="panel panel-primary">
    <div class="panel-heading" style="background-color:whitesmoke">

        <h3 class="panel-title" style="color:#428BCA">
            <div class="row">
                <div class="col-xs-6 col-sm-4"> <b>Ward No : <?php echo $wardNo; ?> </b> </div>
                <div class="col-xs-6 col-sm-4"> <b>Ward Category : <?php echo $category; ?> </b> </div>
                <div class="col-xs-6 col-sm-4"> <b>Ward Type : <?php echo $gender; ?>  </b> </div>

            </div>

        </h3>

    </div>
    
   
    <div class="panel-body">
        <?php echo form_open('inward/wardManageC/Ward'); ?>
        <input type="hidden" id="wardNo" name="wardNo" value="<?php echo $value->wardNo; ?>" />
        <button type="submit" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Add New Bed">
            <span class="glyphicon glyphicon-plus"><strong> Add </strong></span>
        </button>

        <?php echo form_close(); ?>

        <br/>
        <table style="width: 100%;" class="table table-hover">
            <col style="width: 20%;">
            <col style="width: 20%;">
            <col style="width: 20%;">
            <col style="width: 10%;">
            <col style="width: 6%;">
            <col style="width: 6%;">


            <thead>
                <tr>


                    <th style="text-align: center;">Bed No</th>
                    <th style="text-align: center;">Bed Type</th>
                    <th style="text-align: center;">BHT No</th>
                    <th style="text-align: center;">Availability</th>
                    <th style="text-align: center;"  colspan="2"></th>



                </tr>
            </thead>
            <?php
            foreach ($beds as $value) {
                ?>
                <tr style="text-align: center;  ">


                    <td style=" vertical-align: middle"><?php echo "Bed $value->bedNo"; ?></td>
                    <td style=" vertical-align: middle"><?php echo $value->bedType; ?></td>


                    <td style=" vertical-align: middle">
                        <?php
                        if (!($value->availability == 'free')) {
                            echo $value->availability;
                        } else {
                            echo "-";
                        }
                        ?>

                    </td>
                   
                    <td style=" vertical-align: middle">

                        <?php
                        if (!($value->availability == 'free')) {
                            ?>

                            <button  type="button" onclick="loadBHT(<?php echo $value->availability ?>,<?php echo $value->patientID->patientID; ?>);" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Open Patient BHT">
                                <span class="glyphicon glyphicon-new-window">Open BHT</span>
                            </button>

                            <?php
                        } else {
                            echo "Available";
                        }
                        ?>

                    </td>


                    <td style=" vertical-align: middle">
                        <?php echo form_open('inward/wardManageC/UpdateBedView'); ?>
                        <input type="hidden" id="wardNo" name="wardNo" value="<?php echo $value->wardNo->wardNo; ?>" />
                        <input type="hidden" id="bedID" name="bedID" value="<?php echo $value->bedID; ?>" />
                        <input type="hidden" id="bedNo" name="bedNo" value="<?php echo $value->bedNo; ?>" />
                        <input type="hidden" id="bedType" name="bedType" value="<?php echo $value->bedType; ?>" />
                        <?php if($value->availability == 'free'){ ?>
                        <input type="hidden" id="patientID" name="patientID" value="<?php echo "0"; ?>" />
                        <?php }else{
                          ?>  
                         <input type="hidden" id="patientID" name="patientID" value="<?php echo $value->patientID->patientID; ?>" />
                            <?php
                        }
                        ?>
                       
                        <input type="hidden" id="availability" name="availability" value="<?php echo $value->availability; ?>" />
                        <button type="submit"  class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Edit">
                            <span class="glyphicon glyphicon-pencil">Edit</span>
                        </button>

                        <?php echo form_close(); ?>
                    </td>


                    <td style=" vertical-align: middle">
                        <?php echo form_open('inward/wardManageC/RemoveBed'); ?>
                        <input type="hidden" id="bedID" name="bedID" value="<?php echo $value->bedID; ?>" />
                        <input type="hidden" id="wardNo" name="wardNo" value="<?php echo $value->wardNo->wardNo; ?>" />
                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure want to delete the Bed?');" data-toggle="tooltip" data-placement="top" title="Delete">
                            <span class="glyphicon glyphicon-trash">Delete</span>
                        </button>    

                        <?php echo form_close(); ?>
                        <?php //echo anchor('inward/wardManageC/RemoveWard/'.$item['wardNo'],'Delete');  ?>

                    </td>


                </tr> 

                <?php
            }
            ?>
        </table>
    </div>
</div>
