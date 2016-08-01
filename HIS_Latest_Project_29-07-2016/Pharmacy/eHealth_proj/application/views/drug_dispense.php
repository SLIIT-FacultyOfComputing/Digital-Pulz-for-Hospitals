
<section class="content">
          <!-- Default box -->

                      <div class="panel panel-primary" style="width: 100%">
                    <div class="panel-heading">Drug Dispense</div>
                    <div class="panel-body">
                        
                <p>
                    <form id="frmDispense" name="frmDispense">
                        <div> <h3>Patient ID :</h3>  <input type="text" id="pation" name="pation"/>
                         <input type="button" id="search" name="search" value="Search"/>
                         </div>
                    </form>
                </p>
                                    <!-- prescrib table -->
                                    <div id="prescribDiv"  style="width:100%">
                                        <div id="pait" >
                                            
                                        </div>
                                        <hr/>
                                        <div  style="background-color:#E5E5E5;">
                                            <table align="center" cellpadding="0" cellspacing="0" border="0" id="prescribDataTable"
                                                   class="table table-striped table-nomargin  dataTable table-hover tablesorter">
                                                <thead>
                                                    <tr>
                                                        <th width="8%" class="head0">Prescription ID</th>
                                                        <th width="9%" class="head0">Create Date</th>
                                                        <th width="11%" class="head0">Create User</th>
                                                        <th width="10%" class="head0" style="width:15%">Prescription Date</th>
                                                        <th width="12%" class="head0">Last Update User</th>
                                                        <th width="11%" class="head0">Min.Over Payment</th>
                                                        <th width="10%" class="head0">Max.Over Payment</th>
                                                        <th width="10%" class="head0">Min. Pawning Weight</th>
                                                        <th width="9%" class="head0">Max. Pawning Weight</th>
                                                        <th width="0%" class="head0">hdnVal_1</th>
                                                        <th width="7%" class="head0">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- prescrib table --> 
                                    <!-- Items Table -->
                                    <div id="itembDiv" style="width:100%">
                                        <div><b> Drugs List </b>  </div>
                                        <hr/>
                                        <div >
                                            <table  cellpadding="0" cellspacing="0" border="0" id="itemDataTable"
                                                  class="table table-striped table-nomargin  dataTable table-hover tablesorter">
                                                <thead>
                                                    <tr>
                                                        <th width="8%" class="head0">Drug Description</th>
                                                        <th width="9%" class="head0">Dosage</th>
                                                        <th width="11%" class="head0">Frequency</th>
                                                        <th width="10%" class="head0" style="width:15%">Period</th>
                                                        <th width="12%" class="head0">Quantity</th>
                                                        <th width="11%" class="head0">drugID</th>
                                                        <th width="10%" class="head0">Max.Over Payment</th>
                                                        <th width="10%" class="head0">Min. Pawning Weight</th>
                                                        <th width="9%" class="head0">Max. Pawning Weight</th>
                                                        <th width="0%" class="head0">hdnVal_1</th>
                                                        <th width="7%" class="head0">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                        <hr/>
                                        <br/>
                                        <div align="center"><h4><input class="form-control" type="button" id="back" name="back" value="<< Back "/>&nbsp;&nbsp;&nbsp;<input type="button" class="btn btn-warning" id="dispense" name="dispense" value="Dispense"/></h4></div>
                                    </div>
                                    <!--  Items Table -->
                                    </div>
                    </div>


          <div class="box ">
            <div class="box-header with-border">
              <h3 class="box-title">Drug Stock</h3>
              <div class="box-tools pull-right">
              <!--   <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Expand"><i class="fa fa-plus"></i></button> -->
                <!-- <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> -->
              </div>
            </div>
            <div class="box-body">
            
        <div class="panel-body" >
            <?php
            //echo $drugsStock;
            $i=0;
            echo ' <table class="table table-bordered table-hover table-striped tablesorter">';?>
             <tr>
                    <th> Drug ID   </th>
                    <th> Drug Name   </th>
                    <th> Quantity   </th>


                </tr>
           <?php
           foreach ($drugsStock as $row) {
                
                    echo '<tr>';
                    print "<td >" . $row['drug_srno'] . "</td><td >" . $row['drug_name'] . "</td><td >" . $row['drugQty'] . "</td>";
                    echo '</tr>';
                    
            }
           
            echo '</table>';
            ?>

        </div>
            
            </div><!-- /.box-body -->
          </div><!-- /.box -->

                    
</section><!-- /.content -->
      
 
   <!--  <script type="text/javascript">
        

           function getPrescription() {

var thisPation="";
var nid="";

          
          alert("abc");

          thisPation=$('#pation').val();
         nid = thisPation.substring(4,10);

         alert(nid);

        //console.log($('#pation').val());
            $.ajax({
                url: 'http://localhost/eHealth_proj/index.php/Prescribe_Controller/getPrescriptionList',
                type: 'POST',
                data: {id: nid},
                crossDomain: true,
                success: function(data) {
                    console.log(data);
                    try {
                        data = trimData(data);
                        jo = $.parseJSON(data);
                        loadTable();
                    } catch (err) {
                        jo = [];
                        loadTable();
                    }
                }, error: function(xhr, textStatus, error) {
                    alert(xhr.statusText);
                    alert(textStatus);
                    alert(error);
                }
            });
         

   

   
 }
    </script> -->
                                    
                                    