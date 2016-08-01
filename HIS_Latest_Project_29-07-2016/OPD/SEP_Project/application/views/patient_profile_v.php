 <script type="text/javascript" src="<?php echo base_url()."assets/"?>js/divSwitch.js"></script>
  
 <div class="panel panel-info" style="margin-left: 25px; width: 1000px"><!-- starting point of panel-->
            <div class="panel-heading"><!-- starting point of panel head-->
              <h3 class="panel-title">Patient Profile</h3>
            </div><!-- Ending point of panel head-->
    <div class="panel-body"><!-- starting point of body-->
              
          
 
<div class="" style="
    margin-top: 15px;
    width: 1000px;
    margin-left:5px;
    height: auto;
" id="patientprofile" >
   
    <div class="span12 gray-col" style="width: 64%;margin-left:20px;overflow:hidden">



        <?php if (!preg_match("/edit/", $_SERVER['REQUEST_URI'])) { ?>
     
            <span style="position:absolute; margin:25px 10px 0px 577px; cursor:pointer;"><a href="<?php echo base_url() . 'index.php/patient_c/edit/' . $pprofile->patientID; ?>"><img style="  float: right;    margin-left: 100px;" src="<?php echo base_url() . "/assets/" ?>ico/edit.png" title="Edit Patient Profile"/></a></span><?php } ?>

            <div  style="top: 105px;position: absolute;width: 12%;height: 168px; padding-top:4% " >
                <img style="width: 135px; height: 120px; padding-left: 2px;" src="<?php
                if ((strpos($pprofile->patientPhoto, 'null') !== FALSE) | $pprofile->patientPhoto == "" | $pprofile->patientPhoto == null) {
                    //echo base_url() . '/assets/ico/proimage.jpg';
                    {
                        if ($pprofile->patientGender == 'Male')
                            echo base_url() . "/assets/ico/proimage.jpg";
                        else if($pprofile->patientGender == 'Female')
                            echo base_url() . "/assets/ico/proimagefemale.png";
                        else {
                            echo base_url() . "/assets/ico/proimage.jpg";
                        }
                    }
                } else
                    echo base_url() . '/uploads/patient_photos/'.$pprofile->patientPhoto;
                ?>" />
            </div>
        			 
<form class="form-horizontal" method="POST" style="margin-left: 100px">
  
        <table class="tablepprofile table-hover " style="margin-left:170px">
         
            <tr>
                <td style="padding-right:  40px"><strong>Name</strong> </td>
                <td style="padding-left: 10px"> 
                    <?php if ($pprofile->patientTitle == "Baby") echo "$pprofile->patientTitle $pprofile->patientFullName";
                    else echo "$pprofile->patientTitle $pprofile->patientFullName"; ?> 
                </td>
			
            </tr>
            <tr>
                <td style="padding-right:  40px"><strong>HIN</strong> </td>
                <td style="padding-left: 10px">
                    <?php echo "$pprofile->patientHIN"; ?></td>
            </tr>
            
            <tr>
                <td ><strong>Gender</strong> </td>
                <td style="padding-left: 10px">
                    <?php echo "$pprofile->patientGender"; ?></td>
            </tr>
            <tr>
                <td style="width: 90px"><strong>Civil Status</strong></td>
                <td style="padding-left: 10px">
				<?php echo "$pprofile->patientCivilStatus";?></td>
				 
            </tr>
            <tr>
                <td style="width: 50px"><strong>Date of Birth</strong></td>
                <td style="padding-left: 10px">   
				<?php echo date("d-m-Y",$pprofile->patientDateOfBirth/1000);  ?></td>
            </tr>
            <tr>
                <td ><strong>Phone </strong></td>
                <td style="padding-left: 10px"> 
				<?php echo "$pprofile->patientTelephone";?></td>
			 
            </tr>
            <tr>
                <td><strong>Address </strong></td>
                <td style="padding-left: 10px">
				<?php echo "$pprofile->patientAddress" ;?>
				</td>
              
               
            </tr>
			
         
        </table>
        </form>
</div>
</div>

   </div><!-- Ending point of panel head-->
 </div><!-- Ending point of panel-->
   