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
    class treatment_c  extends CI_Controller{
        var $_site_base_url=SITE_BASE_URL;
			public function __construct()
			{
				parent::__construct();                
			}

			public function index(){}
			 

			public function add($pid,$visitid,$status='0',$treatmentid='0')
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
				$data['title'] = 'New Treatment';
				$data['visitid'] = $visitid;

				$this->load->view('Components/headerInward',$data);
 	  
				// loading left side navigation
				$data['leftnavpage'] = '';
				$this->load->view('Components/left_navbar',$data);
				//************************************************************************************
				
				// load data for the selected treatment
				$this->load->model('TreatmentModel','treatment');
				$this->treatment->get_treatmentid( $treatmentid );
				$data['treatment'] = json_decode($this->treatment->getTreatment() );
				// show patient profile mini
				$this->load->model('PatientModel','patient');
				$this->patient->set_pid( $pid );
				$data['pprofile'] = json_decode( $this->patient->getPatient() );
				//$this->load->view('patient_profile_mini_v',$data);
				//****************************************************************************

				$this->load->view('treatment_m_v.php',$data); 
				 
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
				
				$this->load->model('TreatmentModel','treatment');
				$data['treatment'] = json_decode($this->treatment->getTreatment() );
				// load data for the selected treatment
				$data['opdtreatment'] = json_decode($this->treatment->getAllOpdTrements() );

				$this->load->view('opdtreatment_m_v.php',$data); 
				 
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
				$this->load->model('TreatmentModel','treatment');
				$this->treatment->set_treatmentid($this->input->post('treatment'));
				$this->treatment->set_status('Pending');
				$this->treatment->set_remarks($this->input->post('remarks'));
				$this->treatment->set_userid( $this->session->userdata("userid"));
				$this->treatment->set_visitid($visitid);
			  
				$data['status'] = $this->treatment->addTreatment();
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
				$this->load->model('TreatmentModel','treatment');
				$this->treatment->set_opdtreatmentid($this->input->post('inputopdTreatmentId'));
				$this->treatment->set_status($this->input->post('inputStatus'));
				$this->treatment->set_remarks($this->input->post('inputremarks'));
				$this->treatment->set_userid( $this->session->userdata("userid"));

				 
				$data['status'] = $this->treatment->updateTreatment();
								
				$this->view(3);
			 
			}
  
			
        }
?>