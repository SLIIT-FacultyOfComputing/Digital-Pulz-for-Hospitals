

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

<div class="container">


<div class="panel panel-primary" style="width:90%">
    <div class="panel-heading" style="background-color:whitesmoke;width:80">

        <h3 class="panel-title" style="color:#428BCA">
            <div class="row">
                <div class="col-xs-6 col-sm-4"> <b>Ward No : <?php echo $wardNo; ?> </b> </div>
                <div class="col-xs-6 col-sm-4"> <b>Ward Category : <?php echo $category; ?> </b> </div>
                <div class="col-xs-6 col-sm-4"> <b>Ward Type : <?php echo $gender; ?>  </b> </div>

            </div>

        </h3>

    </div>
    <div class="panel-body">
        <table style="width: 100%; text-align: center;" class="table table-hover " >
            <col style="width: 20%;">
            <col style="width: 20%;">
            <col style="width: 20%;">
            <col style="width: 20%;">
            <col style="width: 10%;">
            <col style="width: 10%;">




            <thead>
                <tr >


                    <th style="text-align: center;">Bed No</th>
                    <th style="text-align: center;">Bed Type</th>
                    <th style="text-align: center;">BHT No</th>
                    <th style="text-align: center;">Patient ID</th>
                    <th style="text-align: center;">Availability</th>
                    <th style="text-align: center;"></th>



                </tr>
            </thead>
            <?php
            foreach ($beds as $value) {
                ?>
                <tr style="text-align: center; height: 26px; " >


                    <td style=" vertical-align: middle"><?php echo $value->bedNo; ?></td>
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
                            echo $value->patientID->patientID;
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
                    <td>
                        <?php
                        if (!($value->availability == 'free')) {
                            ?>
                            <?php echo form_open('inward/MyWardsC/updateBedView'); ?>
                            <input name="bhtno" id="bhtno" type="hidden" value="<?php echo $value->availability ?>" >
                            <input name="ward" id="ward" type="hidden" value="<?php echo $wardNo; ?>" >
                            <input name="bed" id="bed" type="hidden" value="<?php echo $value->bedNo; ?>" >
                            <input name="pid" id="pid" type="hidden" value="<?php echo $value->patientID->patientID; ?>" >

                            <button  type="submit" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Allocate Bed">
                                <span class="glyphicon glyphicon-edit">Change Bed</span>
                            </button>
                            <?php
                            echo form_close();
                        }
                        ?>  
                    </td>




                </tr> 

                <?php
            }
            ?>
        </table>
    </div>
</div>

<!-- none allocate patient admission-->
<?php if ($nobedsList != NULL) { ?>
    <div class="panel panel-primary" style="width:90%">
        <div class="panel-heading" style="background-color:whitesmoke">

            <h3 class="panel-title" style="color:#428BCA">
                <div class="row">
                    <div class="col-xs-6 col-sm-12"> <b>None Bed Allocated Patients  </b> </div>


                </div>

            </h3>

        </div>
        <div class="panel-body">
            <table style="width: 100%; text-align: center;" class="table table-hover " >
                <col style="width: 20%;">
                <col style="width: 20%;">
                <col style="width: 20%;">
                <col style="width: 20%;">
                <col style="width: 10%;">
                <col style="width: 10%;">




                <thead>
                    <tr >
                        <th style="text-align: center;">No</th>         
                        <th style="text-align: center;">BHT No</th>
                        <th style="text-align: center;">Patient ID</th>
                        <th style="text-align: center;">Patient Name</th>
                        <th style="text-align: center;"></th>
                        <th style="text-align: center;"></th>
                    </tr>
                </thead>
                <?php
                $cou = 0;
                foreach ($nobedsList as $value) {
                    $cou = $cou + 1;
                    ?>
                    <tr style="text-align: center; height: 26px; " >


                        <td style=" vertical-align: middle"><?php echo $cou; ?></td>
                        <td style=" vertical-align: middle"><?php echo $value->bhtNo; ?></td>
                        <td style=" vertical-align: middle">
                            <?php echo $value->patientID->patientID; ?>
                        </td>
                        <td style=" vertical-align: middle">
                            <?php echo $value->patientID->patientFullName; ?>
                        </td>

                        <td style=" vertical-align: middle">

                            <button  type="button" onclick="loadBHT(<?php echo $value->bhtNo ?>,<?php echo $value->patientID->patientID; ?>);" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Open Patient BHT">
                                <span class="glyphicon glyphicon-new-window">Open BHT</span>
                            </button>


                        </td>
                        <td>
                            <?php echo form_open('inward/MyWardsC/updateBedView'); ?>
                            <input name="bhtno" id="bhtno" type="hidden" value="<?php echo $value->bhtNo; ?>" >
                            <input name="ward" id="ward" type="hidden" value="<?php echo $wardNo; ?>" >
                            <input name="bed" id="bed" type="hidden" value="<?php echo "-99"; ?>" >
                           <input name="pid" id="pid" type="hidden" value="<?php echo $value->patientID->patientID; ?>" >

                            <button  type="submit" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Allocate Bed">
                                <span class="glyphicon glyphicon-edit">Allocate Bed</span>
                            </button>
                            <?php echo form_close(); ?>  
                        </td>

                    </tr> 
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>
<?php } ?>