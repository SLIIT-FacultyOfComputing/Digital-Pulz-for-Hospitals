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
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <title></title>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/Contents/cssnew/ehealth.css'); ?>" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/Contents/cssnew/animate.css'); ?>" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/Contents/cssnew/reset.css'); ?>" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/Contents/cssnew/styles.css'); ?>" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/Bootstrap/css/bootstrap.css'); ?>" media="all"/>

        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>common.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jqPharmacyRC.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jqPharmacyDC.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jqPharmacyBC.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jqPharmacyUC.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>validation.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Bootstrap/js/'; ?>bootstrap.js"></script>

    </head>
    <body>
        <div id="wrapper">
            <div id="header-wrapper">
                <?php $this->load->view('layout/LoginHeader');?>
                <div id="page">
                    <div id="content">
                        <div class="post" id="post_login" >
                            <div class="entry">
                                <div id="container" style="height: 220px">
                                    <label for="name">Sign in</label>
                                    
                                <input type="name" name="userNameValue" id="userNameValue" placeholder="Enter user name" onkeyup="validateField(this.value,'usererror')"/><span id="usererror"></span>
                                
                                <input type="password" name="passwordValue" id="passwordValue"  placeholder="Enter password" onkeyup="validateField(this.value,'passerror')"/><span id="passerror"></span>                               
                               <!--<div id="lower">-->
                               <input type="submit" value="Login" onclick="userLogin()"/>
                               <img id="imgid" style="visibility: hidden;" src="<?php echo base_url('/Contents/images/Loading.gif'); ?>" width="30" height="30"/>
                               
                                <!--</div>-->
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
