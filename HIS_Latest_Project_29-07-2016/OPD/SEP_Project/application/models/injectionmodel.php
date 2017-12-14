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


class InjectionModel {
	
	public function InjectionModel(){}

	private $injectionid;
	private $visitid;
	private $status;
	private $remarks;
	private $active;
	private $userid;
	private $opdinjectionid;

	public function get_injectionid() { return $this->injectionid; } 
	public function get_opdinjectionid() { return $this->opdinjectionid; } 
	public function get_visitid() { return $this->visitid; } 
	public function get_status() { return $this->status; } 
	public function get_remarks() { return $this->remarks; } 
	public function get_active() { return $this->active; } 
	public function get_userid() { return $this->userid; } 
	public function set_injectionid($x) { $this->injectionid = $x; } 
	public function set_opdinjectionid($x) { $this->opdinjectionid = $x; } 
	public function set_visitid($x) { $this->visitid = $x; } 
	public function set_status($x) { $this->status = $x; } 
	public function set_remarks($x) { $this->remarks = $x; } 
	public function set_active($x) { $this->active = $x; } 
	public function set_userid($x) { $this->userid = $x; } 

	public function addInjection()
	{
		$patientJSON   = json_encode($this->jsonSerialize());
		$service_url = SERVICE_BASE_URL."Injection/addInjection";
		$MediaType = "application/json";
		$curl_request  = new ServiceCaller();
	    $response =  $curl_request->curl_POST_Request($service_url,$patientJSON,$MediaType);
		return $response;
	}
  
	public function updateInjection()
	{
		$patientJSON   = json_encode($this->jsonSerialize());
		$service_url = SERVICE_BASE_URL."Injection/updateInjection";
		$MediaType = "application/json";
		$curl_request  = new ServiceCaller();
	    $response =  $curl_request->curl_POST_Request($service_url,$patientJSON,$MediaType);
		return $response;
	}
  	
  	public function getAllOpdInjections()
  	{
  		$service_url = SERVICE_BASE_URL."Injection/getAllOpdInjections";
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
  	}
  
	public function getInjection()
	{
		$service_url = SERVICE_BASE_URL."Injection/getAllInjections";
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}

	public function getOpdInjectionsForVisit($visitId)
	{
		$service_url = SERVICE_BASE_URL."Injection/getOpdInjectionsForVisit/".$visitId;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	
	public function jsonSerialize()
	{
		$post_data = array(
			"injectionid" =>   $this->injectionid,
			"visitid" =>   $this->visitid,
			"status" => $this->status,
			"remarks" => $this->remarks,
			"userid" =>  $this->userid,
			"active" =>  $this->active,
			"opdinjectionid" => $this->opdinjectionid,
		);
		return $post_data;
	}
	 
}
?>