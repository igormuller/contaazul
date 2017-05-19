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

    		$temp = $c->searchByName($s,$user->getCompany());

    		foreach ($temp as $titem) {
    			$data[] = array(
    				'name' => $titem['name'],
    				'link' => BASE_URL.'/client/edit/'.$titem['id_client'],
                    'id' => $titem['id_client']
    			);
    		}
    		
    	}
    	echo json_encode($data);
    }

    public function search_inventory() {
        $data = array();
        $user = new User();
        $user->setLoggedUser();
        $i = new Inventory();

        if (isset($_GET['s']) && !empty($_GET['s'])) {
            $s = addslashes($_GET['s']);

            $temp = $i->searchByName($s,$user->getCompany());

            foreach ($temp as $titem) {
                $data[] = array(
                    'name' => $titem['name'],
                    'link' => BASE_URL.'/inventory/edit/'.$titem['id_inventory'],
                    'id'   => $titem['id_inventory'],
                    'price' => $titem['price']
                );
            }            
        }

        echo json_encode($data);
    }

    public function add_client() {
        $data = array();
        $user = new User();
        $user->setLoggedUser();
        $c = new Client();

        if (isset($_POST['name']) && !empty($_POST['name'])) {
            $name = addslashes($_POST['name']);

            $data['id'] = $c->add($user->getCompany(), $name);

        }
        echo json_encode($data);
    }

}
?>