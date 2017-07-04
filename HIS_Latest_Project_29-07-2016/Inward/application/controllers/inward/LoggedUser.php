<?php

session_start();


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class LoggedUser extends CI_Controller {

    public function index() {
    
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login');
            }
        }  else {
           redirect('Login');  
          }

        $this->LoadAllUsers();
    }

    public function LoadAllUsers() {
        
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login');
            }
        }  else {
           redirect('Login');  
          }
        
          $user = $_SESSION['user'] ;
          
       // $this->load->model("DataAccess");
        $this->load->model("UserWebServiceHandler");
        $data['title'] = "User Home";
        
//        $user = $this->DataAccess->SelectAll("Select user_id as userId,user_name as userName, Password as password
//                                               ,employee_id,role_id from admin_user where user_id =".$user);
          $user = $this->UserWebServiceHandler->GetUser($user);
        
          
            $data['userId'] = $user[0]-> userId;
            $data['userName'] = $user[0]-> userName;
            $data['password'] = $user[0]-> password;
            $data['employeeId'] = $user[0]->hrEmployee->empId;
            $data['roleId'] = $user[0]->adminUserroles->roleId;
  
//            print_r($user);
//            exit();
        
        $data['results'] = $user;
                
        //$data['employees'] = 
        
        //$this->DataAccess->SelectAll("Select * from hr_employee where is_Active = TRUE");
         
         $this->load->model("RoleWebServiceHandler");
         
         $data['roles'] = $this->RoleWebServiceHandler->GetAllRoles();
                 //$this->DataAccess->SelectAll("Select * from admin_userroles "); //where IsActive = TRUE

        $data['permission'] = $_SESSION['permission'];
                //$this->GetRolePermissions($_SESSION['user']);
       $data['mywards']=$this->getMywards();
            $data['count']=$this->getInternalTransferCount();
        $this->load->view("LoggedUser/root_user_details", $data);
    }
    
    public function UpdateLoggedUserDetails() {
        print_r("ffffff");
        exit();
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login');
            }
        }  else {
           redirect('Login');  
          }
          
            if (isset($_POST['userIdText'])) {

            $Id = $_POST['userIdText'];

                $updateUser = array(
                            'userId' => $Id,
                            'userName' => $_POST['uNameText'],
                            
                );
                
            $this->load->model("UserWebServiceHandler");
             $this->UserWebServiceHandler->UpdateUserName($updateUser);
            
              }
              
            redirect('LoggedUser');
        
        }
        
        
        
        
    public function UpdateLoggedUserPassword() {
        
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login');
            }
        }  else {
           redirect('Login');  
          }
          
          print_r($_POST);
          exit();
          
            if (isset($_POST['userId'])) {

            $Id = $_POST['userIdText'];

                $updateUser = array(
                            'userId' => $Id,
                            'userName' => $_POST['uNameText'],
                            
                );
//                $this->load->model('DataAccess');
//                $this->DataAccess->update('admin_user', $updateUser, $Id, "user_id");
                
                
            $this->load->model("UserWebServiceHandler");
             $this->UserWebServiceHandler->UpdateUserName($updateUser);
            
              }
              
            redirect('LoggedUser');
        
        }
        
    
     function GetRolePermissions($user) {
        
        $this->load->model("DataAccess");
        $result = $this->DataAccess->SelectAll("SELECT p.permission_discription FROM `admin_rolepermissions` as rp, `admin_userroles` as r
                                                , `admin_user` as u, `admin_permission` as p
                                                WHERE u.user_id = $user AND r.role_id = u.role_id AND rp.role_id = r.role_id and p.permission_id = rp.permission_id");
        
        $a =0;
        foreach ($result as $key => $value) {
            $permission[$a] = $value->permission_discription;
            $a++;
        }
   
        return $permission;
        
    }
    
     public function getMywards()
        {
            return array("Ward-01","Ward-02");
        }
        
         public function getInternalTransferCount()
        {
             $this->load->model('/inward/transfer/InternalTrasferModel','internaltransfer');
             
             
             $mywards=$this->getMywards();
              $count=0;
             foreach ($mywards as $val) {
                 
            
                    $list=$this->internaltransfer->getInternalTransferByWard($val);
                   
                    foreach ($list as $value)
                        {
                            $count=$count+1;

                        }
                 }
             
            return $count;
        }
}

?>
