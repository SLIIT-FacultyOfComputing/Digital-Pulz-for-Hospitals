/*
 ------------------------------------------------------------------------------------------------------------------------
 DiPMIMS - Digital Pulz Medical Information Management System
 Copyright (c) 2017 Sri Lanka Institute of Information Technology
 <http: http://his.sliit.lk />
 ------------------------------------------------------------------------------------------------------------------------
 */
var baseUrl="http://localhost/eHealth_proj";
function getCategoryListRC() {
    //alert("ABC");
    $.ajax({
        url: baseUrl+'/index.php/Request_Controller/getCatList',
        type: 'POST',
        crossDomain: true,
        success: function(data) {
            data = trimData(data);
            var json_parsed = $.parseJSON(data);
            for (var i = 0; i < json_parsed.length; i++) {
                var newOption = $('<option>');
                newOption.attr('value', json_parsed[i]['dCategory']).text(json_parsed[i]['dCategory']);
                $('#categoryDropDownRC').append(newOption);
            }


        }
    });

}

function getDrugByCategoryRC(){


     document.getElementById("box2").style.visibility = "visible";
          $('#drugNameDropDownRC').empty();
         
         $reqCount=1;
         $request_contents = "<table class=table id=tablecontent>";
         $request_contents += "<thead>";
         $request_contents += "<tr>";
         $request_contents += "<th>Drug ID</th>";
         $request_contents += "<th>Drug Name</th>";
         $request_contents += "<th>Quantity</th>";
         $request_contents += "</tr>";
         $request_contents += "</thead>";
         $request_contents += "<tbody>";

    var val;
    val = $("#categoryDropDownRC option:selected").text();
    $.ajax({
        url: baseUrl+'/index.php/Request_Controller/getDrugList/'+val,
        type: 'POST',
        crossDomain: true,
                success: function(data) {
            data = trimData(data);
            var defaultOption = "<option>Select</option>";
                $('#drugNameDropDownRC').append(defaultOption);
            var json_parsed = $.parseJSON(data);
            for (var i = 0; i < json_parsed.length; i++) {
                var newOption = $('<option id='+json_parsed[i]['dSrNo']+'>');
                newOption.attr('value', json_parsed[i]['dName']).text(json_parsed[i]['dName']);
                $('#drugNameDropDownRC').append(newOption);
                 }
            }
    });
}

function createRequestOptiontableRC() {

    var quantity = document.getElementById("drugQtyRC").value;
    var qtyError  = $("#qtyerror").text();
    
    if(quantity.length == 0)
    {
        alert("Please Enter a quantity");
    }
    else if(qtyError.length != 0)
    {
        alert("Please enter a valid quantity");
    }
    else
    {
            document.getElementById("post_request_tbl_RC").style.visibility = "visible";
            //document.getElementById("post_drugDetails_tbl_DC").style.visibility = "hidden";
            var val;
            var val2;
            var val3;
            
            val3 = $("#drugNameDropDownRC option:selected").attr('id');
            val = $("#drugNameDropDownRC option:selected").text();
            val2 = $("#drugQtyRC").val();
            
            for(i=1; i<=$('#tablecontent tr').length-1; i++)
            {
                if($("#tablecontent #req"+i).text() == val)
                {
                    alert('You have already added this Drug!!!');
                    return false;
                }
                //alert(cat_val_chckd[i]);
            }


            $request_contents += "<tr>";
            $request_contents += "<td name=drugid"+$reqCount+" id=drugid"+$reqCount+">" + val3 + "</td>";
            $request_contents += "<td name=req"+$reqCount+" id=req"+$reqCount+">" + val + "</td>";
            $request_contents += "<td name=qty"+$reqCount+" id=qty"+$reqCount+">" + val2 + "</td>";
            $request_contents += "</tr>";
            $reqCount++;


            document.getElementById("tablespaceRC").innerHTML = $request_contents;
    }

}

