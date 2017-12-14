<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<style type = "text/css">

	form li{
		list-style:none;
	}

</style>
<!--<link rel="stylesheet" type="text/css" href="<?php // echo base_url('/Contents/cssnew/ehealth.css'); ?>" media="all"/>-->

<script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>common.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jq_pharmacy.js"></script>
<link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/bootstrap.css'); ?>" media="all"/>

<!--<link rel="stylesheet" type="text/css" href="--><?php //echo base_url('/Bootstrap/css/sb-admin.css'); ?><!--" media="all"/>-->
<!--<link rel="stylesheet" type="text/css" href="--><?php //echo base_url('/Bootstrap/font-awesome/css/font-awesome.min.css'); ?><!--" media="all"/>-->
<!--<link rel="stylesheet" type="text/css" href="--><?php //echo base_url('/css/demo_table.css'); ?><!--" media="all"/>-->
<!--<link rel="stylesheet" type="text/css" href="--><?php //echo base_url('/css/jquery.dataTables.css'); ?><!--" media="all"/>-->
<!--<link rel="stylesheet" type="text/css" href="--><?php //echo base_url('/css/jquery.dataTables_themeroller.css'); ?><!--" media="all"/>-->
<!--<link rel="stylesheet" type="text/css" href="--><?php //echo base_url('/css/demo_table_jui.css'); ?><!--" media="all"/>-->


<script type="text/javascript">
function json()
{
			//var test = document.getElementById('d_name').value;
			window.location.href = "<?php echo site_url('batch_controller/loadDrug'); ?>";
			//alert('Succsess');
}
</script>

<section class="content">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Get Drug Report - Expires within 90 Days</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                <input type="submit"  class="btn btn-primary btn-md" value="Generate Drug Report" onclick="getDrugReportR()"/>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
</section><!-- /.content -->


