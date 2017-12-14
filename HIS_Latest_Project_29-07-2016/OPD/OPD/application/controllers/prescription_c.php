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
/**********************************************************************/

session_start();
class Drug
{
	// attributes for a drug
	public $index;
	public $drugid;
	public $drugname;
	public $dosage;
	public $freq;
	public $period;

	
	public function __construct($_drugid,$_drugname,$_dosage,$_freq,$_period)
	{
		$this->drugid=$_drugid;
		$this->drugname=$_drugname;
		$this->dosage=$_dosage;
		$this->freq=$_freq;
		$this->period=$_period;

	}
 
}
/**********************************************************************/
class Prescription
{
	public $drug_list = array();
	public $drug_list_stock = array();
	public $prescriptionId = -1;
	
    function addDrug($drug)
    { 
		$this->drug_list[] = $drug;
		$drug->index = (sizeof($this->drug_list)-1);
    }
    function addDrugStock($drug)
    { 
		$this->drug_list_stock[] = $drug;
		$drug->index = (sizeof($this->drug_list_stock)-1);
    }
	
	function removeDrug($index)
	{
		unset($this->drug_list[$index]);
 	}
 	function removeDrugStock($index)
	{
		unset($this->drug_list_stock[$index]);
 	}
 	function clearDrugStock()
	{
		$this->drug_list_stock=NULL;
 	}
 	function clearDrugList()
	{
		$this->drug_list=NULL;
 	}
	
	function getDrugList()
	{
		return $this->drug_list;
	}
	function getDrugStockList()
	{
		return $this->drug_list_stock;
	}

	function getPrescriptionId()
	{
		return $this->prescriptionId;
	}

	function setPrescriptionId($presId)
	{
		$this->prescriptionId = $presId;
	}
}
/**********************************************************************/
 
class prescription_c  extends CI_Controller{
      
      		public static $presEmpty = 'true';
      		public static $newPres = 'false';
			public function __construct()
			{
				parent::__construct();
			 
				@session_start(); 
				if(!isset($_SESSION['prescription']))
				{  
					$_SESSION['prescription'] = new Prescription();
				}
			}
 	 
			public function index(){}
			
			public function add($pid,$visitid,$status='0')
			{	
				 $data['status'] = $status;
			 	 $data['title'] = "Add Prescription";

			 	 if(count($_SESSION['prescription']->getDrugList()) <= 0 && count($_SESSION['prescription']->getDrugStockList()) <=0 && self::$presEmpty =='true')
			 	 {
			 	 	$data['newpres'] = 'true';
			 	 	$data['presEmpty'] = self::$presEmpty;
			 	 	self::$newPres = true;
			 	 }
			 	 else
			 	 {
			 	 	$data['newpres'] = 'false';
			 	 	$data['presEmpty'] = self::$presEmpty;
			 	 	self::$newPres = false;
			 	 }

			 	 if(self::$newPres && self::$presEmpty =='true')
			 	 {
			 	 	$this->done($pid,$visitid);
			 	 }
				 $data['drug_list'] = $_SESSION['prescription']->getDrugList();
				 $data['drug_list_stock'] = $_SESSION['prescription']->getDrugStockList();
				 $data['pid'] = $pid;
				 $data['visitid'] = $visitid;
				 $data['presid'] ='';
				 $data['leftnavpage'] = '';
                                 
				$this->load->view('Components/headerInward',$data);
 	 
				// loading left side navigation
				
				$this->load->view('Components/left_navbar',$data);
				//************************************************************************************
			
				// show patient profile mini
				$this->load->model('PatientModel','patient');
				$this->patient->set_pid( $pid );
				$data['pprofile'] = json_decode( $this->patient->getPatient() );
				$data['pprofilebmi'] = json_decode($this->patient->getPatient(),true);
                $data['allergy'] = json_decode(json_encode($data['pprofile']->allergies), TRUE);

				$this->load->view('patient_prescribe_m_v',$data);


				//****************************************************************************
 
                    $this->load->view('prescription_m_v',$data);
				
				$this->load->view('Components/bottom');
				
			}
			
			public function add_drug($pid,$visitid,$presid = '')
			{
			 	
			 	self::$presEmpty = 'false';
				$drugid = $_POST['inputDrug'];
				$dosage = $_POST['inputDosage'];
				$freq = $_POST['frequency'];
				$period= $_POST['period'];
				$customQty = $_POST['inputQty'];

				if($freq == "s.o.s.")
				{
					$freq = $freq.":".$customQty;
				}

				//get drugname by id 
				$this->load->model('ServiceModel','service');
				$drugname = $this->service->getDrugNameByDrugID($drugid);
				$drugStatus = $this->service->getDrugStatus($drugid);

				if($drugStatus=='true')
				{

					$_SESSION['prescription']->addDrugStock( new Drug($drugid,$drugname , $dosage,$freq ,$period));

						if($presid == '')
						{
							$this->add($pid,$visitid);
						}else
						{ 
							$this->edit($pid,$presid,$visitid);
						}

				}
				else
				{

					$_SESSION['prescription']->addDrug( new Drug($drugid,$drugname , $dosage,$freq ,$period));

					if($presid == '')
					{
						$this->add($pid,$visitid);
					}else
					{ 
						$this->edit($pid,$presid,$visitid);
					}

				}
			 
				
				
				
			
			}
 
