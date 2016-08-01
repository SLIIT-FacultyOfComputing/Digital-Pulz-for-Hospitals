<script>
    getCategoryListDCUpdate();


</script>
  <!-- Main content -->
<section class="content">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Update Drug Information</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                 <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label" for="sm">Drug Category:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="categoryDropDownDC" name="categoryDropDownDC" onchange="getDrugByCategoryDCUpdate()">
                            </select>
                        </div>
                 </div>
                 <br>
                 <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label" for="sm">Drug Name:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="drugNameDropDownDC" autofocus="true" name="drugNameDropDownDC" onchange="getDrugDetailsByDNameDC()">
                                            <option value="" disabled="disabled" selected="selected">Please select a type</option>
            
                            </select>
                        </div>
                 </div>
                 <br>
                 <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label" for="sm">Drug Type:</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="drugTypeDC" id="drugTypeDC" disabled="disabled"/>
                        </div>
                 </div>
                 <br>
                 <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label" for="sm">Price:</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="priceValueDC" id="priceValueDC" onkeyup="validatePrice(this.value, 'priceerror')"/><span id="priceerror"></span>
                        </div>
                 </div>
                 <br>
                 <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label" for="sm">Reorder Level:</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="reorderValueDC" id="reorderValueDC" onkeyup="validateQty(this.value, 'reordererror')"/><span id="reordererror"></span>
                        </div>
                 </div>
                 <br>
                 <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label" for="sm">Danger Level:</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="dangerValueDC" id="dangerValueDC" onkeyup="validateQty(this.value, 'dangererror')"/><span id="dangererror"></span>
                        </div>
                 </div>
                 <br>
                 <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label" for="sm">Remarks:</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="remarksValueDC" id="remarksValueDC" onkeyup="validateField(this.value, 'remerror')"/><span id="remerror"></span>
                        </div>
                 </div>
                 <br>
                 <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label" for="sm"></label>
                        <div class="col-sm-6">
                          <input type="submit" id="btnUpAdd" class="btn btn-primary" value="Update Drug" onclick="getAll()"></input>
                        </div>
                 </div>
                 <br>   
            </div><!-- /.box-body -->
          </div><!-- /.box -->
 </section><!-- /.content -->

