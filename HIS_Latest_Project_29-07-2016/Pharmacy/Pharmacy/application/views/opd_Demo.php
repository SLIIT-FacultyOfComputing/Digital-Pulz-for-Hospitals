<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>OPD Demo</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/Bootstrap/css/bootstrap.css'); ?>" media="all"/>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('/Bootstrap/css/sb-admin.css'); ?>" media="all"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/Bootstrap/font-awesome/css/font-awesome.min.css'); ?>" media="all"/>

<script type="text/javascript" src="<?php echo base_url() . 'Bootstrap/js/'; ?>bootstrap.js"></script>

</head>

<body onload="getCategoryListDC()">
    <div id="wrapper" style="margin-left: 10px">
        <div id="header-wrapper">
            <?php $this->load->view('layout/opd_header'); ?>
        </div>
        <div id="page">
            
            <div id="content" style="margin-left: 50px">
                
          
            </div>	
        </div>  
    </div>

                                        
</body>
</html>