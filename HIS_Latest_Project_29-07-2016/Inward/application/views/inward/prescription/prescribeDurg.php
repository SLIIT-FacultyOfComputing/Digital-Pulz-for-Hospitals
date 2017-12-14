<script type="text/javascript">
   
    window.onload = init;
   
    function init(){
        console.log("working");
        getDrugs();
        function getDrugs(){  
            console.log('calling drugs');

            var tex = "nul";

            $.ajax({ 
                url: 'http://localhost:8080/HIS_API/rest/DrugServices/getDrugNames',
                success: function(result) { 

                    //console.log("ajax called");
                    //console.log(result);
                    //drugs = $.parseJSON(result);
                    console.log(result.length);

                    for (var i = 0; i < result.length; i++) {
                        var drug =  result[i];
                        //console.log(drug);
                        var newOption = $(document.createElement('option')); 
                        /*var color = getDrugEntryColor( parseInt(drugs[i]['dSrNo'] ));
                                             newOption.attr('style',"color:" + color);
                         */
                        //console.log(drug.dName);
                        //console.log(drug.dSrNo);
                        newOption.attr('value',drug.dSrNo );  // have to change drug.dSrNo=================================================
                        newOption.text(drug.dName) ;


                        $('#inputDrug').append(newOption);
                        //$('#inputDrug').append("<option>Value</option>");
                    } 
                },
                async:   false
            }); 
        }
        
        function getDrugByID(drugID)
        {
  
            var newOption = $('<option>');
            newOption.attr('value', "Once a Day").text("Once a Day");
            $('#inputFrequency').append(newOption);
				
            newOption = $('<option>');
            newOption.attr('value', "Twice a Day").text("Twice a Day");
            $('#inputFrequency').append(newOption);
				
            newOption = $('<option>');
            newOption.attr('value', " Thrice a Day").text(" Thrice a Day");
            $('#inputFrequency').append(newOption);

            newOption = $('<option>');
            newOption.attr('value', "Custom").text("Custom");
            newOption.attr('id', "customentry2");
            $('#inputFrequency').append(newOption);
				
				
            newOption = $('<option>');
            newOption.attr('value', "1").text("1");
            $('#inputDosage').append(newOption);
				
            newOption = $('<option>');
            newOption.attr('value', "2").text("2");
            $('#inputDosage').append(newOption);
				
            newOption = $('<option>');
            newOption.attr('value', "3").text("3");
            $('#inputDosage').append(newOption);
				
            newOption = $('<option>');
            newOption.attr('value', "Custom").text("Custom");
            newOption.attr('id', "customentry1");
            $('#inputDosage').append(newOption);
			  
        }
        
        $( "#inputDrug" ).change(function() {
	
            $('#inputDosage').find('option').remove();
            $('#inputFrequency').find('option').remove();	
	 
            var drugID = $('#inputDrug').val();
            getDrugByID(drugID);
        });
	 


    }
   
