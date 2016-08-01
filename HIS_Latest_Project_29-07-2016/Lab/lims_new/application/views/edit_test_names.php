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
                var TID = $('#TID').val();    
                var CID = $('#category').val();
                var SID = $('#subcategory').val();
                var testName = $('#testName').val();

             var test = []
             test.push(TID);
             test.push(CID);
             test.push(SID);
             test.push('1');
             test.push(testName);
             if (testName != '')
             {
                 $.ajax({
                     type: "POST",
                     url: '<?php echo base_url(); ?>lab_test_manager/updateTestNamesAjax',
                     data: {'test': test},
                     success: function(output) {
                         alert("Test Name Updated Successfuly");
                        
                          window.location.href = "<?php echo base_url();?>lab_test_manager/";
                     }



                 });
             }
            
             


         });




     });


</script>

<div class="col-md-6 col-sm-offset-3">
    <div class="box box-solid box-primary">
        <div class="box-header">
            <h3 class="box-title">Update Lab Test</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="TID" class="col-sm-4 control-label" >Test ID</label>
                    <div class="col-sm-8">
                        <input id="TID" type="text" class="form-control" placeholder="Text input" value=" <?php echo urldecode($TID); ?>" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="category" class="col-sm-4 control-label" >Category</label>
                    <div class="col-sm-8">
                        <input id="category" type="text" class="form-control" required="true" placeholder="Text input" value="<?php echo urldecode($cat); ?>" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="subcategory" class="col-sm-4 control-label" >Sub Category</label>
                    <div class="col-sm-8">
                        <input id="subcategory" type="text" class="form-control" required="true" placeholder="Text input" value="<?php echo urldecode($sub); ?>" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="testName" class="col-sm-4 control-label" >Test Name</label>
                    <div class="col-sm-8">
                        <input id="testName" type="text" class="form-control" required="true" placeholder="Text input" value="<?php echo urldecode($TN); ?>">
                    </div>
                </div>
            </form>
        </div>
        <div class="box-footer">
            <button type="button" class="btn btn-primary" id="UpdateButton"> Edit</button>
        </div>
    </div>
</div>
