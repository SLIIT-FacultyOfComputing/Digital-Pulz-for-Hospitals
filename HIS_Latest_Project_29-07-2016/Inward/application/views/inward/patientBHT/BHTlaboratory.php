
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
<div class="panel panel-primary">
    <div class="panel-heading" style="background-color:whitesmoke">
        <h3 class="panel-title" style="color:#428BCA">Patient Laboratory Test Results</h3>
    </div>
    <div class="panel-body">    
  

        <br/>
        <!--class="table table-bordered table-striped table-hover" -->
        <table style="width: 100%;" class="table table-hover">
            <col style="width: 20%;">
            <col style="width: 20%;">
            <col style="width: 15%;">
            <col style="width: 15%;">
            <col style="width: 10%;">
            <col style="width: 10%;">



            <thead>
                <tr>

                    <th >Laboratory Testing Type</th>
                    <th >Laboratory Name</th>
                    <th >priority</th>
                    <th >Test Due Date</th>
                    <th>Spacial Notes</th>
                    <th ></th>


                </tr>
            </thead>

            <tr>

                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

                <td>
                    <?php echo form_open(''); ?>

<!--    <input type="submit" class="btn btn-large btn-info msgbox-confirm" value="View" name="btnSubmit" style="width: 5em;" >-->
                     <button  type="submit" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="View">
                                <span  class="glyphicon glyphicon-search">View</span>
                            </button>

                    <?php echo form_close(); ?>
                </td>




            </tr> 

        </table>
    </div>
</div>