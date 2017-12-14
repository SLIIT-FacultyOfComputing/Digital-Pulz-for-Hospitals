/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
var baseUrl="http://localhost/Pharmacy";
function getCategoryListBC() {
    $.ajax({
        url: baseUrl+'/index.php/Batch_Controller/getCatList',
        type: 'POST',
        crossDomain: true,
        success: function(data) {
	   // alert('adha');
            data = trimData(data);
            var json_parsed = $.parseJSON(data);
            for (var i = 0; i < json_parsed.length; i++) {
                var newOption = $('<option>');
                newOption.attr('value', json_parsed[i]['dCategory']).text(json_parsed[i]['dCategory']);
                $('#categoryDropDownBC').append(newOption);
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
                for (var i = 0; i < json_parsed.length; i++) {
                    var newOption = $('<option id='+json_parsed[i]['dSrNo']+'>');
                    newOption.attr('value', json_parsed[i]['dName']).text(json_parsed[i]['dName']);
                    $('#drugNameDropDownBC').append(newOption);
                     }
                     
                }
        });
       //document.getElementById("imgid").style.visibility = "hidden";

}

function getDrugByCategoryBC(){

//     var drugName_ddcontents = "";
//         drugName_ddcontents += "<select id=drugNameDropDownBC name=drugNameDropDownBC >";
//         drugName_ddcontents += "<option value=default selected=selected>Select</option>";
//         drugName_ddcontents += "</select>";
//
//     document.getElementById("drugspaceBC").innerHTML = drugName_ddcontents;
//
//     document.getElementById("post_drugName_dd_BC").style.visibility = "visible";
    //document.getElementById("imgid").style.visibility = "visible";
    $('#drugNameDropDownBC').empty();
    var val;
    val = $("#categoryDropDownBC option:selected").text();
    if (val === "All")
    {
        $.ajax({
            url: baseUrl+'/index.php/Batch_Controller/getDrugNames',
            type: 'POST',
            crossDomain: true,
                    success: function(data) {
                data = trimData(data);
                var json_parsed = $.parseJSON(data);
                for (var i = 0; i < json_parsed.length; i++) {
                    var newOption = $('<option>');
                    newOption.attr('value', json_parsed[i]['dName']).text(json_parsed[i]['dName']);
                    $('#drugNameDropDownBC').append(newOption);
                     }
                     document.getElementById("imgid").style.visibility = "hidden";
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
                    var newOption = $('<option>');
                    newOption.attr('value', json_parsed[i]['dName']).text(json_parsed[i]['dName']);
                    $('#drugNameDropDownBC').append(newOption);
                     }
                     document.getElementById("imgid").style.visibility = "hidden";
                }
        });
    }
}

function getDetailsFromCartoonsorBottles(){
    var type   = $("#typeDropDownBC option:selected").text();
    var drugName_ddcontents = "";         
    if(type === "Cartoons" || type === "Bottles")
        {
        drugName_ddcontents += "<div class='form-group form-group-sm'>";
        drugName_ddcontents += "<label class='col-sm-4 control-label' for='sm'>Content:</label>";
        drugName_ddcontents += "<div class='col-sm-6'>";
        drugName_ddcontents += "<select onchange=getContentDetails() class='form-control' id=contentTypeDropDownBC name=contentTypeDropDownBC >";
        drugName_ddcontents += "<option value=default selected=selected>Select</option>";
        drugName_ddcontents += "<option >Tablets</option>";
        drugName_ddcontents += "<option >Liquid</option>";
        drugName_ddcontents += "</select>";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "<br>";
        }
     document.getElementById("itemspaceBC").innerHTML = drugName_ddcontents;
     document.getElementById("cartoonspaceBC").innerHTML = "";
     document.getElementById("quantityspaceBC").innerHTML = "";
}
function getDetailsFromType(){
    
    var type   = $("#typeDropDownBC option:selected").text();
    var drugName_ddcontents = "";
//    alert(type);
         
    if(type === "Cartoons" || type === "Bottles")
        {
        drugName_ddcontents += "<div class='form-group form-group-sm'>";
        drugName_ddcontents += "<label class='col-sm-4 control-label' for='sm'>Content:</label>";
        drugName_ddcontents += "<div class='col-sm-6'>";
        drugName_ddcontents += "<select onchange=getContentDetails() class='form-control' id=contentTypeDropDownBC name=contentTypeDropDownBC >";
        drugName_ddcontents += "<option value=default selected=selected>Select</option>";
        drugName_ddcontents += "<option >Tablets</option>";
        drugName_ddcontents += "<option >Liquid</option>";
        drugName_ddcontents += "</select>";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "<br>";
        }
     document.getElementById("itemspaceBC").innerHTML = drugName_ddcontents;
     document.getElementById("cartoonspaceBC").innerHTML = "";
     document.getElementById("quantityspaceBC").innerHTML = "";
     
}

