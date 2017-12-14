<?php

session_start();

/**
 * Description of MyWardsC
 *
 * @author Hasangi
 */
class MyWardsC extends CI_Controller {

    public function index($ward) {

        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }

        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount() + $this->getAdmissionRequestCount());
        //$this->load->view('layout/HeaderNew', $data);

        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);

        $wardlist = $this->getWardByWardNo($ward);
        $data['wards'] = $wardlist;

        $data['beds'] = $this->getAllBedByWardNo($ward);

        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['nobedsList'] = $this->admission->getWardAdmissionByWardNo($ward);




        $this->load->view('inward/myWards/MyWard', $data);
        $this->load->view('layout/footer1');
    }
     public function getAllWard() {
        $this->load->model('/inward/admin/wardModel', 'wardModel');
        $list = $this->wardModel->getAllWards();
        return $list;
    }

    public function getMywards() {
        if($_SESSION['RoleId'] == '2'){
            return $this->getAllWard();
        }else{
        $this->load->model('/inward/admin/wardModel', 'wardModel');
        return $this->wardModel->getWardByEmpID($_SESSION['EmpId']);     
        }
    }

    public function getInternalTransferCount() {
        $this->load->model('/inward/transfer/InternalTrasferModel', 'internaltransfer');


        $mywards = $this->getMywards();
        $count = 0;
        foreach ($mywards as $val) {


            $list = $this->internaltransfer->getInternalTransferByWard($val->wardNo);

            foreach ($list as $value) {
                $count = $count + 1;
            }
        }

        return $count;
    }

    public function getAllBedByWardNo($wardNo) {
        $this->load->model('/inward/admin/bedModel', 'bedModel');
        $list = $this->bedModel->getAllBedByWardNo($wardNo);
        return $list;
    }

    public function getWardByWardNo($wardNo) {
        $this->load->model('/inward/admin/wardModel', 'wardModel');
        $wardObj = $this->wardModel->getWardByWardNo($wardNo);
        return $wardObj;
    }

    public function getAdmissionRequestCount() {
        $this->load->model('/inward/AdmissionRequestModel', 'request');


        $mywards = $this->getMywards();
        $count = 0;
        foreach ($mywards as $val) {


            $list = $this->request->getAdmissionRequestCount($val->wardNo);

            foreach ($list as $value) {
                $count = $count + 1;
            }
        }

        return $count;
    }

    public function updateBedView() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }

        $data['mywards'] = $this->getMywards();
        $data['count'] = ($this->getInternalTransferCount() + $this->getAdmissionRequestCount());

        //$this->load->view('layout/headerInward', $data);
        $this->load->view('layout/header1', $data);
        $this->load->view('layout/navigation1', $data);





        $data['BHT'] = $this->input->post('bhtno');
        $data['ward'] = $this->input->post('ward');
        $data['bed'] = $this->input->post('bed');
        $data['pid']=$this->input->post('pid');
        $data['freeBedList'] = $this->getFreeBeds($this->input->post('ward'));
        $this->load->view('inward/wardAdmission/changeAdmitBed', $data);


        $wardlist = $this->getWardByWardNo($this->input->post('ward'));
        $data['wards'] = $wardlist;      
        $data['beds'] = $this->getAllBedByWardNo($this->input->post('ward'));
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $data['nobedsList'] = $this->admission->getWardAdmissionByWardNo($this->input->post('ward'));
        $this->load->view('inward/myWards/MyWard', $data);


        $this->load->view('layout/footer1');
    }

    public function ChangeBed() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $old = $this->input->post('old');
        $pid= $this->input->post('pid');
        $wardNo = $this->input->post('ward');
        $bhtNo = $this->input->post('bhtno');
        $BedNo = $this->input->post('bedNo');
        $LastUpdatedUser = $_SESSION['user'];
        $LastUpdatedDateTime = date('Y-m-d\TH:i');
        $this->load->model('/inward/wardAdmission/wardAdmissionModel', 'admission');
        $ss = $this->admission->updateAdmissionBedNo($bhtNo, $BedNo, $LastUpdatedUser, $LastUpdatedDateTime);
        //print_r($ss);
        //exit();
        if ($ss == 'true') {
            $this->UpdateBedAvailability($BedNo, $wardNo, $old,$bhtNo,$pid);
        }

        redirect('inward/MyWardsC/index/' . $wardNo);
    }

    public function getFreeBeds($wardNo) {

        $this->load->model('/inward/admin/bedModel', 'bedModel');
        return ($this->bedModel->getFreeBedByWardNo($wardNo));
    }

    public function UpdateBedAvailability($bedNo, $wardNo, $old, $bhtno, $pid) {
             if ($old == "-99") {
            $this->load->model('/inward/admin/bedModel', 'bedModel');
            $bed = $this->bedModel->geBedByWardNoAndBedNo($wardNo, $bedNo);
            foreach ($bed as $value) {
                $bed_id = $value->bedID;
                $bed_no = $value->bedNo;
                $bed_type = $value->bedType;
                $ward_no = $value->wardNo->wardNo;
                $availble = $value->availability;
            }
            $this->bedModel->setBedID($bed_id);
            $this->bedModel->setBedNo($bed_no);
            $this->bedModel->setBedType($bed_type);
            $this->bedModel->setWardNo($ward_no);
            $this->bedModel->setAvailability($bhtno);
            $this->bedModel->setPatientID($pid);
            $ss = $this->bedModel->UpdateBed();
        } else {
            if ($bedNo == "-99") {
                 $this->load->model('/inward/admin/bedModel', 'bedModel2');
                $bed = $this->bedModel2->geBedByWardNoAndBedNo($wardNo, $old);
                foreach ($bed as $value) {
                    $bed_id = $value->bedID;
                    $bed_no = $value->bedNo;
                    $bed_type = $value->bedType;
                    $ward_no = $value->wardNo->wardNo;
                    $availble = $value->availability;
                }
                $this->bedModel2->setBedID($bed_id);
                $this->bedModel2->setBedNo($bed_no);
                $this->bedModel2->setBedType($bed_type);
                $this->bedModel2->setWardNo($ward_no);
                $this->bedModel2->setAvailability("free");
                $this->bedModel2->setPatientID(0);
                $ss = $this->bedModel2->UpdateBed();
            } else {
                //update old bed as free bed
                 $this->load->model('/inward/admin/bedModel', 'bedModel3');
                 $bed = $this->bedModel3->geBedByWardNoAndBedNo($wardNo, $old);
                foreach ($bed as $value) {
                    $bed_id = $value->bedID;
                    $bed_no = $value->bedNo;
                    $bed_type = $value->bedType;
                    $ward_no = $value->wardNo->wardNo;
                    $availble = $value->availability;
                }
                $this->bedModel3->setBedID($bed_id);
                $this->bedModel3->setBedNo($bed_no);
                $this->bedModel3->setBedType($bed_type);
                $this->bedModel3->setWardNo($ward_no);
                $this->bedModel3->setAvailability("free");
                $this->bedModel3->setPatientID(0);
                $ss = $this->bedModel3->UpdateBed();
                
                //update newly change bed 
                 $this->load->model('/inward/admin/bedModel', 'bedModel4');
                $bed2 = $this->bedModel4->geBedByWardNoAndBedNo($wardNo, $bedNo);
                
                foreach ($bed2 as $value) {
                    $bed_id = $value->bedID;
                    $bed_no = $value->bedNo;
                    $bed_type = $value->bedType;
                    $ward_no = $value->wardNo->wardNo;
                    $availble = $value->availability;
                }
                $this->bedModel4->setBedID($bed_id);
                $this->bedModel4->setBedNo($bed_no);
                $this->bedModel4->setBedType($bed_type);
                $this->bedModel4->setWardNo($ward_no);
                $this->bedModel4->setAvailability($bhtno);
                $this->bedModel4->setPatientID($pid);
                $sts = $this->bedModel4->UpdateBed();
                
            }
        }
    
    }

}

?>
