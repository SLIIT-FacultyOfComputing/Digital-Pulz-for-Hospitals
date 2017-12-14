<?php
session_start();
/**
 * Description of diabeticChartC
 *
 * @author nipuna
 */
class diabeticChartC extends CI_Controller {

    function __construct() {

        parent:: __construct();
        $this->load->helper(array('url'));
    }

    public function index($bhtNo, $patientID) {
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
        $this->load->view('inward/charts/diabeticChart');
        $this->load->view('layout/footer1');
    }

    public function getDischargeType($bhtNo) {
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $admission = $this->admission->getWardAdmissionDetails($bhtNo);
        foreach ($admission as $value) {
            $discharjType = $value->dischargeType;
        }
        return $discharjType;
    }

    public function getCordinate() {
        $this->load->model('/inward/charts/diabeticChartModel', 'diabetic');
        $values = $this->diabetic->getCordinates();
        return $values;
    }

}
