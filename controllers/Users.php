<?php

require_once "../models/User.php";
require_once "../helpers/session_helper.php";

class Users {
    private $userModel;

    public function __construct() {
        $this->userModel = new User;
    }

    public function register() {
        // Sanitize the whole $_POST array.
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Trim whitespace from the start and end of the whole $_POST array and store it in a new associative array called $data.
        $data = array(
            "fname" => trim($_POST["fname"]),
            "lname" => trim($_POST["lname"]),
            "username" => trim($_POST["username"]),
            "password" => trim($_POST["password"]),
            "passwordconfirm" => trim($_POST["passwordconfirm"]),
            "university" => trim($_POST["university"]),
            "email" => trim($_POST["email"])
        );

        // Store temporary user input so they can make ammendments if an error is met

        $_SESSION["temp_fname"] = $data["fname"];
        $_SESSION["temp_lname"] = $data["lname"];
        $_SESSION["temp_username"] = $data["username"];
        $_SESSION["temp_university"] = $data["university"];
        $_SESSION["email"] = $data["email"];

        if(empty($data["fname"])) {
            flash("register", "Please enter your first name.");
            redirect("../register.php");
        }
        
        if(empty($data["lname"])) {
            flash("register", "Please enter your last name.");
            redirect("../register.php");
        }

        if(empty($data["username"])) {
            flash("register", "Please enter a username.");
            redirect("../register.php");
        }

        if(empty($data["password"])) {
            flash("register", "Please enter a password.");
            redirect("../register.php");
        }

        if(empty($data["passwordconfirm"])) {
            flash("register", "Please confirm your password.");
            redirect("../register.php");
        }

        if(empty($data["university"])) {
            flash("register", "Please select your university.");
            redirect("../register.php");
        }

        if(empty($data["email"])) {
            flash("register", "Please enter your university email.");
            redirect("../register.php");
        }

        if(!preg_match("/^[a-zA-Z0-9._]{6,}$/", $data["username"])) {
            flash("register", "Please enter a valid username.");
            redirect("../register.php");
        }

        if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[A-Za-z0-9!£$%^&*_.@?#]{8,}$/", $data["password"])) {
            flash("register", "Please enter a valid password.");
            redirect("../register.php");
        }

        if($data["password"] != $data["passwordconfirm"]) {
            flash("register", "Passwords do not match.");
            redirect("../register.php");
        }

        if(!preg_match("/.ac.uk$/", $data["email"])) {
            flash("register", "Please enter a valid university email.");
            redirect("../register.php");
        }

        if($this->userModel->checkExistingUsernameOrEmail($data["username"], $data["email"])) {
            flash("register", "This username has been taken. Please choose another.");
            redirect("../register.php");
        }

        $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);

        if(!$this->userModel->registerUser($data)) {
            flash("register", "There was a problem processing your registration. Please contact us to solve this issue.");
            redirect("../register.php");
        }

        // Unset temporary user data
        unset($_SESSION["temp_fname"]);
        unset($_SESSION["temp_lname"]);
        unset($_SESSION["temp_username"]);
        unset($_SESSION["temp_university"]);
        unset($_SESSION["email"]);

