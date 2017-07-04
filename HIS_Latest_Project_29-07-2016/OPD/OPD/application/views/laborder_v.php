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

    $(document).ready(function () {

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
        $('#pageid').change(function () {

            var start = ((parseInt($('#pageid').val()) - 1) * numPerPage);

            // first one
            if (parseInt($('#pageid').val()) == 1)
                start = 0;
            var end = ($('#pageid').val() * numPerPage);
            $table.find('tbody tr').hide().slice(start, end).show();
        });

        $('#recsperpage').change(function () {
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

        $('#lnkprev').click(function () {
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

        $('#lnknext').click(function () {
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
        $('.tblsearch').bind('keyup change', function (e) {

            // re-paginate ************************** 
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
            //**************************

            $table.find('tbody tr').hide().slice(start, end).show();

            var a = {};

            $('.tblsearch').each(function () {

                if (this.value != "" & this.value != "Any") {

                    var key = this.id.replace("txtsrch", "td");
                    a[key] = this.value;
                }
            });

            $('#testp').find('tbody').find('tr').each(function () {
                var tr = this;
                var matching = true;
                for (var key in a) {
                    $(tr).find('td[id=' + key + ']').each(function () {
                        var content = this.innerHTML.toLowerCase();
                        a[key] = a[key].toLowerCase();
                        var regex = "\\b(" + a[key] + ")\\b";
                        if (key == "tdpid" | key == "tdgender" | key == "tdcivil")
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





<div class="container">
    <div class="panel panel-info" style="width: 1000px">
        <div class="panel-heading">
            <h3 class="panel-title">Lab Orders</h3>
        </div> <!--        Starting point of patient history panel body-->
        <div class="panel-body">
            <div class="row">

                <div class="span10">
                    <div id="tablecont" style="border:RGB(245,245,245) 2px solid;width: 1000px;height:530px;overflow-x:scroll" >
                        <table class="table table-bordered table-striped table-hover"  id="testp" >
                            <thead>
                                <tr>

                                    <th>Patient</th>
                                    <th>Visit</th>
                                    <th>Order Date</th>
                                    <th>Test Name</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" placeholder="By Name" class="tblsearch bg-search" id="txtsrchpname" style="width:150px;padding-left:20px;"></td>

                                    <td>
                                        <select id="txtsrchcvisit"  class="tblsearch" name="visit" style="width:95px;height:25px">
                                            <option  selected  value="Any">Any</option>
                                            <option value="opd">Opd</option>
                                            <option value="clinic">Clinic</option>
                                            <option value="ward">Ward</option>
                                        </select>
                                    </td>

                                    <td><input type="date" class="tblsearch bg-search" id="txtsrchdate" style="width:auto;padding-left:20px;"></td>
                                    <td><input type="text" placeholder="By Test" class="tblsearch bg-search" id="txtsrchtest" style="width:auto;padding-left:20px;"></td>
                                    <td><input type="text" placeholder="By Status" class="tblsearch bg-search" id="txtsrchstatus" style="width:auto;padding-left:20px;"></td>

                                </tr>
                                <?php if (empty(json_decode($laborders, 1))) { ?>
                                <div class="alert alert-warning">
                                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                                    <p align="center"><strong>Attention!</strong> There is no Records Found.</p>
                                </div>

                            <?php } ?>
                            <?php if (count(json_decode($laborders, 1)) != 0) { ?>
                                <?php foreach ($laborders as $row) { ?>  

                                    <tr onClick=<?php // echo "window.location='/SEP_Project/index.php/laborder_c/edit/".$row->LABTESTID."'";   ?> >
                                        <td  id="tdpname"><?php echo '(' . $row->visit->patient->patientID . ') ' . $row->visit->patient->patientTitle . $row->visit->patient->patientFullName; ?> </td>
                                        <td  id="tdvisit"><?php echo $row->visit->visitType; ?></td>
                                        <td  id="tddate"><?php echo $row->orderCreateDate; ?></td>
                                        <td  id="tdtest"><?php echo $row->orderTestID->testName; ?></td>
                                        <td  id="tdstatus"><?php echo $row->orderStatus; ?></td>

                                    </tr> 

                                <?php } ?>

                            <?php } ?>


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

            </div>
        </div>
    </div>
</div>