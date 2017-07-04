<!DOCTYPE html>
<html>
    <head>
        <title>HIS</title>
        <link href="../../../../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../../../../bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Add custom CSS here -->
        <link href="../../../../../bootstrap/css/style.css" rel="stylesheet">
        <link href="../../../../../bootstrap/css/font-awesome.min.css" rel="stylesheet">
        <link href="../../../../../bootstrap/css/bootstrap-combobox.css" rel="stylesheet">
        <link href="../../../../../bootstrap/css/jquery.dataTables.css" rel="stylesheet">
        <link href="../../../../../bootstrap/css/dataTables.tableTools.min.css" rel="stylesheet">
        <link href="../../../../../bootstrap/css/jquery-ui.css" rel="stylesheet">


        <!-- JavaScript -->
        <script src="../../../../../bootstrap/js/jquery-1.11.1.min.js"></script>
        <script src="../../../../../bootstrap/js/jquery-1.9.1.min.js"></script>
        <script src="../../../../../bootstrap/js/bootstrap.js"></script>
        <script src="../../../../../bootstrap/js/bootstrap-combobox.js"></script>

        <script src="../../../../../bootstrap/chartjs/jquery-1.8.2.min.js"></script>
        <script src="../../../../../bootstrap/chartjs/morris-0.4.1.min.js"></script>
        <script src="../../../../../bootstrap/chartjs/raphael-min.js"></script>

        <script src="../../../../../bootstrap/js/jquery.dataTables.min.js"></script>
        <script src="../../../../../bootstrap/js/dataTables.tableTools.min.js"></script>


        <!-- for jquery tab-->
        <script src="../../../../../bootstrap/js/jquery.js"></script>
        <script src="../../../../../bootstrap/js/jquery-ui.js"></script>



        <!-- Chart -->
        <!--        <link href="../../../bootstrap/css/bootstrap_Diabetic.css" rel="stylesheet">
                <link href="../../../bootstrap/css/sb-admin_Diabetic.css" rel="stylesheet">-->
        <!--        <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">-->


        <!-- Custom JavaScript for the Menu Toggle -->
        <script>
            $('document').ready(function(){
                $('.combobox').combobox({bsVersion: '2'});
            });
        </script>
        <style>
            section .required
            {
                color: #f00;
            }                        

        </style>

    </head>
    <body>
        <div id="wrapper">

            <!-- Sidebar -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: #FAFAFA; min-height:100px;">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">


                    <!-- Caption-->
                    <span class="text-info" STYLE="position:absolute; TOP:9px; left:135px;"><h4>SRI LANKA HEALTH INFORMATION SYSTEM</h4></span>
                    <!--logo-->
                    <IMG STYLE="position:absolute; TOP:2px; LEFT:2px; WIDTH:100px; HEIGHT:100px" SRC="../../../../../bootstrap/HIS log.png">

                    <?php if ($dischjType != "none") {
                        ?>
                        <IMG STYLE="position:absolute; TOP:3px; LEFT:830px; WIDTH:101px; HEIGHT:89px" SRC="../../../../../bootstrap/dischrge.jpg">
                        <?php
                    }
                    ?>
                    <span class="text-info" STYLE="position:absolute; TOP:1px; left:950px;"><h1>BED HEAD TICKET</h1></span>               

                    <span class="text-info" STYLE="position:absolute; TOP:59px; left:950px;"><h4>BHT No :<?php echo $bht_no; ?></h4></span>               

                    <span class="text-info" STYLE="position:absolute; TOP:59px; left:1175px;"><h4>Patient ID : <?php echo $patient_id; ?></h4></span>               
                    <a class="navbar-brand" href="#" style="color: #ffffff;"> </a>

                </div>



                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav" style="top:100px;">

                        <li style="color: darkblue; left: 50px; text-align:center"><h4><i class="text-primary"></i></h4></li>
                        <li ><a href="<?php echo base_url(); ?>index.php/inward/patientBHTC/BHT/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>"><i class="text-primary"></i>Patient Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/inward/PrescrptionC/index/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>"><i class="text-primary"></i>Prescription</a></li>
                        <?php if ($dischjType == "none") { ?>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>Laboratory Test<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url(); ?>index.php/lab/TestRequest/index/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>"><i class="text-primary"></i>View Test Results</a></li>
                                    <li><a href="<?php echo base_url(); ?>index.php/lab/NewTestRequest/index/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>"><i class="text-primary"></i>New Test Request</a></li>
                                </ul>

                            </li>
                        <?php } else { ?>
                            <li><a href="<?php echo base_url(); ?>index.php/lab/TestRequest/index/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>"><i class="text-primary"></i>View Test Results</a></li>
                        <?php } ?>
                        <?php if ($dischjType == "none") { ?>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>Patient Allergies<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url(); ?>index.php/inward/patientBHTC/AllergyView/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>"><i class="text-primary"></i>View Allergies</a></li>
                                    <li><a href="<?php echo base_url(); ?>index.php/inward/patientBHTC/NewAllergy/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>"><i class="text-primary"></i>Add New Allergy</a></li>
                                </ul>

                            </li>
                        <?php } else { ?>
                            <li><a href="<?php echo base_url(); ?>index.php/inward/patientBHTC/AllergyView/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>"><i class="text-primary"></i>View Allergies</a></li>
                        <?php } ?>

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>Charts<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url(); ?>index.php/inward/temperatureChartC/index/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>">Fever Chart </a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/inward/diabeticChartC/index/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>">Diabetic Chart</a></li>

                                <li><a href="<?php echo base_url(); ?>index.php/inward/liquidBalanceChartC/index/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>">Liquid Balance Chart</a></li>
                            </ul>
                        </li>
                        <?php if ($dischjType == "none") {
                            ?>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>Patient Transfer<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url(); ?>index.php/inward/patientBHTC/InternalTransfer/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>">Internal Transfer </a></li>
                                    <li><a href="<?php echo base_url(); ?>index.php/inward/patientBHTC/ExternalTransfer/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>">External Transfer</a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url(); ?>index.php/inward/liquidBalanceChartC/index/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>"></i>Discharge Patient</a></li>

                            <?php
                        }
                        ?>

                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
            <br/>
            <br/>
            <br/>