        flash("login", "Thank you for registering with us! You may now log in to your account using the form below.", "success-box");
        redirect("../login.php");
    }

    public function login() {
        // Sanitize the whole $_POST array.
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Trim whitespace from the start and end of the whole $_POST array and store it in a new associative array called $data.
        $data = array(
            "username/email" => trim($_POST["username/email"]),
            "password" => trim($_POST["password"])
        );

        if(empty($data["username/email"])) {
            flash("login", "Please enter your username or email");
            redirect("../login.php");
        }

        if(empty($data["password"])) {
            flash("login", "Please enter your password");
            redirect("../login.php");
        }

        if($row = $this->userModel->checkExistingUsernameOrEmail($data["username/email"], $data["username/email"])) {
            if(password_verify($data["password"], $row->password)) {
                $this->loginUser($row);
                redirect("../index.php");
            } else {
                flash("login", "Incorrect password.");
                redirect("../login.php");
            }
        } else {
            flash("login", "An account with this username or email does not exist.");
            redirect("../login.php");
        }
    }

    public function loginUser($row) {
        $_SESSION["id"] = $row->id;
        $_SESSION["fname"] = $row->firstname;
        $_SESSION["lname"] = $row->lastname;
        $_SESSION["username"] = $row->username;
        $_SESSION["university"] = $row->university;
        $_SESSION["email"] = $row->email;
        $_SESSION["email_verified"] = $row->verified_email;
        $_SESSION["profile_photo"] = $row->profile_photo;
        $_SESSION["dateofbirth"] = $row->dateofbirth;
        $_SESSION["course"] = $row->course;
        $_SESSION["bio"] = $row->bio;
        $_SESSION["last_seen"] = "Last online: " . date('d/m/Y');
    }

    public function logout() {
        unset($_SESSION["id"]);
        unset($_SESSION["fname"]);
        unset($_SESSION["lname"]);
        unset($_SESSION["username"]);
        unset($_SESSION["university"]);
        unset($_SESSION["email"]);
        unset($_SESSION["email_verified"]);
        unset($_SESSION["profile_photo"]);
        unset($_SESSION["dateofbirth"]);
        unset($_SESSION["course"]);
        unset($_SESSION["bio"]);
        unset($_SESSION["last_seen"]);
        session_destroy();
        redirect("../index.php");
    }

    public function updateProfilePicture() {
        $currentTime = date("Y-m-d-H-i-s");
        $targetDir = "../images/profile_images/";
        $fileName = basename($_FILES["profile_photo"]["name"]);
        $ext = pathinfo($_FILES["profile_photo"]["name"], PATHINFO_EXTENSION);
        $targetFilePath = $targetDir.$currentTime."_".$fileName;    

        if(empty($_FILES["profile_photo"]["name"])) {
            flash("profile-settings", "Please upload a picture to save.");
            redirect("../editprofile.php");
        }
        
        $allowTypes = array('jpg','png','jpeg');
        if(!in_array($ext, $allowTypes)) {
            flash("profile-settings", "Only the following file extensions are allowed: .jpg, .jpeg, .png");
            redirect("../editprofile.php");
        }

        if(!move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $targetFilePath)) {
            flash("profile-settings", "There was an error with your request. $targetFilePath");
            redirect("../editprofile.php");
        } 

        if(!$this->userModel->insertProfilePicture($fileName, $currentTime, $_SESSION["username"])) {
            die("There was an error");
        }

        if(!$this->userModel->updateProfilePostsPicture($fileName, $currentTime, $_SESSION["username"])) {
            die("There was an error");
        }

        if(!$this->userModel->updatePostsRepliesPicture($fileName, $currentTime, $_SESSION["username"])) {
            die("There was an error");
        }

        if(!$this->userModel->updatePostsResponsePicture($fileName, $currentTime, $_SESSION["username"])) {
            die("There was an error");
        }
        
        flash("profile-settings", "Your profile picture has successfully been changed.", "success-box");
        redirect("../editprofile.php");
    }

    public function profileSettings() {
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = array(
            "fname" => trim($_POST["fname"]),
            "lname" => trim($_POST["lname"]),
            "dateofbirth" => trim($_POST["dateofbirth"]),
            "bio" => trim($_POST["bio"]),
            "course" => trim($_POST["course"]),
        );

        if(!$this->userModel->updateProfileSettings($data["fname"], $data["lname"], $data["dateofbirth"], $data["bio"], $data["course"], $_SESSION["id"])) {
            die("There was an error");
        }

        flash("profile-settings", "Your profile settings have successfully been changed.", "success-box");
        redirect("../editprofile.php");        
    }

    public function changePassword() {
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = array(
            "old-password" => trim($_POST["old-password"]),
            "new-password" => trim($_POST["new-password"]),
            "new-password-repeat" => trim($_POST["new-password-repeat"])
        );

        if(empty($data["old-password"]) || empty($data["new-password"]) || empty($data["new-password-repeat"])) {
            flash("change-password", "Please fill out all inputs.");
            redirect("../changepassword.php");
        }

        if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[A-Za-z0-9!£$%^&*_.@?#]{8,}$/", $data["new-password"])) {
            flash("change-password", "New password does not meet the required criteria.");
            redirect("../changepassword.php");
        }

        if($data["new-password"] != $data["new-password-repeat"]) {
            flash("change-password", "Passwords do not match.");
            redirect("../changepassword.php");
        }

        $row = $this->userModel->checkExistingUsernameOrEmail($_SESSION["username"], $_SESSION["username"]);
        if(!password_verify($data["old-password"], $row->password)) {
            flash("change-password", "Incorrect Password");
            redirect("../changepassword.php");
        }

        if(!$this->userModel->changePassword(password_hash($data["new-password"], PASSWORD_DEFAULT), $_SESSION["email"])) {
            die("There was an error");
        }

        flash("change-password", "Success!", "success-box");
        redirect("../changepassword.php");
    }
    
    function deleteAccount() {
        $id = $_SESSION["id"];
        $this->userModel->deleteAccount($id);
        $this->logout();
    }

}

$init = new Users;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    switch($_POST["type"]) {
        case "register":
            $init->register();
            break;
        case "login":
            $init->login();
            break;
        case "updateProfilePicture":
            $init->updateProfilePicture();
            break;
        case "profile-settings":
            $init->profileSettings();
            break;
        case "change-password":
            $init->changePassword();
        case "delete-account":
            $init->deleteAccount();
        default:
            redirect("../index.php");
    }
} else if($_SERVER["REQUEST_METHOD"] == "GET") {
    switch($_GET["query"]) {
        case "logout":
            $init->logout();
            break;
        default:
            redirect("../index.php");
    }
} else {
    redirect("../index.php");
}