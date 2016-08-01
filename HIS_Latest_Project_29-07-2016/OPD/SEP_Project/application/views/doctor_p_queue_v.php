<section class="content-header">
    <h1>
        My Queue
      
    </h1>
    
</section>
</br>

<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-4 col-md-offset-3" >
            <div class="box box-solid" style="box-shadow:0px 0px 2px rgba(0, 0, 0, 0.2)">
                <div class="box-header with-border">
                    <i class="fa fa-bookmark"></i>
                    <h3 class="box-title">Summary View</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Name </td>
                                <td> : </td>
                                <td><?php echo "Dr. " . $seldoc[0]->userName; ?> </td>
                            </tr>
                            <tr>
                                <td># of Patients </td>
                                <td> : </td>
                                <td><?php echo sizeof($qpatients) . " Patients"; ?></td>
                            </tr>
                            <tr>
                                <td>Queue Status </td>
                                <td> : </td>
                                <td><?php
                                    if (isset($qstatus) && $qstatus == '1')
                                        echo 'Full';
                                    if (isset($qstatus) && $qstatus == '0')
                                        echo 'Open';
                                    if (isset($qstatus) && $qstatus == '2')
                                        echo 'On Hold';
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td># of Treated Patients </td>
                                <td> : </td>
                                <td><?php
                                    if ($treatedpatients == null)
                                        echo "0";
                                    else
                                        echo sizeof($treatedpatients);
                                    ?></td>
                            </tr>
                            <tr>
                                <td>Queue Type </td>
                                <td> : </td>
                                <td><?php
                                    if ($qtype == 0) {
                                        echo 'Regular';
                                    } else {
                                        echo 'Visit';
                                    }
                                    ?></td>
                            </tr>
                        </tbody>
                    </table>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- ./col -->


        <div class="col-md-3" style="margin-top:-10px">
            <div class="box-body">
                <div class="box box-solid" style="box-shadow:0px 0px 2px rgba(0, 0, 0, 0.2)">
                    <div class="box-header with-border">
                        <i class="fa fa-random"></i>
                        <h3 class="box-title">Queue Controller</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body" style="margin-top:6px">
                        <br>
                        <input class="btn btn-block btn-primary" onClick="<?php echo "window.location='../../queue_c/holdQueue'"; ?>" value="<?php
                        if (isset($qstatus) && $qstatus == '2')
                            echo 'Resume Queue';
                        else
                            echo 'Hold Queue';
                        ?>"  />
                        <br><br>
                        <input type="button" onClick="<?php echo "window.location='../../queue_c/redirectQueue'"; ?>" value="<?php echo "Redirect Queue"; ?>" class="btn btn-block btn-danger"  /> 
                        <br>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>

    </div>
    <div class="row">

        <?php if (sizeof($qpatients) == 0) { ?>

            <div class="callout callout-info">
                <h4>Alert!</h4>
                <p>There Are No Patients In The Queue</p>
            </div>
            <center>
                <br><br>
                <h4 style="color: #E13300"> &nbsp;&nbsp;&nbsp;There Are No Patients In The Queue  </h4> 
            </center>


        <?php } ?>

    </div>




    <div class="row">
        <div class="box-body">
            <div class="box-header with-border bg-aqua">
                <i class="fa fa-medkit"></i>
                <h3 class="box-title">Queue Order</h3>
            </div><!-- /.box-header -->

            <br>
            <?php foreach ($qpatients as $row) { ?>
                <div class="col-lg-3 col-xs-4" onclick="clickhere()">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h5><b style="color:black;">Patient Name : <?php echo $row->patient->patientTitle . " " . $row->patient->patientFullName; ?></b></h5>
                            <p>Patient ID : <?php echo $row->patient->patientHIN; ?></p>
                            <p>Queue Number : <?php echo $row->queueTokenNo ?></p>
                        </div>
                        <div class="icon" >
                            <i class="<?php
                            if ($row->patient->patientGender == 'Male') {
                                echo "fa fa-male";
                            } else {
                                echo "fa fa-female";
                            }
                            ?>"></i>
                        </div>
                        <a  style="padding-top:15px" href=  "<?php echo site_url("/patient_overview_c/view/".$row->patient->patientID); ?>" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>



            <?php } ?>

        </div>
    </div><!-- /.row -->
    <!-- Main row -->

</section>

<br>        


<script src="<?= base_url('/Bootstrap/js/barcdeReader'); ?>"></script>
<script type="text/javascript">
  
    function clickhere()
    {

        document.location.href = "<?php echo site_url("/patient_overview_c/view/".$row->patient->patientID); ?>";
    }
    
</script>






