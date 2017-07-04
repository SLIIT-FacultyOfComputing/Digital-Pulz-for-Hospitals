       
<div class="panel panel-primary" >
    <div class="panel-heading" style="background-color:whitesmoke">
        <h4 class="panel-title" style="color:#428BCA">Internal Transfer Admissions</h4>
    </div>
    <div class="panel-body">

        <table style="width: 100%;" class="table table-hover">
            <thead>
                <tr>

                    <th style="text-align: center; ">BHT No</th>
                    <th style="text-align: center; ">Patient ID</th>
                    <th style="text-align: center; ">Patient Name</th>
                    <th style="text-align: center; ">Transfer From Ward</th>
                    <th style="text-align: center; ">Transfer To Ward</th>
                    <th style="text-align: center; ">Transfer Date Time</th>			
                    <th style="text-align: center; "></th>


                </tr>
            </thead>
            <?php
            date_default_timezone_set("Asia/Colombo");
            foreach ($transfer as $value) {
                ?>

                <tr style="text-align: center; ">

                    <td><?php echo $value->bhtNo->bhtNo; ?></td>
                    <td><?php echo $value->bhtNo->patientID->patientID; ?></td>
                    <td><?php echo $value->bhtNo->patientID->patientFullName; ?></td>
                    <td><?php echo $value->transferFromWard->wardNo; ?></td>
                    <td><?php echo $value->transferWard->wardNo; ?></td>
                    <td><?php echo date("Y-m-d ", $value->transferCreatedDate / 1000); ?>&nbsp;
                     <?php echo date("h:ia ", $value->transferCreatedDate / 1000); ?></td>

                    <td>
                        <?php echo form_open('inward/transferAdmissionC/transferView'); ?>
                        <input type="hidden" id="tranferId" name="tranferId" value="<?php echo $value->transferId; ?>" />
                        <button type="submit" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="View">
                            <span   class="glyphicon glyphicon-search">View</span>
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

