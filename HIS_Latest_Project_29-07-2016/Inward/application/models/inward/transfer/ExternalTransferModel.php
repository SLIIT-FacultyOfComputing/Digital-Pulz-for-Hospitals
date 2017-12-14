<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExternalTransferModel
 *
 * @author Hasangi
 */
class ExternalTransferModel extends CI_Model{
       
        private $bhtNo;
	private $transferFrom;
	private $transferTo;
	private $resonForTrasnsfer;
	private $reportOfSpacialExamination;
	private $treatmentSuggested;
	private $transferCreatedDate;
	private $transferCreatedUser;
	private $nameOfGuardian;
        private $addressOfGuardian;
        
        public function jsonSerialize(){	
        return array(
         
            'bhtNo'=>$this->bhtNo,
            'transferFrom'=>$this->transferFrom,
            'transferTo'=>$this->transferTo,
            'resonForTrasnsfer'=>$this->resonForTrasnsfer,
            'reportOfSpacialExamination'=>$this->reportOfSpacialExamination,
            'treatmentSuggested'=>$this->treatmentSuggested,
            'transferCreatedDate'=>$this->transferCreatedDate,
            'transferCreatedUser'=>$this->transferCreatedUser,
             'nameOfGuardian'=>$this->nameOfGuardian,
             'addressOfGuardian'=>$this->addressOfGuardian     
            
            
            );	
    }
        
        
        public function getBhtNo() {
            return $this->bhtNo;
        }

        public function setBhtNo($bhtNo) {
            $this->bhtNo = $bhtNo;
        }

        public function getTransferFrom() {
            return $this->transferFrom;
        }

        public function setTransferFrom($transferFrom) {
            $this->transferFrom = $transferFrom;
        }

        public function getTransferTo() {
            return $this->transferTo;
        }

        public function setTransferTo($transferTo) {
            $this->transferTo = $transferTo;
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

        public function getNameOfGuardian() {
            return $this->nameOfGuardian;
        }

        public function setNameOfGuardian($nameOfGuardian) {
            $this->nameOfGuardian = $nameOfGuardian;
        }

        public function getAddressOfGuardian() {
            return $this->addressOfGuardian;
        }

        public function setAddressOfGuardian($addressOfGuardian) {
            $this->addressOfGuardian = $addressOfGuardian;
        }
        
         public function insertExternalTransfer(){
            
        $this->load->model('/Service_Caller/ServiceCaller','serviceCaller');
        $data=$this->jsonSerialize();
        $ward_JSON_Obj=json_encode($data);
        $serviceURL=SERVICE_BASE_URL."ExternalTransfer/addExternalTransfer";
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


        
        
}

?>
