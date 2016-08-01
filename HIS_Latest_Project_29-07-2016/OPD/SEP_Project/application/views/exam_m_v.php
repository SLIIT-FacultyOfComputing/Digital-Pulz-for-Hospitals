<script>
$(document).ready(function(){
<?php
if($exam[0]->active=='0'){
      
    echo "$('#myform :input:not(#active):not(.btn-primary)').attr('disabled', true); ";
}
?>
});

</script>
<div class="container">
  
  <div class="span10">
    
    <?php
    if(preg_match('/Edit/',$title))
    {
      echo form_open('exams_c/update/'.$pid."/".$examid, array('name' => 'myform','id' => 'myform'));
    }else
    {
      echo form_open('exams_c/save/'.$pid."/".$visitid, array('name' => 'myform','id' => 'myform'));
    }
    ?>
    <div class="form-horizontal">
      
      
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title"><?php echo $title; ?></h3>
        </div>
        <div >
          
          
          
          
          
          
          
          <!-- Message for operation status  ************************************************************** -->
          <?php
            if($status !== 0){
              if((!preg_match('/Edit/',$title)) & $status == "True"){
          ?>
          <div class="alert alert-success" style="margin-top: 5px">
            <button type="button" class="close" data-dismiss="alert" style="margin-right: 5%">&times;</button>
            <strong>Successfull !  </strong> Examination Added Successfully
          </div>
          <?php }else if( preg_match('/Edit/',$title) & $status == "True"){  ?>
          
          <div class="alert alert-success" style="margin-top: 5px">
            <button type="button" class="close" data-dismiss="alert" style="margin-right: 5%">&times;</button>
            <strong>Successfull !  </strong> Examination updated Successfully
          </div>
          
          <?php } ?>
          
          
          <?php if((!preg_match('/Edit/',$title)) & $status == "False"){ ?>
          
          <div class="alert alert-danger" style="margin-top: 5px;height: 55px;padding-left: 15px;padding-top: 14px">
            <strong>Fail !</strong> Faild to add the examination
            <button type="button" class="close" data-dismiss="alert" style="margin-right: 5%">&times;</button>
            
          </div>
          
          
          <?php }else if( preg_match('/Edit/',$title) & $status == "False"){  ?>
          <div class="alert alert-danger" style="margin-top: 5px;height: 55px;padding-left: 15px;padding-top: 14px">
            <button type="button" class="close" data-dismiss="alert" style="margin-right: 5%">&times;</button>
            <strong>Fail !</strong> Faild to update the examination
          </div>
          <?php } ?>
          <?php } ?>
          <!-- **************************************************************************************** -->
          
          
          <div class="form-horizontal span5 offset1">
            
            <?php  if(preg_match('/Edit/',$title) && $exam[0]->examActive=='0'){  ?>
            <div class="alert alert-danger">
              The record <strong> is not active  </strong>
            </div>
            <?php } ?>
            
            <!--          <div class="control-group" >
              <label class="control-label" >Exam Date Time</label>
              <div class="controls">
                <input type="text" style="width: auto" id="ExamDate" readonly value="<?php echo date('Y-m-d h:i:s A'); ?>" name="ExamDate" placeholder="">
              </div>
            </div>-->
            <div style="margin-left: 30px;margin-top: 10px">
              <div class="form-group input-group" >
                <span style="width: 185px"  class="input-group-addon">Exam Date Time</span>
                
                <input  type="text" style="width:200px" class="form-control" id="ExamDate" readonly value="<?php echo date('Y-m-d h:i:s A'); ?>" name="ExamDate" placeholder="">
                
              </div>
              
              <div class="form-group input-group" >
                <!--<label class="control-label" >Height in cm</label>-->
                <span style="width: 185px"  class="input-group-addon">Height in <b>cm</b></span>
                
                <input class="form-control" style="width:200px"  type="number" id="inputFName"  oninput="calBMI()" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01"  min="15" max="200" value="<?php if (preg_match('/Edit/', $title)) {
                echo $exam[0]->examHeight;
                } ?>" name="Height" placeholder="">
              </div>
              
              <div class="form-group input-group" >
                <span style="width: 185px"  class="input-group-addon">Weight in <b>Kg</b></span>
                <!--<label class="control-label" >Weight in Kg</label>-->
                
                <input class="form-control" style="width:200px" type="number" id="inputLName"  oninput="calBMI()" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01"  min="0" max="150" value="<?php if (preg_match('/Edit/', $title)) {
                echo $exam[0]->examWeight;
                } ?>" name="Weight" placeholder="" >
              </div>

              <div class="form-group input-group" >
                <span style="width: 185px"  class="input-group-addon">BMI</span>
                
                <input  type="text" style="width:200px" class="form-control" id="bmi" readonly name="bmi" placeholder="">
                
              </div>
              <!--              <div data-role="main" class="ui-content">
                <label for="points">Points:</label>-->
               <!--  <div class="form-group input-group" >
                  <span style="width: 185px"  class="input-group-addon">Points:</span>
                  <input class="form-control" style="width:200px" type="number" name="points" id="points" value="50" min="0" max="100">
                </div>
                 -->
                
                
                
                <div class="form-group input-group" >
                  <!--<label class="control-label" >Temperature in F*<sup>o</sup></label>-->
                  <span style="width: 185px"  class="input-group-addon">Temperature in <b>F*<sup>o</sup></b></span>
                  
                  <input class="form-control" style="width:200px" type="number" id="inputOName"   pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" min="96" max="106" value="<?php if (preg_match('/Edit/', $title)) {
                  echo $exam[0]->examTemp;
                  } ?>" name="Temperature" placeholder="">
                  
                </div>
                
                <div class="form-group input-group" >
                  <span style="width: 185px"  class="input-group-addon">Systolic Blood Preasure*</span>
                  <!--<label class="control-label" >Systolic Blood Preasure*</label>-->
                  
                  <input class="form-control" style="width:200px" type="number" id="inputOName"  required min="50" max="240" name="SysBP" placeholder="" value="<?php if (preg_match('/Edit/', $title)) {
                  echo $exam[0]->examSysBP;
                  } ?>">
                </div>
                
                
                <div class="form-group input-group">
                  <span style="width: 185px"  class="input-group-addon">Diastolic Blood Preasure*</span>
                  <!--<label class="control-label" >Diastolic Blood Preasure*</label>-->
                  
                  <input class="form-control" style="width:200px" type="number" id="inputOName" name="DiastBP" placeholder="" required   min="30" max="140"  value="<?php if (preg_match('/Edit/', $title)) {
                  echo $exam[0]->examDisatBP;
                  } ?>">
                  
                </div>
                
                
                <?php if(preg_match('/Edit/',$title)){?>
                <div class="control-group">
                  <label class="control-label" for="gender">Active </label>
                  <div class="controls">
                    <select id="active" name="active">
                      <option  <?php if ($exam[0]->examActive == '1') {
                        echo 'selected';
                      } ?>   value="1">Yes</option>
                      <option   <?php if ($exam[0]->examActive == '0') {
                        echo 'selected';
                      } ?>  value="0">No</option>
                    </select>
                  </div>
                </div>
                
                <div class="control-group">
                  <div class="controls">
                    <label  class="lastmod">Last edit by <?php echo $exam[0]->examLastUpdateUser->hrEmployee->firstName ." ".$exam[0]->examLastUpdateUser->hrEmployee->lastName. " on " . $exam[0]->examLastUpdate; ?></label>
                  </div>
                </div>
                
                <?php } ?>
                
                
                
              </div>
              
              
              <div class="container-fluid" style="margin-bottom:  10px">
                <div class="form-actions span14 offset1">
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <button type="submit" class="btn btn-primary"><?php if (preg_match('/Edit/', $title)) {
                  echo 'Update';
                  } else {
                  echo 'Save';
                  } ?></button>
                  <button type="reset" class='btn'  onclick="history.go(-1);">Cancel</button>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>

      <script type="text/javascript">

      /*var h,w,bmi;

      function calcbmi(){
      
      h = $('#inputFName').val();
      w = $('#inputLName').val();

      bmi = w / (h*h);

      return bmi;*/

      function calBMI()
      {

      var height = document.getElementById('inputFName').value;

      var h1 = height/100;

      var weight = document.getElementById('inputLName').value;

      var resultbmi = document.getElementById('bmi');

      var bmi = (weight/(h1*h1));

      resultbmi.value = bmi;

      }

      </script>