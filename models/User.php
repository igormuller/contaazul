<?php

class User extends model {
    
    private $userInfo;
    private $permission;
    
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
                $this->permission->setGroup($this->userInfo['group'], $this->userInfo['id_company']);
            }            
        }    
    }
    
    public function hasPermission($name) {
        return $this->permission->hasPermission($name);
        
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