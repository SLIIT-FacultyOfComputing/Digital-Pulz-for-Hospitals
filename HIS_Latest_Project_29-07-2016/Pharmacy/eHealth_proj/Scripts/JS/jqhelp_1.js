/*
 ------------------------------------------------------------------------------------------------------------------------
 DiPMIMS - Digital Pulz Medical Information Management System
 Copyright (c) 2017 Sri Lanka Institute of Information Technology
 <http: http://his.sliit.lk />
 ------------------------------------------------------------------------------------------------------------------------
 */
var baseUrl="http://localhost/eHealth_proj";
function getList() {
    $.ajax({
        url: baseUrl+'/index.php/Drug_controller/uprocess',
        type: 'POST',
        //dataType:   "jsonp",
        crossDomain: true,
        success: function(data) {
            
//            alert(data);
             var json_parsed = $.parseJSON(data);
//           alert(json_parsed[1]);
//           var x = { "Item1" : 1, "Item2" : { "Item3" : 3 }};
//           var stringified = JSON.stringify(data, undefined, 2);

// *            var objectified = $.parseJSON(json_parsed);
             
//            alert(stringified);
//            alert(objectified[1]);
//            alert(JSON.stringify(objectified, undefined, 2));
//            var headline = $(res).find('a.tsh').text();
//            alert(data);
//            var json_parsed = $.getJSON(data);
//            
//            alert(json_parsed);
//            
//            for (var key in json_parsed){
//                 alert(key);
//                 }
//                     
//            var arr = json_parsed.d_names;
//            var arr = ["name","media"];
//            alert(json_parsed[1]);
            for (var i = 0; i < json_parsed.length; i++) {

                // document.getElementById("d_name").value  += arr[i];
                //$('#dropdown').append(data);
                var newOption = $('<option>');
                newOption.attr('value', json_parsed[i]).text(json_parsed[i]);
                $('#dropdown').append(newOption);
                // Do something with element i.

            }

        }
    });

}

function getList() {
    $.ajax({
        url: baseUrl+'/index.php/Drug_controller/uprocess',
        type: 'POST',
        crossDomain: true,
        success: function(data) {

            var json_parsed = $.parseJSON(data);
// *            var objectified = $.parseJSON(json_parsed);

            for (var i = 0; i < json_parsed.length; i++) {
                var newOption = $('<option>');
                newOption.attr('value', json_parsed[i]).text(json_parsed[i]);
                $('#dropdown').append(newOption);
            }

        }
    });

}

function CreateTable()
{
    var tablecontents = "";
    tablecontents = "<table class=table1>";
    tablecontents += "<thead>";
    tablecontents += "<tr>";
    tablecontents += "<th>Name</th>";
    tablecontents += "<th>Quantitiy</th>";
    tablecontents += "<th>Dosage</th>";
    tablecontents += "<th>Trequency</th>";
    tablecontents += "</tr>";
    tablecontents += "</thead>";
    tablecontents += "<tbody>";
    for (var i = 0; i < 5; i++)
    {
        tablecontents += "<tr>";
        tablecontents += "<td>" + i + "</td>";
        tablecontents += "<td>" + i * 100 + "</td>";
        tablecontents += "<td>" + i * 1000 + "</td>";
        tablecontents += "</tr>";
    }
    tablecontents += "</tbody>";
    tablecontents += "</table>";
    document.getElementById("tablespace").innerHTML = tablecontents;
}

