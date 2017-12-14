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
 
    $(document).ready(function() {
		
		// Custom pagintation ;)  *************************************************************************************
		// first page load
		var $table = $('#testp');
			
		var currentPage = 0;
		var numPerPage = 15;
		var numRows = $table.find('tbody tr').length;
		var numPages = Math.ceil(numRows / numPerPage);
		$('#pageid').val(currentPage+1);
		$('#pgcount').text(' Of ' + numPages);
		$table.find('tbody tr').hide().slice(0, numPerPage).show();
		
		//************************************************************
		// then
		$('#pageid').change(function() {
		 
			var start =( (parseInt($('#pageid').val())-1) * numPerPage) ;
			
			// first one
			if(parseInt($('#pageid').val()) == 1) start=0;
			
			var end = ($('#pageid').val() * numPerPage);
		 
			$table.find('tbody tr').hide().slice( start , end).show();

		});
		 
		    $('#recsperpage').change(function() {
				numPerPage = $('#recsperpage').val();
				var currentPage = 0;
				var numRows = $table.find('tbody tr').length;
				var numPages = Math.ceil(numRows / numPerPage);
				$('#pageid').val(currentPage+1);
				$('#pgcount').text(' Of ' + numPages);
				$table.find('tbody tr').hide().slice(0, numPerPage).show();

				var start =( (parseInt($('#pageid').val())-1) * numPerPage) ;

				// first one
				if(parseInt($('#pageid').val()) == 1) start=0;

			
				var end = ($('#pageid').val() * numPerPage);

				$table.find('tbody tr').hide().slice( start , end).show();

		});
		
		$('#lnkprev').click(function() {
				if( parseInt($('#pageid').val()) != 1)
				{  
					$('#pageid').val(parseInt($('#pageid').val())-1 );
					 numPerPage = parseInt($('#recsperpage').val());
					 currentPage =  parseInt($('#pageid').val());
					 numRows = $table.find('tbody tr').length;
					 numPages = Math.ceil(numRows / numPerPage);
				 
					$('#pgcount').text(' Of ' + numPages);
					$table.find('tbody tr').hide().slice(0, numPerPage).show();

					var start =( (parseInt($('#pageid').val())-1) * numPerPage) ;

					// first one
					if(parseInt($('#pageid').val()) == 1) start=0;

					var end = ($('#pageid').val() * numPerPage);

					$table.find('tbody tr').hide().slice( start , end).show();
				}
		});
		
		$('#lnknext').click(function() {
				if( parseInt($('#pageid').val()) != numPages)
				{  
					$('#pageid').val(parseInt($('#pageid').val())+1 );
					 numPerPage = parseInt($('#recsperpage').val());
					 currentPage =  parseInt($('#pageid').val());
					 numRows = $table.find('tbody tr').length;
					 numPages = Math.ceil(numRows / numPerPage);
				 
					$('#pgcount').text(' Of ' + numPages);
					$table.find('tbody tr').hide().slice(0, numPerPage).show();

					var start =( (parseInt($('#pageid').val())-1) * numPerPage) ;

					// first one
					if(parseInt($('#pageid').val()) == 1) start=0;
 
					var end = ($('#pageid').val() * numPerPage);

					$table.find('tbody tr').hide().slice( start , end).show();
				}
		});
		
		//*****************************************************************************************************************
	
		
		// instant search ********************************************************************************
		$('.tblsearch').bind('keyup change',function(e) {
			 
				// re-paginate ************************** 
				var numRows = $table.find('tbody tr').length;
            	numPerPage = numRows;
            	var currentPage = 0;


				//numPerPage = $('#recsperpage').val();
				//var currentPage = 0;
				//var numRows = $table.find('tbody tr').length;
				var numPages = Math.ceil(numRows / numPerPage);
				$('#pageid').val(currentPage+1);
				$('#pgcount').text(' Of ' + numPages);
				$table.find('tbody tr').hide().slice(0, numPerPage).show();
				var start =( (parseInt($('#pageid').val())-1) * numPerPage) ;
				// first one
				if(parseInt($('#pageid').val()) == 1) start=0;
				var end = ($('#pageid').val() * numPerPage);
				//**************************
				
				$table.find('tbody tr').hide().slice( start , end).show();
				
				var a = {};
  
				$('.tblsearch').each(function(){
					 
					if(this.value !="" & this.value !="Any"){
					 
						var key = this.id.replace("txtsrch","td");
						a[key] = this.value.toLowerCase();
					}
				});
				
				$('#testp').find('tbody').find('tr').each(function() {
						var tr = this;
						var matching = true;
						for (var key in a) {
							$(tr).find('td[id='+key+']').each(function() {
								var content = this.innerHTML.toLowerCase();
								var regex = "\\b(" + a[key] + ")\\b";
								/*if(key == "tdpatientID" | key =="tdhin" | key == "tdname")
								{
									if (content != a[key])
									{
										matching = false;
									}
								}else{*/
									if (content.match(a[key]) == null)
									{
										matching = false;
									}
								//}
							});
						}
						if(matching==false) $(tr).hide();
				});
		 
		});
		//**********************************************************************************************
		
		
		
    });

	function rowClick(e)
	{
		$('#myModal2').modal('show');

	}
	$(document).ready(function() {
		$('.table').on('click', 'tr', function() {
	    	$('#inputTreatment').val($(this.cells[3]).text());
	    	$('#inputStatus option[value="'+$(this.cells[4]).text()+'"]').attr('selected', true)
	    	$('#inputremarks').val($(this.cells[5]).text());
	    	$('#inputopdTreatmentId').val($(this.cells[6]).text());

		});
	});
	
