<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

class patientHistoryC extends CI_Controller {

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
        $this->load->view('layout/headerInward', $data);
        
        $this->load->view('inward/patientBHT/PatientHistoryDetails');
        $this->load->view('layout/footerInward');
    }
    
      public function getPatientDetailsByPatientHIN($patientID) {
        $this->load->model('/inward/history/PatientHistoryDetailsModel', 'PatientDetails');
        $ss = $this->patientHistory->getPatientDetailsByPatientHIN($patientID);
        return $ss;
  
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
        $this->load->view('layout/headerInward', $data);
        $this->load->view('inward/patientBHT/patientBHT');

        $this->load->model('inward/opd/PatientModel', 'patient');
        $this->patient->set_pid($this->input->post('patientID'));
        $data['patients'] = json_decode($this->patient->getPatient());


        $data['WardAdmission'] = $this->getWardAdmissionByPatientID($this->input->post('patientID'));


        $this->load->view('inward/patientBHT/patientSearch', $data);
        $this->load->view('layout/footerInward');
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

    public function getWardAdmissionByPatientID($patientID) {
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $ss = $this->admission->getWardAdmissionByPatientID($patientID);
        return $ss;
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



        $this->load->view('layout/headerBHT', $data);
        $this->load->view('inward/patientBHT/BHTpatient', $data);
        $this->load->view('layout/footerInward');
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
        $this->load->view('layout/headerBHT', $data);
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
        $this->load->view('layout/headerBHT', $data);
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
        $this->load->view('layout/headerBHT', $data);
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
        $this->load->view('layout/headerBHT', $data);
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);

        $this->load->model('/inward/Allergy/AllergyModel', 'allergy');
        $data['allergies'] = $this->allergy->getAllergies($patientID);

        $this->load->view('inward/patientBHT/PatientDetails', $data);
        // $this->load->view('inward/patientBHT/NewAllergy', $data);
        $this->load->view('inward/patientBHT/BHTallergy', $data);
        $this->load->view('layout/footerInward');
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
        $this->load->view('layout/headerBHT', $data);
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);

        $this->load->model('/inward/Allergy/AllergyModel', 'allergy');
        $data['allergies'] = $this->allergy->getAllergies($patientID);

        $this->load->view('inward/patientBHT/PatientDetails', $data);
        $this->load->view('inward/patientBHT/NewAllergy', $data);
        //$this->load->view('inward/patientBHT/BHTallergy', $data);
        $this->load->view('layout/footerInward');
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
        $this->load->view('layout/headerBHT', $data);
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);

        $this->load->model('/inward/Allergy/AllergyModel', 'allergy');
        $data['allergies'] = $this->allergy->getAllergies($patientID);

        $this->load->view('inward/patientBHT/PatientDetails', $data);
        $this->load->view('inward/patientBHT/NewAllergy');
        $this->load->view('inward/patientBHT/BHTallergy', $data);
        $this->load->view('layout/footerInward');
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
        $this->load->view('layout/headerBHT', $data);
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
        $this->load->view('layout/footerInward');
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
        $this->load->view('layout/headerBHT', $data);
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
        $this->load->view('layout/headerBHT', $data);
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);
        $this->load->model('/inward/admin/wardModel', 'wardModel');
        $data['Wards'] = $this->wardModel->getAllWards();
        $this->load->view('inward/Transfer/newInternalTransfer', $data);
        $this->load->view('layout/footerInward');
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
        $this->load->view('layout/headerBHT', $data);
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);

        $this->load->view('inward/Transfer/newExternalTransfer', $data);
        $this->load->view('layout/footerInward');
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
        $this->load->view('layout/headerBHT', $data);
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);

        $this->load->view('inward/patientBHT/BHTDischarj', $data);
        $this->load->view('layout/footerInward');
    }

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
        $discharjType = $this->input->post('dischargeType');
        $remark = $this->input->post('remark');
        $LastUpdatedUser = $_SESSION['user'];
        $LastUpdatedDateTime = $this->input->post('DischargedCreatedDate');
        $k = $this->admission->UpdateDischarge($bht_no, $discharjType, $remark, $LastUpdatedUser, $LastUpdatedDateTime);

        $this->UpdateBedAvailability($bedNo, $wardNo);

        redirect('inward/patientBHTC/BHT/' . $bht_no . '/' . $patientID);
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

}

?>
    
    }
    
    
    
    

