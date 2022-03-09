<?php
    $title = "Verify Your Account | Uni-Connect";
    require_once "helpers/session_helper.php";
    include "includes/header_logreg.php";
    include "includes/navbar_main.php";
?>

<?php 
if($_SESSION["referrer"] != true) {
    redirect("index.php");
} else {
    $_SESSION["referrer"] = false;
} ?>

<div class="max-container">
<div class="form-section">
    <div class="login-alert"><?php flash("verify"); ?></div>
    <div class="form-container">
        <div class="login-form-container">
        <form action="controllers/VerifyEmails.php" method="post" class="login-form">
            <input type="hidden" name="type" value="verifyAccount">
            <div class="form-control">
                <p>Please enter the 5 digit code that was sent to your email address.</p>
                <input type="number" name="code" id="code">
            </div>
            <div class="submit-btn-container">
            <input type="submit" value="Verify Account">
            </div>
        </form>
        </div>
    </div>
</div>
</div>
<script src="scripts/verificationcode.js"></script>
<?php
    include "includes/footer.php";
?>