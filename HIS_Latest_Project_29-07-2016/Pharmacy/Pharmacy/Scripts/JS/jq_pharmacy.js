/*
 ------------------------------------------------------------------------------------------------------------------------
 DiPMIMS - Digital Pulz Medical Information Management System
 Copyright (c) 2017 Sri Lanka Institute of Information Technology
 <http: http://his.sliit.lk />
 ------------------------------------------------------------------------------------------------------------------------
 */
var baseUrl="http://localhost/Pharmacy";
//Drug controller
function getCategoryListDC() {
    $.ajax({
        url: baseUrl+'/index.php/Drug_Controller/getCatList',
        type: 'POST',
        crossDomain: true,
        success: function(data) {
            var json_parsed = $.parseJSON(data);
            for (var i = 0; i < json_parsed.length; i++) {
                var newOption = $('<option>');
                newOption.attr('value', json_parsed[i]['dCategory']).text(json_parsed[i]['dCategory']);
                $('#categoryDropDownDC').append(newOption);
            }


        }
    });

}

function getDrugByCategoryDC(){


     document.getElementById("post_drugName_dd_DC").style.visibility = "visible";
     document.getElementById("post_drugOption_tbl_DC").style.visibility = "hidden";
     document.getElementById("post_drugDetails_tbl_DC").style.visibility = "hidden";

     var drugName_ddcontents = "";
         drugName_ddcontents += "Drug Name :  <select id=drugNameDropDownDC name=drugNameDropDownDC >";
         drugName_ddcontents += "<option value=default selected=selected>Select</option>";
         drugName_ddcontents += "</select>";
         drugName_ddcontents += "<br></br>";
         drugName_ddcontents += "<input type=submit value=search onclick=createDrugOptiontableDC() />";

     document.getElementById("drugspaceDC").innerHTML = drugName_ddcontents;

    var val;
    val = $("#categoryDropDownDC option:selected").text();
    $.ajax({
        url: baseUrl+'/index.php/Drug_Controller/getDrugList/'+val,
        type: 'POST',
        crossDomain: true,
                success: function(data) {

            var json_parsed = $.parseJSON(data);
            for (var i = 0; i < json_parsed.length; i++) {
                var newOption = $('<option>');
                newOption.attr('value', json_parsed[i]['dName']).text(json_parsed[i]['dName']);
                $('#drugNameDropDownDC').append(newOption);
                 }
            }
    });
}
function createDrugOptiontableDC() {

    document.getElementById("post_drugOption_tbl_DC").style.visibility = "visible";
    document.getElementById("post_drugDetails_tbl_DC").style.visibility = "hidden";
    var val;
    val = $("#drugNameDropDownDC option:selected").text();
            var j=1;
            var tablecontents = "";
            
            tablecontents = "<table class=table1 id=tablecontent>";
            tablecontents += "<thead>";
            tablecontents += "<tr>";
            tablecontents += "<th>Name</th>";
            tablecontents += "<th>Edit</th>";
            tablecontents += "<th>View</th>";            
            tablecontents += "<th>Delete</th>";
            tablecontents += "</tr>";
            tablecontents += "</thead>";
            tablecontents += "<tbody>";

            tablecontents += "<tr>";
            tablecontents += "<td>" + val + "</td>";
            tablecontents += "<td onclick=getDataToEditDC("+j+")>" + "<a href='#detailsPost'>" + "Edit" + "</a></td>";
            tablecontents += "<td onclick=getDataToViewDC("+j+")>" + "<a href='#detailsPost'>" + "View" + "</a></td>";
            tablecontents += "<td onclick=test_onclick()>" + "<a href='#'>" + "Delete" + "</a></td>";
            tablecontents += "</tr>";

            tablecontents += "</tbody>";
            tablecontents += "</table>";
            document.getElementById("tablespaceDC").innerHTML = tablecontents;

}


