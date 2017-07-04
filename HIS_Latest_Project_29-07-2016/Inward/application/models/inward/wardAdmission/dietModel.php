<?php

//include 'application/models/Service_Caller/ServiceCaller.php';
/**
 * Description of wardAdmissionModel
 *
 * @author Nirmani
 */
class dietModel extends CI_Model {
 
    private $diet_id;
    private $patient_id;
    private $patient_diet;
    private $quantity;
    private $diet_category;
    private $time;
    private $status;
    
    function getDiet_id() {
        return $this->diet_id;
    }

    function setDiet_id($diet_id) {
        $this->diet_id = $diet_id;
    }
   
    function getPatient_id() {
        return $this->patient_id;
    }

    function getPatient_diet() {
        return $this->patient_diet;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function getDiet_category() {
        return $this->diet_category;
    }

    function getTime() {
        return $this->time;
    }

    function setPatient_id($patient_id) {
        $this->patient_id = $patient_id;
    }

    function setPatient_diet($patient_diet) {
        $this->patient_diet = $patient_diet;
    }

    function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    function setDiet_category($diet_category) {
        $this->diet_category = $diet_category;
    }

    function setTime($time) {
        $this->time = $time;
    }
    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }

        public function jsonSerialize(){	
        return array(
            'diet_id'=>$this->diet_id,
            'patient_id'=>$this->patient_id,
            'patient_diet'=>$this->patient_diet,
            'quantity'=>$this->quantity,
            'diet_category'=>$this->diet_category,
            'time'=>$this->time,
            'status'=>$this->status);	
    } 
    
   
     public function getPatientDietDetails() {
        $this->load->model('/Service_Caller/ServiceCaller', 'serviceCaller');
        $serviceURL = SERVICE_BASE_URL ."Diet/getPatientDiet/";
        $media_Type = "application/json";
        //$curRequest= new ServiceCaller();
        $response = $this->serviceCaller->curl_GET_All_Request($serviceURL, $media_Type);
        $decodeResponse = json_decode($response);
        return $decodeResponse;
    }
        
      public function insertDiet(){
        $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $data=$this->jsonSerialize();
        $ward_JSON_Obj=json_encode($data);
        $serviceURL=SERVICE_BASE_URL."Diet/insertDiet";
        $media_Type="application/json";
        //$curRequest= new ServiceCaller();
        $response=$this->serviceCaller->curl_POST_Request($serviceURL,$ward_JSON_Obj,$media_Type);
        return $response;
    }
  

}

?>
