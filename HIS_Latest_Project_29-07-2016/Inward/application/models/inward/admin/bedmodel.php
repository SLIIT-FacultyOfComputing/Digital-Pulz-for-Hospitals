<?php

/**
 * Description of bedModel
 *
 * @author Hasangi
 */
class bedModel extends CI_Model {
    
    private $bedID;
    private $bedNo;
    private $bedType;
    private $wardNo;
    private $availability;
    private $patientID;
    
    public function getBedID() {
        return $this->bedID;
    }

    public function setBedID($bedID) {
        $this->bedID = $bedID;
    }

    public function getBedNo() {
        return $this->bedNo;
    }

    public function setBedNo($bedNo) {
        $this->bedNo = $bedNo;
    }

    public function getBedType() {
        return $this->bedType;
    }

    public function setBedType($bedType) {
        $this->bedType = $bedType;
    }

    public function getWardNo() {
        return $this->wardNo;
    }

    public function setWardNo($wardNo) {
        $this->wardNo = $wardNo;
    }

    public function getAvailability() {
        return $this->availability;
    }

    public function setAvailability($availability) {
        $this->availability = $availability;
    }
    
    public function getPatientID() {
        return $this->patientID;
    }

    public function setPatientID($patientID) {
        $this->patientID = $patientID;
    }

        
    public function jsonSerialize(){	
        return array(
            'bedID'=>$this->bedID,
            'bedNo'=>$this->bedNo,
            'bedType'=>$this->bedType,
            'wardNo'=>$this->wardNo,
            'availability'=>$this->availability);	
    }
    
    public function getAllBedByWardNo($wardNo){
         
         $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $serviceURL=SERVICE_BASE_URL."Bed/getAllBedByWardNo/".$wardNo;
        $media_Type="application/json";
        $response=$this->serviceCaller->curl_GET_All_Request($serviceURL,$media_Type);
        $decodeResponse=  json_decode($response);
        return $decodeResponse;
     
    }
    
    public function insertBed(){
        $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $data=$this->jsonSerialize();
        $ward_JSON_Obj=json_encode($data);
        $serviceURL=SERVICE_BASE_URL."Bed/addBed";
        $media_Type="application/json";
        $response=$this->serviceCaller->curl_POST_Request($serviceURL,$ward_JSON_Obj,$media_Type);
        return $response;
    }
    
    
    public function deleteBed() {
          $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $data=array('bedID'=> $this->getBedID());
        $ward_JSON_Obj=json_encode($data);
        $serviceURL=SERVICE_BASE_URL."Bed/deleteBed/";
        $media_Type="application/json";
        $response=$this->serviceCaller->curl_DELETE_Request($serviceURL,$ward_JSON_Obj,$media_Type);
        return $response;
    }
    
    
    public function UpdateBed()
    {
        $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $data=$this->getUpdateBedJson();
        $ward_JSON_Obj=json_encode($data);
        $serviceURL=SERVICE_BASE_URL."Bed/updateBed";
        $media_Type="application/json";
        $response=$this->serviceCaller->curl_UPDATE_Request($serviceURL,$ward_JSON_Obj,$media_Type);
        return $response;
    } 
    public function getUpdateBedJson(){
        return array('bedID'=>  $this->getBedID(),
            'bedNo'=>  $this->getBedNo(),
            'bedType'=>  $this->getBedType(),
             'patientID'=>  $this->getPatientID(),
            'wardNo'=>  $this->getWardNo()
                ,'availability'=>  $this->getAvailability());
    }


     public function geBedByWardNoAndBedNo($wardNo,$bedNo){
         
         $this->load->model('/Service_Caller/ServiceCaller','service');
        $serviceURL=SERVICE_BASE_URL."Bed/geBedByWardNoAndBedNo/".$wardNo."/".$bedNo;
        $media_Type="application/json";
        $response=$this->service->curl_GET_All_Request($serviceURL,$media_Type);
        $decodeResponse=  json_decode($response);
        return $decodeResponse;
     
    }
    
     public function getFreeBedByWardNo($wardNo){
         
         $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $serviceURL=SERVICE_BASE_URL."Bed/getFreeBedByWardNo/".$wardNo;
        $media_Type="application/json";
        $response=$this->serviceCaller->curl_GET_All_Request($serviceURL,$media_Type);
        $decodeResponse=  json_decode($response);
        return $decodeResponse;
     
    }
    
    
}

?>
