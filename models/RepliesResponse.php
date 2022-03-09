<?php

require_once "../libraries/Database.php";

class RepliesResponse {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function uploadReplyResponseData($userID, $parentReplyID, $responseData, $parentUsername, $parentID, $image, $username) {
        $this->db->prepare("INSERT INTO replies_responses (response_parent_id, parent_reply_id, response_user_id, response_content, response_image, response_username, response_parent_username) 
        VALUES
        (:response_parent_id, :parent_reply_id, :response_user_id, :response_content, :response_image, :response_username, :response_parent_username)");
        $this->db->bindValue(":response_parent_id", $parentID);
        $this->db->bindValue(":parent_reply_id", $parentReplyID);
        $this->db->bindValue(":response_user_id", $userID);
        $this->db->bindValue(":response_content", $responseData);
        $this->db->bindValue(":response_image", $image);
        $this->db->bindValue(":response_username", $username);
        $this->db->bindValue(":response_parent_username", $parentUsername);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function uploadReplyResponseDataFinal($userID, $parentReplyID, $responseData, $parentUsername, $parentID, $image, $username) {
        $this->db->prepare("INSERT INTO replies_responses (response_parent_id, parent_reply_id, response_user_id, response_content, response_image, response_username, response_parent_username) 
        VALUES
        (:response_parent_id, :parent_reply_id, :response_user_id, :response_content, :response_image, :response_username, :response_parent_username)");
        $this->db->bindValue(":response_parent_id", $parentID);
        $this->db->bindValue(":parent_reply_id", $parentReplyID);
        $this->db->bindValue(":response_user_id", $userID);
        $this->db->bindValue(":response_content", $responseData);
        $this->db->bindValue(":response_image", $image);
        $this->db->bindValue(":response_username", $username);
        $this->db->bindValue(":response_parent_username", $parentUsername);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}