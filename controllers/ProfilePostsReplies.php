<?php

require_once "../models/ProfilePostReply.php";
require_once "../models/ProfilePost.php";
require_once "../helpers/session_helper.php";

class ProfilePostsReplies {
    private $profilePostReplyModel;
    private $profilePostModel;

    public function __construct() {
        $this->profilePostReplyModel = new ProfilePostReply;
        $this->profilePostModel = new ProfilePost;
    }

    public function wallPostReply() {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $wallPostReplyData = trim($_POST["comment"]);
        $parentname = $_POST["reply-parent-name"];
        $parentID = $_POST["reply-parent-id"];
        $userID = $_SESSION["id"];
        $image = $_SESSION["profile_photo"];
        $username = $_SESSION["username"];

        if(!$this->profilePostReplyModel->uploadPostReplyData($parentID, $userID, $wallPostReplyData, $image, $username)) {
            die("There was an error");
        }

        echo $this->profilePostModel->updatePosts();
    }
}

$init = new ProfilePostsReplies;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    switch($_POST["type"]) {
        case "post-reply":
            $init->wallPostReply();
            break;
        default:
            redirect("../index.php");
    }
} else {
    redirect("../index.php");
}