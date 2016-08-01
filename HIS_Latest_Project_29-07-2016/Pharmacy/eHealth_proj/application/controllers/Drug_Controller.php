<?php

session_start();

/**
 * Drug_Details_Will_Be_Handle_By_This
 *  
 * @category Front_End
 * @package  IPC.Test
 * @author   Rajat Pandit <rajat_pandit@lalaland.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://ipcmedia.com
 * 
 */
class Drug_Controller extends CI_Controller {

    /**
     * Constructer
     *  
     * @category Front_End
     */
    var $_url = SERVICE_BASE_URL;
    
    function Drug_Controller() {
        parent::__construct();

        
         if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect(CLIENT_BASE_URL);
            }
        } else {
             redirect(CLIENT_BASE_URL);
        }
        
        
            $this->view_data['base_url'] = base_url();
        
    }
    
/**
     * Send_The_Drug_List
     * 
     * @param String $_category Selected_Category
     *   
     * @category Front_End
     * @return Json Drug_List
     */

    public function getDrugList($_category) {

        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect('Login_View');
            }
        } else {
           redirect('Login_View');
        }

         $this->load->library('curl');
            $_catAfterStrReplace = str_replace(' ', '%20', $_category);
            $_resultFromService = $this->curl->simple_get(
                   $this->_url.'DrugServices/getDrugNamesByCategory/' . $_catAfterStrReplace
            );
            $_resultsAfterDecode = json_decode($_resultFromService);
            echo json_encode($_resultsAfterDecode);
        
        }
    
    /**
     * Send_The_Add_Drug_View
     *  
     * @category Front_End
     * @return view Add_Drug
     */
    function index() {
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect(CLIENT_BASE_URL);
            }
        } else {
             redirect(CLIENT_BASE_URL);
        }
        $this->load->library('template');
            $this->template->title('Update Drugs');
            $this->template
                ->set_layout('panelpatientlayout') 
                ->build('Add_Drug');
        //$this->load->view('Add_Drug');
    }

    /**
     * Send_Drug_Information_View
     *  
     * @category Front_End
     * @return view Drug_Information
     */
    public function drugInformationview() {

       if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect(CLIENT_BASE_URL);
            }
        } else {
             redirect(CLIENT_BASE_URL);
        }
        
            $this->load->library('template');
            $this->template->title('Drug Information');
            $this->template
                ->set_layout('panelpatientlayout') 
                ->build('Drug_Information');
            //$this->load->view('Drug_Information');
        
    }

    /**
     * Send_The_Category_List
     *  
     * @category Front_End
     * @return Json Category_List
     */
    public function drugNameview() {
        if (isset($_SESSION["User"])) {
            if ($_SESSION["User"] == -1) {
                redirect('Login_View');
            }
        } else {
            $this->load->library('template');
            $this->template->title('Add Drugs');
            $this->template
                ->set_layout('panelpatientlayout') 
                ->build('Add_Drug_Names');
            //$this->load->view('Add_Drug_Names');
        }
    }

    /**
     * Send_The_Drug_Details
     *   
     * @category Front_End
     * @return Json Drug_Details
     */
    public function getBatchDetails() {
        $this->load->library('curl');
        $_category = $this->input->post('myOrderString');
        $_batch = $this->input->post('mybatchString');
        $_catAfterStrReplace = str_replace(' ', '%20', $_category);
        $_catBatchStrReplace = str_replace(' ', '%20', $_batch);

        $_serviceUrl = $this->_url.'DrugServices/getBatchDetailsByDrugName';

        $_curl = curl_init($_serviceUrl);

        $_curlPostData = array(
            "dname" => $_category,
            "dbatch" => $_batch
        );


        $_dataString = json_encode($_curlPostData);

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

    /**
     * Update_The_Drug_Details
     *   
     * @category Front_End
     * @return Json Drug_Details
     */
    public function getBatchList($_drug) {
        $this->load->library('curl');
        $_catAfterStrReplace = str_replace(' ', '%20', $_drug);
        //$_catAfterStrReplace = str_replace('/', '\/', $_drug);
        $_resultFromService = $this->curl->simple_get(
               $this->_url.'DrugServices/getBatchesBydName/' . $_drug
        );
        $_resultsAfterDecode = json_decode($_resultFromService);
        echo json_encode($_resultsAfterDecode);
    }

    public function addDrug() {

        if (isset($_SESSION["User"])) {
            if ($_SESSION["User"] == -1) {
                redirect('Login_View');
            }
        } else {

            $_dname = $this->input->post('drugName');
            $_dtype = $this->input->post('drugType');
            //$_dcat = $this->input->post('drugCat');
            //$_dcatid = $this->input->post('drugCatId');
            $_drem = $this->input->post('remarks');
            $_dprice = $this->input->post('price');
            //$_ddosage = $this->input->post('drugDosage');
            //$_ddosageid = $this->input->post('drugDosageId');
            //$_dfrequency = $this->input->post('drugFrequency');
            //$_dfrequencyid = $this->input->post('drugFrequencyId');
            $_dreorder = $this->input->post('drugReorder');
            $_ddanger = $this->input->post('drugDanger');

            $_serviceUrl = $this->_url.'DrugServices/updateDrug';
            //$_serviceUrl = "http://env-9821234.jelastic.servint.net/pharmacy/rest/DrugServices/addDrug";

            $_curl = curl_init($_serviceUrl);

            $_curlPostData = array(
                "dname" => $_dname,
                "dtype" => $_dtype,
                "dprice" => $_dprice,
                "drem" => $_drem,
                //"dcat" => $_dcat,
                //"dcatid" => $_dcatid,
                "dreorder" => $_dreorder,
                "ddanger" => $_ddanger,
                "username" => $this->session->userdata('username'),
                "userid" => $this->session->userdata('userid')
            );

            $_dataString = json_encode($_curlPostData);

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
 /**
     * Update_The_Drug_Details
     *   
     * @category Front_End
     * @return Json Drug_Details
     */
    public function updateBatch() {
     //   if (strcmp($this->session->userdata('userRoleName'), "Chief Pharmacist") == 0) {

            $_dbatchno = $this->input->post('dbatchno');
            $_dcat = $this->input->post('dcat');
            $_dname = $this->input->post('dname');
            $_dqty = $this->input->post('dqty');
            $_dstatus = $this->input->post('dstatus');
            $_sr = $this->input->post('drugId');
            $_user = $this->session->userdata('username');

            $_serviceUrl = $this->_url.'DrugServices/updateBatch';

            $_curl = curl_init($_serviceUrl);

            $_curlPostData = array(
                "dbatchno" => $_dbatchno,
                "dcat" => $_dcat,
                "dname" => $_dname,
                "dqty" => $_dqty,
                "duser" => $_user,
                "dstatus" => $_dstatus,
                "dsr" => $_sr
            );


            $_dataString = json_encode($_curlPostData);

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
      //  } else {
        //    echo "fail updateBatch in drug_controller";
        //}
    }

    /**
     * Send_The_Drug_Details
     *   
     * @category Front_End
     * @return Json Drug_Details
     */
        
    public function getDrugDetails() {

        $_category = $this->input->post('myOrderString');
            $this->load->library('curl');
            $_catAfterStrReplace = str_replace(' ', '%20', $_category);
            $_resultFromService = $this->curl->simple_get(
                   $this->_url.'DrugServices/getDrugByID/' . $_catAfterStrReplace
            );
            $_resultsAfterDecode = json_decode($_resultFromService);
            echo json_encode($_resultsAfterDecode);
    }

    /**
     * Update_The_Drug_Details
     *   
     * @category Front_End
     * @return Json Drug_Details
     */
    public function updateDrug() {
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                echo "fail";
            }
        } else {
            $_dsrno = $this->input->post('dsr');
            $_dcat = $this->input->post('dcat');
            $_dname = $this->input->post('dname');
            $_dprice = $this->input->post('dprice');
            $_dqty = $this->input->post('dqty');
            $_user = $this->session->userdata('username');

            $_serviceUrl = $this->_url.'DrugServices/updateDrug';
            //$_serviceUrl = "http://env-9821234.jelastic.servint.net/pharmacy/rest/DrugServices/updateDrug";
            $_curl = curl_init($_serviceUrl);

            $_curlPostData = array(
                "dsrno" => $_dsrno,
                "dcat" => $_dcat,
                "dname" => $_dname,
                "dprice" => $_dprice,
                "dqty" => $_dqty,
                "duser" => $_user,
                "userid" => $this->session->userdata('user_id')
            );


            $_dataString = json_encode($_curlPostData);

            curl_setopt($_curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($_curl, CURLOPT_POSTFIELDS, $_dataString);
            curl_setopt($_curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                    $_curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($_dataString))
            );

            $_result = curl_exec($_curl);
            echo "done";
        }
    }

    public function getDrugOrderDetails() {
        $this->load->library('curl');
        $_resultFromService = $this->curl->simple_get(
               $this->_url.'DrugServices/getDrugDetails'
        );
        $_resultsAfterDecode = json_decode($_resultFromService);
        echo json_encode($_resultsAfterDecode);
    }

    public function getDrugNames() {
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect('Login_View');
            }
        } else {
           redirect('Login_View');
        }
        
         $this->load->library('curl');
            $_resultFromService = $this->curl->simple_get(
                   $this->_url.'DrugServices/getDrugNames'
            );
            $_resultsAfterDecode = json_decode($_resultFromService, true);
            echo json_encode($_resultsAfterDecode);
    }
    
    public function Import_View() {

         include 'Excel/reader.php';
        $data = new Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('CP1251');
        $data->read($_FILES['file']['tmp_name']);

//columns:
        $sql = "INSERT INTO `pharm_drug` (";
        for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
            $sql .= "`" . mysql_real_escape_string($data->sheets[0]['cells'][1][$j]) . "`,";
        }
        $sql = substr($sql, 0, -1) . ") VALUES\r\n";
//cells
        for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
            $sql .= "(";
            for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
                $sql .= "'" . mysql_real_escape_string($data->sheets[0]['cells'][$i][$j]) . "',";
            }
            $sql = substr($sql, 0, -1) . "),\r\n";
        }
        $sql = substr($sql, 0, -3) . ";";

        echo '<pre>';
        echo $sql;


        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "his";

// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //alert("New record created successfully");
        if ($conn->query($sql) === TRUE) {
            echo '<script language="javascript">';
            echo 'alert("message successfully sent")';
            echo '</script>';
            header("Location: "+CLIENT_BASE_URL+"index.php/Drug_Controller");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    public function getCatList() {

        if (isset($_SESSION["User"])) {
            if ($_SESSION["User"] == -1) {
                redirect('Login_View');
            }
        } else {
            $this->load->library('curl');
            $_resultFromService = $this->curl->simple_get(
                    $this->_url.'DrugServices/getDrugCategories'
            );
            $_resultsAfterDecode = json_decode($_resultFromService, true);
            echo json_encode($_resultsAfterDecode);
        }
    }

}





    /**
     * Add_The_Drug_Details
     *   
     * @category Front_End
     * @return Json Drug_Details
     */
//     function addDrug() {
//      
//    }

   

     
?>