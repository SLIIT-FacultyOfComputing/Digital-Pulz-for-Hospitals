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

include_once 'servicecaller.php';


class TreatmentModel {
	
	public function TreatmentModel(){}

	private $treatmentid;
	private $visitid;
	private $status;
	private $remarks;
	private $active;
	private $userid;
	private $opdtreatmentid;

	public function get_treatmentid() { return $this->treatmentid; } 
	public function get_opdtreatmentid() { return $this->opdtreatmentid; } 
	public function get_visitid() { return $this->visitid; } 
	public function get_status() { return $this->status; } 
	public function get_remarks() { return $this->remarks; } 
	public function get_active() { return $this->active; } 
	public function get_userid() { return $this->userid; } 
	public function set_treatmentid($x) { $this->treatmentid = $x; } 
	public function set_opdtreatmentid($x) { $this->opdtreatmentid = $x; } 
	public function set_visitid($x) { $this->visitid = $x; } 
	public function set_status($x) { $this->status = $x; } 
	public function set_remarks($x) { $this->remarks = $x; } 
	public function set_active($x) { $this->active = $x; } 
	public function set_userid($x) { $this->userid = $x; } 

	public function addTreatment()
	{
		$patientJSON   = json_encode($this->jsonSerialize());
		$service_url = SERVICE_BASE_URL."Treatment/addTreatment";
		$MediaType = "application/json";
		$curl_request  = new ServiceCaller();
	    $response =  $curl_request->curl_POST_Request($service_url,$patientJSON,$MediaType);
		return $response;
	}
  
	public function updateTreatment()
	{
		$patientJSON   = json_encode($this->jsonSerialize());
		$service_url = SERVICE_BASE_URL."Treatment/updateTreatment";
		$MediaType = "application/json";
		$curl_request  = new ServiceCaller();
	    $response =  $curl_request->curl_POST_Request($service_url,$patientJSON,$MediaType);
		return $response;
	}
  	
  	public function getAllOpdTrements()
  	{
  		$service_url = SERVICE_BASE_URL."Treatment/getAllOpdTreatments";
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
  	}
  
	public function getTreatment()
	{
		$service_url = SERVICE_BASE_URL."Treatment/getAllTreatments";
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}

	public function getOpdTreatmentsForVisit($visitId)
	{
		$service_url = SERVICE_BASE_URL."Treatment/getOpdTreatmentsForVisit/".$visitId;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	
	public function jsonSerialize()
	{
		$post_data = array(
			"treatmentid" =>   $this->treatmentid,
			"visitid" =>   $this->visitid,
			"status" => $this->status,
			"remarks" => $this->remarks,
			"userid" =>  $this->userid,
			"active" =>  $this->active,
			"opdtreatmentid" => $this->opdtreatmentid,
		);
		return $post_data;
	}
	 
}
?>