<?php //print_r($specTypes); ?>
<div class="col-md-6">
    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Laboratory Test</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="<?php echo base_url("mri_test_fields/add_test_name"); ?>" class="form-horizontal" id="test_names_form">
            <div class="box-body">
                <div id="message-1"></div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="department">Category:</label>
                    <div class="col-sm-9">
                        <select name="department" id="category" class="form-control">
                            <?php
                                if(isset($departments)){
                                    foreach($departments as $row) {
                                        echo '<option value="'.$row->category_ID.'">'.$row->category_Name.'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="lab">Sub Category:</label>
                    <div class="col-sm-9">
                        <select name="lab" id="SubCategory" class="form-control">

                            <?php
                            if(isset($labs)){
                                foreach($labs as $row) {
                                    echo '<option value="'.$row->sub_CategoryID.'">'.$row->sub_CategoryName.'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
               <!--  <div class="form-group">
                    <label class="control-label col-sm-3" for="specimen_type">Specimen Type:</label>
                    <div class="col-sm-9">
                        <select name="specimen_type" id="specimen_type" class="form-control">
                            <?php
                            if(isset($specTypes)){
                                foreach($specTypes as $row) {
                                    echo '<option value="'.$row->specimenType_ID.'">'.$row->specimen_TypeName.'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div> -->
                <div class="form-group">
                    <label class="control-label col-sm-3" for="test_name">Test Name:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="test_name" id="TestName"/>
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label class="control-label col-sm-3" for="test_short_name">Test Short Name:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="test_short_name" id="test_short_name"/>
                    </div>
                </div> -->
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div><!-- /.box -->
</div>
<div class="col-md-6">
    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Test Fields</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form role="form" class="form-horizontal">
            <div class="box-body">
                <div class="form-group">
                    <label class="control-label col-sm-3" for="lab_test">Lab Test</label>
                    <div class="col-sm-9">
                        <select name="lab_test" id="lab_test" class="form-control">
                        </select>
                    </div>
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <a class="btn btn-primary" data-toggle="modal" data-target="#parentFieldModal">
                    <i class="fa fa-edit"></i> Add Test Field
                </a>
                <a class="btn btn-primary" data-toggle="modal" data-target="#subFieldModal">
                    <i class="fa fa-edit"></i> Add Test Sub Field
                </a>
                <a class="btn btn-primary" data-toggle="modal" data-target="#viewDataModal">
                    <i class="fa fa-edit"></i> View Data
                </a>
            </div>
        </form>
    </div><!-- /.box -->
</div>

<!-- Modals -->
<div class="modal fade" id="parentFieldModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Parent Field Data</h4>
            </div>
            <div class="modal-body">
                <div id="message-2"></div>
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Field:</label>
                        <div class="col-sm-7">
                            <select name="parent_field" id="parent_field" class="form-control">
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-block btn-success" type="button" id="btn_field_display">
                                <i class="fa fa-plus-square"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group well" id="field_add_section" style="display: none">
                        <label class="control-label col-sm-3" for="email">Field Name:</label>
                        <div class="col-sm-7">
                            <input type="text" name="parent_field_name" id="parent_field_name" class="form-control" placeholder="Parent Field Name"/>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-block btn-success" id="addParentField" type="button">Add</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Gender:</label>
                        <div class="col-sm-9">
                            <select name="gender" id="gender" class="form-control">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Minimum Age:</label>
                        <div class="col-sm-9">
                            <input type="text" name="min_age" id="min_age" class="form-control" placeholder="Minimum Age"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Maximum Age:</label>
                        <div class="col-sm-9">
                            <input type="text" name="max_age" id="max_age" class="form-control" placeholder="Maximum Age"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Minimum value:</label>
                        <div class="col-sm-9">
                            <input type="text" name="min_value" id="min_value" class="form-control" placeholder="Minimum Value"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Maximum Value:</label>
                        <div class="col-sm-9">
                            <input type="text" name="max_value" id="max_value" class="form-control" placeholder="Maximum Value"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Unit:</label>
                        <div class="col-sm-9">
                            <input type="text" name="unit" id="unit" class="form-control" placeholder="Unit"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_parent_form">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<!-- Modals -->
<div class="modal fade" id="viewDataModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">View Field Data</h4>
            </div>
            <div class="modal-body">
                <div id="viewDataContainer"></div>
                <div id="loading1" class="text-center">
                    <img src="<?php echo base_url('assets/img/loading-white.gif'); ?>"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- Modals -->
<div class="modal fade" id="subFieldModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Sub Field Data</h4>
            </div>
            <div class="modal-body">
                <div id="message-3"></div>
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Parent Field:</label>
                        <div class="col-sm-9">
                            <select name="parent_field_sub" id="parent_field_sub" class="form-control">
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="sub_field">Sub Field:</label>
                        <div class="col-sm-7">
                            <select name="sub_field" id="sub_field" class="form-control">
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-block btn-success" type="button" id="btn_subfield_display">
                                <i class="fa fa-plus-square"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group well" id="sub_field_add_section" style="display: none">
                        <label class="control-label col-sm-3" for="email">Field Name:</label>
                        <div class="col-sm-7">
                            <input type="text" name="sub_field_name" id="sub_field_name" class="form-control" placeholder="Sub Field Name"/>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-block btn-success" id="addSubField" type="button">Add</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="gender">Gender:</label>
                        <div class="col-sm-9">
                            <select name="sub_gender" id="sub_gender" class="form-control">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Minimum Age:</label>
                        <div class="col-sm-9">
                            <input type="text" name="sub_min_age" id="sub_min_age" class="form-control" placeholder="Minimum Age"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Maximum Age:</label>
                        <div class="col-sm-9">
                            <input type="text" name="sub_max_age" id="sub_max_age" class="form-control" placeholder="Maximum Age"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Minimum value:</label>
                        <div class="col-sm-9">
                            <input type="text" name="sub_min_value" id="sub_min_value" class="form-control" placeholder="Minimum Value"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Maximum Value:</label>
                        <div class="col-sm-9">
                            <input type="text" name="sub_max_value" id="sub_max_value" class="form-control" placeholder="Maximum Value"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Unit:</label>
                        <div class="col-sm-9">
                            <input type="text" name="sub_unit" id="sub_unit" class="form-control" placeholder="Unit"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_sub_form">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<script type="application/javascript">

    $( document ).ready(function() {
        //LabTestTypes Dropdown data
        $.getJSON( "<?php echo base_url("mri_test_fields/getAllLabTestTypes"); ?>", function( data ) {
            $.each(data, function(i, item){
                var obj = item;
                $('#lab_test')
                    .append($("<option></option>")
                        .attr("value",obj.test_ID)
                        .text(obj.test_Name));
            });
        });
    });

    /*$('#test_names_form').submit(function(e) {
        e.preventDefault(); //STOP default action
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax(
            {
                url : formURL,
                type: "POST",
                data : postData,
                dataType : "JSON",
                success:function(data, textStatus, jqXHR)
                {
                    console.log(data);
                    if(data.success==true){
                        $("#message-1").addClass("alert alert-success alert-dismissable");
                        $("#message-1").append('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>');
                        $("#message-1").append("<p>Successfully added data</p>");
                    } else {
                        $("#message-1").addClass("alert alert-error alert-dismissable");
                        $("#message-1").append('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>');
                        $("#message-1").append("<p>Failed to add data</p>");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert(errorThrown);
                }
            });
    });*/

       $('#test_names_form').submit(function(e)  {
            var new_val = $('#TestName').val();

            var TestName = []
            TestName.push('TN');
            TestName.push(new_val);
            TestName.push($("#category").children(":selected").val());
            TestName.push($("#SubCategory").children(":selected").val());
            TestName.push('1');
         

            if (new_val != '')
            {
                $.ajax({
                    type: "POST",
                    url:  "<?php echo base_url("new_test_controller/testName"); ?>",
                    data: {'TestName': TestName},
                    success: function(output) {

                        $("#category").attr('disabled','disabled');
                        $("#SubCategory").attr('disabled','disabled');
                        $("#specimen_type").attr('disabled','disabled');
                        $("#TestName").attr('disabled','disabled');
                       
                        if($("#myAlertSuccess").show()){
                             $("#myAlertError").hide();
                             $("#pf").show();
                         }
                    }
                });
            }

            else{
                $("#myAlertError").show();
            }

        });

    $("#btn_field_display").click(function(){
        if($('#field_add_section:visible').length == 0)
        {
            $("#field_add_section").show();
            $("#btn_field_display").find("i").remove();
            $("#btn_field_display").append('<i class="fa  fa-minus-square"></i>');
        } else {
            $("#field_add_section").hide();
            $("#btn_field_display").find("i").remove();
            $("#btn_field_display").append('<i class="fa  fa-plus-square"></i>');
        }
    });

    $('#parentFieldModal').on('shown.bs.modal', function() {
        getParentFields();
    });

    function getParentFields() {
        $('#parent_field').html("");
        
        var labTestId = $("#lab_test").val();
        $.post("<?php echo base_url("mri_test_fields/getTestParentTypes"); ?>", {"labTestId": labTestId}, function(result){
            $.each(result, function(i, item){
                $('#parent_field')
                    .append($("<option></option>")
                        .attr("value",item.parent_FieldID)
                        .text(item.parent_FieldName));
            });
            getSubFields();
        },"JSON");
    }

    $("#addParentField").click(function(){
        var labTestId = $("#lab_test").val();
     
        var testName = $("#parent_field_name").val();

        $.post("<?php echo base_url("mri_test_fields/addTestParentField"); ?>", {"labTestId": labTestId,"testName":testName}, function(result){
          

            //console.log(result);
            
            if(result.message==true) {

                getParentFields();
            }
        },"JSON");
    });

    function checkForExistence() {
        var gender = $("#gender").val();
        var parent = $("#parent_field").val();
        $.post("<?php echo base_url("mri_test_fields/checkForExistenceOfParentData"); ?>", {"gender": gender,"parent_id":parent}, function(result){
            console.log(result);
            if(result.success==true) {
                alert("has");
            } else {
                alert("no");
            }
        },"JSON");
    }

    $("#btn_parent_form").click(function(){
        var parentID = $("#parent_field").val();
        var gender = $("#gender").val();
        var minAge = $("#min_age").val();
        var maxAge = $("#max_age").val();
        var minValue = $("#min_value").val();
        var maxValue = $("#max_value").val();
        var unit = $("#unit").val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("mri_test_fields/addParentFieldData"); ?>",
            data: {"parentID":parentID,"gender":gender,"minAge":minAge,"maxAge":maxAge,"minValue":minValue,"maxValue":maxValue,"unit":unit},
            dataType: "JSON"
        }).done(function(data){
                console.log(data);
                if(data.success!=true){
                    $("#message-2").addClass("alert alert-error alert-dismissable");
                    $("#message-2").append('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>');
                    $("#message-2").append("<p>"+data.success+"</p>");
                }else {
                    $("#message-2").addClass("alert alert-success alert-dismissable");
                    $("#message-2").append('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>');
                    $("#message-2").append("<p>Successfully added data</p>");
                }
            });
    });

    $('#viewDataModal').on('shown.bs.modal', function() {
        getViewData();
    });

    function getViewData() {
        $('#loading1').show();
        $('#viewDataContainer').html("");
        var labTestId = $("#lab_test").val();
        $.post("<?php echo base_url("mri_test_fields/getTestParentFieldData"); ?>", {"labTestId": labTestId}, function(result){
            $('#loading1').hide();
            $('#viewDataContainer').html(result);
            $('#viewDataTable').dataTable();
        },"TEXT")
    }

    function getParentFieldsForSub() {
        $('#parent_field_sub').html("");
        var labTestId = $("#lab_test").val();
        $.post("<?php echo base_url("mri_test_fields/getTestParentTypes"); ?>", {"labTestId": labTestId}, function(result){
            $.each(result, function(i, item){
                $('#parent_field_sub')
                    .append($("<option></option>")
                        .attr("value",item.parent_FieldID)
                        .text(item.parent_FieldName));
            });
            getSubFields();
        },"JSON");
    }

    $('#subFieldModal').on('shown.bs.modal', function() {
        getParentFieldsForSub();
    });

    $("#btn_subfield_display").click(function(){
        if($('#sub_field_add_section:visible').length == 0)
        {
            $("#sub_field_add_section").show();
            $("#btn_subfield_display").find("i").remove();
            $("#btn_subfield_display").append('<i class="fa  fa-minus-square"></i>');
        } else {
            $("#sub_field_add_section").hide();
            $("#btn_subfield_display").find("i").remove();
            $("#btn_subfield_display").append('<i class="fa  fa-plus-square"></i>');
        }
    });

    $("#addSubField").click(function(){
        var testName = $("#sub_field_name").val();
        var parentField = $("#parent_field_sub").val();

        $.post("<?php echo base_url("mri_test_fields/addTestSubField"); ?>", {"parentField": parentField,"testName":testName}, function(result){
            console.log(result);
            if(result.message==true) {
                getSubFields();
            } else {
                alert(result.message);
            }
        },"JSON");
    });

    function getSubFields() {
        // $('#sub_field').html("");
        var parentField = $("#parent_field_sub").val();
       
        $.post("<?php echo base_url("mri_test_fields/getTestsubsTypes"); ?>",{"parentField": parentField}, function(result){
            $.each(result, function(i, item){
              
                $('#sub_field')
                    .append($("<option></option>")
                        .attr("value",item.sub_TestFieldID)
                        .text(item.subtest_FieldName));
            });
        },"JSON");



    }

    $("#btn_sub_form").click(function(){
        var parentID = $("#parent_field_sub").val();
        var gender = $("#sub_gender").val();
        var minAge = $("#sub_min_age").val();
        var maxAge = $("#sub_max_age").val();
        var minValue = $("#sub_min_value").val();
        var maxValue = $("#sub_max_value").val();
        var unit = $("#sub_unit").val();
        var sid = $("#sub_field").children(":selected").val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("mri_test_fields/addSubFieldData"); ?>",
            data: {"parentID":parentID,"gender":gender,"minAge":minAge,"maxAge":maxAge,"minValue":minValue,"maxValue":maxValue,"unit":unit,"sub_field":sid},
            dataType: "JSON"
        }).done(function(data){
                console.log(data);
                if(data.success!=true){
                    $("#message-3").addClass("alert alert-error alert-dismissable");
                    $("#message-3").append('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>');
                    $("#message-3").append("<p>"+data.success+"</p>");
                }else {
                    $("#message-3").addClass("alert alert-success alert-dismissable");
                    $("#message-3").append('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>');
                    $("#message-3").append("<p>Successfully added data</p>");
                }
            });
    });
</script>