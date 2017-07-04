<style type="text/css" class="init">

    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }

</style>
<script type="text/javascript" language="javascript" class="init">


    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#example tfoot th').each( function () {
            var title = $('#example thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );

        // DataTable
        var table = $('#example').dataTable();

        // Apply the search
        table.columns().eq( 0 ).each( function ( colIdx ) {
            $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
                table
                .column( colIdx )
                .search( this.value )
                .draw();
            } );
        } );
    } );


</script>
<!--<div class="panel panel-primary" >
    <div class="panel-heading" style="background-color:whitesmoke">
        <h4 class="panel-title" style="color:#428BCA">Ward Admissions</h4>
    </div>
    <div class="panel-body">-->
<div class="row">
 <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Ward Admission</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">  
                    <col style="width: 10%;">
                    <col style="width: 10%;">
                    <col style="width: 25%;">
                    <col style="width: 10%;">
                    <col style="width: 10%;">
                    <col style="width: 15%;">
                    <col style="width: 15%;">
                    <col style="width: 5%;">
                    <thead>
                        <tr>


                            <th  style="text-align: center;">BHT No</th>
                            <th  style="text-align: center;">patient ID</th>
                            <th  style="text-align: center;">patient Name</th>
                            <th  style="text-align: center;">Ward No</th>
                            <th  style="text-align: center;">Bed No</th>
            <!--                <th >Daily No</th>
                            <th >Monthly No</th>
                            <th >Yearly No</th>-->
                            <th  style="text-align: center;">Admitted Date</th>
                            <th style="text-align: center;">Admitted Time</th>
                            <th ></th>


                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                            <th>Age</th>
                            <th>Start date</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        date_default_timezone_set("Asia/Colombo");
                        foreach ($WardAdmissions as $value) {
                            ?>
                            <tr style="text-align: center;  ">


                                <td style=" vertical-align: middle"><?php echo $value->bhtNo; ?></td>
                                <td style=" vertical-align: middle"><?php echo $value->patientID->patientID; ?></td>
                                <td style=" vertical-align: middle"><?php
                        echo $value->patientID->patientTitle;
                        echo $value->patientID->patientFullName;
                            ?></td>
                                <td style=" vertical-align: middle"><?php echo $value->wardNo; ?></td>
                                <td style=" vertical-align: middle">
                                    <?php
                                    if ($value->bedNo == -99) {
                                        echo "None";
                                    } else {
                                        echo $value->bedNo;
                                    }
                                    ?>
                                </td>
                            <!--    <td><?php //echo $value->dailyNo;     ?></td>
                                <td><?php //echo $value->monthlyNo;     ?></td>
                                <td><?php //echo $value->yearlyNo;     ?></td>-->
                                <td style=" vertical-align: middle"><?php echo date("Y-m-d ", $value->admitDateTime / 1000); ?></td>
                                <td style=" vertical-align: middle"><?php echo date(" h:ia", $value->admitDateTime / 1000); ?></td>

                                <td style=" vertical-align: middle">
                                    <?php echo form_open('inward/wardAdmissionC/admissionSearch'); ?>
                                    <input type="hidden" id="bhtNo" name="bhtNo" value="<?php echo $value->bhtNo; ?>" />
                                <!--    <input type="submit" value="View">-->
                                    <button type="submit" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="View">
                                        <span   class="glyphicon glyphicon-search">View</span>
                                    </button>

                                    <?php echo form_close(); ?>
                                </td>

                            </tr> 

                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
</div>

<!--    </div>
</div>-->