function getContentDetails(){
    
    var content   = $("#contentTypeDropDownBC option:selected").text();
    var type   = $("#typeDropDownBC option:selected").text();
    var drugName_ddcontents ="";
    
    if(type === "Bottles" && content==="Tablets")
    {
        drugName_ddcontents += "<div class='form-group form-group-sm'>";
        drugName_ddcontents += "<label class='col-sm-4 control-label' for='sm'>Number of Bottles</label>";
        drugName_ddcontents += "<div class='col-sm-6'>";
        drugName_ddcontents += "<input type=number  class='form-control' name=numOfBottlesContentValueDC id=numOfBottlesContentValueDC />";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "<br><br/>";
        drugName_ddcontents += "<div class='form-group form-group-sm'>";
        drugName_ddcontents += "<label class='col-sm-4 control-label' for='sm'>Tablets per Bottle</label>";
        drugName_ddcontents += "<div class='col-sm-6'>";
        drugName_ddcontents += "<input type=number class='form-control' name=numOfTabletsContentValueDC id=numOfTabletsContentValueDC />";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "<br>";
        drugName_ddcontents += "<input type=submit class='btn btn-primary' value='Calculate Quantity' onclick=calculateQuantityBT()>";
//         
    }
    else if(type === "Bottles" && content ==="Liquid")
    {
        drugName_ddcontents += "<div class='form-group form-group-sm'>";
        drugName_ddcontents += "<label class='col-sm-4 control-label' for='sm'>Number of Bottles</label>";
        drugName_ddcontents += "<div class='col-sm-6'>";
        drugName_ddcontents += "<input type=number class='form-control' name=numOfBottlesContentValueDC id=numOfBottlesContentValueDC />";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "<br></br>";
        drugName_ddcontents += "<input type=submit class='btn btn-primary' value='Calculate Quantity' onclick=calculateQuantityBL()>";
    
    }
    else if(type === "Cartoons" && content ==="Liquid")
    {
        drugName_ddcontents += "<div class='form-group form-group-sm'>";
        drugName_ddcontents += "<label class='col-sm-4 control-label' for='sm'>Number of Cartoons</label>";
        drugName_ddcontents += "<div class='col-sm-6'>";
        drugName_ddcontents += "<input type=number class='form-control' name=numOfCartoonsContentValueDC id=numOfCartoonsContentValueDC />";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "<br></br>";
        drugName_ddcontents += "<div class='form-group form-group-sm'>";
        drugName_ddcontents += "<label class='col-sm-4 control-label' for='sm'>Number of Bottles per Cartoon</label>";
        drugName_ddcontents += "<div class='col-sm-6'>";
        drugName_ddcontents += "<input type=number class='form-control' name=numOfBottlesContentValueDC id=numOfBottlesContentValueDC />";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "<br></br>";
        drugName_ddcontents += "<input type=submit class='btn btn-primary' value='Calculate Quantity' onclick=calculateQuantityCL()>";
        
    }
    else if(type ==="Cartoons" && content === "Tablets")
    {
        drugName_ddcontents += "<div class='form-group form-group-sm'>";
        drugName_ddcontents += "<label class='col-sm-4 control-label' for='sm'>Content Type</label>";
        drugName_ddcontents +=  "<div class='col-sm-6'>";
        drugName_ddcontents += "<select onchange=getContentTypeDetails() class='form-control' id=contentDropDownBC name=contentDropDownBC >";
        drugName_ddcontents += "<option value=default selected=selected>Select</option>";
        drugName_ddcontents += "<option >Bottles</option>";
        drugName_ddcontents += "<option >Cards</option>";
        drugName_ddcontents += "</select>";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "<br>";
        
    }
//   if(content == "cards")
//       {
//
//         drugName_ddcontents += "<label style= background-color: #00FFFF >Number of cards per cartoon</label>";
//         drugName_ddcontents += "<br/>"
//         drugName_ddcontents += "<td><input type=number name=numOfCardsValueDC id=numOfCardsValueDC /></td>";
//         drugName_ddcontents += "<br></br>";
//         drugName_ddcontents += "<label style= background-color: #00FFFF >Number of tablets per card</label>";
//         drugName_ddcontents += "<br/>"
//         drugName_ddcontents += "<td><input type=number name=tabletsPerCardValueDC id=tabletsPerCardValueDC /></td>";
//       }
//    else if(content == "bottles")
//    {
//         drugName_ddcontents += "<label style= background-color: #00FFFF >Number of bottles per cartoon</label>";
//         drugName_ddcontents += "<br/>"
//         drugName_ddcontents += "<td><input type=number name=numOfBottlesContentValueDC id=numOfBottlesContentValueDC /></td>";
//    }
     document.getElementById("cartoonspaceBC").innerHTML = drugName_ddcontents;
     document.getElementById("quantityspaceBC").innerHTML = "";
}

