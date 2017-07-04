<?php

session_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PrescrptionC
 *
 * @author Hasangi
 */
class PrescrptionC extends CI_Controller {
    

    //put your code here
    public function index($bhtNo, $patientID) {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        date_default_timezone_set("Asia/Colombo");
        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $data['dischjType'] = $this->getDischargeType($bhtNo);
        $this->load->view('layout/headerBHT1', $data);
        $this->load->view('layout/navigationBHT1');

        $count = $this->getPrescriptionTermsCount($bhtNo);
        $data['count'] = $count;
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);
        if ($count == 0) {
            $this->load->view('inward/patientBHT/PatientDetails', $data);

            //insert term
            $this->load->model('/inward/prescription/PrescrptionTermModel', 'termModel');
            $this->termModel->setBht_no($bhtNo);
            $this->termModel->setNo_of_terms(1);
            $this->termModel->setStart_date(date('Y-m-d'));
            $this->termModel->setEnd_date(date('Y-m-d'));
            $this->termModel->setCreate_user($_SESSION['user']);
            $ok = $this->termModel->insertPrescrptionTerms();

            //get term ID

            $data['TermList'] = $this->request->getPrescrptionTermsByBHTNo($bhtNo);
            $this->load->view('inward/prescription/prescrptionHome', $data);
        } else {

            $this->load->view('inward/patientBHT/PatientDetails', $data);
            $this->load->model('/inward/prescription/PrescrptionTermModel', 'request');
            $data['TermList'] = $this->request->getPrescrptionTermsByBHTNo($bhtNo);
            $this->load->view('inward/prescription/prescrptionHome', $data);
        }

