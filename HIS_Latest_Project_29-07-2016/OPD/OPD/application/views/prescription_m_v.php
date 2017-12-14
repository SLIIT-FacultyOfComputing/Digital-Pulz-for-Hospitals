<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<script type="text/javascript">
   
   window.onload = init;
   
   function init(){
        //console.log("working");
        getDrugs();
        function getDrugs(){  
             console.log('calling drugs');

             var tex = "nul";
             $.ajax({ 

             	 type: 'GET',
                 url: '<?php echo base_url();?>index.php/prescription_c/getDrugMainStock',
                 dataType:'json',  //'http://localhost:8080/HIS_API/rest/PharmacyServices/drugStockTable',
                 success: function(result) { 

                 					  	//console.log("DRUGS="+result);
                                         //console.log("ajax called");
                                         //console.log(result);
                                         //drugs = $.parseJSON(result);
                                         //console.log(result.length);
                                         
                                         for (var i = 0; i < result.length; i++) {
                                             var drug =  result[i];
                                             //console.log(drug.exist );
                                             var newOption = $(document.createElement('option')); 
                                             
                                             /*var color = getDrugEntryColor( parseInt(drugs[i]['dSrNo'] ));
                                            
                                                       */
                                             //console.log(drug.dName);
                                             //console.log(drug.dSrNo);
                                             
                                             if(drug.exist==true)
                                             {
                                             	newOption.attr('value',drug.dSrNo );
                                             	var drugtype = "";

                                             	if(drug.dName.endsWith("ml"))
                                             	{
                                             		drugtype = "ml";
                                             	}
                                             	newOption.text(drug.dName + " (stock: " + drug.stock + drugtype + " )");
                                             	newOption.attr('style',"background-color: #90EE90;color:Black;font:Bold");
                                             	
                                             	//console.log(drug.dName);

                                             }
                                             else
                                             {
                                             	newOption.attr('value',drug.dSrNo );
                                             	newOption.text(drug.dName) ;
                                             }

                                             $('#inputDrug').append(newOption);
                                             //$('#inputDrug').append("<option>Value</option>");
                                         } 
                                         
                                 },
                          async:   false
                 }); 
        }
        
        function getDrugByID(drugID)
		{
  

 				$.ajax({ 

             	 type: 'GET',
                 url: '<?php echo base_url();?>index.php/prescription_c/getDosages',
                 dataType:'json',  //'http://localhost:8080/HIS_API/rest/PharmacyServices/drugStockTable',
                 success: function(result) { 

                 					  	
                                         //console.log("ajax called");
                                         //console.log(result);
                                         //drugs = $.parseJSON(result);
                                         //console.log($('#inputDrug option:selected').text().split("(")[0]);
                                        if(!$('#inputDrug option:selected').text().split("(")[0].trim().endsWith("ml"))
                                        {
                                         	
                                         	for (var i = 0; i < result.length; i++) {
                                             	var dosages =  result[i];
                                            	if(!dosages.dosage.endsWith("ml"))
                                             	{
                                             		var newOption = $(document.createElement('option')); 
                                             	
                                           	 		newOption.attr('value',dosages.dosage );
                                             		newOption.text(dosages.dosage) ;

                                            		$('#inputDosage').append(newOption);
                                            	}
                                            	//$('#inputDrug').append("<option>Value</option>");
                                        	} 
                                        }
                                        else
                                        {
                                        	for (var i = 0; i < result.length; i++) {
                                             	var dosages =  result[i];
                                            
                                             	if(dosages.dosage.endsWith("ml"))
                                             	{
                                             		var newOption = $(document.createElement('option')); 
                                             	
                                           	 		newOption.attr('value',dosages.dosage );
                                             		newOption.text(dosages.dosage) ;

                                            		$('#inputDosage').append(newOption);
                                            	}
                                        	}
                                        }
                                 },
                          async:   false
                 }); 


 				$.ajax({ 

             	 type: 'GET',
                 url: '<?php echo base_url();?>index.php/prescription_c/getFrequency',
                 dataType:'json',  //'http://localhost:8080/HIS_API/rest/PharmacyServices/drugStockTable',
                 success: function(result) { 

                 					  	
                                         
                                         for (var i = 0; i < result.length; i++) {
                                             var frequent =  result[i];
                                         
                                             var newOption = $(document.createElement('option')); 
                                             
                                            
                                             newOption.attr('value',frequent.frequency );
                                             newOption.text(frequent.frequency) ;
                                             

                                             $('#inputFrequency').append(newOption);
                                             //$('#inputDrug').append("<option>Value</option>");
                                         } 
                                         
                                 },
                          async:   false
                 }); 





	}
        
    $( "#inputDrug" ).change(function() {
	
		$('#inputDosage').find('option').remove();
		$('#inputFrequency').find('option').remove();	
	 
		var drugID = $('#inputDrug').val();
		getDrugByID(drugID);
	});
	
	$("#printPres").click(function() {
		var docprint = window.open("about:blank", "_blank");
		$.ajax({ 

             	 type: 'GET',
                 url: '<?php echo base_url();?>index.php/prescription_c/getReport/'+$('#pid').val(),
                 //dataType:'json',  //'http://localhost:8080/HIS_API/rest/PharmacyServices/drugStockTable',
                 success: function(result) {

				    
				    docprint.document.open();
			    	docprint.document.write(result);
			    	docprint.document.close();
			    	docprint.focus();
			    	//docprint.print();
			    	//docprint.close();
				},
				error: function (xhr, ajaxOptions, thrownError) {
		        alert(xhr.status);
		        alert(thrownError);
		      }
		});
	});

	$("#inputFrequency").change(function(){

		if($("#inputFrequency option:selected").text() == "s.o.s.")
		{
			$('#myModal2').modal('show');
		}
		else
		{
			$('#myModal2').modal('hide');
			$('#inputQty2').val("1");
			$('#inputQty').val("1");
		}
	});
	
	$("#inputQty2").on("change paste keyup",function(){
		
		$("#inputQty").val($("#inputQty2").val());
	});

	
    }
    console.log('newpres= <?php echo $newpres?>');
    console.log('presEmpty= <?php echo $presEmpty?>');
	

