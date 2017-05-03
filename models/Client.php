<?php

class Client extends model {

    public function getList($offset, $id_company) {
        $sql = $this->db->prepare("SELECT * FROM client WHERE id_company = :id_company LIMIT $offset, 10");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $array = array();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;

    }

}