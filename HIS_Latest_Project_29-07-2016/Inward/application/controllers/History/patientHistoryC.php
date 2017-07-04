<?php

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
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);
        
        $this->load->view('inward/patientBHT/patientSearchHistory');
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
        $this->load->view('layout/headerInward', $data);
        $this->load->view('inward/patientBHT/patientSearchHistory');
            
        $data['tmp'] = json_decode($this->getPatientDetailsByPatientHIN($this->input->post('patientID')));
        $data['patients'] = $data['tmp'][0];
        $this->load->view('inward/patientBHT/PatientHistorySearch', $data);
        $this->load->view('layout/footerInward');
    }
       public function SearchPatientViewtoDischarge() {
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
        $this->load->view('inward/patientBHT/patientSearchHistory');
            
        $data['tmp'] = json_decode($this->getPatientDetailsByPatientHIN($this->input->post('patientID')));
        $data['patients'] = $data['tmp'][0];
        $this->load->view('inward/patientBHT/PatientHistorySearchtoDiscarge', $data);
        $this->load->view('layout/footerInward');
    }

   //this function need 
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
//this function need
    public function getMywards() {
        if($_SESSION['RoleId'] == '2'){
            return $this->getAllWard();
        }else{
        $this->load->model('/inward/admin/wardModel', 'wardModel');
        return $this->wardModel->getWardByEmpID($_SESSION['EmpId']);     
        }
    }
//this function need
    public function getPatientDetailsByPatientHIN($patientID) {
        $this->load->model('/inward/history/patientHistoryModel', 'patientHistory');
        $ss = $this->patientHistory->getPatientDetailsByPatientHIN($patientID);
        return $ss;
    }
//this function need
    public function getDischargeType($bhtNo) {
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $admission = $this->admission->getWardAdmissionDetails($bhtNo);
        foreach ($admission as $value) {
            $discharjType = $value->dischargeType;
        }
        return $discharjType;
    }


       
//this function need    
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
    
