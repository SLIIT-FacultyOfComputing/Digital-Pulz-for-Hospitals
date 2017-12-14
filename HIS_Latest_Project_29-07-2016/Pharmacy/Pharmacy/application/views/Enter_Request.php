<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jqPharmacyRC.js"></script>
<script type="text/javascript">
    getCategoryListRC();
</script>
<section class="content">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Send Requests</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
  <section id="selectdrug">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Select Drug</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
             <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label" for="sm">Drug Category:</label>
                        <div class="col-sm-6">
                            <select class="form-control"  id="categoryDropDownRC" name="categoryDropDownRC" onchange="getDrugByCategoryRC()">
                                            <option value="default" selected="selected">All</option>
                            </select>
                        </div>
                 </div>
            <br>
            </div><!-- /.box-body -->
          </div><!-- /.box -->         
</section><!-- /.content -->               
<section id="box2" style="visibility: hidden;">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Drug and Quantity</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label" for="sm">Drug Name:</label>
                        <div class="col-sm-6">
                            <select class="form-control"  id="drugNameDropDownRC" name="drugNameDropDownRC" >
                                            <option value="default" selected="selected">All</option>
                            </select>
                        </div>
                 </div>
            <br>
            <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label" for="sm">Quantity:</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="drugQtyRC" id="drugQtyRC" onkeyup="validateQty(this.value,'qtyerror')" /><span id="qtyerror"></span>
                        </div>
            </div>
            <br>
            <br/>
            <input type="button" class="btn btn-primary" value='Add Request' onclick="createRequestOptiontableRC()" />
            <br>                
            <p id="drugspaceRC"></p>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
                    
</section><!-- /.content -->                                    
<section id="post_request_tbl_RC" style="visibility: hidden;">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Send Drug Requests</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            <div class="entry">
            <p id="tablespaceRC"></p>                    
            <input type=submit class="btn btn-primary" value="Send Request" onclick="SendRequestRC()" />
            </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
                    
</section><!-- /.content -->                                    
            </div><!-- /.box-body -->
          </div><!-- /.box -->         
</section><!-- /.content -->