/*
 ------------------------------------------------------------------------------------------------------------------------
 DiPMIMS - Digital Pulz Medical Information Management System
 Copyright (c) 2017 Sri Lanka Institute of Information Technology
 <http: http://his.sliit.lk />
 ------------------------------------------------------------------------------------------------------------------------
 */
var baseUrl="http://localhost/eHealth_proj";
function getCategoryListDC() {
    //document.getElementById("imgid").style.visibility = "visible";

    $.ajax({
        url: baseUrl+'/index.php/Drug_Controller/getcatlist',
        type: 'POST',
        crossDomain: true,
        success: function(data) {
    
            data = trimData(data);
            var json_parsed = $.parseJSON(data);
           
            for (var i = 0; i < json_parsed.length; i++) {
        
                var newOption = $('<option id='+json_parsed[i]['dCategoryId']+'>');
                newOption.attr('value', json_parsed[i]['dCategory']).text(json_parsed[i]['dCategory']);
                $('#categoryDropDownDC').append(newOption);
            }

        }
    });
    
        

    $.ajax({
            url: baseUrl+'/index.php/Drug_Controller/getDrugNames',
            type: 'POST',
            crossDomain: true,
            success: function(data) {  
                data = trimData(data);
                var json_parsed = $.parseJSON(data);
                for (var i = 0; i < json_parsed.length; i++) {
                    var newOption = $('<option id='+json_parsed[i]['dSrNo']+'>');
                    newOption.attr('value', json_parsed[i]['dName']).text(json_parsed[i]['dName']);
                    $('#drugNameDropDownDC').append(newOption);
                }
                getDrugDetailsByDNameDC();

            }
                
        });
    
}


////////////////////
function getCategoryListDCUpdate() {
    
    $.ajax({
        url: baseUrl+'/index.php/Batch_Controller/getCatList',
        type: 'POST',
        crossDomain: true,
        success: function(data) {
            data = trimData(data);
//            alert("sfs");
            var json_parsed = $.parseJSON(data);
            for (var i = 0; i < json_parsed.length; i++) {
                var newOption = $('<option>');
                newOption.attr('value', json_parsed[i]['dCategory']).text(json_parsed[i]['dCategory']);
//                alert(newOption);
                $('#categoryDropDownDC').append(newOption);
            }

        }
    });
    
    $.ajax({
            url: baseUrl+'/index.php/Batch_Controller/getDrugNames',
            type: 'POST',
            crossDomain: true,
                    success: function(data) {
                data = trimData(data);
                var json_parsed = $.parseJSON(data);
               // alert(json_parsed.length);
                
                for (var i = 0; i < json_parsed.length; i++) {
                    var newOption = $('<option id='+json_parsed[i]['dSrNo']+'>');
                    newOption.attr('value', json_parsed[i]['dName']).text(json_parsed[i]['dName']);
                    $('#drugNameDropDownDC').append(newOption);
                     }
                     getDrugDetailsByDNameDC();
//                    var drugId = $("#drugNameDropDownDC option:selected").attr('id');
//                $("#dangerValueDC").val(drugId); 
                }
                
        });
       //document.getElementById("imgid").style.visibility = "hidden";

}



function getDrugDetailsByDNameDC() { 
    //var drugName = $("#drugNameDropDownDC option:selected").text();
    //document.getElementById("imgid").style.visibility = "visible";
    
    var drugId = $("#drugNameDropDownDC option:selected").attr('id');
    
   
    $.ajax({
        url: baseUrl+'/index.php/Drug_Controller/getDrugDetails',
        type: 'POST',
        crossDomain: true,
       data: {'myOrderString': drugId},
        success: function(data) {

//             $("#dangerValueDC").val("sdss");              
            data = trimData(data);
            var json_parsed = $.parseJSON(data);
            if(json_parsed != null)
            {
            //alert(json_parsed[0]['categories']['dCategory']);
            $("#priceValueDC").val(json_parsed[0]['dPrice'].toString());
            $("#reorderValueDC").val(json_parsed[0]['statusReOrder'].toString());
            $("#dangerValueDC").val(json_parsed[0]['statusDanger'].toString());
            //$("#categoryDropDownDC").val(json_parsed[0]['categories']['dCategory'].toString());
            $("#drugTypeDC").val(json_parsed[0]['dUnit'].toString());
            $("#remarksValueDC").val(json_parsed[0]['dRemarks'].toString());
        }
            //document.getElementById("imgid").style.visibility = "hidden";
        },
         error: function (error) {
             
             alert("test");
                 
                $("#dangerValueDC").val( "getDrugDetailsByDNameDC method failed"); 
              }
    });


}

