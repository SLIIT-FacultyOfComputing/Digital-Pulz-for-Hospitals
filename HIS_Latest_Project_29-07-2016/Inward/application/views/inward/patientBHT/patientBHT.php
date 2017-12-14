<br/>
<?php echo form_open('inward/patientBHTC/SearchPatientView'); ?>

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
            <input id="patientID" name="patientID" type="text" class="form-control" value="" required="required" />
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

