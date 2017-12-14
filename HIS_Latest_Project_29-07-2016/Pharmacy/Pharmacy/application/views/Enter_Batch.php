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
                getCategoryListBC();

                
        </script>             
        <script type="text/javascript">

                $(document).ready(function() {

                  $('#drugNameDropDownBC').change(function (){

                    $('#quantityValueBC').val("");
                    if($('#drugNameDropDownBC').val().endsWith("ml"))
                    {
                        $('#mlvalue').attr('hidden', false);
                        $('#drugUnitQuantity').val($('#drugNameDropDownBC').val().split(" ").pop().replace("ml", ""));
                        getDetailsFromCartoonsorBottles();

                        $('#contentTypeDropDownBC').val("Liquid");
                        $('#contentTypeDropDownBC').prop("disabled", true);
                        getContentDetails();
                    }
                    else
                    {
                        $('#mlvalue').attr('hidden', true);
                        $('#drugUnitQuantity').val("");
                        $('#typeDropDownBC option:eq(0)').prop('selected', true);
                        $('#typeDropDownBC').prop("disabled", false);
                        getDetailsFromCartoonsorBottles();
                        $('#contentTypeDropDownBC option:eq(0)').prop('selected', true);
                        $('#contentTypeDropDownBC').prop("disabled", false);
                    }

                  });

                  $('#typeDropDownBC').change(function (){

                      if($('#drugNameDropDownBC').val().endsWith("ml"))
                      {
                          getDetailsFromCartoonsorBottles();

                          $('#contentTypeDropDownBC').val("Liquid");
                          $('#contentTypeDropDownBC').prop("disabled", true);
                          getContentDetails();
                      }
                      else
                      {
                          
                          //$('#typeDropDownBC option:eq(0)').prop('selected', true);
                          //$('#typeDropDownBC').prop("disabled", false);
                          getDetailsFromCartoonsorBottles();
                          $('#contentTypeDropDownBC option:eq(0)').prop('selected', true);
                          $('#contentTypeDropDownBC').prop("disabled", false);
                      }
                  });

                });

                String.prototype.endsWith = function(suffix) {
                  return !!this.match(suffix+"$");
                }
        </script>
<section class="content">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Add New Batch</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Select Drug Category</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label" for="sm">Drug Category:</label>
                        <div class="col-sm-6">
                            <select class="form-control"  id="categoryDropDownBC" name="categoryDropDownBC" onchange="getDrugByCategoryBC()">
                                            <option value="default" selected="selected">All</option>
                            </select>
                        </div>
                 </div>
                 <br>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
          
            <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Add Received Drug</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label" for="sm">Drug Name:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="drugNameDropDownBC" name="drugNameDropDownBC">
                            </select>
                        </div>
                 </div>
                 <br>
                 <div class="form-group form-group-sm" id="mlvalue" hidden>
                    <label class="col-sm-4 control-label" for="sm">Drug's Unit Quantity:</label>
                        <div class="col-sm-6">
                             <input class="form-control" type="text" disabled="disabled" name="drugUnitQuantity" id="drugUnitQuantity">
                        </div>
                        <br>
                 </div>
                 
                 <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label" for="sm">Batch Number:</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="batchNoValueBC" id="batchNoValueBC" onkeyup="validateField(this.value, 'batcherror')"/><span id="batcherror"></span>
                        </div>
                 </div>
                 <br>
                 <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label" for="sm">Type:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="typeDropDownBC" name="typeDropDownBC" onchange="getDetailsFromCartoonsorBottles()">
                                            <option value="" disabled="disabled" selected="selected">Please select a type</option>
                                            <option value="Cartoons">Cartoons</option>
                                            <option value="Bottles">Bottles</option>
                            </select>
                        </div>
                 </div>
                <br>
                <div id="itemspaceBC" ></div>
                <div id="cartoonspaceBC"></div>
                <div id="quantityspaceBC"></div>
                <br>
                 <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label" for="sm">Quantity:</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" disabled="disabled" name="quantityValueBC" id="quantityValueBC" onkeyup="validateQty(this.value, 'qtyerror')" /><span id="qtyerror"></span>
                        </div>
                 </div>
                <br>
                 <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label" for="sm">Manufacure Date:</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="date" id="manufactureDateValueBC" name="manufactureDateValueBC"/><span id="manerror"></span>
                        </div>
                 </div>
                <br>
                 <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label" for="sm">Expire Date:</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="date" id="expireDateValueBC" name="expireDateValueBC" /><span id="experror"></span>
                        </div>
                 </div>
                <br>
                 <input type="submit" class="btn btn-primary" value="Add Batch" onclick="addDrugBatchBC()"/>
                            

            </div><!-- /.box-body -->
          </div><!-- /.box -->
               






            </div><!-- /.box-body -->
          </div><!-- /.box -->
          
</section><!-- /.content -->
            
                
                
  