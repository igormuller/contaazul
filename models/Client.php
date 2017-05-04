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

    public function add($id_company,$name,$email,$phone,$address_zipcode,$address,$address_number,$address_comp,$address_neigh,$address_city,$address_state,$address_country,$stars,$internal_obs) {
        $sql = $this->db->prepare("INSERT INTO client SET name = :name, email = :email, phone = :phone, address_zipcode = :address_zipcode, address = :address, address_number = :address_number, address_comp = :address_comp, address_neigh = :address_neigh, address_city = :address_city, address_state = :address_state, address_country = :address_country, stars = :stars, internal_obs = :internal_obs, id_company = :id_company");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":phone", $phone);
        $sql->bindValue(":address_zipcode", $address_zipcode);
        $sql->bindValue(":address", $address);
        $sql->bindValue(":address_number", $address_number);
        $sql->bindValue(":address_comp", $address_comp);
        $sql->bindValue(":address_neigh", $address_neigh);
        $sql->bindValue(":address_city", $address_city);
        $sql->bindValue(":address_state", $address_state);
        $sql->bindValue(":address_country", $address_country);
        $sql->bindValue(":stars", $stars);
        $sql->bindValue(":internal_obs", $internal_obs);
        $sql->bindValue(":id_company", $id_company);
        echo $sql->execute();

    }


}