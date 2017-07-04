<div class="row"><?php
   
     if (($dischjType == 'none') && ( $_SESSION['RoleId']!='4')) { ?>


        <div class="col-md-2">
            <?php echo form_open('inward/PrescrptionC/prescribeDurg/' . $bht_no . '/' . $patient_id); ?>

            <button  type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Prescribe Drugs">
                <span class="glyphicon glyphicon-list"> Prescribe Drugs</span>
            </button>
            <?php echo form_close(); ?> 
        </div>
    <?php } ?>
    <div class="col-md-2">
        <?php echo form_open('inward/PrescrptionC/ExtractDrug/' . $bht_no . '/' . $patient_id); ?>
        <button  type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Prescribe Drugs">
            <span class="glyphicon glyphicon-list-alt"> Expand Drug Charts</span>
        </button>
        <?php echo form_close(); ?> 
    </div>
    <div class="col-md-8">
        <span  style="color:#428BCA" class="pull-right text-primary small "><em>
                <span style="background-color: #d9edf7; border: 1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;:Active Drug&nbsp;&nbsp;&nbsp;
                <span style="background-color: #dff0d8; border: 1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;:Continuous Drug&nbsp;&nbsp;&nbsp;
                <span style="background-color: #fcf8e3; border: 1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;:Changed Dose/Frequency Drug&nbsp;&nbsp;&nbsp;
                <span style="background-color: #f2dede; border: 1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;:Omitted Drug&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </em> </span>
    </div>
</div>
<br/>
<div>
    <div id="accordion" class="panel panel-primary">
        <?php
        foreach ($TermList as $value) {
            $kk = new PrescrptionC();
            $itmsList = $kk->getPrescrptionItemsByTermID($value->term_id);
            ?>

            <div class="panel-heading" style="background-color:whitesmoke; cursor:pointer " >
                <h6 class="panel-title" >                
                    <?php
                    if ($value->no_of_terms == $count) {
                        ?>           
                        <span  style="color:#428BCA" class="text-primary  "><em><b>
                                    <?php echo "Active Drug Chart"; ?>
                                </b> </em> </span>

                        <?php
                    }
                    if (!$itmsList == NULL) {
                        ?>
                        <?php
                        if ($value->no_of_terms == $count) {
                            ?> 
                            <span  style="color:#428BCA" class=" text-primary small "><em>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                    Start Date : <?php echo date("Y-m-d ", $value->start_date / 1000); ?> 
                                </em> </span>
                            <span  style="color:#428BCA" class="pull-right text-primary small "><em>
                                    Prescribe By : <?php echo $value->create_user->hrEmployee->title . ". " . $value->create_user->hrEmployee->firstName . " " . $value->create_user->hrEmployee->lastName; ?>
                                </em></span>
                            <?php
                        } else {
                            if ($value->no_of_terms != $count) {
                                ?>  <span  style="color:#428BCA" class=" text-primary small "><em>
                                        Start Date : <?php echo date("Y-m-d ", $value->start_date / 1000); ?> 
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        End Date : <?php echo date("Y-m-d ", $value->end_date / 1000); ?> 
                                    </em> </span>
                                <span  style="color:#428BCA" class="pull-right text-primary small "><em>
                                        Prescribe By : <?php echo $value->create_user->hrEmployee->title . ". " . $value->create_user->hrEmployee->firstName . " " . $value->create_user->hrEmployee->lastName; ?>
                                    </em></span>
                                <?php
                            }
                        }
                        ?>

                    <?php } ?>
                </h6>
            </div>
            <div style="background-color:white  ">
                <?php
                if (!$itmsList == NULL) {
                    ?>
                    <table class="table table-hover">

                        <col style="width: 40%;">
                        <col style="width: 20%;">
                        <col style="width: 40%;">

                        <thead>
                        <th>Drug</th>
                        <th>Dosage</th>
                        <th>Frequency</th>               
                        </thead>
                        <tbody>


                            <?php
                            foreach ($itmsList as $item) {
                                ?>
                                <tr <?php
                    if ($item->status == 'omit') {
                        echo 'class="danger"';
                    } elseif ($item->status == 'chg') {
                        echo 'class="warning"';
                    } elseif ($item->status == 'con') {
                        echo 'class="success"';
                    } elseif ($item->status == 'active') {
                        echo 'class="info"';
                    }
                                ?>
                                    >
                                    <td><?php echo $item->drug_id->dName; ?></td>
                                    <td><?php echo $item->dose; ?></td>
                                    <td><?php echo $item->frequency; ?></td>

                                </tr>

                            <?php }
                            ?>

                        </tbody>
                    </table>
                    <?php
                }
                ?>


            </div>

            <?php
        }
        ?>
    </div>
</div>



<script>

    var icons = {
        header: "ui-icon-circle-arrow-e",
        activeHeader: "ui-icon-circle-arrow-s"
    };
    $( "#accordion" ).accordion({
        icons: icons,
        heightStyle: "content"
    });
</script>