function getDrugByCategoryDCUpdate(){
    
       
        
//     var drugName_ddcontents = "";
//         drugName_ddcontents += "<select id=drugNameDropDownBC name=drugNameDropDownBC >";
//         drugName_ddcontents += "<option value=default selected=selected>Select</option>";
//         drugName_ddcontents += "</select>";
//
//     document.getElementById("drugspaceBC").innerHTML = drugName_ddcontents;
//
//     document.getElementById("post_drugName_dd_BC").style.visibility = "visible";
    //document.getElementById("imgid").style.visibility = "visible";
    $('#drugNameDropDownDC').empty();
    var val;
    val = $("#categoryDropDownDC option:selected").text();
    if (val == "All")
    {
        $.ajax({
            url: baseUrl+'/index.php/Batch_Controller/getDrugNames',
            type: 'POST',
            crossDomain: true,
                    success: function(data) {
                data = trimData(data);
                var json_parsed = $.parseJSON(data);
                for (var i = 0; i < json_parsed.length; i++) {
                    var newOption = $('<option id='+json_parsed[i]['dSrNo']+'>');
                    newOption.attr('value', json_parsed[i]['dName']).text(json_parsed[i]['dName']);
                    $('#drugNameDropDownDC').append(newOption);
                     }
                     getDrugDetailsByDNameDC();

                     //document.getElementById("imgid").style.visibility = "hidden";
                }
        });
    }
    else
    {
        $.ajax({
            url: baseUrl+'/index.php/Batch_Controller/getDrugList/'+val,
            type: 'POST',
            crossDomain: true,
                    success: function(data) {
                data = trimData(data);
                var json_parsed = $.parseJSON(data);
                for (var i = 0; i < json_parsed.length; i++) {
                    var newOption = $('<option id='+json_parsed[i]['dSrNo']+'>');
                    newOption.attr('value', json_parsed[i]['dName']).text(json_parsed[i]['dName']);
                    $('#drugNameDropDownDC').append(newOption);
                     }
                     getDrugDetailsByDNameDC();

                     //document.getElementById("imgid").style.visibility = "hidden";
                }
        });
    }
}

/////////////////////////////////
function getDrugByCategoryDC(){


     document.getElementById("post_drugDetails_tbl_DC").style.visibility = "hidden";
     document.getElementById("tablespaceDC").innerHTML = "";

     var drugName_ddcontents = "";
         drugName_ddcontents += "<div class='form-group form-group-sm'>";
         drugName_ddcontents += "<label class='col-sm-4 control-label' for='sm'>Drug Name :</label>";
         drugName_ddcontents += "<div class='col-sm-6'>";
         drugName_ddcontents += "<select  class=form-control id=drugNameDropDownDC name=drugNameDropDownDC onchange=createDrugOptiontableDC() >";
         drugName_ddcontents += "<option value=default selected=selected>Select</option>";
         drugName_ddcontents += "</select>";
         drugName_ddcontents += "</div>";
         drugName_ddcontents += "</div>";


     document.getElementById("drugspaceDC").innerHTML = drugName_ddcontents;

    var val;
    val = $("#categoryDropDownDC option:selected").text();
    $.ajax({
        url: baseUrl+'/index.php/Drug_Controller/getDrugList/'+val,
        type: 'POST',
        crossDomain: true,
        success: function(data) {
            data = trimData(data); 
           // alert("asder");
            var json_parsed = $.parseJSON(data);
            for (var i = 0; i < json_parsed.length; i++) {
                var newOption = $('<option id='+json_parsed[i]['dSrNo']+'>');
                newOption.attr('value', json_parsed[i]['dName']).text(json_parsed[i]['dName']);
                $('#drugNameDropDownDC').append(newOption);
                 }
            }
    });
}


