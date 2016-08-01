<!--
<html>
    <head>
        <title> Drug Dispense Report</title>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/';?>jquery-1.9.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>common.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/';?>jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/';?>jqueryui.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/';?>jquery.dataTables.columnFilter.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/';?>jquery.validate.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/Contents/cssnew/demo_table.css'); ?>" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/Contents/cssnew/jquery.dataTables.css'); ?>" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/Contents/cssnew/jquery.dataTables_themeroller.css'); ?>" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/Contents/cssnew/demo_table_jui.css'); ?>" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/Bootstrap/css/bootstrap.min.css'); ?>" media="all"/>
          <link rel="stylesheet" type="text/css" href="<?php echo base_url('/Contents/cssnew/ehealth.css'); ?>" media="all"/>
           <link rel="stylesheet" type="text/css" href="<?php echo base_url('/Contents/cssnew/jquery-ui.css'); ?>" media="all"/>
  

    </head>-->
<body style="margin-top: 75px">
        <div id="wrapper">
            <div id="header-wrapper">
                
                <div id="page">
                    <div id="content">
                        <h3>Drug Dispense Report</h3>
                            Date: <input type="date" id="datepicker" name="datepicker" />
                            <input type="button" id="btnReportView" name="btnReportView" value="View Report" />
                            <input type="button" id="create_pdf" name="create_pdf" value="Create PDF" />
                         
                        <div id="view_report"></div>

                        <iframe id="view__pdf_report" hidden="true"></iframe>
                       

                    </div>
                </div>
                <div id="sidebar">
                </div>
            </div>					
        </div>		
        	


    </body>
</html>