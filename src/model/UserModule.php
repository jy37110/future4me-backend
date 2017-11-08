<?php
include_once '../model/DbContext.php';

class UserModule {
    private $_db;

    public function __construct() {
        $dbInstance = new DbContext();
        $this->_db = $dbInstance->getDBContext();
    }

    public function reconnectDB() {
        $dbInstance = new DbContext();
        $this->_db = $dbInstance->getDBContext();
    }

    public function registerUser($userEmail, $firstName, $lastName, $psd)
    {
        $query = "INSERT INTO `User` VALUES('','$userEmail', '$firstName', '$lastName', '$psd');";
        $result = $this->_db->query($query);
        $this->_db->close();
        return $result;
    }

    public function loginCheck($psd, $userModule)
    {
        if ($userModule == false || $userModule == []) return false;
        else return password_verify($psd, $userModule[0]['password']);
    }

    public function verifyResetPassword($psd, $userModule)
    {
        if ($userModule == false || $userModule == []) return false;
        else return password_verify($userModule[0]['password'], $psd);
    }

    public function getUSer($userEmail)
    {
        $query = "SELECT * FROM User WHERE `email`='$userEmail'";
        $resObj = $this->_db->query($query);
        $this->_db->close();
        //if ($resObj->num_rows != 0) {return true;}
        if($resObj==false) {
            return false;
        }
        //put all account id into an array and return the array
        $resultArray = Array();
        $n = 0;
        while ($row = $resObj->fetch_assoc()) {
            $resultArray[$n] = $row;
            ++$n;
        }
        return $resultArray;
    }

    public function resetPassword($id,$newPassword)
    {
        $query = "UPDATE User SET password='$newPassword' WHERE id=$id";
        $res = $this->_db->query($query);
        $this->_db->close();
        return $res;
    }
}