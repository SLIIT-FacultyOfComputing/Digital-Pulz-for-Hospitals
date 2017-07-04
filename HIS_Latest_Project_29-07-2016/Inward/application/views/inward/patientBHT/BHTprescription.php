<script type="text/javascript">
    //---------------------------
    //    var index = 1;
    //function insertRow(){
    //            var table=document.getElementById("myTable");       
    //            var drug=document.getElementById("inputDrug").value;
    //            var dose=document.getElementById("inputDosage").value;
    //            var frequnce=document.getElementById("inputFrequency").value;
    //            if(!(drug==="" & dose ==="" & frequnce===""))
    //                {
    //            var row=table.insertRow(table.rows.length);
    //            
    //            var cell1=row.insertCell(0);
    //            var t1=document.createElement("input");
    //                t1.id = "txtName"+index;
    //                t1.value=drug;
    //                cell1.appendChild(t1);
    //                
    //            var cell2=row.insertCell(1);
    //            var t2=document.createElement("input");
    //                t2.id = "txtAge"+index;
    //                t2.value=dose;
    //                cell2.appendChild(t2);
    //                
    //            var cell3=row.insertCell(2);
    //            var t3=document.createElement("input");
    //                t3.id = "txtGender"+index;
    //                t3.value=frequnce;
    //                cell3.appendChild(t3);
    //           
    //           
    //      index++;
    //      }
    //
    //}
    //---------------------
   
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
                        newOption.attr('value',drug.dName );  // have to change drug.dSrNo=================================================
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
            newOption.attr('value', "1/3").text("1/3");
            $('#inputDosage').append(newOption);
				
            newOption = $('<option>');
            newOption.attr('value', "1").text("1");
            $('#inputDosage').append(newOption);
				
            newOption = $('<option>');
            newOption.attr('value', "2").text("2");
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
foreach ($wardadmission as $value) {

    $bhtNo = $value->bhtNo;
    $patientID = $value->patientID->patientID;
}
?>


<div >
    <a style="cursor: pointer;">Add New Drug</a>
</div>

<div class="panel panel-info" >
    <div class="panel-heading">

    <div class="form-horizontal">

        <?php echo form_open('inward/patientBHTC/AddDrug/' . $bhtNo . '/' . $patientID); ?>
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
                    </td>

                    <td> &nbsp;&nbsp;&nbsp;
                        <select  style="height:200px;width:250px" required   id="inputDosage"  name="inputDosage" multiple="multiple" rows="8">

                        </select><br/>
                        &nbsp; &nbsp;&nbsp;<input id="custom1" readonly="readonly" type="text" value="Custom" />  
                    </td>

                    <td> &nbsp;&nbsp;
                        <select  style="height:200px;width:250px" required id="inputFrequency" name ="inputFrequency" multiple="multiple" rows="8">

                        </select><br/>
                        &nbsp;&nbsp;&nbsp;<input id="custom2"  readonly="readonly"  type="text" value="Custom" />  
                    </td>


                    <td>&nbsp;&nbsp;&nbsp;
                        <input class="btn btn-large  btn-primary " type="submit" value="+Add">
                    </td>
                </tr>

            </tbody>
        </table> 
        <?php echo form_close(); ?>

    </div>


    </div>
</div>