function createDrugOptiontableDC() {

    document.getElementById("post_drugDetails_tbl_DC").style.visibility = "hidden";
    $_drugName = $("#drugNameDropDownDC option:selected").text();
    var drugId = $("#drugNameDropDownDC option:selected").attr('id');
    //alert(drugId);
    var myArray = [];
    
    $.ajax({
    url: baseUrl+'/index.php/Drug_Controller/getBatchList/'+drugId,
    type: 'POST',
    crossDomain: true,
            success: function(data) {
            data = trimData(data);
            var json_parsed = $.parseJSON(data);                  
            var j=1;
            var tablecontents = "";

            tablecontents = "<table class=table table-boardered id=tablecontent>";
            tablecontents += "<thead>"; 
            tablecontents += "<tr>";
            tablecontents += "<th>Name</th>";
            tablecontents += "<th>Batch No</th>";
            tablecontents += "<th>Edit</th>";
            tablecontents += "<th>View</th>";
            tablecontents += "<th>Delete</th>";
            tablecontents += "</tr>";
            tablecontents += "</thead>";
            tablecontents += "<tbody>";

            for (var i = 0; i < json_parsed.length; i++) {
 
            tablecontents += "<tr>";
            tablecontents += "<td>" + $_drugName + "</td>";
            tablecontents += "<td>" + json_parsed[i] + "</td>";
            tablecontents += "<td onclick=getDataToEditDC("+j+")>" + "<a href='#detailsPost' class='btn btn-info btn-md'>" + "Edit" + "</a></td>";
            tablecontents += "<td onclick=getDataToViewDC("+j+")>" + "<a href='#detailsPost' class='btn btn-info btn-md'>" + "View" + "</a></td>";
            tablecontents += "<td onclick=deleteBatchDC("+j+")>" + "<a href='#detailsPost' class='btn btn-info btn-md'>" + "Delete" + "</a></td>";
            tablecontents += "</tr>";
            
            j++;
            
            }
            tablecontents += "</tbody>";
            tablecontents += "</table>";
            document.getElementById("tablespaceDC").innerHTML = tablecontents;
             
        }
});


}


function getDataToEditDC(rowNumber) {

    document.getElementById("post_drugDetails_tbl_DC").style.visibility = "visible";
    $_rownumber = rowNumber;
    $('#tablecontent tr td').each(function(){
         $_drugNameFromColumn  = $("#tablecontent tr:nth-child("+rowNumber+") td:nth-child(1)").text();
         $_batchIdFromColumn  = $("#tablecontent tr:nth-child("+rowNumber+") td:nth-child(2)").text();

         });

    var myOrderString = $_drugNameFromColumn;
    var mybatchString = $_batchIdFromColumn;
    $.ajax({
        url: baseUrl+'/index.php/Drug_Controller/getBatchDetails',
        type: 'POST',
        crossDomain: true,
        data: {"myOrderString": myOrderString,"mybatchString":mybatchString},  // fix: need to append your data to the call
        success: function (data) {
           data = trimData(data); 
           var json_parsed = $.parseJSON(data);
           var s1,s2,s0,s3;
           s0=json_parsed[0];
           s1=json_parsed[1];
           s2=json_parsed[2];
           s3=json_parsed[3];


           createDrugUpdateTblDC(s0,s1,s2,s3);

        }
    });

}

function getDataToViewDC(rowNumber) {

    document.getElementById("post_drugDetails_tbl_DC").style.visibility = "visible";

    $('#tablecontent tr td').each(function(){
         $_drugNameFromColumn  = $("#tablecontent tr:nth-child("+rowNumber+") td:nth-child(1)").text()
         $_batchIdFromColumn  = $("#tablecontent tr:nth-child("+rowNumber+") td:nth-child(2)").text();
      });
    var myOrderString = $_drugNameFromColumn;
    var mybatchString = $_batchIdFromColumn;

    $.ajax({
        url: baseUrl+'/index.php/Drug_Controller/getBatchDetails',
        type: 'POST',
        crossDomain: true,
        data: {"myOrderString": myOrderString,"mybatchString":mybatchString},  // fix: need to append your data to the call
        success: function (data) {
            data = trimData(data);
           var json_parsed = $.parseJSON(data);
           var s1,s2,s3,s4,s5,s6,s0;
           s0=json_parsed[0];
           s1=json_parsed[1];
           s2=json_parsed[2];
           s3=json_parsed[3];
           s4=json_parsed[4];
           s5=json_parsed[5];
           s6=json_parsed[7];
           s7=json_parsed[8];
           createviewTblDC(s0,s1,s3,s4,s2,s5,s6,s7);

        }
    });

}

