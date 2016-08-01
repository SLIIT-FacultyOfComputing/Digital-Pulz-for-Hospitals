<?php

include_once 'servicecaller.php';

class ServiceModel {
	
	public function ServiceModel(){}
     
	public function getFullUserName($uid)
	{
		 $jsonstring = '[{"employees": {"empID": 1,"empName": "Miyuru Madawa De Silva","post": "Doctor"},"userID": 2,"userName": "Miyuru","userRoles":    {"userRoleID": 1,"userRoleName": "Doctor"}}]';
		$response = json_decode($jsonstring);
		return $response[0]->userName;
		 
		 /*
		$service_url = SERVICE_BASE_URL."UserService/getUsersByUsrID/".$uid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		$response = json_decode($response);
		if( $response != NULL && sizeof($response) > 0)
			return $response->employees->empName;
		else
			return "Unknown";
		*/
	}
	  
	public function validateUser($userName,$password)
	{
		$service_url =  SERVICE_BASE_URL."UserService/userValidation";
		$curl_request = new ServiceCaller();
		
		$MediaType = "application/json";
		$curl_post_data = array(
			"uUserName" => $userName,
			"uUserPassword" => $password
		);

		$response = $curl_request->curl_POST_Request($service_url,json_encode($curl_post_data),$MediaType);
		return $response;
	}
     
     
	 
	public function getDrugByID($id)
	{
		$service_url =  SERVICE_BASE_URL."DrugServices/getDrugByID/".$id;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
     
     
	 
	 public function getComplaints()
	{
		//$service_url = SERVICE_BASE_URL."services/getcomplaints";
		//$curl_request = new ServiceCaller();
		//$response = $curl_request->curl_GET_Request($service_url);
		$response  = json_encode( '{Fever}' );
		return $response;
	}
     
	  public function getDoctor($uid)
	{
		$service_url =  SERVICE_BASE_URL."UserService/getUserByUsrID/".$uid;
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	
	public function getDoctors()
	{
            
            date_default_timezone_set("Asia/Colombo");
            $dt=new DateTime();
            
            //die();
		$service_url = SERVICE_BASE_URL."HrAttandanceService/getAllAttendanceByDept/".$dt->format("Y-m-d")."/5/1";	
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
	
 	
	public function getDrugNameByDrugID($drugid)
	{
		$service_url = SERVICE_BASE_URL."DrugServices/getDrugByID/".$drugid;
		$curl_request = new ServiceCaller();
		$response = json_decode($curl_request->curl_GET_Request($service_url));
		  
		return $response[0]->dName;
	}
	
	public function getLabTestNames()
	{
		$service_url = SERVICE_BASE_URL."testdescription/getAll";
		$curl_request = new ServiceCaller();
		$response = $curl_request->curl_GET_Request($service_url);
		return $response;
	}
}
?>
