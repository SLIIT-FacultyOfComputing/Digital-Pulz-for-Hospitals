<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <title></title>

        <link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/bootstrap.css'); ?>" media="all"/>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('/Bootstrap/css/sb-admin.css'); ?>" media="all"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/Bootstrap/font-awesome/css/font-awesome.min.css'); ?>" media="all"/>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>common.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jq_pharmacy.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Bootstrap/js/'; ?>bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jqPharmacyDC.js"></script>
</head>

    <body onload="getDrugDetailsToViewDC()">
<div id="wrapper">
            <div id="header-wrapper">
                                <?php $this->load->view('layout/header_pharmacy');?>               
                <div id="page">
                    <div id="content">
                        <div class="post">
                            <h3 class="title"><a href="#">Drugs need to be Ordered</a></h3>
                            <br/>
                            <img id="imgid" style="visibility: hidden;" src="<?php echo base_url('/Contents/images/Loading.gif'); ?>" width="30" height="30"/>
                            <p style="color: red">Quantity less than Danger Level</p>
                            <p style="color: orange">Quantity less than ReOrder Level</p>
                            <form name="getcvs" action="../Report_Controller/report_pdfB" method="post">
            
            <div>
                <input type="submit" name="submitpdf" value="download pdf file" align="center"/>
            </div>
            <p id="tablespaceDC" name="tablespaceDC"></p>
        </form>
                            
                            <div class="entry">
                            </div>
                        </div>
                    </div>	
                </div>
                <div id="sidebar">
                </div>
            </div>
        </div>
            

</body>
</html>
