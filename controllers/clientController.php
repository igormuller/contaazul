<?php
class clientController extends controller {

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

        if ($user->hasPermission("CLIENT_VIEW")) {
            $c = new Client();
            $offset = 0;
            $data['client_list'] = $c->getList($offset, $user->getCompany());
            $data['permission_edit'] = $user->hasPermission("CLIENT_EDIT");
            $this->loadTemplate("client", $data);
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

        if ($user->hasPermission("CLIENT_EDIT")) {

            $this->loadTemplate("clientAdd", $data);
        } else {
            header("Location: ".BASE_URL."/erro/permission");
        }
    }
}
?>