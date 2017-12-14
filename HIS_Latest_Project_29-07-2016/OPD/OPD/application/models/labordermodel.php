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

class LabOrderModel {
	
	public function LabOrderModel(){}
   		
	private $testid;
	private $visitid;
   	private $orderdate;
	private $duedate;
	private $orderby;
	private $orderlocation;
	private $priority;
	private $remarks;

	public function get_Testid() { return $this->testid; } 
	public function get_Visitid() { return $this->visitid; } 
	public function get_Orderdate() { return $this->orderdate; } 
	public function get_Duedate() { return $this->duedate; } 
	public function get_Orderby() { return $this->orderby; } 
	public function get_Orderlocation() { return $this->orderlocation; } 
	public function get_Priority() { return $this->priority; } 
	public function get_Remarks() { return $this->remarks; } 
	
	public function set_Testid($x) { $this->testid = $x; } 
	public function set_Visitid($x) { $this->visitid = $x; } 
	public function set_Orderdate($x) { $this->orderdate = $x; } 
	public function set_Duedate($x) { $this->duedate = $x; } 
	public function set_Orderby($x) { $this->orderby = $x; } 
	public function set_Orderlocation($x) { $this->orderlocation = $x; } 
	public function set_Priority($x) { $this->priority = $x; } 
	public function set_Remarks($x) { $this->remarks = $x; } 

 
	public function addLabOrder()
	{
		$patientJSON   = json_encode($this->jsonSerialize());
		$service_url =SERVICE_BASE_URL."OPDLabOrder/addLabOrder";
		$MediaType = "application/json";
		$curl_request  = new ServiceCaller();
	    $response =  $curl_request->curl_POST_Request($service_url,$patientJSON,$MediaType);
		return $response;
	}
  
	public function getDoctorLabOrders($docid)
	{
		$service_url =SERVICE_BASE_URL."OPDLabOrder/getLabOrderByUserID/".$docid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url); 
		return $response;
	}
	
	public function getPatientLabOrders($patientID)
	{
		$service_url =SERVICE_BASE_URL."OPDLabOrder/getLabOrderByPatientID/".$patientID;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url); 
		return $response;
	}
	
	
	public function getLabOrderDetails($orderid)
	{
		$service_url ="http://env-7792945.jelastic.servint.net/elab/laborder/searchStatus/".$orderid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url); 
		return $response;
	}
	
	
	public function getVisitLabOrders($visitid)
	{
		$service_url = SERVICE_BASE_URL."OPDLabTestRequest/getOPDRequestByVisitID/".$visitid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	public function getVisitLabOrdersByPid($visitid)
	{
		$service_url = SERVICE_BASE_URL."LabTestRequest/getRequestsByPatientID/".$visitid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	
 	 
	public function jsonSerialize()
	{
		$post_data = array(
			"DueDate" => $this->duedate,
			"OrderdDate" => date('Y-m-d'),
			"TestID" => $this->testid,
			"visitid" => $this->visitid,
			"orderCreateUser" => 1,
			"orderLocation" =>  $this->orderlocation,
			"orderPriority" => $this->priority,
			"orderRemarks" => $this->remarks,
		);
		return $post_data;
	}
	
}
?>