<script>
    $(function () {
        $('#myTab a:last').tab('show');
    })
</script>
            
    <div class = "row">      
      <div class = "col-md-12">
        <div class="panel ">
            <div class="panel-heading"> <!-- Starting point of panel Head-->
                <h2 class="panel-title">My Home</h2>
            </div> 
            <div class="panel-body">  


                <div class="widget-title">
                    <span class="icon">
                        <i class="icon-tasks"></i>
                    </span>
                    <h5><b>Queue</h5>
                </div>
<!--          <table style="float:left; width: 255px;  margin-left: 20px;  margin-top: 18px;">
              <tr>
                    <div class="widget-content nopadding">
                        <div class="chat-content panel-left">                   
                        <div class="chat-messages" id="chat-messages">
                        <div>
<td>-->
                <!--<ul >-->

   <!--<li><i class="icon-user"></i>  <?php
                echo "Dr." . $seldoc[0]->employees->empName;
                ;
                ?>   </p>-->


<!--                                <li><i class="icon-user"></i> <strong><?php echo sizeof($qpatients); ?></strong> <small>Patient(s)</small></li>
     <li style="<?php if ((isset($qstatus) && $qstatus == '2') | (isset($qstatus) && $qstatus == '1')) echo 'background-color: #F2DEDE;border-color: #EED3D7;'; ?> "><i class="icon-arrow-right"></i> 
         <strong>
                <?php
                if (isset($qstatus) && $qstatus == '1')
                    echo 'Full';
                if (isset($qstatus) && $qstatus == '0')
                    echo 'Open';
                if (isset($qstatus) && $qstatus == '2')
                    echo 'On Hold';
                ?> 
         </strong> 
         <small>Queue Status</small>
     </li>

     <li><i class="icon-arrow-right"></i> <strong>  <?php
                if (isset($qtype) && $qtype == '0')
                    echo 'Regular';
                else
                    echo 'Visit';
                ?> </strong> <small>Queue Type</small></li>-->
                <!--
                                                <li class="divider"></li>-->


                <!--</ul>-->

                <!--</td>
                              </tr></table>-->
                <!--			</div>-->

                <div id="q"  class="widget-content qcontainer">
<?php if (sizeof($qpatients) == 0) { ?>

                        <!--                            <div id="w1" class="alert alert-warning" style='height: 91%; position: relative;  left: -4px;  top: 6px;  '>
                                                        <center>
                                                            <br><br><br><br>
                                                            <h4> There Are No Patients In The Queue  </h4> 
                                                        </center>
                                                    </div>-->

                    <?php } ?>

<?php if ($qpatients != NULL) foreach ($qpatients as $row) { ?>

                            <div class="img-thumbnail" style=""onClick="window.location = '<?php echo "../../../operator_home_c/viewpatient/" . $row->patient->patientID . " "; ?>" id="entry1" class="<?php //if( $row['Status'] =="In") echo 'glow';     ?> qentry" class="qentry" > 
                                <h2>  <?php echo $row->queueTokenNo; ?>  </h2>
                                <!--</div>--> 
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

                        

    <?php } ?>

            		



<?php if ($doclist != NULL) foreach ($doclist as $row) { ?>
                    <!--<div class="img-thumbnail">-->
                    <div id="doc" ><img  alt="" src="<?php echo base_url() . "/assets/" ?>ico/docicon.png" />
                        <a href="<?php echo site_url("/operator_home_c/view/3/" . $row->hrEmployee->firstName); ?> ">
                        <?php echo "Dr." . $row->hrEmployee->firstName . " " . $row->hrEmployee->lastName; ?>
                        </a>				
    <?php } ?>
            </div>
            <!--</div>-->
            <!--</div>-->


            <div  style="position: relative;width:220px;margin-left: 15px;margin-top: 30%;"> 
                <input class="btn btn-primary"  type="button" onClick="<?php echo "window.location='/SEP_Project/index.php/queue_c/setQType'"; ?>" value="<?php
                if (isset($qtype) && $qtype == 1)
                    echo 'Enable Regular Queue';
                else
                    echo 'Enable Visit Queue';
                ?>" class="btn btn-success" style="width:220px;" /><br><br>
            </div>


