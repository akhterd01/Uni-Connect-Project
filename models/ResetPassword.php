<?php

require_once "../libraries/Database.php";

class ResetPassword {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function deleteRow($email) {

        $this->db->prepare("DELETE FROM passwordreset WHERE email = :email");
        $this->db->bindValue(":email", $email);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function insertRow($selector, $hashedToken, $email, $expires) {

        $this->db->prepare("INSERT INTO passwordreset (selector, token, email, expires) VALUES 
        (:selector, :hashedToken, :email, :expires)");
        $this->db->bindValue(":selector", $selector);
        $this->db->bindValue(":hashedToken", $hashedToken);
        $this->db->bindValue(":email", $email);
        $this->db->bindValue("expires", $expires);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getRow($selector, $expires) {

        $this->db->prepare("SELECT * FROM passwordreset WHERE selector = :selector AND expires > :expires");
        $this->db->bindValue(":selector", $selector);
        $this->db->bindValue(":expires", $expires);

        $row = $this->db->fetch();

        if($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
}