</script>
<?php
foreach ($TermList as $value) {
    if ($value->no_of_terms == $count) {
        $Term_id = $value->term_id;
        ?> 
        <div class="panel panel-primary">
            <div class="panel-heading" style="background-color:whitesmoke"> 
                <h4 class="panel-title"  style="color:#428BCA"><b>Active Drug Chart</b><span  style="color:#428BCA" class="pull-right text-primary small "><em>
                            <span style="background-color: #dff0d8; border: 1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;:Continuous Drug&nbsp;&nbsp;&nbsp;

                            <span style="background-color: #d9edf7; border: 1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;:Active Drug&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Start Date : <?php echo date("Y-m-d ", $value->start_date / 1000); ?>


                        </em> </span>
                </h4>

            </div>
            <div class="panel-body">          
                <?php
                $kk = new PrescrptionC();
                $itmsList = $kk->getPrescrptionItemsByTermID($value->term_id);
                if (!$itmsList == NULL) {
                    ?>
                    <table class="table  table-hover">

                        <col style="width: 40%;">
                        <col style="width: 20%;">
                        <col style="width: 20%;">
                        <col style="width: 5%;">
                        <col style="width: 15%;">

                        <thead>
                        <th>Drug</th>
                        <th>Dosage</th>
                        <th>Frequency</th>
                        <th></th>
                        <th></th>
                        </thead>
                        <tbody>


                            <?php
                            foreach ($itmsList as $item) {
                                if ($item->status == 'active') {
                                    ?>
                                    <tr class="success">
                                        <td><?php echo $item->drug_id->dName; ?></td>
                                        <td><?php echo $item->dose; ?></td>
                                        <td><?php echo $item->frequency; ?></td>
                                        <td>
                                            <?php echo form_open('inward/PrescrptionC/OmitPrescrptionItem'); ?>
                                            <input name="auto_id" id="auto_id" type="hidden" value="<?php echo $item->auto_id ?>" >
                                            <input name="bhtno" id="bhtno" type="hidden" value="<?php echo $bht_no; ?>" >
                                            <input name="patientID" id="patientID" type="hidden" value="<?php echo $patient_id; ?>" >

                                            <button  type="submit" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Omit">
                                                <span class="glyphicon glyphicon-remove"> Omit </span>
                                            </button>
                                            <?php echo form_close(); ?> 
                                        </td>  
                                        <td>
                                            <?php echo form_open('inward/PrescrptionC/ChangeDrugView/' . $bht_no . '/' . $patient_id); ?>
                                            <input name="change" id="change" type="hidden" value="<?php echo "item"; ?>" >
                                            <input name="auto_id" id="auto_id" type="hidden" value="<?php echo $item->auto_id ?>" >
                                            <input name="Term_id" id="Term_id" type="hidden" value="<?php echo $Term_id; ?>" >
                                            <button  type="submit" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Change" onclick="<script>open('#modal');</script>">
                                                <span class="glyphicon glyphicon-pencil">Change</span>
                                            </button>
                                            <?php echo form_close(); ?> 

                                        </td>

                                    </tr>

                                    <?php
                                }
                            }
                            ?>                               
                        </tbody>
                    </table>
                    <?php
                }
                ?>
                <hr>
                <!--      Temp table data       -->
                <?php
                $kk = new PrescrptionC();
                $itmsList = $kk->getPrescrptionTempsByTermID($Term_id);
                if (!$itmsList == NULL) {
                    ?>
                    <table class="table table-hover">

                        <col style="width: 40%;">
                        <col style="width: 20%;">
                        <col style="width: 20%;">
                        <col style="width: 5%;">
                        <col style="width: 15%;">
                        <tbody>


                            <?php
                            foreach ($itmsList as $item) {
                                ?>
                                <tr class="info">
                                    <td><?php echo $item->drug_id->dName; ?></td>
                                    <td><?php echo $item->dose; ?></td>
                                    <td><?php echo $item->frequency; ?></td>
                                    <td>
                                        <?php echo form_open('inward/PrescrptionC/deletePrescrptionTemp'); ?>
                                        <input name="auto_id" id="auto_id" type="hidden" value="<?php echo $item->auto_id ?>" >
                                        <input name="bhtno" id="bhtno" type="hidden" value="<?php echo $bht_no; ?>" >
                                        <input name="patientID" id="patientID" type="hidden" value="<?php echo $patient_id; ?>" >

                                        <button  type="submit" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <span class="glyphicon glyphicon-trash"> Delete </span>
                                        </button>
                                        <?php echo form_close(); ?> 
                                    </td>  
                                    <td>
                                       <?php echo form_open('inward/PrescrptionC/ChangeDrugView/' . $bht_no . '/' . $patient_id); ?>
                                        <input name="change" id="change" type="hidden" value="<?php echo "temp"; ?>" >
                                            <input name="auto_id" id="auto_id" type="hidden" value="<?php echo $item->auto_id ?>" >
                                            <input name="Term_id" id="Term_id" type="hidden" value="<?php echo $Term_id; ?>" >
                                            <button  type="submit" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Change" onclick="<script>open('#modal');</script>">
                                                <span class="glyphicon glyphicon-pencil">Change</span>
                                            </button>
                                            <?php echo form_close(); ?>

                                    </td>
                                </tr>

                                <?php
                            }
                            ?>                               
                        </tbody>
                    </table>
                    <?php
                }
                ?>
                <?php echo form_open('inward/PrescrptionC/SavePrescrption'); ?>
                <input name="Term_id" id="Term_id" type="hidden" value="<?php echo $Term_id; ?>" >
                <input name="count" id="count" type="hidden" value="<?php echo $count; ?>" >                
                <input name="bhtno" id="bhtno" type="hidden" value="<?php echo $bht_no; ?>" >
                <input name="patientID" id="patientID" type="hidden" value="<?php echo $patient_id; ?>" >

                <button  type="submit" class="btn btn-primary " data-toggle="tooltip" data-placement="top" onclick="return confirm('Are you sure want to Save Prescription?');"  title="Save Prescription">
                    <span class=" glyphicon glyphicon-check">Save Prescription</span>
                </button>
                <?php echo form_close(); ?> 
            </div> 
        </div>
        <?php
    }
}
?>
<br/><br/>

<div class="panel panel-default" >
    <div class="panel-body">
        <div class="form-horizontal">

            <?php echo form_open('inward/PrescrptionC/InsertPrescrptionTemp'); ?>
            <table  class="table table-striped"> 


                <thead>

                <th>&nbsp;&nbsp;Drug</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;Dosage</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;Frequency</th>               
                <th></th>
                </thead>
                <tbody>
                    <tr>
                        <td>&nbsp;&nbsp;
                            <select style="margin-top: 2px; height: 250px; width:300px" required id="inputDrug" name ="inputDrug" multiple="multiple" rows="8" class="form-control">

                            </select>
                            <br/>
                        </td>

                        <td> <br/> &nbsp;&nbsp;&nbsp;

                            <select  style="height:200px;width:250px" required   id="inputDosage"  name="inputDosage" multiple="multiple" rows="8">

                            </select><br/>
                            &nbsp; &nbsp;&nbsp;<input id="custom1" readonly="readonly" type="text" value="Custom" />  
                        </td>

                        <td> <br/>
                            &nbsp;&nbsp; 
                            <select  style="height:200px;width:250px" required id="inputFrequency" name ="inputFrequency" multiple="multiple" rows="8">

                            </select><br/>
                            &nbsp;&nbsp;&nbsp;<input id="custom2"  readonly="readonly"  type="text" value="Custom" />  
                        </td>


                        <td> <br/>
                            &nbsp;&nbsp;&nbsp;
                            <?php
                            foreach ($TermList as $value) {
                                if ($value->no_of_terms == $count) {
                                    $Term_id = $value->term_id;
                                }
                            }
                            ?>
                            <input name="bhtno" id="bhtno" type="hidden" value="<?php echo $bht_no; ?>" >
                            <input name="patientID" id="patientID" type="hidden" value="<?php echo $patient_id; ?>" >
                            <input name="Term_id" id="Term_id" type="hidden" value="<?php echo $Term_id; ?>" >
                            <input class="btn btn-large  btn-primary " type="submit" value="+Add">
                        </td>
                    </tr>

                </tbody>
            </table> 
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

