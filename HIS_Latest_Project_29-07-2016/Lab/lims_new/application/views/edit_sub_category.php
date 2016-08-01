<script>
    $('document').ready(function() {

        if ($("#myAlertError").is(":visible")) {

            setInterval(function() {
                $("#myAlertError").hide();
            }, 1000);
        }

        resizeDiv();
        window.onresize = function(event) {
            resizeDiv();
        }
        function resizeDiv() {
            vph = $(window).height() - 150;
            vpw = $(window).width() - 300;
            $('#content').css({'width': vpw + 'px'})

        }


            $('#UpdateButton').click(function() {
             var SubcatID = $('#SID').val();
             var SubCatName = $('#SubCategoryName').val();
             var cate = []
             cate.push(SubcatID);
             cate.push(SubCatName);
            
             if (SubCatName != '')
             {
                 $.ajax({
                     type: "POST",
                     url: '<?php echo base_url(); ?>lab_test_manager/updateSubCategoryAjax',
                     data: {'Category': cate},
                     success: function(output) {
                         alert("Sub Category Updated Successfuly");
                         window.location.href = "<?php echo base_url();?>lab_test_manager";
                     }



                 });
             }
            
             


         });




     });


</script>

<div class="col-md-6 col-sm-offset-3">
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">Update Sub Category</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label for="SID" class="col-sm-4 control-label">Sub Category ID</label>
                <div class="col-sm-8">
                    <input id="SID" type="text" class="form-control" placeholder="Text input"  value=" <?php echo $SID; ?>" disabled>
                </div>
            </div>
           
            <div class="form-group">
                <label for="SubCategoryName" class="col-sm-4 control-label">Sub Category Name</label>
                <div class="col-sm-8">
                    <input id="SubCategoryName" type="text" class="form-control" required="true" placeholder="Text input"  value="<?php echo $SubcatName; ?>">
                </div>
            </div>
        </form>
    </div><!-- /.box-body -->
    <div class="box-footer">
        <button type="button" class="btn btn-primary" id="UpdateButton"> Edit</button>
    </div>
</div>
</div>

