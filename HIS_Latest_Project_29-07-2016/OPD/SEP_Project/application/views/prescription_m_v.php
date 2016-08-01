<script type="text/javascript">
   
   window.onload = init;
   
   function init(){
        console.log("working");
        getDrugs();
        function getDrugs(){  
             console.log('calling drugs');

             var tex = "nul";

             $.ajax({ 
                 url: 'http://172.16.21.251:8080/HIS_API/rest/PharmacyServices/drugStockTable',
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
                                             newOption.attr('value',drug.drug_srno );
                                             newOption.text(drug.drug_name) ;


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

//				newOption = $('<option>');
//				newOption.attr('value', "Custom").text("Custom");
//				newOption.attr('id', "customentry2");
//				$('#inputFrequency').append(newOption);
//				
				
				newOption = $('<option>');
				newOption.attr('value', "1/3").text("1/3");
				$('#inputDosage').append(newOption);
				
				newOption = $('<option>');
				newOption.attr('value', "1").text("1");
				$('#inputDosage').append(newOption);
				
				newOption = $('<option>');
				newOption.attr('value', "2").text("2");
				$('#inputDosage').append(newOption);
				
//				newOption = $('<option>');
//				newOption.attr('value', "Custom").text("Custom");
//				newOption.attr('id', "customentry1");
//				$('#inputDosage').append(newOption);
			  
	}
        
        $( "#inputDrug" ).change(function() {
	
		$('#inputDosage').find('option').remove();
		$('#inputFrequency').find('option').remove();	
	 
		var drugID = $('#inputDrug').val();
		getDrugByID(drugID);
	});
	 


   }
   
</script>


<script type="text/javascript">
    //$(document).ready(function() {
        //cosole.log("document is ready");
	  
        //  alert('1');

//	function getDrugs1()
//	{
//	
//		$.ajax({ 
//			 url: 'http://localhost:8080/HIS_API/rest/DrugServices/getDrugNames',
//                         alert("dgdgk[{"dName":"Afrin","dSrNo":8},{"dName":"Afrin Latest","dSrNo":39},{"dName":"Afrin Test","dSrNo":38},{"dName":"asas","dSrNo":15},{"dName":"Asprin","dSrNo":11},{"dName":"Captopril","dSrNo":2},{"dName":"dsdsa","dSrNo":37},{"dName":"LOOL","dSrNo":12},{"dName":"Methyldopa","dSrNo":1},{"dName":"new","dSrNo":7},{"dName":"NewDrug1","dSrNo":20},{"dName":"NewDrug2","dSrNo":21},{"dName":"Panadol","dSrNo":3},{"dName":"Pindolol Tablet 5mg","dSrNo":5},{"dName":"Propranolol Tablet 10mg","dSrNo":6},{"dName":"TestDrug100","dSrNo":13},{"dName":"TestDrug10000","dSrNo":16},{"dName":"TestDrug1001","dSrNo":14},{"dName":"TestDrug20000","dSrNo":17},{"dName":"TestDrug2013","dSrNo":22},{"dName":"TestDrug2014","dSrNo":24},{"dName":"TestDrug2015","dSrNo":25},{"dName":"TestDrug2016","dSrNo":26},{"dName":"TestDrug2017","dSrNo":27},{"dName":"TestDrug2020","dSrNo":29},{"dName":"TestDrug2021","dSrNo":30}]dk");
//			 success: function(drugs) { 
//						 
//				 	 drugs = $.parseJSON(drugs);  
//                                         
//					for (var i = 0; i < drugs.length; i++) {  
//						alert('aa');
//				
//					var newOption = $('<option>'); 
//					/*var color = getDrugEntryColor( parseInt(drugs[i]['dSrNo'] ));
//					newOption.attr('style',"color:" + color);
//						  */
//					newOption.attr('value',drugs[i]['dSrNo'] ).text(drugs[i]['dName']   ) ;
//						 
//						$('#inputDrug').append(newOption);
//					} 
//				},
//			 async:   false
//		});  
//	}
        
 
/*	
	
	function getDrugEntryColor(drugid)
	{
		var color = "Black";
		$.ajax({
			 url: 'http://localhost:8080/HIS_API/rest/DrugServices/getDrugByID/'+drugid+'',
			 success: function(jsonDrugData) {
			 
 
				 if(parseInt(jsonDrugData['dQty']) < parseInt(jsonDrugData['statusReOrder']) & parseInt(jsonDrugData['dQty']) > parseInt(jsonDrugData['statusDanger']))
				 {
				 	color = "Green";
				 }
				 if(parseInt(jsonDrugData['dQty']) < parseInt(jsonDrugData['statusDanger']))
				 { 
				    color =  "Red";
				 } 
				 
				},
			 async:   false
		});  
		 
			return color;
	}
	
	function getDrugQty(drugid)
	{
		var qty = 0;
		$.ajax({
			 url: 'http://localhost:8080/HIS_API/rest/DrugServices/getDrugByID/'+drugid+'',
			 success: function(jsonDrugData) {
			 
				 qty = parseInt(jsonDrugData['dQty']);
				 
				},
			 async:   false
		});  
		 
			return qty;
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
	
	
	$( "#inputDosage" ).change(function() {
		var val = $('#inputDosage').val();
		if(val!="Custom")
		{
			$('#custom1').attr('readonly','readonly');
		}else
		{
			$('#custom1').removeAttr('readonly');
		}
	});
	
	$("#custom1").change(function() {
		 var userval = $("#custom1").val();
		 
		 $("#customentry1").val(userval);
		  $("#customentry1").text(userval);
	});
		
	$( "#inputFrequency" ).change(function() {
 
		var val = $('#inputFrequency').val();
		if(val!="Custom")
		 {
			 $('#custom2').attr('readonly','readonly');
		 }else
		 {
			 $('#custom2').removeAttr('readonly');
		 }
	});
	
	$("#custom2").change(function() {
		 var userval = $("#custom2").val();
		 
		 $("#customentry2").val(userval);
		  $("#customentry2").text(userval);
	});
		
		
		
	$("#custom3").change(function() {
		 var userval = $("#custom3").val();
		 $("#customentry3").val(userval);
		  $("#customentry3").text(userval);
	});
		
	
	$("#period").change(function() {
		var val = $('#period').val();
		if(val!="Custom")
		{
			$('#custom3').attr('readonly','readonly');
		}else
		{
			$('#custom3').removeAttr('readonly');
		}
	});
	
	$("#custom3").change(function() {
		 var userval = $("#custom3").val();
		 
		 $("#customentry3").val(userval);
		  $("#customentry3").text(userval);
	});
		
	*/
      
	//getDrugs();
 
//});


</script>
 
 <div class = "row">
 <div class = "col-md-12">
 <!--Ending point of panel for prescription-->
    <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Prescribe Drugs</h3>
               
            </div>
        <div class="panel-body" >
              
           
    
            <div class="form-horizontal well" style="alignment-adjust: auto" >

		   
<!-- Message for operation status  ************************************************************** --> 
		<?php 
			if($status !== 0){
				if((!preg_match('/Edit/',$title)) &  $status == "True"){ 
		 ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Successfull !  </strong> Prescription Added Successfully
		</div>
		<?php }else if(preg_match('/Edit/',$title) & $status == "True"){  ?>
		
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Successfull !  </strong> Prescription updated Successfully
		</div>
		
		<?php } ?>
		
		
		<?php if((!preg_match('/Edit/',$title)) & $status == "False"){ ?>
		
			<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Fail !</strong> Faild to add the prescription
			</div>
		
		
		<?php }else if( preg_match('/Edit/',$title) &  $status == "False"){  ?>

			<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Fail !</strong> Faild to update the prescription
			</div>
		<?php } ?>
	<?php } ?>
 <!-- **************************************************************************************** --> 		
		

			 

	  
 <div class="form-horizontal" style="margin-bottom: 20px">
 
                   
     
     
                <table class=""> 

                    <thead> 
                        <th style="padding-left: 70px">Drug</th>
                        <th style="padding-left: 80px">Dosage</th>
                        <th style="padding-left: 70px">Frequency</th>
                        <th style="padding-left: 70px">Period</th>
                        <th style="padding-left: 10px">
                            
                          <!-- Button trigger modal -->
                          <button type="button" class="btn btn-warning" style="margin-left: -5px; width :137px" data-toggle="modal" data-target="#myModal">
                              Refer BNF
                          </button>

                       
                          
                          <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <?php $this->load->view('viewBNF');?>
                        </div>  
                       
                            <?php echo form_open('prescription_c/add_drug/'.$pid."/".$visitid."/".$presid , array('name' => 'myform')); ?>
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select style="width:200px;height: 180px" required id="inputDrug" name ="inputDrug"   class="form-control" multiple="multiple" >
                                    
                                </select>
                            </td>

                            <td style="padding-left: 10px">
                                <select class="form-control"  style="height: auto;width:200px" required   id="inputDosage"  name="inputDosage" multiple="multiple">

                                </select>
                                <!--<input id="custom1" readonly="readonly" type="text" value="Custom" />-->  
                            </td>

                            <td style="padding-left: 10px">
                                <select class="form-control"  style="height: auto;width:200px" required id="inputFrequency" name ="frequency" multiple="multiple">

                                </select>
                                <!--<input id="custom2"  readonly="readonly"  type="text" value="Custom" />-->  
                            </td>

                            <td style="padding-left: 10px">
                                <select id="period" style="height: auto;width:200px"  name ="period" class="form-control" multiple="multiple">
                                    <option value="For 1 day">For 1 day</option>
                                    <option value="For 2 day">For 2 days</option>
                                    <option value="For 4 day">For 4 days</option>
                                    <option value="For 5 day">For 5 days</option>
                                    <option value="For 1 week">For 1 week</option>
                                    <option value="For 2 weeks">For 2 weeks</option>
                                    <option>For 3 weeks</option>
                                    <option>For 1 month</option>
                                    <option>For 3 months</option> 	
                                    <!--<option value="Custom" id="customentry3">Custom</option>-->									
                                </select>
                                <!--<input id="custom3"  readonly="readonly"  type="text" value="Custom" />-->  
                            </td>

                            <td style="padding-left:10px; padding-top :150px; width:135px" >
                               	<input class="glyphicon glyphicon-plus btn btn-primary" type="submit" value="+Add">
                            </td>
                        </tr>

                    </tbody>
                </table>
     
     <!-- Modal for BNF button click -->
     
			
  <?php echo form_close(); ?>
   <hr>
  
  <?php 
	if( sizeof($drug_list) >0 ){
	?> 
	 
	 <table class="table table-hover">
             
            <tr>
              
                <td><strong>Name</strong> </td>
                <td><strong>Dosage</strong> </td>
                <td><strong>Frequency</strong> </td>
                <td><strong>Period</strong> </td>
				<td> </td>
				<td></td>
            </tr>

            <?php foreach($drug_list as $drug) {?>
            <tr>
               
				<td><?php echo $drug->drugname;?></td>
				<td><?php echo $drug->dosage;?></td>
				<td><?php echo $drug->freq;?></td>
				<td><?php echo $drug->period;?></td>
				
				<td>
				<label class="checkbox">
					<input type="checkbox" value="outdrug">Don't Issue
				</label> 
				</td>
				
				<?php echo form_open('prescription_c/remove_drug/'.$drug->index ."/". $pid."/".$visitid."/".$presid, array('name' => 'drugform')); ?>

					<td><button type="submit" class="btn btn-mini btn-delete">Remove</button> </td>

				<?php echo form_close(); ?>

            </tr>
           <?php }?>
            
        </table>
   <?php }?>
 
   
  
</div> 
</div> 
     
</div>  

        
        
<div class="span10">
        
    <div class="form-actions" style="margin-top:20px;">


        <?php if (preg_match('/Edit/', $title)) { ?> 

            <div class="control-group">

                <div class="controls">
                    <label  class="lastmod">  <?php echo $lastmodusername." on ". date('Y-m-d', $prescription[0][0]->lastUpDate/1000);   ?></label>
                </div>
            </div>

        <?php } ?> 	

        <?php
        if (preg_match('/Edit/', $title)) {
            echo form_open('prescription_c/update/' . $pid . "/" . $visitid . "/" . $presid, array('name' => 'drugform'));
        } else {
            echo form_open('prescription_c/save/' . $pid . "/" . $visitid . "/" . $presid, array('name' => 'drugform'));
        }
        ?>
        <button style="margin-left: 20px" type="submit" class="btn btn-primary"><?php if (preg_match('/Edit/', $title))
            echo "Update Prescription";
        else
            echo "Send To Pharmacy";
        ?></button>
        <?php echo form_close(); ?>

<?php echo form_open('prescription_c/discard/' . ($pid) . "/" . $visitid, array('name' => 'drugform')); ?>
        <button style="margin-left: 20px;margin-bottom: 30px;margin-top: 10px" type="submit" style="margin-top: 10px" class="btn btn-primary">Discard</button>
    <?php echo form_close(); ?>

    
 

       
    <!--Ending point of panel for prescription-->