function getDataToEditDC(rowNumber) {

    document.getElementById("post_drugDetails_tbl_DC").style.visibility = "visible";
    $row_Number = rowNumber;
    var drugNameFromColumn;
    
    $('#tablecontent tr td').each(function(){
         drugNameFromColumn  = $("#tablecontent tr:nth-child("+rowNumber+") td:nth-child(1)").text()
          
         });

    var myOrderString = drugNameFromColumn;
    
    $.ajax({
        url: baseUrl+'/index.php/Drug_Controller/getDrugDetails',
        type: 'POST',
        crossDomain: true,
        data: {"myOrderString": myOrderString},  // fix: need to append your data to the call
        success: function (data) {

           var json_parsed = $.parseJSON(data);
           var s1,s2,s3,s4,s5,s6,s0;
           s0=json_parsed[0];
           s1=json_parsed[1];
           s2=json_parsed[2];
           s3=json_parsed[3];
           s4=json_parsed[4];
           s5=json_parsed[5];
           s6=json_parsed[6];
           createDrugUpdateTblDC(s0,s1,s2,s3,s4,s5,s6);
            
        }
    });
    
}

function getDataToViewDC(rowNumber) {

    document.getElementById("post_drugDetails_tbl_DC").style.visibility = "visible";
    var drugNameFromColumn;

    $('#tablecontent tr td').each(function(){
         drugNameFromColumn  = $("#tablecontent tr:nth-child("+rowNumber+") td:nth-child(1)").text()
          
      });
    
    var myOrderString = drugNameFromColumn;

    $.ajax({
        url: baseUrl+'/index.php/Drug_Controller/getDrugDetails',
        type: 'POST',
        crossDomain: true,
        data: {"myOrderString": myOrderString},  // fix: need to append your data to the call
        success: function (data) {
           var json_parsed = $.parseJSON(data);
           var s1,s2,s3,s4,s5,s6,s0;
           s0=json_parsed[0];
           s1=json_parsed[1];
           s2=json_parsed[2];
           s3=json_parsed[3];
           s4=json_parsed[4];
           s5=json_parsed[5];
           s6=json_parsed[6];
           createviewTblDC(s0,s1,s2,s3,s4,s5,s6);
            
        }
    });
    
}

function createviewTblDC(sr,category,name,createUser,LastUpdated,price,quantity){

    $sr_globe = sr;
    var pagecontent = "";

    pagecontent = "<table class=table1 id=pagetable>";
    pagecontent += "<thead>";
    pagecontent += "<tr>";
    pagecontent += "<th>Drug Details</th>";
    pagecontent += "<th>Values to the date</th>";
    pagecontent += "</tr>";
    pagecontent += "</thead>";
    pagecontent += "<tbody>";

    pagecontent += "<tr>";
    pagecontent += "<td>SR No</td>";
    pagecontent += "<td name=sr_val id=sr_val >"+sr+"</td>";
    pagecontent += "</tr>";

    pagecontent += "<tr>";
    pagecontent += "<td>Category</td>";
    pagecontent += "<td>"+category+"</td>";
    pagecontent += "</tr>";

    pagecontent += "<tr>";
    pagecontent += "<td>Name</td>";
    pagecontent += "<td>"+name+"</td>";
    pagecontent += "</tr>";

    pagecontent += "<tr>";
    pagecontent += "<td>Create User</td>";
    pagecontent += "<td>"+createUser+"</td>";
    pagecontent += "</tr>";

    pagecontent += "<tr>";
    pagecontent += "<td>Last Updated</td>";
    pagecontent += "<td>"+LastUpdated+"</td>";
    pagecontent += "</tr>";

    pagecontent += "<tr>";
    pagecontent += "<td>Price</td>";
    pagecontent += "<td>"+price+"</td>";
    pagecontent += "</tr>";

    pagecontent += "<tr>";
    pagecontent += "<td>Quantity</td>";
    pagecontent += "<td>"+quantity+"</td>";
    pagecontent += "</tr>";

    pagecontent += "</tbody>";
    pagecontent += "</table>";



   document.getElementById("pagespaceDC").innerHTML = pagecontent;
}

