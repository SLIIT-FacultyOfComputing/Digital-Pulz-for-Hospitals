<?php if($this->session->userdata('userRoleName')=="Chief Pharmacist" ){ ?>
    <div id="menu">
                        <ul class="sf-menu dropdown">
                            <li><a href="<?php echo base_url('/index.php/Report_Controller/report'); ?>">Home</a></li>
                            <li><a class="has_submenu" href="#">Requests</a>
                                <ul>
                                    <li><a href="<?php echo base_url('/index.php/Request_Controller/addRequestDrug'); ?>">Send Request</a></li>
                                    <li><a href="<?php echo base_url('/index.php/Request_Controller/requestDrugsView'); ?>">View Request</a></li>
                                </ul>
                            </li>
                            <li><a class="has_submenu" href="#">Drugs</a>
                                <ul>
                                    <li><a href="<?php echo base_url('/index.php/Drug_Controller'); ?>">Update Drug</a></li>
                                    <li><a href="<?php echo base_url('/index.php/Drug_Controller/drugNameview'); ?>">Add Drug Names</a></li>
                                    <li><a href="<?php echo base_url('/index.php/Batch_Controller'); ?>">Add Batch</a></li>
                                    <li><a href="<?php echo base_url('/index.php/Prescribe_Controller'); ?>">Dispense Drug</a></li>
                                    <li><a href="<?php echo base_url('/index.php/Drug_Controller/drugInformationview'); ?>">Drug Information</a></li>
                                    <li><a href="<?php echo base_url('/index.php/Dosage_Controller'); ?>">Drug Dosage</a></li>
                                    <li><a href="<?php echo base_url('/index.php/Frequency_Controller/frequencyMgr'); ?>">Drug Frequency</a></li>
                                </ul>
                            </li>
                            <li><a class="has_submenu" href="#">Reports</a>
                                <ul>
                                    <li><a href="<?php echo base_url('/index.php/Report_Controller'); ?>">Drug Report</a></li>
                                    <li><a href="<?php echo base_url('/index.php/Dispense_Drug_Reports'); ?>">Dispense Log</a></li>
                                    <li><a href="<?php echo base_url('/index.php/Report_Controller/report'); ?>">Low Drug Report</a></li>
                                </ul>
                            </li>
                            
                            <li><a href="<?php echo base_url(); ?>">Logout</a></li>
                        </ul>
                    </div>
<?php } else if($this->session->userdata('userRoleName')=="Assistant Pharmacist") {?>
<div id="menu">
                        <ul class="sf-menu dropdown">
                            <li><a href="<?php echo base_url('/index.php/Prescribe_Controller'); ?>">Home</a></li>
                            <li><a class="has_submenu" href="#">Requests</a>
                                <ul>
                                    <li><a href="<?php echo base_url('/index.php/Request_Controller/addRequestDrug'); ?>">Send Request</a></li>
                                </ul>
                            </li>
                            <li><a class="has_submenu" href="#">Drugs</a>
                                <ul>
                                    <li><a href="<?php echo base_url('/index.php/Prescribe_Controller'); ?>">Dispense Drug</a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url(); ?>">Logout</a></li>
                        </ul>
                    </div>
<?php } ?>