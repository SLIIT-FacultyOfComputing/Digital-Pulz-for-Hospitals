
<script>
    $('document').ready(function() {

        $('#tbl1').dataTable({
            "dom": 'T<"clear">lfrtip',
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 2,2 ] } //Disbale sorting on these colums - Dush
            ]
        });
        $('#tbl2').dataTable({
            "dom": 'T<"clear">lfrtip',
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 8,8 ] } //Disbale sorting on these colums - Dush
            ]
        });

            $('#LabTypeBtn').click(function() {
            var type = $('#LabType').val();
            var LabData = []
            LabData.push(type);
            if (LabData !== '')
            {
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url();?>sample_centre_manager/addSampleCenterType',
                    data: {'LabData': LabData},
                    success: function(output) {
                            alert("Sample Center Type is Added Successfuly !");
                            window.location.href = "<?php echo base_url();?>sample_centre_manager/";
                    }
                });
            }
        });


            $('#AddSCBtn').click(function() {
            var Tp = $("#TypeDropDown").children(":selected").attr("id");
            var LabName = $('#labName').val();
            var Incharge = $('#labIncharge').val();
            var Location = $('#location').val();
            var email = $('#email').val();
            var contact1 = $('#Contact1').val();
            var contact2 = $('#Contact2').val();


            var LabData = []

            LabData.push(Tp);
            LabData.push('1');
            LabData.push(LabName);
            LabData.push(Incharge);
            LabData.push(Location);
            LabData.push(email);
            LabData.push(contact1);
            LabData.push(contact2);
            if (LabData != '')
            {
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url();?>sample_centre_manager/addSampleCenter',
                    data: {'LabData': LabData},
                    success: function(output) {
                            alert("Sample Center is Added successfuly");
                            window.location.href = "<?php echo base_url();?>sample_centre_manager/";
                    }



                });
            }




        });



    });
</script>
<style>
    .add_button {
        padding: 0 0 10px 0;
    }
    .form-horizontal .control-label{
        text-align:left;
    }
</style>

<div class="col-xs-12">

