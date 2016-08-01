<?php
class servicecaller {

	public function curl_POST_Request($service_url,$JSON_Object,$request_type)
	{
	
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: ".$request_type));
		curl_setopt($curl, CURLOPT_POSTFIELDS, $JSON_Object);
		$curl_response = curl_exec($curl);
		curl_close($curl);
		return  $curl_response;
	}
	
	public function curl_DELETE_Request($service_url,$JSON_Object,$request_type)
	{
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: ".$request_type));
		curl_setopt($curl, CURLOPT_POSTFIELDS, $JSON_Object);
		$curl_response = curl_exec($curl);
		curl_close($curl);
		return $curl_response;
	}
	
	public function curl_UPDATE_Request($service_url,$JSON_Object,$request_type)
	{
		
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: ".$request_type));
		curl_setopt($curl, CURLOPT_POSTFIELDS, $JSON_Object);
		$curl_response = curl_exec($curl);
		curl_close($curl);
		return $curl_response;
	
	}
	
	public function curl_GET_All_Request($service_url,$request_type)
	{
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: ".$request_type));
		$curl_response = curl_exec($curl);
		curl_close($curl);


        return $curl_response;
		
	}
        
    //getdetails using  patient ID
    public function curl_GET_Request($service_url)
	{
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$curl_response = curl_exec($curl);
		curl_close($curl);
		return $curl_response;
	}

	
	
	
}