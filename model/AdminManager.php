<?php

class AdminManager
{

    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }

    public function connectAdmin()
    {
        $req = $this->_db->query('SELECT id, user, password, mail FROM admin');
        $admin = $req->fetch(PDO::FETCH_ASSOC);
        return $admin;
    }

    public function editPassword($id, $password)
    {
        $query = 'UPDATE admin SET password ="'.$password.'" WHERE id =' .$id;
        $req = $this->_db->exec($query);
    }

    public function editEmail($id, $email)
    {
        $query = 'UPDATE admin SET mail ="'.$email.'" WHERE id =' .$id;
        $req = $this->_db->exec($query);
    }

    public function resetPassword()
    {
        $id =1;
        $temp_password=rand(100000,999999);
        $password = password_hash($temp_password, PASSWORD_BCRYPT);
        $query = 'UPDATE admin SET password ="'.$password.'" WHERE id =' .$id;
        $req = $this->_db->exec($query);
        return $temp_password;
    }
}

