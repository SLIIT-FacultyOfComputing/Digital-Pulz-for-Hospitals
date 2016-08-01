<?php
session_start();
    class print_c  extends CI_Controller{
            var $_site_base_url=SITE_BASE_URL;
			public function __construct()
			{
				parent::__construct();                
			}

			public function index(){}
			 
 
			public function print_patient_card($pid)
			{
			 if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
			 	$this->load->model('PatientModel','patient');
				$this->patient->set_pid( $pid );
				$data['pprofile'] = json_decode( $this->patient->getPatient() );
				
				$this->load->view('patient_card_p_v',$data);
			}
			
			public function print_prescription($pid,$presid)
			{
                                if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
				$this->load->model('PatientModel','patient');
				$this->patient->set_pid( $pid );
				$data['pprofile'] = json_decode( $this->patient->getPatient() );
				
				// load details of prescriptions for that visits
				$service_url = SERVICE_BASE_URL."Prescription/get/".$presid;
				$curl = curl_init($service_url);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				$curl_response = curl_exec($curl);
				curl_close($curl);
				$data['presitems'] = json_decode($curl_response);
				 $data['presitems']  =  $data['presitems']->prescribeItems ;
				//****************************************************************************
			
				/*
				// load username of the doc
				$service_url = SERVICE_BASE_URL."services/getfullusername/".$this->session->userdata("userid");
				$curl = curl_init($service_url);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				$curl_response = curl_exec($curl);
				curl_close($curl);
				$data['username'] = $curl_response;
				//****************************************************************************		
				 */ 
				$this->load->view('perscription_p_v.php',$data); 
			}
			
			public function print_token($pid,$token)
			{
				if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
                                $this->load->model('PatientModel','patient');
				$this->patient->set_pid( $pid );
				$data['pprofile'] = json_decode( $this->patient->getPatient() );
				$this->load->model('QueueModel','queue'); 
				$data['queue'] = json_decode($this->queue->isPatientInQueue( $pid ));
				 
			 	$this->load->view('patient_token_p_v',$data);
			 
			}
			
			public function print_PatientSlip($pid)
			{
                                if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
				$this->load->model('PatientModel','patient');
				$this->patient->set_pid( $pid );
				$data['pprofile'] = json_decode( $this->patient->getPatient() );
				
				$this->load->view('patient_slip_p' ,$data);
			}
			
			
			
			public function print_visitSummary($pid,$vid)
			{
				 if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
				$this->load->model('VisitModel','visitm');
				$this->visitm->set_visitid($vid);
				$this->visitm->set_pid($pid);
				
				 
				// load details of the visit
				$data['visit']  = json_decode($this->visitm->getVisitByVisitID($vid));
				//****************************************************************************
			 
			 	// load patient details
				$this->load->model('PatientModel','patient');
				$this->patient->set_pid( $pid );
				$data['pprofile'] = json_decode( $this->patient->getPatient() );
				//****************************************************************************
$data['presitems'] =  json_decode (json_encode($data['visit']->prescriptions[0]->prescribeItems  ),TRUE);
				
				// load details of prescriptions for that visits
			/*	if($data['visit']->prescriptions != null && sizeof( $data['visit']->prescriptions) > 0 )
				{
					$data['presitems'] =  json_decode (json_encode($data['visit']->prescriptions[0]->prescribeItems  ),TRUE);
				}
				else
				{
					$data['presitems'] = NULL;
				}
                         * */
                         
				//****************************************************************************
				 
	 
				// load details of laborders for that visits
				$data['labtests']  = NULL; //json_decode (json_encode($data['visit']->laborders   ),TRUE);
				if($data['labtests'] == NULL) $data['labtests']  = NULL;
				//****************************************************************************
				 
			
				
				// load details of examinations for that visits
				$data['exams']  =  json_decode (json_encode($data['visit']->exams ),TRUE);
				if($data['exams'] == NULL) $data['exams']  = NULL;
				//****************************************************************************
    
				$this->load->view('patient_visit_summary_p' ,$data); 
			}
			
			 		
		
			public function print_PatientLabTests($pid,$visitid)
			{
			
			}
			
			
        }
?>