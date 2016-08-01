<?php
$array = $this->uri->uri_to_assoc(3);
?>

<script>
$('document').ready(function(){
	
	var reqID = <?php echo $array['ReqID']; ?>;
	var TestID = <?php echo $array['TestID']; ?>;
	var PID = <?php echo $array['PID']; ?>;

       <?php
        $array = $this->uri->uri_to_assoc(7);
      
        $hin = $array['HIN'];
     
      
        ?>

	function GetPara(name) {
		var GetReqID = new RegExp('[\?%&]' + name + '=([^%&#]*)').exec(window.location.href);
		if (GetReqID == null) {
			return null;
		} else {
			return GetReqID[1] || 0;
		}
	}

	function GetReport() {

		$.ajax({
			type: "POST",
			url: '<?php echo base_url(); ?>report_view/getAllReport',
			data: { 'ID': reqID},
			dataType: 'json',
			success: function (output) { 
				var count = 1;
				 var count1 = 2;
				  var count2 = 7;
				$.each(output, function (key, val) {
					var dob= new Date(val['fTestRequest_ID']['fpatient_ID']['patientDateOfBirth']);

					if(count2>val['mainResult']){
						$('#tbdy').append('<tr id=' + count + '><td colspan="7" style="width:179px;">' + val['fParentF_ID']['parent_FieldName'] + '</td><td colspan="7" style="width:179px;">'+count1+'-'+count2+'</td><td colspan="7" style="width:179px;">'+val['mainResult']+'</td></tr>');
					}
					else{
					
					$('#tbdy').append('<tr id=' + count + '><td colspan="7" style="width:179px;">' + val['fParentF_ID']['parent_FieldName'] + '</td><td colspan="7" style="width:179px;">'+count1+'-'+count2+'</td><td colspan="7" style="width:179px;">'+val['mainResult']+ " " + '<i class="text-danger text-center" > **' +'  </td></tr>');
					
				}
					$("#fname").text(val['fTestRequest_ID']['fpatient_ID']['patientFullName']);
					$("#PID").text(val['fTestRequest_ID']['fpatient_ID']['patientID']);
					$("#DOB").text(dob.toDateString());
					$("#gender").text(val['fTestRequest_ID']['fpatient_ID']['patientGender']);
					$("#TestName").text(val['fTestRequest_ID']['ftest_ID']['test_Name']+" "+"REPORT");

					$fn = val['fParentF_ID']['fTest_NameID']['fTest_CreateUserID']['hrEmployee']['firstName'];
					$ln = val['fParentF_ID']['fTest_NameID']['fTest_CreateUserID']['hrEmployee']['lastName'];
					$("#req").text("Dr."+" "+$fn+" "+$ln);

                    $("#date").text(val['result_FinalizedDate']);
                    $("#t").text(val['result_ID']);
					count++;
					count1=count1+4;
					count2=count2+6;
					
					
				});

			}
		});
	}


$('#Print').click(function(){

     var printContents = document.getElementById("panel").innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;

	});
  

	$('#Email').click(function(){
		var address=$('#Email_Address').val();
		if(address==''||address==null){
			alert('Enter an email address');
		}
		else{

			$.ajax({
				type: "POST",
				url: 'Ajax_calls/Add_sub_Field_ranges',
				data: {'email': address},
				success: function(output) {
					alert('Successfully Sent');
				}
			});
		}
	});

	GetReport();

});


</script>
<style>
.form-horizontal .control-label{
  text-align:left;
}
</style>

<div class="col-md-12" >
	<div class="box box-solid box-primary">
			<div class="box-header">
			  <div class="text-center"><h3 class="box-title"><strong>Lab Report</strong></h3></div>
			</div> 
			<div class="box-body" id="panel">
			  <div class="col-sm-4">
				<div class="panel panel-primary" style="width: 125%; border-color:#ffffff">

					<!-- <div class="panel-body"> -->
						<div class="form-group">
							<label for="HIN" class="col-sm-2 control-label" style="width:120px; font-size:12px">Patient
								ID</label>
							<label id="HIN" type="text"><?php echo($hin); ?></label>
							<br><br>
							<label for="fname" class="col-sm-2 control-label" style="width:120px; font-size:12px">Patient
								Name</label>
							<label id="fname" type="text"></label>
							<br><br>
							<label for="DOB" class="col-sm-2 control-label" style="width:120px; font-size:12px">DOB</label>
							<label id="DOB" type="text"></label>
							<br><br>
							<label for="gender" class="col-sm-2 control-label"
								   style="width:120px; font-size:12px">Gender</label>
							<label id="gender" type="text"></label>
							<br><br>
							</div>

					</div>
			
			</div>

			<div class="col-sm-4">
				<div class="panel panel-primary" style="width: 125%; position: absolute; left: 150px; border-color:#ffffff" >

					<!-- <div class="panel-body"> -->
						<div class="form-group">
							<label for="ref" class="col-sm-2 control-label" style="width:120px; font-size:12px">Report
								ID</label>
							<label id="t" type="text"></label>
							<br><br>
							<label for="fname" class="col-sm-2 control-label" style="width:120px; font-size:12px">Date
							</label>
							<label id="date" type="text"></label>
							<br><br>
							<label for="DOB" class="col-sm-2 control-label" style="width:120px; font-size:12px">Ref By</label>
							<label id="req" type="text"></label>
							<br><br><br><br>

						</div>

					</div>
		
			</div>

			<table id="tbl" class="table table-bordered  table-hover" border='0' width='50%' align='center'
				   style="border-collapse:collapse " cellspacing='3' cellpadding='5'>
				<tr>
					<th colspan="7" bgcolor="black"
						style="width:179px; text-align:center; color: #797979;background-color:#D8D8D8;  font-size:12px">
						Parameter
					</th>
					<th colspan="7" bgcolor="black"
						style="width:179px; text-align:center; color: #797979;background-color:#D8D8D8;  font-size:12px">
						Reference Range
					</th>
					<th colspan="7" bgcolor="black"
						style="width:179px; text-align:center; color: #797979;background-color:#D8D8D8;  font-size:12px">
						Result
					</th>

				</tr>

				<tbody id='tbdy'>


				</tbody>


			</table>
			
		</div>
		
	</div>

		<div class="box-footer" >
			<button id="Print" type="button" class="btn btn-primary"  >Print</button>
			</div>

</div>