</script>
<script type="text/javascript">
	$(document).ready(function() {
		if('<?php echo $newpres?>' == 'true' && '<?php echo $presEmpty?>' == 'true')
		{
			$('#presStatus').html('New Prescription');
		}
		else
		{
			$('#presStatus').html('Pending Prescription');
		}
	});
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
               <label id="presStatus"></label>
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
 	<input type="text" id="pid" value="<?php echo $pid ?>" hidden>
    
     
                <table class=""> 

                    <thead> 
                        <th style="padding-left: 70px">Drug</th>
                        <th style="padding-left: 40px">Dosage</th>
                        <th style="padding-left: 50px">Frequency</th>
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
                            <input type="text" id="inputQty" name="inputQty" value="1" hidden>
     
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select style="width:200px;height: 180px" required id="inputDrug" name ="inputDrug"   class="form-control" multiple="multiple" >
                                    
                                </select>
                            </td>

                            <td style="padding-left: 10px">
                                <select class="form-control"  style="height: 180px;width:100px" required   id="inputDosage"  name="inputDosage" multiple="multiple">

                                </select>
                                <!--<input id="custom1" readonly="readonly" type="text" value="Custom" />-->  
                            </td>

                            <td style="padding-left: 10px">
                                <select class="form-control"  style="height: 180px;width:150px" required id="inputFrequency" name ="frequency" multiple="multiple">

                                </select>
                                <!--<input id="custom2"  readonly="readonly"  type="text" value="Custom" />-->  
                            </td>

                            <td style="padding-left: 10px">
                                <select id="period" style="height: 180px;width:150px" required  name ="period" class="form-control" multiple="multiple">
                                    <option value="For 1 day">For 1 day</option>
                                    <option value="For 2 days">For 2 days</option>
                                    <option value="For 4 days">For 4 days</option>
                                    <option value="For 5 days">For 5 days</option>
                                    <option value="For 1 week">For 1 week</option>
                                    <option value="For 2 weeks">For 2 weeks</option>
                                    <option value="For 3 weeks">For 3 weeks</option>
                                    <option value="For 1 month">For 1 month</option>
                                    <option value="For 3 months">For 3 months</option> 	
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
   </div>
   
  
  <?php 
	if( sizeof($drug_list_stock) >0 ){
	?> 
	</div>
   <div class="form-horizontal well" style="alignment-adjust: auto" >
	 <h4 style="color:red">In-Pharmacy</h4>
	 <table class="table table-striped">
             
            <tr>
              
                <td><strong>Name</strong> </td>
                <td><strong>Dosage</strong> </td>
                <td><strong>Frequency</strong> </td>
                <td><strong>Period</strong> </td>
				<!-- <td> </td> -->
				<td></td>
            </tr>

            <?php foreach($drug_list_stock as $drug) {?>
            <tr>
               
				<td><?php echo $drug->drugname;?></td>
				<td><?php echo $drug->dosage;?></td>
				<td><?php echo $drug->freq;?></td>
				<td><?php echo $drug->period;?></td>
				
				<!-- <td>
				<label class="checkbox">
					<input type="checkbox" value="outdrug">Don't Issue
				</label> 
				</td> -->
				
				<?php echo form_open('prescription_c/remove_drug_stock/'.$drug->index ."/". $pid."/".$visitid."/".$presid, array('name' => 'drugform')); ?>

					<td><button type="submit" class="btn btn-mini btn-delete">Remove</button> </td>

				<?php echo form_close(); ?>
				


            </tr>
           <?php }?>
            
        </table>
        <?php 
				 echo form_open('prescription_c/save_stock/' . $pid . "/" . $visitid, array('name' => 'drugform'));
				 ?>
				  <button style="margin-left: 20px" type="submit" class="btn btn-primary">
			            Send To Pharmacy</button>
        			<?php echo form_close(); 
        			?>
   <?php }?>

   
  
  <?php 
	if( sizeof($drug_list) >0 ){
	?> 
	</div>
   	<div class="form-horizontal well" style="alignment-adjust: auto" >
	 <h4 style="color:red">Out-Pharmacy</h4>
	 <table class="table table-striped">
            <thead class="thead-inverse"> 
            <tr>
              
                <th><strong>Name</strong> </th>
                <th><strong>Dosage</strong> </th>
                <th><strong>Frequency</strong> </th>
                <th><strong>Period</strong> </th>
				<!-- <th></th> -->
				<th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($drug_list as $drug) {?>
            <tr>
               
				<td><?php echo $drug->drugname;?></td>
				<td><?php echo $drug->dosage;?></td>
				<td><?php echo $drug->freq;?></td>
				<td><?php echo $drug->period;?></td>
				
				<!-- <td>
				<label class="checkbox">
					<input type="checkbox" value="outdrug">Don't Issue
				</label> 
				</td> -->
				
				<?php echo form_open('prescription_c/remove_drug/'.$drug->index ."/". $pid."/".$visitid."/".$presid, array('name' => 'drugform')); ?>

					<td><button type="submit" class="btn btn-mini btn-delete">Remove</button> </td>

				<?php echo form_close(); ?>

            </tr>
           <?php }?>
            </tbody>
        </table>
         <?php 
				 echo form_open('prescription_c/save_stock2/' . $pid . "/" . $visitid . "/" . $presid, array('name' => 'drugform'));
				 ?>
				  <button style="margin-left: 20px" type="submit" id="printPres" class="btn btn-primary">
			            Print Prescription</button>
        			<?php echo form_close(); 
        			?>
   <?php }?>
 
   
  
