<?php

/**
 * Description of temperatureChartModel
 *
 * @author nipuna
 */

include 'application/models/Service_Caller/ServiceCaller.php';

class temperatureChartModel {
    private $rowNo;
    private $bhtNo;
    private $temperature;
    private $dateTime;

    
    public function getRowNo() {
        return $this->rowNo;
    }

    public function getBhtNo() {
        return $this->bhtNo;
    }

    public function getTemperature() {
        return $this->temperature;
    }

    public function getDateTime() {
        return $this->dateTime;
    }

    public function setRowNo($rowNo) {
        $this->rowNo = $rowNo;
    }

    public function setBhtNo($bhtNo) {
        $this->bhtNo = $bhtNo;
    }

    public function setTemperature($temperature) {
        $this->temperature = $temperature;
    }

    public function setDateTime($dateTime) {
        $this->dateTime = $dateTime;
    }

    
    public function getCordinates() {
        $serviceURL = SERVICE_BASE_URL . "temperaturechart/getChart";
        $media_Type = "application/json";
        $curRequest = new ServiceCaller();
        $response = $curRequest->curl_GET_All_Request($serviceURL, $media_Type);
        $decodeResponse = json_decode($response);
        return $decodeResponse;
    }
}
