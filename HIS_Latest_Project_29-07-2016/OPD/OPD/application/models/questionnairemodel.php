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

class QuestionnaireModel {

		public function QuestionnaireModel(){}
		 
		private $userid;
		private $questionnaire;
		
		public function get_userid() { return $this->userid; } 
		public function set_userid($x) {  $this->userid = $x; } 
		
		public function set_questionnaire($x) { $this->questionnaire = $x; } 
		public function get_questionnaire() { return $this->questionnaire; } 

	
		public function addQuestionnaire()
		{
			$questionnaireJSON   = json_encode($this->questionnaire);
			$service_url = SERVICE_BASE_URL."Questionnaire/addQuestionnaire/".$this->userid;
			$MediaType = "application/json";
			$curl_request  = new ServiceCaller();
			$response =  $curl_request->curl_POST_Request($service_url,$questionnaireJSON,$MediaType);
			return $response;
		}
		
		public function updateQuestionnaire($qid)
		{
			$questionnaireJSON   = json_encode($this->questionnaire);
			$service_url = SERVICE_BASE_URL."Questionnaire/updateQuestionnaire/".$qid."/".$this->userid;
			$MediaType = "application/json";
			$curl_request  = new ServiceCaller();
			$response =  $curl_request->curl_POST_Request($service_url,$questionnaireJSON,$MediaType);
			return $response;
		}
		
		
		public function getAllQuestionnaires()
		{
			$service_url = SERVICE_BASE_URL."Questionnaire/getAll";
			$curl_request = new ServiceCaller();
			$response = $curl_request->curl_GET_Request($service_url);
			return $response;
		}
	
			
		public function getQuestionnairesByVisitType($visitType)
		{
			$service_url = SERVICE_BASE_URL."Questionnaire/getQuestionnaireByVisitType/".$visitType;
			$curl_request = new ServiceCaller();
			$response = $curl_request->curl_GET_Request($service_url);
			return $response;
		}
				
		public function getQuestionnaireByID($qid)
		{
			$service_url = SERVICE_BASE_URL."Questionnaire/getQuestionnaireByID/".$qid;
			$curl_request = new ServiceCaller();
			$response = $curl_request->curl_GET_Request($service_url);
			return $response;
		}
		
		public function getQuestionsByQuestionnaireID($qid)
		{
			$service_url = SERVICE_BASE_URL."Questionnaire/getQuestions/".$qid;
			$curl_request = new ServiceCaller();
			$response = $curl_request->curl_GET_Request($service_url);
			return $response;
		}
		
		
		public function saveQuestionAnswer($qid,$visitid,$userid,$postdata)
		{
			$questionnaireJSON   = json_encode($postdata);
			$service_url = 	$service_url = SERVICE_BASE_URL."Questionnaire/saveQuestionAnswer/".$qid."/".$visitid."/".$userid;
			$MediaType = "application/json";
			$curl_request  = new ServiceCaller();
			$response =  $curl_request->curl_POST_Request($service_url,$questionnaireJSON,$MediaType);
			return $response;
		}
		
		
		public function updateQuestionAnswer($qid,$visitid,$userid,$postdata)
		{
			$questionnaireJSON   = json_encode($postdata);
			$service_url = 	$service_url = SERVICE_BASE_URL."Questionnaire/updateQuestionAnswer/".$qid."/".$visitid."/".$userid;
			$MediaType = "application/json";
			$curl_request  = new ServiceCaller();
			$response =  $curl_request->curl_POST_Request($service_url,$questionnaireJSON,$MediaType);
			return $response;
		}
		
		
		public function getAnswers($pid, $qid, $asid)
		{
			$service_url = SERVICE_BASE_URL."Questionnaire/getAnswers/".$pid."/".$qid."/". $asid;
			$curl_request = new ServiceCaller();
			$response = $curl_request->curl_GET_Request($service_url);
			return $response;
		}
}
?>