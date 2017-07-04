<br/>
<?php echo form_open('History/PatientHistoryDetailsC/index'); ?>
<table>
    <col style="width: 80px;">
    <col style="width: 300px;">
    <col style="width: 100px;">

    <tr>
        <td style=" vertical-align: middle"> 
            &nbsp;
            <label  for="patientID"  >Patient ID</label>

        </td>
        <td style=" vertical-align: middle">
            <input id="patientHin" name="patientHin" type="text" class="form-control" value="" required="required" />
        </td>
        <td style=" vertical-align: middle">
            &nbsp;
            <button name="btnSubmit" type="submit" class="btn btn-success " data-toggle="tooltip" data-placement="top" title="Search Patient">
                <span   class="glyphicon glyphicon-search">Search</span>
            </button>
        </td>
    </tr>
</table>


<?php echo form_close(); ?>  

<?php

if(isset($patientData)){
    print_r($patientData);
?>
<br>
<br>
<div id="accordion" class="panel panel-primary">
        
        

                 
        <div class="panel-heading" style="background-color:whitesmoke">
                <h4 class="panel-title" style="color:#428BCA">Patient Details</h4>
            </div>
            <div class="panel-body">
                <div class="panel-body" id="panel2">


                    <div class="row">
                        
                       <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Address : </label> <?php echo $patientData[0]->patientAddress;   ?>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Previous History: </label> <?php echo $patientData[0]->previousHistory;   ?>
                        </div>                                
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Gender : </label>  
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Date of Birth : </label>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Civil Status : </label>
                        </div>                                
                    </div>
                </div>
            </div>
</div>

<?php
}
?>