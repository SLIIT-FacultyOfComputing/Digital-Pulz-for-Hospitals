<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
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
     public function index($pid) {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('http://localhost/SEP_Project');
            }
        } else {
            redirect('http://localhost/SEP_Project');
        }
        
        
        $data['patient_id']=$pid;
       $this->load->view('Components/headerInward');
        //$this->load->view('layout/headerInward', $data);        
      
        //$this->load->view('layout/footerInward');
       $data['leftnavpage'] = 'admission';
      $this->load->view('Components/left_navbar',$data);
       $this->load->view('inward/AdmissionRequestView',$data);
      $this->load->view('Components/bottom');
    }
    
    public function RequestAdmission() {
        
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('http://localhost/SEP_Project');
            }
        } else {
            redirect('http://localhost/SEP_Project');
        }
         //$this->load->view('headerInward');
      
       
	       //$data['pid'] = $this->input->post('pid');
         $data['patient_id']= $this->input->post('pid');
       
        //echo $pid;
       // die();
        
        //request admission
         $request_unit="OPD";
         $is_read=0;
         
          //$this->load->view('headerInward');  
         $this->load->model('/inward/AdmissionRequestModel','admission');
        // print_r($this->input->post('pid'));
         //exit();
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



        $this->load->view('Components/headerInward');
        //$this->load->view('layout/headerInward', $data);        
      
        //$this->load->view('layout/footerInward');
        $data['leftnavpage'] = 'admission';
        $this->load->view('Components/left_navbar',$data);
        $this->load->view('inward/AdmissionRequestSucess',$data);
        $this->load->view('Components/bottom');
       
    }
      


}

?>
