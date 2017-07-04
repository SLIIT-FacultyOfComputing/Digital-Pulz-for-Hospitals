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
    class injection_c  extends CI_Controller{
        var $_site_base_url=SITE_BASE_URL;
			public function __construct()
			{
				parent::__construct();                
			}

			public function index(){}
			 

			public function add($pid,$visitid,$status='0',$injectionid='0')
			{
                if (isset($_SESSION["user"])) {
                    if ($_SESSION["user"] == -1) {
                        redirect($this->_site_base_url);
                    }
                    } else {
                        redirect($this->_site_base_url);
                    }
				$data['status'] = $status;
				$data['pid'] = $pid;
				$data['title'] = 'New Injection';
				$data['visitid'] = $visitid;

				$this->load->view('Components/headerInward',$data);
 	  
				// loading left side navigation
				$data['leftnavpage'] = '';
				$this->load->view('Components/left_navbar',$data);
				//************************************************************************************
				
				// load data for the selected treatment
				$this->load->model('InjectionModel','injection');
				$this->injection->get_injectionid( $injectionid );
				$data['injection'] = json_decode($this->injection->getInjection() );
				// show patient profile mini
				$this->load->model('PatientModel','patient');
				$this->patient->set_pid( $pid );
				$data['pprofile'] = json_decode( $this->patient->getPatient() );
				//$this->load->view('patient_profile_mini_v',$data);
				//****************************************************************************

				$this->load->view('injection_m_v.php',$data); 
				 
				$this->load->view('Components/bottom'); 
			}
			
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
				
				$this->load->model('InjectionModel','injection');
				$data['injection'] = json_decode($this->injection->getInjection() );
				// load data for the selected treatment
				$data['opdinjection'] = json_decode($this->injection->getAllOpdInjections() );

				$this->load->view('opdinjection_m_v.php',$data); 
				 
				$this->load->view('Components/bottom'); 
			}
			
			
			
			public function save($pid,$visitid)
			{
                                if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
				$this->load->model('InjectionModel','injection');
				$this->injection->set_injectionid($this->input->post('injection'));
				$this->injection->set_status('Pending');
				$this->injection->set_remarks($this->input->post('remarks'));
				$this->injection->set_userid( $this->session->userdata("userid"));
				$this->injection->set_visitid($visitid);
			  
				$data['status'] = $this->injection->addInjection();
				$data['title'] = 'Edit';
				$data['visitid'] = $visitid;
				$this->add($pid,$visitid,$data['status']);
			}
  
  
  
			
			public function update()
			{
				if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                } 
				$this->load->model('InjectionModel','injection');
				$this->injection->set_opdinjectionid($this->input->post('inputopdInjectionId'));
				$this->injection->set_status($this->input->post('inputStatus'));
				$this->injection->set_remarks($this->input->post('inputremarks'));
				$this->injection->set_userid( $this->session->userdata("userid"));

				 
				$data['status'] = $this->injection->updateInjection();
								
				$this->view(3);
			 
			}
  
			
        }
?>