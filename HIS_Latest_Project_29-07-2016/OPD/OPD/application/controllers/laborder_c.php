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
    class laborder_c  extends CI_Controller{
        var $_site_base_url=SITE_BASE_URL;
			public function __construct()
			{
				parent::__construct();                
			}
 
			public function index()
			{	
				 $data['status'] = '0';
			 	 $this->load->view('laborder_m_v',$data);
			}
			
			public function save($pid,$visitid)
			{
  
				$this->load->model('LabOrderModel','laborder');
 
				$this->laborder->set_Testid($this->input->post('TestName'));
				$this->laborder->set_Visitid($visitid);
				$this->laborder->set_Orderdate(date("d-m-Y"));
				$this->laborder->set_Duedate($this->input->post('duedate'));
				$this->laborder->set_Orderby($this->session->userdata("userid"));
				$this->laborder->set_Orderlocation($this->input->post("location"));
				$this->laborder->set_Priority($this->input->post('Priority'));
				$this->laborder->set_Remarks($this->input->post('Remarks'));
      
				$data['status'] =$this->laborder->addLabOrder();
			 
			 	$this->add($pid,$visitid,$data['status']);

			}
						
			public function add($pid,$visitid,$status='0')
			{
 
				
				$data['status'] = $status;
				 
				$data['pid'] = $pid;
				$data['visitid'] = $visitid;
				$data['title'] = 'New LabOrder ';
				
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
 
				// load lab test names
				$this->load->model('ServiceModel','service');
				$data['labtests'] =  json_decode( $this->service->getLabTestNames() ); 
				//****************************************************************************
				 
				
				// load details of the visit
				$this->load->model('VisitModel','visit'); 
				$data['vist'] = json_decode($this->visit->getVisitByVisitID($visitid));
				//****************************************************************************
  
				
				$this->load->view('laborder_m_v',$data);
				$this->load->view('bottom'); 
				 
			}
			public function edit($laborderid)
			{
				
			}
			
        }
?>