			public function remove_drug($index,$pid,$visitid,$presid = '')
			{
			   
				$_SESSION['prescription']->removeDrug($index);

				if($presid == '')
				{
					$this->add($pid,$visitid);
				}else
				{ 
					$this->edit($pid,$presid,$visitid);
				}
				
			}

			
			public function remove_drug_stock($index,$pid,$visitid,$presid = '')
			{
			   
				$_SESSION['prescription']->removeDrugStock($index);

				if($presid == '')
				{
					$this->add($pid,$visitid);
				}else
				{ 
					$this->edit($pid,$presid,$visitid);
				}
				
			}

			public function done($pid,$visitid)
			{
				$_SESSION['prescription']->setPrescriptionId(-1);
				//$this->add($pid,$visitid);
			}

			public function continuePres($pid,$visitid)
			{
				self::$presEmpty = 'false';
				$this->add($pid,$visitid);
			}
  
			public function save($pid,$visitid,$status='0')
			{
                           
				$prescriptionId = $_SESSION['prescription']->getPrescriptionId();
				$data['status'] = '0';
				$data['visitid'] = $visitid;
				
				$this->load->model('PrescriptionModel','prescription');
				
				$this->prescription->set_pid($pid);
				$this->prescription->set_visitid($visitid);
				$this->prescription->set_userid($_SESSION['user']);
				if($prescriptionId == -1)				
				{
					$this->prescription->set_drug_list($_SESSION['prescription']->getDrugList());

					
					//print_r($this->prescriptionid);
					$this->prescription->set_presid($prescriptionId);  
                }  
               else{
                	$this->prescription->set_drug_list($_SESSION['prescription']->getDrugList());
                	$this->prescription->set_presid($prescriptionId);
                	//print_r($this->prescription);
                }       
				$data['status'] = $this->prescription->addPrescription();
				$_SESSION['prescription']->setPrescriptionId($this->prescription->getLastPrescriptionId());
				//
                                //die();
 				$data['title'] = "Add Prescription";

 				//$data['drug_list'] = $drug_list;

 				
 				
 				//  foreach ($pres_list as $drugs ) {

 				//  	$data['drugname']=$drugs->drugname;
			  //       $data['dosage']=$drugs->dosage;
			  //       $data['freq']=$drugs->freq;
 				// 	$data['period']=$drugs->period;
 				// // 	# code...
 				//  }
 				

 				/*echo '<script type="text/javascript">',
				     '
				     	 window.open("'.base_url().'index.php/prescription_c/getReport", "_blank") ;
				     ',
				     '</script>'
				;*/
 				
 				//print_r($pres_list);
				//$data['drug_list'] = NULL;
				//redirect('/login/form/', 'refresh');
				 
				$this->add($pid,$visitid, $data['status'] );
				 
			}

			public function save_stock($pid,$visitid,$status='0')
			{
                           
				$prescriptionId = $_SESSION['prescription']->getPrescriptionId();

				$data['status'] = '0';
				$data['visitid'] = $visitid;
				
				$this->load->model('PrescriptionModel','prescription');
				
				$this->prescription->set_pid($pid);
				$this->prescription->set_visitid($visitid);
				$this->prescription->set_userid($_SESSION['user']);

                $this->prescription->set_drug_list($_SESSION['prescription']->getDrugStockList());
                $this->prescription->set_presid($prescriptionId);
	        
				$data['status'] = $this->prescription->addPrescription();
				$_SESSION['prescription']->setPrescriptionId($this->prescription->getLastPrescriptionId());
				$_SESSION['prescription']->clearDrugStock();
                                //die();
 				$data['title'] = "Add Prescription";
				$data['drug_list'] = NULL;

				if(count($_SESSION['prescription']->getDrugList()) <= 0 && count($_SESSION['prescription']->getDrugStockList()) <=0)
			 	{
			 		self::$presEmpty = 'true';
			 	}
				 
				$this->add($pid,$visitid, $data['status'] );
				 
			}
 
