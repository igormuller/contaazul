<?php

class Sale extends model {

    public function getList($offset, $id_company) {
        $sql = $this->db->prepare("
            SELECT
              sale.id_sale,
              sale.date_sale,
              sale.total_price,
              sale.status,
              client.name
            FROM sale
            LEFT JOIN client ON client.id_client = sale.id_client
            WHERE
              id_company = :id_company
            ORDER BY sale.date_sale DESC
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
        $sql = $this->db->prepare("SELECT COUNT(*) AS c FROM sale WHERE id_company = :id_company");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $r = $sql->fetch()['c'];
        return $r;

    }
}