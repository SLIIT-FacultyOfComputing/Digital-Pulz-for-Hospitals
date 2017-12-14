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
class doctor_home_c extends CI_Controller {
    var $_site_base_url=SITE_BASE_URL;
    public function __construct() {
        parent::__construct();
    }

    public function index() {

    }

    public function view($visit_type) {
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect($this->_site_base_url);
            }
        } else {
            redirect($this->_site_base_url);
        }
        
        $data['title'] = "Doctor Home";
        // load queue belongs to this doctor.  
        $this->load->model('QueueModel', 'queue');
        $data['qpatients'] = json_decode($this->queue->getQueuePatientsByUserID($_SESSION['user']));
        
        //************************************************************************************
        $data['status'] = '0';
        $data['leftnavpage'] = '';

        // loading left side navigation

        $data['visit_type'] = $visit_type;
        //************************************************************************************
        if ($visit_type == 1 | $visit_type == 2 | $visit_type == 3) {
          $this->load->model('PatientModel', 'patient');
          $data['patients'] = json_decode($this->patient->getDoctorPatients($_SESSION['user'], $visit_type));

          $this->load->library('template');
          $this->template->title('Patients');
          $this->template
          ->set_layout('panellayout') 
          ->build('patients_v',$data);
            // load patients belong to this doctor. here the doc id should be passed to service
            //************************************************************************************
      } else if ($visit_type == 4) {
            // load lab orders
            // load lab orders belong to this doctor.  
        $this->load->model('LabOrderModel', 'laborder');
        $data['laborders'] = json_decode($this->laborder->getDoctorLabOrders($_SESSION['user']));
            //************************************************************************************
        $this->load->view('laborder_v', $data);
    } else if ($visit_type == 5) {

            // get doc details
        $this->load->model('ServiceModel', 'service');
        $data['seldoc'] = json_decode($this->service->getDoctor($this->session->userdata('userid')));

        $data['treatedpatients'] = json_decode($this->queue->getTreatedPatients($_SESSION['user']));

        

        $data['qstatus'] = json_decode($this->queue->getQStatus($_SESSION['user']));

        //$data['qtype'] = json_decode($this->queue->getQType());
        $data['qtype'] = json_decode($this->queue->getQTypeForDoctor($_SESSION['user']));

        $this->load->library('template');
        $this->template->title('Dashboard');
        $this->template
        ->set_layout('panellayout') 
        ->build('doctor_p_queue_v',$data); 

    } else if ($visit_type == 0) {

            //load doctor home  
    }

       //$this->load->view('bottom');
}

}

?>