function gettable() {
    
    var val;
    val = $("#dropdown option:selected").text();
    $.ajax({
        url: baseUrl+'/index.php/Drug_controller/tablerocess/'+val,
        type: 'POST',
        crossDomain: true,
        success: function(data) {

            var json_parsed = $.parseJSON(data);
          //  var arr = json_parsed.d_names;
          //  var arr1 = json_parsed.d_qty;
          //  var arr2 = json_parsed.d_dos;
          //  var arr3 = json_parsed.d_fre;
            var j=1;

            var tablecontents = "";
            tablecontents = "<table class=table1 id=tablecontent>";
            tablecontents += "<thead>";
            tablecontents += "<tr>";
            tablecontents += "<th>Name</th>";
           // tablecontents += "<th>Quantity</th>";
           // tablecontents += "<th>Dosage</a></th>";
           // tablecontents += "<th>Frequency</th>";
            tablecontents += "<th>Edit</th>";
            tablecontents += "<th>View</th>";            
            tablecontents += "<th>Delete</th>";
            tablecontents += "</tr>";
            tablecontents += "</thead>";
            tablecontents += "<tbody>";

            for (var i = 0; i < json_parsed.length; i++) {


                tablecontents += "<tr  value="+"lol"+">";
                tablecontents += "<td id=" + "asprin" + ">" + json_parsed[i] + "</td>";
               // tablecontents += "<td>" + arr1[i] + "</td>";
               // tablecontents += "<td>" + arr2[i] + "</td>";
               // tablecontents += "<td>" + arr3[i] + "</td>";
                tablecontents += "<td onclick=getData("+j+")>" + "<a href='#'>" + "Edit" + "</a></td>";
                tablecontents += "<td onclick=getViewData("+j+")>" + "<a href='#'>" + "View" + "</a></td>";                
                tablecontents += "<td onclick=test_onclick()>" + "<a href='#'>" + "Delete" + "</a></td>";
                tablecontents += "</tr>";
                
                j++;

            }
            tablecontents += "</tbody>";
            tablecontents += "</table>";
            document.getElementById("tablespace").innerHTML = tablecontents;
        }
    });
}


function getData(_row) {

    var texto;
    var test4= new String(_row);
    $d_name = test4;
    

        $('#tablecontent tr td').each(function(){
         // var texto = $(this).text();
         texto  = $("#tablecontent tr:nth-child("+_row+") td:nth-child(1)").text()
          
    });
    
   // alert(texto);
  //  test_onclick();


    var myOrderString = texto;
    alert(myOrderString);
    $.ajax({
        url: baseUrl+'/index.php/Drug_controller/UpdateValues',
        type: 'POST',
        crossDomain: true,
        data: {"myOrderString": myOrderString},  // fix: need to append your data to the call
        success: function (data) {
           // alert(data);
           // $('#freq').append(data);
           var json_parsed = $.parseJSON(data);
           var s1,s2,s3,s4,s5,s6,s0;
           s0=json_parsed[0];
           s1=json_parsed[1];
           s2=json_parsed[2];
           s3=json_parsed[3];
           s4=json_parsed[4];
           s5=json_parsed[5];
           s6=json_parsed[6];
          // var S2='gg';
          alert(s6);
            create_druginfo(s0,s1,s2,s3,s4,s5,s6);
            
        }
    });
    
}

function getViewData(_row) {

    var texto;
    var test4= new String(_row);
    

        $('#tablecontent tr td').each(function(){
         texto  = $("#tablecontent tr:nth-child("+_row+") td:nth-child(1)").text()
          
    });
    
    var myOrderString = texto;
    alert(myOrderString);
    $.ajax({
        url: baseUrl+'/index.php/Drug_controller/UpdateValues',
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
          alert(s6);
            create_viewTable(s0,s1,s2,s3,s4,s5,s6);
            
        }
    });
    
}


function getDataAfterEdit(_row) {

    var texto;
    var test4= new String(_row);
    

        $('#tablecontent tr td').each(function(){
         texto  = $("#tablecontent tr:nth-child("+_row+") td:nth-child(1)").text()
          
    });
    
    var myOrderString = texto;
    alert(myOrderString);
    $.ajax({
        url: baseUrl+'/index.php/Drug_controller/UpdateValues',
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
            create_viewTable(s0,s1,s2,s3,s4,s5,s6);
            
        }
    });
    
}

