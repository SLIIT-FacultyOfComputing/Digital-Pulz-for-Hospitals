<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<script>
    $(function () {
        $('#myTab a:last').tab('show');
    })
</script>
            
    <div class = "row">      
      <div class = "col-md-12">
        <div class="panel ">
            <div class="panel-heading"> <!-- Starting point of panel Head-->
                <h2 class="panel-title"><b>Queue</b></h2>
            </div> 
            <div class="panel-body">  



                <div id="q"  class="widget-content qcontainer">

                    <!--<?php if ($qpatients != NULL) foreach ($qpatients as $row) { ?>

                            <div class="img-thumbnail" style=""onClick="window.location = '<?php echo "../../../operator_home_c/viewpatient/" . $row->patient->patientID . " "; ?>" id="entry1" class="<?php //if( $row['Status'] =="In") echo 'glow';     ?> qentry" class="qentry" >
                                <h2>  <?php echo $row->queueTokenNo; ?>  </h2>
                                <!--</div>
                                <img class="" src="<?php
                                if ($row->patient->patientGender == 'Male') {
                                    echo base_url() . "/assets/ico/proimage.jpg";
                                } else {
                                    echo base_url() . "/assets/ico/proimagefemale.png";
                                }
                                ?>" style='width: 55px;margin:5px 0px 0px 5px;'/>

                                <div id="info"  >
                                    <p><b>Patient ID : </b><?php echo $row->patient->patientID; ?>  </p>
                                    <p><b>Name :  </b><?php echo $row->patient->patientFullName; ?> </p>
                                </div>
                <?php } ?>-->




                    <h5><b>OPD</b></h5>
                    <?php
                    $count = 0;
                    if ($doclist != NULL) foreach ($doclist as $row) {

                        if ($row->type == 0) {
                            $count++;
                            ?>
                            <div id="doc" ><img  alt="" src="<?php echo base_url() . "/assets/" ?>ico/docicon.png" width="5%" height="5%"/>
                                <b><a href="<?php echo site_url("/operator_home_c/view/3/" . $row->hrEmployee->firstName); ?> ">
                                    <?php echo "Dr." . $row->hrEmployee->firstName . " " . $row->hrEmployee->lastName; ?>
                                </a></b></div>
                        <?php }}

                    if($count == 0) { ?>
                        <div id="doc" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>No Doctors in OPD</b></div>
                    <?php }?>
                </div>
                    <h5><b>Clinic</b></h5>
                    <?php
                    $count = 0;
                    if ($doclist != NULL) foreach ($doclist as $row) {

                        if ($row->type == 1) {
                            $count++;
                        ?>
                            <div id="doc" ><img  alt="" src="<?php echo base_url() . "/assets/" ?>ico/docicon.png" width="5%" height="5%"/>
                            <b><a href="<?php echo site_url("/operator_home_c/view/3/" . $row->hrEmployee->firstName); ?> ">
                                <?php echo "Dr." . $row->hrEmployee->firstName . " " . $row->hrEmployee->lastName; ?>
                            </a></b></div>
                        <?php }}

                        if($count == 0) { ?>
                            <div id="doc" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>No Doctors in clinic</b></div>
                        <?php }?>
            </div>
            <!--</div>-->
            <!--</div>-->


<!--            <div  style="position: relative;width:220px;margin-left: 15px;margin-top: 30%;"> -->
<!--                <input class="btn btn-primary"  type="button" onClick="--><?php //echo "window.location='/SEP_Project/index.php/queue_c/setQType'"; ?><!--" value="--><?php
//                if (isset($qtype) && $qtype == 1)
//                    echo 'Enable Regular Queue';
//                else
//                    echo 'Enable Visit Queue';
//                ?><!--" class="btn btn-success" style="width:220px;" /><br><br>-->
<!--            </div>-->


