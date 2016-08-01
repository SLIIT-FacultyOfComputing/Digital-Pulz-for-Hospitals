
<?php
session_start();
        
/**
 * Batch_Details_Will_Be_Handle_By_This
 *  
 * @category Front_End
 * @package  IPC.Test
 * @author   Rajat Pandit <rajat_pandit@lalaland.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://ipcmedia.com
 * 
 */
class Batch_Controller extends CI_Controller
{
    /**
    * Constructer
    *  
    * @category Front_End
    */ 
    //var $_url = "http://10.0.0.1:8080/HIS_API";
    var $_url = SERVICE_BASE_URL;
    function Batch_Controller()
    {
        parent::__construct();
        $this -> view_data['base_url'] = base_url();
    }
    /**
     * Send_The_Enter_Batch_View
     *  
     * @category Front_End
     * @return view Enter_Batch
     */   
    function index()
    {
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect(CLIENT_BASE_URL);
            }
        } else {
             redirect(CLIENT_BASE_URL);
        }
        
            $this->load->library('template');
            $this->template->title('Enter Batch');
            $this->template
                ->set_layout('panelpatientlayout') 
                ->build('Enter_Batch');
//		 $this->load->view('Enter_Batch');
        
//        if(!$this->session->userdata('username'))
//        {
//            $this->load->view('Login');
//        }
//        else {
//        $this->load->view('Enter_Batch');
//        }
    }
    /**
     * Send_The_Category_List
     *  
     * @category Front_End
     * @return Json Category_List
     */    
    public function getCatList()
    {
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect(CLIENT_BASE_URL);
            }
        } else {
             redirect(CLIENT_BASE_URL);
        }
        
        $this->load->library('curl');
        
//        print_r($this->_url);
//        exit();
       
        $_resultFromService = $this->curl->simple_get(
        $this->_url.'DrugServices/getDrugCategories'
        );
//        $_resultFromService = $this->curl->simple_get(
//            'http://env-9821234.jelastic.servint.net/pharmacy/rest/DrugServices/getDrugCategories'
//        );
        $_resultsAfterDecode = json_decode($_resultFromService, true);
        
        print_r(json_encode($_resultsAfterDecode));
        exit();
        
        echo json_encode($_resultsAfterDecode);
        
    }
    
    public function getDrugNames()
    {
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect(CLIENT_BASE_URL);
            }
        } else {
             redirect(CLIENT_BASE_URL);
        }
        
        $this->load->library('curl');
        $_resultFromService = $this->curl->simple_get(
        $this->_url.'DrugServices/getDrugNames'
        );
//        $_resultFromService = $this->curl->simple_get(
//            'http://env-9821234.jelastic.servint.net/pharmacy/rest/DrugServices/getDrugNames'
//        );
        $_resultsAfterDecode = json_decode($_resultFromService, true);
        echo json_encode($_resultsAfterDecode);
    }
    /**
     * Send_The_Drug_List
     * 
     * @param String $_category Selected_Category
     *   
     * @category Front_End
     * @return Json Drug_List
     */
    public function getDrugList($_category)
    {
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect(CLIENT_BASE_URL);
            }
        } else {
             redirect(CLIENT_BASE_URL);
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
     * Send_The_Drug_List
     *    
     * @category Front_End
     * @return Json Drug_List
     */
    public function addBatch()
    {
//       echo'batch controller add batch';
        
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"] == -1) {
                redirect(CLIENT_BASE_URL);
            }
        } else {
             redirect(CLIENT_BASE_URL);
        } 
        
        $_drugId = $this->input->post('drugId');
        $_dname = $this->input->post('drugName');
        
        $_bNo = $this->input->post('batchNo');
        $_bQty = $this->input->post('quantity');
        $_mDate = $this->input->post('manufactureDate');
        $_eDate = $this->input->post('expireDate');
        
//        echo $_drugId;
//        echo $_dname;
//        echo $_bNo;
//        echo $_bQty;
//        echo $_mDate;
//        echo $_eDate;
//        die();
//        if($_dname != "" && $_bNo != ""){   
//            $this->form_validation->run() ;
//        }
        
        $_serviceUrl = $this->_url."/rest/DrugServices/addBatch";
//        //$_serviceUrl = "http://env-9821234.jelastic.servint.net/pharmacy/rest/DrugServices/addBatch";

        $_curl = curl_init($_serviceUrl);
//       echo $_SESSION["user"];
//        die();
        $_curlPostData = array(
            "dname" => $_dname,
            "did" => $_drugId,
            "b_no" => $_bNo,
            "b_qty" => $_bQty,
            "b_mdate" => $_mDate,
            "b_edate" => $_eDate,
            "username" => $this->session->userdata('username'),
//            "userid" => $this->session->userdata('userid')
                "userid" =>$_SESSION["user"]
                
        );
//
        $_DataString = json_encode($_curlPostData);
        curl_setopt($_curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($_curl, CURLOPT_POSTFIELDS, $_DataString);
        curl_setopt($_curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $_curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($_DataString))
        );

        $_result = curl_exec($_curl);
        echo $_result;
        
        }

   
 
}
?>
