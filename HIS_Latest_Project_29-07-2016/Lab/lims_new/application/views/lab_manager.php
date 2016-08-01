
<script>
    $('document').ready(function() {

        $('#tbl1').dataTable({
            "dom": 'T<"clear">lfrtip'
            ,
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 2,2 ] } //Disbale sorting on these colums - Dush
            ]
        });
        $('#tbl2').dataTable({
            "dom": 'T<"clear">lfrtip',
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 2,2 ] } //Disbale sorting on these colums - Dush
            ]
        });
        var tbl3 =$('#tbl3').dataTable({
            "dom": 'T<"clear">lfrtip',
            "autoWidth": true,
            "sScrollXInner": "100%",
            //"sScrollX": "100%",
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 10,10] } //Disbale sorting on these colums - Dush
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
                url: '<?php echo base_url(); ?>lab_manager/addLabType',
                data: {'LabData': LabData},
                success: function(output) {
                        alert("Laboratory Type is Added Successfuly !");
                        window.location.href = "<?php echo base_url(); ?>lab_manager/";
                }
            });
        }
        });

            $('#AddDeptBtn').click(function() {
            var type = $('#LabDept').val();
            var LabData = []
            LabData.push(type);
            if (LabData !== '')
            {
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>lab_manager/addLabDept',
                    data: {'LabData': LabData},
                    success: function(output) {
                            alert("New Department is Added Successfuly !");
                            window.location.href = "<?php echo base_url(); ?>lab_manager/";
                    }
                });
            }
        });




            $('#AddLabBtn').click(function() {
            var Tp = $("#LabTypeDropDown").children(":selected").attr("id");
            var Dpt = $("#DeptDropDown").children(":selected").attr("id");
            var count = $('#count').val();
            var LabName = $('#labName').val();
            var Incharge = $('#labIncharge').val();
            var Location = $('#location').val();
            var email = $('#email').val();
            var contact1 = $('#Contact1').val();
            var contact2 = $('#Contact2').val();


            var LabData = []

            LabData.push(Tp);
            LabData.push(Dpt);
            LabData.push(count);
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
                    url: '<?php echo base_url(); ?>lab_manager/addLaboraroty',
                    data: {'LabData': LabData},
                    success: function(output) {
                            alert("Laboratory is Added successfuly");
                            window.location.href = "<?php echo base_url(); ?>lab_manager/";
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
            <li class="active"><a href="#tab_1" data-toggle="tab">Lab Types</a></li>
            <li><a href="#tab_2" data-toggle="tab">Laboratory Departments</a></li>
            <li><a href="#tab_3" data-toggle="tab">Laboratories</a></li>
        </ul>
      
        <div class="tab-content">
            
            <div class="tab-pane active" id="tab_1">

                <div class="add_button pull-right">
                    <a href="#AddType" target="_blank" id="NewTypeBtn" class="updtCat" data-toggle='modal'> <button id="Btn01" value=""  class='btn btn-primary' title='Edit' data-toggle='tooltip' data-placement='right' ><!--span class="glyphicon glyphicon-plus"></span-->  Add New Laboratory Type</button></a>
                </div>

                 <table id="tbl1" class="table table-bordered table-hover dataTable" cellspacing="0">

                <thead>
                <tr>
                    <th>Laboratory ID</th>
                    <th>Laboratory Name</th>
                    <th></th>
                    
                </tr>
                </thead>
                
                <tbody>
                <?php
                date_default_timezone_set("Asia/Colombo");
                foreach ($labTypes as $value) {
                    ?>
                    <tr id="<?php echo $value->labType_ID; ?>">
                        <td><?php echo $value->labType_ID; ?></td>
                        <td><?php echo $value->lab_Type_Name; ?></td>

                        <td> <a href='<?php echo base_url(); ?>lab_manager/updateLab/LID/<?php echo $value->labType_ID; ?>/Lab/<?php echo $value->lab_Type_Name; ?>' id="<?php echo $value->labType_ID; ?>" class="updtCat" data-toggle='modal'> <button id="<?php echo $value->labType_ID; ?>" value=""  class='btn btn-primary' title='Edit' data-toggle='tooltip' data-placement='right  ' ><!--span class="glyphicon glyphicon-edit"></span--> Edit</button></a></td>
                        
                    </tr>

                <?php
                }
                ?>
                </tbody>
            </table>

            </div><!-- /.tab-pane1 -->
        

            <div class="tab-pane" id="tab_2">

                <div class="add_button pull-right">
                    <a href="#AddDept" target="_blank" id="NewDeptBtn" class="updtCat" data-toggle='modal'> <button id="Btn02" value=""  class='btn btn-primary' title='Edit' data-toggle='tooltip' data-placement='right  ' ><!--span class="glyphicon glyphicon-plus"></span-->  Add New Department</button></a>
                </div>

                <table id="tbl2" class="table table-bordered table-hover dataTable" cellspacing="0">

                <thead>
                <tr>
                    <th>Department ID</th>
                    <th>Department Name</th>
                    <th></th>
                    
                </tr>
                </thead>
                
                <tbody>
                <?php
                date_default_timezone_set("Asia/Colombo");
                foreach ($Depts as $value) {
                    ?>
                    <tr id="<?php echo $value->labDept_ID; ?>">
                        <td><?php echo $value->labDept_ID; ?></td>
                        <td><?php echo $value->labDept_Name; ?></td>

                        <td> <a href='<?php echo base_url(); ?>lab_manager/updateLabDept/DID/<?php echo $value->labDept_ID; ?>/Dept/<?php echo $value->labDept_Name; ?>' id="<?php echo $value->labDept_ID; ?>" data-toggle='modal'> <button id="<?php echo $value->labDept_ID; ?>" value=""  class='btn btn-primary' title='Edit' data-toggle='tooltip' data-placement='right  ' ><!--span class="glyphicon glyphicon-edit"></span--> Edit</button></a></td>
                        
                    </tr>

                <?php
                }
                ?>
                </tbody>
            </table>

            </div><!-- /.tab-pane2 -->

            <div class="tab-pane" id="tab_3">

                <div class="add_button pull-right">
                    <a href="#AddLab" target="_blank" id="NewTypeBtn" class="updtCat" data-toggle='modal'> <button id="Btn03" value=""  class='btn btn-primary' title='Edit' data-toggle='tooltip' data-placement='right  ' ><!--span class="glyphicon glyphicon-plus"></span-->  Add New Laboratory</button></a>
                </div>

                <table id="tbl3" class="table table-bordered table-hover dataTable" cellspacing="0">
                <thead>
                <tr >
                    <th>Lab ID</th>
                    <th>Lab Name</th>
                    <th>Lab Type </th>
                    <th>Department</th>
                    <th>Count</th>
                    <th>Lab Incharge</th>
                    <th>Location </th>
                    <th>Email</th>
                    <th>Contact1 </th>
                    <th>Contact2 </th>
                    <th></th>
                   
                </tr>
                </thead>
                
                <tbody>
                <?php
                date_default_timezone_set("Asia/Colombo");
                foreach ($laboratories as $value) {
                    ?>
                    <tr id="<?php echo $value->lab_ID; ?>">
                        <td><?php echo $value->lab_ID; ?></td>
                        <td><?php echo $value->lab_Name; ?></td>
                        <td><?php echo $value->flabType_ID->lab_Type_Name; ?></td>
                        <td><?php echo $value->flabDept_ID->labDept_Name; ?></td>
                        <td><?php echo $value->lab_Dept_Count; ?></td>
                        <td><?php echo $value->lab_Incharge; ?></td>
                        <td><?php echo $value->location; ?></td>
                        <td><?php echo $value->email; ?></td>
                        <td><?php echo $value->contactNumber1; ?></td>
                        <td><?php echo $value->contactNumber2; ?></td>

                        <td> <a href='<?php echo base_url(); ?>lab_manager/EditLaboraroty/LID/<?php echo $value->lab_ID; ?>/LabName/<?php echo $value->lab_Name; ?>/type/<?php echo $value->flabType_ID->lab_Type_Name; ?>/dept/<?php echo $value->flabDept_ID->labDept_Name; ?>/count/<?php echo $value->lab_Dept_Count;?>/incharge/<?php echo $value->lab_Incharge; ?>/location/<?php echo $value->location; ?>/email/<?php echo urlencode($value->email); ?>/con1/<?php echo $value->contactNumber1; ?>/con2/<?php echo $value->contactNumber2; ?>' data-toggle='modal'> <button id="<?php echo $value->lab_ID; ?>" value=""  class='btn btn-primary' title='Edit' data-toggle='tooltip' data-placement='right  ' ><!--span class="glyphicon glyphicon-edit"></span--> Edit</button></a></td>
                        
                    </tr>

                    <?php
                    }
                    ?>
                </tbody>

                </table>

            </div><!-- /.tab-pane3 -->

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
                    <h4 class="modal-title">New Laboratory Type</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="LabType" class="col-sm-4 control-label">Laboratory Type</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="LabType" placeholder="Lab Type" name="LabType">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button id="LabTypeBtn" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
</div>


<div id="billing_items_div1">

    <div id="AddDept" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h4 class="modal-title">New Department</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">

                        <div class="form-group">
                            <label for="LabDept" class="col-sm-4 control-label">Department Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="LabDept" placeholder="Department Name" name="LabDept">
                            </div>
                        </div>

                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button id="AddDeptBtn" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>

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
                            <label class="col-sm-4 control-label" for="gender-1">Lab Type</label>
                            <div class="col-sm-8">
                                <select id="LabTypeDropDown" class="col-sm-3 form-control">

                                    <?php
                                    date_default_timezone_set("Asia/Colombo");
                                    foreach ($labTypes as $value) {
                                        ?>

                                        <option  id="<?php echo $value->labType_ID; ?>"value=""><?php echo $value->lab_Type_Name; ?></option>
                                    <?php  } ?>
                                </select>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group" >
                            <label class="col-sm-4 control-label" for="gender-1">Department</label>
                            <div class="col-sm-8">
                                <select id="DeptDropDown" class="col-sm-3 form-control">

                                    <?php
                                    date_default_timezone_set("Asia/Colombo");
                                    foreach ($Depts as $value) {
                                        ?>
                                        <option  id="<?php echo $value->labDept_ID; ?>"value=""><?php echo $value->labDept_Name; ?></option>
                                    <?php  } ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="count" class="col-sm-4 control-label">Department Count</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="count" placeholder="count" name="count">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="labName" class="col-sm-4 control-label">Lab Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="labName" placeholder="Lab Name" name="labName">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="labIncharge" class="col-sm-4 control-label">Lab Incharge</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="labIncharge" placeholder="lab Inchargee" name="labIncharge">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="location" class="col-sm-4 control-label">Location</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="location" placeholder="location" name="location">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="email" placeholder="email" name="email">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="Contact1" class="col-sm-4 control-label">Contact 01</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="Contact1" placeholder="Contact 1" name="Contact1">
                            </div>
                        </div>
                        <br>
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
                    <button id="AddLabBtn" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
</div>