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
    class patient_visit_c  extends CI_Controller{
            var $_site_base_url=SITE_BASE_URL;
			public function __construct()
			{
				parent::__construct();
			}
			 
			public function index(){}
			
			public function view($pid,$vid)
			{	if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
				$data['title'] = "Patient Visit";
				$data['status'] = '0';
				//$this->load->view('headerInward',$data);
				 
				$this->load->model('VisitModel','visitm');
				$this->visitm->set_visitid($vid);
				$this->visitm->set_pid($pid);


/////////////////////////////////
		$data['leftnavpage'] = 'patient_overview_v';
        $data['pid'] = $pid;
        $data['vid'] = $vid;
    //    $this->load->view('left_navbar_v', $data);
        //************************************************************************************
        // show the patient profile on the top patient profile
        $this->load->model('PatientModel', 'patient');
        // $this->load->model('servicemodel','svm');
        // $data['dprofile'] = json_decode($this->svm->getDoctors(),true);
        $this->patient->set_pid($pid);
        $data['pprofile'] = json_decode($this->patient->getPatient());
        $data['pprofilebmi'] = json_decode($this->patient->getPatient(),true);
       
		//$data['pprofile'] = json_decode($this->patient->getPatient());
		$data['visits'] = json_decode(json_encode($data['pprofile']->visits), TRUE);
//////////////////////////////	




				
				 
				// load details of the visit
				$data['visit']  = json_decode($this->visitm->getVisitByVisitID($vid));
				//****************************************************************************
			 
				// if the visit the most reacent one, we should enable the links in patient visit page
				$data['recentvisit'] = json_decode($this->visitm->getRecentVisitID() );
				//****************************************************************************
			   		 
					 
				// load details of prescriptions for that visits
				// if($data['visit'][0]->prescriptions != null && sizeof( $data['visit'][0]->prescriptions) > 0 )
				// {

				// 	$this->load->model('PrescriptionModel','prescriptionmodel');

				// 	$data['presitems'] =  json_decode ($this->prescriptionmodel->getPrescriptionsByPatientIDAfterprescribe($pid));
				// }
				// else
				// {

				// 	$data['presitems'] = NULL;
				// }
				//****************************************************************************
				$this->load->model('PrescriptionModel','prescriptionmodel');

				$data['presitems'] = json_decode($this->prescriptionmodel->getPrescriptionsByPatientIDAfterprescribedetails($pid),true);
			    $data['pres'] = json_decode($this->prescriptionmodel->getPrescriptionsByPatientIDAfterprescribe($pid,"2015-07-10"),true);

				// var_dump($data['pres']);
                                 // var_dump($data['visit']->prescriptions->prescriptionStatus );
			   
				 //get questioneers for the visit. opd or clinic
				$this->load->model('QuestionnaireModel','questionnairemodel');
				$data['questionnaire'] = json_decode( $this->questionnairemodel->getQuestionnairesByVisitType( $data['visit'][0]->visitType));  
			  
	              $data['allergy'] = json_decode(json_encode($data['pprofile']->allergies), TRUE);
				// load details of laborders for that visits
				$this->load->model('LabOrderModel','laborderm');
				/*$data['laborders']  =json_decode($this->laborderm->getVisitLabOrders($vid));*/
                 $data['labs'] =json_decode($this->laborderm->getVisitLabOrdersByPid($pid));

                                
				//****************************************************************************
				  
				 
				 // loading left side navigation
				$data['leftnavpage'] = 'patient_visit_v';
				$data['pid'] = $pid;

				//************************************************************************************
 
				// show patient profile mini
				$this->load->model('PatientModel','patient');
				$this->patient->set_pid( $pid );
                                
                             
                                
				$data['pprofile'] = json_decode( $this->patient->getPatient() );
                                                              
                                $pntHIN =$data['pprofile']->patientHIN;
                                $data['pntHIN'] = $pntHIN ;
                                $this->load->library('session');
                                $this->session->set_userdata('userPatientDetails', $pntHIN);
                                
				//$this->load->view('patient_profile_mini_v',$data);
				//****************************************************************************

				
				// load details of examinations for that visits
				$data['exams']  =  json_decode (json_encode($data['visit'][0]->exams ),TRUE);
				//****************************************************************************
  
				$this->load->library('template');
				$this->template->title('Patient Overview');
				$this->template
				->set_layout('panellayout')
				->build('patient_visit_v',$data);

			}

			public function view1($pid,$vid)
			{	if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
				$data['title'] = "Patient Visit";
				$data['status'] = '0';
				//$this->load->view('headerInward',$data);
				 
				$this->load->model('VisitModel','visitm');
				$this->visitm->set_visitid($vid);
				$this->visitm->set_pid($pid);
				


			 	//load only one row
				// load details of the visit
				$data['visit']  = json_decode($this->visitm->getVisitByVisitID($vid));
				//****************************************************************************
			 
				// if the visit the most reacent one, we should enable the links in patient visit page
				$data['recentvisit'] = json_decode($this->visitm->getRecentVisitID() );
				//****************************************************************************
			   		 
					 
				// load details of prescriptions for that visits
				if($data['visit'][0]->prescriptions != null && sizeof( $data['visit'][0]->prescriptions) > 0 )
				{
					$presItemData = "";
					for($i=0; $i<count($data['visit'][0]->prescriptions); $i++)
					{
						if(is_array($presItemData))
						{
						$presItemData =  array_merge(json_decode (json_encode($data['visit'][0]->prescriptions[$i]->prescribeItems  ),TRUE),$presItemData);
						}
						else
						{
							$presItemData =  json_decode (json_encode($data['visit'][0]->prescriptions[$i]->prescribeItems  ),TRUE);
						}
					}

					$data['presitems'] = $presItemData;
				}
				else
				{
					$data['presitems'] = NULL;
				}
				//****************************************************************************
				
                                 // var_dump($data['visit']->prescriptions->prescriptionStatus );
			   
				 //get questioneers for the visit. opd or clinic
				$this->load->model('QuestionnaireModel','questionnairemodel');
				$data['questionnaire'] = json_decode( $this->questionnairemodel->getQuestionnairesByVisitType( $data['visit'][0]->visitType));  
			  
	 
				// load details of laborders for that visits
				$this->load->model('LabOrderModel','laborderm');
				$data['laborders']  =json_decode($this->laborderm->getVisitLabOrders($vid));
                $data['labs'] =json_decode($this->laborderm->getVisitLabOrdersByPid($pid));
                                
				//****************************************************************************
				  
				 
				 // loading left side navigation
				$data['leftnavpage'] = 'patient_visit_v';
				$data['pid'] = $pid;

				//************************************************************************************
 
 				$this->load->model('TreatmentModel','treatment');
				$data['treatment'] = json_decode($this->treatment->getOpdTreatmentsForVisit($vid), true);

				$this->load->model('InjectionModel','injection');
				$data['injection'] = json_decode($this->injection->getOpdInjectionsForVisit($vid), true);
				// show patient profile mini
				$this->load->model('PatientModel','patient');
				$this->patient->set_pid( $pid );
                                
                             
                                
				$data['pprofile'] = json_decode( $this->patient->getPatient() );
                                                              
                                $pntHIN =$data['pprofile']->patientHIN;
                                $data['pntHIN'] = $pntHIN ;
                                $this->load->library('session');
                                $this->session->set_userdata('userPatientDetails', $pntHIN);
                                
				//$this->load->view('patient_profile_mini_v',$data);
				//****************************************************************************

				
				// load details of examinations for that visits
				$data['exams']  =  json_decode (json_encode($data['visit'][0]->exams ),TRUE);
				//****************************************************************************
  
				// load details of the visit
				$data['visit']  = json_decode($this->visitm->getVisitByVisitID($vid));

				
				$this->load->library('template');
				$this->template->title('Patient Overview');
				$this->template
				->set_layout('panellayout')
				->build('patient_visit_v1',$data);

			}

	public function view3($pid,$vid,$date)
			{	if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
				$data['title'] = "Patient Visit";
				$data['status'] = '0';
				//$this->load->view('headerInward',$data);
				 
				$this->load->model('VisitModel','visitm');
				$this->visitm->set_visitid($vid);
				$this->visitm->set_pid($pid);


/////////////////////////////////
		$data['leftnavpage'] = 'patient_overview_v';
        $data['pid'] = $pid;
    //    $this->load->view('left_navbar_v', $data);
        //************************************************************************************
        // show the patient profile on the top patient profile
        $this->load->model('PatientModel', 'patient');
        // $this->load->model('servicemodel','svm');
        // $data['dprofile'] = json_decode($this->svm->getDoctors(),true);
        $this->patient->set_pid($pid);
        $data['pprofile'] = json_decode($this->patient->getPatient());
       
		$data['pprofile'] = json_decode($this->patient->getPatient());
		$data['visits'] = json_decode(json_encode($data['pprofile']->visits), TRUE);
//////////////////////////////	




				
				 
				// load details of the visit
				$data['visit']  = json_decode($this->visitm->getVisitByVisitID($vid));
				//****************************************************************************
			 
				// if the visit the most reacent one, we should enable the links in patient visit page
			//	 changed$data['recentvisit'] = json_decode($this->visitm->getRecentVisitID(),true);

				$data['recentvisit'] = json_decode($this->visitm->getRecentVisitID() );
				//****************************************************************************
			   		 
					 
				// load details of prescriptions for that visits
				// if($data['visit'][0]->prescriptions != null && sizeof( $data['visit'][0]->prescriptions) > 0 )
				// {

				// 	$this->load->model('PrescriptionModel','prescriptionmodel');

				// 	$data['presitems'] =  json_decode ($this->prescriptionmodel->getPrescriptionsByPatientIDAfterprescribe($pid));
				// }
				// else
				// {

				// 	$data['presitems'] = NULL;
				// }
				//****************************************************************************
				$this->load->model('PrescriptionModel','prescriptionmodel');

				$data['presitems'] = json_decode($this->prescriptionmodel->getPrescriptionsByPatientIDAfterprescribedetails($pid),true);
			   $data['pres'] = json_decode($this->prescriptionmodel->getPrescriptionsByPatientIDAfterprescribe($pid,$date),true);

				 var_dump($data['pres']);
                                 // var_dump($data['visit']->prescriptions->prescriptionStatus );
			   
				 //get questioneers for the visit. opd or clinic
				$this->load->model('QuestionnaireModel','questionnairemodel');
				$data['questionnaire'] = json_decode( $this->questionnairemodel->getQuestionnairesByVisitType( $data['visit'][0]->visitType));  
			  
	 
				// load details of laborders for that visits
				$this->load->model('LabOrderModel','laborderm');
				/*$data['laborders']  =json_decode($this->laborderm->getVisitLabOrders($vid));*/
                 $data['labs'] =json_decode($this->laborderm->getVisitLabOrdersByPid($pid));

                                
				//****************************************************************************
				  
				 
				 // loading left side navigation
				$data['leftnavpage'] = 'patient_visit_v';
				$data['pid'] = $pid;
                $data['vid'] = $vid;
				//************************************************************************************
 
				// show patient profile mini
				$this->load->model('PatientModel','patient');
				$this->patient->set_pid( $pid );
                                
                             
                                
				$data['pprofile'] = json_decode( $this->patient->getPatient() );
                                                              
                                $pntHIN =$data['pprofile']->patientHIN;
                                $data['pntHIN'] = $pntHIN ;
                                $this->load->library('session');
                                $this->session->set_userdata('userPatientDetails', $pntHIN);
                                
				//$this->load->view('patient_profile_mini_v',$data);
				//****************************************************************************

				
				// load details of examinations for that visits
				$data['exams']  =  json_decode (json_encode($data['visit'][0]->exams ),TRUE);
				//****************************************************************************
  
				$this->load->library('template');
				$this->template->title('Patient Overview');
				$this->template
				->set_layout('panellayout')
				->build('patient_visit_v',$data);

			}

        }
       

?>