function getContentTypeDetails()
{
    var content   = $("#contentTypeDropDownBC option:selected").text();
    var type   = $("#typeDropDownBC option:selected").text();
    var contentType   = $("#contentDropDownBC option:selected").text();
    var drugName_ddcontents ="";
    
    if(type=="Cartoons" && content=="Tablets" && contentType=="Bottles")
    {
        drugName_ddcontents += "<div class='form-group form-group-sm'>";
        drugName_ddcontents += "<label class='col-sm-4 control-label' for='sm'>Number of Cartoons</label>";
        drugName_ddcontents +=  "<div class='col-sm-6'>";    
        drugName_ddcontents += "<input type=number class='form-control' name=numOfCartoonsContentValueDC id=numOfCartoonsContentValueDC />";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "<br></br>";
        drugName_ddcontents += "<div class='form-group form-group-sm'>";
        drugName_ddcontents += "<label class='col-sm-4 control-label'>Number of Bottles per Cartoon</label>";
        drugName_ddcontents +=  "<div class='col-sm-6'>";  
        drugName_ddcontents += "<input type=number class='form-control' name=numOfBottlesContentValueDC id=numOfBottlesContentValueDC />";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "<br></br>";
        drugName_ddcontents += "<div class='form-group form-group-sm'>";
        drugName_ddcontents += "<label class='col-sm-4 control-label'>Number of Tablets per Bottle</label>";
        drugName_ddcontents +=  "<div class='col-sm-6'>";  
        drugName_ddcontents += "<input class='form-control' type=number name=numOfTabletsContentValueDC id=numOfTabletsContentValueDC />";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "<br></br>";
        drugName_ddcontents += "<input type=submit class='btn btn-primary' value='Calculate Quantity'  onclick=calculateQuantityCTB()>"
        drugName_ddcontents += "<br></br>";
    }
    else if(type=="Cartoons" && content=="Tablets" && contentType=="Cards")
    {
        drugName_ddcontents += "<div class='form-group form-group-sm'>";
        drugName_ddcontents += "<label class='col-sm-4 control-label' for='sm'>Number of Cartoons</label>";
        drugName_ddcontents += "<div class='col-sm-6'>";    
        drugName_ddcontents += "<input type=number class='form-control' name=numOfCartoonsContentValueDC id=numOfCartoonsContentValueDC />";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "<br></br>";
        drugName_ddcontents += "<div class='form-group form-group-sm'>";
        drugName_ddcontents += "<label class='col-sm-4 control-label' for='sm'>Number of Cards per Cartoon</label>";
        drugName_ddcontents += "<div class='col-sm-6'>";
        drugName_ddcontents += "<input type=number class='form-control' name=numOfCardsContentValueDC id=numOfCardsContentValueDC />";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "<br></br>";
        drugName_ddcontents += "<div class='form-group form-group-sm'>";
        drugName_ddcontents += "<label class='col-sm-4 control-label' for='sm'>Number of Tablets per Card</label>";
        drugName_ddcontents += "<div class='col-sm-6'>";
        drugName_ddcontents += "<input class='form-control' type=number name=numOfTabletsContentValueDC id=numOfTabletsContentValueDC />";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "</div>";
        drugName_ddcontents += "<br></br>";
        drugName_ddcontents += "<input type=submit class='btn btn-primary' value='Calculate Quantity' onclick=calculateQuantityCTC()>";
    }
    document.getElementById("quantityspaceBC").innerHTML = drugName_ddcontents;
}

