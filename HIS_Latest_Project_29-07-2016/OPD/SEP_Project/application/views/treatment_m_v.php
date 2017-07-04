<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<script>
$(document).ready(function(){
  <?php
  if($treatment != null)
  {
    if($treatment[0]->active=='0'){
        
      echo "$('#myform :input:not(#active):not(.btn-primary)').attr('disabled', true); ";
    }
  }
  ?>

  $(".alert").removeClass("in").show();
  $ (".alert").delay(200).addClass("in").fadeOut(2010);
});

</script>

<section class="content-header">
    <h1>
        New Treatment
    </h1>
    <div class="col-md-9">
        <h4><small><b><?php
            if ($pprofile->patientTitle == "Baby")
                echo "$pprofile->patientTitle $pprofile->patientFullName";
            else
                echo "$pprofile->patientTitle $pprofile->patientFullName";
        ?> </b> / <?php echo "$pprofile->patientGender"; ?> / <?php 
                                date_default_timezone_set('Asia/Colombo');
                                echo (date("Y") - date("Y",$pprofile->patientDateOfBirth/1000));  ?>Yrs <?php 
                                date_default_timezone_set('Asia/Colombo');
                                echo (date("m") - date("m",$pprofile->patientDateOfBirth/1000));  ?>Mths <?php 
                                date_default_timezone_set('Asia/Colombo');
                                echo (date("d") - date("d",$pprofile->patientDateOfBirth/1000));  ?>Dys / 
                <?php echo "$pprofile->patientCivilStatus";?> / 
                <?php echo "$pprofile->patientAddress" ;?>
                </div></small></h4>
    <div class="col-md-3" align="right"><h4><small><?php echo "$pprofile->patientHIN"; ?></small></h4></div>
    <br>
    <br>
</section>

  

    
    <?php
    if(preg_match('/Edit/',$title))
    {
      echo form_open('treatment_c/update/'.$pid."/".$treatmentid, array('name' => 'myform','id' => 'myform'));
    }else
    {
      echo form_open('treatment_c/save/'.$pid."/".$visitid, array('name' => 'myform','id' => 'myform'));
    }
    ?>
      
      
      
<section class="content">
  <div class="row">
        <!-- left column -->
    <div class="col-md-12">
        <div class="box box-default">
          <div class="box-header">
            <h3 class="box-title">Treatment</h3>
          </div>
          
          
          <hr/>
          
          
          <!-- Message for operation status  ************************************************************** -->
          <?php
            if($status !== 0){
              if((!preg_match('/Edit/',$title)) & $status == $visitid){
          ?>
          <div class="alert alert-success fade" >
            <button type="button" class="close" data-dismiss="alert" id="x">×</button>
            <strong>Treatment Successfully added..</strong>
          </div>
          <?php }else if( preg_match('/Edit/',$title) & $status == $visitid){  ?>
          
          <div class="alert alert-success fade" >
            <button type="button" class="close" data-dismiss="alert" id="x">×</button>
            <strong>Treatment Successfully updated..</strong> 
          </div>
          
          <?php } ?>
          
          
          <?php if((!preg_match('/Edit/',$title)) & $status == "False"){ ?>
          
          <div class="alert alert-danger" style="margin-top: 5px;height: 55px;padding-left: 15px;padding-top: 14px">
            <strong>Failed!</strong> Failed to add the Treatment
            <button type="button" class="close" data-dismiss="alert" style="margin-right: 5%">&times;</button>
            
          </div>
          
          
          <?php }else if( preg_match('/Edit/',$title) & $status == "False"){  ?>
          <div class="alert alert-danger" style="margin-top: 5px;height: 55px;padding-left: 15px;padding-top: 14px">
            <button type="button" class="close" data-dismiss="alert" style="margin-right: 5%">&times;</button>
            <strong>Failed!</strong> Failed to update the Treatment
          </div>
          <?php } ?>
          <?php } ?>
          <!-- **************************************************************************************** -->
          
          
          <div class="form-horizontal span5 offset1">
            
            <?php  if(preg_match('/Edit/',$title) && $treatment[0]->active=='0'){  ?>
            <div class="alert alert-danger">
              The record <strong> is not active  </strong>
            </div>
            <?php } ?>
            
            <div style="margin-left: 30px;margin-top: 10px">
              <div class="form-group input-group" >
                <span style="width: 185px"  class="input-group-addon">Treatment Date Time</span>
                
                <input  type="text" style="width:210px" class="form-control" id="TreatmentDate" readonly value="<?php echo date('Y-m-d h:i:s A'); ?>" name="TreatmentDate" placeholder="">
                
              </div>

              
              <div class="form-group input-group">
                  <span style="width: 185px" class="input-group-addon">Treatment *</span> 
                  <select id="treatment" class="form-control" name="treatment" required>
                      <option selected="selected" value="" disabled>Select Test</option>
                      <?php foreach ( $treatment as $row ) { ?>
                        <option
                          itemid=<?php echo $row->treatmentId; ?>> <?php echo $row->treatmentId; ?>:<?php echo $row->treatment; ?>
                        </option> 

                      <?php } ?>
                  </select>
              </div>

            <div class="form-group input-group">
              <span style="width: 185px" class="input-group-addon">Remarks</span>
              <!--<label class="control-label" >Weight in Kg</label>-->
              <textarea style="width:210px" class="form-control" id="Remarks" name="remarks" value="<?php if (preg_match('/Edit/', $title)) {
                echo $treatment[0]->remarks;
              } ?>" name="remarks" placeholder="" ></textarea>
             
            </div>

              
              
              <div class="form-group input-group">
                <span style="width: 185px"  class="input-group-addon">Active</span>
                <!--<label class="control-label" >Diastolic Blood Preasure*</label>-->
                
                <select style="width:210px" id="active" class="form-control">
                       <option  <?php if ($treatment[0]->active == '1') {
                      echo 'selected';
                    } ?>   value="1">Yes</option>
                    <option   <?php if ($treatment[0]->active == '0') {
                      echo 'selected';
                    } ?>  value="0">No</option>
                  </select>

              </div>
                
                

              
                
              <div><b>Fields marked with an asterisk must be filled</b></div><br/>
                
              </div>
              
              
              <div class="container-fluid" style="margin-bottom:  10px">
                <div class="form-actions span14 offset1">
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <button type="submit" class="btn btn-primary"><?php if (preg_match('/Edit/', $title)) {
                  echo 'Update';
                  } else {
                  echo 'Save';
                  } ?></button>
                 <!--  <button type="reset" class='btn'  onclick="history.go(-1);">Back</button> -->
                </div>
              </div>
            </div>
            <br/>
          </div>
        </div>
      </div>
</section>
