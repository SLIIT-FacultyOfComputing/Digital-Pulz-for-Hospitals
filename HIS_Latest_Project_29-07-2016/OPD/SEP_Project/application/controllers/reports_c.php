<?php
session_start();
    class reports_c  extends CI_Controller{
            var $_site_base_url=SITE_BASE_URL;
			public function __construct()
			{
				parent::__construct(); 
			}

			public function index(){}
			
			public function view( )
			{	if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
				$data['visitid'] = '0';
				$data['status'] ='0';

				$data['pid'] ='';
				$data['title'] = '';
				$this->load->view('Components/headerInward',$data);

				// loading left side navigation
				$data['leftnavpage'] = 'reports_v';
				$this->load->view('Components/left_navbar',$data);
				//************************************************************************************
			  
				$this->load->view('reports_m_v',$data); 

				$this->load->view('Components/bottom'); 
			}
  
			public function generateReport()
			{
                                if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
				$reportType = $_POST['reportType'];
				$fromDate = $_POST['fromdate'];
				$toDate = $_POST['todate'];
				
//				if( $_POST['doctor'] == "All Doctors"){
//                                    
//                                   // die();
//                                $doctor = 0;
//                                //$doctor =  $_POST['doctor'];
//                               // echo $doctor;
//                                }
//				else{
//                                    $doctor = $_POST['doctor'];
////                                    echo $doctor;
////                                    die();
//                                }
                               
						
				
				$outputType = $_POST['outtype'];
				  
				if( $reportType == "Visits")
				{   //echo $doctor;
                                //die();
					$this->printVisitsReport($fromDate,$toDate,$outputType);
					
				}else if($reportType == "LabOrders")
				{
					$this->printLabOrdersReport(NULL);
				}else
				{
					 $this->printAdmissionsReport(NULL);
				}
			
			}
			
			
			public function printVisitsReport($fromdate,$todate,$outType)
			{
                            if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"] == -1) {
                                    redirect($this->_site_base_url);
                                }
                                } else {
                                    redirect($this->_site_base_url);
                                }
				$data['reportType']  = "Visits";
				$data['outType']  = $outType;
				$data['fromdate']  = $fromdate;
				$data['todate']  = $todate;
//                                echo $doctor;
//                                die();
//        echo $outType;
//        die();
				$this->load->model('VisitModel','visit');
				$data['visits'] = json_decode($this->visit->getVisitsForReport($fromdate,$todate));
                                
				$this->load->view('prints_p',$data);
			}
			
			public function printLabOrdersReport($date)
			{
			 
			}
			
			public function printAdmissionsReport($date)
			{
			 
			}
			
        }
?>