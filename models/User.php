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
    
    public function edit($name, $password, $id_group, $id_user, $id_company) {
        $command = "UPDATE user SET name = :name, id_group = :id_group";
        if (!empty($password)) {
            $command .= ", password = :password";
        }
        $command .= " WHERE id_user = :id_user AND id_company = :id_company";
        $sql = $this->db->prepare($command);
        $sql->bindValue(":name", $name);
        if (!empty($password)) {
            $sql->bindValue(":password", md5($password));
        }
        $sql->bindValue(":id_group", $id_group);
        $sql->bindValue(":id_user", $id_user);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();        
    }
    
    public function delete($id_user, $id_company) { 
        $sql = $this->db->prepare("DELETE FROM user WHERE id_user = :id_user AND id_company = :id_company");
        $sql->bindValue(":id_user", $id_user);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
    }
    
    public function findUserByEmail($email) {
        $sql = $this->db->prepare("SELECT COUNT(*) AS c FROM user WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();
        
        if ($sql->fetch()['c'] === '0') {
            return FALSE;
        } else {
            return TRUE;
        }
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
    
    public function getUser($id_user) {
        $sql = $this->db->prepare("SELECT * FROM user WHERE id_user = :id_user");
        $sql->bindValue(":id_user", $id_user);
        $sql->execute();
        
        $array = array();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;        
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
   

    public function getCompany($id_user = '') {
        
        if (!empty($id_user)) {
            $sql = $this->db->prepare("SELECT id_company FROM user WHERE id_user = :id_user");
            $sql->bindValue(":id_user", $id_user);
            $sql->execute();
            
            $id_company = '';
            if ($sql->rowCount() > 0) {
                $id_company = $sql->fetch()['id_company'];
            }
            return $id_company;
        } else {
            if (isset($this->userInfo['id_company'])) {
                return $this->userInfo['id_company'];
            } else {
                return 0;
            }
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