<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InternalTrasferModel
 *
 * @author Hasangi
 */
class InternalTrasferModel extends CI_Model {
    
        private $transferId;
        private $bhtNo;
	private $transferFromWard;
	private $transferWard;
	private $resonForTrasnsfer;
	private $reportOfSpacialExamination;
	private $treatmentSuggested;
	private $transferCreatedDate;
	private $transferCreatedUser;
	private $read;
        private $NewbhtNo;
        
        public function getNewbhtNo() {
            return $this->NewbhtNo;
        }

        public function setNewbhtNo($NewbhtNo) {
            $this->NewbhtNo = $NewbhtNo;
        }

                
        public function getTransferId() {
            return $this->transferId;
        }

        public function setTransferId($transferId) {
            $this->transferId = $transferId;
        }

                
        public function getBhtNo() {
            return $this->bhtNo;
        }

        public function setBhtNo($bhtNo) {
            $this->bhtNo = $bhtNo;
        }

        public function getTransferFromWard() {
            return $this->transferFromWard;
        }

        public function setTransferFromWard($transferFromWard) {
            $this->transferFromWard = $transferFromWard;
        }

        public function getTransferWard() {
            return $this->transferWard;
        }

        public function setTransferWard($transferWard) {
            $this->transferWard = $transferWard;
        }

        public function getResonForTrasnsfer() {
            return $this->resonForTrasnsfer;
        }

        public function setResonForTrasnsfer($resonForTrasnsfer) {
            $this->resonForTrasnsfer = $resonForTrasnsfer;
        }

        public function getReportOfSpacialExamination() {
            return $this->reportOfSpacialExamination;
        }

        public function setReportOfSpacialExamination($reportOfSpacialExamination) {
            $this->reportOfSpacialExamination = $reportOfSpacialExamination;
        }

        public function getTreatmentSuggested() {
            return $this->treatmentSuggested;
        }

        public function setTreatmentSuggested($treatmentSuggested) {
            $this->treatmentSuggested = $treatmentSuggested;
        }

        public function getTransferCreatedDate() {
            return $this->transferCreatedDate;
        }

        public function setTransferCreatedDate($transferCreatedDate) {
            $this->transferCreatedDate = $transferCreatedDate;
        }

        public function getTransferCreatedUser() {
            return $this->transferCreatedUser;
        }

        public function setTransferCreatedUser($transferCreatedUser) {
            $this->transferCreatedUser = $transferCreatedUser;
        }

        public function getRead() {
            return $this->read;
        }

        public function setRead($read) {
            $this->read = $read;
        }

            
    public function getInternalTransferByID($tranferId){
         
         $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $serviceURL=SERVICE_BASE_URL."InternalTransfer/getInternalTransferByID/".$tranferId;
        $media_Type="application/json";
        //$curRequest= new ServiceCaller();
        $response=$this->serviceCaller->curl_GET_All_Request($serviceURL,$media_Type);
        $decodeResponse=  json_decode($response);
        return $decodeResponse;
     
    }
    
     public function getInternalTransferByWard($wardNo){
         
         $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $serviceURL=SERVICE_BASE_URL."InternalTransfer/getNotReadInternalTransferByWard/".$wardNo;
        $media_Type="application/json";
        //$curRequest= new ServiceCaller();
        $response=$this->serviceCaller->curl_GET_All_Request($serviceURL,$media_Type);
        $decodeResponse=  json_decode($response);
        return $decodeResponse;
     
    }
    public function getInternalTransferByBHTNo($bhtNo){
         
         $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $serviceURL=SERVICE_BASE_URL."InternalTransfer/getInternalTransferByBHTNo/".$bhtNo;
        $media_Type="application/json";
        //$curRequest= new ServiceCaller();
        $response=$this->serviceCaller->curl_GET_All_Request($serviceURL,$media_Type);
        $decodeResponse=  json_decode($response);
        return $decodeResponse;
     
    }
    
     public function UpdateTransfer()
    {
        $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $data=$this->getUpdateJson();
        $ward_JSON_Obj=json_encode($data);
      
        $serviceURL=SERVICE_BASE_URL."InternalTransfer/updateInternalTransfer";
        $media_Type="application/json";
        $response=$this->serviceCaller->curl_UPDATE_Request($serviceURL,$ward_JSON_Obj,$media_Type);
        return $response;
    } 
    
     public function getUpdateJson(){
        return array('transferId'=>  $this->transferId,'NewbhtNo'=>$this->NewbhtNo );
    }
    
     public function insertInternalTransfer(){
            
        $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $data=$this->jsonSerialize();
        $ward_JSON_Obj=json_encode($data);
        $serviceURL=SERVICE_BASE_URL."InternalTransfer/addInternalTransfer";
        $media_Type="application/json";
        //$curRequest= new ServiceCaller();
        $response=$this->serviceCaller->curl_POST_Request($serviceURL,$ward_JSON_Obj,$media_Type);
        return $response;
    }
    
      public function getExternalTransferByBHTNo($bhtNo){
         
         $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $serviceURL=SERVICE_BASE_URL."ExternalTransfer/getSelectExternalTransfer/".$bhtNo;
        $media_Type="application/json";
        //$curRequest= new ServiceCaller();
        $response=$this->serviceCaller->curl_GET_All_Request($serviceURL,$media_Type);
        $decodeResponse=  json_decode($response);
        return $decodeResponse;
     
    }
    
    
     public function jsonSerialize(){	
        return array(
            'transferId'=>  $this->transferId,
            'bhtNo'=>$this->bhtNo,
            'transferFromWard'=>$this->transferFromWard,
            'transferWard'=>$this->transferWard,
            'resonForTrasnsfer'=>$this->resonForTrasnsfer,
            'reportOfSpacialExamination'=>$this->reportOfSpacialExamination,
            'treatmentSuggested'=>$this->treatmentSuggested,
            'transferCreatedDate'=>$this->transferCreatedDate,
            'transferCreatedUser'=>$this->transferCreatedUser,
             'read'=>$this->read,
            
            
            
            );	
    }
}

?>
