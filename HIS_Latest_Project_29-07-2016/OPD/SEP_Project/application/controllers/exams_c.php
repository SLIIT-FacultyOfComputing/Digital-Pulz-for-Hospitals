<?php
session_start();
    class exams_c  extends CI_Controller{
        var $_site_base_url=SITE_BASE_URL;
			public function __construct()
			{
				parent::__construct();                
			}

			public function index(){}
			 

			public function add($pid,$visitid,$status='0')
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
				$data['title'] = 'New Examination';
				$data['visitid'] = $visitid;
				$this->load->view('Components/headerInward',$data);
 	  
				// loading left side navigation
				$data['leftnavpage'] = '';
				$this->load->view('Components/left_navbar',$data);
				//************************************************************************************
				
				
				// show patient profile mini
				$this->load->model('PatientModel','patient');
				$this->patient->set_pid( $pid );
				$data['pprofile'] = json_decode( $this->patient->getPatient() );
				//$this->load->view('patient_profile_mini_v',$data);
				//****************************************************************************

				$this->load->view('exam_m_v.php',$data); 
				 
				$this->load->view('Components/bottom'); 
			}
			
			
			public function edit($pid,$examid,$status='0')
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
				$data['title'] = 'Edit Examination';
				$data['visitid'] = '0';
				$data['examid'] = $examid ;
				$this->load->view('headerInward',$data);
 	  
				// loading left side navigation
				$data['leftnavpage'] = '';
				$this->load->view('left_navbar_v',$data);
				//************************************************************************************
				 
				// show patient profile mini
				$this->load->model('PatientModel','patient');
				$this->patient->set_pid( $pid );
				$data['pprofile'] = json_decode( $this->patient->getPatient() );
				$this->load->view('patient_profile_mini_v',$data);
				//****************************************************************************

				
				// load data for the selected exam
				$this->load->model('ExamModel','exam');
				$this->exam->set_patexamid( $examid );
				$data['exam'] = json_decode($this->exam->getExams() );
				//****************************************************************************				
				 
				
				$this->load->view('exam_m_v.php',$data); 
				 
				$this->load->view('bottom'); 
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
				$this->load->model('ExamModel','exam');
				$this->exam->set_pid($pid);
				$this->exam->set_height($this->input->post('Height'));
				$this->exam->set_weight($this->input->post('Weight'));
				$this->exam->set_bmi($this->input->post('bmi'));

				$this->exam->set_examdate($this->input->post('ExamDate'));
				$this->exam->set_temprature($this->input->post('Temperature'));
				$this->exam->set_sys_bp($this->input->post('SysBP'));
				$this->exam->set_diast_bp($this->input->post('DiastBP'));
				$this->exam->set_userid( $this->session->userdata("userid"));
				$this->exam->set_visitid($visitid);
			  
				$data['status'] = $this->exam->addExam();
				$this->add($pid,$visitid,$data['status']);
			}
  
  
  
			
			public function update($pid,$examid)
			{
				if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                } 
				$this->load->model('ExamModel','exam');
				$this->exam->set_patexamid( $examid );
				$this->exam->set_height($this->input->post('Height'));
				$this->exam->set_weight($this->input->post('Weight'));
				$this->exam->set_bmi($this->input->post('bmi'));
				$this->exam->set_examdate($this->input->post('ExamDate'));
				$this->exam->set_temprature($this->input->post('Temperature'));
				$this->exam->set_sys_bp($this->input->post('SysBP'));
				$this->exam->set_diast_bp($this->input->post('DiastBP'));
				$this->exam->set_userid( $this->session->userdata("userid"));
				$this->exam->set_active( $this->input->post('active'));
				 
				$data['status'] = $this->exam->updateExam();
								
				$this->edit($pid,$examid,$data['status']);
			 
			}
  
			
        }
?>