function deleteBatchDC(rowNumber){
     document.getElementById("post_drugDetails_tbl_DC").style.visibility = "visible";

    $('#tablecontent tr td').each(function(){
         $_drugNameFromColumn  = $("#tablecontent tr:nth-child("+rowNumber+") td:nth-child(1)").text()
         $_batchIdFromColumn  = $("#tablecontent tr:nth-child("+rowNumber+") td:nth-child(2)").text();
      });
    var myOrderString = $_drugNameFromColumn;
    var mybatchString = $_batchIdFromColumn;

    $.ajax({
        url: baseUrl+'/index.php/Drug_Controller/deleteBatch',
        type: 'POST',
        crossDomain: true,
        data: {"myOrderString": myOrderString,"mybatchString":mybatchString},  // fix: need to append your data to the call
        success: function (data) {
           window.location =  baseUrl+'/index.php/Drug_Controller/drugInformationview';

        }
    });
}

function createviewTblDC(batch_num,name,createUser,LastUpdated,quantity,LastUpdatedUser,manufactureDate,expireDate){


    var pagecontent = "";

    pagecontent = "<table class=table id=pagetable>";
    pagecontent += "<thead>";
    pagecontent += "<tr>";
    pagecontent += "<th>Drug Details</th>";
    pagecontent += "<th>Values to the date</th>";
    pagecontent += "</tr>";
    pagecontent += "</thead>";
    pagecontent += "<tbody>";

    pagecontent += "<tr>";
    pagecontent += "<td>Batch No</td>";
    pagecontent += "<td name=sr_val id=sr_val >"+batch_num+"</td>";
    pagecontent += "</tr>";


    pagecontent += "<tr>";
    pagecontent += "<td>Name</td>";
    pagecontent += "<td>"+name+"</td>";
    pagecontent += "</tr>";

//    pagecontent += "<tr>";
//    pagecontent += "<td>Create User</td>";
//    pagecontent += "<td>"+createUser+"</td>";
//    pagecontent += "</tr>";
//
//    pagecontent += "<tr>";
//    pagecontent += "<td>Last Updated ON</td>";
//    pagecontent += "<td>"+LastUpdated+"</td>";
//    pagecontent += "</tr>";
//    
//    pagecontent += "<tr>";
//    pagecontent += "<td>Last Updated User</td>";
//    pagecontent += "<td>"+LastUpdatedUser+"</td>";
//    pagecontent += "</tr>";

    pagecontent += "<tr>";
    pagecontent += "<td>Quantity</td>";
    pagecontent += "<td>"+quantity+"</td>";
    pagecontent += "</tr>";

    pagecontent += "<tr>";
    pagecontent += "<td>Manufacture Date</td>";
    pagecontent += "<td>"+manufactureDate+"</td>";
    pagecontent += "</tr>";


    pagecontent += "<tr>";
    pagecontent += "<td>Expire Date</td>";
    pagecontent += "<td>"+expireDate+"</td>";
    pagecontent += "</tr>";

    pagecontent += "</tbody>";
    pagecontent += "</table>";



   document.getElementById("pagespaceDC").innerHTML = pagecontent;
}

function createDrugUpdateTblDC(batch_num,name,quantity,status){


    $batch_num_globe = batch_num;
    $name_global = name;
    //alert($name_global);
    var pagecontent = "";

    pagecontent = "<table class=table id=pagetable>";
    pagecontent += "<thead>";
    pagecontent += "<tr>";
    pagecontent += "<th>Drug Details</th>";
    pagecontent += "<th>Values to the date</th>";
    pagecontent += "</tr>";
    pagecontent += "</thead>";
    pagecontent += "<tbody>";


    pagecontent += "<tr>";
    pagecontent += "<td>Quantity</td>";
    pagecontent += "<td><div class='col-sm-6'><input class='form-control' value="+quantity+" type=number name=quantityValueDC id=quantityValueDC /></div></td>";
    pagecontent += "</tr>";
    
    // pagecontent += "<tr>";
    // pagecontent += "<td>Batch Status</td>";
    // pagecontent += "<td><div class='col-sm-6'><input class='form-control' value='status' name=statusValueDC id=statusValueDC /></div></td>";
    // pagecontent += "</tr>";
    
    pagecontent += "<tr>";
    pagecontent += "<td>Change Batch Status</td>";
    pagecontent += "<form>";
    if(status=="Enabled")
    {
        pagecontent += "<td><input type=radio name=status id=Enabled value=Enabled checked=true >Enable</br>";
        pagecontent += "<input type=radio name=status id=Enabled value=Disabled >Disable</td>";
    }
    else
    {
        pagecontent += "<td><input type=radio name=status id=Enabled value=Enabled  >Enable</br>";
        pagecontent += "<input type=radio name=status id=Enabled value=Disabled checked=true>Disable</td>";
    }    
    pagecontent += "</form>";
    pagecontent += "</tr>";

    pagecontent += "</tbody>";
    pagecontent += "</table>";

    pagecontent += "<input type=submit class='btn btn-primary' value=Update onclick=getAllDataDC()>";
    document.getElementById("pagespaceDC").innerHTML = pagecontent;
}



