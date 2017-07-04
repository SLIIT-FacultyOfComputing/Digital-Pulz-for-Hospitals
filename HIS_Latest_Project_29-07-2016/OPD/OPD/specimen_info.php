<?php
$array = $this->uri->uri_to_assoc(3);
?>
<!-- Custom JavaScript for the Menu Toggle -->
<script xmlns="http://www.w3.org/1999/html">
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

        <?php
        $array = $this->uri->uri_to_assoc(7);
      
        $hin = $array['HIN'];
      
        ?>






        $('#datetimepicker2').datepicker({
            changeMonth: true,
            changeYear: true,
            dateonly: true,
            dateFormat: 'yyyy-mm-dd'
        });
        $('#datetimepicker1').datepicker({
            changeMonth: true,
            changeYear: true,
            dateonly: true,
            dateFormat: 'yyyy-mm-dd'
        });
        $('#datetimepicker3').datepicker({
            changeMonth: true,
            changeYear: true,
            dateonly: true,
            dateFormat: 'yyyy-mm-dd'
        });
        $('#datetimepicker4').datepicker({
            changeMonth: true,
            changeYear: true,
            dateonly: true,
            dateFormat: 'yyyy-mm-dd'
        });


    });


</script>
<style>
.form-horizontal .control-label{
  text-align:left;
}
</style>
<div class="col-md-12">
    <div class="box box-solid box-primary">
        <div class="box-header">
            <h3 class="box-title">Specimen Information</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
           <div class="row">
                <div class="col-md-6">
                    <div class="box box-solid box-info">
                        <div class="box-header">
                            <h3 class="box-title">Patient Details</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-info btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <form class="form-horizontal" role="form" id="specimen_frm">
                        <input type="hidden" name="flabtestrequest_ID" value="<?php
                        $array = $this->uri->uri_to_assoc(3);
                        $reqid = $array['ReqID'];
                        echo $reqid; ?>">
                        <div class="box-body form-horizontal" id="patient_panel">
                            <div class="form-group">
                                <label for="PID" class="col-sm-4 control-label">Patient's HIN</label>
                                <div class="col-sm-8">
                                    <input id="PID" type="text" class="form-control" placeholder="Text input" value="<?php echo  $hin; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Fullname" class="col-sm-4 control-label">Full Name</label>
                                <div class="col-sm-8">
                                    <input id="Fullname" type="text" class="form-control" placeholder="Text input" value="<?php echo $specimen->fpatient_ID->patientFullName; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="gender" class="col-sm-4 control-label">Gender</label>
                                <div class="col-sm-8">
                                    <input id="gender" type="text" class="form-control" placeholder="Text input" value="<?php echo ucfirst($specimen->fpatient_ID->patientGender); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dob" class="col-sm-4 control-label">Date of birth</label>
                                <div class="col-sm-8">
                                    <input id="dob" type="text" class="form-control" placeholder="Text input" value="<?php echo date('Y-m-d', $specimen->fpatient_ID->patientDateOfBirth); ?>">
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-solid box-info">
                        <div class="box-header">
                            <h3 class="box-title">Test Details</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-info btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class=" form-horizontal">
                                <div class="form-group">
                                    <label for="ReqID" class="col-sm-4 control-label" ">Request ID</label>
                                    <div class="col-sm-8">
                                        <input id="ReqID" type="text" class="form-control" placeholder="Text input" value="<?php echo $specimen->labTestRequest_ID; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Category" class="col-sm-4 control-label" ">Category</label>
                                    <div class="col-sm-8">
                                        <input id="Category" type="text" class="form-control" placeholder="Text input" value="<?php echo $specimen->ftest_ID->fTest_CategoryID->category_Name; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="SubCategory" class="col-sm-4 control-label" ">Sub category</label>
                                    <div class="col-sm-8">
                                        <input id="SubCategory" type="text" class="form-control" placeholder="Text input" value="<?php echo $specimen->ftest_ID->fTest_Sub_CategoryID->sub_CategoryName; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="TestName" class="col-sm-4 control-label" ">Test Name</label>
                                    <div class="col-sm-8">
                                        <input id="TestName" type="text" class="form-control" placeholder="Text input" value="<?php echo $specimen->ftest_ID->test_Name; ?>">
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                    </div>
                </div>
           </div>
           <div class="row">
               <div id="response" style="display: none;"></div>
           </div>
           <div class="row">
               <div class="col-md-12">
                   <div class="box box-solid box-info">
                       <div class="box-header">
                           <h3 class="box-title">Specimen Details</h3>
                           <div class="box-tools pull-right">
                               <button class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                               <button class="btn btn-info btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                           </div>
                       </div>
                       <div class="box-body">
                           <div class="row">
                           <div class="col-md-6">
                               <div class=" form-horizontal">
                                   <div class="form-group">
                                       <label for="SpecimenType" class="col-sm-4 control-label"">Type</label>
                                       <div class="col-sm-8">
                                           <?php if (!empty($specimen_in_details)): ?>
                                               <label class="form-control"><?php echo $specimen_in_details->fSpecimentType_ID->specimen_TypeName;?></label>
                                           <?php else:?>
                                               <select id="SpecimenType" name="SpecimenType" class="form-control" required="">

                                                   <option selected="selected" value="">Select a Type</option>
                                                   <?php foreach ($specimen_types as $item): ?>
                                                       <option value="<?php echo $item->specimenType_ID; ?>"><?php echo $item->specimen_TypeName; ?></option>
                                                   <?php endforeach; ?>
                                               </select>
                                           <?php endif; ?>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label for="retentionType" class="col-sm-4 control-label"">Retention Type</label>
                                       <div class="col-sm-8">
                                           <?php if (!empty($specimen_in_details)): ?>
                                               <label class="form-control"><?php echo $specimen_in_details->fRetentionType_ID->retention_TypeName;?></label>
                                           <?php else:?>
                                               <select id="retentionType" name="retentionType" class="form-control" required="">

                                                   <option selected="selected" value="">Select a Type</option>
                                                   <?php foreach ($specimen_retension_types as $item): ?>
                                                       <option value="<?php echo $item->retention_TypeID; ?>"><?php echo $item->retention_TypeName; ?></option>
                                                   <?php endforeach; ?>
                                               </select>
                                           <?php endif; ?>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label for="datetimepicker1" class="col-sm-4 control-label"">Collected Date</label>
                                       <div class="col-sm-8">
                                               <input  type="text" placeholder="collected date" id="datetimepicker1" name="collected_date" class="form-control" required="" value="<?php echo (isset($specimen_in_details->specimen_CollectedDate))? date('Y-m-d',$specimen_in_details->specimen_CollectedDate/1000):"";?>">
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label for="ramrks" class="col-sm-4 control-label"">Remarks</label>
                                       <div class="col-sm-8">
                                           <textarea id="remarks" name="remarks" class="form-control" rows="4" cols="100" required=""><?php echo (isset($specimen_in_details->remarks))? $specimen_in_details->remarks:"";?></textarea>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="col-md-6">
                               <div class=" form-horizontal">
                                   <div class="form-group">
                                       <label for="location" class="col-sm-4 control-label">Location</label>
                                       <div class="col-sm-8">
                                           <input id="stored_location" name="stored_location" type="text" class="form-control" placeholder="Text input" required="" value="<?php echo (isset($specimen_in_details->stored_location))? $specimen_in_details->stored_location:"";?>">
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <?php
                                       $stored = "";
                                       $destroyed = "";
                                       if(isset($specimen_in_details->stored_or_destroyed)):
                                       ?>
                                       <label for="stored" class="col-sm-4 control-label">
                                       <?php
                                           echo ucfirst($specimen_in_details->stored_or_destroyed);
                                       ?>
                                       </label>
                                   </div>
                                   <?php else:?>
                                   <div class="form-group" id="RadioButtonGroup1">
                                       <div class="col-sm-4"></div>
                                       <div class="col-sm-8">
                                           <div class="radio">
                                               <label>
                                               <input type="radio"  name="stored_or_destroyed" value="stored" required="" <?php echo $stored;?>>
                                               Stored
                                               </label>
                                           </div>
                                           <div class="radio">
                                               <label>
                                               <input type="radio"  name="stored_or_destroyed" value="destroyed" required="" <?php echo $destroyed;?>>
                                               Destroyed
                                               </label>
                                           </div>
                                       </div>
                                   </div>
                                   <?php endif;?>
                                   <div class="form-group">
                                       <label for="datetimepicker4" class="col-sm-4 control-label">Stored/Destroyed Date</label>
                                       <div class="col-sm-6">
                                           <input  type="text" placeholder="Due date" id="datetimepicker4" name="CompletedDate" class="form-control" required="" value="<?php echo (isset($specimen_in_details->specimen_stored_destroyed_date))? date('Y-m-d',$specimen_in_details->specimen_stored_destroyed_date/1000):"";?>">
                                       </div>
                                   </div>
                                   <div class ="row">
                                   <div class="col-md-offset-6">
                                    <div id="buttonGroup" >
                                   <?php if(!$status=="complete") { ?>

                                  
                                       <div class="btn-group">
                                          
                                           <button type="submit" class="btn btn-primary" id="add_specimen">Apply</button>
                                           <button type="reset" class="btn btn-primary" >Reset</button>
                                          
                                      <?php } ?>

                                            <a href="<?php echo base_url('test_request'); ?>" class="btn btn-primary">Back</a>
                                       </div>
                                   </div>
                                   </div>
                                   </div>
                                   <div id="buttonGroup" style="margin-top: 10px">
                                       <label for="location" class="col-sm-2 control-label"> </label>
                                       <img alt="12345" src="<?php echo base_url('assets/Barcode/barcode.php'); ?>?codetype=Code39&size=40&text=<?php echo $reqid;?>" style="display: none;" />
                                   </div>
                               </div>
                           </div>
                           </div>
                       </div><!-- /.box-body -->
                       </form>
                   </div>
               </div>
           </div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>