function calculateQuantityBT()
{
//    alert("Came in");
    var noOfBottles = parseInt($("#numOfBottlesContentValueDC").val());
    var noOfTabletsPerBottle = parseInt($("#numOfTabletsContentValueDC").val());
    var totalQty;
    if(noOfBottles > 0 && noOfTabletsPerBottle > 0)
    {
        totalQty = noOfBottles * noOfTabletsPerBottle;
        $("#quantityValueBC").val(totalQty);
        
    }
    else
    {
        alert("Please enter valid Quantities!!!");
    }
}
//
//function helloworld(){
//    alert("came in hello world");
//    
//}

function calculateQuantityBL()
{
    var noOfBottles = 0;
    var totalQty;
    if($('#drugNameDropDownBC').val().endsWith("ml"))
    {
        var unitQty = parseInt($("#drugUnitQuantity").val());
        noOfBottles = parseInt($("#numOfBottlesContentValueDC").val());

        if(noOfBottles > 0)
        {
            totalQty = noOfBottles * unitQty;
            $("#quantityValueBC").val(totalQty);
            
        }
        else
        {
            alert("Please enter valid Quantities!!!");
        }
    }
    else
    { 
//    alert("Came in calculateQuantityBL");
        noOfBottles = parseInt($("#numOfBottlesContentValueDC").val());
        if(noOfBottles > 0)
        {
            totalQty = noOfBottles;
            $("#quantityValueBC").val(totalQty);
            
        }
        else
        {
            alert("Please enter valid Quantities!!!");
        }
    }
}

function calculateQuantityCL()
{
    //alert("Came in");
    
    if($('#drugNameDropDownBC').val().endsWith("ml"))
    {
        var unitQty = parseInt($("#drugUnitQuantity").val());
        noOfBottles = parseInt($("#numOfBottlesContentValueDC").val());
        noOfCartoons = parseInt($("#numOfCartoonsContentValueDC").val());
        var totalQty;
        if(noOfBottles > 0 && noOfCartoons > 0)
        {
            totalQty = noOfBottles * noOfCartoons * unitQty;
            $("#quantityValueBC").val(totalQty);
        
        }
        else
        {
            alert("Please enter valid Quantities!!!");
        }
    }
    else
    {
        noOfBottles = parseInt($("#numOfBottlesContentValueDC").val());
        noOfCartoons = parseInt($("#numOfCartoonsContentValueDC").val());
        var totalQty;
        if(noOfBottles > 0 && noOfCartoons > 0)
        {
            totalQty = noOfBottles * noOfCartoons;
            $("#quantityValueBC").val(totalQty);
        
        }
        else
        {
            alert("Please enter valid Quantities!!!");
        }
    }
    
}

function calculateQuantityCTB()
{
    //alert("Came in");
    var noOfBottles = parseInt($("#numOfBottlesContentValueDC").val());
    var noOfCartoons = parseInt($("#numOfCartoonsContentValueDC").val());
    var noOfTablets = parseInt($("#numOfTabletsContentValueDC").val());
    var totalQty;
    if(noOfBottles > 0 && noOfCartoons > 0 && noOfTablets > 0)
    {
        totalQty = noOfBottles * noOfCartoons * noOfTablets;
        $("#quantityValueBC").val(totalQty);
        
    }
    else
    {
        alert("Please enter valid Quantities!!!");
    }
}

