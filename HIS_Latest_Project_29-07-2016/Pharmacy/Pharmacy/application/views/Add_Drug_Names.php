<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<?php

  if(isset($result) && $result == 'true')
  {
    echo '<div class="alert alert-success fade" >
            <button type="button" class="close" data-dismiss="alert" id="x">×</button>
            <strong>Drug list Successfully added..</strong>
          </div>';
  }
  else if(isset($result) && $result == 'false')
  {
    echo '<div class="alert alert-danger fade" >
            <button type="button" class="close" data-dismiss="alert" id="x">×</button>
            <strong>Drug list addition failed..</strong>
          </div>';
  }
  else if(isset($result) && $result == 'no file')
  {
    echo '<div class="alert alert-danger fade">
            <button type="button" class="close" data-dismiss="alert" id="x">×</button>
            <strong>No file is select to Upload..</strong>
          </div>';
  }

  $array = [];
  if(isset($_POST['submit']))
  {


    $file = $_FILES['file']['tmp_name'];

    

    $handle = fopen($file, "r");
    

    while(($fileop = fgetcsv($handle,1000000,",")) !== false)
    {

        $drugname = $fileop[0];
        $drugremarks = $fileop[1];
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
        $arr = ["drugname" => $drugname, "drugremark" => $drugremarks, "drugcreatedate" => $drugcreatedate, "druglastupdatedate" => $druglastupdatedate,
        "druglastupdateuser" => $druglastupdateuser, "drugactive" => $drugactive, "drugunit" =>$drugunit, "drugcatid" => $drugcatid, "drugprice" => $drugprice, "drugqty" => $drugqty, "drugstatusreorder" => $drugstatusreorder, "drugstatusdanger" => $drugstatusdanger];

        $array[] = $arr;
    }

    foreach ($array as $key => $value) {
      
    }

  
    
  }
    
 ?>
 <script type="text/javascript">
   
   $(document).ready(function() {
      console.log(document.getElementById("file").files.length);
      if(document.getElementById("file").files.length === 0)
      {
          $('#submit').attr('disabled', true);
      }
      $('#file').change('click', function(){

        console.log(document.getElementById("file").files);
 
        if ($('#file').get(0).files.length > 0) {
          //console.log("No files selected.");
          $('#submit').attr('disabled', false);
        }
        else
        {
          $('#submit').attr('disabled', true); 
        }
      });

      $(".alert").removeClass("in").show();
      $ (".alert").delay(500).addClass("in").fadeOut(2010);

       $.ajax({
        url: baseUrl+'/index.php/Drug_Controller/getcatlist',
        type: 'POST',
        crossDomain: true,
        success: function(data) {
    
            data = trimData(data);
            var json_parsed = $.parseJSON(data);
           
            for (var i = 0; i < json_parsed.length; i++) {
        
                var newOption = $('<option id='+json_parsed[i]['dCategoryId']+'>');
                newOption.attr('value', json_parsed[i]['dCategoryId']).text(json_parsed[i]['dCategoryId'] +": " +json_parsed[i]['dCategory']);
                $('#categoryDropDownBC').append(newOption);
            }

        }


      });
       $.ajax({
        url: baseUrl+'/index.php/Frequency_Controller/getFreqFromDb',
        type: 'POST',
        crossDomain: true,
        success: function(data) {
    
            data = trimData(data);
            var json_parsed = $.parseJSON(data);
           
            for (var i = 0; i < json_parsed.length; i++) {
        
                var newOption = $('<option id='+json_parsed[i]['freqId']+'>');
                newOption.attr('value', json_parsed[i]['freqId']).text(json_parsed[i]['frequency']);
                $('#frequencyDropDownBC').append(newOption);
            }

        }
      });
       $.ajax({
        url: baseUrl+'/index.php/Dosage_Controller/getDosages',
        type: 'POST',
        crossDomain: true,
        success: function(data) {
    
            data = trimData(data);
            var json_parsed = $.parseJSON(data);
           
            for (var i = 0; i < json_parsed.length; i++) {
        
                var newOption = $('<option id='+json_parsed[i]['dosId']+'>');
                newOption.attr('value', json_parsed[i]['dosId']).text(json_parsed[i]['dosage']);
                $('#dosageDropDownBC').append(newOption);
            }

        }
      });

      $( "#addDosagesBtn" ).click(function() {
      $.ajax({
        url: baseUrl+'/index.php/Dosage_Controller/addDosage',
        type: 'POST',
        dataType: 'json',
        data: { "dosage" : $('#dosage').val()},
        success: function(data) {
            console.log("add dosage"+data);
            
           }

        });
       $('#dosage').val("");
      $.ajax({
            url: baseUrl+'/index.php/Dosage_Controller/getDosages',
            type: 'POST',
            crossDomain: true,
            success: function(data) {
              
                data = trimData(data);
                var json_parsed = $.parseJSON(data);
               
                $('#dosageDropDownBC').empty(); 
                for (var i = 0; i < json_parsed.length; i++) {
            
                    var newOption = $('<option id='+json_parsed[i]['dosId']+'>');
                    newOption.attr('value', json_parsed[i]['dosId']).text(json_parsed[i]['dosage']);
                    $('#dosageDropDownBC').append(newOption);
                }


            }
      });
    });


      $( "#addFrequencyBtn" ).click(function() {
      $.ajax({
        url: baseUrl+'/index.php/Frequency_Controller/addFrequency',
        type: 'POST',
        dataType: 'json',
        data: { "frequency" : $('#frequency').val()},
        success: function(data) {

        }

      });
      $('#frequency').val("");
      $.ajax({
        url: baseUrl+'/index.php/Frequency_Controller/getFreqFromDb',
        type: 'POST',
        crossDomain: true,
        success: function(data) {
      
            data = trimData(data);
            var json_parsed = $.parseJSON(data);
            $('#frequencyDropDownBC').empty(); 
            for (var i = 0; i < json_parsed.length; i++) {
        
                var newOption = $('<option id='+json_parsed[i]['freqId']+'>');
                newOption.attr('value', json_parsed[i]['freqId']).text(json_parsed[i]['frequency']);
                $('#frequencyDropDownBC').append(newOption);
            }

        }
    });

    });

    $("#dosageDropDownBC").change(function () {
        var dosageValue = $('#dosageDropDownBC option:selected').text();
        $('#dosageValue').val(dosageValue);
    });


    $("#frequencyDropDownBC").change(function () {
        var frequencyValue = $('#frequencyDropDownBC option:selected').text();
        $('#frequencyValue').val(frequencyValue);
    });



    $("#dtype").change(function () {
      
        if($('#dtype').val() == "Spray" || $('#dtype').val() == "Liquid" || $('#dtype').val() == "Drop")
        {
          $(".liquiddiv").attr("hidden", false);
          $("#liquidType").attr("required", true);
        }
        else
        {
          $(".liquiddiv").attr("hidden", true);
          $("#liquidType").attr("required", false);
        }
    });
   });


    

