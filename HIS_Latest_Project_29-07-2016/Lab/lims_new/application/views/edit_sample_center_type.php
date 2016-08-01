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
             var SCID = $('#SCID').val();
             var type = $('#type').val();
             var lab = [];
             lab.push(SCID);
             lab.push(type);
             
             if (lab != '')
             {
                 
                 $.ajax({
                     type: "POST",
                     url: '<?php echo base_url();?>sample_centre_manager/UpdateSampleCenterTypesAjax',
                     data: {'lab': lab},
                     success: function(output) {
                           alert("Sample Center Type Updated Successfuly");
                           window.location.href = "<?php echo base_url();?>sample_centre_manager/";
                         
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
            <h3 class="box-title">Update Sample Center Type</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <form class="form-horizontal" role="form">
        <div class="box-body">
            <div class="form-group">
                <label for="SCID" class="col-sm-4 control-label">Sample Center Type ID</label>
                <div class="col-sm-8">
                <input id="SCID" type="text" class="form-control" placeholder="Text input" 
                value=" <?php echo $scid; ?>" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="type" class="col-sm-4 control-label">Sample Center Type Name</label>
                <div class="col-sm-8">
                <input id="type" type="text" class="form-control" required="true" placeholder="Text input" 
                value="<?php echo $type; ?>">
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button type="button" class="btn btn-primary"  id="UpdateButton">Edit</button>
        </div>
        </form>
    </div>
</div>
