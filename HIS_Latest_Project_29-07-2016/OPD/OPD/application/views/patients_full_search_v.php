<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<script type="text/javascript">

    $(document).ready(function() {

        // Custom pagintation ;)  *************************************************************************************
        // first page load
        var $table = $('#testp');

        var currentPage = 0;
        var numPerPage = 15;
        var numRows = $table.find('tbody tr').length;
        var numPages = Math.ceil(numRows / numPerPage);
        $('#pageid').val(currentPage + 1);
        $('#pgcount').text(' Of ' + numPages);
        $table.find('tbody tr').hide().slice(0, numPerPage).show();

        //************************************************************
        // then
        $('#pageid').change(function() {

            var start = ((parseInt($('#pageid').val()) - 1) * numPerPage);

            // first one
            if (parseInt($('#pageid').val()) == 1)
                start = 0;

            var end = ($('#pageid').val() * numPerPage);

            $table.find('tbody tr').hide().slice(start, end).show();

        });

        $('#recsperpage').change(function() {
            numPerPage = $('#recsperpage').val();
            var currentPage = 0;
            var numRows = $table.find('tbody tr').length;
            var numPages = Math.ceil(numRows / numPerPage);
            $('#pageid').val(currentPage + 1);
            $('#pgcount').text(' Of ' + numPages);
            $table.find('tbody tr').hide().slice(0, numPerPage).show();

            var start = ((parseInt($('#pageid').val()) - 1) * numPerPage);

            // first one
            if (parseInt($('#pageid').val()) == 1)
                start = 0;


            var end = ($('#pageid').val() * numPerPage);

            $table.find('tbody tr').hide().slice(start, end).show();

        });

        $('#lnkprev').click(function() {
            if (parseInt($('#pageid').val()) != 1)
            {
                $('#pageid').val(parseInt($('#pageid').val()) - 1);
                numPerPage = parseInt($('#recsperpage').val());
                currentPage = parseInt($('#pageid').val());
                numRows = $table.find('tbody tr').length;
                numPages = Math.ceil(numRows / numPerPage);

                $('#pgcount').text(' Of ' + numPages);
                $table.find('tbody tr').hide().slice(0, numPerPage).show();

                var start = ((parseInt($('#pageid').val()) - 1) * numPerPage);

                // first one
                if (parseInt($('#pageid').val()) == 1)
                    start = 0;

                var end = ($('#pageid').val() * numPerPage);

                $table.find('tbody tr').hide().slice(start, end).show();
            }
        });

        $('#lnknext').click(function() {
            if (parseInt($('#pageid').val()) != numPages)
            {
                $('#pageid').val(parseInt($('#pageid').val()) + 1);
                numPerPage = parseInt($('#recsperpage').val());
                currentPage = parseInt($('#pageid').val());
                numRows = $table.find('tbody tr').length;
                numPages = Math.ceil(numRows / numPerPage);

                $('#pgcount').text(' Of ' + numPages);
                $table.find('tbody tr').hide().slice(0, numPerPage).show();

                var start = ((parseInt($('#pageid').val()) - 1) * numPerPage);

                // first one
                if (parseInt($('#pageid').val()) == 1)
                    start = 0;

                var end = ($('#pageid').val() * numPerPage);

                $table.find('tbody tr').hide().slice(start, end).show();
            }
        });

        //*****************************************************************************************************************


        // instant search ********************************************************************************
        $('.tblsearch').bind('keyup change', function(e) {

            // re-paginate ************************** 
            var numRows = $table.find('tbody tr').length;
            numPerPage = numRows;
            var currentPage = 0;
            
            
            var numPages = Math.ceil(numRows / numPerPage);

            $('#pageid').val(currentPage + 1);
            $('#pgcount').text(' Of ' + numPages);
            $table.find('tbody tr').hide().slice(0, numPerPage).show();
            var start = ((parseInt($('#pageid').val()) - 1) * numPerPage);
            // first one
            if (parseInt($('#pageid').val()) == 1)
                start = 0;
            var end = ($('#pageid').val() * numPerPage);
            //**************************

            $table.find('tbody tr').hide().slice(start, end).show();

            var a = {};

            $('.tblsearch').each(function() {

                if (this.value != "" & this.value != "Any") {

                    var key = this.id.replace("txtsrch", "td");
                    a[key] = this.value;
                }
            });

            $('#testp').find('tbody').find('tr').each(function() {
                var tr = this;
                var matching = true;
                for (var key in a) {
                    $(tr).find('td[id=' + key + ']').each(function() {
                        var content = this.innerHTML.toLowerCase();
                        var regex = "\\b(" + a[key] + ")\\b";

                        if (key == "tdpatientID" | key == "tdgender" | key == "tdcivil")
                        {
                            if (content != a[key])
                            {
                                matching = false;
                            }
                        } else {
                            if (content.match(a[key]) == null)
                            {
                                matching = false;
                            }
                        }
                    });
                }
                if (matching == false)
                    $(tr).hide();
            });

        });
        //**********************************************************************************************



    });

</script>