function SendRequestRC() {

var count = $('#tablecontent tr').length;
var countOfUpdateValues = 0;
//alert(count);
var cat_val_chckd= [];
var j=1;
for(i=1; i<=$('#tablecontent tr').length-1; i++)
{
            cat_val_chckd.push({name:$("#tablecontent #req"+i).text(),qty:$("#tablecontent #qty"+i).text(),drugid:$("#tablecontent #drugid"+i).text()});
            //cat_val_chckd[j] = $("#pagetable #reqid"+i).text();
            countOfUpdateValues++;
            j++;
            //alert(cat_val_chckd[i]);
}
//alert(countOfUpdateValues);

if(countOfUpdateValues>0)
    {
$.ajax({
        url: baseUrl+'/index.php/Request_Controller/requestDrug',
        type: 'POST',
        crossDomain: true,
        //data: {"dsr":$sr_globe ,"dcat":cat_val_chckd , "dname":nam_val_chckd ,"dprice":price_val_chckd,"dqty":qty_va_chckd},
        data:{"reqArr":cat_val_chckd},
        success: function (data) {
            data = trimData(data);
            alert(data);
            $("#tablecontent tr").remove();
            document.getElementById("post_request_tbl_RC").style.visibility = "hidden";
        //getRequestAfterApproveDC();
        
        }
    });
    }
else{
    alert('please select atleast one value to update');
    }

}

function getRequestToViewRC() {

    document.getElementById("post_requestDetails_tbl_RC").style.visibility = "visible";
    $.ajax({
        url: baseUrl+'/index.php/Request_Controller/viewRequestDrugs',
        type: 'POST',
        crossDomain: true,
        //data: {"myOrderString": myOrderString},  // fix: need to append your data to the call
        success: function (data) {
            data = trimData(data);
           var json_parsed = $.parseJSON(data);
           createRequestViewTblRC(json_parsed);      
        }
    });
    
}
function createRequestViewTblRC(json){

    var available = true;
    $.each(json, function(index,el) {
        // el = object in array
        // access attributes: el.Id, el.Name, etc
        //alert(el.drugs.dName);
        if (el.processed == null || el.processed == false) {
            available = false;
        }
    });
        //s0=json[0]['drugs']['dName'];

        //alert(json);
//    $sr_globe = sr;
    var pagecontent = "";
    if(available == false) {


        pagecontent = "<table class='table table-bordered table-striped table-hover' id=pagetable>";
        pagecontent += "<thead>";
        pagecontent += "<tr>";
        pagecontent += "<th>Request ID</th>";
        pagecontent += "<th>Drug ID</th>";
        pagecontent += "<th>Drug Name</th>";
        pagecontent += "<th>Requested Quantity</th>";
        pagecontent += "<th>Available Quantity</th>";
        pagecontent += "<th>Date</th>";
        pagecontent += "<th>Department</th>";
        pagecontent += "<th>Status</th>";
        pagecontent += "<th style='width:100px'>Approved Quantity</th>";
        pagecontent += "<th>Approve</th>";
        pagecontent += "</tr>";
        pagecontent += "</thead>";
        pagecontent += "<tbody>";

        var i = 1;
        $.each(json, function (index, el) {
            // el = object in array
            // access attributes: el.Id, el.Name, etc
            //alert(el.drugs.dName);
            if (el.processed == null || el.processed == false) {
                pagecontent += "<tr>";
                pagecontent += "<td name=reqid" + i + " id=reqid" + i + ">" + el.requestId + "</td>";
                pagecontent += "<td name=sr_val" + i + " id=sr_val" + i + " >" + el.drugs.dSrNo + "</td>";
                pagecontent += "<td name=req_dname" + i + " id=req_dname" + i + " >" + el.drugs.dName + "</td>";
                pagecontent += "<td name=req_qty" + i + " id=req_qty" + i + " >" + el.quantity + "</td>";
                pagecontent += "<td name=avail_qty" + i + " id=avail_qty" + i + " >" + el.drugs.dQty + "</td>";
                pagecontent += "<td>" + el.requestedDate + "</td>";
                pagecontent += "<td>" + el.department + "</td>";


                pagecontent += "<td>Pending</td>";
                pagecontent += "<td><input type=number name=appQtyValueRC" + i + " id=appQtyValueRC" + i + " value='" + el.quantity + "'/></td>";
                pagecontent += "<td><input type=checkbox name=chkRequestValueRC" + i + " id=chkRequestValueRC" + i + " /></td>";
                i++;
            }
            pagecontent += "</tr>";
//
//disabled="true" document.getElementById("checkemail").disabled=true;
//

//
        });
//
        pagecontent += "</tbody>";
        pagecontent += "</table>";
        pagecontent += "<input class='btn btn-primary' type=submit value=Approve onclick=getAllRequestRC()>";



    }
    else
    {
        pagecontent += "No new requests available at the moment";
    }

    document.getElementById("pagespaceRC").innerHTML = pagecontent;
   //cat_val_chckd = $("#pagetable #reqid1").text();
   //alert(cat_val_chckd);
   //getAllRequestDC();
}

