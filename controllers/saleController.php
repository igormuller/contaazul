<?php
class saleController extends controller
{

    public function __construct() {
        parent::__construct();

        $u = new User();
        if (!$u->isLogged()) {
            header("Location: " . BASE_URL . "/login");
        }
    }

    public function index() {
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
            '4' => 'Cancelada');

        if ($user->hasPermission("SALE_VIEW")) {
            $sale = new Sale();

            //Código paginação
            $data['p'] = 1;
            if (isset($_GET['p']) && !empty($_GET['p'])) {
                $data['p'] = intval($_GET['p']);
                if ($data['p'] == 0) {
                    $data['p'] = 1;
                }
            }
            $offset = (10 * ($data['p'] - 1));
            $data['sale_count'] = $sale->getCount($user->getCompany());
            $data['p_count'] = ceil($data['sale_count'] / 10);
            //Fim Paginação

            $data['sale_list'] = $sale->getList($offset, $user->getCompany());
            $data['permission_edit'] = $user->hasPermission("SALE_EDIT");
            $this->loadTemplate("sale", $data);
        } else {
            header("Location: " . BASE_URL . "/erro/permission");
        }
    }

    public function add() {
        $data = array();
        $user = new User();
        $user->setLoggedUser();
        $data['user_name'] = $user->getName();
        $company = new Company($user->getCompany());
        $data['company_name'] = $company->getName();

        if ($user->hasPermission("SALE_VIEW")) {
            $sale = new Sale();

            if (isset($_POST['client_id']) && !empty($_POST['client_id'])) {
                $client_id = addslashes($_POST['client_id']);
                $status = addslashes($_POST['status']);
                //$date_sale = str_replace("/","-",$_POST['date_sale']);
                //$date_sale = date("Y-m-d",strtotime($date_sale));
                $products = $_POST['product'];

                $sale->add($user->getCompany(), $user->getId(), $client_id, $status, $products);
                header("Location: ".BASE_URL."/sale");
            }

            $this->loadTemplate("saleAdd", $data);
        } else {
            header("Location: " . BASE_URL . "/erro/permission");
        }
    }

    public function edit($id_sale) {
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
            '4' => 'Cancelada');
        
        if ($user->hasPermission("SALE_VIEW")) {
            $sale = new Sale();

            if (isset($_POST['client_id']) && !empty($_POST['client_id'])) {
                $client_id = addslashes($_POST['client_id']);
                $status = addslashes($_POST['status']);
                //$date_sale = str_replace("/","-",$_POST['date_sale']);
                //$date_sale = date("Y-m-d",strtotime($date_sale));
                $products = $_POST['product'];

                $sale->add($user->getCompany(), $user->getId(), $client_id, $status, $products);
                header("Location: ".BASE_URL."/sale");
            }


            $data['permission_edit'] = $user->hasPermission("SALE_EDIT");
            $data['sale_info'] = $sale->getSaleById($id_sale, $user->getCompany());
            
            $this->loadTemplate("saleEdit", $data);
        } else {
            header("Location: " . BASE_URL . "/erro/permission");
        }
    }
}