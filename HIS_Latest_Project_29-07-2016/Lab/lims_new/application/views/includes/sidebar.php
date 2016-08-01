<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
	  <!-- Sidebar user panel -->
	  <div class="user-panel">
		<div class="pull-left image">
		  <img src="<?php echo base_url('assets'); ?>/img/avatar5.png" class="img-circle" alt="User Image" />
		</div>
		<div class="pull-left info">
		  <p>
              <?php
              $name = $this->session->userdata('userfullname');
              if(isset($name) && !empty($name)){
                  echo ($name);
              } else {
                  echo ('HIS');
              }
              ?>
          </p>

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
        <li>
          <a href="<?php echo base_url(); ?>test_request">
            <i class="fa fa-calendar"></i> <span>Lab Orders</span>
          </a>
        </li>
        <li>
          <!-- <a href="<?php echo base_url(); ?>new_test_controller">
              <i class="fa fa-plus"></i> <span>New Lab Test</span>
          </a> -->
          <a href="<?php echo base_url(); ?>mri_test_fields">
              <i class="fa fa-plus"></i> <span>New Lab Test</span>
          </a>
        </li>
        <li>
          <a href="#">
              <i class="fa fa-edit"></i> <span>Option Manager</span>
              <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
              <li><a href="<?php echo base_url(); ?>lab_test_manager"><i class="fa fa-circle-o"></i> Lab Test Manager</a></li>
              <li><a href="<?php echo base_url(); ?>lab_manager"><i class="fa fa-circle-o"></i> Laboratory Manager</a></li>
              <li><a href="<?php echo base_url(); ?>sample_centre_manager"><i class="fa fa-circle-o"></i> Sample Center Manager</a></li>
          </ul>
        </li>
	  </ul>
	</section>
	<!-- /.sidebar -->
</aside>