function getAllRequestRC() {

var msg1 = "";
var msg2 = "";
var count = $('#pagetable tr').length;
var countOfUpdateValues = 0;
var countInvalidQty = 0;
//alert(count);
var catValChckd= [];
var appQty = [];
var reqvalID=[];
var j=1;
for(i=1; i<=$('#pagetable tr').length-1; i++)
{  
    if($('#chkRequestValueRC'+i).is(":checked"))
    {
        if(document.getElementById("appQtyValueRC"+i).value.length != 0 && parseInt(document.getElementById("appQtyValueRC"+i).value) > 0)
        {
            
            if((parseInt($("#pagetable #avail_qty"+i).text()) < parseInt($("#pagetable #req_qty"+i).text())) && (parseInt($("#pagetable #avail_qty"+i).text()) < parseInt(document.getElementById("appQtyValueRC"+i).value)))
            {
                msg1 += $("#pagetable #req_dname"+i).text();
                msg1 += ", ";
                countOfUpdateValues++;
                //alert("Stock is not Available...!!!");
                //return false;
            }
            else if((parseInt($("#pagetable #avail_qty"+i).text()) > parseInt($("#pagetable #req_qty"+i).text())) && (parseInt($("#pagetable #req_qty"+i).text()) < parseInt(document.getElementById("appQtyValueRC"+i).value)))
            {
                msg1 += $("#pagetable #req_dname"+i).text();
                msg1 += ", ";
                countOfUpdateValues++;
            }
            else
            {
                msg2 += $("#pagetable #req_dname"+i).text();
                msg2 += $("#pagetable #req_qty"+i).text();
               msg2 += $("#pagetable #avail_qty"+i).text();


			 var textFile = null,
			  makeTextFile = function (text) {
			    var data = new Blob([text], {type: 'text/plain'});

			    // If we are replacing a previously generated file we need to
			    // manually revoke the object URL to avoid memory leaks.
			    if (textFile !== null) {
			      window.URL.revokeObjectURL(textFile);
			    }

			    textFile = window.URL.createObjectURL(msg2);

			    // returns a URL you can use as a href
			    return textFile;
			  };
 






                catValChckd.push({id:$("#pagetable #sr_val"+i).text()});
                appQty.push({qty:document.getElementById("appQtyValueRC"+i).value});
                reqvalID.push({rid:$("#pagetable #reqid"+i).text()});
                countOfUpdateValues++;
                //cat_val_chckd[j] = $("#pagetable #reqid"+i).text();
                   // alert(getElementById("reqid"+i).value);
                j++;
            }
        }
        else
        {
            countInvalidQty++;
            //alert('Please enter a Quantity to approve!!!');
        }
            
            //alert(cat_val_chckd[i]);
    }
    
}


if(countOfUpdateValues>0 && countInvalidQty ===0)
    {
$.ajax({
        url: baseUrl+'/index.php/Request_Controller/approveRequest_new',
        type: 'POST',
        crossDomain: true,
        //data: {"dsr":$sr_globe ,"dcat":cat_val_chckd , "dname":nam_val_chckd ,"dprice":price_val_chckd,"dqty":qty_va_chckd},
        data:{"reqArr":catValChckd, "appQty":appQty ,"reqID":reqvalID},
        success: function (data) {
        console.log(data);
        data = trimData(data);
        if(msg1 != "")
        {
            msg1 += "\n are not Available!!!";
            alert(msg1);       
        }
        if(msg2 != "")
        {
            //alert(msg2+"\n");
            getRequestAfterApproveRC();
        }
        
        }
    });

    }
else{
    if(countOfUpdateValues<=0)
    {
        alert('Please select atleast one value to update');
    }
    if(countInvalidQty>0)
    {
        alert('Please Enter a valid quantity');
    }
}

}

function getRequestAfterApproveRC() {
    alert('Pharmacy Stock Sccessfully Updated');
    $.ajax({
        url: baseUrl+'/index.php/Request_Controller/viewRequestDrugs',
        type: 'POST',
        crossDomain: true,
        //data: {"myOrderString": myOrderString},  // fix: need to append your data to the call
        success: function (data) {
           data = trimData(data); 
           var json_parsed = $.parseJSON(data);
           createRequestViewTblRC(json_parsed);      
        }
    });

}

