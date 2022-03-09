<?php

require "../libraries/Database.php";

class Chatroom {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }
}