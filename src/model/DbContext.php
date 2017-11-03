<?php

class DbContext {
    private $_db;
    public function __construct()
    {
        $this->_db = new mysqli('103.226.222.179', 'strate15_jesse', 'future4me','strate15_future4me');
//        $this->_db = new mysqli('localhost', 'strate15_jesse', 'future4me','strate15_future4me');
        //$this->_db = new mysqli('www.future4me.net', 'strate15_jesse', 'future4me','strate15_future4me');

        if ($this->_db->connect_errno) {
            //throw exception
            die("Failed to connect to MySQL: (" . $this->_db->connect_errno . ") " . $this->_db->connect_error);
        }
    }

    public function getDBContext(){
        return $this->_db;
    }

    public function getUser(){
        $query = "SELECT * FROM User";
        $resObj = $this->_db->query($query);
        $resultArray = Array();
        $n = 0;
        while ($row = $resObj->fetch_assoc()) {
            $resultArray[$n] = $row;
            ++$n;
        }
        $this->_db->close();
        return $resultArray;
    }
}