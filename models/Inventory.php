<?php

class Inventory extends model {

	public function getList($offset, $id_company) {
		$sql = $this->db->prepare("SELECT * FROM inventory WHERE id_company = :id_company LIMIT $offset, 10");
		$sql->bindValue(":id_company",$id_company);
		$sql->execute();

		$array = array();
		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		return $array;
	}

	public function add($id_company, $name, $price, $qtd, $qtd_min, $id_user) {
		$sql = $this->db->prepare("INSERT INTO inventory SET id_company = :id_company, name = :name, price = :price, qtd = :qtd, qtd_min = :qtd_min");
		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":name", $name);
		$sql->bindValue(":price", $price);
		$sql->bindValue(":qtd", $qtd);
		$sql->bindValue(":qtd_min", $qtd_min);
		$sql->execute();

		$id_product = $this->db->lastInsertId();
		$sql = $this->db->prepare("INSERT INTO inventory_history SET id_company = :id_company, id_product = :id_product, id_user = :id_user, action = :action, date_action = NOW()");
		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":id_product", $id_product);
		$sql->bindValue(":id_user", $id_user);
		$sql->bindValue(":action", "add");
		$sql->execute();
	}

	public function getInventoryById($id_inventory) {
		$sql = $this->db->prepare("SELECT * FROM inventory WHERE id_inventory = :id_inventory");
		$sql->bindValue(":id_inventory", $id_inventory);
		$sql->execute();

		$array = array();
		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}
		return $array;
	}

	public function getCompany($id_inventory) {
		$sql = $this->db->prepare("SELECT id_company FROM inventory WHERE id_inventory = :id_inventory");
		$sql->bindValue(":id_inventory", $id_inventory);
		$sql->execute();

		$aid_company = array();
		if ($sql->rowCount() > 0) {
			$id_company = $sql->fetch()['id_company'];
		}
		return $id_company;
	}
}