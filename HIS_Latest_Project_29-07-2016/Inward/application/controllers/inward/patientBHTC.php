<?php

session_start();

class patientBHTC extends CI_Controller {

    public function index() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }

        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount()+ $this->getAdmissionRequestCount());
       
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);
        $this->load->view('inward/patientBHT/patientBHT');
        
        $this->load->view('layout/footer1');
    }
 public function getAllWard() {
        $this->load->model('/inward/admin/wardModel', 'wardModel');
        $list = $this->wardModel->getAllWards();
        return $list;
    }
    public function SearchPatientView() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount()+ $this->getAdmissionRequestCount());
        

        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);
        
        $this->load->view('inward/patientBHT/patientBHT');

        $this->load->model('inward/opd/PatientModel', 'patient');
        $this->patient->set_pid($this->input->post('patientID'));
        $data['patients'] = json_decode($this->patient->getPatient());


        $data['WardAdmission'] = $this->getWardAdmissionByPatientID($this->input->post('patientID'));


        $this->load->view('inward/patientBHT/patientSearch', $data);
        $this->load->view('layout/footer1');
    }

    public function getInternalTransferCount() {
        $this->load->model('/inward/transfer/InternalTrasferModel', 'internaltransfer');


        $mywards = $this->getMywards();
        $count = 0;
        foreach ($mywards as $val) {


            $list = $this->internaltransfer->getInternalTransferByWard($val->wardNo);

            foreach ($list as $value) {
                $count = $count + 1;
            }
        }

        return $count;
    }

    public function getMywards() {
        if($_SESSION['RoleId'] == '2'){
            return $this->getAllWard();
        }else{
        $this->load->model('/inward/admin/wardModel', 'wardModel');
        return $this->wardModel->getWardByEmpID($_SESSION['EmpId']);     
        }
    }

   

    public function getDischargeType($bhtNo) {
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $admission = $this->admission->getWardAdmissionDetails($bhtNo);
        foreach ($admission as $value) {
            $discharjType = $value->dischargeType;
        }
        return $discharjType;
    }

    public function BHT($bhtNo, $patientID) {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);
        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $dischargeType = $this->getDischargeType($bhtNo);
        $data['dischjType'] = $dischargeType;
        if ($dischargeType == "IT") {
            $this->load->model('/inward/transfer/InternalTrasferModel', 'internaltransfer');
            $data['transviewData'] = $this->internaltransfer->getInternalTransferByBHTNo($bhtNo);
        } elseif ($dischargeType == "ET") {
            $this->load->model('/inward/transfer/ExternalTransferModel', 'Externaltransfer');
            $data['transviewData'] = $this->Externaltransfer->getExternalTransferByBHTNo($bhtNo);
        }



        $this->load->view('layout/headerBHT1', $data);
          $this->load->view('layout/navigationBHT1', $data);
        $this->load->view('inward/patientBHT/BHTpatient', $data);
        $this->load->view('layout/footer1');
    }
    
    

    public function PrescriptionView($bhtNo, $patientID) {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['dischjType'] = $this->getDischargeType($bhtNo);
        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);
        //$this->load->view('layout/headerBHT', $data);
        $this->load->view('layout/headerBHT1', $data);
        $this->load->view('layout/navigationBHT1',$data);


        $this->load->view('inward/patientBHT/PatientDetails', $data);

        $con = mysqli_connect("localhost", "root", "", "his");
        $result = mysqli_query($con, "SELECT * FROM ward_prescriptionitem where bht_no = '" . $bhtNo . "' and status='active'");
        $data['prescribeItems'] = $result;


        $result2 = mysqli_query($con, "SELECT * FROM ward_prescriptionitem where bht_no = '" . $bhtNo . "' and status='omit'");
        $data['OmittedItems'] = $result2;
        mysqli_close($con);

        $this->load->view('inward/patientBHT/BHTDrugChart', $data);
        $this->load->view('inward/patientBHT/BHTprescription', $data);
        $this->load->view('layout/footerInward');
    }

    public function AddDrug($bhtNo, $patientID) {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $drugID = $this->input->post('inputDrug');
        $dose = $this->input->post('inputDosage');
        $frequnce = $this->input->post('inputFrequency');
        $startdate = date("Y-m-d");

        $con = mysqli_connect("localhost", "root", "", "his");
        mysqli_query($con, "INSERT INTO ward_prescriptionitem (bht_no, drug_id, dose,frequency,status,start_date) VALUES ('" . $bhtNo . "', '" . $drugID . "','" . $dose . "','" . $frequnce . "', 'active','" . $startdate . "')");
        mysqli_close($con);

        redirect('inward/patientBHTC/PrescriptionView/' . $bhtNo . '/' . $patientID);
    }

    public function UpdateDrugView($bhtNo, $patientID) {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $drug_id = $this->input->post('drug_id');
        $enddate = date("Y-m-d");

        $con = mysqli_connect("localhost", "root", "", "his");
        mysqli_query($con, "UPDATE ward_prescriptionitem SET status='omit' , end_date ='" . $enddate . "' where drug_id = '" . $drug_id . "'");
        mysqli_close($con);

        redirect('inward/patientBHTC/PrescriptionView/' . $bhtNo . '/' . $patientID);
    }

