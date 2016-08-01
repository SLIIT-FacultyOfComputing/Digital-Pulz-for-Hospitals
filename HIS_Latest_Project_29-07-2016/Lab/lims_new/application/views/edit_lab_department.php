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
             var DID = $('#DID').val();
             var DeptName = $('#DeptName').val();
             var lab = []
             lab.push(DID);
             lab.push(DeptName);
             
             if (DeptName != '')
             {
                 
                 $.ajax({
                     type: "POST",
                     url: '<?php echo base_url();?>lab_manager/updateLabDeptAjax',
                     data: {'lab': lab},
                     success: function(output) {
                           alert("Department Updated Successfuly");
                           window.location.href = "<?php echo base_url();?>lab_manager";
                     }



                 });
             }
            
             


         });




     });


</script>


<div class="col-md-6 col-sm-offset-3">
    <!-- Primary box -->
    <div class="box box-solid box-primary">
        <div class="box-header">
            <h3 class="box-title">Update Department</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <form class="form-horizontal" role="form">
            <div class="box-body">
                <div class="form-group">
                    <label for="DID" class="col-sm-4 control-label" >Department ID</label>
                    <div class="col-sm-8">
                        <input id="DID" type="text" class="form-control" placeholder="Text input" value=" <?php echo $DID; ?>" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="DeptName" class="col-sm-4 control-label" >Department Name</label>
                    <div class="col-sm-8">
                        <input id="DeptName" type="text" class="form-control" required="true" placeholder="Text input" value="<?php echo $DeptName; ?>">
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="button" class="btn btn-primary" id="UpdateButton">Edit</button>
            </div>
        </form>
    </div>
</div>
