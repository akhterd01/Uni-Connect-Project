<?php

require "../models/Chatroom.php";
require "../helpers/session_helper.php";

class Chatrooms {
    private $chatModel;

    public function __construct() {
        $this->chatModel = new Chatroom;
    }
}

$init = new Chatrooms;