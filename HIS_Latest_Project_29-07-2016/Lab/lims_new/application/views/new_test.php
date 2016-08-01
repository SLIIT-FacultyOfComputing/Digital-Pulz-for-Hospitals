<style>
    .form-horizontal .control-label{
        text-align:left;
    }
</style>
<script>
    $(document).ready(function(){
        //Dropdown Loading Functions

       $("#pf").hide();

        getAllCategories();
        $('#category').change(function(){
            
           SubGetCategories();
        });
        $('#SubCategory').change(function(){
            GetSpecimenType();
        });
        $('#Specimen_Type').change(function(){
            GetSpecimenRetentionType();
        });



        $('#Addtest').click(function(e) {
            var new_val = $('#TestName').val();

            var TestName = []
            TestName.push('TN');
            TestName.push(new_val);
            TestName.push($("#category").children(":selected").attr("id"));
            TestName.push($("#SubCategory").children(":selected").attr("id"));
            TestName.push('1');

            alert(TestName);
            if (new_val != '')
            {
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>new_test_controller/testName',
                    data: {'TestName': TestName},
                    success: function(output) {

                        $("#category").attr('disabled','disabled');
                        $("#SubCategory").attr('disabled','disabled');
                        $("#Specimen_Type").attr('disabled','disabled');
                        $("#Specimen").attr('disabled','disabled');
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

        // Re-tested and changed by Dushyantha //

        var itemCount = 0;
        var objs = [];
        var temp_objs = [];

    $("#add_button").click(function() {
        var no = /^[0-9]+$/;
            if($("#name").val().match(no))
            {
                $.ajax({
                    type: "GET",
                    url: 'new_test_controller/GetMaxParentID',
                    async:false,
                    dataType: 'JSON',
                    success: function(output) {
                        itemCount=parseInt(output)+1;
                        $("#btn_save").show();

                    }
                });


                for(var c=1;c<=$("#name").val();c++){

                    var html = "";

                    var obj = {
                        "ROW_ID": itemCount,
                        "NAME": $("#name").val()

                    }

                    // add object
                    objs.push(obj);

                    html = "<tr id='tr" + itemCount + "'><td style='width:500px !important;'><input id='txt' type='text' class='form-control'> </td> <td><a href='#Add_Range' class='ss' id='" + itemCount + "'data-toggle='modal'> <button id='rg" + itemCount + "' value='" + obj['NAME'] + "'  class='btn btn-primary' title='Add Ranges' data-toggle='tooltip' data-placement='right  ' >Add Ranges</button></a> </td> <td style='width:50px !important;'><input class='remove' type='button' id='" + itemCount + "' value='Remove'></td> </tr>";


                    $("#bill_table").append(html);
                    itemCount++;

                    // The remove button click
                    $(".remove" ).click(function() {
                        var buttonId = $(this).attr("id");

                    //write the logic for removing from the array
                    $("#tr" + buttonId).remove();
                    });


                    $("#rg" + itemCount).click(function() {
                    fdName = $("#rg" + itemCount).val();
                    });

                    $(".ss").click(function() {
                        fdName = $(this).attr("Id");
                    });

                    $(".AddSub").click(function() {
                        fdName3 = $(this).attr("Id");
                    });
                }
            }

            else
            {
                alert("Please fill the required row count");
                return false;
            }

        });
                
                 $('#ab').click(function(){

                                $("#AddSub").hide();
                                });

        // add ranges for parent field
        $('#save_Range').click(function() {
            var Gender=$('#gender-1 option:selected').text();
            var Min_Age = $('#minAge').val();
            var Max_Age = $('#maxAge').val();
            var unit = $('#unit').val();
            var Min_Val = $('#minVal').val();
            var Max_Val = $('#maxVal').val();
           
            var data = []
            data.push(Gender);
            data.push(Min_Age);
            data.push(Max_Age);
            data.push(unit);
            data.push(Min_Val);
            data.push(Max_Val);
            data.push(fdName);

            data.push($('#TestName').val());
            data.push($('#txt').val());
            
            if (Gender != '' || Min_Age != '' || Max_Age != '' || unit != '' || Min_Val != '' || Max_Val != '')
            {
                if(confirm("Confirm Data ?"))
                {
                            
            $.ajax({

                    type: "POST",
                    url: 'new_test_controller/Add_ranges',
                    data: {'range': data},
                    success: function(output) {
                            
                             alert("Successfully Added");
                             $("#Add_Range").hide();
                             $("#AddSub").show();
                        }
                });}
                  else{
                               redirect('<?php echo base_url(); ?>new_test_controller/testName');
                        }
            }
        });



                    $('#bill_table tbody tr').each(function(i, el){
                        if(count!=0){
                            var val = $.trim($(this).find('#txt'+ count +'').val());

                            var obj = {};

                            obj['parent_FieldName'] = val;
                            obj['fTest_NameID'] = MaxTestID;
                            json.push(obj);
                        }
                        count++;
                    });

        $('#save_subfields').click(function() {
            var parent_field = $('#txt').val();

            var data = []
            data.push(parent_field);

            data.push(fdName);
           
            if (parent_field != '')
            {
                $.ajax({
                    type: "POST",
                    url: 'new_test_controller/AddParentFields',
                    data: {'range': data},
                    success: function(output) {
                       
                        alert("Successfully Added");

                        $('#rangeSpan'+fdName).show();

                    }
                });
            }
        });


            // add subfield ranges
            $('#add_subfields').click(function() {
            
            var subname =  $("#name2").val();
            var Gender=$('#gender-2 option:selected').text();
            var Min_Age = $('#minAge2').val();
            var Max_Age = $('#maxAge2').val();
            var unit = $('#unit2').val();
            var Min_Val = $('#minVal2').val();
            var Max_Val = $('#maxVal2').val();

            var data = []
            data.push(Gender);
            data.push(Min_Age);
            data.push(Max_Age);
            data.push(unit);
            data.push(Min_Val);
            data.push(Max_Val);
            
            data.push(fdName);
            data.push(subname);
          
            if (Gender != '' || Min_Age != '' || Max_Age != '' || unit != '' || Min_Val != '' || Max_Val != '')
            {
                $.ajax({
                    type: "POST",
                    url: 'new_test_controller/AddSubFieldsRanges',
                    data: {'range1': data},
                    success: function(output) {
                      
                        alert("Successfully Added");
                        $('#rangeSpan'+fdName).show();
                        $("#Add_sub_Range").hide();

                    }
                });
            }
        });         

        var itemCount1 = 0;
        var objs1 = [];
        var temp_objs1 = [];

        $("#add_button2").click(function() {

            var MaxSubID=0;
            $.ajax({
                type: "GET",
                url: 'new_test_controller/GetMaxSubFieldID',
                async:false,
                dataType: 'JSON',
                success: function(output) {
                    MaxSubID=parseInt(output)+1;
                    alert(MaxSubID);

                }
            });


            var html = "";

            var obj1 = {
                "ROW_ID": MaxSubID,
                "NAME": $("#name2").val()

            }

            // add object
            objs1.push(obj1);

            MaxSubID++;
            // dynamically create rows in the table
           
            html = "<tr id='tr2" + MaxSubID + "'> <td style='width:1000px !important;'>" + obj1['NAME'] + " </td> <td><a href='#Add_sub_Range'  id='" + MaxSubID + "'data-toggle='modal'> <button id='AR" + MaxSubID + "' value='" + obj1['NAME'] + "'  class='btn btn-primary' title='Add Ranges' data-toggle='tooltip' data-placement='right'>Add Ranges</button></a> </td> <td style='width:20% !important;'><input class='remove1' type='button'  id='" + MaxSubID + "' value='Remove'></td> </tr>";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
            //add to the table
            $("#bill_table2").append(html)

            // The remove button click
            $(".remove1" + MaxSubID).click(function() {
                var buttonId = $(this).attr("id");

            //write the logic for removing from the array
            $("#tr2" + buttonId).remove();
            });

            $("#AR" + MaxSubID).click(function() {
                fdName2 = $(this).attr("Id");
            $('#adR').show();

            });


        });

    });
    function getAllCategories(){
        $.ajax({
            url: '<?php echo base_url(); ?>new_test_controller/GetAllCategories',
            dataType: 'JSON',
            success: function(cat) {
                $("#category").append('<option value="Select category" >select category</option>');
                $.each(cat, function(key, val) {
                    $('#category').append($('<option ID=' + val['category_ID'] + '>').text(val['category_Name']).attr('category_Name', val['category_Name']));
                });
            },
            async: false
        });
    }
    function SubGetCategories()
    {
        $('#SubCategory').empty();
        var caID =$("#category").children(":selected").attr("id");
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>new_test_controller/GetAllSubCategoriesByCategoryID',
            dataType: 'JSON',
            data: {'CategoryID': caID},
            success: function(cat) {
                $.each(cat, function(key, val) {
                    $('#SubCategory').append($('<option ID=' + val['sub_CategoryID'] + '>').text(val['sub_CategoryName']).attr('sub_CategoryName', val['sub_CategoryName']));

                });
                GetSpecimenType();
            },
            async: false
        });
    }

    function GetSpecimenType()
    {
        $('#Specimen_Type').empty();
        var caID =$("#category").children(":selected").attr("id");
        var SubID =$("#SubCategory").children(":selected").attr("id");
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>new_test_controller/GetSpecimenTypesByIDs',
            dataType: 'JSON',
            data: {'CategoryID': caID, 'SubCategoryID': SubID},

            success: function(cat) {
                $.each(cat, function(key, val) {

                    $('#Specimen_Type').append($('<option ID=' + val['specimenType_ID'] + '>').text(val['specimen_TypeName']).attr('specimenType', val['specimen_TypeName']));

                });
                GetSpecimenRetentionType();
            },
            async: false
        });
    }

    function GetSpecimenRetentionType()
    {
        $('#Specimen').empty();
         var caID =$("#category").children(":selected").attr("id");
        var SubID =$("#SubCategory").children(":selected").attr("id");
            
       
        $.ajax({
            type:"POST",
            url: '<?php echo base_url(); ?>new_test_controller/GetRet',
            dataType: 'JSON',
            data: {'CategoryID': caID,'SubCategoryID': SubID},

            success: function(cat) {
                  
                $.each(cat, function(key,val) {
                    $('#Specimen').append($('<option ID='+val['retention_TypeID']+'>').text(val['retention_TypeName']).attr('specimenRetType', val['retention_TypeName']));
                    //$('#Specimen').append($('<option ID=' + val['specimenType_ID'] + '>').text(val['specimen_TypeName']).attr('specimenType', val['specimen_TypeName']));

                });
            },
            async: false
        });

    }

