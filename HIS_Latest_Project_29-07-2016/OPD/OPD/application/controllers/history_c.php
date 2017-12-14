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
    class history_c  extends CI_Controller{
            var $_site_base_url=SITE_BASE_URL;
			public function __construct()
			{
				parent::__construct();                
			}

			public function index(){} 
			
			public function save($pid,$visitid)
			{
				if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
				$this->load->model('HistoryModel','history');
  
				$this->history->setPatient($pid);
				$this->history->setRecordType($this->input->post('rectype'));
				$this->history->setRecordText($this->input->post('RecordText'));
				$this->history->setRecordVisibility($this->input->post('recvisible'));
				$this->history->setRecordCreateUser($this->session->userdata("userid"));
				$this->history->getRecordLastUpdateUser($this->session->userdata("userid"));
				$this->history->setRecordCompleted(0); 
  
				$data['status'] = $this->history->addHistory();
				$this->add($pid,$visitid,$data['status']);
			}
			
			public function update($pid,$hid)
			{
				if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
				$this->load->model('HistoryModel','history');
				 
				$this->history->setPatientRecordID($hid);
				$this->history->setPatient($pid);
				$this->history->setRecordType($this->input->post('rectype'));
				$this->history->setRecordText($this->input->post('RecordText'));
				$this->history->setRecordVisibility($this->input->post('recvisible'));
				$this->history->setRecordLastUpdateUser($this->session->userdata("userid"));
				 
				if( $this->input->post('rectype') == 1)
			    	$this->history->setRecordCompleted(  $this->input->post('completed') ); 
				else
				    $this->history->setRecordCompleted(0);
				
				$data['status'] = $this->history->updateHistory();
				 
				$this->edit($pid,$hid,$data['status']);
			}
			
			
			public function edit($pid,$hid,$status='0')
			{
				$this->load->library('template');
    			$this->template->title('Edit Notes');
    	
        
                if (isset($_SESSION["user"])) {
                if ($_SESSION["user"] == -1) {
                    redirect($this->_site_base_url);
                }
                } else {
                    redirect($this->_site_base_url);
                }
				$data['status'] = $status;
				$data['hid'] = $hid;
				$data['pid'] = $pid;
				$data['visitid'] = '0';
			    $data['title'] = 'Edit Note | ToDo';		
				$this->load->view('headerInward',$data);
 	
	
				// loading left side navigation
				//$data['leftnavpage'] = '';
				//$this->load->view('left_navbar_v',$data);
				//************************************************************************************
				
				
				// show patient profile mini
				$this->load->model('PatientModel','patient');
				$this->patient->set_pid( $pid );
				$data['pprofile'] = json_decode( $this->patient->getPatient() );
				$this->load->view('patient_profile_mini_v',$data);
				//****************************************************************************
 

				// get histroy rec to edit
				$this->load->model('HistoryModel','record'); 
				$data['record'] = json_decode($this->record->getRecordByRecordID($hid) );
				//****************************************************************************
				$data['leftnavpage'] = 'history_m_v';
   				$this->template
        			->set_layout('panellayout')
        			->build('history_m_v',$data);
				
				//$this->load->view('history_m_v',$data);
				
				$this->load->view('bottom');
			}
			
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
				$data['visitid'] = $visitid;
                                $data['title'] = 'Add a Note or To Do';		
				$this->load->view('headerInward',$data);
 	
	
				// loading left side navigation
				$data['leftnavpage'] = 'history_m_v';
				$this->load->view('left_navbar_v',$data);
				//************************************************************************************
				
				
				// show patient profile mini
				$this->load->model('PatientModel','patient');
				$this->patient->set_pid( $pid );
				$data['pprofile'] = json_decode( $this->patient->getPatient() );
				$this->load->view('patient_profile_mini_v',$data);
				//****************************************************************************
 			
				//$this->load->view('history_m_v',$data);
				$this->load->library('template');
				$this->template->title('Attach File');
				$this->template
				->set_layout('panellayout')
				->build('history_m_v',$data);
				//$this->load->view('bottom');
			}
		 
			 
        }
?>