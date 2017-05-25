<?php
class Purchase extends model {

    public function getList($offset, $id_company) {
        $sql = $this->db->prepare("
            SELECT
              *
            FROM purchase
            WHERE
              id_company = :id_company
            ORDER BY purchase.date_purchase DESC
            LIMIT $offset, 10");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $array = array();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function getCount($id_company) {
        $sql = $this->db->prepare("SELECT COUNT(*) AS c FROM purchase WHERE id_company = :id_company");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $r = $sql->fetch()['c'];
        return $r;
    }

}