</script>


<div class="container">
	<h3>Treatment Room</h3>
  <div class="row">
    
<div class="span10">
<div id="tablecont" style="border:RGB(245,245,245) 2px solid; width: 90%; height:530px;overflow-y:scroll" >
    <table class="table table-bordered table-striped table-hover"  id="testp" >
        <thead>
            <tr>

                <th style="text-align: center;">Date</th>
                <th style="text-align: center;">Patient HIN</th>
                <th style="text-align: center;">Patient Name</th>
                <th style="text-align: center;">Treatment</th>
                <th style="text-align: center;">Status</th>
                <th style="text-align: center;" hidden>Remark</th>
                <th style="text-align: center;" hidden>Id</th>
            </tr>

            <tr>
                <td><input type="text" class="tblsearch bg-search" id="txtsrchdate"  placeholder="By Date" style="width: 100%; text-align: center;" ></td>
                <td><input type="text" class="tblsearch bg-search" id="txtsrchhin"   placeholder="By HIN" style="width: 100%; text-align: center;" ></td>
                <td><input type="text" class="tblsearch bg-search" id="txtsrchname"  placeholder="By Name" style="width: 100%; text-align: center;" ></td>
                <td>
                <select id="txtsrchtreatment"  class="tblsearch" name="Treatment" style="width: 100%; text-align: center;">
                        <option  selected  value="Any">Any</option>
                        <?php foreach ( $treatment as $row ) { ?>
                        <option
                          itemid=<?php echo $row->treatment; ?>><?php echo $row->treatment; ?>
                        </option> 

                      <?php } ?>
                    </select>
                </td>
                <td><select id="txtsrchstatus"  class="tblsearch" name="Status" style="width: 100%; text-align: center;">
                        <option  selected  value="Any">Any</option>
                        <option  value="Pending">Pending</option>
                        <option  value="Done">Done</option>
                    </select></td>
                <td></td>
                <td></td>
            </tr>

        </thead>


        <tbody>

        <div id="tbody">
            <?php foreach ($opdtreatment as $row) { ?>

                <tr style="font-size:13px;cursor:pointer;" onClick="rowClick(event)" >

                    <td id="tddate"><?php date_default_timezone_set('Asia/Colombo'); echo date("Y-m-d h:i:s A", $row->createDate / 1000); ?></td>
                    <td id="tdhin"><?php echo $row->visitId->patient->patientHIN; ?></td>
                    <td id="tdname"><?php echo $row->visitId->patient->patientTitle . " " . $row->visitId->patient->patientFullName; ?></td>
                    <td id="tdtreatment"><?php echo $row->treatments->treatment; ?></td>
                    <td id="tdstatus"><?php echo $row->status; ?></td>
                    <td id="tdremarks" hidden><?php echo $row->remarks; ?></td>
					<td id="tdid" hidden><?php echo $row->opdTreatmentId; ?></td>
			<?php } ?>


            </tr>

            </tbody>

        </div>

    </table>
  
   
  </div>
  
   
  
  
   <div id="pagin"> 
   
        <a href='#' id="lnkprev" > << </a>
		|
		<label class="control-label" for="pageid"  style='display:inline'>Page</label>

		<input type="text" class="input-xlarge" id="pageid" style='width:20px' value="1" name="pageid"  />
		<p id='pgcount' style='display:inline'>  </p>
		|
         <a href='#' id="lnknext" > >> </a>
		  
		 &nbsp;&nbsp;&nbsp;
		<select id="recsperpage" style='width:65px'>
			<option value="5"> 5 </option>
			<option value="10"> 10 </option>
			<option value="25" selected> 25 </option>
			<option value="50"> 50 </option>
			<option value="100"> 100 </option>
		</select>
   </div>
   
   <div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
	<?php    
      	echo form_open('treatment_c/update', array('name' => 'myform','id' => 'myform'));
    
    ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Treatment</h4>
        <input  type="text" id="inputopdTreatmentId" name="inputopdTreatmentId" placeholder="" hidden>
      </div>
      <div class="modal-body">
         <div class="row">
         	<div class="col-md-2">
         		Treatment: 
         	</div>
         	<div class="col-md-5">
         		<input style="width:100%;"  type="text" id="inputTreatment" name="inputTreatment" placeholder="" disabled>
         	</div>
         </div>
         <br/>
         <div class="row">
         	<div class="col-md-2">
         		Status: 
         	</div>
         	<div class="col-md-5">
         		<select id="inputStatus"  name="inputStatus" style="width:100%; text-align: center;">
                    <option value="pending">Pending</option>
                    <option value="done">Done</option>
                 </select>
            </div>
         </div>
         <br/>
         <div class="row">
         	<div class="col-md-2">
         		Remarks:
         	</div>
         	<div class="col-md-5">
         		<textarea style="width:100%;height: 100px" id="inputremarks" name="inputremarks" value="" name="remarks" placeholder="" ></textarea>
         	</div>
        </div>
        <br/>
      </div>
      <div class="modal-footer">
      
      	<button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>
</div>
</div>