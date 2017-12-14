<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<?php

/**
 * Sending_And_Recieving_Requests_Will_Be_Handle_By_This_Class
 *  
 * @category Front_End
 * @package  IPC.Test
 * @author   Rajat Pandit <rajat_pandit@lalaland.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://ipcmedia.com
 */
class Request_Controller extends CI_Controller {

    //var $_url = "http://10.0.0.1:8080/HIS_API";
    var $_url = SERVICE_BASE_URL;

    /**
     * Constructer
     *  
     * @category Front_End
     */
    function Request_Controller() {
        parent::__construct();
        $this->load->model('Drug_model');
        $this->view_data['base_url'] = base_url();
    }

    /**
     * Send_The_Request_View
     *  
     * @category Front_End
     * @return view Send_Request
     */
    function sendRequestView() {
        if (!$this->session->userdata('username')) {
            $this->load->view('Login');
        } else {
            $this->load->view('Send_Request');
        }
    }

    /**
     * Send_The_Request_View
     *  
     * @category Front_End
     * @return Json Category_List
     */
    public function getCatList() {
        if (!$this->session->userdata('username')) {
            $this->load->view('Login');
        } else {
            $this->load->library('curl');
            $_resultFromService = $this->curl->simple_get(
                    $this->_url . 'DrugServices/getDrugCategories'
            );
            $_resultsAfterDecode = json_decode($_resultFromService, true);
            echo json_encode($_resultsAfterDecode);
        }
    }

    /**
     * Send_The_Request_View
     * 
     * @param String $_category Selected_Category
     *   
     * @category Front_End
     * @return Json Drug_List
     */
    public function getDrugList($_category) {
        if (!$this->session->userdata('username')) {
            $this->load->view('Login');
        } else {
            $this->load->library('curl');
            $_catAfterStrReplace = str_replace(' ', '%20', $_category);
            $_resultFromService = $this->curl->simple_get(
                    $this->_url . 'DrugServices/getDrugNamesByCategory/' . $_catAfterStrReplace
            );
            $_resultsAfterDecode = json_decode($_resultFromService);
            echo json_encode($_resultsAfterDecode);
        }
    }

    /**
     * Send_The_Drug_Request
     *  
     * @category Front_End
     * @return Json Drug_Details
     */
    function requestDrug() {


        if (!$this->session->userdata('username')) {
            $this->load->view('Login');
        } else {
            $_getReqArr = (array) $this->input->post('reqArr');
            $_i = 1;
            foreach ($_getReqArr as $_row) {
                $_reqArr["id" . $_i] = $_row;
                $_i++;
            }
            $_reqArr["user"] = $this->session->userdata('userid');

            //$dt = new DateTime();
            //echo $dt->format('Y-m-d H:i:s');

            $_service_url = $this->_url . "DrugServices/requestDrug";

            $_curl = curl_init($_service_url);
            $_data_string = json_encode($_reqArr);

            curl_setopt($_curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($_curl, CURLOPT_POSTFIELDS, $_data_string);
            curl_setopt($_curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                    $_curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($_data_string))
            );


            $_result = curl_exec($_curl);
            echo $_result;
        }
    }

    /**
     * Send_The_View_Drug_Request
     *  
     * @category Front_End
     * @return Json Drug_Details
     */
    function viewRequestDrugs() {
        if (!$this->session->userdata('username')) {
            $this->load->view('Login');
        } else {
            $this->load->library('curl');
            $_resultFromService = $this->curl->simple_get(
                    $this->_url . 'DrugServices/getRequest'
            );
            $_resultsAfterDecode = json_decode($_resultFromService);
            echo json_encode($_resultsAfterDecode);
        }
    }

    /**
     * Add_The_Request
     * 
     * @param String $_category Selected_Category
     *   
     * @category Front_End
     * @return Json Drug_List
     */
    function addRequestDrug() {
        if (!$this->session->userdata('username')) {
            $this->load->view('Login');
        } else {
            $this->load->library('template');
            $this->template->title('Drug Dispense');
            $this->template
              ->set_layout('pharmacist') 
              ->build('Enter_Request');
    
        }
    }

