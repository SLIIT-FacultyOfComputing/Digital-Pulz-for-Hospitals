 
<?php

class PatientHistoryC extends CI_Controller{
    public function InternalTransfer($bhtNo, $patientID) {
//        if (isset($_SESSION['user'])) {
//            if ($_SESSION['user'] == -1) {
//                redirect('Login/index');
//            }
//        } else {
//            redirect('Login/index');
//        }
//        date_default_timezone_set("Asia/Colombo");
        //check whether patient allready transfered or not.

        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $data['dischjType'] = $this->getDischargeType($bhtNo);
        $this->load->view('layout/headerBHT', $data);
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);
        $this->load->model('/inward/admin/wardModel', 'wardModel');
        $data['Wards'] = $this->wardModel->getAllWards();
        $this->load->view('inward/wardAdmission/PatientHistory', $data);
        $this->load->view('layout/footerInward');
    }
        
        }