<script type="text/javascript" src="<?php echo base_url('assets/plugins/print/jQuery.print.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/get_barcode_from_image.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#patient_panel').find('input, textarea, button:not(#print_bc), select').attr('disabled', 'disabled');
        <?php
        if(isset($array['status']) && $array['status'] == "complete"):?>
              $('#specimen_frm').find('input, textarea, button:not(#print_bc), select').attr('disabled', 'disabled');  
        <?php endif;?>   
        
        
        
        $("#print_bc").hide();
        $("#barcode_img").hide();
        $("#specimen_frm").on("submit", function(e) {
            e.preventDefault();
            $("#response").html("");
            $("#response").removeClass();
            $("#response").hide();
            $("#print_bc").hide();
            $("#barcode_img").hide();
            var post_data = $("#specimen_frm").serialize();
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>specimen_info/add',
                data: post_data,
                dataType: 'JSON',
                success: function(output) {
                    $('#specimen_frm').find('input, textarea, button:not(#print_bc), select').attr('disabled', 'disabled');
                    $("#response").html("Specimen details saved successfully.");
                    $("#response").addClass("alert alert-success");
                    $("#response").show();
                    $("#print_bc").show();
                    $("#barcode_img").show();
                  
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });
        });

        $("#specimen_frm").on("click", "#print_bc", function() {
            $("#barcode_img").print();
        });
    });
</script>