//    public function UpdateDrugDetails($bhtNo, $patientID) {
//        $drugID = $this->input->post('inputDrug');
//        $dose = $this->input->post('inputDosage');
//        $frequnce = $this->input->post('inputFrequency');
//        $startdate = date("Y-m-d");
//
//        $con = mysqli_connect("localhost", "root", "", "his");
//        mysqli_query($con, "INSERT INTO ward_prescriptionitem (bht_no, drug_id, dose,frequency,status,start_date) VALUES ('" . $bhtNo . "', '" . $drugID . "','" . $dose . "','" . $frequnce . "', 'active','" . $startdate . "')");
//        mysqli_close($con);
//
//        redirect('inward/patientBHTC/PrescriptionView/' . $bhtNo . '/' . $patientID);
//    }

    public function LabView($bhtNo, $patientID) {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $data['dischjType'] = $this->getDischargeType($bhtNo);
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);
        //$this->load->view('layout/headerBHT', $data);
        $this->load->view('layout/headerBHT1', $data);
        $this->load->view('layout/navigationBHT1',$data);

        $this->load->view('inward/patientBHT/PatientDetails', $data);
        $this->load->view('inward/patientBHT/BHTlaboratory', $data);
        $this->load->view('layout/footerInward');
    }

    public function NewLab($bhtNo, $patientID) {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $data['dischjType'] = $this->getDischargeType($bhtNo);
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);
        //$this->load->view('layout/headerBHT', $data);
        $this->load->view('layout/headerBHT1', $data);
        $this->load->view('layout/navigationBHT1',$data);


        $this->load->view('inward/patientBHT/PatientDetails', $data);
        $this->load->view('inward/patientBHT/NewTestRequest', $data);
        $this->load->view('layout/footerInward');
    }

    public function AllergyView($bhtNo, $patientID) {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $data['dischjType'] = $this->getDischargeType($bhtNo);

        $this->load->view('layout/headerBHT1', $data);
        $this->load->view('layout/navigationBHT1',$data);

        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');

        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);

        $this->load->model('/inward/Allergy/AllergyModel', 'allergy');
        $data['allergies'] = $this->allergy->getAllergies($patientID);

        $this->load->view('inward/patientBHT/PatientDetails', $data);
        // $this->load->view('inward/patientBHT/NewAllergy', $data);
        $this->load->view('inward/patientBHT/BHTallergy', $data);
        $this->load->view('layout/footer1');
    }

    public function NewAllergy($bhtNo, $patientID) {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $data['dischjType'] = $this->getDischargeType($bhtNo);

        $this->load->view('layout/headerBHT1', $data);
        $this->load->view('layout/navigationBHT1',$data);


        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);

        $this->load->model('/inward/Allergy/AllergyModel', 'allergy');
        $data['allergies'] = $this->allergy->getAllergies($patientID);

        $this->load->view('inward/patientBHT/PatientDetails', $data);
        $this->load->view('inward/patientBHT/NewAllergy', $data);
        //$this->load->view('inward/patientBHT/BHTallergy', $data);
        $this->load->view('layout/footer1');
    }

    public function AddAllergyView($bhtNo, $patientID) {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $allergyName = $this->input->post('AllergyName');
        $Remark = $this->input->post('Remark');
        $Status = $this->input->post('Status');

        $this->load->model('/inward/Allergy/AllergyModel', 'allergy');

        $this->allergy->setName($allergyName);
        $this->allergy->setStatus($Status);
        $this->allergy->setRemarks($Remark);
        $this->allergy->setUserid($_SESSION['user']);
        $this->allergy->setActive(1);
        $this->allergy->setPid($patientID);
        $ss = $this->allergy->addAllergy();

        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $data['dischjType'] = $this->getDischargeType($bhtNo);
        
        //$this->load->view('layout/headerBHT1', $data);
        $this->load->view('layout/headerBHT1', $data);
        $this->load->view('layout/navigationBHT1',$data);



        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);

        $this->load->model('/inward/Allergy/AllergyModel', 'allergy');
        $data['allergies'] = $this->allergy->getAllergies($patientID);

        $this->load->view('inward/patientBHT/PatientDetails', $data);
        $this->load->view('inward/patientBHT/NewAllergy');
        $this->load->view('inward/patientBHT/BHTallergy', $data);
        $this->load->view('layout/footer1');
    }

    public function UpdateAllergy($bhtNo, $patientID) {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $data['dischjType'] = $this->getDischargeType($this->input->post('bhtNo'));
        //$this->load->view('layout/headerBHT', $data);
        $this->load->view('layout/headerBHT1', $data);
        $this->load->view('layout/navigationBHT1',$data);

        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);

        $this->load->model('/inward/Allergy/AllergyModel', 'allergy');
        $data['allergies'] = $this->allergy->getAllergies($patientID);

        $this->load->model('/inward/Allergy/AllergyModel', 'allergyy');
        $data['allergyView'] = $this->allergyy->getAllergy($this->input->post('allergyid'));


        $this->load->view('inward/patientBHT/PatientDetails', $data);
        $this->load->view('inward/patientBHT/UpdateAllergy', $data);
        //$this->load->view('inward/patientBHT/NewAllergy', $data);
        $this->load->view('inward/patientBHT/BHTallergy', $data);
        $this->load->view('layout/footer1');
    }

    public function UpdateAllergyDetails($bhtNo, $patientID) {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $allergyID = $this->input->post('allergyID');
        $allergyName = $this->input->post('allergyName');
        $Remark = $this->input->post('Remark');
        $Status = $this->input->post('Status');

        $this->load->model('/inward/Allergy/AllergyModel', 'allergy');
        $this->allergy->setAllergyid($allergyID);
        $this->allergy->setName($allergyName);
        $this->allergy->setStatus($Status);
        $this->allergy->setRemarks($Remark);
        $this->allergy->setUserid($_SESSION['user']);
        $this->allergy->setActive(1);
        $ss = $this->allergy->updateAllergy();


        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $data['dischjType'] = $this->getDischargeType($bhtNo);
        //$this->load->view('layout/headerBHT', $data);
        $this->load->view('layout/headerBHT1', $data);
        $this->load->view('layout/navigationBHT1',$data);

        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);

        $this->load->model('/inward/Allergy/AllergyModel', 'allergy');
        $data['allergies'] = $this->allergy->getAllergies($patientID);

        $this->load->view('inward/patientBHT/PatientDetails', $data);
        $this->load->view('inward/patientBHT/NewAllergy');
        $this->load->view('inward/patientBHT/BHTallergy', $data);
        $this->load->view('layout/footerInward');
    }

    public function InternalTransfer($bhtNo, $patientID) {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        date_default_timezone_set("Asia/Colombo");
        //check whether patient allready transfered or not.

        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $data['dischjType'] = $this->getDischargeType($bhtNo);
       
        //$this->load->view('layout/headerBHT', $data);
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigationBHT1',$data);


        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);
        $this->load->model('/inward/admin/wardModel', 'wardModel');
        $data['Wards'] = $this->wardModel->getAllWards();

        $this->load->view('inward/Transfer/newInternalTransfer', $data);
        $this->load->view('layout/footer1');
    }

    public function ExternalTransfer($bhtNo, $patientID) {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $data['dischjType'] = $this->getDischargeType($bhtNo);
        
        //$this->load->view('layout/headerBHT', $data);
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigationBHT1',$data);


        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);

        $this->load->view('inward/Transfer/newExternalTransfer', $data);
        $this->load->view('layout/footer1');
    }

    public function DischarjView($bhtNo, $patientID) {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $data['dischjType'] = $this->getDischargeType($bhtNo);
        
        
        
        $this->load->view('layout/headerBHT1', $data);
        $this->load->view('layout/navigationBHT1',$data);

        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);

        $this->load->view('inward/patientBHT/BHTDischarj', $data);
        $this->load->view('layout/footer1');
    }
 //-------------------------------------------------------------------------------------------------
  public function DischarjArchive($bhtNo, $patientID){
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        
        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $data['dischjType'] = $this->getDischargeType($bhtNo);
        
        
        
        $this->load->view('layout/headerBHT1', $data);
        $this->load->view('layout/navigationBHT1',$data);

        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);
              
        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount()+ $this->getAdmissionRequestCount());
        
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);
        
        //$this->load->view('inward/patientBHT/patientArchive');

        //$this->load->model('inward/opd/PatientModel', 'patient');
        //$this->patient->set_pid($this->input->post('patientID'));
        //$data['patients'] = json_decode($this->patient->getPatient());
        
       
        $data['tmp'] =($this->getPatientByHIN($this->input->post('patientID')));
        $data['patients'] = $data['tmp'][0];
          
        $this->load->view('inward/patientBHT/PatientArchiveOutput', $data);
        $this->load->view('layout/footer1');
    }
    //-------------------------------------------------------------------------------------------
    public function AddDiets($bhtNo, $patientID) {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $data['dischjType'] = $this->getDischargeType($bhtNo);
                
        $this->load->view('layout/headerBHT1', $data);
        $this->load->view('layout/navigationBHT1',$data);

        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);
        
        //$data['tmp'] =$this->getPatientDietDetails();
        //$data['diet'] = $data['tmp'];
        
        $data['tmp'] =$this->getPatientDietDetails();
        $data['diet'] = $data['tmp'];
        
        $this->load->model('/inward/wardAdmission/dietModel', 'diet');
        $data['diet'] = $this->diet->getPatientDietDetails();
                
        $this->load->view('/inward/patientBHT/Diet',$data);
        $this->load->view('layout/footer1');
    }
    //-----------------------------------------------------------------------------------
    
      public function getPatientDietDetails(){
        $this->load->model('/inward/wardAdmission/dietModel', 'dietModel');
        $ss = $this->dietModel->getPatientDietDetails();
        return $ss;
    }
    
    //-------------------------------------------------------------------------------------
    
    public function InsertDiet() {
     if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        
        $diet_id=  $this->input->post('diet_id');
        $patient_id = $this->input->post('patient_id');
        $patient_diet= $this->input->post('patient_diet');
        $quantity = $this->input->post('quantity');
        $diet_category = $this->input->post('diet_category');
        $time = $this->input->post('time');
        $status = $this->input->post('status');
        
        $this->load->model('/inward/wardAdmission/dietModel', 'dietModel');

        $this->dietModel->setDiet_id($diet_id);
        $this->dietModel->setPatient_id($patient_id);
        $this->dietModel->SetPatient_diet($patient_diet);
        $this->dietModel->setQuantity($quantity);
        $this->dietModel->setDiet_category($diet_category);
        $this->dietModel->setTime($time);
        $this->dietModel->setStatus($status);
        
        $ss = $this->dietModel->insertDiet();
        if ($ss == 'true') {
            //print_r("Success");
            echo "<script type=\"text/javascript\">window.alert('Patient Diet Has Inserted.');window.location.href = '/Inward/index.php/inward/patientBHTC/AddDiets/201412/1';</script>"; 
   exit;
        }
    }
    
    
