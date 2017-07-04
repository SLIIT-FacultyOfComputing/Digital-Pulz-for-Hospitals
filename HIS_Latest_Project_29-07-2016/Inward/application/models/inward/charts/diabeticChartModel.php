<?php

/**
 * Description of diabeticChartModel
 *
 * @author nipuna
 */
include 'application/models/Service_Caller/ServiceCaller.php';

class diabeticChartModel {

    private $rowNo;
    private $bhtNo;
    private $dateTime;
    private $bloodSuger;

    public function getRowNo() {
        return $this->rowNo;
    }

    public function getBhtNo() {
        return $this->bhtNo;
    }

    public function getDateTime() {
        return $this->dateTime;
    }

    public function getBloodSuger() {
        return $this->bloodSuger;
    }

    public function setRowNo($rowNo) {
        $this->rowNo = $rowNo;
    }

    public function setBhtNo($bhtNo) {
        $this->bhtNo = $bhtNo;
    }

    public function setDateTime($dateTime) {
        $this->dateTime = $dateTime;
    }

    public function setBloodSuger($bloodSuger) {
        $this->bloodSuger = $bloodSuger;
    }

    public function getCordinates() {
        $serviceURL = SERVICE_BASE_URL . "DiabeticChart/getChart";
        $media_Type = "application/json";
        $curRequest = new ServiceCaller();
        $response = $curRequest->curl_GET_All_Request($serviceURL, $media_Type);
        $decodeResponse = json_decode($response);
        return $decodeResponse;
    }

}