function createDrugUpdateTblDC(sr,category,name,createUser,LastUpdated,price,quantity){

    $sr_globe = sr;
    var pagecontent = "";

    pagecontent = "<table class=table1 id=pagetable>";
    pagecontent += "<thead>";
    pagecontent += "<tr>";
    pagecontent += "<th>Drug Details</th>";
    pagecontent += "<th>Values to the date</th>";
    pagecontent += "<th>Edited values</th>";
    pagecontent += "<th>Select to update</th>";
    pagecontent += "</tr>";
    pagecontent += "</thead>";
    pagecontent += "<tbody>";
    
    pagecontent += "<tr>";
    pagecontent += "<td>Category</td>";
    pagecontent += "<td>"+category+"</td>";
    pagecontent += "<td><input type=text name=categoryValueDC id=categoryValueDC /></td>";
    pagecontent +="<td><input type=checkbox name=chkCategoryValueDC id=chkCategoryValueDC /></td>";
    pagecontent += "</tr>";

    pagecontent += "<tr>";
    pagecontent += "<td>Name</td>";
    pagecontent += "<td>"+name+"</td>";
    pagecontent += "<td><input type=text name=nameValueDC id=nameValueDC /></td>";
    pagecontent +="<td><input type=checkbox name=chkNameValueDC id=chkNameValueDC /></td>";
    pagecontent += "</tr>";
    
    pagecontent += "<tr>";
    pagecontent += "<td>Price</td>";
    pagecontent += "<td>"+price+"</td>";
    pagecontent += "<td><input type=text name=priceValueDC id=priceValueDC /></td>";
    pagecontent +="<td><input type=checkbox name=chkPriceValueDC id=chkPriceValueDC /></td>";
    pagecontent += "</tr>";
    
    pagecontent += "<tr>";
    pagecontent += "<td>Quantity</td>";
    pagecontent += "<td>"+quantity+"</td>";
    pagecontent += "<td><input type=text name=quantityValueDC id=quantityValueDC /></td>";
    pagecontent +="<td><input type=checkbox name=chkQuantityValueDC id=chkQuantityValueDC /></td>";
    pagecontent += "</tr>";
    
    pagecontent += "</tbody>";
    pagecontent += "</table>";

    pagecontent += "<input type=submit value=Update onclick=getAllDataDC()>";
    document.getElementById("pagespaceDC").innerHTML = pagecontent;
}


function getAllDataDC() {

var cat_val_chckd,nam_val_chckd,user_val_chckd,price_val_chckd,qty_va_chckd;
var countOfUpdateValues = 0;

if ($('#chkCategoryValueDC').is(":checked")){
   cat_val_chckd = $("#categoryValueDC").val();
   countOfUpdateValues++;
}
else{
    cat_val_chckd='null';
}
if ($('#chkNameValueDC').is(":checked")){
   nam_val_chckd = $("#nameValueDC").val();
   countOfUpdateValues++;
}
else{
    nam_val_chckd='null';
}

if ($('#chkPriceValueDC').is(":checked")){
   price_val_chckd = $("#priceValueDC").val();
   countOfUpdateValues++;
}
else{
    price_val_chckd='-1';
}

if ($('#chkQuantityValueDC').is(":checked")){
   qty_va_chckd = $("#quantityValueDC").val();
   countOfUpdateValues++;
}
else{
    qty_va_chckd='-1';
}
if(countOfUpdateValues>0)
    {
$.ajax({
        url: baseUrl+'/index.php/Drug_Controller/updateDrug',
        type: 'POST',
        crossDomain: true,
        data: {"dsr":$sr_globe ,"dcat":cat_val_chckd , "dname":nam_val_chckd ,"dprice":price_val_chckd,"dqty":qty_va_chckd},
        success: function (data) {
        getDataAfterEditDC(1);
        
        }
    });
    }
else{
    alert('please select atleast one value to update');
}
}

