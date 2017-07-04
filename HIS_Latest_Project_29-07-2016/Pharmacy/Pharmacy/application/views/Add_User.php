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

        <title></title>

        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/Bootstrap/css/bootstrap.css'); ?>" media="all"/>

        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jq_pharmacy.js"></script>
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
                <?php $this->load->view('layout/header_pharmacy');?>
                <div id="page" style="margin-left: 155px">
                    <div id="content">
                        <div class="post" id="post_drugOption_tbl">
                            <h2 class="title"><a href="#">Add Pharmacist</a></h2>
                            <div class="entry">
                                Title :  <select style="margin-left: 90px" id=titleDropDown name=titleDropDown >
                                    <option  selected=selected>Mr</option>
                                    <option  selected=selected>Mrs</option>
                                    <option  selected=selected>Miss</option>
                                </select>
                                <br></br>
                               First Name : <input style="margin-left: 49px" type="text" name="firstNameValue" id="firstNameValue" onkeyup="validateField(this.value,'fnameerror')"/><span id="fnameerror"></span>

                                <br></br>
                               Last Name : <input style="margin-left: 49px" type="text" name="lastNameValue" id="lastNameValue" onkeyup="validateField(this.value,'lnameerror')"/><span id="lnameerror"></span>

                                <br></br>
                               NIC : <input style="margin-left: 95px" type="text" name="nicValue" id="nicValue" value="892694320V" onkeyup="validateNIC(this.value,'nicerror')"/><span id="nicerror"></span>
                                <br></br>
                                Date Of Birth : <input style="margin-left: 35px" type="text" name="dobValue" id="dobValue" value="" onkeyup="validateDate(this.value,'doberror')"/><span id="doberror"></span>
                                <br></br>
                                civil Status :  <select style="margin-left: 50px" id=civilStatusDropDown name=civilStatusDropDown >
                                    <option  selected=selected>Single</option>
                                    <option  selected=selected>Married</option>
                                </select>
                                <br></br>
                                Gender :  <select style="margin-left: 69px" id=genderDropDown name=genderDropDown >
                                    <option  selected=selected>Male</option>
                                    <option  selected=selected>Female</option>
                                </select>
                                <br></br>
                                User Group :  <select style="margin-left: 45px" id=userGroupDropDown name=userGroupDropDown >
                                    <option  selected=selected>Chief Pharmacist</option>
                                    <option  selected=selected>Assistant Pharmacist</option>
                                </select>
                                <br></br>
                                User Department :  <select style="margin-left: 11px" id=userDepDropDown name=userDepDropDown >
                                    <option  selected=selected>Clinic Pharmacy</option>
                                    <option  selected=selected>IPD Pharmacy</option>
                                    <option  selected=selected>LAB Pharmacy</option>
                                    <option  selected=selected>OPD Pharmacy</option>
                                </select>
                                <br></br>
                               UserName : <input style="margin-left: 52px" type="text" name="userNameValue" id="userNameValue" value="" onkeyup="validateField(this.value,'usererror')"/><span id="usererror"></span>

                                <br></br>
                                Password : <input style="margin-left: 54px" type="password" name="passwordValue" id="passwordValue" value="" onkeyup="validatePassword(this.value,'passerror')"/><span id="passerror"></span>
                                <br></br>
                               Street : <input style="margin-left: 78px" type="text" name="streetValue" id="streetValue" onkeyup="validateField(this.value,'streeterror')"/><span id="streeterror"></span>
                                <br></br>
                               Division : <input style="margin-left: 66px" type="text" name="divisionValue" id="divisionValue" onkeyup="validateField(this.value,'diverror')"/><span id="diverror"></span>
                                <br></br>
                               District : <input style="margin-left: 72px" type="text" name="districtValue" id="districtValue" onkeyup="validateField(this.value,'diserror')"/><span id="diserror"></span>
                                <br></br>
                                <input type="submit" value="Add pharmacist" onclick="addPharmacist()"/>
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
