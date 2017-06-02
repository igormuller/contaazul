<?php
class purchaseController extends controller
{

    public function __construct()
    {
        parent::__construct();

        $u = new User();
        if (!$u->isLogged()) {
            header("Location: " . BASE_URL . "/login");
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

        if ($user->hasPermission("PURCHASES_VIEW")) {
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

        if ($user->hasPermission("PURCHASES_EDIT")) {
            $purchases = new Purchase();

            if (isset($_POST['product']) && !empty($_POST['product'])) {
                print_r($_POST['price']);print_r($_POST['product']);exit;
            }



            $this->loadTemplate("purchaseAdd", $data);
        } else {
            header("Location: " . BASE_URL . "/erro/permission");
        }
    }

}