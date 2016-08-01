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
             var LID = $('#LID').val();
             var LabName = $('#LabName').val();
             var lab = [];
             lab.push(LID);
             lab.push(LabName);
             
             if (LabName != '')
             {
                 
                 $.ajax({
                     type: "POST",
                     url: '<?php echo base_url();?>lab_manager/updateLabAjax',
                     data: {'lab': lab},
                     success: function(output) {
                           alert("Lab Type Updated Successfuly");
                           window.location.href = "<?php echo base_url();?>lab_manager/";
                         
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
            <h3 class="box-title">Update Laboratory Type</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <form class="form-horizontal" role="form">
        <div class="box-body">
            <div class="form-group">
                <label for="LID" class="col-sm-4 control-label">Laboratory ID</label>
                <div class="col-sm-8">
                <input id="LID" type="text" class="form-control" placeholder="Text input" value=" <?php echo $LabID; ?>" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="LabName" class="col-sm-4 control-label">Laboratory Name</label>
                <div class="col-sm-8">
                <input id="LabName" type="text" class="form-control" required="true" placeholder="Text input" value="<?php echo $LabName; ?>">
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button type="button" class="btn btn-primary"  id="UpdateButton">Edit</button>
        </div>
        </form>
    </div>
</div>
