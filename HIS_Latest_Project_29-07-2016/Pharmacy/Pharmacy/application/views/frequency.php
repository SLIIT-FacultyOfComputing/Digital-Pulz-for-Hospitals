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

       <link rel="stylesheet" type="text/css" href="<?php  echo base_url('/Bootstrap/css/bootstrap.css'); ?>" media="all"/>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('/Bootstrap/css/sb-admin.css'); ?>" media="all"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/Bootstrap/font-awesome/css/font-awesome.min.css'); ?>" media="all"/>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>common.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jqPharmacyRC.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jqPharmacyDC.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jqPharmacyBC.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>jqPharmacyUC.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Scripts/JS/'; ?>validation.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'Bootstrap/js/'; ?>bootstrap.js"></script>

    </head>

    <body onload="getCategoryListDC()">
        <div id="wrapper" style="margin-left: 10px; margin-right: 17px">
            <div id="header-wrapper">
                <?php $this->load->view('layout/header_pharmacy');?>
            </div>
                <div id="page">
                    <div id="content">
                        <div class="post" >
                       <?php
        //==========================================
        $dusr = new Frequency_Controller();
        $details = $dusr->getFreqFromDb();
        //echo $frqPcs[1];
        //==========================================
        ?>
                     <br/>
                     <br/>
                     <br/>    
                    
                   
                            
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Drug Frequency Manager</h3>
                                </div>
                                <div class="panel-body">
                                  <form action='http://localhost/Pharmacy/index.php/Frequency_Controller/updateFreq' method='post'>
            <div>
            <table class="table table-bordered table-hover table-striped tablesorter ">
                <thead>
                    <tr>
                        <th>Frequency Id</th>
                        <th>Drug Frequency</th>
                        <th>Update</th>
                    </tr>


                </thead>
                <?php
                $s=0;
                //echo $details;
                foreach ($details as $key=>$value) {
                    //$frqPcs = explode(":", $details[$s]);
                    $frqPcs = $value;
                    //echo json_encode($value);
                ?>
                    <tr>
                        <td><?php echo $frqPcs->freqId; ?></td>
                        <td align="middle"><input type="text" name="drug_freq_<?php echo $s; ?>" id="drug_freq_<?php echo $s; ?>" value="<?php echo $frqPcs->frequency; ?>" style="text-align:center">
                            <input type="hidden" name="drug_freqId" id="drug_freq_Id" value="<?php echo $frqPcs->frequency; ?>" style="text-align:center">
                            <input type="hidden" name="loop" id="drug_freq_Id" value="<?php echo$s; ?>" style="text-align:center">
                            <input type="hidden" name="id_<?php echo $s; ?>" id="id<?php echo $s; ?>" value="<?php echo $frqPcs->freqId; ?>" style="text-align:center">
                        </td>

                        <td align="middle">
<!--                            <input name="but" id="but" type="submit" value="<?php echo$s; ?>" style='width:100px '/>-->
                            <button type='submit' name='but' id='but' value="<?php echo$s; ?>" style='width:100px'>Update</button>
                        </td>
                    </tr>

<?php $s++;} ?>

            </table>
        </form>
                                </div>
                            </div>
                            
                            
        
        
                            
         <br/><br/>  
         
         
         <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title">Add New Frequency</h3>
              </div>
              <div class="panel-body">
                <form action='http://localhost/Pharmacy/index.php/Frequency_Controller/addFrequency' method='post'>
         <table class="table1">
                <thead>
                    <tr>
                        <th>Drug Frequency </th>
                        <th>Action</th>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td align="middle"><input type="text" class="form-control" name="add_freq_db" id="add_freq_db" value="" style="text-align:center"/> </td>
                        <td align="center" style="margin-left: 20px"><input name="add" class="form-control" id="add" type="submit" value="Add Freqency"/></td>
                    </tr>
                </thead>
         </table>
        </form>
              </div>
            </div>
         
        
     

                    </div>
                    </div>
                </div>
                <div id="sidebar">
                </div>
            </div>
        
        <?php // $this->load->view('layout/Footer');?>
    </body>
</html>