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
    class queue_c  extends CI_Controller{
            var $_site_base_url=SITE_BASE_URL;
			public function __construct()
			{
				parent::__construct(); 
			
			}

			public function index(){}
			
			public function view()
			{}

			public function add($pid,$status = '0',$full=null)
			{
                            if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
				$data['status'] = $status;

				if($full!=null)
				{
					$data['title'] = "<h4>doctor "+$full+"is full</h4>";
					$this->load->model('ServiceModel', 'service');
					$data['full'] = json_decode($this->service->getDoctor($full));

				}
				else
				{
					$data['full'] ="";
				}
			

				$data['visitid'] = '0';
				$data['pid'] = $pid;
				$data['title'] = 'Add to Queue';

				$this->load->view('Components/headerInward',$data);
								
				// loading left side navigation
				$data['leftnavpage'] = '';
				$data['visit_type'] = '';
				$this->load->view('Components/left_navbar',$data);
				//************************************************************************************

				// show patient profile mini
				$this->load->model('PatientModel','patient');
				$this->patient->set_pid( $pid );
				$data['pprofile'] = json_decode( $this->patient->getPatient() );				
				$this->load->view('patient_profile_mini_v',$data);
				//****************************************************************************
  	
				// check if the patient is already in the queue
				$this->load->model('QueueModel','queue');
				$data['isonq'] = json_decode( $this->queue->isPatientInQueue($pid) );
				//****************************************************************************
			 
				$this->load->model('ServiceModel','service');
					 
				if($_SERVER['REQUEST_METHOD'] != 'POST' & $data['isonq'] != NULL)
				{ 
					$data['status'] = "True";
			     	$data['title'] = "<h4>Patient is already in the queue </h4>";
					
 				}else
				{
					// get doctor list
					$data['doctors'] = json_decode( $this->service->getDoctors());
					//****************************************************************************
					    
					$data['docpatients'] = array();	
//                                        echo $data['doctors']->userId;
//                                        die;
					foreach($data['doctors']  as $doctor)
					{ 
						$data['patients'] = json_decode( $this->queue->getQueuePatientsByDoctorID($doctor->hrEmployee->empId));
						  
						array_push($data['docpatients'],  array($doctor->hrEmployee->firstName , $doctor->hrEmployee->lastName,sizeof( $data['patients']), $doctor->status));
					}
					//****************************************************************************
                }
				if( json_decode( $this->queue->getQType()) == "0")
					$data['assigndoc'] = json_decode( $this->queue->getNextAssignDoctor());
				else
					$data['assigndoc'] = json_decode( $this->queue->getNextAssignDoctor($pid));
			
			
				if($data['assigndoc'] == null) 
				{
					$url = base_url()."index.php/operator_home_c/view/3";
					header("Location:".$url);
                                        //echo 'no doctors';
				}
				
			 	$this->load->view('queue_m_v',$data); 
				$this->load->view('Components/bottom');   
			}
 
			 
			public function save($pid)
			{
			if (isset($_SESSION["user"])) {
                if ($_SESSION["user"] == -1) {
                    redirect($this->_site_base_url);
                }
            } 
            else {
                        redirect($this->_site_base_url);
                  }
				$this->load->model('QueueModel','queue');

				
				$this->queue->setQueueAssignedBy($this->session->userdata("userid") ) ;
				$this->queue->setQueueAssignedTo($this->input->post('doctor'));
				$this->queue->setQueueRemarks($this->input->post('Remarks'));
				$this->queue->setPatient( $pid);

                $formSubmit = $this->input->post('autobtn');
	            if($formSubmit == 'auto')
                {
                    $data = json_decode($this->queue->addToQueueAuto(), true);
                }else {
                    $data = json_decode($this->queue->addToQueue(), true);
                }
				$this->add($pid,$data['status'],$data['full']);
				//print_r($data);
				//echo $data['status'];
				


			}
			
			public function remove($pid)
			{ 
                            if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
			    $this->load->model('QueueModel','queue');
 				$data['status'] =  $this->queue->removeFromQueue($pid, $this->session->userdata("userid"));
				$url = base_url()."index.php/doctor_home_c/view/5";
				header("Location:".$url);
			}
			
			public function redirectQueue()
			{ 
                            if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == 0) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
			    $this->load->model('QueueModel','queue');
				$doctor = $this->session->userdata("userid");
 				$this->queue->redirectQueue($doctor); 
				$url = base_url()."index.php/doctor_home_c/view/5";
				header("Location:".$url);
			}
			
			public function holdQueue($val = TRUE)
			{
                            if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
				$this->load->model('QueueModel','queue');
				$doctor = $this->session->userdata("userid");
 				$this->queue->holdQueue($doctor); 
				$url = base_url()."index.php/doctor_home_c/view/5";
				header("Location:".$url);
			}
			 
		 	public function setQType()
			{
                if (isset($_SESSION["user"])) {
                    if ($_SESSION["user"] == -1) {
                        redirect($this->_site_base_url);
                    }
                } else {
                    redirect($this->_site_base_url);
                }
				$this->load->model('QueueModel','queue');
                $type = $this->queue->getQTypeForDoctor($this->session->userdata("userid"));

                if($type == 0) {
                    $this->queue->setQTypeForDoctor(1, $this->session->userdata("userid"));
                }
                else{
                    $this->queue->setQTypeForDoctor(0, $this->session->userdata("userid"));
                }
				$url = base_url()."index.php/doctor_home_c/view/5";
				header("Location:".$url);
			}
			 
        }
?>