function getDataAfterEditDC(rowNumber) {

    var drugNameFromColumn;

        $('#tablecontent tr td').each(function(){
         drugNameFromColumn  = $("#tablecontent tr:nth-child("+rowNumber+") td:nth-child(1)").text()

    });

    var myOrderString = drugNameFromColumn;

    $.ajax({
        url: baseUrl+'/index.php/Drug_Controller/getDrugDetails',
        type: 'POST',
        crossDomain: true,
        data: {"myOrderString": myOrderString},  
        success: function (data) {
           var json_parsed = $.parseJSON(data);
           var s1,s2,s3,s4,s5,s6,s0;
           s0=json_parsed[0];
           s1=json_parsed[1];
           s2=json_parsed[2];
           s3=json_parsed[3];
           s4=json_parsed[4];
           s5=json_parsed[5];
           s6=json_parsed[6];
           createviewTblDC(s0,s1,s2,s3,s4,s5,s6);

        }
    });

}
function addDrugDC(){

    var drugName  = document.getElementById("drugNameValueDC").value;
    var drugCat   = $("#categoryDropDownDC option:selected").text();
    var drugType  = $("#drugTypeDropDownDC option:selected").text();
    var remarks   = document.getElementById("remarksValueDC").value;
    var price     = document.getElementById("priceValueDC").value;
    
    if(drugName.length==0 || remarks.length==0 || price.length==0)
    {
        alert("Please Fill all the Fields");
    }
    else
    {
    $.ajax({
            url: baseUrl+'/index.php/Drug_Controller/addDrug',
            type: 'POST',
            crossDomain: true,
            data: {"drugName":drugName ,"drugCat":drugCat,"drugType":drugType,
                   "remarks":remarks,"price":price},
            success: function(data) {
                 alert(data);
                                 }
         });
    }
}

// User controller
function userLogin(){
var userName = document.getElementById("userNameValue").value;
var password = document.getElementById("passwordValue").value;

    $.ajax({
        url: baseUrl+'/index.php/User_Controller/authenticate',
        type: 'POST',
        crossDomain: true,
        data: {"userName":userName ,"password":password},
        success: function(data) {
                alert(data);
                 var json_parsed   = $.parseJSON(data);
                 var $userID       = json_parsed[0]['userID'];
                 var $userName     = json_parsed[0]['userName'];
                 var $userRoleID   = json_parsed[0]['userRoles']['userRoleID'];
                 var $userRoleName = json_parsed[0]['userRoles']['userRoleName'];
                 createSessionUC($userID,$userName,$userRoleID,$userRoleName);
        }
    });
}

function createSessionUC(userID,userName,userRoleID,userRoleName)
{
        $.ajax({
        url: baseUrl+'/index.php/User_Controller/createSession',
        type: 'POST',
        crossDomain: true,
        data: {"userID":userID ,"userName":userName,"userRoleID":userRoleID,"userRoleName":userRoleName},
        success: function(data) {
                   alert(data);
                   window.location = baseUrl+'/eHealth_proj/index.php/User_Controller/homeView';
                   }
    });
}

