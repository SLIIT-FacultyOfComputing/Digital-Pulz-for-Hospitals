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
 * User_Details_Will_Be_Handle_By_This
 *  
 * @category Front_End
 * @package  IPC.Test
 * @author   Rajat Pandit <rajat_pandit@lalaland.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://ipcmedia.com
 * 
 */
class user_controller extends CI_Controller
{
    //var $_url = "http://10.0.0.1:8080/HIS_API";
    var $_url = SERVICE_BASE_URL;
    /**
    * Constructer
    *  
    * @category Front_End
    */     
    
    public $_userdata;
            
    function user_controller()
    {
        parent::__construct();
        $this ->view_data['base_url'] = base_url();
    }
    /**
     * Send_The_Login'_View
     *  
     * @category Front_End
     * @return view Login'
     */     
    function index()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('userRoleName');
        $this->load->view('Login');
        
    }
    /**
     * Send_The_Home'_View
     *  
     * @category Front_End
     * @return view Home
     */
    function addUserView()
    {
        if(!$this->session->userdata('username'))
        {
            $this->load->view('Login');
        }
        else {
        $this->load->view('Add_User');
        }
    }
    /**
     * Authenticate_Username_And_Password
     *  
     * @category Front_End
     * @return Json Username_And_Password
     */     
    function authenticate()
    {
        $this->load->library('curl');
        $_username  = $this->input->post('userName');
        $_password  = $this->input->post('password');

        $_serviceUrl = $this->_url."UserService/userValidation";
        //$_serviceUrl = "http://env-9821234.jelastic.servint.net/pharmacy/rest/UserService/userValidation";
        $_curl = curl_init($_serviceUrl);

        $_curlPostData = array(
              "uUserName" => $_username,
              "uUserPassword" => $_password
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
     * Creating_The_Session
     *  
     * @category Front_End
     * @return String User_Role_Name
     */
    function createSession()
    {
        $_userID       = $this->input->post('userID');
        $_userName     = $this->input->post('userName');
        $_userRoleID   = $this->input->post('userRoleID');
        $_userRoleName = $this->input->post('userRoleName');
        $_userPermissions  =(array) $this->input->post('userPermissions');
        $_userSpclPermissions = (array) $this->input->post('spclPermission');
            
        $this->_userdata = array(
            'user_id'      => $_userID,
            'username'     => $_userName,
            'userRoleID'   => $_userRoleID,
            'userRoleName' => $_userRoleName,
            'userPermissions' => $_userPermissions,
            'spclPermissions' => $_userSpclPermissions
        );
        $this->session->set_userdata($this->_userdata);
        echo $this->session->userdata('userRoleName');
//        foreach($this->session->userdata('userPermissions') as $_row)
//        {
//            echo $_row["per"]." ";
//        }
    }
    /**
     * Add_A_New_User
     *  
     * @category Front_End
     * @return view Add_Drug
     */    
    function addUser()
    {
        if(!$this->session->userdata('username'))
        {
            $this->load->view('Login');
        }
        else {
        $_title = $this->input->post('title');
        $_fname = $this->input->post('firstName');
        $_lname = $this->input->post('lastName');
        $_nic = $this->input->post('nic');
        $_dob = $this->input->post('dob');
        $_status = $this->input->post('civilStatus');
        $_username = $this->input->post('userName');
        $_password = $this->input->post('password');
        $_gender = $this->input->post('gender');
        $_userg = $this->input->post('userGroup');
        $_userd = $this->input->post('userDep');
        $_street = $this->input->post('street');
        $_division = $this->input->post('division');
        $_district = $this->input->post('district');
            
        $_serviceUrl = $this->_url."UserServices/addUser";
            
        $_curl = curl_init($_serviceUrl);
        
        $_curlPostData = array(
            "title" =>$_title,
            "f_name" =>$_fname ,
            "l_name" =>$_lname,
            "nic" => $_nic,
            "dob" => $_dob,
            "civilStatus" => $_status,
            "username" => $_username,
            "password" => $_password,
            "gender" => $_gender,
            "userGroup" => $_userg,
            "userDept" => $_userd,
            "street" => $_street,
            "division" => $_division,    
            "district" => $_district
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
     * Send_The_Home_View
     *  
     * @category Front_End
     * @return view Home
     */    
    function homeView()
    {
        if(!$this->session->userdata('username'))
        {
            $this->load->view('Login');
        }
        else {
        $this->load->view('Home');
        }
        
    }
    
}

?>
