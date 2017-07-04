<?php

class EmployeeModel extends CI_Model {
    private $empID;
    private $empName;
    
    public function getEmpID() {
        return $this->empID;
    }

    public function setEmpID($empID) {
        $this->empID = $empID;
    }

    public function getEmpName() {
        return $this->empName;
    }

    public function setEmpName($empName) {
        $this->empName = $empName;
    }
    
     public function jsonSerialize(){	
        return array(
            'empID'=>$this->empID,
            'empName'=>$this->empName);	
    }


        public function getAll_Employees_ByType($empType){
        
        $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $eType=$empType;
        $serviceURL=SERVICE_BASE_URL."Employee/empListByEmpType/".$eType;
        $media_Type="application/json";
        $response=$this->serviceCaller->curl_GET_All_Request($serviceURL,$media_Type);
        $decodeResponse=  json_decode($response);
        
       return $decodeResponse;
    }
}

?>
