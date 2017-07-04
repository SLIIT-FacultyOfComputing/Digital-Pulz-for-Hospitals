


$(document).ready(function() {
    var pressed = false;

   
            
            var chars = [];
    $(window).keypress(function(e) {
        if (e.which >= 48 && e.which <= 57) {
            chars.push(String.fromCharCode(e.which));
            //alert("sdfd");
        }
        console.log(e.which + ":" + chars.join("|"));
        if (pressed == false) {
            setTimeout(function() {
                // check we have a long length e.g. it is a barcode
                if (chars.length >= 7) {
                    // join the chars array to make a string of the barcode scanned
                    var scanned = chars.join(""); //1234000022-1
                    var sliced = scanned.slice(4, 10);//000022 hAve to change this according to input
                    var patientID = "";
                    //alert("Scanned "+scanned);
                    // alert("Sliced "+sliced);

                    if (sliced.charAt(0) != 0) {
                        patientID = sliced;
                        // alert("patientID is "+patientID);
                    }
                    else if (sliced.charAt(1) != 0) {
                        patientID = sliced.slice(1, sliced.length);
                        // alert("patientID is "+patientID);
                    }
                    else if (sliced.charAt(2) != 0) {
                        patientID = sliced.slice(2, sliced.length);
                        // alert("patientID is "+patientID);
                    }
                    else if (sliced.charAt(3) != 0) {
                        patientID = sliced.slice(3, sliced.length);
                        //alert("patientID is "+patientID);
                    }
                    else if (sliced.charAt(4) != 0) {
                        patientID = sliced.slice(4, sliced.length);
                        //alert("patientID is "+patientID);
                    }
                    else if (sliced.charAt(5) != 0) {
                        patientID = sliced.slice(5, sliced.length);
                        //alert("patientID is "+patientID);
                    }
                    else {
                        alert("Invalid Patient HIN");
                    }

           // var userSessionName = '<%= Session["userlevel"] %>'
           //12340000101
           // alert($userSessionName);


                    window.location = "../../viewpatient/" + patientID;

//                                            /patient_overview_c/view/1

                }
                chars = [];
                pressed = false;
            }, 300);
        }
        pressed = true;
    });
});





