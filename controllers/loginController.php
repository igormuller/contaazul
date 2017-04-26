<?php
class loginController extends controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $data = array();
        
        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $email = addslashes($_POST['email']);
            $password = addslashes($_POST['password']);
            
            $u = new User();
            
            if ($u->doLogin($email, $password)) {
                header("Location: ".BASE_URL);
            } else {
                $data['info'] = "Login e/ou Senha incorretos!";
            }
        }
        
        $this->loadView('login', $data);
    }
    
    public function logOut() {
        unset($_SESSION['ccUser']);
        
        header("Location: ".BASE_URL);
    }
    
}
?>