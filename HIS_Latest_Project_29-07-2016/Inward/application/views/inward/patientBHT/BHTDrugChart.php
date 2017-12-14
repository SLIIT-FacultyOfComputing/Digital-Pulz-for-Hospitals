
<?php
foreach ($wardadmission as $value) {

    $bhtNo = $value->bhtNo;
    $patientID = $value->patientID->patientID;
}
?>

 <script> 
            $(document).ready(function(){
                $("#flip").click(function(){
                    $("#panel").slideToggle("slow");
                });
            });
        </script>
        <style> 

            #panel
            {
                
              
            }
        </style>
<!--<script> 
    $(document).ready(function(){
        $("#flip").click(function(){
            $("#panel").slideToggle("slow");
        });
    });
</script>
<style> 

    #panel
    {

        display:none;
    }
</style>-->

<div class="panel panel-primary">
    <div class="panel-heading" style="background-color:whitesmoke">
        <h3 class="panel-title" style="color:#428BCA">Patient Drug Chart</h3>
    </div>
    <div class="panel-body">

        <div class="tables">
            <!--class="table table-bordered table-striped table-hover" -->
            <table style="width: 100%;"   class="table table-hover table table-striped" >
                <col style="width: 19%;">
                <col style="width: 19%;">
                <col style="width: 19%;">
                <col style="width: 20%;">
                <col style="width: 20%;">
              <!--  <col style="width: 23%;">-->
                <col style="width: 3%;">



                <thead>
                    <tr >

                        <th  style="text-align: center;" >Drug</th>
                        <th  style="text-align: center;">Dose</th>
                        <th  style="text-align: center;">Frequency</th>
                        <th  style="text-align: center;">Issued Date</th>
                        <th  style="text-align: center;">End Date</th>
                        <th  style="text-align: center;" colspan="1"></th>


                    </tr>
                </thead>
                <?php
                while ($row = mysqli_fetch_array($prescribeItems)) {
                    ?>
                    <tr style="text-align: center;  ">

                        <td style=" vertical-align: middle"><?php echo $row['drug_id'];        ?></td>
                        <td style=" vertical-align: middle"><?php echo $row['dose'];        ?></td>
                        <td style=" vertical-align: middle"><?php echo $row['frequency'];        ?></td>
                        <td style=" vertical-align: middle"><?php echo $row['start_date'];        ?></td>
                        <td style=" vertical-align: middle">
                            
                            <?php 
                            if($row['end_date']==NULL)
                            {
                                echo "Continue Drug";
                            }else{
                                echo $row['end_date'];  
                            }
                                
                            
                            
                            ?>
                        
                        
                        </td>





                        <td style=" vertical-align: middle">
                            <?php echo form_open('inward/patientBHTC/UpdateDrugView/'.$bhtNo.'/'.$patientID); ?>
                             <input type="hidden" id="drug_id" name="drug_id" value="<?php echo $row['drug_id'];  ?>" />
                            
                           
                            <button type="submit" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Edit" onclick="return confirm('Are you sure want to Omit Drug?');">
                                <span  class="glyphicon glyphicon-pencil">Omit</span>
                            </button>
                            <?php echo form_close(); ?>
                        </td>
                    </tr> 

                    <?php
                }
                ?>
            </table>
        </div>
        
        <div id="flip">
            <a style="cursor: pointer; color: orange;">Omitted Drugs</a>
        </div>

        <div class="alert alert-warning" id="panel">
            <table style="width: 100%;"   class="table table-hover table table-striped" >
                <col style="width: 19%;">
                <col style="width: 19%;">
                <col style="width: 19%;">
                <col style="width: 20%;">
                <col style="width: 20%;">
              <!--  <col style="width: 23%;">-->
                <col style="width: 3%;">



                <thead>
                    <tr >

                        <th  style="text-align: center;" >Drug</th>
                        <th  style="text-align: center;">Dose</th>
                        <th  style="text-align: center;">Frequency</th>
                        <th  style="text-align: center;">Issued Date</th>
                        <th  style="text-align: center;">End Date</th>
                        <th  style="text-align: center;" colspan="1"></th>


                    </tr>
                </thead>
                <?php
                while ($row = mysqli_fetch_array($OmittedItems)) {
                    ?>
                    <tr style="text-align: center;  ">

                        <td style=" vertical-align: middle"><?php echo $row['drug_id'];        ?></td>
                        <td style=" vertical-align: middle"><?php echo $row['dose'];        ?></td>
                        <td style=" vertical-align: middle"><?php echo $row['frequency'];        ?></td>
                        <td style=" vertical-align: middle"><?php echo $row['start_date'];        ?></td>
                        <td style=" vertical-align: middle">
                            
                            <?php 
                            
                                echo $row['end_date'];                           
                            ?>
                        
                        
                        </td>





                     
                    </tr> 

                    <?php
                }
                ?>
            </table>
            
        </div>           
    </div>
</div>
