<?php
session_start();
class externalTransferC extends CI_Controller {


    public function ExternalTransfer() {
         if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login/index');
            }
        } else {
            redirect('Login/index');
        }
        $data['mywards'] = $this->getMywards();
        $data['count'] = $this->getInternalTransferCount();
        $this->load->view('layout/headerInward', $data);

        $this->load->view('inward/Transfer/externalTransfer');
        $this->load->view('layout/footerInward');
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

    public function getMywards() {
        $this->load->model('/inward/admin/wardModel', 'wardModel');
        return $this->wardModel->getWardByEmpID($_SESSION['EmpId']);
    }

}

?>
