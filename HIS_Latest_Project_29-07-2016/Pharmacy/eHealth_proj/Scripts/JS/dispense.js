/*
 ------------------------------------------------------------------------------------------------------------------------
 DiPMIMS - Digital Pulz Medical Information Management System
 Copyright (c) 2017 Sri Lanka Institute of Information Technology
 <http: http://his.sliit.lk />
 ------------------------------------------------------------------------------------------------------------------------
 */
var baseUrl="http://localhost/eHealth_proj";
$(document).ready(function() {
   //alert("wimarsha");

    $("#frmDispense").validate({
        pation: {
            pation: "required"
        },
        errorElement: "span",
        messages: {
            pation: {required: "* ation ID required"}
        }
    });

    $('#bill').live('click', function(e) {

       //report();
        $.ajax({
            url: baseUrl+'/index.php/Prescribe_Controller/getReport',
            type: 'POST',
            data: {drugarr: drugarr, id: nid},
            crossDomain: true,
            success: function(data) {
                var docprint = window.open("about:blank", "_blank");
                docprint.document.open();
                docprint.document.write(data);
                docprint.document.close();
                docprint.focus();
            }, error: function(xhr, textStatus, error) {
                alert(xhr.statusText);
                alert(textStatus);
                alert(error);
            }
        });

    });  

/*var thisPation="";
        var nid="";
   jQuery('#pation').on('input',function(e) {

        
        
       alert($('#pation').val());
        
        
       
        jo = [];
        //var fid = $("#pation").val();
        //var id = fid.substring(3,9);
        thisPation=$('#pation').val();
        nid = thisPation.substring(4,10);
        $('#pait').html('<b> Prescription List ( Patient ID: ' + nid+ ' ) </b>');

        getPrescription();
        $("#itembDiv").hide();
        $("#prescribDiv").show();
        //loadTable();
        $('#pation').val('');
    });*/

    $("#itembDiv").hide();
    $("#prescribDiv").hide();
    var prescription_selected = 0;

//    $('#search').live('click', function(e) {
//       
//        $("#itembDiv").hide();
//        $("#prescribDiv").show();
//        loadTable();
//
//    });

    var prescribDataTable = $('#prescribDataTable').dataTable({
        "bFilter": true,
        "bInfo": false,
        "bPaginate": true,
        "bSort": true,
        "bAutoWidth": false,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 10,
        "aoColumns": [
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"mDataProp": null, "sClass": "center", "sDefaultContent": '<a  id="viewInfo" style="cursor: pointer" href="javascript:void(0)" >view & dispense</a>', "bSortable": false},
        ],
        "aoColumnDefs": [{"bVisible": false, "aTargets": [2,4,5, 6, 7, 8, 9]}]
    });

    var jo = [];



    function loadTable() {
//        alert("12");
        prescribDataTable.fnClearTable();
        for (i = 0; i < jo.length; i++) {
            if(jo[i]["inPrescribe"] == "true")
            {
                prescribDataTable.fnAddData([
                    jo[i]["prescriptionID"],
                    jo[i]["prescriptionCreateDate"],
                    jo[i]["prescriptionCreateUser"],
                    jo[i]["prescriptionDate"],
                    jo[i]["prescriptionLastUpdateUser"],
                    i,
                    "stu",
                    "vwx",
                    "yz1",
                    "234"


                ]);
            }
        }//end for each
        if (jo.length <= 0) {
            $('#pait').html("<div style='color:red'>* Empty Prescription List *</div>");
        }

    }//end loadTable



var selectedPrescID="";
var selectedPresRow ="";
    $('#prescribDataTable  a#viewInfo').live('click', function(e) {

        var prescribEditId = prescribDataTable.fnGetPosition(this.parentNode.parentNode);

        selectedPresRow = prescribEditId;

        var prescriptionID = prescribDataTable.fnGetData(prescribEditId)[0];
        var createDate = prescribDataTable.fnGetData(prescribEditId)[1];
        var createUser = prescribDataTable.fnGetData(prescribEditId)[2];
        var prescriptionDate = prescribDataTable.fnGetData(prescribEditId)[3];
        var lastUpdateUser = prescribDataTable.fnGetData(prescribEditId)[4];
        prescribDataTable.fnGetData(prescribEditId)[5];
        prescribDataTable.fnGetData(prescribEditId)[6];
        prescribDataTable.fnGetData(prescribEditId)[7];
        prescribDataTable.fnGetData(prescribEditId)[8];
        prescribDataTable.fnGetData(prescribEditId)[9];
		
		selectedPrescID=prescriptionID;


        prescription_selected = this.parentNode.parentNode;
        loadTable_I();
        $("#prescribDiv").hide();
        $("#itembDiv").show();



        
    });




//**************************************
//******** Item Table ******************
//***************************************



    var itemDataTable = $('#itemDataTable').dataTable({
        
    });

    drugarr = [];
    function loadTable_I() {



        var prescribEditId = prescribDataTable.fnGetPosition(prescription_selected);
        var prescribeItems = jo[prescribDataTable.fnGetData(prescribEditId)[5]]["prescribeItems"];
        itemDataTable.fnClearTable();

        drugarr = [];
        $(prescribeItems).each(function() {
            var o = this;
            if(o["status"]=="true"){
            itemDataTable.fnAddData([
                o["drugID"]["dSrNo"],
                o["drugID"]["dName"],
                o["prescribeItemsDosage"],
                o["prescribeItemsFrequency"],
                o["prescribeItemsPeriod"],
                o["prescribeItemsQuantity"],
                "Rs. "+o["itemPrice"],
                "stu",
                "vwx",
                "yz1",
                "234"


            ]);
            drugarr.push(o);
          }

        });


//Gayesha
/*var total_Prices=[];
 $(prescribeItems).each(function() {
        var ItemPrice = jo[i]["prescribeItems"][j]["drugID"]["dPrice"];
        var PresQty=jo[i]["prescribeItems"][j]["prescribeItemsQuantity"];
        var total=ItemPrice*PresQty;
            total_Prices.push(total);
            console.log(total_Prices);
             
        });*/
       
    }//end loadTable






    $('#dispense').live('click', function(e) {
        
       
        
       
        prescribDataTable.fnDeleteRow(prescription_selected);

        
        //****** prescrib ****
        var itemJSONarray = new Array();
        $(itemDataTable.fnGetData()).each(function() {
            var oData = this;

            var itemJSONobject = {};
            itemJSONobject["qty"] = oData[5];
            itemJSONobject["DSrNo"] = oData[0];
            itemJSONobject["user"] = "chinthaka";
            itemJSONarray.push(itemJSONobject);

        });
        var itemJSON_OBJECT = {};
		itemJSON_OBJECT["PrescriptionId"] = selectedPrescID;
        itemJSON_OBJECT["dispenseList"] = itemJSONarray;

        var stringifyItem = JSON.stringify(itemJSON_OBJECT);
        $.ajax({
            url: baseUrl+'/index.php/Prescribe_Controller/drugDispense',
            //url: 'http://localhost/eHealth_proj/index.php/Prescribe_Controller/drugDispense_new',
            type: 'POST',
            data: {id: stringifyItem},
            crossDomain: true,
            success: function(data) {
                console.log(data);
            }, error: function(xhr, textStatus, error) {
                alert(xhr.statusText);
                alert(textStatus);
                alert(error);
            }
        });

        //****** prescrib ****

        $("#itembDiv").hide();
        $("#prescribDiv").show();
        $('#pait').html('<b> Prescription List ( Patient ID: ' + thisPation + ' )  <span style="color:#55FB6E">Successfully Dispensed...</span></b>');

    });




    $('#back').live('click', function(e) {

        $("#itembDiv").hide();
        $("#prescribDiv").show();

    });

 


    var thisPation="";
    var nid="";
    $('#search').live('click', function(e) {
        jo = [];
        //var fid = $("#pation").val();
        //var id = fid.substring(3,9);
        thisPation=$('#pation').val();
        nid = thisPation.substring(4,10);
        //alert(thisPation);
        $('#pait').html('<b> Prescription List ( Patient ID: ' + nid+ ' ) </b>');

        getPrescription();
        $("#itembDiv").hide();
        $("#prescribDiv").show();
        //loadTable();
        $('#pation').val('');


    });
        
      


function report(){

        var docprint = window.open("about:blank", "_blank");
        var oTable = document.getElementById("panel");
        var t=document.getElementById("itembDiv");
       
        docprint.document.open();
        docprint.document.write('<html><head><title>Pharmacy bill</title></head><body>');
        /*docprint.document.write('<style>.dataTables_length,.dataTables_filter,.dataTables_info,.dataTables_paginate { display: none;}</style>');*/
        docprint.document.write('<div align="center">');
        docprint.document.write('<table align="center" cellpadding="10" cellspacing="10" border="0" id="billtablel" class="table table-bordered">');
        docprint.document.write('<thead><tr><th padding="20px">');
        docprint.document.write('Drug Name');
        docprint.document.write('</th><th padding="20px">');
        docprint.document.write('Qty');
        docprint.document.write('</th><th padding="20px">');
        docprint.document.write('Unit Price');
        docprint.document.write('</th>');
        docprint.document.write('</th><th padding="20px">');
        docprint.document.write('Row Price');
        docprint.document.write('</th></tr></thead>');
        docprint.document.write('<tbody><tr>');
        var totalprice=0;
        for (i = 0; i < drugarr.length; i++) {
/*            console.log(jo[selectedPresRow]["prescribeItems"].length);
            console.log(jo[selectedPresRow]["prescribeItems"]);
            console.log("loop = " + i);
            console.log ("selected Row = " + selectedPresRow);*/

            if(drugarr[i]["status"]== "true"){
                var name=drugarr[i]["drugID"]["dName"];
                var type = "";
                if(name.endsWith("ml"))
                {
                    type = "ml";
                }

                var qty=drugarr[i]["prescribeItemsQuantity"];
                //var qty=3;
                var price=drugarr[i]["drugID"]["dPrice"];
                            var tot=qty*price;
                            totalprice=totalprice+tot;
                docprint.document.write('<td>'+name+'');
                docprint.document.write('</td><td align="right">');
                docprint.document.write(''+qty+type+'');
                docprint.document.write('</td><td align="right">');
                docprint.document.write(''+Number(price).toFixed(2)+'');
                docprint.document.write('</td>');
                docprint.document.write('</td><td align="right">');
                docprint.document.write(''+Number(tot).toFixed(2)+'');
                docprint.document.write('</td></tr>');

            }
        }
        docprint.document.write('<tr><td></td>');
        docprint.document.write('<td></td><td align="right"><b>Total :</b></td><td align="right">Rs. '+Number(totalprice).toFixed(2)+'</td></tr>');
        docprint.document.write('</tbody></table></div>');
            docprint.document.write('<br><br><br>');
         
        
        //docprint.document.write(oTable.parentNode.innerHTML);
        //docprint.document.write('+id+');
        docprint.document.write('</center></body></html>');
        docprint.document.close();
        docprint.print();
        docprint.close();



}



    function getPrescription() {
        //console.log($('#pation').val());
            $.ajax({
                url: baseUrl+'/index.php/Prescribe_Controller/getPrescriptionList',
                type: 'POST',
                data: {id: nid},
                crossDomain: true,
                success: function(data) {
                    //console.log(data);
                    try {
                        data = trimData(data);
                        jo = $.parseJSON(data);
                        loadTable();
                    } catch (err) {
                        jo = [];
                        loadTable();
                    }
                }, error: function(xhr, textStatus, error) {
                    alert(xhr.statusText);
                    alert(textStatus);
                    alert(error);
                }
            });
         

    }


});
