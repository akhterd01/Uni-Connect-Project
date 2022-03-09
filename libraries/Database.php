<?php

class Database {
    private $host = "localhost";
    private $dbname = "usersdb";
    private $user = "root";
    private $password = "123456";

    private $error;
    private $dbh;
    private $stmt;

    public function __construct() {

        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->dbh = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->user, $this->password, $options);
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function prepare($sql) {
        $this->stmt = $this->dbh->prepare($sql);
    }

    public function bindValue($param, $value, $type = null) {
        if(is_null($type)) {
            switch(true) {
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute() {
        return $this->stmt->execute();
    }

    public function fetch() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function fetchAll() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function rowCount() {
        return $this->stmt->rowCount();
    }
}