       
<div class="panel panel-primary" >
    <div class="panel-heading" style="background-color:whitesmoke">
        <h4 class="panel-title" style="color:#428BCA">Ward Admission Requests</h4>
    </div>
    <div class="panel-body">

        <table style="width: 100%;" class="table table-hover">
            <thead>
                <tr>                   
                    <th style="text-align: center; ">Patient ID</th>
                    <th style="text-align: center; ">Patient Name</th>
                    <th style="text-align: center; ">Transfer Unit</th>
                    <th style="text-align: center; ">Admission Ward</th>
                    <th style="text-align: center; ">Transfer Date Time</th>			
                    <th style="text-align: center; "></th>


                </tr>
            </thead>
            <?php
            date_default_timezone_set("Asia/Colombo");
            foreach ($requestAdmit as $value) {
                ?>

                <tr style="text-align: center; ">

                 
                    <td><?php echo $value->patient_id->patientID; ?></td>
                    <td><?php echo $value->patient_id->patientFullName; ?></td>
                    <td><?php echo $value->request_unit; ?></td>
                    <td><?php echo $value->transfer_ward->wardNo; ?></td>
                    <td><?php echo date("Y-m-d ", $value->create_date_time / 1000); ?>&nbsp;
                        <?php echo date("h:ia ", $value->create_date_time / 1000); ?></td>

                    <td>
                        <?php echo form_open('inward/transferAdmissionC/AdmissionRequestView'); ?>
                        <input type="hidden" id="auto_id" name="auto_id" value="<?php echo $value->auto_id; ?>" />
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