</script>

<div class="col-md-8 col-md-offset-2">
	<div class="box box-primary">
		<div class="box-header">
		  <h3 class="box-title">Add a new Laboratory Test</h3>
		</div>
		<form class="form-horizontal" role="form">
		<div class="box-body">
            <div id="myAlertSuccess" class="alert alert-success alert-dismissable" style="display: none"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Success!</strong></div>
            <div id="myAlertError" class="alert alert-danger alert-dismissable" style="display: none"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong> Error ! </strong></div>
			<div class="form-group">
				<label class="control-label col-sm-4" for="category">Test Category:</label>
				<div class="col-sm-8">
					<select name="category" id="category" class="form-control">
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4" for="email">Test Sub Category:</label>
				<div class="col-sm-8">
					<select id="SubCategory" name="SubCategory" class="form-control"></select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4" for="email">Specimen Type:</label>
				<div class="col-sm-8">
					<select id="Specimen_Type" name="Specimen_Type" class="form-control"></select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4" for="email">Specimen Retention Type:</label>
				<div class="col-sm-8">
					<select id="Specimen" name="Specimen" class="form-control"></select>
				</div>
			</div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="email">Test Name:</label>
                <div class="col-sm-8">
                    <input class="form-control" id="TestName" placeholder="Test Name" name="TestName"/>
                </div>
            </div>
		</div>
            <div class="box-footer">
                <button type="button" id="Addtest" class="btn btn-primary">Save Test Details</button>
            </div>
		</form>
        <div class="box-body" id="pf">
            <div class="box box-solid box-info">
                <div class="box-header">
                    <h3 class="box-title">Parent Fields</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-info btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <form class="form-horizontal" role="form">
                <div class="box-body">
                    <div class="form-group">
                       <label class="control-label col-md-3" for="name">No of rows:</label>
                       <div class="col-md-6">
                           <input name="name" type="text" id="name" class="form-control"/>
                       </div>
                       <div class="col-md-3">
                           <button id="add_button" type="button" class="btn btn-block btn-info">
                               Add Rows</button>
                       </div>
                    </div>
                    <div id="billing_items_div">
                        <table class="table table-condensed"  id='bill_table' align='center' cellspacing='3' cellpadding='5'>

                        </table>
                    </div>
                </div><!-- /.box-body -->
                </form>
            </div>
        </div>
	</div>
