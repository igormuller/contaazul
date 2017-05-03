<?php
class userController extends controller {
    
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
        
        if ($user->hasPermission("USER_VIEW")) {
            $data['user_list'] = $user->getList($user->getCompany());
            $this->loadTemplate("user", $data);
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
        $data['error_info'] = '';
        
        if ($user->hasPermission("USER_VIEW")) {
            $permission = new Permission();
            
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                if (!$user->findUserByEmail($_POST['email'])) {
                    $name = addslashes($_POST['name']);
                    $email = addslashes($_POST['email']);
                    $password = $_POST['password'];
                    $id_group = $_POST['id_group'];
                    $user->add($name, $email, $password, $id_group, $user->getCompany());
                    header("Location: ".BASE_URL."/user");
                } else {
                    $data['error_info'] = "E-mail já cadastrado";
                }
                
            }
            
            $data['group_list'] = $permission->getGroupList($user->getCompany());
            $this->loadTemplate("userAdd", $data);
        } else {
            header("Location: ".BASE_URL."/erro/permission");
        }
    }
    
    public function edit($id_user) {
        $data = array();
        $user = new User();
        $user->setLoggedUser();
        $data['user_name'] = $user->getName();
        $company = new Company($user->getCompany());
        $data['company_name'] = $company->getName();
        
        if ($user->hasPermission("USER_VIEW")) {
            $permission = new Permission();
            
            if ($user->getCompany() === $user->getCompany($id_user)) {
                if (isset($_POST['name']) && !empty($_POST['name'])) {
                    $name = addslashes($_POST['name']);
                    $password = $_POST['password'];
                    $id_group = $_POST['id_group'];
                    $user->edit($name, $password, $id_group, $id_user, $user->getCompany());
                    $data['error_info'] = 'Usuário editado com sucesso!';
                }
                $data['user_edit'] = $user->getUser($id_user);
                $data['group_list'] = $permission->getGroupList($user->getCompany());
                $this->loadTemplate("userEdit", $data);
            } else {
                header("Location: ".BASE_URL."/erro/permission");
            }            
        } else {
            header("Location: ".BASE_URL."/erro/permission");
        }
    }
    
    public function delete($id_user) {
        $data = array();
        $user = new User();
        $user->setLoggedUser();
        $data['user_name'] = $user->getName();
        $company = new Company($user->getCompany());
        $data['company_name'] = $company->getName();
        
        if ($user->hasPermission("USER_VIEW")) {
            $permission = new Permission();
            
            if ($user->getCompany() === $user->getCompany($id_user)) {
                $user->delete($id_user, $user->getCompany());
                header("Location: ".BASE_URL."/user");
            } else {
                header("Location: ".BASE_URL."/erro/permission");
            }            
        } else {
            header("Location: ".BASE_URL."/erro/permission");
        }
    }
}

?>