function create_druginfo($0,$1,$2,$3,$4,$5,$6){

$sr = $0;
    var pagecontent = "";

    pagecontent = "<table class=table1 id=pagetable>";
    pagecontent += "<thead>";
    pagecontent += "<tr>";
    pagecontent += "<th>Drug Details</th>";
    pagecontent += "<th>Values to the date</th>";
    pagecontent += "<th>New values</th>";
    pagecontent += "<th>Select to update</th>";
    pagecontent += "</tr>";
    pagecontent += "</thead>";
    pagecontent += "<tbody>";
    
    pagecontent += "<tr>";
    pagecontent += "<td>SR No</td>";
    pagecontent += "<td name=sr_val id=sr_val value="+$0+">"+$0+"</td>";
    pagecontent += "<td></td>";
    pagecontent +="<td></td>";    
    pagecontent += "</tr>";
    
    pagecontent += "<tr>";
    pagecontent += "<td>Category</td>";
    pagecontent += "<td>"+$1+"</td>";
    pagecontent += "<td><input type=text name=cat_val id=cat_val /></td>";
    pagecontent +="<td><input type=checkbox name=chk_cat_val id=chk_cat_val /></td>";
    pagecontent += "</tr>";

    pagecontent += "<tr>";
    pagecontent += "<td>Name</td>";
    pagecontent += "<td>"+$2+"</td>";
    pagecontent += "<td><input type=text name=nam_val id=nam_val /></td>";
    pagecontent +="<td><input type=checkbox name=chk_nam_val id=chk_nam_val /></td>";
    pagecontent += "</tr>";

    pagecontent += "<tr>";
    pagecontent += "<td>Create User</td>";
    pagecontent += "<td>"+$3+"</td>";
    pagecontent += "<td></td>";
    pagecontent +="<td></td>";
    pagecontent += "</tr>";
    
    pagecontent += "<tr>";
    pagecontent += "<td>Last Updated</td>";
    pagecontent += "<td>"+$4+"</td>";
    pagecontent += "<td></td>";
    pagecontent +="<td></td>";
    pagecontent += "</tr>";
    
    pagecontent += "<tr>";
    pagecontent += "<td>Price</td>";
    pagecontent += "<td>"+$5+"</td>";
    pagecontent += "<td><input type=text name=price_val id=price_val /></td>";
    pagecontent +="<td><input type=checkbox name=chk_price_val id=chk_price_val /></td>";
    pagecontent += "</tr>";
    
    pagecontent += "<tr>";
    pagecontent += "<td>Quantity</td>";
    pagecontent += "<td>"+$6+"</td>";
    pagecontent += "<td><input type=text name=qty_val id=qty_val /></td>";
    pagecontent +="<td><input type=checkbox name=chk_qty_val id=chk_qty_val /></td>";
    pagecontent += "</tr>";
    
    pagecontent += "</tbody>";
    pagecontent += "</table>";
    
    //cat_val1 = $("#cat_val").text();
    
    pagecontent += "<input type=submit name=update id=update value=Update onclick=getAllData()>";
    document.getElementById("pagespace").innerHTML = pagecontent;
}

function create_viewTable($0,$1,$2,$3,$4,$5,$6){

$sr = $0;
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
    pagecontent += "<td name=sr_val id=sr_val value="+$0+">"+$0+"</td>";   
    pagecontent += "</tr>";
    
    pagecontent += "<tr>";
    pagecontent += "<td>Category</td>";
    pagecontent += "<td>"+$1+"</td>";
    pagecontent += "</tr>";

    pagecontent += "<tr>";
    pagecontent += "<td>Name</td>";
    pagecontent += "<td>"+$2+"</td>";
    pagecontent += "</tr>";

    pagecontent += "<tr>";
    pagecontent += "<td>Create User</td>";
    pagecontent += "<td>"+$3+"</td>";
    pagecontent += "</tr>";
    
    pagecontent += "<tr>";
    pagecontent += "<td>Last Updated</td>";
    pagecontent += "<td>"+$4+"</td>";    
    pagecontent += "</tr>";
    
    pagecontent += "<tr>";
    pagecontent += "<td>Price</td>";
    pagecontent += "<td>"+$5+"</td>";
    pagecontent += "</tr>";
    
    pagecontent += "<tr>";
    pagecontent += "<td>Quantity</td>";
    pagecontent += "<td>"+$6+"</td>";
    pagecontent += "</tr>";
    
    pagecontent += "</tbody>";
    pagecontent += "</table>";
    

    
   document.getElementById("pagespace").innerHTML = pagecontent;
}

function getAllData() {

var cat_val_chckd,nam_val_chckd,user_val_chckd,price_val_chckd,qty_va_chckd;


if ($('#chk_cat_val').is(":checked")){
   cat_val_chckd = $("#cat_val").val();
}
else{
    cat_val_chckd='null';
}
if ($('#chk_nam_val').is(":checked")){
   nam_val_chckd = $("#nam_val").val();
}
else{
    nam_val_chckd='null';
}

if ($('#chk_price_val').is(":checked")){
   price_val_chckd = $("#price_val").val();
}
else{
    price_val_chckd='-1';
}

if ($('#chk_qty_val').is(":checked")){
   qty_va_chckd = $("#qty_val").val();
}
else{
    qty_va_chckd='-1';
}



    $.ajax({
        url: baseUrl+'/index.php/Drug_controller/updateDrug',
        type: 'POST',
        crossDomain: true,
        data: {"dsr":$sr ,"dcat":cat_val_chckd , "dname":nam_val_chckd ,"dprice":price_val_chckd,"dqty":qty_va_chckd},
        success: function (data) {
        getDataAfterEdit($d_name);

        
        }
    });
   
}

