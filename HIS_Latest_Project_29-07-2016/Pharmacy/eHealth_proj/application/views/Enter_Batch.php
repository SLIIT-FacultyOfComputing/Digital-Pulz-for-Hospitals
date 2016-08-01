
        <script>
                getCategoryListBC();
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
            
                
                
  