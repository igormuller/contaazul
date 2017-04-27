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
            $data['permission_list'] = $permission->getList($user->getCompany());
            $this->loadTemplate('permission', $data);
        } else {
            header("Location: ".BASE_URL."/erro/permission");
        }
        
    }
    
}
