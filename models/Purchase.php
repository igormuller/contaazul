<?php
class Purchase extends model {

    public function getList($offset, $id_company) {
        $sql = $this->db->prepare("
            SELECT
              purchase.id_purchase,
              purchase.date_purchase,
              purchase.total_price,
              user.name 
            FROM purchase 
            LEFT JOIN user ON user.id_user = purchase.id_user 
            WHERE 
              purchase.id_company = :id_company 
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

    public function add($id_company, $id_user, $products) {
        $sql = $this->db->prepare("INSERT INTO purchase SET id_company = :id_company, id_user = :id_user, date_purchase = NOW(), total_price = :total_price");
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":id_user", $id_user);
        $sql->bindValue(":total_price", 0);
        $sql->execute();

        $id_purchase = $this->db->lastInsertId();
        $total_price = 0;

        $i = new Inventory();
        foreach ($products as $id => $product) {
            $this->add_product($id_company,$id_purchase,$id,$product['qtd'], $product['price']);
            $i->purchase($id, $id_company, $product['price'], $product['qtd'], $id_user);
            $total_price += $product['price'] * $product['qtd'];
        }

        $sql = $this->db->prepare("UPDATE purchase SET total_price = :total_price WHERE id_purchase = :id_purchase AND id_company = :id_company");
        $sql->bindValue(":total_price", $total_price);
        $sql->bindValue("id_purchase", $id_purchase);
        $sql->bindValue("id_company", $id_company);
        $sql->execute();
    }

    public function add_product($id_company, $id_purchase, $id_product, $qtd, $purchase_price) {
        $sql = $this->db->prepare("INSERT INTO purchase_product SET id_company = :id_company, id_purchase = :id_purchase, id_inventory = :id_inventory, qtd = :qtd, purchase_price = :purchase_price");
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":id_purchase", $id_purchase);
        $sql->bindValue(":id_inventory", $id_product);
        $sql->bindValue(":qtd", $qtd);
        $sql->bindValue(":purchase_price", $purchase_price);
        $sql->execute();
    }

    public function getCompany($id_purchase) {
        $sql = $this->db->prepare("SELECT id_company FROM purchase WHERE id_purchase = :id_purchase");
        $sql->bindValue(":id_purchase", $id_purchase);
        $sql->execute();

        $id_company = '';
        if ($sql->rowCount() > 0) {
            $id_company = $sql->fetch()['id_company'];
        }
        return $id_company;
    }

    public function getPurchase($id_purchase, $id_company) {
        $sql = $this->db->prepare("SELECT * FROM purchase WHERE id_purchase = :id_purchase AND id_company = :id_company");
        $sql->bindValue(":id_purchase", $id_purchase);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $array = array();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
            $array['products'] = array();
            $sql = $this->db->prepare("
                      SELECT
                        pp.id_inventory,
                        inventory.name,
                        pp.qtd,
                        pp.purchase_price,
                        (pp.qtd * pp.purchase_price) AS subtotal
                      FROM purchase_product pp
                      LEFT JOIN inventory ON inventory.id_inventory = pp.id_inventory
                      WHERE pp.id_purchase = :id_purchase AND pp.id_company = :id_company");
            $sql->bindValue(":id_purchase", $id_purchase);
            $sql->bindValue(":id_company", $id_company);
            $sql->execute();

            if ($sql->rowCount() > 0){
                $array['products'] = $sql->fetchAll();
            }
        }
        return $array;
    }

}