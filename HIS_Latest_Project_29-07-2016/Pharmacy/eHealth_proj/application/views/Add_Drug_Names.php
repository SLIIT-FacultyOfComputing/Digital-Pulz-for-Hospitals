<?php 

  /*$conn = mysql_connect("localhost","his","") or die(mysql_error());

  mysql_select_db("HIS",$conn);

  if(isset($_POST['submit']))
  {
    $file = $_FILES['file']['temp_drug'];
    $handle = fopen($file, "r");

  }s
*/

 $conn = mysqli_connect("localhost","root","");
      mysqli_select_db($conn,"HIS");

      if(isset($_POST['submit']))
      {


        $file = $_FILES['file']['tmp_name'];

        

        $handle = fopen($file, "r");
        

        while(($fileop = fgetcsv($handle,1000000,",")) !== false)
        {

            $drugname = $fileop[0];
            $drugremaks = $fileop[1];
            $drugcreatedate = $fileop[2];
            $drugcreateuser= $fileop[3];
            $druglastupdatedate = $fileop[4];
            $druglastupdateuser = $fileop[5];
            $drugactive = $fileop[6];
            $drugunit = $fileop[7];
            $drugcatid = $fileop[8];
            $drugprice = $fileop[9];
            $drugqty = $fileop[10];
            $drugstatusreorder = $fileop[11];
            $drugstatusdanger = $fileop[12];

            /*$lname = $fileop[1];
            $email = $fileop[2];*/
          //echo $fileop;


            $sql = mysqli_query($conn,"INSERT INTO pharm_drug (drug_name,drug_remarks,drug_create_date,drug_create_user,drug_lastupdate_date,drug_lastupdate_user,drug_active,drug_unit,drug_categoryid,drug_price,drug_quantity,drug_statusreorder,drug_statusdanger)
             VALUES ('$drugname' , '$drugremaks' , '$drugcreatedate' , '$drugcreateuser' , '$druglastupdatedate' , '$druglastupdateuser' , '$drugactive' , '$drugunit' , '$drugcatid' , '$drugprice' , '$drugqty' , '$drugstatusreorder' , 'drugstatusdanger')");
              }

              
             if ($sql) {
             echo "
             <div class = 'row'>
              <div class='col-lg-12 col-centered' style='padding-left: 50px'>
             <div class='alert alert-success' style='padding-right:40px ; width:95%'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong>Successfull ! </strong> File attached successfully
          </div>
          </div>
          </div>
          ";
            }

             
          

        
        
      }
 ?>
<section class="content">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Add Drugs</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
               <!-- <input type="hidden" name="MAX_FILE_SIZE" value="2000000" /> -->
                                            <form method="post" action="drugNameview" enctype="multipart/form-data"  >
                                                

                                                <input type="file"  name="file" />
                                                 <br />
                                                 <input type="submit"  name="submit" value="Submit">

                                                  <!--   <table width="450">
                                                        <tr>
                                                        <td>Names file:</td>
                                                        <td><input type="file"  name="file"></input></td>
                                                        <td><input class='btn btn-primary btn-md' type="submit" value="Upload" /></td>
                                                        </tr> 
                                          
                                                    </table> -->
                                            </form> 
            </div><!-- /.box-body -->
          </div><!-- /.box -->
</section><!-- /.content -->
            
                
                
    

    