<div class="box box-primary">
   <div class="box-header" data-toggle="tooltip" title=""> 

    <div class="nav-tabs-custom">
        
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Sample Center Types</a></li>
            <li><a href="#tab_2" data-toggle="tab">Sample Centers</a></li>
        </ul>
      
        <div class="tab-content">
            
            <div class="tab-pane active" id="tab_1">

                <div class="add_button pull-right">
                    <a href="#AddType" target="_blank" id="NewTypeBtn" class="updtCat" data-toggle='modal'> <button id="Btn01" value=""  class='btn btn-primary' title='Edit' data-toggle='tooltip' data-placement='right  ' ><!--span class="glyphicon glyphicon-plus"></span-->  Add New Sample Center Type</button></a>
                </div>

                <table id="tbl1" class="table table-bordered table-hover" cellspacing="0">

                <thead>
                <tr>
                    <th>Sample center Type ID</th>
                    <th>sample center Type Name</th>
                    <th></th>
                </tr>
                </thead>
          
                <tbody>
                <?php
                date_default_timezone_set("Asia/Colombo");
                foreach ($SSTypes as $value) {
                ?>
                <tr id="<?php echo $value->sampleCenterType_ID; ?>">
                    <td><?php echo $value->sampleCenterType_ID; ?></td>
                    <td><?php echo $value->sample_Center_TypeName; ?></td>

                    <td> <a href='<?php echo base_url(); ?>sample_centre_manager/UpdateSampleCenterTypes/SCID/<?php echo $value->sampleCenterType_ID; ?>/type/<?php echo $value->sample_Center_TypeName; ?>' id="<?php echo $value->sampleCenterType_ID; ?>" class="updtCat" data-toggle='modal'> <button id="<?php echo $value->sampleCenterType_ID; ?>" value=""  class='btn btn-primary' title='Edit' data-toggle='tooltip' data-placement='right  ' ><!--span class="glyphicon glyphicon-edit"></span--> Edit</button></a></td>
                    </tr>

                <?php
                }
                ?>
                </tbody>
            
                </table>

            </div><!-- /.tab-pane1 -->
        

            <div class="tab-pane" id="tab_2">

                <div class="add_button pull-right">
                    <a href="#AddLab" target="_blank" id="NewTypeBtn" class="updtCat" data-toggle='modal'> <button id="Btn03" value=""  class='btn btn-primary' title='Edit' data-toggle='tooltip' data-placement='right  ' ><!--span class="glyphicon glyphicon-plus"></span-->  Add New Sample Center</button></a>
                </div>


                <table id="tbl2" class="table table-bordered table-hover" cellspacing="0">
                
                <thead>
                <tr >
                    <th>ID</th>
                    <th>Sample Center Type</th>
                    <th>Sample Center Name</th>
                    <th>Incharge</th>
                    <th>Location</th>
                    <th>Email</th>
                    <th>Contact1 </th>
                    <th>Contact2 </th>
                    <th></th>
                </tr>
                </thead>
           
                <tbody>

                <?php
                date_default_timezone_set("Asia/Colombo");
                foreach ($SampleCenter as $value) {
                ?>
                <tr id="<?php echo $value->sampleCenter_ID; ?>">
                    <td><?php echo $value->sampleCenter_ID; ?></td>
                    <td><?php echo $value->fSampleCenterType_ID->sample_Center_TypeName; ?></td>
                    <td><?php echo $value->sampleCenter_Name; ?></td>
                    <td><?php echo $value->sampleCenter_Incharge; ?></td>
                    <td><?php echo $value->location; ?></td>
                    <td><?php echo $value->email; ?></td>
                    <td><?php echo $value->contactNumber1; ?></td>
                    <td><?php echo $value->contactNumber2; ?></td>

                    <td> <a href='<?php echo base_url(); ?>sample_centre_manager/UpdateSampleCenter/SCID/<?php echo $value->sampleCenter_ID; ?>/type/<?php echo $value->fSampleCenterType_ID->sample_Center_TypeName;?>/name/<?php echo $value->sampleCenter_Name; ?>/incharge/<?php echo $value->sampleCenter_Incharge; ?>/location/<?php echo $value->location; ?>/email/<?php echo urlencode($value->email);?>/con1/<?php echo $value->contactNumber1; ?>/con2/<?php echo $value->contactNumber2; ?>' data-toggle='modal'> <button id="<?php echo $value->sampleCenter_ID; ?>" value=""  class='btn btn-primary' title='Edit' data-toggle='tooltip' data-placement='right  ' ><!--span class="glyphicon glyphicon-edit"></span--> Edit</button></a></td>
                     </tr>

                <?php
                }
                ?>
                </tbody>
                </table>

            </div><!-- /.tab-pane2 -->
        
        </div><!-- /.tab-content -->
    
    </div><!-- nav-tabs-custom -->

</div> 

</div>


<div id="billing_items_div">

    <div id="AddType" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">New Sample Center Type</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group" >
                            <label for="LabType" class="col-sm-4 control-label">Sample center Type</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="LabType" placeholder="sample center Type" name="LabType">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button id="LabTypeBtn" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>


<div id="billing_items_div2">

    <div id="AddLab" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">New Laboratory</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group" >
                            <label class="col-sm-4 control-label" for="gender-1">Sample center Type</label>
                            <div class="col-sm-8">
                                <select id="TypeDropDown" class="form-control">

                                    <?php
                                    date_default_timezone_set("Asia/Colombo");
                                    foreach ($SSTypes as $value) {
                                        ?>

                                        <option  id="<?php echo $value->sampleCenterType_ID; ?>"value=""><?php echo $value->sample_Center_TypeName; ?></option>
                                    <?php  } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="labName" class="col-sm-4 control-label">Sample center Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="labName" placeholder="sample center Name" name="labName">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="labIncharge" class="col-sm-4 control-label">Incharge</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="labIncharge" placeholder="lab Incharge" name="labIncharge">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="location" class="col-sm-4 control-label">Location</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="location" placeholder="location" name="location">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="email" placeholder="email" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Contact1" class="col-sm-4 control-label">Contact 01</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="Contact1" placeholder="Contact 1" name="Contact1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Contact2" class="col-sm-4 control-label">Contact 02</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="Contact2" placeholder="Contact 2" name="Contact2">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button id="AddSCBtn" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>

