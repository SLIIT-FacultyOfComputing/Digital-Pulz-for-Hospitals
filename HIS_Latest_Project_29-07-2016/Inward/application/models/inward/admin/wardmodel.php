<?php
//require 'application/models/Service_Caller/ServiceCaller.php';
/**
 * Description of wardModel
 *
 * @author Hasangi
 */
class wardModel extends CI_Model {
    
    private $wardNo;
    private $category;
    private $wardGender;
    private $noOfBed;
    
    public function  get_wardNo(){
        return $this->wardNo;
    }
    
    public function set_wardNo($value){
        $this->wardNo=$value;
    }
    
    public function  get_category(){
        return $this->category;
    }
    
    public function set_category($value){
        $this->category=$value;
    }
    
    public function  get_wardGender(){
        return $this->wardGender;
    }
    
    public function set_wardGender($value){
        $this->wardGender=$value;
    }
    
    public function  get_noOfBed(){
        return $this->noOfBed;
    }
    
    public function set_noOfBed($value){
        $this->noOfBed=$value;
    }
    
    public function jsonSerialize(){	
        return array(
            'wardNo'=>$this->wardNo,
            'category'=>$this->category,
            'wardGender'=>$this->wardGender,
            'noOfBed'=>$this->noOfBed);	
    }
    
    
    public function insertWard(){
        $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $data=$this->jsonSerialize();
        $ward_JSON_Obj=json_encode($data);
        $serviceURL=SERVICE_BASE_URL."Ward/addWard";
        $media_Type="application/json";
        //$curRequest= new ServiceCaller();
        $response=$this->serviceCaller->curl_POST_Request($serviceURL,$ward_JSON_Obj,$media_Type);
        return $response;
    }
    
     public function getAllWards(){
          $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $serviceURL=SERVICE_BASE_URL."Ward/getWard";
        $media_Type="application/json";
        //$curRequest= new ServiceCaller();
        $response=$this->serviceCaller->curl_GET_All_Request($serviceURL,$media_Type);
        $decodeResponse=  json_decode($response);
        return $decodeResponse;
    }
    
     public function deleteWard() {
          $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $data=array('wardNo'=>  $this->get_wardNo());
        $ward_JSON_Obj=json_encode($data);
        $serviceURL=SERVICE_BASE_URL."Ward/deleteWard/";
        $media_Type="application/json";
        //$curRequest= new ServiceCaller();
        $response=$this->serviceCaller->curl_DELETE_Request($serviceURL,$ward_JSON_Obj,$media_Type);
        return $response;
    }
 
    public function getWardByWardNo($wardNo){
         
         $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $serviceURL=SERVICE_BASE_URL."Ward/getWardByWardNo/".$wardNo;
        $media_Type="application/json";
        //$curRequest= new ServiceCaller();
        $response=$this->serviceCaller->curl_GET_All_Request($serviceURL,$media_Type);
        $decodeResponse=  json_decode($response);
        return $decodeResponse;
     
    }
    
    public function UpdateWard()
    {
         $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $data=$this->getUpdateWardJson();
        $ward_JSON_Obj=json_encode($data);
        $serviceURL=SERVICE_BASE_URL."Ward/updateWard";
        $media_Type="application/json";
        //$curRequest= new ServiceCaller();
        $response=$this->serviceCaller->curl_UPDATE_Request($serviceURL,$ward_JSON_Obj,$media_Type);
        return $response;
    }   
    
        public function getUpdateWardJson(){
        return array('wardNo'=>  $this->get_wardNo(),
            'category'=>  $this->get_category(),
            'wardGender'=>  $this->get_wardGender()
                ,'noOfBed'=>  $this->get_noOfBed());
    }
    
     public function getWardByEmpID($empID){
          $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $serviceURL=SERVICE_BASE_URL."HrEmployee/getEmployeesWard/".$empID;
        $media_Type="application/json";
        //$curRequest= new ServiceCaller();
        $response=$this->serviceCaller->curl_GET_All_Request($serviceURL,$media_Type);
        $decodeResponse=  json_decode($response);
        return $decodeResponse;
    }
    
}

?>