</div>

<div class="modal modal-info" id="Add_Range">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Parent field Range Details</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                <div class="form-group" >
                    <label class="col-sm-4 control-label" for="gender-1">Gender</label>
                    <div class="col-sm-8">
                        <select id="gender-1" class="col-sm-3 form-control">
                            <option selected="selected" value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="unit" class="col-sm-4 control-label">Unit</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="unit" placeholder="Unit" name="UNIT">
                    </div>
                </div>
                <div class="form-group">
                    <label for="minAge" class="col-sm-4 control-label">Min Age</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="minAge" placeholder="Min Age" name="minAge">
                    </div>
                </div>
                <div class="form-group">
                    <label for="maxAge" class="col-sm-4 control-label">Max Age</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="maxAge" placeholder="Max Value" name="maxAge">
                    </div>
                </div>
                <div class="form-group">
                    <label for="minVal" class="col-sm-4 control-label">Min Value</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="minVal" placeholder="Min Value" name="minVal">
                    </div>
                </div>
                <div class="form-group">
                    <label for="maxVal" class="col-sm-4 control-label">Max Value</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="maxVal" placeholder="Max Value" name="maxVal">
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
                <button type="button" id="save_Range" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>




<div class="modal modal-info" id="AddSub">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <div class="box-tools pull-right">
                        <button id="ab" class="btn btn-info btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                <h4 class="modal-title">Subfield Details</h4>
            </div>

                <form class="form-horizontal" role="form">
                <div class="box-body">
                    <div class="form-group">
                       <label class="control-label col-md-3" for="name">Subfield Name:</label>
                       <div class="col-md-6">
                           <input name="name" type="text" id="name2" class="form-control"/>
                       </div>
                       <div class="col-xs-3">
                        <input name="add_button" type="button" id="add_button2" class="btn btn-block btn-info" value="Add Subfield" />
                    </div>
                    </div>
                    <div id="billing_items_div">
                        <table class="table table-condensed"  id='bill_table' align='center' cellspacing='3' cellpadding='5'>

                        </table>
                    </div>
                </div><!-- /.box-body -->
                </form>


                <div id="billing_items_div2">
                    <table class="table table-condensed" id='bill_table2'  align='center' cellspacing='3' cellpadding='5' span aria-hidden="true">

                    </table>
                </div>
        </div>
    </div>

<div class="modal modal-primary default" id="Add_sub_Range">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Subfield Range Details</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                <div class="form-group" >
                    <label class="col-sm-4 control-label" for="gender-2">Gender</label>
                    <div class="col-sm-8">
                        <select id="gender-2" class="col-sm-3 form-control">
                            <option selected="selected" value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="unit" class="col-sm-4 control-label">Unit</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="unit2" placeholder="Unit" name="UNIT">
                    </div>
                </div>
                <div class="form-group">
                    <label for="minAge" class="col-sm-4 control-label">Min Age</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="minAge2" placeholder="Min Age" name="minAge">
                    </div>
                </div>
                <div class="form-group">
                    <label for="maxAge" class="col-sm-4 control-label">Max Age</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="maxAge2" placeholder="Max Value" name="maxAge">
                    </div>
                </div>
                <div class="form-group">
                    <label for="minVal" class="col-sm-4 control-label">Min Value</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="minVal2" placeholder="Min Value" name="minVal">
                    </div>
                </div>
                <div class="form-group">
                    <label for="maxVal" class="col-sm-4 control-label">Max Value</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="maxVal2" placeholder="Max Value" name="maxVal">
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" id="add_subfields" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>

</div><!-- /.modal-dialog -->