function getAllDataDC() {

var cat_val_chckd,nam_val_chckd,batch_val_chckd,price_val_chckd,qty_va_chckd;



   cat_val_chckd = $("#categoryDropDownDC").val();
   qty_va_chckd = $("#quantityValueDC").val();
   batch_val_chckd = $('input[name=status]:checked').val();
   var drug_id  = $("#drugNameDropDownDC option:selected").attr('id');;
   //alert(qty_va_chckd);


var r=confirm("Are you sure you want to update the following data ?");
if (r==true)
    {
        //alert(drug_id);
    
$.ajax({
        url: baseUrl+'/index.php/Drug_Controller/updateBatch',
        type: 'POST',
        crossDomain: true,
        data: {"dbatchno":$batch_num_globe ,"dcat":cat_val_chckd , "dname":$name_global ,"dqty":qty_va_chckd,"dstatus":batch_val_chckd,"drugId":drug_id},
        success: function (data) {
            data = trimData(data);
            alert(data);
        getDataAfterEditDC();

        }
    });
    }
    else{
        alert("canceled update");
    }
    
}


function getAll() {

 //document.getElementById("imgid").style.visibility = "visible";
   // alert("dfggfd");
    var drugName  = $("#drugNameDropDownDC option:selected").text();
     
   
    var drugType  = document.getElementById("drugTypeDC").value;
    var remarks   = document.getElementById("remarksValueDC").value;
    var price     = document.getElementById("priceValueDC").value;
      
   
    var drugReorder  = document.getElementById("reorderValueDC").value;
    var drugDanger  = document.getElementById("dangerValueDC").value;
     
  
    var priceError  = $("#priceerror").text();
    var reorderError  = $("#reordererror").text();
    var dangerError  = $("#dangererror").text();
     
    
    if(drugName.length==0 || price.length==0 || drugReorder.length==0 || drugDanger.length==0)
    {
        alert("Please Fill all the Fields");
        //document.getElementById("imgid").style.visibility = "hidden";
    }
    else if(priceError.length != 0 || dangerError.length != 0 || reorderError.length != 0)
    {
        alert("Some Fields are Invalid!!!");
        //document.getElementById("imgid").style.visibility = "hidden";
    }
    else
    {
        var r=confirm("Are you sure you want to update the following data ?");
        if(r==true)
        {
    $.ajax({
           url: baseUrl+'/index.php/Drug_Controller/addDrug',
            type: 'POST',
            crossDomain: true,
            data: {"drugName":drugName, "drugType":drugType,
                   "remarks":remarks,"price":price, "drugReorder":drugReorder,"drugDanger":drugDanger },
            success: function(data) {
                data = trimData(data);
                 alert(data);
                 //document.getElementById("imgid").style.visibility = "hidden";
                 $("#remarksValueDC").val("");
                 //document.getElementById('SucMsg').innerHTML = data;
                 

           }
         });
        }
        else{
            alert("Update Canceled!!! (jqdc addrugdc1)");
            //document.getElementById("imgid").style.visibility = "hidden";
        }
        
    }
}