<div class="box">
    
    <div class="panel panel-info" style="width: 100%px"> <!--starting point of panel-->
        
        <div class="panel-heading"> <!--starting point of panel head-->
            <h3 class="panel-title">Search for a patient</h3>


        </div> <!--Ending point of panel-->
        
        <div class="panel-body"><!--starting point of panel body (page content)-->
     
        
        <div class="span10">

            <div id="tablecont" style="border:RGB(245,245,245) 2px solid;width: 100%;height:530px;overflow-x:scroll" >
                <table class="table table-bordered table-striped table-hover tablesorter"  id="testp" style="width: 100">
                    <thead>
                        <tr>

                            <th width="50px">ID</th>
                            <th width="75px">Title</th>
                            <th width="100px">Name</th>

                            <th width="90px">DOB</th>
                            <th width="90px">Gender</th>
                            <th width="90px">Status</th>
                            <th width="90px">NIC</th>
                            <th width="90px">HIN</th>
                            <th width="90px">Passport</th>
                            <th width="90px">Telephone</th>
                            <th>Address</th>

                        </tr>

                        <tr>
                            <td><input type="text" class="tblsearch bg-search" id="txtsrchpatientID"   placeholder="ID" style="width:35px;height:25px"></td>

                            <td>
                                <select id="txtsrchtitle"  class="tblsearch" name="title" style="width:60px;height:25px">
                                    <option  selected  value="Any">Any</option>
                                    <option  value="mr.">Mr.</option>
                                    <option  value="miss.">Miss.</option>
                                    <option  value="mrs.">Mrs.</option>
                                    <option  value="rev ">Rev </option>
                                    <option  value="baby ">Baby </option>
                                    <option  value="unknown">Unknown</option>

                                </select>
                            </td>

                            <td><input type="text" class="tblsearch bg-search" id="txtsrchname"  placeholder="By Name" style="width:120px;height:25px"></td>
                            <td><input type="text" class="tblsearch bg-search" id="txtsrchdob"   placeholder="By DOB" style="width:70px;height:25px"></td>

                            <td>
                                <select id="txtsrchgender"  class="tblsearch" name="status" style="width:60px;height:25px">
                                    <option  selected  value="Any">Any</option>
                                    <option  value="male">Male</option>
                                    <option  value="female">Female</option>
                                </select>
                            </td>

                            <td>
                                <select id="txtsrchcivil"  class="tblsearch" name="status" style="width:60px;height:25px">
                                    <option  selected  value="Any">Any</option>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="divorced">Divorced</option>
                                    <option value="widow">Widow</option>
                                    <option value="unKnown">Unknown</option>
                                </select>

                            </td>

                            <td><input type="text" class="tblsearch bg-search" id="txtsrchnic"   placeholder="By NIC" style="width:70px;height:25px"></td>

                            <td><input type="text" class="tblsearch bg-search" id="txtsrchhin"   placeholder="By HIN" style="width:70px;height:25px"></td>

                            <td><input type="text" class="tblsearch bg-search" id="txtsrchpassport"   placeholder="By Passport" style="width:70px;height:25px"></td>

                            <td><input type="text" class="tblsearch bg-search" id="txtsrchtel"   placeholder="By Tel" style="width:70px;height:25px"></td>
                            <td><input type="text" class="tblsearch bg-search" id="txtsrchaddr" placeholder="By Address" style="width:auto;height:25px"></td>

                        </tr>

                    </thead>


                    <tbody>

                    <div id="tbody">
                        <?php foreach ($patients as $row) { ?>

                            <tr style="font-size:13px;cursor:pointer;" onClick=<?php echo "window.location='" . base_url() . "/index.php/operator_home_c/viewpatient/" . $row->patientID . "'"; ?> >

                                <td id="tdpatientID"><?php echo $row->patientID; ?></td>
                                <td id="tdtitle"><?php echo $row->patientTitle; ?></td>

                                <td id="tdname"><?php echo $row->patientFullName; ?></td>

                                <td id="tddob"><?php date_default_timezone_set('Asia/Colombo'); echo date("Y-m-d", $row->patientDateOfBirth / 1000); ?></td>
                                <td id="tdgender"><?php echo $row->patientGender; ?></td>
                                <td id="tdcivil"><?php echo $row->patientCivilStatus; ?></td>
                                <td id="tdnic"><?php echo $row->patientNIC; ?></td>
                                <td id="tdhin"><?php echo $row->patientHIN; ?></td>
                                <td id="tdpassport"><?php echo $row->patientPassport; ?></td>
                                <td id="tdtel"><?php echo $row->patientTelephone; ?></td>
                                <td id="tdaddr"><?php echo $row->patientAddress; ?></td>

                            <?php } ?>


                        </tr>

                        </tbody>

                   

                </table>


            </div>




            <div id="pagin"> 

                <a href='#' id="lnkprev" > << </a>
                |
                <label class="control-label" for="pageid"  style='display:inline'>Page</label>

                <input type="text" class="input-xlarge" id="pageid" style='width:20px' value="1" name="pageid"  />
                <p id='pgcount' style='display:inline'>  </p>
                |
                <a href='#' id="lnknext" > >> </a>

                &nbsp;&nbsp;&nbsp;
                <select id="recsperpage" style='width:65px'>
                    <option value="5"> 5 </option>
                    <option value="10"> 10 </option>
                    <option value="25" selected> 25 </option>
                    <option value="50"> 50 </option>
                    <option value="100"> 100 </option>
                </select>
            </div>

        </div>
    

    </div> <!--Ending point of panel body (page content)-->
    </div><!--Ending point of panel head-->
</tbody>
</table>
</div>
