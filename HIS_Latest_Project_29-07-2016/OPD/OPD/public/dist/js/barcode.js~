 var role_id = <?php echo $_SESSION['role_id']; ?>;
        //alert(role_id);
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
                    setTimeout(function(){
                        // check we have a long length e.g. it is a barcode
                        if (chars.length >= 7) {
                            // join the chars array to make a string of the barcode scanned
                            var scanned = chars.join(""); //1234000022-1
                            var sliced = scanned.slice(4, 10);//000022 hAve to change this according to input
                            var patientID="";
                            //alert("Scanned "+scanned);
                                                       // alert("Sliced "+sliced);
                            
                            if(sliced.charAt(0)!=0){
                                    patientID=sliced;
                                    //alert("patientID is "+patientID);
                            }
                            else if(sliced.charAt(1)!=0 ){                                  
                                patientID=sliced.slice(1, sliced.length);
                                //alert("patientID is "+patientID);
                            }
                            else if(sliced.charAt(2)!=0 ){                                  
                                patientID=sliced.slice(2, sliced.length);
                                //alert("patientID is "+patientID);
                            }
                            else if(sliced.charAt(3)!=0 ){                                  
                                patientID=sliced.slice(3, sliced.length);
                                //alert("patientID is "+patientID);
                            }
                            else if(sliced.charAt(4)!=0 ){                                  
                                patientID=sliced.slice(4, sliced.length);
                                //alert("patientID is "+patientID);
                            }
                            else if(sliced.charAt(5)!=0 ){                                  
                                patientID=sliced.slice(5, sliced.length);
                                //alert("patientID is "+patientID);
                            }
                            else{
                                alert("Invalid Patient HIN");
                            }
                            //alert("patientID is "+patientID);
                            
                            // This is for nurse view-> patient_full_view_v.php
                            // view-> patients_full_search_v.php
                            //window.location="../../operator_home_c/viewpatient/" + patientID;
                            
                            // for the doctor
                            //view-> doctor_p_queue_v
                                                       if(role_id == 1){
                                                           var url = "<?=site_url('patient_overview_c/view')?>"+"/"+patientID;
                                                           window.location = url;
                                                       } else {
                                                           var url = "<?=site_url('operator_home_c/viewpatient')?>"+"/"+patientID;
                                                           window.location = url;
                                                       }
                                                             
                                                       
                                                        
                                                        
                            
                        }
                        chars = [];
                        pressed = false;
                    },300);
                }
                pressed = true;
            });
        });
    
    
