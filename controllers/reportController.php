<?php
class reportController extends controller {

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

        if ($user->hasPermission("REPORT_VIEW")) {

            $this->loadTemplate("report", $data);
        } else {
            header("Location: ".BASE_URL."/erro/permission");
        }
    }

    public function sales() {
        $data = array();
        $user = new User();
        $user->setLoggedUser();
        $data['user_name'] = $user->getName();
        $company = new Company($user->getCompany());
        $data['company_name'] = $company->getName();
        $data['statuses'] = array(
            '1' => 'Novo',
            '2' => 'Em Aprovação',
            '3' => 'Concluida',
            '4' => 'Cancelada'
        );
        if ($user->hasPermission("REPORT_VIEW")) {

            $this->loadTemplate("reportSales", $data);
        } else {
            header("Location: ".BASE_URL."/erro/permission");
        }
    }

}