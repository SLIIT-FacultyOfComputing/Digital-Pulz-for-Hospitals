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
    class attachment_c  extends CI_Controller{
                var $_site_base_url=SITE_BASE_URL;
			public function __construct()
			{
				parent::__construct();    
				$this->load->helper(array('form', 'url'));
				
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
				$data['attachid'] = '';
				$data['status'] = $status;
				$data['pid'] = $pid;
				$data['title'] = 'Attach File';
                                
				$this->load->view('Components/headerInward',$data);
				$data['visitid'] = $visitid;
				//loading left side navigation
				$data['leftnavpage'] = '';
				$this->load->view('Components/left_navbar',$data);
				//************************************************************************************
				
				
				// show patient profile mini
				$this->load->model('PatientModel','patient');
				$this->patient->set_pid( $pid );
				$data['pprofile'] = json_decode( $this->patient->getPatient() );
				//$this->load->view('patient_profile_mini_v',$data);
				//****************************************************************************

			 	$data['attachment'] = null;
                                
                                
				
				// load creator user name
				$this->load->model('ServiceModel','service');
				
				$data['createduser'] = $this->session->userdata("userfullname");
			
				//****************************************************************************	
	 
			 
				$this->load->view('attachments_m_v',$data); 
				/* $this->load->library('template');
				$this->template->title('Attach File');
				$this->template
				->set_layout('panellayout')
				->build('attachments_m_v',$data);*/
				$this->load->view('Components/bottom'); 
			}
			
			
			public function edit($pid,$attachid,$status='0')
			{	if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
				  
				$data['attachid'] = $attachid;
				$data['status'] = $status;
				$data['pid'] = $pid;
				$data['title'] = 'Edit Attachment';
				$this->load->view('headerInward',$data);
 	  
				// loading left side navigation
				$data['leftnavpage'] = '';
				$data['visitid'] = '0';
				//$this->load->view('left_navbar_v',$data);
				//************************************************************************************
				
				
				// show patient profile mini
				$this->load->model('PatientModel','patient');
				$this->patient->set_pid( $pid );
				$data['pprofile'] = json_decode( $this->patient->getPatient() );
				//$this->load->view('patient_profile_mini_v',$data);
				//****************************************************************************

				
				// load attachment data
				$this->load->model('AttachmentModel','attachment');
				$this->attachment->set_attchid( $attachid );
				$data['attachment'] = json_decode($this->attachment->getAttachment() );
				//****************************************************************************
				
				    
				$this->load->model('ServiceModel','service');
				// load created user name
				$data['createduser'] = $this->service->getFullUserName($data['attachment'][0]->attachedBy);
				//****************************************************************************	
				 
			//	$this->load->view('attachments_m_v',$data); 
				  
//				$this->load->view('bottom'); 	
				$this->load->library('template');
				$this->template->title('Attachments');
				$this->template
				->set_layout('panellayout')
				->build('attachments_m_vu',$data);   
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
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'txt|jpg|png|pdf';
				$config['max_size']	= '51200';
				$config['remove_spaces']= TRUE;
				
				$this->load->library('upload', $config);
			 
				$upload_data;
				if ( ! $this->upload->do_upload())
				{
					array('error' => $this->upload->display_errors());
					$data['upstatus'] ="error";
					
				}
				else
				{
					$upload_data = $this->upload->data();
					$data['upstatus'] ="ok";
				}
 			 
				$data['status'] = "error" ;
				
				if($data['upstatus'] == "ok")
				{
					$this->load->model('AttachmentModel','attachment');
					$this->attachment->set_pid($pid);
					$this->attachment->set_attached_by($this->input->post('filetype'));
					$this->attachment->set_attach_name($this->input->post('attachname'));
					$this->attachment->set_attached_by($this->session->userdata("userid"));
					$this->attachment->set_attach_description($this->input->post('Remarks'));
					$this->attachment->set_attach_link( $upload_data['full_path']);
					$this->attachment->set_userid($this->session->userdata("userid"));
					//$this->attachment->set_visitid('0');
 
					$data['status'] =  $this->attachment->addAttachment() ;
				}

				$this->add($pid,0,$data['status']);
			}
			
			public function update($pid,$attachid)
			{
                                if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
  				$service_url = SERVICE_BASE_URL."Attachments/updateAttachments";

				$curl = curl_init($service_url);
     
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'txt|jpg|png|pdf';
				$config['max_size']	= '51200';
				$config['remove_spaces']= TRUE;
				
				$ff = $_FILES['userfile']['name']; 

				if(!empty($ff))
				{ 
					$upload_config['file_name'] = $this->input->post('uplddfnm');
			   
					$this->load->library('upload', $config);
				 
					$upload_data;
					if ( ! $this->upload->do_upload())
					{
						array('error' => $this->upload->display_errors());
						$data['upstatus'] ="error";
						
					}
					else
					{
						$upload_data = $this->upload->data();
						$data['upstatus'] ="ok";
					}
					$data['status'] = "error" ;
					
					$curl_post_data = array(
					"pid" => $pid,
					"attchid" => $attachid,
					"filetype" => $this->input->post('filetype'),
					"attachname" => $this->input->post('attachname'),
					"AttachedBy" => $this->input->post('AttachedBy'),
					"Remarks" => $this->input->post('Remarks'),
					"filepath" => $upload_data['full_path'],
					"active" => $this->input->post('active'),
					"userid" =>  $this->session->userdata("userid"),
					"visitid" => '0',
					); 
					
				}else
				{
					$data['upstatus'] = "ok";
					
					$curl_post_data = array(
					"pid" => $pid,
					"attchid" => $attachid,
					"filetype" => $this->input->post('filetype'),
					"attachname" => $this->input->post('attachname'),
					"AttachedBy" => $this->input->post('AttachedBy'),
					"Remarks" => $this->input->post('Remarks'),
					"filepath" => null,
					"active" => $this->input->post('active'),
					"userid" =>  $this->session->userdata("userid"),
					"visitid" => '0',
					); 
				}
				
				if($data['upstatus'] == "ok")
				{
                                    if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json")); 
					curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode( $curl_post_data));
					$curl_response = curl_exec($curl);
					$data['status'] =  $curl_response ;
					curl_close($curl);
				}
				
				$this->edit($pid,$attachid,$data['status']);

			}
			
			
			public function view($pid,$attachid)
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
				 
				$this->load->model('AttachmentModel','attachment');
				$this->attachment->set_attchid( $attachid );
				$data['attachment'] = json_decode($this->attachment->getAttachment() );
				  
				$this->load->view('attachments_v',$data ); 
			}
		 
			 
        }
?>