function test_onclick() {
alert('row1');
}

function sample(){
   $val = $("#dropdown option:selected").text();
    alert($val);
}

//function paging(page_num){
//
//    //how much items per page to show
//    var show_per_page = 5;
//    //getting the amount of elements inside content div
//    var number_of_items = page_num;
//    //calculate the number of pages we are going to have
//    var number_of_pages = Math.ceil(number_of_items/show_per_page);
//
//    //set the value of our hidden input fields
//    $("#current_page").val(0) ;
//    $("#show_per_page").val(show_per_page);
//
//
//    //now when we got all we need for the navigation let's make it '
//
//    /*
//    what are we going to have in the navigation?
//        - link to previous page
//        - links to specific pages
//        - link to next page
//    */
//    var navigation_html = '<a class="previous_link" href="javascript:previous();">Prev</a>';
//    var current_link = 0;
//    while(number_of_pages > current_link){
//        navigation_html += '<a class="page_link" href="javascript:go_to_page(' + current_link +')" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>';
//        current_link++;
//    }
//    navigation_html += '<a class="next_link" href="javascript:next();">Next</a>';
//
//    $("#page_navigation").html(navigation_html);
//
//    //add active_page class to the first page link
//    $("#page_navigation .page_link:first").addClass('active_page');
//
//    //hide all the elements inside content div
//    $("#tablespace").css('display', 'none');
//
//    //and show the first n (show_per_page) elements
//    $("#tablespace").show(0,3).css('display', 'block');
//
////    selectedCell = $("#row0").eq(0).text()
////    alert(selectedCell);
////    var tr = $("#tablespace").find("tbody tr").eq(1).children().first();
////
////    alert(tr[0]);
////    $("#tablespace tr").each(function() {
////       alert($(this).attr("row0")); //trying to alert id of the clicked row
////     });
//
//};
//
//function previous(){
//
//    var p_page_val = $("#current_page").val();
//    var p_new_page = parseInt(p_page_val) - 1;
//    alert(p_new_page);
//    //if there is an item before the current active link run the function
//    if($(".active_page").prev(".page_link").length==true){
//        go_to_page(p_new_page);
//    }
//
//}
//
//function next(){
//    var n_page_val = $("#current_page").val();
//    var n_new_page = parseInt(n_page_val) + 1;
//    alert(n_new_page);
//    //if there is an item after the current active link run the function
//    if($(".active_page").next(".page_link").length==true){
//        go_to_page(n_new_page);
//    }
//
//}
//function go_to_page(page_num){
//    var g_page_val = $("#show_per_page").val();
//    //get the number of items shown per page
//    var show_per_page = parseInt(g_page_val);
//
//    //get the element number where to start the slice from
//    start_from = page_num * show_per_page;
//
//    //get the element number where to end the slice
//    end_on = start_from + show_per_page;
//
//    //hide all children elements of content div, get specific items and show them
//    $("#tablespace").css('display', 'none');
//
//    $("#tablespace").slice(start_from, end_on).css('display', 'block');
//
//    /*get the page link that has longdesc attribute of the current page and add active_page class to it
//    and remove that class from previously active page link*/
//    $(".page_link[longdesc=" + page_num +"]").addClass("active_page").siblings(".active_page").removeClass("active_page");
//
//    //update the current page input field
//    $("#current_page").val(page_num);
//
//}
//
//function CreateTable()
//{
//    var tablecontents = "";
//    tablecontents = "<table class=table1>";
//    tablecontents += "<thead>";
//    tablecontents += "<tr>";
//    tablecontents += "<th>Name</th>";
//    tablecontents += "<th>Quantitiy</th>";
//    tablecontents += "<th>Dosage</th>";
//    tablecontents += "<th>Trequency</th>";
//    tablecontents += "</tr>";
//    tablecontents += "</thead>";
//    tablecontents += "<tbody>";
//    for (var i = 0; i < 5; i++)
//    {
//        tablecontents += "<tr>";
//        tablecontents += "<td>" + i + "</td>";
//        tablecontents += "<td>" + i * 100 + "</td>";
//        tablecontents += "<td>" + i * 1000 + "</td>";
//        tablecontents += "</tr>";
//    }
//    tablecontents += "</tbody>";
//    tablecontents += "</table>";
//    document.getElementById("tablespace").innerHTML = tablecontents;
//}