function addPharmacist(){

    var title       = $("#titleDropDown option:selected").text();
    var firstName   = document.getElementById("firstNameValue").value;
    var lastName    = document.getElementById("lastNameValue").value;
    var nic         = document.getElementById("nicValue").value;
    var dob         = document.getElementById("dobValue").value;
    var civilStatus = $("#civilStatusDropDown option:selected").text();
    var gender      = $("#genderDropDown option:selected").text();
    var userGroup   = $("#userGroupDropDown option:selected").text();
    var userDep     = $("#userDepDropDown option:selected").text();
    var userName    = document.getElementById("userNameValue").value;
    var password    = document.getElementById("passwordValue").value;
    var street      = document.getElementById("streetValue").value;
    var division    = document.getElementById("divisionValue").value;
    var district    = document.getElementById("districtValue").value;

    $.ajax({
            url: baseUrl+'/index.php/User_Controller/addUser',
            type: 'POST',
            crossDomain: true,
            data: {"title":title ,"firstName":firstName,"lastName":lastName,"nic":nic,"dob":dob,"civilStatus":civilStatus,
                   "gender":gender,"userGroup":userGroup,"userDep":userDep,"userName":userName,"password":password,
                   "street":street,"division":division,"district":district},
            success: function(data) {
                 alert(data);
                                 }
         });
//                        if (firstName==null || firstName=="")
//                        {
//                            alert("First name must be filled out");
//                            check = "false";
//                        }
//                        else if (lastName==null || lastName=="")
//                        {
//                            alert("Last name must be filled out");
//                            check =  "false";
//                        }
//                        else if (nic==null || nic=="")
//                        {
//                            alert("NIC must be filled out");
//                            check =  "false";
//                        }
//                        else if (dob==null || dob=="")
//                        {
//                            alert("Date of Birth must be filled out");
//                            check =  "false";
//                        }
//                        else if (userName==null || userName=="")
//                        {
//                            alert("Username must be filled out");
//                            check =  "false";
//                        }
//                        else if (password==null || password=="")
//                        {
//                            alert("Password must be filled out");
//                            check =  "false";
//                        }
//                        else if (street==null || street=="")
//                        {
//                            alert("Street must be filled out");
//                            check =  "false";
//                        }
//                        else if (division==null || division=="")
//                        {
//                            alert("Division must be filled out");
//                            check =  "false";
//                        }
//                        else if (district==null || district=="")
//                        {
//                            alert("District must be filled out");
//                            check =  "false";
//                        }
//                        else if (nic.length != 10 || (nic.charAt(9)!='V' && nic.charAt(9)!='v' && nic.charAt(9)!='X' && nic.charAt(9)!='x') || isInteger(nic.substring(0, 9)))
//                        {
//                            alert("Invalid NIC");
//                            check =  "false";
//                        }
//                        else if (password.length < 6)
//                        {
//                            alert("Please enter a minimum of 6 characters");
//                            check =  "false";
//                        }
//                        else if (dob.length != 10 || isInteger(dob.substring(0,4))|| isInteger(dob.substring(5,7)) || isInteger(dob.substring(8,10)) || dob.charAt(4) != '/' || dob.charAt(7) != '/')
//                        {
//                            alert("Invalid Date of Birth. Correct format (yyyy/MM/dd)");
//                            check =  "false";
//                        }
}

//batch controller

function getCategoryListBC() {
    $.ajax({
        url: baseUrl+'/index.php/Batch_Controller/getCatList',
        type: 'POST',
        crossDomain: true,
        success: function(data) {
            var json_parsed = $.parseJSON(data);
            for (var i = 0; i < json_parsed.length; i++) {
                var newOption = $('<option>');
                newOption.attr('value', json_parsed[i]['dCategory']).text(json_parsed[i]['dCategory']);
                $('#categoryDropDownBC').append(newOption);
            }

        }
    });

}

function getDrugByCategoryBC(){


     document.getElementById("post_drugName_dd_BC").style.visibility = "visible";

    var val;
    val = $("#categoryDropDownBC option:selected").text();
    $.ajax({
        url: baseUrl+'/index.php/Batch_Controller/getDrugList/'+val,
        type: 'POST',
        crossDomain: true,
                success: function(data) {

            var json_parsed = $.parseJSON(data);
            for (var i = 0; i < json_parsed.length; i++) {
                var newOption = $('<option>');
                newOption.attr('value', json_parsed[i]['dName']).text(json_parsed[i]['dName']);
                $('#drugNameDropDownBC').append(newOption);
                 }
            }
    });
}

function addDrugBatchBC1(){

    var drugName         = $("#drugNameDropDownBC option:selected").text();
    var batchNo          = document.getElementById("batchNoValueBC").value;
    var quantity         = document.getElementById("quantityValueBC").value;
    var manufactureDate  = document.getElementById("manufactureDateValueBC").value;
    var expireDate       = document.getElementById("expireDateValueBC").value;


    $.ajax({
            url: baseUrl+'/index.php/Batch_Controller/addBatch',
            type: 'POST',
            crossDomain: true,
            data: {"drugName":drugName ,"batchNo":batchNo,"quantity":quantity,
                   "manufactureDate":manufactureDate,"expireDate":expireDate},
            success: function(data) {
                 alert(data);
                                 }
         });
}

function getDrugReportR() {
    
    window.location = baseUrl+'/index.php/Report_Controller/drugReport';

}


