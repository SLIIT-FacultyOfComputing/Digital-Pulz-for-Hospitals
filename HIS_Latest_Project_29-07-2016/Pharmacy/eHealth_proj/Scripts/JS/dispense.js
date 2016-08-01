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

        }//end for each
        if (jo.length <= 0) {
            $('#pait').html("<div style='color:red'>* Empty Prescription List *</div>");
        }

    }//end loadTable



var selectedPrescID="";
    $('#prescribDataTable  a#viewInfo').live('click', function(e) {

        var prescribEditId = prescribDataTable.fnGetPosition(this.parentNode.parentNode);

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
        "aoColumnDefs": [{"bVisible": false, "aTargets": [5, 6, 7, 8, 9, 10]}]
    });


    function loadTable_I() {



        var prescribEditId = prescribDataTable.fnGetPosition(prescription_selected);
        var prescribeItems = jo[prescribDataTable.fnGetData(prescribEditId)[5]]["prescribeItems"];
        itemDataTable.fnClearTable();
        $(prescribeItems).each(function() {
            var o = this;

            itemDataTable.fnAddData([
                o["drugID"]["dName"],
                o["prescribeItemsDosage"],
                o["prescribeItemsFrequency"],
                o["prescribeItemsPeriod"],
                o["prescribeItemsQuantity"],
                o["drugID"]["dSrNo"],
                "stu",
                "vwx",
                "yz1",
                "234"


            ]);
        });


    }//end loadTable





    $('#dispense').live('click', function(e) {
        
       
        
       
        prescribDataTable.fnDeleteRow(prescription_selected);

        
        //****** prescrib ****
        var itemJSONarray = new Array();
        $(itemDataTable.fnGetData()).each(function() {
            var oData = this;

            var itemJSONobject = {};
            itemJSONobject["qty"] = oData[4];
            itemJSONobject["DSrNo"] = oData[5];
            itemJSONobject["user"] = "chinthaka";
            itemJSONarray.push(itemJSONobject);

        });
        var itemJSON_OBJECT = {};
		itemJSON_OBJECT["PrescriptionId"] = selectedPrescID;
        itemJSON_OBJECT["dispenseList"] = itemJSONarray;

        var stringifyItem = JSON.stringify(itemJSON_OBJECT);

        $.ajax({
            url: 'http://localhost/eHealth_proj/index.php/Prescribe_Controller/drugDispense',
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




    function getPrescription() {
        console.log($('#pation').val());
            $.ajax({
                url: 'http://localhost/eHealth_proj/index.php/Prescribe_Controller/getPrescriptionList',
                type: 'POST',
                data: {id: nid},
                crossDomain: true,
                success: function(data) {
                    console.log(data);
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