//------------------------------------------------------------------------------------------------------------------    

     public function ViewDiets($bhtNo, $patientID) {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $data['dischjType'] = $this->getDischargeType($bhtNo);
                
        $this->load->view('layout/headerBHT1', $data);
        $this->load->view('layout/navigationBHT1',$data);

        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);
        
        //$data['tmp'] =$this->getPatientDietDetails();
        //$data['diet'] = $data['tmp'];
          
        $data['tmp'] =$this->getPatientDietDetails();
        $data['diet'] = $data['tmp'];
        
        $this->load->model('/inward/wardAdmission/dietModel', 'diet');
        $data['diet'] = $this->diet->getPatientDietDetails();
        
        
                
        $this->load->view('/inward/patientBHT/ViewDiet',$data);
        $this->load->view('layout/footer1');
    }
    
//----------------------------------------------------------------------------------------------------
 public function UpdateDiet() {
     if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        
        $diet_id= $this->input->post('diet_id');
        $patient_id = $this->input->post('patient_id');
        $patient_diet= $this->input->post('patient_diet');
        $quantity = $this->input->post('quantity');
        $diet_category = $this->input->post('diet_category');
        $time = $this->input->post('time');
        $status = $this->input->post('status');
        
        $this->load->model('/inward/wardAdmission/dietModel', 'dietModel');
        
        $this->dietModel->setDiet_id($setDiet_id);
        $this->dietModel->setPatient_id($patient_id);
        $this->dietModel->SetPatient_diet($patient_diet);
        $this->dietModel->setQuantity($quantity);
        $this->dietModel->setDiet_category($diet_category);
        $this->dietModel->setTime($time);
        $this->dietModel->setStatus($status);
        
        $ss = $this->dietModel->insertDiet();
        if ($ss == 'true') {
            print_r("Success");
        }
    }
    
    
