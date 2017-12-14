<?php

session_start();

class PatientArchiveC extends CI_Controller {

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
        
        $this->load->view('inward/patientBHT/patientArchive');
        $this->load->view('layout/footer1');
    }
    
    //load the HIN searching view 
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
              
        $data['tmp'] =($this->getPatientByHIN($this->input->post('patientID')));
        $data['patients'] = $data['tmp'][0];
          
        $this->load->view('inward/patientBHT/PatientArchiveDetails', $data);
        $this->load->view('layout/footer1');
    }
    
        public function SearchPatientDownload() {
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
        
        $data['tmp1'] =($this->getPatientByHIN($this->input->post('patientID')));
        $data['patients'] = $data['tmp1'];
        
        //serach the patient by giving the HIN to the system
        $data['details'] = ($this->getPatientByHIN($this->input->post('patientID'))); 
        
        
        $data['tmp'] =($this->getPatientByID($this->input->post('patientID')));
        $data['patients'] = $data['tmp'];
        
        $data['wardadmission'] = ($this->getWardAdmissionByPatientID($this->input->post('patientID'))); 
        
      
        $this->load->view('inward/patientBHT/PatientArchiveOutput', $data);
        $this->load->view('layout/footerInward');

        }
    
        
    //Method to retrieve the patient details by HIN
    public function getPatientByHIN($hin) {
        $this->load->model('inward/opd/PatientModel', 'patient');
        $ss = $this->patient->getPatientByHIN($hin);
        return $ss;
    }
    
     public function getPatientByID($patientID) {
        $this->load->model('inward/opd/PatientModel', 'patient');
        $ss = $this->patient->getPatientByID($patientID);
        return $ss;
    }
     public function getAllergies($patientID) {
        $this->load->model('/inward/Allergy/AllergyModel', 'allergy');
        $ss = $this->patient->getAllergies($patientID);
        return $ss;
    }
    
    public function getWardAdmissionByPatientID($patientID) {
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $ss = $this->admission->getWardAdmissionByPatientID($patientID);
        return $ss;
    }
    
    
    
    
    public function getMywards() {
        if($_SESSION['RoleId'] == '2'){
            return $this->getAllWard();
        }else{
        $this->load->model('/inward/admin/wardModel', 'wardModel');
        return $this->wardModel->getWardByEmpID($_SESSION['EmpId']);     
        }
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