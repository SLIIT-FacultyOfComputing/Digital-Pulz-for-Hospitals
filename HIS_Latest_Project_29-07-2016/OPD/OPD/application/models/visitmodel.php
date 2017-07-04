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

class VisitModel {
	
	public function VisitModel(){}
  
	private $visitid;
	private $pid;
	private $dateofvisit;
	private $complaint;
	private $doctor;
	private $remarks;
	private $visittype;
	private $active;
	private $userid;  
	
	public function get_visitid() { return $this->visitid; } 
	public function get_pid() { return $this->pid; } 
	public function get_type() { return $this->type; } 
	public function get_dateofvisit() { return $this->dateofvisit; } 
	public function get_complaint() { return $this->complaint; }    
	public function get_doctor() { return $this->doctor; } 
	public function get_remarks() { return $this->remarks; }  
	public function get_visittype() { return $this->visittype; } 
	public function get_active() { return $this->active; } 
	public function set_visitid($x) { $this->visitid = $x; } 
	public function set_pid($x) { $this->pid = $x; } 
	public function set_type($x) { $this->type = $x; } 
	public function set_dateofvisit($x) { $this->dateofvisit = $x; } 
	public function set_complaint($x) { $this->complaint = $x; } 
	public function set_doctor($x) { $this->doctor = $x; } 
	public function set_remarks($x) { $this->remarks = $x; }  
	public function set_visittype($x) { $this->visittype = $x; } 
	public function set_active($x) { $this->active = $x; } 
	public function set_userid($x) { $this->userid = $x; } 
	public function get_userid() { return $this->userid; }
 
 
 
	public function addVisit()
	{
		$patientJSON   = json_encode($this->jsonSerialize());
		$service_url = SERVICE_BASE_URL."Visit/addVisit";
		$MediaType = "application/json";
		$curl_request  = new ServiceCaller();
	    $response =  $curl_request->curl_POST_Request($service_url,$patientJSON,$MediaType);
		return $response;
	}
  
  	public function updateVisit()
	{
		$patientJSON   = json_encode($this->jsonSerialize());
		$service_url = SERVICE_BASE_URL."Visit/updateVisit";
		$MediaType = "application/json";
		$curl_request  = new ServiceCaller();
	    $response =  $curl_request->curl_UPDATE_Request($service_url,$patientJSON,$MediaType);
		return $response;
	}

	
	public function getVisits()
	{
		$service_url = SERVICE_BASE_URL."Visit/getVisitsByPatientID/".$this->pid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	
	public function getVisitByVisitID($visitid)
	{
	 
		$service_url = SERVICE_BASE_URL."Visit/getVisitsByVisitID/".$visitid;	
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url); 
		return $response;
	}
	
	  
	public function getRecentVisitID()
	{
		$service_url = SERVICE_BASE_URL."Visit/getRecentVisit/".$this->pid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	
	
	public function getVisitsByVisitDate($date)
	{
		$service_url = SERVICE_BASE_URL."Visit/getVisitsByVisitDate/".$date;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	
	public function getVisitsForReport($fromdate,$todate)
	{
		$service_url = SERVICE_BASE_URL."Visit/getVisitsForReport/".$fromdate."/".$todate."/0";
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	
	public function getComplainsOnSearch($inputInjury)
	{
		$service_url = SERVICE_BASE_URL."Complaint/getComplainsOnSearch/".$inputInjury;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	public function jsonSerialize()
	{
		$post_data = array(
				"visitid" => $this->visitid,
				"pid" => $this->pid,
				"DateandTime" => $this->dateofvisit,
				"Doctor" => $this->userid,
				"VisitType" => $this->visittype,
				"Injury" =>  $this->complaint,
				"Remarks" => $this->remarks,
		);
		return $post_data;
	}
	 
}
?>
