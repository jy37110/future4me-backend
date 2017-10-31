<?php
include_once '../model/DbContext.php';

class UserModule {
    private $_db;

    public function __construct() {
        $dbInstance = new DbContext();
        $this->_db =  $dbInstance->getDBContext();
    }

    public function registerUser($userEmail, $firstName, $lastName, $psd)
    {
        $query = "INSERT INTO `User` VALUES('','$userEmail', '$firstName', '$lastName', '$psd');";
        $result = $this->_db->query($query);
        $this->_db->close();
        return $result;
    }

    public function loginCheck($userEmail, $psd)
    {
        //get id and password from database
        $query = "SELECT * FROM User WHERE `email`='$userEmail' AND binary `password`='$psd'";
        $resObj = $this->_db->query($query);
        $this->_db->close();
        //if exist, return true
        if ($resObj->num_rows != 0) {return true;}
        return false;
    }
}