</script>
 

<section class="content">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Add Drug List</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>


            </div>


            <div class="box-body">
               <!-- <input type="hidden" name="MAX_FILE_SIZE" value="2000000" /> -->
                <form method="post" action="addDrug" enctype="multipart/form-data"  >
                                                

                  <input type="file" name="file" id="file"/>
                  <br />
                  <input class="btn btn-primary" type="submit" id="submit" name="submit" value="Submit" hidden>
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
          <div class="box">
           <div class="box-header with-border">
              <h3 class="box-title">Add Drugs Manually</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
              <br>
            <?php echo form_open('Drug_Controller/addIndividualDrugs', 'id="myform"'); ?>
            </div>
              <input type="text" name="dosageValue" id="dosageValue" hidden>
              <input type="text" name="frequencyValue" id="frequencyValue" hidden>
              <div class="box-body">
                <div class="form-group form-group-sm">
                      <label class="col-sm-4 control-label" for="sm">Drug Category</label>
                          <div class="col-sm-6">
                              <select class="form-control"  id="categoryDropDownBC" name="categoryDropDownBC">
                              </select>
                          </div>
                </div>
                <br/>
                <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label" for="sm">Drug Name</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="dname" name="dname" Required>
                    </div>
                </div>
                <br>
                 <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label" for="sm">Drug Type</label>
                        <div class="col-sm-3">
                            <!--<input type="text" class="form-control" id="dtype" name="dtype" >-->
                            <select class="form-control"  id="dtype" name="dtype">
                                <option value="" disabled="disabled" selected="selected">Please select a type</option>
                                <option value="AMP">AMP</option>
                                <option value="Tab">Tablet</option>
                                <option value="Cap">Capsule</option>
                                <option value="Spray">Spray</option>
                                <option value="Liquid">Liquid</option>
                                <option value="Drop">Drop</option>
                            </select>
                        </div>
                        <div class="liquiddiv col-sm-1" hidden>
                            <input type="text" id="liquidType" name="liquidType" Required>
                        </div>
                        <div class="liquiddiv col-sm-2" hidden>ml</div>
                 </div>
                <br>
                <div class="form-group form-group-sm">
                  <label class="col-sm-4 control-label" for="sm">Drug Price</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="dprice" name="dprice" Required>
                  </div>
                </div>
                <br>

                <div class="form-group form-group-sm">
                  <label class="col-sm-4 control-label" for="sm">Remarks</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="drem" name="drem" Required>
                  </div>
                </div>
                <br>
                <div class="form-group form-group-sm">
                  <label class="col-sm-4 control-label" for="sm">Danger Level</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="ddanger" name="ddanger" Required>
                  </div>
                </div>
                <br>

                <div class="form-group form-group-sm">
                  <label class="col-sm-4 control-label" for="sm">Reorder Level</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="dreorder" name="dreorder" Required>
                  </div>
                </div>
                <br>

               <!--  <div class="form-group form-group-sm">
                  <label class="col-sm-4 control-label" for="sm">Quantity</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="qty" name="qty">
                  </div>
                </div>
                <br> -->
                <div class="form-group form-group-sm">
                  <label class="col-sm-4 control-label" for="sm">Dosage</label>
                  <div class="col-sm-6">
                    <select class="form-control"  id="dosageDropDownBC" name="dosageDropDownBC"> </select>
                  </div>
                    <button type="button" id="addDosageBtn" class="btn btn-info glyphicon glyphicon-plus"
                    data-toggle="modal" data-target="#addDosageModel" data-backdrop="false"></button>

                    
                    
                </div>
                <div class="form-group form-group-sm">
                  <label class="col-sm-4 control-label" for="sm">Frequency</label>
                  <div class="col-sm-6">
                    <select class="form-control"  id="frequencyDropDownBC" name="frequencyDropDownBC"></select>
                    
                  </div>
                    <button type="button" id="addFreqBtn" class="btn btn-info glyphicon glyphicon-plus"
                    data-toggle="modal" data-target="#addFrequencyModel" data-backdrop="false"></button>
                </div>
                <br>
                <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label" for="sm"></label>
                        <div class="col-sm-6">
                          <input type="submit" id="btnUpAdd" class="btn btn-primary" value="Add Drug"></input>
                        </div>
                 </div>
                 <br>   
                

                 

              </div>



          </div>


              
           
        
        
</section>
<!-- /.content -->

<div id="addDosageModel" class="modal fade" role="dialog">
  <div class="modal-dialog">

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add Dosages</h4>
    </div>
    <div class="modal-body">
      <div class="form-group form-group-sm">
        <label class="col-sm-4 control-label" for="sm">Dosage :</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="dosage" name="dosage" placeholder="Eg: 1/2, 1 or 2">
        </div>
      </div>

      
    </div>
    <div class="modal-footer">
      <button type="button" id="addDosagesBtn" class="btn btn-primary" data-dismiss="modal">Add</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>

</div>
</div>

<div id="addFrequencyModel" class="modal fade" role="dialog">
  <div class="modal-dialog">

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add Frequencies</h4>
    </div>
    <div class="modal-body">
      <div class="form-group form-group-sm">
        <label class="col-sm-4 control-label" for="sm">Frequency :</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="frequency" name="frequency" placeholder="Eg: Once a Day">
        </div>
      </div>

      
    </div>
    <div class="modal-footer">
      <button type="button" id="addFrequencyBtn" class="btn btn-primary" data-dismiss="modal">Add</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>

</div>
</div> 
 
    

    



