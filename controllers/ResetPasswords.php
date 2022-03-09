<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once "../helpers/session_helper.php";
require_once "../models/ResetPassword.php";
require_once "../models/User.php";

// PHPMailer required files

require_once "../PHPMailer/src/PHPMailer.php";
require_once "../PHPMailer/src/Exception.php";
require_once "../PHPMailer/src/SMTP.php";

class ResetPasswords {
    private $resetModel;
    private $userModel;
    private $mail;

    public function __construct() {
        $this->resetModel = new ResetPassword;
        $this->userModel = new User;
        $this->mail = new PHPMailer();
        // Set core PHPMailer properties and methods
        $this->mail->isSMTP();
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->SMTPAuth = true;
        $this->mail->Username = "akhterd01@gmail.com";
        $this->mail->Password = "hawkyciagqgybgsp";
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port = 465;
    }

    public function sendMail() {

        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $email = trim($_POST["email"]);

        if(empty($email)) {
            flash("forgottenpassword", "Please enter your email.");
            redirect("../forgottenpassword.php");
        }

        if(!preg_match("/.ac.uk$/", $email)) {
            flash("forgottenpassword", "Please enter a valid university email.");
            redirect("../forgottenpassword.php");
        }

        if(!$this->resetModel->deleteRow($email)) {
            die("There was an error with your request.");
        }

        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);
        $url = "http://localhost/University%20Forum%20Project/resetpassword.php?selector=".$selector."&token=".
        bin2hex($token);

        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        $expires = date("U") + 1800;

        if(!$this->resetModel->insertRow($selector, $hashedToken, $email, $expires)) {
            die("There was an error with your request.");
        }

        // If all of the above is successful, send the reset email.

        $subject = "Uni-Connect | Reset Your Password";
        $message = "<h3>Reset your uni-connect password</h3>";
        $message .= "<p>We recieved a request to reset your uni-connect password. If you did not request this, you can safely ignore this email and your password will not be changed.</p>";
        $message .= "<p>To reset your password, click on the link below and follow the provided steps.</p>";
        $message .= "<p><a href='".$url."'>".$url."</p>";

        // Set additional mail properties and methods.

        $this->mail->setFrom("akhterd01@gmail.com");
        $this->mail->isHTML(true);
        $this->mail->Subject = $subject;
        $this->mail->Body = $message;
        $this->mail->addAddress($email);

        if($this->mail->send()) {
            flash("forgottenpassword", "A password reset link has been sent to the provided email address, please follow the steps provided in that email to reset your password.", "success-box");
            redirect("../forgottenpassword.php");
        } else {
            flash("forgottenpassword", "There was an issue processing your request, please try agian later.");
            redirect("../forgottenpassword.php");
        }
    }

    public function resetPassword() {
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = array(
            "selector" => trim($_POST["selector"]),
            "token" => trim($_POST["token"]),
            "password" => trim($_POST["password"]),
            "passwordconfirm" => trim($_POST["passwordconfirm"])
        );

        $url = "../resetpassword.php?selector=".$data["selector"]."&token=".$data["token"];

        if(empty($data["password"])) {
            flash("resetpassword", "Please enter a new password.");
            redirect($url);
        }

        if(empty($data["passwordconfirm"])) {
            flash("resetpassword", "Please confirm new password.");
            redirect($url);
        }

        if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!£$%^&*_.@?#])[A-Za-z0-9!£$%^&*_.@?#]{8,}$/", $data["password"])) {
            flash("resetpassword", "Password must contain at least one uppercase and lowercase character, one number, and one of the following special characters: !£$%^&*_.@?#");
            redirect($url);
        }

        if($data["password"] != $data["passwordconfirm"]) {
            flash("resetpassword", "Passwords do not match.");
            redirect($url);
        }

        $currentTime = date("U");
        if(!$row = $this->resetModel->getRow($data["selector"], $currentTime)) {
            flash("resetpassword", "Either your link is invalid or has expired. Please request a new password reset email. 125");
            redirect($url);
        }

        $token = hex2bin($data["token"]);
        if(!password_verify($token, $row->token)) {
            flash("resetpassword", "Your password reset link is invalid. Please use the link provided in your email, or request a new one. 131");
            redirect($url);
        }

        if(!$this->userModel->checkExistingUsernameOrEmail($row->email, $row->email)) {
            flash("resetpassword", "No account exists with this email.");
            redirect($url);
        }

        $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
        if(!$this->userModel->changePassword($data["password"], $row->email)) {
            die("There was an error");
        }

        if(!$this->resetModel->deleteRow($row->email)) {
            die("There was an error with your request.");
        }        

        flash("login", "Your password has successfully been changed.", "success-box");
        redirect("../login.php");
    }
}

$init = new ResetPasswords;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    switch($_POST["type"]) {
        case "forgotpassword":
            $init->sendMail();
            break;
        case "resetpassword":
            $init->resetPassword();
            break;
        default: 
            redirect("../index.php");
    }
} else {
    redirect("../index.php");
}