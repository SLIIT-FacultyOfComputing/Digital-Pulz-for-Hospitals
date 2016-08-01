 <body onload="getCategoryListDC()">                            
<section class="content">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Drug Request Mail Sender</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">

        <?php
                                    /* @var $_POST type */
        ( $s = $_POST['asd']);
        $st = substr($s, 0, 4);
        //echo $st;
        //-------------------------------------------------------

        $dusr = new Report_Controller();
        $details = $dusr->drugReportNew();

        //--------------------------------------------------------------------
        $id = 0;
        $name = 0;
        $cat = 0;
        $price = 0;
        $quty = 0;

        $s=0;
        foreach ($details as $value) {
            $drugPcs = explode(":", $details[$s]);

            if ($drugPcs[1] === $st) {

                $name = $drugPcs[0];
                $cat = $drugPcs[2];
                $price = $drugPcs[3];
                $quty = $drugPcs[4];
            }
            $s++;
        }
        $text = "" . "\n"
                . "Dear Officer," . "\n"
                . "The Quantities of the below Drugs are Low." . "\n"
                . "Name     :" . $name . "\n"
                . "Catagary :" . $cat . "\n"
                . "Price(Rs)    :" . $price . "\n"
                . "Quantity in Hand :" . $quty . "\n"
                . "Please be kind enough to send us new stocks" . "\n"
                . "" . "\n"
                . "" . "\n"
                . "Best Regards," . "\n"
                . "Chief Pharmasist" . "\n";

        $subject = "Drug Reorder Request For " . $name;
        ?>

        <form action='http://localhost/eHealth_proj/index.php/Report_Controller/sendRequestMail' method='post'>
            <table class="table table-hover" style="width:100%">
                <tr>
                    <td>From :</td>
                    <td style="margin-left: 12px"><input  type="text" name="from" id="from" value="ehealthpharmacy111@gmail.com" class="form-control" readonly  style="width:830px " /></td>
                </tr>
                <tr>
                    <td>To:</td>
                    <td style="margin-left: 12px"><input  type="text" name="to" id="to" class="form-control" readonly value="shamith1991@gmail.com" style="width:830px " /></td>
                </tr>
                <tr>
                    <td>Subject:</td>
                    <td style="margin-left: 12px"><input  type="text" name="subject" class="form-control" readonly  id="subject" value="<?php echo $subject ?>" style="width:830px "</td>
                </tr>
                <tr>
                    <td>Content:</td>
                    <td style="margin-left: 12px"><textarea name="cont" class="form-control"   id="cont" rows="15" cols="70">
                            <?php echo $text ?>
                        </textarea></td>
                </tr>
            </table>

            <div align="left" style="margin-left: 75px">
                <input type="submit" name="submitpdf" class="btn btn-primary" value="SEND" align="left"/>
                <input type="hidden" name="id" id="id" value="<?php echo $st; ?>"/>
            </div>
        </form>

                
            </div><!-- /.box-body -->
          </div><!-- /.box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Mail History For Selected Drugs</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            <table class="table  table-hover table-striped tablesorter">
                
                    <tr>
                        <td>Content</td>
                        <td style="width: 100px">Date</td>
                    </tr>


               
                <?php
//-------------------------------------------------------
                            $dusrMail = new Report_Controller();
                            $detailsMailHi = $dusrMail->getMailHistory();
                            $s=0;

                            foreach ($detailsMailHi as $key=>$value) {
                                $drugPcsMail = $value;
                                $s++;
                                if($drugPcsMail->mailHistory_Drug->dSrNo  == $st){
                                         //--------------------------------------------------------------------
                ?>
                <tr>
                        <td><?php echo $drugPcsMail->mailHistory_Content?></td>
                        <td><?php echo $drugPcsMail->mailHistory_SendDate?></td>
                 </tr>
        <?php }}?>
        </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
</section><!-- /.content -->



    </body>