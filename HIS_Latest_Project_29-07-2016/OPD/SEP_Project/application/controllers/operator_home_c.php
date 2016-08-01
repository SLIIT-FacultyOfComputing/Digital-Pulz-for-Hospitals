<?php
session_start();
    class operator_home_c  extends CI_Controller{
        var $_site_base_url=SITE_BASE_URL;
			public function __construct()
			{
				parent::__construct();                
			}
			
			public function index(){}
 
			public function view($visit_type,$doctor = '') 
			{ 
                            if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
			
				$data['doctor'] = $doctor;
				$data['title'] = "Operator Home";
				$data['status'] = '0';
				$this->load->view('Components/headerInward',$data);
				 
				// loading left side navigation
				$data['leftnavpage'] = 'operator_home_v';
				$data['visit_type'] = $visit_type;
				$this->load->view('Components/left_navbar',$data);
				//************************************************************************************
				
				if($visit_type == 0){
					 // show operator home
				  
				}
				
				if($visit_type == 1){
 				
					// load all patients 
					$this->load->model('PatientModel','patients');
					$data['patients'] = json_decode($this->patients->getAllPatients());

					//print_r($data['patients']);
					
					$this->load->view('patients_full_view_v',$data);

				}
				
				if($visit_type == 3){
				
					// get doc details
					$data['seldoc'] = NULL;
					$data['doclist'] = NULL;
					
					$this->load->model('ServiceModel','service');
					$data['doclist'] =  json_decode( $this->service->getDoctors());
                                        
					//****************************************************************************
					if($doctor != '')
					{ 
						$data['seldoc'] =  json_decode($this->service->getDoctor($doctor));
					}else
					{
						$data['seldoc'] =  json_decode($this->service->getDoctor($data['doclist'][0]->hrEmployee->empId));
					
					}

					$this->load->model('QueueModel','queue');
					$data['qpatients'] = json_decode( $this->queue->getQueuePatientsByUserID($doctor));
			 
					//****************************************************************************
					$data['qstatus'] = json_decode( $this->queue->getQStatus($data['doclist'][0]->hrEmployee->empId));   
					
					$data['qtype'] = json_decode( $this->queue->getQType());
					$this->load->view('operator_queue_v',$data);
				}
				
				
				$this->load->view('Components/bottom'); 
			}
				
			public function viewpatient($pid)
			{	
			
                            if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
                                
				$data['status'] = '0';
				$data['pid'] = $pid;
				$data['checkoutlast'] = NULL;
				
				$this->load->view('Components/headerInward',$data);
				 
				// loading left side navigation
				$data['leftnavpage'] = 'operator_home_view_patient';
				$data['visit_type'] = '';
				$this->load->view('Components/left_navbar',$data);
				//************************************************************************************
				
								
				// show the patient profile on the top patient profile
				$this->load->model('PatientModel','patient');
				$this->patient->set_pid($pid);
				$data['pprofile'] = json_decode($this->patient->getPatient());
				     $data['pprofilebmi'] = json_decode($this->patient->getPatient(),true);
				//$this->load->view('patient_profile_v',$data);
				//*************************************************************************
						
						
				//************************************************************************
				 
				// allergies
				$data['allergy'] = json_decode (json_encode($data['pprofile']->allergies),TRUE) ;

				// attachments
				$data['attachment'] = json_decode (json_encode($data['pprofile']->attachments),TRUE) ;
 	
				
				$this->load->view('patient_overview_v',$data);
			
				$this->load->view('Components/bottom'); 		
			}
			
        }
?>