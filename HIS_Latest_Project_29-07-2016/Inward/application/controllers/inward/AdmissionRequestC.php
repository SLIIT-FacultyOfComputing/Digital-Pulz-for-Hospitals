<?php
session_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdmissionRequestC
 *
 * @author Hasangi
 */
class AdmissionRequestC extends CI_Controller {
    //put your code here
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
        //$this->load->view('layout/opdheader', $data);   
        
        
        $this->load->view('inward/AdmissionRequestView');
        $this->load->view('layout/footer1');
    }
     public function getAllWard() {
        $this->load->model('/inward/admin/wardModel', 'wardModel');
        $list = $this->wardModel->getAllWards();
        return $list;
    }
    public function RequestAdmission() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount()+ $this->getAdmissionRequestCount());
        //$this->load->view('layout/opdheader', $data);
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);
        
        
        
        //request admission
         $request_unit="OPD";
         $is_read=0;
         
         $this->load->model('/inward/AdmissionRequestModel', 'admission');
         $this->admission->setPatient_id($this->input->post('pid'));  
         $this->admission->setIs_user_doctor($this->input->post('is_user_doctor'));
         $this->admission->setTransfer_ward($this->input->post('ward'));
         $this->admission->setRemark($this->input->post('Remark'));
         
         $this->admission->setCreate_user($_SESSION['user']);
         $this->admission->setLast_update_user($_SESSION['user']);
         $this->admission->setIs_read( $is_read);
         $this->admission->setRequest_unit($request_unit);
         //set time zone for sri lanka
            date_default_timezone_set("Asia/Colombo");
         $this->admission->setCreate_date_time(date('Y-m-d\TH:i'));
         $this->admission->setLast_update_date_time(date('Y-m-d\TH:i'));
       
         $sss= $this->admission->insertaddAdmissionRequest();
       if ($sss == 'true') {
           $data['status']="sucess";
       }else{
           $data['status']="fail";
       }
                     
        $this->load->view('inward/AdmissionRequestSucess',$data);
         $this->load->view('inward/AdmissionRequestView');
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

?>
