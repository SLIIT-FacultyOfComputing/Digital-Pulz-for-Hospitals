<?php

session_start();

class RolePermission extends CI_Controller {

    public function index() {


        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login');
            }
        } else {
            redirect('Login');
        }

        $this->LoadViewPermission();
    }

    public function LoadViewPermission($userId, $roleId) {

        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login');
            }
        } else {
            redirect('Login');
        }


        $this->load->model("DataAccess");
        $this->load->model("PermissionRequestWebServiceHandler");
        $this->load->model("UserWebServiceHandler");
                        
        $data['title'] = "Permission Request Home";
        $data['results'] = $this->UserWebServiceHandler->GetUserRolePermissions($userId,$roleId);
                
        foreach ($data['results'] as $key => $value) {
         $data['results'] =($value->adminUserroles->adminPermissions);
        }
        
        $user = $_SESSION['user'];
        $data['approvedResults'] = $this->PermissionRequestWebServiceHandler->GetApprovedPermissionRequest($user);
        
        $this->load->view("User/Permission/root_for_2para_route", $data);
    }

    public function SaveRolePermission() {


        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == -1) {
                redirect('Login');
            }
        } else {
            redirect('Login');
        }

        if ($_POST) {
            $c = 0;
            $r = 0;
            $p = 0;
            $Role;
            $myPostData = json_decode($_POST['cat']);
            foreach ($myPostData as $key => $value) {
                foreach ($value as $key1 => $value1) {

                    if (++$c % 2 == 0) {
                        $Role[$r] = $value1;
                        $r++;
                    } else {
                        $Per[$p] = ($value1);
                        $p++;
                    }
                }
            }
        } else {
            print_r("No Data");
            exit();
        }
        for ($w = 0; $w < count($Role); $w++) {
            $this->DeleteRolePermission($Role[$w]);
        }
        $mat[1] = 'FALSE';
        for ($i = 0; $i < count($Role); $i++) {


            $rolePermission = array(
                "role_id" => $Role[$i],
                "permission_id" => $Per[$i],
                    // "AssignedBy" => 1,
            );

            $this->load->model("DataAccess");
            $this->DataAccess->Insert("admin_rolepermissions", $rolePermission);
            $mat[1] = 'TRUE';
        }

        $_SESSION['permission'] = $this->GetRolePermissions($_SESSION['user']);
        
        echo json_encode($mat);
    }

    public function DeleteRolePermission($role) {
        $this->load->model("DataAccess");
        $this->DataAccess->DeleteByQuary("delete From admin_rolepermissions where role_id = " . $role);
    }

    public function GetAllRolePermission($id) {
        
        $this->load->model("RoleWebServiceHandler");
         $result = $this->RoleWebServiceHandler->GetRole($id);
          
         
         $a= 0;
          foreach ($result as $key => $value) {
              
            $rolePermission[$a] = array('roleId' => $value->roleId , 'permissionId' => $value->adminPermissions   );
                $a++;
            }
        
        $r = 0;
        foreach ($rolePermission as $key => $value) {
            foreach ($value['permissionId'] as $key1 => $va) {
                    $role[$r] = array('roleId' => $value['roleId'] , 'permissionId' => $va->permissionId   );
                    $r++;
            }
            
        }
       
       
        
        echo json_encode($role);
    }
    
    
     public function GetActiveRolePermission() {
        
        $this->load->model("RoleWebServiceHandler");
         $result = $this->RoleWebServiceHandler->GetAllRoles();
          
         
         $a= 0;
          foreach ($result as $key => $value) {
              
            $rolePermission[$a] = array('roleId' => $value->roleId , 'permissionId' => $value->adminPermissions   );
                $a++;
            }
        
        $r = 0;
        foreach ($rolePermission as $key => $value) {
            foreach ($value['permissionId'] as $key1 => $va) {
                    $role[$r] = array('roleId' => $value['roleId'] , 'permissionId' => $va->permissionId   );
                    $r++;
            }
            
        }
       
       
        
        echo json_encode($role);
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
    
}

?>
