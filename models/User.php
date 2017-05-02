<?php

class User extends model {
    
    private $userInfo;
    private $permission;
    
    public function add($name, $email, $password, $id_group, $id_company) {
        $sql = $this->db->prepare("INSERT INTO user SET name = :name, email = :email, password = :password, id_group = :id_group, id_company = :id_company");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":password", md5($password));
        $sql->bindValue(":id_group", $id_group);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();        
    }
    
    public function isLogged() {
        
        if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {
            return TRUE;
        } else {
            return FALSE;
        }   
    }
    
    public function doLogin($email, $password) {
        $sql = $this->db->prepare("SELECT * FROM user WHERE email = :email AND password = :password");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":password", md5($password));
        $sql->execute();
        
        if ($sql->rowCount() > 0) {
            $row = $sql->fetch();
            $_SESSION['ccUser'] = $row['id_user'];
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function setLoggedUser() {
        
        if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {
            $id = $_SESSION['ccUser'];
            $sql = $this->db->prepare("SELECT * FROM user WHERE id_user = :id_user");
            $sql->bindValue(":id_user", $id);
            $sql->execute();
            
            if ($sql->rowCount() > 0) {
                $this->userInfo = $sql->fetch();
                $this->permission = new Permission();
                $this->permission->setGroup($this->userInfo['id_group'], $this->userInfo['id_company']);
            }            
        }    
    }
    
    public function hasPermission($name) {
        return $this->permission->hasPermission($name);
    }
    
    public function findUsersInGroup($id_group) {
        $sql = $this->db->prepare("SELECT COUNT(*) AS c FROM user WHERE id_group = :id_group");
        $sql->bindValue(":id_group", $id_group);
        $sql->execute();
        $row = $sql->fetch();
        
        if ($row['c'] === '0') {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function getList($id_company) {
        $sql = $this->db->prepare("SELECT "
                    . "user.*, "
                    . "permission_group.name AS name_group "
                . "FROM "
                    . "user "
                . "LEFT JOIN "
                    . "permission_group ON id_permission_group = id_group "
                . "WHERE "
                    . "user.id_company = :id_company");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        
        $array = array();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
   

    public function getCompany() {
        if (isset($this->userInfo['id_company'])) {
            return $this->userInfo['id_company'];
        } else {
            return 0;
        }
    }
    
    public function getName() {
        if (isset($this->userInfo['name'])) {
            return $this->userInfo['name'];
        } else {
            return 0;
        }
    }
    
    
}