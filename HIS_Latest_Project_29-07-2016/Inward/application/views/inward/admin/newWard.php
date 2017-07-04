<div class="panel panel-primary" >
    <div class="panel-heading" style="background-color:whitesmoke">
        <h4 class="panel-title" style="color:#428BCA">Wards Manage</h4>
    </div>
    <div class="panel-body">
        <script> 
            $(document).ready(function(){
                $("#flip").click(function(){
                    $("#panel").slideToggle("slow");
                });
            });
        </script>
        <style> 

            #panel
            {
                height: 160px;
              
            }
        </style>

        <div id="flip">
            <a style="cursor: pointer;">Add New Ward</a>
        </div>

        <div class="alert alert-info" id="panel">
            <?php echo form_open('inward/wardManageC/inserWardDetails'); ?>


            <fieldset>

                <div class="form-group">
                    <label for="wardNo"  class="col-sm-2 control-label">Ward No<span class="required">*</span></label>
                    <div class="col-xs-4">
                        <input id="wardNo" name="wardNo" type="text" class="form-control" value="" required="required" />
                    </div>

                </div>
                <div class="form-group">
                    <br/>
                    <label for="category"  class="col-sm-2 control-label">Ward Category <span class="required">*</span></label>
                    <div class="col-xs-4">
                        <input  id="category" name="category" type="text" class="form-control" value="" required="required" />
                    </div>
                </div>

                <div class="form-group">
                    <br/>
                    <label for="wardGender" class="col-sm-2 control-label">Ward Type<span class="required">*</span></label>
                    <div class="col-xs-4">

                        <div class="radio">
                            <label class="radio-inline">
                                <input  type="radio" name="wardGender" value="Male" required="required"/>Male
                            </label>
                        </div> 

                        <div class="radio">
                            <label class="radio-inline">
                                <input  type="radio" name="wardGender" value="Female" required="required"/>Female<br />
                            </label>
                        </div> 

                    </div>

                </div>
                <br/>
                <div class="form-group">

                    <input type="submit" class="btn btn-large btn-info " value="Create Ward" name="btnSubmit" >
                </div>
            </fieldset>             
            <?php echo form_close(); ?> 
        </div>


