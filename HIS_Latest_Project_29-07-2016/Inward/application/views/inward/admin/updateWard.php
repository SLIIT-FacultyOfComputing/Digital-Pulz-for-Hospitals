<?php
foreach ($wards as $value) {
    $wardNo = $value->wardNo;
    $category = $value->category;
    $gender = $value->wardGender;
//     $beds= $value->noOfBed;
}
?>
<div class="alert alert-warning">
     <a href="#" class="close" data-dismiss="alert">
      &times;
   </a>
<section>
    <legend>Update Ward Details</legend>
     <?php echo form_open('inward/wardManageC/UpdateWardDetails'); ?>
    <fieldset>

        <div class="form-group">
            <label style="color: #797979;" for="wardNo"  class="col-sm-2 control-label">Ward No</label>
            <div class="col-xs-4">
                <input id="No" name="No" type="text" class="form-control" value="<?php echo $wardNo; ?>" disabled />
                <input id="wardNo" name="wardNo" type="hidden" value="<?php echo $wardNo; ?>">

            </div>
            <br/>
            <div class="form-group">
                <br/>
                <label style="color: #797979;" for="category"  class="col-sm-2 control-label">Ward Category <span class="required">*</span></label>
                <div class="col-xs-4">
                    <input id="category" name="category" type="text" class="form-control" value="<?php echo $category; ?>" required="required" />
                </div>
            </div>

            <div class="form-group">
                <br/>
                <label style="color: #797979;" for="wardGender" class="col-sm-2 control-label">Ward Type<span class="required">*</span></label>
                <div class="col-xs-4">

                    <?php
                    if ($gender == 'Male') {
                        ?>

                        <div class="radio">
                            <label style="color: #797979;" class="radio-inline">
                                <input  type="radio" name="wardGender" value="Male" required="required" checked/>Male
                            </label>
                        </div> 

                        <div class="radio">
                            <label style="color: #797979;" class="radio-inline">
                                <input  type="radio" name="wardGender" value="Female" required="required"/>Female<br />
                            </label>
                        </div> 
                        <?php
                    } else {
                        ?>
                        <div class="radio">
                            <label class="radio-inline">
                                <input  type="radio" name="wardGender" value="Male" required="required"/>Male
                            </label>
                        </div> 

                        <div class="radio">
                            <label class="radio-inline">
                                <input  type="radio" name="wardGender" value="Female" required="required" checked/>Female<br />
                            </label>
                        </div> 

                        <?php
                    }
                    ?>

                </div>
            </div> 

            <br/>

            <div class="form-group">
                
                <input type="submit" class="btn btn-large btn-info msgbox-confirm" value="Update Ward" name="btnSubmit" >
            </div>
    </fieldset>
    <?php echo form_close(); ?>     
</section>
</div>