function calculateQuantityCTC()
{
    //alert("Came in");
    var noOfCards = parseInt($("#numOfCardsContentValueDC").val());
    var noOfCartoons = parseInt($("#numOfCartoonsContentValueDC").val());
    var noOfTablets = parseInt($("#numOfTabletsContentValueDC").val());
    var totalQty;
    if(noOfCards > 0 && noOfCartoons > 0 && noOfTablets > 0)
    {
        totalQty = noOfCards * noOfCartoons * noOfTablets;
        $("#quantityValueBC").val(totalQty);
        
    }
    else
    {
        
        alert("Please enter valid Quantities!!!");
    }
}

function addDrugBatchBC(){
//    alert("1");
  //document.getElementById("batchNoValueBC").value=1223; //check is it going in to this function
//   date_default_timezone_set("Asia/Colombo");
//   $dt = new DateTime(); alert(dt);
////echo $dt->format('Y-m-d H:i:s');
    var drugName         = $("#drugNameDropDownBC option:selected").text();
    var batchNo          = document.getElementById("batchNoValueBC").value;
    var quantity         = document.getElementById("quantityValueBC").value;
//    alert("2");
    //var manufactureDate  = document.getElementById("manufactureDateValueBC").value;
    var manufactureDate  = document.getElementById("manufactureDateValueBC").value;
//    alert("3");
    //var expireDate       = document.getElementById("expireDateValueBC").value;
    var expireDate  = document.getElementById("expireDateValueBC").value;
//    alert("4");
    var batchError  = $("#batcherror").text();
//    alert("5");
    var qtyError  = $("#qtyerror").text();
    var mdateError  = $("#manerror").text();
    var edateError  = $("#experror").text();
   
    var exp = new Date(expireDate);
    var man = new Date(manufactureDate);
    
    var diff = new Date(exp-man);
    var days = diff/1000/60/60/24;
    
//    alert("name of drug " + manufactureDate);
//    alert("Name of batch " + batchNo);
//    alert("name of quantity " + quantity);
////    alert("name of manufactureDate " + man);
//    alert("name of expireDate " + exp);
//    alert("name of diff " + diff);
    
//    alert("");
    if(batchNo.length==0 || quantity.length==0 || manufactureDate.length==0 || expireDate.length==0)        
    {
        alert("Please Fill all the Fields");
    }
    else if (batchError.length !=0 || qtyError.length !=0 || mdateError.length != 0 || edateError.length != 0)
    {
        alert("Some Fields are Invalid!!!");
    }
    else if(days <= 0)
    {
        alert("Expiry Date and Manufactue Date dosn't match!!!");
    }
    else
    {
//        alert("ajax ekata ");
        
    $.ajax({
            url: baseUrl+'/index.php/Batch_Controller/addBatch',
            type: 'POST',
            crossDomain: true,
            data: {"drugName":drugName ,"batchNo":batchNo,"quantity":quantity,
                   "manufactureDate":manufactureDate,"expireDate":expireDate},
            success: function(output) {
                //console.log(data);
                 data = trimData(output);
                alert(data);
                 $("#quantityValueBC").val("");
                 document.getElementById("cartoonspaceBC").innerHTML = "";
                 document.getElementById("quantityspaceBC").innerHTML = "";
                 document.getElementById("itemspaceBC").innerHTML ="";
//                 alert("Successfully Added");
            },
            error:function() {
             alert("Fail to add batch");
            }
         });

    
    document.getElementById('batchNoValueBC').value = "";
    document.getElementById('manufactureDateValueBC').value = "mm/dd/yyyy";
    document.getElementById('expireDateValueBC').value = "mm/dd/yyyy";

    var d = $('#typeDropDownBC option:disabled').prop('disabled', '');
    $('#typeDropDownBC').val(0);
    d.prop('disabled', 'disabled');

    }
}



