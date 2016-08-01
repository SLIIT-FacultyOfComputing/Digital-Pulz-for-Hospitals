<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Get Prescription Form</title>

<style type = "text/css">
		
	form li{
		list-style:none;
	}	
	
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/Contents/cssnew/ehealth.css'); ?>" media="all"/>

        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>common.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jq_pharmacy.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jqPharmacyRC.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jqPharmacyDC.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jqPharmacyBC.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jqPharmacyUC.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>validation.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Bootstrap/js/'; ?>bootstrap.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/demo_table.css'); ?>" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/jquery.dataTables.css'); ?>" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/jquery.dataTables_themeroller.css'); ?>" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/demo_table_jui.css'); ?>" media="all"/>


<script type="text/javascript">
function json()
{
			
			window.location.href = "<?php echo site_url('batch_controller/loadDrug'); ?>";
			
}
</script>


<script type="text/javascript">

</script>
</head>
<body>
<div id="wrapper">
            <div id="header-wrapper">
                  <?php $this->load->view('layout/Header');?>

                <div id="page">
                    <div id="content">
                        <div class="post">
                            <h2 class="title"><a href="#">Get Patients Prescription </a></h2>
                            <br/>

                            <div class="entry">

<?php 

$attributes = array(
		'id' => 'myform'
		);

echo form_open('prescribe_controller/load_prescription' , $attributes);

        $pid = array(
		'name' => 'pid',
		'id' => 'pid',
		'value' => set_value('pid'),
                'onkeyup' => "validatePid(this.value,'piderror')"
	);
        


?>



<ul>	

         <li>
	<label>Enter Patient ID </label>
	<div>
		<?php echo form_input($pid);?>
                <p><span id="piderror"></span></p>
	</div>
	</li>
	<br/>
	
	<li>
	<div>
		<?php  echo form_submit('add', 'Get Prescription'); ?>
	</div>
	</li>
	<br/>
	

	
</ul>

<?php echo form_close(); ?>
                            </div>
                        </div>
                        
                        
                        
                    </div>	
                </div>
                <div id="sidebar">
                </div>
            </div>
        </div>

                <?php $this->load->view('layout/Footer');?>

</body>
</html>
