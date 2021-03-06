<?php
class purchaseController extends controller
{

    public function __construct()
    {
        parent::__construct();

        $u = new User();
        if (!$u->isLogged()) {
            header("Location: " . BASE_URL . "/login");
            exit("<strong> Informo que é necessário <a href='".BASE_URL."/login'>logar</a> no sistema.</strong>");
        }
    }

    public function index()
    {
        $data = array();
        $user = new User();
        $user->setLoggedUser();
        $data['user_name'] = $user->getName();
        $company = new Company($user->getCompany());
        $data['company_name'] = $company->getName();

        if ($user->hasPermission("PURCHASE_VIEW")) {
            $purchases = new Purchase();

            //Código paginação
            $data['p'] = 1;
            if (isset($_GET['p']) && !empty($_GET['p'])) {
                $data['p'] = intval($_GET['p']);
                if ($data['p'] == 0) {
                    $data['p'] = 1;
                }
            }
            $offset = (10 * ($data['p'] - 1));
            $data['purchases_count'] = $purchases->getCount($user->getCompany());
            $data['p_count'] = ceil($data['purchases_count'] / 10);
            //Fim Paginação

            $data['purchases_list'] = $purchases->getList($offset, $user->getCompany());
            $data['permission_edit'] = $user->hasPermission("PURCHASES_EDIT");

            $this->loadTemplate("purchase", $data);
        } else {
            header("Location: " . BASE_URL . "/erro/permission");
        }
    }

    public function add()
    {
        $data = array();
        $user = new User();
        $user->setLoggedUser();
        $data['user_name'] = $user->getName();
        $company = new Company($user->getCompany());
        $data['company_name'] = $company->getName();

        if ($user->hasPermission("PURCHASE_EDIT")) {
            $purchase = new Purchase();

            if (isset($_POST['product']) && !empty($_POST['product'])) {
                $products = $_POST['product'];
                $purchase->add($user->getCompany(),$user->getId(),$products);

                header("Location: ".BASE_URL."/purchase");
            }

            $this->loadTemplate("purchaseAdd", $data);
        } else {
            header("Location: " . BASE_URL . "/erro/permission");
        }
    }

    public function view($id_purchase) {
        $data = array();
        $user = new User();
        $user->setLoggedUser();
        $data['user_name'] = $user->getName();
        $company = new Company($user->getCompany());
        $data['company_name'] = $company->getName();

        if ($user->hasPermission("PURCHASE_VIEW")) {
            $purchase = new Purchase();

            if ($user->getCompany() === $purchase->getCompany($id_purchase)) {
                $data['purchase'] = $purchase->getPurchase($id_purchase, $user->getCompany());
                $this->loadTemplate("purchaseView", $data);
            } else {
                header("Location: " . BASE_URL . "/erro/permission");
            }
        } else {
            header("Location: " . BASE_URL . "/erro/permission");
        }
    }

}