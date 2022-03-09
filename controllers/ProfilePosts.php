<?php

require_once "../models/ProfilePost.php";
require_once "../helpers/session_helper.php";

class ProfilePosts {
    private $profilePostModel;

    public function __construct() {
        $this->profilePostModel = new ProfilePost;
    }

    public function wallPost() {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $wallPostData = trim($_POST["wall-post"]);
        $userID = $_SESSION["id"];
        $image = $_SESSION["profile_photo"];
        $username = $_SESSION["username"];

        if(!$this->profilePostModel->uploadPostData($userID, $wallPostData, $image, $username)) {
            die("There was an error");
        }

        echo $this->profilePostModel->updatePosts();

    }

}

$init = new ProfilePosts;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    switch($_POST["type"]) {
        case "new-post":
            $init->wallPost();
            break;
        default:
            redirect("../index.php");
    }
} else {
    redirect("../index.php");
}