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

class patient_overview_c extends CI_Controller {

    var $_site_base_url = SITE_BASE_URL;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        
    }

    public function view($pid) {
    	$this->load->library('template');
    	$this->template->title('Patient Overview');
    	
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect($this->_site_base_url);
            }
        } else {
            redirect($this->_site_base_url);
        }
        $data['status'] = '0';
        $this->load->view('headerInward', $data);
        $data['checkoutlast'] = NULL;

        $data['title'] = "Patient Overview";

        // CHECK IN the patient if the patitne is in the queue and the user is a doctor
        $this->load->model('QueueModel', 'queue');
        $data['onq'] = json_decode($this->queue->isPatientInQueue($pid));

        //**********************************************************
        // if the doctor is viewing a patient and its not the current IN patient and hes on the queue
        // then ask to checkout the old patient and checkin the new one
        // if the patient is not on the queue then no worries ^_^


        $data['currentin'] = json_decode($this->queue->getCurrentInPatient($this->session->userdata("userid")));

        if ($data['currentin'] != NULL && $data['currentin']->patient->patientID != $pid && $data['onq'] != NULL) {
            //echo "you havent checkd out the last patient. wanna ? <br> ";
            $data['checkoutlast'] = $data['currentin']->patient->patientID;
        } else {
            if ($data['onq'] != NULL && $data['onq']->queueStatus == "Waiting") {
                $this->queue->checkinPatient($pid);
                $this->view($pid);
            }
        }

        //*******************************************************************************************


        if ($data['currentin'] == NULL && $this->session->userdata("userlevel") == 1 & $data['onq'] != NULL) {
            $service_url = SERVICE_BASE_URL . "queue/checkin/" . $pid;
            $curl = curl_init($service_url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $curl_response = curl_exec($curl);
            curl_close($curl);
        }
        //***************************************************************************
        // loading left side navigation
        $data['leftnavpage'] = 'patient_overview_v';
        $data['pid'] = $pid;
    //    $this->load->view('left_navbar_v', $data);
        //************************************************************************************
        // show the patient profile on the top patient profile
        $this->load->model('PatientModel', 'patient');
        $this->patient->set_pid($pid);
        $data['pprofile'] = json_decode($this->patient->getPatient());
        $data['pprofilebmi'] = json_decode($this->patient->getPatient(),true);
       
       //$this->load->view('patient_profile_v', $data); $this->load->view('patient_profile_v', $data);
        //*************************************************************************
        // load the details about the patient ( like allergies etc.. )
        // visits
        $data['visits'] = json_decode(json_encode($data['pprofile']->visits), TRUE);

        // examinations
        $data['exams'] = json_decode(json_encode($data['pprofile']->exams), TRUE);

        // notes and to dos
        $data['records'] = json_decode(json_encode($data['pprofile']->records), TRUE);

        // allergies
        $data['allergy'] = json_decode(json_encode($data['pprofile']->allergies), TRUE);



        // attachments
        $data['attachment'] = json_decode(json_encode($data['pprofile']->attachments), TRUE);

        // answered questionnaire
        $data['answerSet'] = json_decode(json_encode($data['pprofile']->answerSets), TRUE);

//        $this->load->model('LabOrderModel', 'laborderm');
//
//        // lab orders
//        $data['laborders'] = json_decode($this->laborderm->getPatientLabOrders($pid));
        $this->load->model('LabOrderModel', 'laborderm');
       // $data['laborders'] = json_decode($this->laborderm->getVisitLabOrders($vid));
        $data['labs'] = json_decode($this->laborderm->getVisitLabOrdersByPid($pid));


        
        $this->template
        ->set_layout('panellayout')
        ->build('patient_overview_v',$data);
        //************************************************************************

    }

}

?>