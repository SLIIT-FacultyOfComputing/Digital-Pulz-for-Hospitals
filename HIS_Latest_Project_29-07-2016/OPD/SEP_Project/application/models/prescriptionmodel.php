<?php

include_once 'servicecaller.php';

class PrescriptionModel {
	
	public function PrescriptionModel(){}
 
	private $pid;
	private $visitid;
	private $userid;
        private $drug_list;
        private $presid;
	
	public function get_userid() { return $this->userid; } 
	public function set_userid($x) { $this->userid = $x; } 
	
	public function get_pid() { return $this->pid; } 
	public function set_pid($x) { $this->pid = $x; } 
	
	public function get_visitid() { return $this->visitid; } 
	public function set_visitid($x) { $this->visitid = $x; } 
	
	public function get_drug_list() { return $this->drug_list; } 
	public function set_drug_list($x) { $this->drug_list = $x; } 
	
	public function get_presid() { return $this->presid; } 
	public function set_presid($x) { $this->presid = $x; } 
	
	public function addPrescription()
	{
	
		$patientJSON   = json_encode($this->drug_list); 
               // echo(json_encode($this->drug_list));
               // die();
		$service_url =  SERVICE_BASE_URL."Prescription/addPrescription/".$this->pid."/".$this->visitid."/".$this->userid;
		$MediaType = "application/json";
		$curl_request  = new ServiceCaller();
                $response =  $curl_request->curl_POST_Request($service_url,$patientJSON,$MediaType);
		return $response;
	}
   
   
   	public function updatePrescription()
	{
		$patientJSON =  json_encode($this->drug_list);
		$service_url =  SERVICE_BASE_URL."Prescription/updatePrescription/".$this->pid."/". $this->presid."/".$this->userid;
		$MediaType = "application/json";
		$curl_request  = new ServiceCaller();
                $response =  $curl_request->curl_POST_Request($service_url,$patientJSON,$MediaType);
		return $response;
	}
	
	public function getVisitPrescription()
	{
		$service_url = SERVICE_BASE_URL."Prescription/getvisitpres/".$this->visitid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}

	public function getPrescription($presid)
	{
		$service_url = SERVICE_BASE_URL."Prescription/getPrescription/".$presid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}

	public function getPrescriptionsByPatientID($pid)
	{
		$service_url = SERVICE_BASE_URL."Prescription/getPrescriptionsByPatientID/".$pid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}


	public function getPrescriptionsByPatientIDafterprescribe($pid,$date)
	{
		$service_url = SERVICE_BASE_URL."Prescription/getPrescriptionsByPatientIDAfterprescribe/".$pid ."/".$date;
	    //var_dump($service_url);

		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}

	public function getPrescriptionsByPatientIDAfterprescribedetails($pid)
	{
		$service_url = SERVICE_BASE_URL."Prescription/getPrescriptionsByPatientIDAfterprescribedetails/".$pid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
    
    public function getDrugStocks()
	{
		$service_url = SERVICE_BASE_URL."PharmacyServices/drugStockTable";
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
}
?>