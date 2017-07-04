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

class AllergyModel {
	
	public function AllergyModel(){}

	private $allergyid;
	private $pid;
	private $visitid;
	private $name;
	private $status;
	private $remarks;
	private $createdate;
	private $createuser;
	private $lastupdate;
	private $lastupdateuser;
	private $active;
	private $userid;

	public function get_allergyid() { return $this->allergyid; } 
	public function get_pid() { return $this->pid; } 
	public function get_visitid() { return $this->visitid; } 
	public function get_name() { return $this->name; } 
	public function get_status() { return $this->status; } 
	public function get_remarks() { return $this->remarks; } 
	public function get_createdate() { return $this->createdate; } 
	public function get_createuser() { return $this->createuser; } 
	public function get_lastupdate() { return $this->lastupdate; } 
	public function get_lastupdateuser() { return $this->lastupdateuser; } 
	public function get_active() { return $this->active; } 
	public function get_userid() { return $this->userid; } 
	public function set_allergyid($x) { $this->allergyid = $x; } 
	public function set_pid($x) { $this->pid = $x; } 
	public function set_visitid($x) { $this->visitid = $x; } 
	public function set_name($x) { $this->name = $x; } 
	public function set_status($x) { $this->status = $x; } 
	public function set_remarks($x) { $this->remarks = $x; } 
	public function set_createdate($x) { $this->createdate = $x; } 
	public function set_createuser($x) { $this->createuser = $x; } 
	public function set_lastupdate($x) { $this->lastupdate = $x; } 
	public function set_lastupdateuser($x) { $this->lastupdateuser = $x; } 
	public function set_active($x) { $this->active = $x; } 
	public function set_userid($x) { $this->userid = $x; } 


	public function addAllergy()
	{
		$patientJSON   = json_encode($this->jsonSerialize());
		$service_url = SERVICE_BASE_URL."Allergy/addAllergy";
		$MediaType = "application/json";
		$curl_request  = new ServiceCaller();
	    $response =  $curl_request->curl_POST_Request($service_url,$patientJSON,$MediaType);
		return $response;
	}
  
  
	public function updateAllergy()
	{
		$patientJSON   = json_encode($this->jsonSerialize());
		$service_url = SERVICE_BASE_URL."Allergy/updateAllergy";
		$MediaType = "application/json";
		$curl_request  = new ServiceCaller();
	    $response =  $curl_request->curl_UPDATE_Request($service_url,$patientJSON,$MediaType);
		return $response;
	}
  
  
	public function getAllergies()
	{
		$service_url = SERVICE_BASE_URL."Allergy/getAllergiesByPatient/".$this->pid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	
	public function getAllergy()
	{
		$service_url = SERVICE_BASE_URL."Allergy/getAllergy/".$this->allergyid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	
	
	public function getVisitAllergies()
	{
		$service_url = SERVICE_BASE_URL."allergy/getvisitallergies/".$this->visitid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	
	public function jsonSerialize()
	{
		$post_data = array(
			"allergyid" =>  $this->allergyid,
			"pid" =>  $this->pid,
			"name" => $this->name,
			"status" => $this->status,
			"remarks" => $this->remarks,
			"userid" =>  $this->userid,
			"active" => $this->active,
			"visitid" => $this->visitid
		);
		return $post_data;
	}
	 
}
?>