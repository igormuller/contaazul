<?php

class Permission extends model {
    
    private $group;
    private $permission;

    public function setGroup($id, $id_company) {
        $this->group = $id;
        $this->permission = array();
        
        $sql = $this->db->prepare("SELECT params FROM permission_group WHERE id_permission_group = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        
        if ($sql->rowCount() > 0) {
            $row = $sql->fetch();
            
            $params = $row['params'];
            
            $sql = $this->db->prepare("SELECT name FROM permission_param WHERE id_permission_param IN ($params) AND id_company = :id_company");
            $sql->bindValue(":id_company", $id_company);
            $sql->execute();
            
            if ($sql->rowCount() > 0) {
                foreach ($sql->fetchAll() as $item) {
                    $this->permission[] = $item['name'];
                }
            }
        }
    }
    
    public function getList($id_company) {
        $sql = $this->db->prepare("SELECT * FROM permission_param WHERE id_company = :id_company");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        
        $array = array();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function hasPermission($name) {
        if (in_array($name, $this->permission)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}