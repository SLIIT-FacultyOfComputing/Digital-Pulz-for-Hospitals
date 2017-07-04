/*
 ------------------------------------------------------------------------------------------------------------------------
 DiPMIMS - Digital Pulz Medical Information Management System
 Copyright (c) 2017 Sri Lanka Institute of Information Technology
 <http: http://his.sliit.lk />
 ------------------------------------------------------------------------------------------------------------------------
 */
var baseUrl="http://his.sliit.lk/Pharmacy";
$(document).ready(function() {

    var jo = [];
 
    


    $('#save').live('click', function(e) {
       


        var itemJSONarray = new Array();

            var itemJSONobject = {};
            itemJSONobject["dosage"] = $("#dosage").val();
            itemJSONobject["recordStatus"] = $("#recordStatus").val();
			 itemJSONobject["dosId"] = $("#dosId").val();
			
            itemJSONarray.push(itemJSONobject);

       
        var itemJSON_OBJECT = {};
        itemJSON_OBJECT["dosageList"] = itemJSONarray;

        var stringifyItem = JSON.stringify(itemJSON_OBJECT);

        $.ajax({
            url: baseUrl+'/index.php/Dosage_Controller/insrtDosages',
            type: 'POST',
            data: {dosages: stringifyItem},
            crossDomain: true,
            success: function(data) {
                data = trimData(data);
                alert(data);
				$("#dosage").val("");
				$("#dosId").val("");
				$("#recordStatus").val("1");
				getDosages();
				 $("#fields").hide();
				$("#dosageDiv").show();
            }, error: function(xhr, textStatus, error) {
                alert(xhr.statusText);
                alert(textStatus);
                alert(error);
            }
        });


    });
	
	
	$("#fields").hide();
	 $('#addNew').live('click', function(e) {
	 $("#dosage").val("");
	 $("#dosId").val("");
	 $("#recordStatus").val("1");
	 $("#fields").show();
	 $("#dosageDiv").hide();
	 
	 });
	 
	  $('#back').live('click', function(e) {
	 $("#dosage").val("");
	 $("#dosId").val("");
	 $("#recordStatus").val("1");
	 $("#fields").hide();
	 $("#dosageDiv").show();
	 
	 });


  var dosageDataTable = $('#dosageDataTable').dataTable({
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
			{"bSortable": false},
			{"bSortable": false},
            {"mDataProp": null, "sClass": "center", "sDefaultContent": '<a  id="viewInfo" style="cursor: pointer" href="javascript:void(0)" >view/edit</a>', "bSortable": false},
        ],
        "aoColumnDefs": [{"bVisible": false, "aTargets": [2,3]}]
    });

   
 function loadTable() {
        dosageDataTable.fnClearTable();
       for (i = 0; i < jo.length; i++) {
	   var recordStatus="In-Active";
	   if(jo[i]["recordStatus"]===1){
	   recordStatus="Active";
	   }
            dosageDataTable.fnAddData([
                jo[i]["dosage"],
                recordStatus,
               jo[i]["recordStatus"],
                jo[i]["dosId"],
               // jo[i]["prescriptionLastUpdateUser"],
               


            ]);

        }//end for each
       

    }//end loadTable
	
	
	
	
	
	 $('#dosageDataTable  a#viewInfo').live('click', function(e) {

        var dosageEditId = dosageDataTable.fnGetPosition(this.parentNode.parentNode);
	        $("#fields").show();
	       $("#dosageDiv").hide();
			$("#dosage").val(dosageDataTable.fnGetData(dosageEditId)[0]);
            $("#recordStatus").val(dosageDataTable.fnGetData(dosageEditId)[2]);
			$("#dosId").val(dosageDataTable.fnGetData(dosageEditId)[3]);
        
		
		selectedPrescID=prescriptionID;


        prescription_selected = this.parentNode.parentNode;
      




    });
	
	
	
function getDosages() {
            $.ajax({
                url: baseUrl+'/index.php/Dosage_Controller/getDosages',
                type: 'POST',
                crossDomain: true,
                success: function(data) {
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
	
	
	
	
	

getDosages();

});