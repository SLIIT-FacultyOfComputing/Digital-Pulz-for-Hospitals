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
    class Patient_c  extends CI_Controller{
            var $_site_base_url=SITE_BASE_URL;
			public function __construct()
			{
				parent::__construct();        
				$this->load->helper(array('form', 'url'));				
			}

			
			  
			public function add($status='0')
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
 
				$data['title'] = 'Register New Patient';
 
				$this->load->view('Components/headerInward',$data);
 	            
				// loading left side navigation
                                $data['leftnavpage'] = 'new_patient';
				$this->load->view('Components/left_navbar',$data);
				
				//************************************************************************************
				
				$this->load->view('patient_m_v',$data);
				$this->load->view('Components/bottom');
				
			}
			
			public function edit($pid,$status='0')
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
				$data['title'] = 'Edit Patient';
				$data['visitid'] = '0';
                                
                                //get the visit_type of the patient from the database according to the passed
                                //patiet id including other required variables.
                                $data['visit_type'] = 1;
				$this->load->view('Components/headerInward',$data);
 	 
				// loading left side navigation
				$data['leftnavpage'] = '';
				$this->load->view('Components/left_navbar',$data);
				//************************************************************************************
				
				
				// show patient profile mini
			 
				$this->load->model('PatientModel','patient');
				$this->patient->set_pid( $pid );
				$data['pprofile'] = json_decode( $this->patient->getPatient() );

                $this->load->view('patient_m_v',$data);

				//****************************************************************************
				
				/*$this->load->library('template');
				$this->template->title('Patient');
				$this->template
				->set_layout('panellayout')
				->build('patient_m_v',$data);*/
				 $this->load->view('Components/bottom',$data);
			}
			 	
			

                        
                        
              public function save()
			{
				  if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
				$ff = $_FILES['userfile']['name']; 

				if(!empty($ff))
				{ 
					$config['upload_path'] = './uploads/patient_photos/';
					$config['allowed_types'] = 'jpg|png';
					$config['max_size']	= '51200';
					$config['remove_spaces']= TRUE;
					$config['overwrite']= TRUE;
					$this->load->library('upload', $config);
				 
					$upload_data;
					
					if (!$this->upload->do_upload())
					{
						 array('error' => $this->upload->display_errors());
					}
					else
					{
						$upload_data = $this->upload->data();
					 
					}
				}else
				{	
					$upload_data;
					
					if(!empty($this->input->post('imageName')))
					{
						$upload_data['full_path'] = $this->input->post('imageName');
					}
					else
					{
						$upload_data['full_path'] = NULL;	
					}
				}
				
					$this->load->model('PatientModel','patient');
					$this->patient->set_title($this->input->post('title'));
					$this->patient->set_fullname($this->input->post('fullname'));
					$this->patient->set_personalname($this->input->post('personalname'));
					$this->patient->set_nic($this->input->post('nic'));
					$this->patient->set_passport($this->input->post('passport'));						
					//$this->patient->set_hin($this->input->post('hin'));
					$this->patient->set_photo( $upload_data['full_path']);
					$this->patient->set_dob($this->input->post('dob'));
					$this->patient->set_gender($this->input->post('gender'));
					$this->patient->set_contactpname($this->input->post('contactpname'));
					$this->patient->set_contactpno($this->input->post('contactpno'));
					$this->patient->set_cstatus($this->input->post('cstatus'));

					if($this->input->post('address1') != "" && $this->input->post('address2') != "")
						$this->patient->set_address($this->input->post('address1') .", " .$this->input->post('address2') .", ".$this->input->post('village'));
					else if($this->input->post('address1') != "")
						$this->patient->set_address($this->input->post('address1') .", ".$this->input->post('village'));
					else
						$this->patient->set_address($this->input->post('village'));

					$this->patient->set_telephone($this->input->post('telephone'));
					$this->patient->set_lang($this->input->post('lang'));
					$this->patient->set_citizen($this->input->post('citizen'));
					$this->patient->set_blood($this->input->post('blood'));
					$this->patient->set_remarks($this->input->post('remarks'));
					$this->patient->set_userid( $this->session->userdata("userid"));

					$data['status'] =  json_decode( $this->patient->addPatient());
				 
					if($data['status'] == null)
						$this->add("False");
					else
						$this->add($data['status']->patientID);

					/*redirect($this->SITE_BASE_URL. "operator_home_c/viewpatient/"  );*/
			}
			 
			  
			public function update($pid)
			{
				  if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
				$this->load->model('PatientModel','patient');
				
				$config['upload_path'] = './uploads/patient_photos/';
				$config['allowed_types'] = 'jpg|png';
				$config['max_size']	= '51200';
				$config['remove_spaces']= TRUE;
				$config['overwrite']= TRUE;
				$ff = $_FILES['userfile']['name']; 

				if(!empty($ff))
				{ 
					$upload_config['file_name'] = $this->input->post('uplddfnm');
			   
					$this->load->library('upload', $config);
				 
					$upload_data;
					if (!$this->upload->do_upload())
					{
						array('error' => $this->upload->display_errors());
					}
					else
					{
						$upload_data = $this->upload->data();
					}
				
				}else 
				{	
					$upload_data;
					if(!empty($this->input->post('imageName')))
					{
						$upload_data['full_path'] = $this->input->post('imageName');
					}
					else
					{
						$upload_data['full_path'] = NULL;	
					}
				}
				
				$this->patient->set_pid($pid);
				$this->patient->set_title($this->input->post('title'));
				$this->patient->set_fullname($this->input->post('fullname'));
				$this->patient->set_personalname($this->input->post('personalname'));
				$this->patient->set_nic($this->input->post('nic'));
				$this->patient->set_passport($this->input->post('passport'));						
				//$this->patient->set_hin($this->input->post('hin'));
				$this->patient->set_photo($upload_data['full_path']);
				$this->patient->set_dob($this->input->post('dob'));
				$this->patient->set_gender($this->input->post('gender'));
				$this->patient->set_contactpname($this->input->post('contactpname'));
				$this->patient->set_contactpno($this->input->post('contactpno'));
				$this->patient->set_cstatus($this->input->post('cstatus'));

				if($this->input->post('address1') != "" && $this->input->post('address2') != "")
						$this->patient->set_address($this->input->post('address1') .", " .$this->input->post('address2') .", ".$this->input->post('village'));
					else if($this->input->post('address1') != "")
						$this->patient->set_address($this->input->post('address1') .", ".$this->input->post('village'));
					else
						$this->patient->set_address($this->input->post('village'));

				$this->patient->set_active($this->input->post('active'));
				$this->patient->set_telephone($this->input->post('telephone'));
				$this->patient->set_lang($this->input->post('lang'));
				$this->patient->set_citizen($this->input->post('citizen'));
				$this->patient->set_blood($this->input->post('blood'));
				$this->patient->set_remarks($this->input->post('remarks'));
				$this->patient->set_userid( $this->session->userdata("userid"));
 
				$data['status'] = $this->patient->updatePatient();
				
				$this->edit($pid,$data['status']); 
			}
			
			public function search()
			{
	       		if (isset($_SESSION["user"])) {
	                if ($_SESSION["user"] == -1) {
	                    redirect($this->_site_base_url);
	                }
	            } else {
	                redirect($this->_site_base_url);
	            }
				$data['status'] = '0';
				$this->load->view('Components/headerInward',$data);


				// loading left side navigation
				$data['leftnavpage'] = 'patient_search';
				$data['visit_type'] = '';
				$this->load->view('Components/left_navbar',$data);
				//************************************************************************************

				// load all patients 
				$this->load->model('PatientModel','patient');
				$data['patients'] = json_decode($this->patient->getAllPatients());
                                //load relavant view
				$this->load->view('patients_full_search_v.php',$data);
				$this->load->view('Components/bottom');
			} 

			
			public function saveImage()
			{
				if(isset($_POST['img']))
				{
					$img = $_POST['img'];
					$path = $_POST['path'];

					//$img = str_replace('data:image/png;base64,', '', $img);
					//$img = str_replace(' ', '+', $img);

					$img = explode( ',', $img );
					$data = base64_decode($img[1]);
					$root = $_SERVER['DOCUMENT_ROOT'];
					$success = file_put_contents($root.'/OPD'.$path, $data);
					if($success)
					{
						echo "successful";
					}
					else
					{
						echo "failed";
					}
				}

			}

			public function getVillageOnSearch($village)
			{
				$this->load->model('PatientModel','patient');
				$result = $this->patient->getVillageOnSearch($village);
				print_r($result);
				return $result;
			}
        }
?>