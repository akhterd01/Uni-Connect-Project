<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once "../helpers/session_helper.php";
require_once "../models/VerifyEmail.php";
require_once "../models/User.php";

// PHPMailer required files

require_once "../PHPMailer/src/PHPMailer.php";
require_once "../PHPMailer/src/Exception.php";
require_once "../PHPMailer/src/SMTP.php";

class VerifyEmails {
    private $verifyModel;
    private $userModel;
    private $mail;

    public function __construct() {
        
        $this->verifyModel = new VerifyEmail;
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

        $email = $_POST["email"];
        $code = rand(10000, 99999);
        $expires = date("U") + 900; // 15 minutes

        if(!$this->verifyModel->deleteRow($email)) {
            die("There was an error");
        }

        if(!$this->verifyModel->insertRow($code, $expires, $email)) {
            die("There was an error");
        }

        $subject = "Uni-Connect | Verify Your Account";
        $message = "<h3>Verify Your Account</h3>";
        $message .= "<p>To verify your account please copy and paste the 5 digit code below to the page you were directed to. Verifying your account allows you to access Uni-Connect and helps prevent spam/bots, thank you for understanding.</p>";
        $message .= "<p>Your Code Is:</p>";
        $message .= "<h3><b>".$code."</h3></b>";

        // Set additional mail properties and methods.

        $this->mail->setFrom("akhterd01@gmail.com");
        $this->mail->isHTML(true);
        $this->mail->Subject = $subject;
        $this->mail->Body = $message;
        $this->mail->addAddress($email);

        if($this->mail->send()) {
            flash("verify", "A code has been sent to your email.", "success-box");
            $_SESSION["referrer"] = true;
            redirect("../verifyaccount.php");
        } else {
            flash("index_verify", "There was a problem sending your email, please try again.");
            redirect("../index.php");
        }
    }

    public function verifyAccount() {

        $code = $_POST["code"];
        $currentTime = date("U");
        $email = $_SESSION["email"];

        if(empty($code)) {
            flash("verify", "Please enter your code.");
            $_SESSION["referrer"] = true;
            redirect("../verifyaccount.php");
        }

        if(!$row = $this->verifyModel->getRow($code, $currentTime, $email)) {
            flash("verify", "Your code is either incorrect or has expired. Please send another verification request.");
            $_SESSION["referrer"] = true;
            redirect("../verifyaccount.php");
        }

        if(!$this->userModel->verifyAccount($row->email)) {
            die("There was an error");
        }

        if(!$this->verifyModel->deleteRow($email)) {
            die("There was an error");
        }

        flash("index_verify", "Your account has been verified.", "success-box");
        redirect("../index.php");
    }
}

$init = new VerifyEmails;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    switch($_POST["type"]) {
        case "sendMail":
            $init->sendMail();
            break;
        case "verifyAccount":
            $init->verifyAccount();
            break;
        default:
            redirect("../index.php");
    }
} else {
    redirect("../index.php");
}