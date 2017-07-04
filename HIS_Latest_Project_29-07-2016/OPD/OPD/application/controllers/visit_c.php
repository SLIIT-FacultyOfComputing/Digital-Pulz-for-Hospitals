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
    class visit_c  extends CI_Controller{
            var $_site_base_url=SITE_BASE_URL;
			public function __construct()
			{
				parent::__construct(); 
			
			}

			public function index(){}
			
			public function view()
			{	
				
			}

			public function add($pid,$status = '0')
			{
				 if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
				$data['status'] = $status;
				$data['visitid'] = '0';
				$data['pid'] = $pid;
				$data['title'] = 'New Visit';
				
				//$this->load->view('headerInward',$data);
 	  
				// loading left side navigation
				$data['leftnavpage'] = 'create_visit';
				//$this->load->view('left_navbar_v',$data);
				//************************************************************************************
				
				
				// show patient profile mini
				 $this->load->model('PatientModel','patient');
				 $this->patient->set_pid( $pid );
				 $data['pprofile'] = json_decode( $this->patient->getPatient() );
				// $this->load->view('patient_profile_mini_v',$data);
				//****************************************************************************
 
				// get complaint list
				$this->load->model('ServiceModel','service');
				$data['complaints'] =  $this->service->getComplaints();
				//****************************************************************************
 
				//$this->load->view('visit_m_v',$data); 
				//$this->load->view('bottom'); 
				$this->load->library('template');
				$this->template->title('Patient');
				$this->template
				->set_layout('panellayout')
				->build('visit_m_v',$data);
			}

			public function edit($pid, $VISITID, $status = '0')
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
			  
				$data['visitid'] = $VISITID;
				$data['title'] = 'Edit Visit';
				
				$this->load->view('headerInward',$data);
 
				// loading left side navigation
				$data['leftnavpage'] = '';
				//************************************************************************************
				 
				
				// load data for the selected visit
				$this->load->model('VisitModel','visit');
				$data['visit'] = json_decode($this->visit->getVisitByVisitID($VISITID));
				//****************************************************************************				
 
				$this->load->library('template');
				$this->template->title('Patient');
				$this->template
				->set_layout('panellayout')
				->build('visit_m_v',$data);
				 
				//$this->load->view('bottom'); 
			}
			 
			 
			public function save($pid)
			{
                                if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
				$this->load->model('VisitModel','visit');

				$this->visit->set_pid($pid);
				$this->visit->set_dateofvisit($this->input->post('DateandTime'));
				$this->visit->set_doctor( $this->session->userdata("userid"));
				$this->visit->set_userid( $this->session->userdata("userid"));
				$this->visit->set_visittype($this->input->post('VisitType'));
				$this->visit->set_complaint($this->input->post('Injury'));
				$this->visit->set_remarks($this->input->post('Remarks'));

				$data['status'] = $this->visit->addVisit();
				$this->add($pid,$data['status']);
			
				if($data['status'] != null)
				{
					// get the visit id of the visit we just created
					$this->load->model('VisitModel','visit');
					$this->visit->set_pid($pid);
					$recentvisit = json_decode( $this->visit->getRecentVisitID() );
					//****************************************************************************
				   	redirect('patient_visit_c/view1/'.$pid.'/'.$recentvisit[0]->visitID);





				}else
				{
					$this->add($pid,$data['status']);
				}
				
			}

			
			public function update($pid, $VISITID)
			{
                                if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
				$this->load->model('VisitModel','visit');
				
				$this->visit->set_pid($pid); 
				$this->visit->set_visitid($VISITID); 
				$this->visit->set_doctor( $this->session->userdata("userid"));
				$this->visit->set_userid( $this->session->userdata("userid"));
				$this->visit->set_visittype($this->input->post('VisitType'));
				$this->visit->set_complaint($this->input->post('Injury'));
				$this->visit->set_remarks($this->input->post('Remarks'));
					$this->visit->set_dateofvisit($this->input->post('DateandTime'));
					
				$data['status'] = $this->visit->updateVisit();
				$this->edit($pid, $VISITID, $data['status']);
			   
			}
 
 			public function getComplainsOnSearch($inputInjury)
			{
				$this->load->model('VisitModel','visit');
				$result = $this->visit->getComplainsOnSearch($inputInjury);
				print_r($result);
				return $result;
			}
        }
?>