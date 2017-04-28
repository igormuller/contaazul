<?php
class permissionController extends controller {
    
    public function __construct() {
        parent::__construct();
        
        $u = new User();
        if (!$u->isLogged()){
            header("Location: ".BASE_URL."/login");
        }
    }
    
    public function index() {
        $data = array();
        $user = new User();
        $user->setLoggedUser();
        $data['user_name'] = $user->getName();
        $company = new Company($user->getCompany());
        $data['company_name'] = $company->getName();
        
        if ($user->hasPermission("PERMISSION_VIEW")) {
            $permission = new Permission();
            
            //Se informado nova permissão
            if (isset($_POST['permission_add']) && !empty($_POST['permission_add'])) {
                $pname = addslashes($_POST['permission_add']);
                $permission->addPermission($pname, $user->getCompany());
            }
            //Se informado novo Grupo de permissões
            if (isset($_POST['permission_group_add']) && !empty($_POST['permission_group_add'])) {
                $pgname = addslashes($_POST['permission_group_add']);
                $plist = $_POST['permissions'];
                $permission->addPermissionGroup($pgname, $plist, $user->getCompany());
            }
            
            
            $data['permission_list'] = $permission->getPermissionList($user->getCompany());
            $data['permission_group_list'] = $permission->getGroupList($user->getCompany());
            $this->loadTemplate('permission', $data);
        } else {
            header("Location: ".BASE_URL."/erro/permission");
        }        
    }
    
    public function deletePermission($id_permission_param) {
        $permission = new Permission();
        $permission->deletePermission($id_permission_param);
        header("Location: ".BASE_URL."/permission");
    }
    
    public function deletePermissionGroup($id_permission_group) {
        $permission = new Permission();
        $permission->deletePermissionGroup($id_permission_group);
        header("Location: ".BASE_URL."/permission");
    }
    
    public function editPermissionGroup($id_permission_group) {
        $data = array();
        $user = new User();
        $user->setLoggedUser();
        $data['user_name'] = $user->getName();
        $company = new Company($user->getCompany());
        $data['company_name'] = $company->getName();
        
        if ($user->hasPermission("PERMISSION_VIEW")) {
            $permission = new Permission();
            
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $pgname = addslashes($_POST['name']);
                $plist = $_POST['permissions'];
                $permission->editPermissionGroup($pgname, $plist, $user->getCompany(), $id_permission_group);
                header("Location: ".BASE_URL."/permission");
            }
            
            $data['permission_list'] = $permission->getPermissionList($user->getCompany());
            $data['group_info'] = $permission->getGroup($id_permission_group, $user->getCompany());
            $this->loadTemplate("permissionGroupEdit", $data);
        } else {
            header("Location: ".BASE_URL."/erro/permission");
        }   
    }
    
    public function addPermissionGroup() {
        $data = array();
        $user = new User();
        $user->setLoggedUser();
        $data['user_name'] = $user->getName();
        $company = new Company($user->getCompany());
        $data['company_name'] = $company->getName();
        
        if ($user->hasPermission("PERMISSION_VIEW")) {
            $permission = new Permission();
            
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $pgname = addslashes($_POST['name']);
                $plist = $_POST['permissions'];
                $permission->addPermissionGroup($pgname, $plist, $user->getCompany());
                header("Location: ".BASE_URL."/permission");
            }
            
            $data['permission_list'] = $permission->getPermissionList($user->getCompany());
            $this->loadTemplate("permissionGroupAdd", $data);
        } else {
            header("Location: ".BASE_URL."/erro/permission");
        }
    }
    
}
