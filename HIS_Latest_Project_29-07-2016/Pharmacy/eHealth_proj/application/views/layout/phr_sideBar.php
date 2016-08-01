<!--
<style>
   

ul#nav li.active a { color: #f4ba51 ; }


    
</style>-->

 <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul id="nav" class="nav navbar-nav side-nav " style="top:100px;">

                    <li ><a href="<?php echo base_url('/index.php/Report_Controller/report'); ?>"><i class="text-primary"></i>Home</a></li>
                    <li ><a href="<?php echo base_url('/index.php/Drug_Controller/drugNameview'); ?>"><i class="text-primary"></i>Add Drugs</a></li>
                    <!--<li><a href="<?php // echo base_url('/index.php/Prescribe_Controller'); ?>"><i class="text-primary"></i>Dispense Drugs</a></li>-->
                    <li><a href="<?php echo base_url('/index.php/Drug_Controller'); ?>"><i class="text-primary"></i>Update Drugs</a></li>
                    <li><a href="<?php echo base_url('/index.php/Batch_Controller'); ?>"><i class="text-primary"></i>Add New Batch</a></li>
                    <!--<li><a href="<?php echo base_url('/index.php/Dosage_Controller'); ?>"><i class="text-primary"></i>Drug dosage</a></li>-->
                    <!--<li><a href="<?php echo base_url('/index.php/Frequency_Controller/frequencyMgr'); ?>"><i class="text-primary"></i>Drug frequency</a></li>-->
                    
                    
                    
                    <!--<li><a href="<?php // echo base_url('/index.php/Request_Controller/addRequestDrug'); ?>"><i class="text-primary"></i>Send Requests</a></li>-->
                    <li><a href="<?php echo base_url('/index.php/Request_Controller/requestDrugsView'); ?>"><i class="text-primary"></i>View Requests</a></li>
                    <li><a href="<?php echo base_url('/index.php/Drug_Controller/drugInformationview'); ?>"><i class="text-primary"></i>Drug Information</a></li>
                    
                    
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Reports </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('/index.php/Report_Controller'); ?>">Drugs to be expired</a></li>
                            <!--<li><a href="<?php echo base_url('/index.php/Dispense_Drug_Reports'); ?>">Dispense log</a></li>-->
                            
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>