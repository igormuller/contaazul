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
		$this->setLog($id_company, $id_product, $id_user, 'add');

		return $id_product;
	}

	public function edit($id_inventory, $id_company, $name, $price, $qtd, $qtd_min, $id_user) {
		$sql = $this->db->prepare("UPDATE inventory SET name = :name, price = :price, qtd = :qtd, qtd_min = :qtd_min WHERE id_inventory = :id_inventory AND id_company = :id_company");
		$sql->bindValue(":id_inventory", $id_inventory);
		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":name", $name);
		$sql->bindValue(":price", $price);
		$sql->bindValue(":qtd", $qtd);
		$sql->bindValue(":qtd_min", $qtd_min);
		$sql->execute();

		$this->setLog($id_company, $id_inventory, $id_user, 'edt');
	}

	public function delete($id_inventory, $id_company, $id_user) {
		$sql = $this->db->prepare("DELETE FROM inventory WHERE id_inventory = :id_inventory AND id_company = :id_company");
		$sql->bindValue(":id_inventory", $id_inventory);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		$this->setLog($id_company, $id_inventory, $id_user, 'del');
	}

	public function setLog($id_company, $id_product, $id_user, $action) {
		$sql = $this->db->prepare("INSERT INTO inventory_history SET id_company = :id_company, id_product = :id_product, id_user = :id_user, action = :action, date_action = NOW()");
		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":id_product", $id_product);
		$sql->bindValue(":id_user", $id_user);
		$sql->bindValue(":action", $action);
		$sql->execute();
	}

	public function getCount($id_company) {
        $sql = $this->db->prepare("SELECT COUNT(*) AS c FROM inventory WHERE id_company = :id_company");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $row = $sql->fetch();
        $r = $row['c'];
        return $r;
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

	public function searchByName($name, $id_company) {
		$sql = $this->db->prepare("SELECT * FROM inventory WHERE name LIKE :name AND id_company = :id_company LIMIT 15");
		$sql->bindValue(":name", '%'.$name.'%');
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		$array = array();
		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		return $array;
	}

	public function getCompany($id_inventory) {
		$sql = $this->db->prepare("SELECT id_company FROM inventory WHERE id_inventory = :id_inventory");
		$sql->bindValue(":id_inventory", $id_inventory);
		$sql->execute();

		$id_company = array();
		if ($sql->rowCount() > 0) {
			$id_company = $sql->fetch()['id_company'];
		}
		return $id_company;
	}

	public function decrease($id_product, $id_company, $qtd, $id_user) {
		$sql = $this->db->prepare("UPDATE inventory SET qtd = qtd - $qtd WHERE id_inventory = :id_inventory AND id_company = :id_company");
		$sql->bindValue(":id_inventory", $id_product);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		$this->setLog($id_company, $id_product, $id_user, 'dec');
	}
}