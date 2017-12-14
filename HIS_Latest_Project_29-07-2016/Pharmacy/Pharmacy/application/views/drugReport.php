<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<body onload="getCategoryListDC()">
<section class="content-header">
          <h1>
            Pharmacy Stock
            <small>stock</small>
          </h1>
</section>
<section class="content">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
            <?php $currentDate = date("F j, Y"); ?>   
              <h3 class="box-title">Low Stocks as on <?php echo$currentDate ?></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            <div class="row">
                        <div class="col-md-6">
                            <p style="color: red">Less than Danger Level</p>
                             
                        
                        </div>
                        <div class="col-md-6" style="margin-left: -350px">
                            <p style="color: orange">Less than ReOrder Level</p>
                        </div>
                       
            </div>            
        <form action='http://localhost/Pharmacy/index.php/Report_Controller/requestMailDrug' method='post'>
                        <p>
                <table class="table table-bordered table-striped table-hover" id="tabletestp" >
                        <br>
                        <thead>
                            <tr>
                                <th >Drug Name</th>
                                <th >Unit Type</th>
                                <th >Drug Category</th>
                                <th >Drug Price</th>
                                <th >Drug Quantity</th>
                                <th >Send Mail</th>
                             </tr>
                        </thead>
                        <tbody>
                                <?php
//-------------------------------------------------------

                                $dusr = new Report_Controller();
                                $details = $dusr->drugReportNew();

//--------------------------------------------------------------------
                                $s = 0;
                                foreach ($details as $value) {

                                    $drugPcs = explode(":", $details[$s]);
                                    echo "<tr>";
                                    echo "<td align='center'>$drugPcs[0]</td>";
                                    echo "<td align='center'>$drugPcs[5]</td>";
                                    echo "<td align='center'>$drugPcs[2]</td>";
                                    echo "<td align='center'>$drugPcs[3]</td>";
                                    if ($drugPcs[4] <= $drugPcs[6]) {
                                        echo "<td align='center' style='color:red'>$drugPcs[4]</td>";
                                    } else if ($drugPcs[4] <= $drugPcs[7]) {
                                        echo "<td align='center' style='color:orange'>$drugPcs[4]</td>";
                                    }
                                    echo "<td align='center'>";
                                    // echo "<input type='submit' name='qwe' id='qwe' value='" .$drugPcs[1]. "' style='text-align:center; width:100px'>";
                                    echo "<button type='submit' name='asd' id='asd' class='btn btn-primary btn-xs' value='" . $drugPcs[1] . "' >Place Order </button>";
                                    echo "</td>";
                                    echo "</tr>";
                                    $s++;
                                }
                                ?>
                                <tbody>
                        </table>
                </form>
                <form name="getcvs" action="report_pdfA" method="post">
                        <div>
                            <input type="submit" class="btn btn-primary" name="submitpdf" value="View as PDF " align="center"/>
                        </div>
                        <input type="hidden" name="count_basic_skills" value='<?php echo $details[1]; ?>'/>
                        <input type="hidden" name="count_basic_skills" value='<?php echo $details[2]; ?>'/>
                </form>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
 </section><!-- /.content -->

    
</body>