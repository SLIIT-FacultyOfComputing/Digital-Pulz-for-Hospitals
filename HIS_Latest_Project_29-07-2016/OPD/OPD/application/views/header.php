<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="<?php echo base_url('/Bootstrap/css/css/style.css'); ?>" />
        <script type="text/javascript" src="<?= base_url('/Bootstrap/js/js/jquery.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('/Bootstrap/js/js/script.js'); ?>"></script>

        <!--**Stylesheet links -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/Bootstrap/css/bootstrap.css'); ?>" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/Bootstrap/css/bootstrap.min.css'); ?>" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/Bootstrap/css/style.css'); ?>" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/Bootstrap/css/font-awesome.min.css'); ?>" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/Bootstrap/css/datepicker.css'); ?>" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/Bootstrap/css/bootstrap-combobox.css'); ?>" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/Bootstrap/css/style1.css'); ?>" media="all"/>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/Bootstrap/css/livesearch.css'); ?>" media="all"/>

        <!--**Javascript links -->
<!--        <script src="--><?//= base_url('/Bootstrap/js/jquery-1.11.1.min.js'); ?><!--"></script>-->
        <script src="<?= base_url('/Bootstrap/js/jquery-1.9.1.min.js'); ?>"></script>
        <script src="<?= base_url('/Bootstrap/js/bootstrap.min.js'); ?>"></script>
        <script src="<?= base_url('/Bootstrap/js/bootstrap.js'); ?>"></script>
        <script src="<?= base_url('/Bootstrap/js/bootstrap-combobox.js'); ?>"></script>
<!--        <script src="--><?//= base_url('/Bootstrap/js/jquery-1.js'); ?><!--"></script>-->
        <script src="<?= base_url('/Bootstrap/js/jquery-ui.min.js'); ?>"></script>

        <!-- Custom JavaScript for the Menu Toggle -->
        <script>
            $('document').ready(function () {
                $('.combobox').combobox({bsVersion: '2'});
            });
        </script>


        <script type="text/javascript">

            $(document).ready(function () {


                // ***** waiting for barcode to be scanned  ******************
                var value = "";
                document.addEventListener('keypress', function (e) {

                    value += String.fromCharCode(e.which);
                    e.cancelBubble = true;
                    if (e.which == 13 & value.charAt(0) == '~' & value.charAt(1) == '|')
                    {
                        value = value.replace("~", "");
                        value = value.replace("|", "");

                        window.location = "../../operator_home_c/viewpatient/" + value;
                        value = "";
                    }
                }, true)
                ///*****************************************************

            });

        </script>

    </head>
    <body>

        <div id="wrapper">

            <!-- Sidebar -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: #FAFAFA; min-height:100px;">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">

                    <ul class="nav nav-pills" STYLE="position:absolute; TOP:50px; LEFT:126px;" >


                        <?php
                        if ($this->session->userdata("logged_in") == TRUE) {
                            ?>
                            <?php
                            if ($this->session->userdata("userlevel") == 1) { // doctor
                                ?>
                                <li><a href="<?php echo site_url("/doctor_home_c/view/1"); ?>">Home</a></li>     
                                <li><a href="<?php echo site_url("/questionnaire_c/add"); ?>">Preferences</a></li>
                                <li><a href="<?php echo site_url("/BNF_c/bnf"); ?>">View BNF</a>


                                    <?php
                                } else if ($this->session->userdata("userlevel") == 2) { // operator
                                    ?> 
                                <li><a href="<?php echo site_url("/operator_home_c/view/1"); ?>">Home</a></li>     
                                <li><a href="<?php echo site_url("/patient_c/add"); ?>">New Patient</a></li>   
                                <li><a href="<?php echo site_url("/patient_c/search"); ?>">Search</a></li>   
                                <li><a href="<?php echo site_url("/reports_c/view"); ?>">Reports</a></li>     
                            <?php }
                            ?>

                        <?php }
                        ?>


                    </ul>

                    <?php
                    if ($this->session->userdata("logged_in") == TRUE) {
                        ?>
                        <!--<ul class="nav pull-right" style="margin-right: 20px;">-->

                        <?php
                        if ($this->session->userdata("userlevel") == 1) { // doctor
                            ?>
                            <li class="divider-vertical"> </li>
                            <li>
                                <a href="<?php echo site_url("/doctor_home_c/view/5"); ?>" class="">
                                    <i class="icon icon-tasks"></i> <span class="text">Queue</span>
                                    <span class="label label-important">
                                        <?php
                                        $service_url = SERVICE_BASE_URL . "Queue/getQueuePatientsByUserID/" . $this->session->userdata("userid");
                                        $curl = curl_init($service_url);
                                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                        $curl_response = curl_exec($curl);
                                        curl_close($curl);
                                        $qp = json_decode($curl_response);

                                        if (isset($qp) && $qp != null)
                                            echo sizeof($qp);
                                        else
                                            echo "0";
                                        ?>
                                    </span> 
                                    <b class="caret"></b>
                                </a>
                            </li>
                            <?php
                        }
                        ?>

                        </ul>
                        <span class="text-info" STYLE="position:absolute; TOP:9px; left:135px;"><h4>SRI LANKA HEALTH INFORMATION SYSTEM</h4></span>
                        <!--logo-->
                        <IMG STYLE="position:absolute; TOP:2px; LEFT:2px; WIDTH:100px; HEIGHT:100px" SRC="<?php echo base_url('/application/images/HIS log.png'); ?>">
                        <span class="text"><?php echo date("Y-m-d")?></span>
                        <!-- User Image-->


                        <IMG STYLE="position:absolute; TOP:2px; right:150px; WIDTH:100px; HEIGHT:95px" SRC="<?php echo base_url('/application/images/doctor-Image.jpg'); ?>">
                        <!-- User Name-->
                        <span class="label label-primary" STYLE="position:absolute; TOP:20px; right:50px;">Hi <?php
                            $utype = $this->session->userdata("username");
                            echo $utype;
                            ?></span>
                        <!--sign out-->
                        <span class="control-label" STYLE="position:absolute; TOP:70px; right:50px;"><a href="<?php echo base_url() . 'index.php/' ?>login_c/logout">LogOut</a></span>

                        <a class="navbar-brand" href="#" style="color: #ffffff;"> </a>
<?php } ?>
                </div>
            </nav>
        </div>
