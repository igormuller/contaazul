<?php
class erroController extends controller {
    
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
        $this->loadTemplate('erro', $data);
    }
    
    public function permission() {
        $data = array();
        $user = new User();
        $user->setLoggedUser();
        $data['user_name'] = $user->getName();
        $company = new Company($user->getCompany());
        $data['company_name'] = $company->getName();
        $this->loadTemplate('erroPermission', $data);
    }
    
}
?>