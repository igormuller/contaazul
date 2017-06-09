<?php
class homeController extends controller {
    
    public function __construct() {
        parent::__construct();
        
        $u = new User();
        if (!$u->isLogged()){
            header("Location: ".BASE_URL."/login");
            exit("<strong> Informo que é necessário <a href='".BASE_URL."/login'>logar</a> no sistema.</strong>");
        }
    }
    
    public function index() {
        $data = array();
        $user = new User();
        $user->setLoggedUser();
        $data['user_name'] = $user->getName();
        $company = new Company($user->getCompany());
        $data['company_name'] = $company->getName();
        $this->loadTemplate('home', $data);
    }
    
}
?>