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
            $c = new Client();
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $name = addslashes($_POST['name']);
                $email = addslashes($_POST['email']);
                $phone = addslashes($_POST['phone']);
                $address_zipcode = addslashes($_POST['address_zipcode']);
                $address = addslashes($_POST['address']);
                $address_number = addslashes($_POST['address_number']);
                $address_comp = addslashes($_POST['address_comp']);
                $address_neigh = addslashes($_POST['address_neigh']);
                $address_city = addslashes($_POST['address_city']);
                $address_state = addslashes($_POST['address_state']);
                $address_country = addslashes($_POST['address_country']);
                $stars = addslashes($_POST['stars']);
                $internal_obs = addslashes($_POST['internal_obs']);
                $c->add($user->getCompany(),$name,$email,$phone,$address_zipcode,$address,$address_number,$address_comp,$address_neigh,$address_city,$address_state,$address_country,$stars,$internal_obs);
                header("Location: ".BASE_URL."/client");

            }
            $this->loadTemplate("clientAdd", $data);
        } else {
            header("Location: ".BASE_URL."/erro/permission");
        }
    }
}
?>