</div> 
			<!-- <?php 
				 echo form_open('prescription_c/done/' . $pid . "/" . $visitid, array('name' => 'drugform'));
				 ?>
				  <button style="margin-left: 20px" type="submit" class="btn btn-primary">
			            Done</button>
        			<?php echo form_close();?> -->

</div> 
     
 
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter the Quantity for this drug</h4>
      </div>
      <div class="modal-body">
         Quantity of drugs to prescribe: <input class="form-control" style="width:200px"  type="number" id="inputQty2" pattern="[0-9]+([\.|,][0-9]+)?" step="1"  min="1" max="200" value="1" name="inputQty2" placeholder="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
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
         //else {
        //     echo form_open('prescription_c/save/' . $pid . "/" . $visitid . "/" . $presid, array('name' => 'drugform'));
        // }
        ?>
        <button style="margin-left: 20px" type="submit" class="btn btn-primary"><?php if (preg_match('/Edit/', $title))
            echo "Update Prescription";
        
        ?></button>
        <?php } echo form_close(); ?>

<?php echo form_open('prescription_c/discard/' . ($pid) . "/" . $visitid, array('name' => 'drugform')); ?>
        <button style="margin-left: 20px;margin-bottom: 30px;margin-top: 10px" type="submit" style="margin-top: 10px" class="btn btn-primary">Discard</button>
    <?php echo form_close(); ?>

    
 

       
    <!--Ending point of panel for prescription-->
