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

        $last_day = date('t', mktime(0,0,0,date('m'),'01',date('Y')));

        $sale = new Sale();
        $purchase = new Purchase();

        $data['days_list'] = array();
        $data['sale_price'] = array();
        $data['purchase_price'] = array();
        for ($q = 1; $q <= $last_day; $q++) {
            $data['days_list'][] = $q."/".date('m');
            $date = date('Y').'-'.date('m').'-'.$q;
            $data['sale_price'][] = $sale->getPriceInDate($date, $user->getCompany());
            $data['purchase_price'][] = $purchase->getPriceInDate($date, $user->getCompany());
        }

        $this->loadTemplate('home', $data);
    }
}
?>