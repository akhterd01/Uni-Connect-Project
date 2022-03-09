<?php

require_once "../libraries/Database.php";

class VerifyEmail {
    private $db;

    public function __construct() {
        $this->db = new Database; 
    }

    public function deleteRow($email) {
        $this->db->prepare("DELETE FROM verifyemail WHERE email = :email");
        $this->db->bindValue(":email", $email);
        
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function insertRow($code, $expires, $email) {
        $this->db->prepare("INSERT INTO verifyemail (code, expires, email) VALUES (:code, :expires, :email)");
        $this->db->bindValue(":code", $code);
        $this->db->bindValue(":expires", $expires);
        $this->db->bindValue(":email", $email);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getRow($code, $expires, $email) {
        $this->db->prepare("SELECT * FROM verifyemail WHERE email = :email AND code = :code AND expires > :expires");
        $this->db->bindValue(":email", $email);
        $this->db->bindValue(":code", $code);
        $this->db->bindValue(":expires", $expires);
        
        $row = $this->db->fetch();

        if($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
}