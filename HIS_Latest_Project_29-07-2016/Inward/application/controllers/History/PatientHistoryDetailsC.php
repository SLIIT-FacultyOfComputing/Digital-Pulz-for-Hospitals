<?php

session_start();

class PatientHistoryDetailsC extends CI_Controller {

     public function index() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        //the first two functions are most important as they were load the thing relevant to the header and footer
        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount()+ $this->getAdmissionRequestCount());
        

        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);


        $this->load->model('inward/history/PatientHistoryDetailsModel');
        
        
        if(!empty($_POST['patientHin']) && isset($_POST['patientHin'])){
            $data['patientData']=  json_decode($this->PatientHistoryDetailsModel->getPatientDetails());
        }
        
        $this->load->view('inward/History/PatientHistoryDetails',$data);
        $this->load->view('layout/footer1');
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