<?php

namespace Pandao\Admin\Models;

class UsersModel
{
    protected $pms_db;

    public function __construct($db)
    {
        $this->pms_db = $db;
    }

    public function validateLogin($username, $password)
    {
        if($this->pms_db !== false){
            $stmt = $this->pms_db->prepare('SELECT * FROM pm_user WHERE login = ?');
            $stmt->execute([$username]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['pass'])) {
                return $user;
            }
        }
        return false;
    }
    
    public function validateEmail($email)
    {
        if($this->pms_db !== false){
            $stmt = $this->pms_db->prepare('SELECT * FROM pm_user WHERE email = ?');
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            if ($user) return $user;
        }
        return false;
    }
}
