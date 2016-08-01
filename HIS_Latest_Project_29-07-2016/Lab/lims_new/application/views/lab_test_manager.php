<script>
    $('document').ready(function() {

        $('#tbl1').dataTable({
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "<?php echo base_url(); ?>swf/copy_csv_xls_pdf.swf"
            },
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 2,2 ] } //Disbale sorting on these colums - Dush
            ]
        });
        $('#tbl2').dataTable({
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "<?php echo base_url(); ?>swf/copy_csv_xls_pdf.swf"
            },
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 2,2 ] }
            ]
        });
        $('#tbl3').dataTable({
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "<?php echo base_url(); ?>swf/copy_csv_xls_pdf.swf"
            },
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 4,4 ] }
            ]
        });
        $('#tbl4').dataTable({
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "<?php echo base_url(); ?>swf/copy_csv_xls_pdf.swf"
            }
        });



        $('.updtCat').click(function() {

            var x = ($(this).data('member'));
          
        });

        $('#AddTest_Cat_Btn').click(function() {
        var cat = $('#Test_Cat').val();
        var subCat = $('#Test_SubCat').val();
        var specType = $('#specimenType').val();
        var retType = $('#retentionType').val();
        var duration = $('#duration').val();

        var catData = []
        catData.push(cat);
        catData.push(subCat);
        catData.push(specType);
        catData.push(retType);
        catData.push(duration);


        if (catData !== '')
        {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>lab_test_manager/addCategoryDetails',
                data: {'categories': catData},
                success: function(output) {
                        alert("Category Details Added Successfuly !");
                        window.location.href = "<?php echo base_url(); ?>lab_test_manager/";
                }
            });
        }
        });




    });
</script>


<div class="col-xs-12">

<div class="box box-primary">
    <div class="box-header" data-toggle="tooltip" title=""> 

    <div class="nav-tabs-custom">
        
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Test Names</a></li>
            <li><a href="#tab_2" data-toggle="tab">Test Categories</a></li>
            <li><a href="#tab_3" data-toggle="tab">Test Sub Categories</a></li>
        </ul>
      
        <div class="tab-content">
            
            <div class="tab-pane" id="tab_2">

                <div class="add_button pull-right">
                    <a href="#AddTestCat" target="_blank" id="NewTypeBtn" class="updtCat" data-toggle='modal'> <button id="Btn01" value=""  class='btn btn-primary' title='Edit' data-toggle='tooltip' data-placement='right' ><!--span class="glyphicon glyphicon-plus"></span--> Add New Test Category</button></a>  
                </div> 

                <table id="tbl1" class="table table-bordered table-hover" cellspacing="0">

                <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th></th>
                
                </tr>
                </thead>
            
                <tbody>
                <?php

                date_default_timezone_set("Asia/Colombo");
                foreach ($categories as $value) {
                ?>
                <tr id="<?php echo $value->category_ID; ?>">
                    <td><?php echo $value->category_ID; ?></td>
                    <td><?php echo $value->category_Name; ?></td>

                    <td>
                        <div style="text-align:center">
                        <a href='<?php echo base_url();?>lab_test_manager/updateCategory/CID/<?php echo $value->category_ID;?>/Cat/<?php echo $value->category_Name; ?>'  id="<?php echo $value->category_ID; ?>" class="updtCat" data-toggle='modal'> 
                        <button id="<?php echo $value->category_ID; ?>" value=""  class='btn btn-primary' title='Edit' data-toggle='tooltip' data-placement='right  ' >
                        Edit</button>
                        </a>
                        </div></td>

                </tr>

                <?php
                }
                ?>
                </tbody>
                </table>

            </div><!-- /.tab-pane1 -->
        

            <div class="tab-pane" id="tab_3">

                <table id="tbl2" class="table table-bordered table-hover" cellspacing="0">

                <thead>
                <tr >
                    <th>Sub Category ID</th>
                    <th>Sub Category Name</th>
                    <th></th>
                
                </tr>
                </thead>
            
                <tbody>
                <?php
                date_default_timezone_set("Asia/Colombo");
                foreach ($Subcategories as $value) {
                ?>
                <tr id="<?php echo $value->sub_CategoryID ?>">
                    <td><?php echo $value->sub_CategoryID; ?></td>
                    <td><?php echo $value->sub_CategoryName; ?></td>

                    <td><div style="text-align:center"> 
                    <a href='<?php echo base_url();?>lab_test_manager/updateSubCategory/SID/<?php echo $value->sub_CategoryID;?>/SubCat/<?php echo $value->sub_CategoryName; ?>'id="<?php echo $value->sub_CategoryID; ?>" class="updtCat" data-toggle='modal'> <button id="<?php echo $value->sub_CategoryID; ?>" value=""  class='btn btn-primary' title='Edit' data-toggle='tooltip' data-placement='right  ' >Edit</button></a></div></td>
                </tr>

                <?php
                }
                ?>
                </tbody>

                </table>

            </div><!-- /.tab-pane2 -->

            <div class="tab-pane active" id="tab_1">

                <table id="tbl3" class="table table-bordered table-hover" cellspacing="0">
                
                <thead>
                <tr >
                    <th>Test ID</th>
                    <th>Test Name</th>
                    <th>Category </th>
                    <th>Sub Category</th>
                    <th></th>
                </tr>
                </thead>
           
                <tbody>
                <?php
                date_default_timezone_set("Asia/Colombo");
                foreach ($TestNames as $value) {
                ?>
                <tr id="<?php echo $value->test_ID; ?>">
                    <td><?php echo $value->test_ID; ?></td>
                    <td><?php echo $value->test_Name; ?></td>
                    <td><?php echo $value->fTest_CategoryID->category_Name; ?></td>
                    <td><?php echo $value->fTest_Sub_CategoryID->sub_CategoryName; ?></td>

                    <td><div style="text-align:center"> <a href='<?php echo base_url();?>lab_test_manager/updateTestNames/TID/<?php echo $value->test_ID; ?>/TN/<?php echo $value->test_Name; ?>/cid/<?php echo $value->fTest_CategoryID->category_ID; ?>/cat/<?php echo $value->fTest_CategoryID->category_Name; ?>/sid/<?php echo $value->fTest_Sub_CategoryID->sub_CategoryID; ?>/sub/<?php echo $value->fTest_Sub_CategoryID->sub_CategoryName; ?>'  data-toggle='modal'> <button id="<?php echo $value->test_ID; ?>" value=""  class='btn btn-primary' title='Edit' data-toggle='tooltip' data-placement='right  ' ><!--span class="glyphicon glyphicon-edit"></span--> Edit</button></a></div></td>
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

    <div id="AddTestCat" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">New Test Category</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">

                        <div class="form-group">
                            <label for="Test_Cat" class="col-sm-4 control-label">Category Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="Test_Cat" placeholder="Category Name" name="Test_Cat">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Test_SubCat" class="col-sm-4 control-label">Sub Category Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="Test_SubCat" placeholder="Sub Category Name" name="Test_SubCat">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="specimenType" class="col-sm-4 control-label">Specimen Type</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="specimenType" placeholder="Specimen Type" name="specimenType">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="retentionType" class="col-sm-4 control-label">Specimen Retention Type</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="retentionType" placeholder="Specimen Retention Type" name="retentionType">
                            </div>
                        </div>

                        <div class="form-group" style="align:center"  >
                             <label for="duration" class="col-sm-4 control-label">Duration</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="duration" placeholder="Duration" name="duration">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button id="AddTest_Cat_Btn" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
         </div>
    </div>
</div>