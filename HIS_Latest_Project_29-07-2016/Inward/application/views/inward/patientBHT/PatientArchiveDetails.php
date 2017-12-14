<?php

?>
<div style="color: white">
<?php echo "$patients->patientID"; ?> 
</div>
<?php echo form_open('History/PatientArchiveC/SearchPatientDownload'); ?>


<table>
    <col style="width: 80px;">
    <col style="width: 300px;">
    <col style="width: 100px;">

        <tr>           
            
        <div style="font-size: 20px;color: #39cccc">Patient History,Diagonosis and Treatment:</div>
            
        </tr>
        <tr>     
        <br>     
        <br>
        </tr>
         <tr>           
            
            <div>Patient HIN:<?php echo "$patients->patientHIN"; ?></div>
            
        </tr>
         <tr>     
        <br>     
        <br>
        </tr>
        <tr>           
            
            <div>Patient Full Name:<?php echo "$patients->patientFullName"; ?></div>
            
        </tr>
        <tr>     
        <br>     
        <br>
        </tr>
        <tr>           
            
            <div>Patient NIC:<?php echo "$patients->patientNIC"; ?></div>
            
        </tr>
        <tr>     
        <br>     
        <br>
        </tr> 
    <tr>
               
         <td style=" vertical-align: middle"> 
            &nbsp;
            
      
  <label  for="patientID"  >Patient ID  </label>
        </td>
        
        <td style=" vertical-align: middle">
            <input id="patientID" name="patientID" type="text" class="form-control" value="<?php echo "$patients->patientID"; ?>" required="required" />
        </td>
<!--            <td style=" vertical-align: middle">
            <input id="patientID" name="patientID" type="text" class="form-control" value="<?php echo "$patients->patientHIN"; ?>" required="required" />
        </td>-->
        <td>
          <button name="btnSubmit" type="submit" class="btn btn-success " data-toggle="tooltip" data-placement="top" title="Search Patient">
                <span   class="glyphicon glyphicon-search">Download</span>
            </button>
        </td>
    </tr>
</table>



<?php echo form_close(); ?>  
