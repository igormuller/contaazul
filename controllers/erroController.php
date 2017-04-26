<?php
class erroController extends controller {
    
    public function __construct() {
        parent::__construct();
        
        $u = new User();
        if (!$u->isLogged()){
            header("Location: ".BASE_URL."/login");
        }
    }
    
    public function index() {
        $dados = array();
        $this->loadTemplate('erro', $dados);
    }
    
}
?>