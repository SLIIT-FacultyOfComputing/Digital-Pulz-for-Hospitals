 <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url(); ?>css/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>Alexander Pierce</p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            
            <li class="treeview">
              <a href="<?php echo base_url(); ?>index.php/inward/wardAdmissionC/index">
                </i> <span>Ward Admission</span> 
              </a>    
            </li>

            <li class="treeview">
              <a href="<?php echo base_url(); ?>index.php/inward/wardAdmissionC/newAdmission"><i class="text-primary">
                </i> <span>New Admission</span>
              </a>    
            </li>
           
            <li class="treeview">
              <a href="<?php echo base_url(); ?>index.php/inward/transferAdmissionC/index"><i class="text-primary">
                </i> <span>Transfer Admission</span>
               <?php if ($count != 0) { ?>
                                    <span  class="badge pull-right"><?php echo $count; ?></span>
                                <?php } ?>
              </a>    
            </li>

            <?php if ($_SESSION['RoleId'] != '4') { ?>
             <li class="treeview">
              <a href="<?php echo base_url(); ?>index.php/inward/patientBHTC/index"><i class="text-primary">
                </i> <span>Patient BHT</span>
              </a>    
            </li>
            <?php } ?>

            <?php if ($_SESSION['RoleId'] == '2') { ?>
                 <li class="treeview">
              <a href="<?php echo base_url(); ?>index.php/inward/wardManageC/index"><i class="text-primary"><i class="text-primary">
                </i> <span>Ward Manage</span>
              </a>    
            </li>           
            <?php } ?>
                                     
        <?php
                            if (sizeof($mywards != null)) {
                                ?>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>My Wards<b class="caret"></b></a>
                                    <ul class="dropdown-menu">

                                        <?php
                                        foreach ($mywards as $value) {
                                            ?>

                                            <li><a href="<?php echo base_url(); ?>index.php/inward/MyWardsC/index/<?php echo $value->wardNo; ?>"><?php echo $value->wardNo; ?></a></li>


                                            <?php
                                        }
                                        ?>

                                    </ul>
                                </li>
                                <?php
                            }
                            ?>
           
            
            
            
            
                  
            
        </section>
        <!-- /.sidebar -->
      </aside>
 <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">