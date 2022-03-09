<?php

require_once "../libraries/Database.php";

class ProfilePostReply {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function uploadPostReplyData($parentID, $userID, $replyContent, $image, $username) {
        $this->db->prepare("INSERT INTO profileposts_replies (reply_parent_id, reply_user_id, reply_content, reply_image, reply_username) VALUES
        (:reply_parent_id, :reply_user_id, :reply_content, :reply_image, :reply_username)");
        $this->db->bindValue(":reply_parent_id", $parentID);
        $this->db->bindValue(":reply_user_id", $userID);
        $this->db->bindValue(":reply_content", $replyContent);
        $this->db->bindValue(":reply_image", $image);
        $this->db->bindValue(":reply_username", $username);
        
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
