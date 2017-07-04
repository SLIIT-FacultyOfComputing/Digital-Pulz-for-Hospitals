<?php
session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of liquidBalanceChartC
 *
 * @author nipuna
 */
class liquidBalanceChartC extends CI_Controller {

    function __construct() {

        parent:: __construct();
        $this->load->helper(array('url'));
    }
    public function getDischargeType($bhtNo) {
        
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $admission = $this->admission->getWardAdmissionDetails($bhtNo);
        foreach ($admission as $value) {
            $discharjType = $value->dischargeType;
        }
        return $discharjType;
    }

    public function index($bhtNo,$patientID) {
         if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);
        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $dischargeType = $this->getDischargeType($bhtNo);
        $data['dischjType'] = $dischargeType;
        if ($dischargeType == "IT") {
            $this->load->model('/inward/transfer/InternalTrasferModel', 'internaltransfer');
            $data['transviewData'] = $this->internaltransfer->getInternalTransferByBHTNo($bhtNo);
        } elseif ($dischargeType == "ET") {
            $this->load->model('/inward/transfer/ExternalTransferModel', 'Externaltransfer');
            $data['transviewData'] = $this->Externaltransfer->getExternalTransferByBHTNo($bhtNo);
        }



        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigationBHT1',$data);
        
        //$data['liquid'] = $this->getCordinate();
        $this->load->view('inward/charts/liquidBalanceChart');
        $this->load->view('layout/footer1');
    }
    
     public function getCordinate(){
        $this->load->model('/inward/charts/LiquidBlanceChartModel','liquid');
        $values = $this->liquid->getCordinates();
        return $values;
        
    }

}