        $this->load->view('layout/footer1');
    }
     public function getAllWard() {
        $this->load->model('/inward/admin/wardModel', 'wardModel');
        $list = $this->wardModel->getAllWards();
        return $list;
    }
    public function ExtractDrug($bhtNo, $patientID) {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        date_default_timezone_set("Asia/Colombo");
        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $data['dischjType'] = $this->getDischargeType($bhtNo);
        
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigationBHT1',$data);

        $count = $this->getPrescriptionTermsCount($bhtNo);
        $data['count'] = $count;
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);
        if ($count == 0) {
            $this->load->view('inward/patientBHT/PatientDetails', $data);

            //insert term
            $this->load->model('/inward/prescription/PrescrptionTermModel', 'termModel');
            $this->termModel->setBht_no($bhtNo);
            $this->termModel->setNo_of_terms(1);
            $this->termModel->setStart_date(date('Y-m-d'));
            $this->termModel->setEnd_date(date('Y-m-d'));
            $this->termModel->setCreate_user($_SESSION['user']);
            $ok = $this->termModel->insertPrescrptionTerms();

            //get term ID

            $data['TermList'] = $this->request->getPrescrptionTermsByBHTNo($bhtNo);
            $this->load->view('inward/prescription/extractHome', $data);
        } else {

            $this->load->view('inward/patientBHT/PatientDetails', $data);
            $this->load->model('/inward/prescription/PrescrptionTermModel', 'request');
            $data['TermList'] = $this->request->getPrescrptionTermsByBHTNo($bhtNo);
            $this->load->view('inward/prescription/extractHome', $data);
        }

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

    public function getPrescriptionTermsCount($bhtNo) {
        $this->load->model('/inward/prescription/PrescrptionTermModel', 'request');

        $count = 0;
        $list = $this->request->getPrescrptionTermsByBHTNo($bhtNo);

        foreach ($list as $value) {
            $count = $count + 1;
        }

        return $count;
    }

    public function getPrescrptionItemsByTermID($termID) {
        $this->load->model('/inward/prescription/PrescrptionItemModel', 'items');
        $itmsList = $this->items->getPrescrptionItemsByTermID($termID);
        return $itmsList;
    }

    public function prescribeDurg($bhtNo, $patientID) {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        date_default_timezone_set("Asia/Colombo");
        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $data['dischjType'] = $this->getDischargeType($bhtNo);

        //$this->load->view('layout/headerBHT', $data);
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigationBHT1');

        $count = $this->getPrescriptionTermsCount($bhtNo);
        $data['count'] = $count;
        $data['newTermsNo'] = $count + 1;
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);
        $this->load->view('inward/patientBHT/PatientDetails', $data);
        $this->load->model('/inward/prescription/PrescrptionTermModel', 'request');
        $data['TermList'] = $this->request->getPrescrptionTermsByBHTNo($bhtNo);
        $this->load->view('inward/prescription/prescribeDurg', $data);
        $this->load->view('layout/footer1');
    }

    public function getPrescrptionTempsByTermID($termID) {
        $this->load->model('/inward/prescription/TempPrescribeModel', 'items');
        $itmsList = $this->items->getPrescrptionItemsByTermID($termID);
        return $itmsList;
    }

    public function deletePrescrptionTemp() {

        $auto_id = $this->input->post('auto_id');
        $bhtNo = $this->input->post('bhtno');
        $patientID = $this->input->post('patientID');

        $this->load->model('/inward/prescription/TempPrescribeModel', 'items');
        $this->items->setAuto_id($auto_id);
        $ss = $this->items->deletePrescrptionTemp();
        redirect('inward/PrescrptionC/prescribeDurg/' . $bhtNo . '/' . $patientID);
    }

    public function OmitPrescrptionItem() {

        $auto_id = $this->input->post('auto_id');
        $bhtNo = $this->input->post('bhtno');
        $patientID = $this->input->post('patientID');

        $this->load->model('/inward/prescription/PrescrptionItemModel', 'items');
        $ss = $this->items->UpdatePrescrptionItem($auto_id, "omit");
        redirect('inward/PrescrptionC/prescribeDurg/' . $bhtNo . '/' . $patientID);
    }

    public function InsertPrescrptionTemp() {
date_default_timezone_set("Asia/Colombo");

        $bhtNo = $this->input->post('bhtno');
        $patientID = $this->input->post('patientID');
        $drugID = $this->input->post('inputDrug');
        $dose = $this->input->post('inputDosage');
        $frequnce = $this->input->post('inputFrequency');
        $Term_id = $this->input->post('Term_id');

        $this->load->model('/inward/prescription/TempPrescribeModel', 'items');
        $this->items->setTerm_id($Term_id);
        $this->items->setDrug_id($drugID);
        $this->items->setDose($dose);
        $this->items->setFrequency($frequnce);
        $ss = $this->items->addNewPrescrptionItem();
        if ($ss == 'true') {
            redirect('inward/PrescrptionC/prescribeDurg/' . $bhtNo . '/' . $patientID);
        }
    }

    public function SavePrescrption() {
date_default_timezone_set("Asia/Colombo");
        $count = $this->input->post('count');
        $newCount = $count + 1;
        $bhtNo = $this->input->post('bhtno');
        $patientID = $this->input->post('patientID');
        $Term_id = $this->input->post('Term_id');

        $this->load->model('/inward/prescription/PrescrptionItemModel', 'itemModel');
        $this->load->model('/inward/prescription/PrescrptionTermModel', 'termModel');
        $this->load->model('/inward/prescription/TempPrescribeModel', 'tempModel');

        //insert term
        $this->termModel->setBht_no($bhtNo);
        $this->termModel->setNo_of_terms($newCount);
        $this->termModel->setStart_date(date('Y-m-d'));
        $this->termModel->setEnd_date(date('Y-m-d'));
        $this->termModel->setCreate_user($_SESSION['user']);
        $ok = $this->termModel->insertPrescrptionTerms();

        if ($ok == 'true') {

            //get new term id
            $TermList = $this->termModel->getPrescrptionTermsByBHTNo($bhtNo);
            foreach ($TermList as $value) {
                if ($value->no_of_terms == $newCount) {
                    $NewtremId = $value->term_id;
                }
            }

            //insert continoues drug and update it as status as con
            $itemList = $this->itemModel->getPrescrptionItemsByTermID($Term_id);
            foreach ($itemList as $item) {
                if ($item->status == 'active') {

                    $ok = $this->itemModel->UpdatePrescrptionItem($item->auto_id, "con");

                    $this->itemModel->setTerm_id($NewtremId);
                    $this->itemModel->setDrug_id($item->drug_id->dSrNo);
                    $this->itemModel->setDose($item->dose);
                    $this->itemModel->setFrequency($item->frequency);
                    $this->itemModel->setStatus("active");
                    $ss = $this->itemModel->addNewPrescrptionItem();
                }
            }
            //insert Temp table drugs into the item table and delete temp
            $TempList = $this->tempModel->getPrescrptionItemsByTermID($Term_id);
            foreach ($TempList as $item) {

                $this->itemModel->setTerm_id($NewtremId);
                $this->itemModel->setDrug_id($item->drug_id->dSrNo);
                $this->itemModel->setDose($item->dose);
                $this->itemModel->setFrequency($item->frequency);
                $this->itemModel->setStatus("active");
                $ss = $this->itemModel->addNewPrescrptionItem();

                $ok = $this->tempModel->deletePrescrptionTemp($item->auto_id);
            }
        }


        redirect('inward/PrescrptionC/index/' . $bhtNo . '/' . $patientID);
    }

    public function ChangeDrugView($bhtNo, $patientID) {
        date_default_timezone_set("Asia/Colombo");
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['bht_no'] = $bhtNo;
        $data['patient_id'] = $patientID;
        $data['dischjType'] = $this->getDischargeType($bhtNo);

        //$this->load->view('layout/headerBHT', $data);

        $this->load->view('layout/headerBHT1', $data);
        $this->load->view('layout/navigationBHT1', $data);

        $data['change'] = $this->input->post('change');
        $data['auto_id'] = $this->input->post('auto_id');
        $data['Term_id'] = $this->input->post('Term_id');
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);
        $this->load->view('inward/patientBHT/PatientDetails', $data);

        $this->load->view('inward/prescription/ChangeDrug', $data);
    }

    public function ChangeDrug() {
        date_default_timezone_set("Asia/Colombo");
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $bht = $this->input->post('bht_no');
        $patientID = $this->input->post('patient_id');
        $change = $this->input->post('change');
        $data['bht_no'] = $this->input->post('bht_no');
        $data['patient_id'] = $this->input->post('patient_id');
        $data['dischjType'] = $this->getDischargeType($bhtNo);
        
        //$this->load->view('layout/headerBHT', $data);

        $this->load->view('layout/headerBHT1', $data);
        $this->load->view('layout/navigationBHT1', $data);


        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['wardadmission'] = $this->admission->getWardAdmissionDetails($bhtNo);
        $this->load->view('inward/patientBHT/PatientDetails', $data);


        $auto_id = $this->input->post('auto_id');
        $Term_id = $this->input->post('Term_id');
        $Dose = $this->input->post('Dose');
        $drugID = $this->input->post('DrugID');
        $Frequency = $this->input->post('Frequency');

        if ($change == "item") {
            //insert to the temp new changes

            $this->load->model('/inward/prescription/TempPrescribeModel', 'items');
            $this->items->setTerm_id($Term_id);
            $this->items->setDrug_id($drugID);
            $this->items->setDose($Dose);
            $this->items->setFrequency($Frequency);
            $ss = $this->items->addNewPrescrptionItem();

            //update item status as chg
            $this->load->model('/inward/prescription/PrescrptionItemModel', 'itemModel');
            $ss = $this->itemModel->UpdatePrescrptionItem($auto_id, "chg");
        } elseif ($change == "temp") {

            $this->load->model('/inward/prescription/TempPrescribeModel', 'items');
            $ss = $this->items->UpdatePrescrptionItem($auto_id, $Dose,$Frequency);
        }

        redirect('inward/PrescrptionC/prescribeDurg/' . $bht . '/' . $patientID);
    }

}

?>