//---------------------------------------------------------------------------------------------------
    
    public function NewTransfer() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        date_default_timezone_set("Asia/Colombo");
        $this->load->model('/inward/transfer/InternalTrasferModel', 'transfer');
        $this->transfer->setBhtNo($this->input->post('bhtNo'));
        $this->transfer->setTransferFromWard($this->input->post('TransferFromWard'));
        $this->transfer->setTransferWard($this->input->post('transferWard'));
        $this->transfer->setResonForTrasnsfer($this->input->post('resonForTrasnsfer'));
        $this->transfer->setReportOfSpacialExamination($this->input->post('reportOfSpacialExamination'));
        $this->transfer->setTreatmentSuggested($this->input->post('TreatmentSuggested'));
        $this->transfer->setTransferCreatedDate($this->input->post('TransferCreatedDate'));
        $this->transfer->setTransferCreatedUser($_SESSION['user']);
        $ss = $this->transfer->insertInternalTransfer();

        $bht_no = $this->input->post('bhtNo');
        $patient_id = $this->input->post('patientID');

        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $discharjType = "IT"; //Iternal Transfer Discharge Type
        $remark = $this->input->post('remark');
        $LastUpdatedUser = $_SESSION['user'];
        $LastUpdatedDateTime = $this->input->post('TransferCreatedDate');
        $k = $this->admission->UpdateDischarge($bht_no, $discharjType, $remark, $LastUpdatedUser, $LastUpdatedDateTime);

        $wardNo = $this->input->post('TransferFromWard');
        $bedNo = $this->input->post('bedNo');
        $this->UpdateBedAvailability($bedNo, $wardNo);


        redirect('inward/patientBHTC/BHT/' . $bht_no . '/' . $patient_id);
    }

    public function DischargePatient() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        date_default_timezone_set("Asia/Colombo");
        $bht_no = $this->input->post('bhtNo');
        $wardNo = $this->input->post('wardNo');
        $bedNo = $this->input->post('bedNo');
        $patientID = $this->input->post('patientID');
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        //$discharjType = $this->input->post('dischargeType');
        $remark = $this->input->post('remark');
        $LastUpdatedUser = $_SESSION['user'];
        $LastUpdatedDateTime = $this->input->post('DischargedCreatedDate');
        
        $k = $this->admission->UpdateDischarge($bht_no, $remark, $LastUpdatedUser, $LastUpdatedDateTime);

        $this->UpdateBedAvailability($bedNo, $wardNo);

        redirect('inward/patientBHTC/BHT/' . $bht_no . '/' . $patientID);
    }
    //discharge patient details
    public function DischargePatientView() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        date_default_timezone_set("Asia/Colombo");
        $bht_no = $this->input->post('bhtNo');
        $wardNo = $this->input->post('wardNo');
        $bedNo = $this->input->post('bedNo');
        $patientID = $this->input->post('patientID');
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $discharjType = $this->input->post('dischargeType');
        
        
        $LastUpdatedUser = $_SESSION['user'];
        $LastUpdatedDateTime = $this->input->post('DischargedCreatedDate');
        //----------------------------------------

        $remark = $this->input->post('remark');
        $outcomes=  $this->input->post('outcomes');
      
        $dischargediagnosis=  $this->input->post('dischargediagnosis');
        $referredto=  $this->input->post('referredto');
        $dischargeImmr = $this->input->post('dischargeImmr');
        $icdCode = $this->input->post('icdCode');       
      //   $
        
        $k = $this->admission->UpdateDischarge($bht_no, $discharjType, $remark, $LastUpdatedUser, $LastUpdatedDateTime,$outcomes,$dischargediagnosis,$referredto,$dischargeImmr,$icdCode);

        $this->UpdateBedAvailability($bedNo, $wardNo);

        redirect('inward/patientBHTC/BHTDischarge/' . $bht_no . '/' . $patientID);
    }
    
 public function BHTDischarge($bhtNo, $patientID) {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);
        
        
        
