<?php
session_start();
    class preferences_c  extends CI_Controller{
            var $_site_base_url=SITE_BASE_URL;
			public function __construct()
			{
				parent::__construct(); 
			
			}

			public function index(){}
			  

			public function view( )
			{
				 if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
				$data='';
				$this->load->view('headerInward',$data);
 	  
				// loading left side navigation
				
				$this->load->view('left_navbar_v',$data);
				//************************************************************************************
				 
				$this->load->view('preferences_v',$data); 
				$data['leftnavpage'] = 'preferences_v'; 
				//$this->load->view('bottom'); 
			}
 
	 
			public function view_questionnaire()
			{
                            if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
				$data['status'] ='0';
				$this->load->view('headerInward',$data);
				
				// load questionnaire
				$this->load->model('QuestionnaireModel','questionnaire');
				$data['questionnaire'] = json_decode( $this->questionnaire->getAllQuestionnaires() );
				//****************************************************************************
				 
				// loading left side navigation
				$data['leftnavpage'] = 'preferences_v';
				
				$this->load->library('template');
				$this->template->title('Patients');
				$this->template
				->set_layout('panellayout')
				->build('questionnaire_v',$data);

			  
			}
        }
?>