 			public function save_stock2($pid,$visitid,$status='0')
			{
                           
				$prescriptionId = $_SESSION['prescription']->getPrescriptionId();

				$data['status'] = '0';
				$data['visitid'] = $visitid;
				
				$this->load->model('PrescriptionModel','prescription');
				
				$this->prescription->set_pid($pid);
				$this->prescription->set_visitid($visitid);
				$this->prescription->set_userid($_SESSION['user']);

                $this->prescription->set_drug_list($_SESSION['prescription']->getDrugList());
                $this->prescription->set_presid($prescriptionId);
                	//print_r($this->prescription);
                	        
				$data['status'] = $this->prescription->addPrescription();
				$_SESSION['prescription']->setPrescriptionId($this->prescription->getLastPrescriptionId());
				//$this->getReport($pid);
				$_SESSION['prescription']->clearDrugList();
                                //die();
 				$data['title'] = "Add Prescription";
				$data['drug_list'] = NULL;
				
				if(count($_SESSION['prescription']->getDrugList()) <= 0 && count($_SESSION['prescription']->getDrugStockList()) <=0)
			 	{
			 	 	self::$presEmpty = 'true';
			 	}

				$this->add($pid,$visitid, $data['status'] );
				 
			}
			
			public function discard($pid,$visitid)
			{
 
				unset($_SESSION['prescription']);
 
				$data['status'] = '0';
				 
				 
 				$data['title'] = "Add Prescription";
				$this->load->view('header',$data);
				$data['pid'] = ($pid); 
				$data['drug_list'] = NULL;
			    $data['visitid'] = $visitid;
			    $data['presid'] ='';
				
				$url = base_url()."index.php/patient_visit_c/view/".$pid."/".$visitid;
				header("Location:".$url);
			}
			
			 
			
			public function edit($pid,$presid,$visitid,$loadlist = FALSE, $status='0')
			{	
				 $data['status'] = $status;
			 	 $data['title'] = "Edit Prescription";
				
				 $data['pid'] = $pid;
				 $data['visitid'] = $visitid;
				 $data['presid'] = $presid;
				  
				$this->load->view('header',$data);
 	 
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
 
				// load the saved prescription
				$this->load->model('PrescriptionModel','prescription'); 
				$data['prescription'] = json_decode($this->prescription->getPrescription($presid) );
				//****************************************************************************
 				
  	 
				// load last edited username for the prescription
				$lastupdateuid =json_encode($data['prescription'][0][0])->lastUpDateUser;
				$this->load->model('ServiceModel','service');
				$data['lastmodusername'] = "Test";//$this->service->getFullUserName($lastupdateuid);;
				//****************************************************************************	
				
				// load the prescription data
				if($loadlist != FALSE)
				{
					$_SESSION['prescription'] = new Prescription();
					if($loadlist){
					
						foreach($data['prescription']->prescribeItems as $prescribeItem)
						{
							 
							$drugid = $prescribeItem->drugID;
							$drugname = $prescribeItem->drugID->dName;
							$dosage = $prescribeItem->prescribeItemsDosage;
							$freq =  $prescribeItem->prescribeItemsFrequency;
							$period= $prescribeItem->prescribeItemsPeriod;
						 
							$_SESSION['prescription']->addDrug( new Drug(  $drugid,$drugname,$dosage,$freq ,$period));
	 
						} 					
					 }
				 }
				$data['drug_list'] = $_SESSION['prescription']->getDrugList();
				$data['drug_list_stock'] = $_SESSION['prescription']->getDrugStockList();
				
				$this->load->view('prescription_m_v',$data);
                                $data['leftnavpage'] = '';
				//$this->load->view('bottom');
				 
			}
			
			public function update($pid,$visitid,$presid)
			{
				$this->load->model('PrescriptionModel','prescription');
				$this->prescription->set_pid($pid);
				$this->prescription->set_visitid($visitid);
				$this->prescription->set_userid($this->session->userdata("userid"));
				$this->prescription->set_presid($presid);
				
				$this->prescription->set_drug_list((array) $_SESSION['prescription']->getDrugList());
				$data['status'] = $this->prescription->updatePrescription();
				  
				$this->edit($pid,$presid,$visitid, TRUE ,$data['status']  );
			}
			
			public function getDrugMainStock()
			{
				$this->load->model('PrescriptionModel','prescription');

				echo $this->prescription->getDrugMainStock();
			}

			public function getFrequency()
			{
				$this->load->model('PrescriptionModel','prescription');

				echo $this->prescription->getFrequency();
			}
			public function getDosages()
			{
				$this->load->model('PrescriptionModel','prescription');

				echo $this->prescription->getDosages();
			}
			public function getReport($pid)
			{
				$pres_list['drug'] = $_SESSION['prescription']->getDrugList();

				$this->load->model('PatientModel','patient');
				$this->patient->set_pid( $pid );
				$pres_list['pdetails'] = json_decode( $this->patient->getPatient());
				 
				$this->load->view('print_prescription', $pres_list);
				//$_SESSION['prescription']->clearDrugList();

			}


			
        }
?>