//        $data['tmp'] = json_decode($this->getPatientDetailsByPatientHIN($this->input->post('patientID')));
//        $data['patients'] = $data['tmp'][0];
        
        
        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $dischargeType = $this->getDischargeType($bhtNo);
        $data['dischjType'] = $dischargeType;
        
        if ($dischargeType == "IT") {
            $this->load->model('/inward/transfer/InternalTrasferModel', 'internaltransfer');
            $data['transviewData'] = $this->internaltransfer->getInternalTransferByBHTNo($bhtNo);
        } elseif ($dischargeType == "ET") {
            $this->load->model('/inward/transfer/ExternalTransferModel', 'Externaltransfer');
            $data['transviewData'] = $this->Externaltransfer->getExternalTransferByBHTNo($bhtNo);
        }
        
        
        $this->load->view('layout/headerBHT1', $data);
        $this->load->view('layout/navigationBHT1', $data);
        
        $this->load->view('inward/patientBHT/DischargePatient', $data);
        
        $this->load->view('layout/footer1');


    }
   
 //pdf discharge
    
  public function DischargePDF($bhtNo,$patientID){
        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $data['dischjType'] = $this->getDischargeType($bhtNo);
        
        
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigationBHT1',$data);


        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission'); 
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);
        //$data['patientsPDF'] = $data['wardadmission'][0];
                             
      
        
        $data['tmp'] = json_decode($this->getWardAdmissionByPatientID($this->input->post($patientID)));
        $data['patientsPDF'] = $data['tmp'][0];
        
        $this->load->model('/inward/treatment/diagnoseModel', 'diagnose');     
        $data['treatment']=  $this->diagnose->getDiagonseDetails($bhtNo) ;
        
        //$data['tmp'] = json_decode($this->getDiagonseDetails($this->input->post($bhtNo)));
        //$data['patienttreatment'] = $data['tmp'][0];
        
        //$this->admission->set_pid($this->input->post('patientID'));
        //$data['patients'] = json_decode($this->admission->getWardAdmissionByPatientID('patientID'));
                
        $this->load->view('inward/patientBHT/DischargePatientPDF',$data);
       // $this->load->view('lab/layout/sideMenu');
        
        $this->load->view('layout/footer1');
    }    
        
      public function getWardAdmissionDetails($bhtNo) {
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $ss = $this->admission->getWardAdmissionDetails($bhtNo);
        return $ss;
    }

  public function getWardAdmissionByPatientID($patientID) {
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $ss = $this->admission->getWardAdmissionByPatientID($patientID);
        return $ss;
    }
    
 public function getDiagonseDetails($bhtNo) {
        $this->load->model('/inward/treatment/diagnoseModel', 'diagnose');
        $ss = $this->diagnose->getDiagonseDetails($bhtNo) ;
        return $ss;
    }   
    
    
    
    public function UpdateBedAvailability($bedNo, $wardNo) {
        $this->load->model('/inward/admin/bedModel', 'bedModel');
        $bed = $this->bedModel->geBedByWardNoAndBedNo($wardNo, $bedNo);

        foreach ($bed as $value) {
            $bed_id = $value->bedID;
            $bed_no = $value->bedNo;
            $bed_type = $value->bedType;
            $ward_no = $value->wardNo->wardNo;
            $availble = $value->availability;
        }
        $this->load->model('/inward/admin/bedModel', 'bedModel');
        $this->bedModel->setBedID($bed_id);
        $this->bedModel->setBedNo($bed_no);
        $this->bedModel->setBedType($bed_type);
        $this->bedModel->setWardNo($ward_no);
        $this->bedModel->setAvailability("free");
        $this->bedModel->setPatientID(0);
        $ss = $this->bedModel->UpdateBed();
    }

    public function NewExtenalTransfer() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        date_default_timezone_set("Asia/Colombo");
        $this->load->model('/inward/transfer/ExternalTransferModel', 'transfers');
        $this->transfers->setBhtNo($this->input->post('bhtNo'));
        $this->transfers->setTransferFrom($this->input->post('fromHospital'));
        $this->transfers->setTransferTo($this->input->post('toHospital'));
        $this->transfers->setResonForTrasnsfer($this->input->post('resonForTrasnsfer'));
        $this->transfers->setReportOfSpacialExamination($this->input->post('reportOfSpacialExamination'));
        $this->transfers->setTreatmentSuggested($this->input->post('TreatmentSuggested'));
        $this->transfers->setTransferCreatedDate($this->input->post('TransferDateTime'));
        $this->transfers->setTransferCreatedUser($_SESSION['user']);
        $this->transfers->setNameOfGuardian($this->input->post('nameOfGuardian'));
        $this->transfers->setAddressOfGuardian($this->input->post('addressOfGuardian'));

        $ss = $this->transfers->insertExternalTransfer();

        $bht_no = $this->input->post('bhtNo');
        $patient_id = $this->input->post('patientID');

        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $discharjType = "ET"; //External Transfer Discharge Type
        $remark = $this->input->post('remark');
        $LastUpdatedUser = $_SESSION['user'];
        $LastUpdatedDateTime = $this->input->post('TransferDateTime');
        $k = $this->admission->UpdateDischarge($bht_no, $discharjType, $remark, $LastUpdatedUser, $LastUpdatedDateTime);

        $wardNo = $this->input->post('TransferFromWard');
        $bedNo = $this->input->post('bedNo');
        $this->UpdateBedAvailability($bedNo, $wardNo);


        redirect('inward/patientBHTC/BHT/' . $bht_no . '/' . $patient_id);
    }
    
     public function getAdmissionRequestCount() {
        $this->load->model('/inward/AdmissionRequestModel', 'request');


        $mywards = $this->getMywards();
        $count = 0;
        foreach ($mywards as $val) {


            $list = $this->request->getAdmissionRequestCount($val->wardNo);

            foreach ($list as $value) {
                $count = $count + 1;
            }
        }

        return $count;
    }

    //--------------------------------------------------------------
    //Methods for generate PDF in Discharge
    public function  getAllTestRequests()
    {
             $this->load->model('/lab/testRequestModel','requests');
             $ss=$this->requests->getAlltRequests();
             return $ss;
    }
 
    
     public function getAllPatientByBHT($bhtNo) {
        $this->load->model('/lab/testRequestModel', 'data');
        $ss = $this->data->getAllPatientByBHT($bhtNo);
        return $ss;
       
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>