    /**
     * Send_The_Request_Drug_View
     *  
     * @category Front_End
     * @return view View_Request
     */
    function requestDrugsView() {
        if (!$this->session->userdata('username')) {
            $this->load->library('session');
            $this->session->unset_userdata('logged_in');
            session_destroy();
        
            $data['in'] = FALSE ;
            $data['status'] = "";
            $this->load->library('template');
            $this->template->title('Login');
            $this->template
                 ->set_layout('login') 
                 ->build('login_view',$data);
        
        } else {
            $this->load->library('template');
            $this->template->title('Update Drugs');
            $this->template
                ->set_layout('panelpatientlayout') 
                ->build('View_Request');

            //$this->load->view('View_Request');
        }
    }

    /**
     * Send_The_Request_Drug_View
     *  
     * @category Front_End
     * @return view View_Request
     */
    function approveRequest() {
        if (!$this->session->userdata('username')) {
            $this->load->view('Login');
        } else {
            $_getReqArr = (array) $this->input->post('reqArr');
            $_getQtyArr = (array) $this->input->post('appQty');
            $_i = 1;
            foreach ($_getReqArr as $_row) {
                $_reqArr["id" . $_i] = $_row;
                $_i++;
            }
            $_j = 1;
            foreach ($_getQtyArr as $_row) {
                $_reqArr["qty" . $_j] = $_row;
                $_j++;
            }
            $_serviceUrl = $this->_url . "DrugServices/approveRequest";

            $_curl = curl_init($_serviceUrl);

            $_dataString = json_encode($_reqArr);

            curl_setopt($_curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($_curl, CURLOPT_POSTFIELDS, $_dataString);
            curl_setopt($_curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                    $_curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($_dataString))
            );

            $_result = curl_exec($_curl);
            echo $_result;
        }
    }

    public function approveRequest_new() {

        if (!$this->session->userdata('username')) {
            $this->load->view('Login');
        } else {
            $ids = $this->input->post('reqArr');
            $qtys = $this->input->post('appQty');
            $reqids =  $this->input->post('reqID');

            for ($i = 0; $i < count($ids); $i++) {
                //get drug name
                $drug_name = $this->Drug_model->getDrugName($ids[$i]['id'])->drug_name;
                $data = array(
                    'drug_srno' => $ids[$i]['id'],
                    'drug_name' => $drug_name,
                    'drugQty' => $qtys[$i]['qty'],
                    'drug_reqid' => $reqids[$i]['rid'],
                    'userId' => $this->session->userdata('userid')
                );
                $dataToinsert = json_encode($data);

                $_serviceUrl = $this->_url . 'PharmacyServices/insertDrug';
                $_curl = curl_init($_serviceUrl);

        curl_setopt($_curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($_curl, CURLOPT_POSTFIELDS, $dataToinsert);
        curl_setopt($_curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
                $_curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($dataToinsert))
        );

        $_result = curl_exec($_curl);
        echo $_result;


                $this->Drug_model->insertAsTbl($data, $ids[$i]['id']);


                $old = $this->Drug_model->getPhamDrugQty($ids[$i]['id'])->drug_quantity;
                $new = $old - $qtys[$i]['qty'];
                $this->Drug_model->updatePham($ids[$i]['id'], $new);

                //remove from the request table
            }
        }
    }

    /**
     * Load_The_Home_View
     *  
     * @category Front_End
     * @return view View_Request
     */
    function homeView() {
        if (!$this->session->userdata('username')) {
            $this->load->view('Login');
        } else {
            $this->load->view('Home');
        }
    }

    function report_pdfB() {

        $this->load->view('report_pdfB');
    }

    public function test() {
        $str = '[{"id":"19"}]';
        echo json_decode($str);
    }

}

?>
