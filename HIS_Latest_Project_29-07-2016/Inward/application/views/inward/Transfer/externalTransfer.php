
<br/>
<!--class="table table-bordered table-striped table-hover" -->
<table style="width: 100%;" class="table table-hover">
  <col style="width: 22%;">
  <col style="width: 23%;">
  <col style="width: 23%;">
  <col style="width: 23%;">
  <col style="width: 3%;">
  <col style="width: 3%;">
  <col style="width: 3%;">
 
    <thead>
      <tr>

		<th >BHT No</th>
                <th >Transfer Date Time</th>
                <th >Transfer Hospital</th>
		<th >Reason For Transfer</th>
		
                <th colspan="3"></th>
                
				
      </tr>
    </thead>

      <tr>
          
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    
        <td>
     <?php echo form_open(''); ?>
    
<!--    <input type="submit" class="btn btn-large btn-info msgbox-confirm" value="View" name="btnSubmit" style="width: 5em;" >-->
    <button type="submit" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="View">
        <span class="glyphicon glyphicon-search"></span>
        </button>
    
    <?php echo form_close(); ?>
    </td>
    
    <td>
    <?php echo form_open(''); ?>

    <?php //echo anchor('Update'); ?>
<!--    <input type="submit" class="btn btn-large btn-info msgbox-confirm" value="Update" name="btnSubmit" style="width: 5em;" >-->
        <button type="submit" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Edit">
        <span class="glyphicon glyphicon-pencil"></span>
        </button>
        
        <?php echo form_close(); ?>
    </td>
    
    <td>
    <?php echo form_open(''); ?>
 
    <?php //echo anchor('Update'); ?>
<!--    <input type="submit" class="btn btn-large btn-info msgbox-confirm" value="Update" name="btnSubmit" style="width: 5em;" >-->
          <button type="submit" class="btn btn-default" onclick="return confirm('Are you sure want to delete the Ward?');" data-toggle="tooltip" data-placement="top" title="Delete">
        <span class="glyphicon glyphicon-trash"></span>
        </button>
        
        <?php echo form_close(); ?>
    </td>


     </tr> 

</table>
   <legend></legend>