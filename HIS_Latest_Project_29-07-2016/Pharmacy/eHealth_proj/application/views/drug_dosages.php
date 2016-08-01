

        <title> </title>
<script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/';?>jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>common.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/';?>jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/';?>jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/';?>jquery.dataTables.columnFilter.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/';?>jquery.validate.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/Contents/cssnew/demo_table.css'); ?>" media="all"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/Contents/cssnew/jquery.dataTables.css'); ?>" media="all"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/Contents/cssnew/jquery.dataTables_themeroller.css'); ?>" media="all"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/Contents/cssnew/demo_table_jui.css'); ?>" media="all"/>
<link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/bootstrap.css'); ?>" media="all"/>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('/Bootstrap/css/sb-admin.css'); ?>" media="all"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/Bootstrap/font-awesome/css/font-awesome.min.css'); ?>" media="all"/>
  <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/';?>dosage.js"></script>

    </head>
    <body>
        <div id="wrapper" style="margin-left: 10px">
	<div id="header-wrapper">
            <?php $this->load->view('layout/header_pharmacy');?>
        </div>
	<div id="page">
<div id="content">
    <br/>
        <h3>Drug Dosages</h3>


<!--<p>

    <form id="frmFrequency" name="frmFrequency" >
        <div  id="fields" >
            <div align="left"> 
                <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <h4><input type="button" id="back" name="back" value="<< Back"/></h4>
            </div>
                    <input type="hidden" id="dosId" name="dosId"  /> 
                    <br/>
                    <b> <h4>Dosage :<h4> </b>  <input type="text" id="dosage" name="dosage"  /> <br/>
                    <b> <h4>Is Active :<h4> </b> 
                        <select type="text" id="recordStatus" name="recordStatus"  >  
                            <option value="1">Active</option>
                            <option value="0">In-Active</option>
                        </select>
                    <br/>
                        <input type="button" id="save" name="save" value="Save"/></div>
    </form>
   
</p>-->

<!-- dosage table -->
<div id="dosageDiv"  style="width:1000px">
    <div align="right"><h4><input type="button" id="addNew" class="btn btn-success" name="addNew" value="+ Add New Dosage"/></h4></div>
<div id="pait" ></div>
   <hr/>
   <div>
       <table align="center" id="dosageDataTable" class="table table-bordered table-hover table-striped tablesorter ">
             <thead>
                <tr>
                    <th>Dosage</th>
                    <th>Status</th>
                    <th>record_status</th>
                    <th>record_id</th>
                    <th>Action</th>
                </tr>
             </thead>
                                <tbody>

                                </tbody>
                            </table>
							</div>
							</div>
						<!-- dosage table -->	

							</div>
							</div>
							 <div id="sidebar">
                </div>
		</div>					
		</div>		
 <?php // $this->load->view('layout/Footer');?>		


    </body>
</html>