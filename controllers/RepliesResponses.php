<?php

require_once "../models/RepliesResponse.php";
require_once "../models/ProfilePost.php";
require_once "../helpers/session_helper.php";

class RepliesResponses {
    private $repliesResponseModel;
    private $profilePostModel;

    public function __construct() {
        $this->repliesResponseModel = new RepliesResponse;
        $this->profilePostModel = new ProfilePost;
    }

    public function replyResponse() {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $userID = $_SESSION["id"];
        $responseData = trim($_POST["response"]);
        $parentUsername = $_POST["parent-username"];
        $parentID = $_POST["parent-id"];
        $parentReplyID = $_POST["parent-reply-id"];
        $image = $_SESSION["profile_photo"];
        $username = $_SESSION["username"];

        if(!$this->repliesResponseModel->uploadReplyResponseData($userID, $parentReplyID, $responseData, $parentUsername, $parentID, $image, $username)) {
            die("There was an error");
        }

        redirect("../myprofile.php");
    }

    public function replyResponseFinal() {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $userID = $_SESSION["id"];
        $responseData = trim($_POST["response"]);
        $parentUsername = $_POST["parent-username"];
        $parentID = $_POST["parent-id"];
        $parentReplyID = $_POST["parent-reply-id"];
        $image = $_SESSION["profile_photo"];
        $username = $_SESSION["username"];

        if(!$this->repliesResponseModel->uploadReplyResponseDataFinal($userID, $parentReplyID, $responseData, $parentUsername, $parentID, $image, $username)) {
            die("There was an error");
        }

        redirect("../myprofile.php");
    }
}

$init = new RepliesResponses;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    switch($_POST["type"]) {
        case "reply-response":
            $init->replyResponse();
            break;
        case "reply-response-final":
            $init->replyResponseFinal();
            break;
        default:
            redirect("../index.php");
    }
} else {
    redirect("../index.php");
}