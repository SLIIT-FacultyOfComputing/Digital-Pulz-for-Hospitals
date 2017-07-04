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
        getCategoryListDC();
</script>    
      
<section class="content">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Drug Information</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label" for="sm">Drug Category:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="categoryDropDownDC" name="categoryDropDownDC" onchange="getDrugByCategoryDC()">
                                            <option value="" disabled="disabled" selected="selected">Please select a type</option>
                            </select>
                        </div>
            </div>
            <br>
            <p id="drugspaceDC"></p>
            <br></br>
            <p id="tablespaceDC"></p> 
            <br>
             <div class="post" id="post_drugDetails_tbl_DC" style="visibility: hidden;">
                                            <div class="entry">               
                                                <p id="pagespaceDC"></p>
                                                <a name="detailsPost"></a>
                                            </div>
            </div>

            </div><!-- /.box-body -->
          </div><!-- /.box -->
</section><!-- /.content -->

