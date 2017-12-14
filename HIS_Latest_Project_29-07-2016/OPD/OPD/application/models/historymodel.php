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

class HistoryModel {
	
	public function HistoryModel(){}

	private $patientRecordID;
	private $patient;
	private $recordType;
	private $recordText;
	private $recordVisibility;
	private $recordCompleted; 
	private $recordCreateUser;
	private $recordLastUpdateUser;

	public function getPatientRecordID() { return $this->patientRecordID; } 
	public function getPatient() { return $this->patient; } 
	public function getRecordType() { return $this->recordType; } 
	public function getRecordText() { return $this->recordText; } 
	public function getRecordVisibility() { return $this->recordVisibility; } 
	public function getRecordCompleted() { return $this->recordCompleted; } 
	public function getRecordCreateUser() { return $this->recordCreateUser; } 
	public function getRecordLastUpdateUser() { return $this->recordLastUpdateUser; } 
	public function setPatientRecordID($x) { $this->patientRecordID = $x; } 
	public function setPatient($x) { $this->patient = $x; } 
	public function setRecordType($x) { $this->recordType = $x; } 
	public function setRecordText($x) { $this->recordText = $x; } 
	public function setRecordVisibility($x) { $this->recordVisibility = $x; } 
	public function setRecordCompleted($x) { $this->recordCompleted = $x; } 
	public function setRecordCreateUser($x) { $this->recordCreateUser = $x; } 
 
	public function setRecordLastUpdateUser($x) { $this->recordLastUpdateUser = $x; } 

	public function addHistory()
	{
		$patientJSON   = json_encode($this->jsonSerialize());  ;
		$service_url = SERVICE_BASE_URL."Record/addRecord";
		$MediaType = "application/json";
		$curl_request  = new ServiceCaller();
	    $response =  $curl_request->curl_POST_Request($service_url,$patientJSON,$MediaType);
		return $response;
	}
  
	
	public function updateHistory()
	{
		$patientJSON = json_encode($this->jsonSerialize());  ;
		$service_url = SERVICE_BASE_URL."Record/updateRecord";
		$MediaType = "application/json";
		$curl_request  = new ServiceCaller();
	    $response =  $curl_request->curl_POST_Request($service_url,$patientJSON,$MediaType);
		return $response;
	}
		
	public function getHistory()
	{
		$service_url = SERVICE_BASE_URL."History/getHistroyRecordsByPatientID/".$this->pid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	 
	public function getRecordByRecordID($recid)
	{
		$service_url = SERVICE_BASE_URL."Record/getRecordRecordByRecordID/".$recid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	
	public function jsonSerialize()
	{
 
		$post_data = array(
				"patientRecordID" => $this->patientRecordID,
				"patient" => $this->patient,
				"recordType" => $this->recordType,
				"recordText" =>  $this->recordText,
				"recordVisibility" =>  $this->recordVisibility,
			    "recordCompleted" =>  $this->recordCompleted,
				"recordCreateUser" =>  $this->recordCreateUser,
				"recordLastUpdateUser" =>  $this->recordLastUpdateUser
		);
		return $post_data;
	}
	 
}
?>