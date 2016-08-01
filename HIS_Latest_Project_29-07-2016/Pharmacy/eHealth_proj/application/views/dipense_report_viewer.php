

  <html><body>
 
 <?php 
/* foreach($report as $dis){
 echo $dis->dispenseID;
  echo $dis->drugName;
  echo $dis->dispenseQty;
  print "</br>";
 }*/
 ?> 
  <h4>Drug Dispense Report</h4>
  <br/>
  
 
  <table>
       <tr>
		<td>Pharmacy : </td>
		<td colspan="2">&nbsp;</td>		
	   </tr>
	   
	    <tr> <td>Dispense Report Generated Date : </td> <td colspan="2"><?php echo date("Y-m-d"); ?> </td> </tr>
	   
	      <tr>
		<td>Dispense Report Date : </td>
		<td colspan="2"><?php echo $date ?> </td>		
	   </tr>
	   
	   
	</table>
  <br/>
<table border="1" cellpadding="3">
	<tr>
		<th>Dispense ID</th>
		<th>Drug Name</th>		
		<th>Quantity</th>
		<th>Dispense User</th>
		<th>Dispense Time</th>
	</tr>
	<?php 
 foreach($report as $dis){ ?>
	<tr>
		<td><?php echo $dis->dispenseID; ?> </td>
		<td><?php echo $dis->drugName; ?></td>		
		<td><?php echo $dis->dispenseQty; ?></td>
		<td><?php echo $dis->dispenseUser; ?></td>
		<td><?php echo $dis->dispenseTime; ?></td>
	</tr>
	<?php }
 ?> 
	
</table>
<br/>
<br/>
<table>
<tr>
		<th>----------------------------------</th>
		<th colspan="2">&nbsp;</th>		
		<th>---------------------------------</th>
	</tr>
	<tr>
		<th>Created By:</th>
		<th colspan="2" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>		
		<th>Authorised Signature</th>
	</tr>
</table>


  </body></html>