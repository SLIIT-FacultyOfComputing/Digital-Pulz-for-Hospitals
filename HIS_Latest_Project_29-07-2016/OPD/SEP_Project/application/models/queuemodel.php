<?php

include_once 'servicecaller.php';

class QueueModel {

	private $queueTokenNo;
	private $queueTokenAssignTime;
	private $queueAssignedBy;
	private $queueAssignedTo;
	private $queueStatus;
	private $queueRemarks;
	private $patient;

	public function getQueueTokenNo() { return $this->queueTokenNo; } 
	public function getQueueTokenAssignTime() { return $this->queueTokenAssignTime; } 
	public function getQueueAssignedBy() { return $this->queueAssignedBy; } 
	public function getQueueAssignedTo() { return $this->queueAssignedTo; } 
	public function getQueueStatus() { return $this->queueStatus; } 
	public function getQueueRemarks() { return $this->queueRemarks; } 
	public function getPatient() { return $this->patient; } 
	public function setQueueTokenNo($x) { $this->queueTokenNo = $x; } 
	public function setQueueTokenAssignTime($x) { $this->queueTokenAssignTime = $x; } 
	public function setQueueAssignedBy($x) { $this->queueAssignedBy = $x; } 
	public function setQueueAssignedTo($x) { $this->queueAssignedTo = $x; } 
	public function setQueueStatus($x) { $this->queueStatus = $x; } 
	public function setQueueRemarks($x) { $this->queueRemarks = $x; } 
	public function setPatient($x) { $this->patient = $x; } 

	public function QueueModel(){ }
   
    public function getQueuePatientsByUserID($userid)
	{
		$service_url = SERVICE_BASE_URL."Queue/getQueuePatientsByUserID/".$userid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	
	public function addToQueue()
	{
		$queueJson   = json_encode($this->jsonSerialize());
		$service_url = SERVICE_BASE_URL."Queue/addPatientToQueue";
		$MediaType = "application/json";
		$curl_request  = new ServiceCaller();
	    $response =  $curl_request->curl_POST_Request($service_url,$queueJson,$MediaType);
		return $response;
	}
	
	public function removeFromQueue($patientID)
	{
		$service_url = SERVICE_BASE_URL."Queue/checkoutPatient/".$patientID;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	} 
	
	public function isPatientInQueue($patientID)
	{
		$service_url = SERVICE_BASE_URL."Queue/isPatientInQueue/".$patientID;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	} 
	 
	public function checkinPatient($patientID)
	{
		$service_url = SERVICE_BASE_URL."Queue/checkinPatient/".$patientID;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	} 
	
	public function getCurrentInPatient($doctor)
	{
		$service_url = SERVICE_BASE_URL."Queue/getCurrentInPatient/".$doctor;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	} 
	
	public function getTreatedPatients($doctor)
	{
		$service_url = SERVICE_BASE_URL."Queue/getTreatedPatients/".$doctor;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	} 
	
	public function redirectQueue($doctor)
	{
		$service_url = SERVICE_BASE_URL."Queue/redirectQueue/".$doctor;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	} 
	
	public function holdQueue($doctor)
	{
		$service_url = SERVICE_BASE_URL."Queue/holdQueue/".$doctor;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	} 
	
	
	public function getQStatus($doctor)
	{
		$service_url = SERVICE_BASE_URL."Queue/getUserQStatus/".$doctor;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	} 
	
	
	public function getQType()
	{
		$service_url = SERVICE_BASE_URL."Queue/getQueueType";
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	} 
	
	public function setQType()
	{
		$service_url = SERVICE_BASE_URL."Queue/setQueueType";
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	} 
	
		
	public function getNextAssignDoctor($patientid = -1)
	{
		$service_url = SERVICE_BASE_URL."Queue/getNextAssignDoctor/".$patientid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	} 
	
	
	public function jsonSerialize()
	{
		$post_data = array( 
				"queueAssignedBy" => $this->queueAssignedBy,
				"queueAssignedTo" => $this->queueAssignedTo, 
				"queueRemarks" =>  $this->queueRemarks,
				"patient" => $this->patient,
		);
		return $post_data;
	}
	
}
?>
