<?php
class ajaxController extends controller {

    public function __construct() {
        parent::__construct();

        $u = new User();
        if (!$u->isLogged()) {
            header("Location: " . BASE_URL . "/login");
        }
    }

    public function index() {
    	echo "index";
    }

    public function search_client() {
    	$data = array();
        $user = new User();
        $user->setLoggedUser();
        $c = new Client();

    	if (isset($_GET['s']) && !empty($_GET['s'])) {
    		$s = addslashes($_GET['s']);

    		$clients = $c->searchClientByName($s,$user->getCompany());

    		foreach ($clients as $citem) {
    			$data[] = array(
    				'name' => $citem['name'],
    				'link' => BASE_URL.'/client/edit/'.$citem['id_client']
    			);
    		}
    		
    	}
    	echo json_encode($data);
    }
}
?>