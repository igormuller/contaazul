<?php
class inventoryController extends controller {

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

        if ($user->hasPermission("INVENTORY_VIEW")) {
            $i = new Inventory();

            $offset = 0;
            $data['inventory_list'] = $i->getList($offset, $user->getCompany());
            
            $data['permission_edit'] = $user->hasPermission("INVENTORY_EDIT");
            $data['permission_add'] = $user->hasPermission("INVENTORY_ADD");
            $this->loadTemplate("inventory", $data);
        } else {
            header("Location: ".BASE_URL."/erro/permission");
        }
    }

    public function add() {
        $data = array();
        $user = new User();
        $user->setLoggedUser();
        $data['user_name'] = $user->getName();
        $company = new Company($user->getCompany());
        $data['company_name'] = $company->getName();

        if ($user->hasPermission("INVENTORY_ADD")) {
            $i = new Inventory();

            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $name = addslashes($_POST['name']);
                $price = str_replace(',', '.', $_POST['price']);
                $qtd = $_POST['qtd'];
                $qtd_min = $_POST['qtd_min'];

                $i->add($user->getCompany(), $name, $price, $qtd, $qtd_min, $user->getId());
                header("Location: ".BASE_URL."/inventory");
            }
            
            $this->loadTemplate("inventoryAdd", $data);
        } else {
            header("Location: ".BASE_URL."/erro/permission");
        }
    }

}