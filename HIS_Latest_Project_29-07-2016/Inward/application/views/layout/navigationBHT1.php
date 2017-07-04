 <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
     
            
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
           
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">Patient BHT Options</li>

            <li class="treeview">
              <a href="<?php echo base_url(); ?>index.php/inward/patientBHTC/BHT/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>">
                </i> <span>Patient Profile</span> 
              </a>    
            </li>

            <li class="treeview">
              <a href="<?php echo base_url(); ?>index.php/inward/PrescrptionC/index/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>">
                </i> <span>Prescription</span>
              </a>    
            </li>

          <?php if ($dischjType == "none") { ?>
           <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Laboratory Test</span> </i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>index.php/lab/TestRequest/index/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>"></i> View Test Results</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/lab/NewTestRequest/index/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>"><i class="text-primary"></i> New Test Request</a></li>
              </ul>
            </li>
            <?php } else { ?>
            <li><a href="<?php echo base_url(); ?>index.php/lab/TestRequest/index/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>"></i> View Test Results</a></li>
            <?php } ?>

            <?php if ($dischjType == "none") { ?>
              <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Patient Allergies</span> </i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>index.php/inward/patientBHTC/AllergyView/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>"><i class="text-primary"></i> View Allergies</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/inward/patientBHTC/NewAllergy/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>"><i class="text-primary"></i> Add New Allergy</a></li>
              </ul>
            </li>
                        
                 <?php } else { ?>
                             <li><a href="<?php echo base_url(); ?>index.php/inward/patientBHTC/AllergyView/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>"><i class="text-primary"></i> View Allergies</a></li>
                 <?php } ?>      
           
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Charts</span> </i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>index.php/inward/temperatureChartC/index/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>"></i> Fever Chart</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/inward/diabeticChartC/index/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>"></i> Diabetic Chart</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/inward/liquidBalanceChartC/index/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>"></i>Liquid Balance Chart</a></li>
              
              </ul>
            </li>
        
            <?php if ($dischjType == "none") { ?>
              <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Patient Transfer</span> </i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>index.php/inward/patientBHTC/InternalTransfer/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>">Internal Transfer</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/inward/patientBHTC/ExternalTransfer/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>">External Transfer</a></li>
              </ul>
            </li>
                     
            <?php } ?>
                 
            <li><a href="<?php echo base_url(); ?>index.php/inward/patientBHTC/DischarjView/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>"><i class="text-primary"></i>Discharge Patient</a></li>
                             
<!--            <li><a href="<?php echo base_url(); ?>index.php/inward/patientBHTC/AddDiets/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>"><i class="text-primary"></i>Patient Diets</a></li>
                 -->
            
            <?php if ($dischjType == "none") { ?>
              <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Patient Diets</span> </i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>index.php/inward/patientBHTC/AddDiets/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>"><i class="text-primary"></i>Patient Diets</a></li>
                
                <li><a href="<?php echo base_url(); ?>index.php/inward/patientBHTC/ViewDiets/<?php echo $bht_no; ?>/<?php echo $patient_id; ?>"><i class="text-primary"></i> View patient Diets</a></li>
              </ul>
            </li>
                        
                 <?php } else { ?>
                            
                  <?php } ?>     
            
            
            
            
        </section>
        <!-- /.sidebar -->
      </aside>
 <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="modal-example">

            