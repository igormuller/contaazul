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
              sale.id_company = :id_company
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

    public function add($id_company, $id_user, $id_client, $status, $products) {
        $i = new Inventory();

        $sql = $this->db->prepare("INSERT INTO sale SET id_company = :id_company, id_client = :id_client, id_user = :id_user, date_sale = NOW(), status = :status, total_price = :total_price");
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":id_client", $id_client);
        $sql->bindValue(":id_user", $id_user);
        $sql->bindValue(":status", $status);
        $sql->bindValue(":total_price", 0);
        $sql->execute();

        $id_sale = $this->db->lastInsertId();

        $total_price = 0;
        foreach ($products as $id_product => $qtd) {
            $sql = $this->db->prepare("SELECT price FROM inventory WHERE id_inventory = :id_inventory AND id_company = :id_company");
            $sql->bindValue(":id_inventory", $id_product);
            $sql->bindValue(":id_company", $id_company);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $row = $sql->fetch();
                $price = $row['price'];

                $sql_prod = $this->db->prepare("INSERT INTO sale_product SET id_company = :id_company, id_sale = :id_sale, id_product = :id_product, qtd = :qtd, sale_price = :sale_price");
                $sql_prod->bindValue(":id_company", $id_company);
                $sql_prod->bindValue(":id_sale", $id_sale);
                $sql_prod->bindValue(":id_product", $id_product);
                $sql_prod->bindValue(":qtd", $qtd);
                $sql_prod->bindValue(":sale_price", $price);
                $sql_prod->execute();

                $i->decrease($id_product, $id_company, $qtd, $id_user);

                $total_price += $price * $qtd;
            }
        }
        
        $sql = $this->db->prepare("UPDATE sale SET total_price= :total_price WHERE id_sale = :id_sale AND id_company = :id_company");
        $sql->bindValue(":total_price", $total_price);
        $sql->bindValue(":id_sale", $id_sale);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

    }

    public function getSaleById($id_sale, $id_company) {
        $sql = $this->db->prepare("
            SELECT
                *,
                (select client.name from client where client.id_client = sale.id_client) as client_name
            FROM sale
            WHERE
                id_sale = :id_sale AND
                id_company = :id_company");
        $sql->bindValue("id_company", $id_company);
        $sql->bindValue("id_sale", $id_sale);
        $sql->execute();

        $array = array();
        if ($sql->rowCount() > 0) {
            $array['info'] = $sql->fetch();
        }

        $sql = $this->db->prepare("
            SELECT
                sale_product.qtd,
                sale_product.sale_price,
                inventory.name,
                inventory.id_inventory
            FROM sale_product
            LEFT JOIN inventory ON
                inventory.id_inventory = sale_product.id_product
            WHERE
                sale_product.id_sale = :id_sale AND
                sale_product.id_company = :id_company");
        $sql->bindValue(":id_sale", $id_sale);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array['products'] = $sql->fetchAll();
        }

        return $array;
    }
}