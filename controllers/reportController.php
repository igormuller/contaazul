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

    public function sales_pdf() {
        $data = array();
        $user = new User();
        $user->setLoggedUser();
        $data['statuses'] = array(
            '1' => 'Novo',
            '2' => 'Em Aprovação',
            '3' => 'Concluida',
            '4' => 'Cancelada'
        );

        if ($user->hasPermission("REPORT_VIEW")) {
            $client_name = addslashes($_GET['client_name']);
            $period1 = str_replace("/","-", addslashes($_GET['period1'])."00:00:00");
            $period1 = date("Y-m-d H:i:s", strtotime($period1));
            $period2 = str_replace("/","-", addslashes($_GET['period2'])."23:59:59");
            $period2 = date("Y-m-d H:i:s", strtotime($period2));

            $status = addslashes($_GET['status']);
            $order = addslashes($_GET['order']);

            $s = new Sale();
            $data['sale_list'] = $s->getSaleFiltered($client_name, $period1, $period2, $status, $order, $user->getCompany());
            $data['filters'] = $_GET;
            $this->loadView("sales_pdf", $data);
        } else {
            header("Location: ".BASE_URL."/erro/permission");
        }
    }

}