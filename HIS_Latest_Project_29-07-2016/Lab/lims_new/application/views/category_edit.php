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
             var catID = $('#CID').val();
             var CatName = $('#CategoryName').val();
             var cate = []
             cate.push(catID);
             cate.push(CatName);
             
             if (CatName != '')
             {
                 $.ajax({
                     type: "POST",
                     url: '<?php echo base_url(); ?>lab_test_manager/updateCategoryAjax',
                     data: {'Category': cate},
                     success: function(output) {
                          alert("Category is updated successfuly !");
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
        <h3 class="box-title">Update Category</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="CID" class="col-sm-2 control-label">Category ID</label>
            <div class="col-sm-8">
                <input id="CID" type="text" class="form-control" placeholder="Text input" value=" <?php echo $catID; ?>" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="CategoryName" class="col-sm-2 control-label">Category Name</label>
            <div class="col-sm-8">
                <input id="CategoryName" type="text" class="form-control" required="true" placeholder="Text input" value="<?php echo $catName; ?>">
            </div>
        </div>
    </div><!-- /.box-body -->
    <div class="box-footer">
        <button type="button" class="btn btn-primary" id="UpdateButton">Edit</button>
    </div>
</div>
</div>