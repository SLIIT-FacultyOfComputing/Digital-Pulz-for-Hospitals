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

    public function getQueuePatientsByDoctorID($doctorid)
    {
        $service_url = SERVICE_BASE_URL."Queue/getQueuePatientsByDoctorID/".$doctorid;
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

    public function addToQueueAuto()
    {
        $queueJson   = json_encode($this->jsonSerialize());
        $service_url = SERVICE_BASE_URL."Queue/addPatientToQueueAuto";
        $MediaType = "application/json";
        $curl_request  = new ServiceCaller();
        $response =  $curl_request->curl_POST_Request($service_url,$queueJson,$MediaType);
        return $response;
    }

	public function removeFromQueue($patientID, $userID)
	{
		$service_url = SERVICE_BASE_URL."Queue/checkoutPatient/".$patientID."/".$userID;
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

    public function getQTypeForDoctor($doctorid)
    {
        $service_url = SERVICE_BASE_URL."Queue/getQueueType/".$doctorid;
        $curl_request = new ServiceCaller();
        $response = $curl_request->curl_GET_Request($service_url);
        return $response;
    }

    public function setQTypeForDoctor($type,$doctorid)
    {
        $service_url = SERVICE_BASE_URL."Queue/setQueueType/".$type."/".$doctorid;
        $curl_request = new ServiceCaller();
        $response = $curl_request->curl_GET_Request($service_url);
        return $response;
    }

    public function getNextAssignDoctor($patientid = -1)
	{
        date_default_timezone_set("Asia/Colombo");
        $dt=new DateTime();

		$service_url = SERVICE_BASE_URL."Queue/getNextAssignDoctor/".$patientid."/".$dt->format("Y-m-d");
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