function getDataAfterEditDC() {

    var myOrderString = $_drugNameFromColumn;
    var mybatchString = $_batchIdFromColumn;

    $.ajax({
        url: baseUrl+'/index.php/Drug_Controller/getBatchDetails',
        type: 'POST',
        crossDomain: true,
        data: {"myOrderString": myOrderString,"mybatchString":mybatchString},  // fix: need to append your data to the call
        success: function (data) {
            data = trimData(data);
           var json_parsed = $.parseJSON(data);
           var s1,s2,s3,s4,s5,s6,s0;
           s0=json_parsed[0];
           s1=json_parsed[1];
           s2=json_parsed[2];
           s3=json_parsed[3];
           s4=json_parsed[4];
           s5=json_parsed[5];
           //alert(s0 + s1 + s2 + s3 + s4 + s5);
           createviewTblDC(s0,s1,s3,s4,s2,s5);

        }
    });

}
function addDrugDC1(){
    //document.getElementById("drugTypeDC").value=123;
    document.getElementById("imgid").style.visibility = "visible";
     

    var drugName  = $("#drugNameDropDownDC option:selected").text();
     
   
    var drugType  = document.getElementById("drugTypeDC").value;
    var remarks   = document.getElementById("remarksValueDC").value;
    var price     = document.getElementById("priceValueDC").value;
      
   
    var drugReorder  = document.getElementById("reorderValueDC").value;
    var drugDanger  = document.getElementById("dangerValueDC").value;
     
  
    var priceError  = $("#priceerror").text();
    var reorderError  = $("#reordererror").text();
    var dangerError  = $("#dangererror").text();
     
    
    if(drugName.length==0 || price.length==0 || drugReorder.length==0 || drugDanger.length==0)
    {
        alert("Please Fill all the Fields");
        document.getElementById("imgid").style.visibility = "hidden";
    }
    else if(priceError.length != 0 || dangerError.length != 0 || reorderError.length != 0)
    {
        alert("Some Fields are Invalid!!!");
        document.getElementById("imgid").style.visibility = "hidden";
    }
    else
    {
        var r=confirm("Are you sure you want to update the following data ?");
        if(r==true)
        {
    $.ajax({
           url: baseUrl+'/index.php/Drug_Controller/addDrug',
            type: 'POST',
            crossDomain: true,
            data: {"drugName":drugName, "drugType":drugType,
                   "remarks":remarks,"price":price, "drugReorder":drugReorder,"drugDanger":drugDanger },
            success: function(data) {
                data = trimData(data);
                 alert(data);
                 document.getElementById("imgid").style.visibility = "hidden";
                 $("#remarksValueDC").val("");
                 document.getElementById('SucMsg').innerHTML = data;
                 

           }
         });
        }
        else{
            alert("Update Canceled!!! (jqdc addrugdc1)");
            document.getElementById("imgid").style.visibility = "hidden";
        }
        
    }
}

function getDrugDetailsToViewDC() {

    //document.getElementById("post_requestDetails_tbl_RC").style.visibility = "visible";
    $.ajax({
        url: baseUrl+'/index.php/Drug_Controller/getDrugOrderDetails',
        type: 'POST',
        crossDomain: true,
        //data: {"myOrderString": myOrderString},  // fix: need to append your data to the call
        success: function (data) {
            data = trimData(data);
           var json_parsed = $.parseJSON(data);
           createDrugDetailsViewTblDC(json_parsed);      
        }
    });
    
}
function createDrugDetailsViewTblDC(json){

        //s0=json[0]['drugs']['dName'];
         
        //alert(json);
//    $sr_globe = sr;
    var pagecontent = "";
//
    pagecontent = "<table class=table1 id=pagetable>";
    pagecontent += "<thead>";
    pagecontent += "<tr>";
    pagecontent += "<th>Drug ID</th>";
    pagecontent += "<th>Drug Name</th>";
    pagecontent += "<th>Unit Type</th>";
    pagecontent += "<th>Drug Quantity</th>";
    pagecontent += "<th>ReOrder Quantity</th>";
    pagecontent += "<th>Danger Level Quantity</th>";
    pagecontent += "</tr>";
    pagecontent += "</thead>";
    pagecontent += "<tbody>";
    
    var i=1;
    $.each(json, function(index,el) {
            // el = object in array
            // access attributes: el.Id, el.Name, etc
            //alert(el.drugs.dName);

    pagecontent += "<tr>";
    pagecontent += "<td>"+el.dSrNo+"</td>";
    pagecontent += "<td>"+el.dName+"</td>";
    pagecontent += "<td>"+el.dUnit+"</td>";
    if(parseInt(el.dQty) <= parseInt(el.statusDanger))
    {
        pagecontent += "<td style=color:red>"+el.dQty+"</td>";
    }
    else if(parseInt(el.dQty) <= parseInt(el.statusReOrder))
    {
        pagecontent += "<td style=color:orange>"+el.dQty+"</td>";
    }
    pagecontent += "<td>"+el.statusReOrder+"</td>";
    pagecontent += "<td>"+el.statusDanger+"</td>";
    
    
    pagecontent += "</tr>";
//
//disabled="true" document.getElementById("checkemail").disabled=true;
//
      
//
        });
//
    pagecontent += "</tbody>";
    pagecontent += "</table>";
    

   document.getElementById("tablespaceDC").innerHTML = pagecontent;
   //cat_val_chckd = $("#pagetable #reqid1").text();
   //alert(cat_val_chckd);
   //getAllRequestDC();
}



