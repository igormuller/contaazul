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
    
    public function hasPermission($name) {
        if (in_array($name, $this->permission)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    /*
     * Function of Permissions
     */
    public function addPermission($name, $id_company) {
        $sql = $this->db->prepare("INSERT INTO permission_param SET name = :name, id_company = :id_company");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
    }

    public function editPermission($name, $id_permission_param, $id_company) {
        $sql = $this->db->prepare("UPDATE permission_param SET name = :name WHERE id_permission_param = :id_permission_param AND id_company = :id_company");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":id_permission_param", $id_permission_param);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
    }
    
    public function deletePermission($id_permission_param) {
        $sql = $this->db->prepare("DELETE FROM permission_param WHERE id_permission_param = :id_permission_param");
        $sql->bindValue(":id_permission_param", $id_permission_param);
        $sql->execute();        
    }
    
    public function getPermissionList($id_company) {
        $sql = $this->db->prepare("SELECT * FROM permission_param WHERE id_company = :id_company");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        
        $array = array();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    /*
     * Funtions of Permissions Group
     */
    public function getGroupList($id_company) {
        $sql = $this->db->prepare("SELECT * FROM permission_group WHERE id_company = :id_company");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        
        $array = array();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function getGroup($id_permission_group, $id_company) {
        $sql = $this->db->prepare("SELECT * FROM permission_group WHERE id_permission_group = :id_permission_group AND id_company = :id_company");
        $sql->bindValue(":id_permission_group", $id_permission_group);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        
        $array = array();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;        
    }
    
    public function addPermissionGroup($name, $plist, $id_company) {
        $sql = $this->db->prepare("INSERT INTO permission_group SET name = :name, params = :params ,id_company = :id_company");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":params", implode(',', $plist));
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
    }
    
    public function editPermissionGroup($name, $plist, $id_company, $id_permission_group) {
        $sql = $this->db->prepare("UPDATE permission_group SET name = :name, params = :params ,id_company = :id_company WHERE id_permission_group = :id_permission_group");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":params", implode(',', $plist));
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":id_permission_group", $id_permission_group);
        $sql->execute();
    }


    public function deletePermissionGroup($id_permission_group) {
        $u = new User();
        
        if (!$u->findUsersInGroup($id_permission_group)) {
            $sql = $this->db->prepare("DELETE FROM permission_group WHERE id_permission_group = :id_permission_group");
            $sql->bindValue(":id_permission_group", $id_permission_group);
            $sql->execute();
        }
        
    }
}