<?php
    $title = "Forgotten Password | Uni-Connect";
    require_once "helpers/session_helper.php";
    include "includes/header_logreg.php";
    include "includes/navbar_main.php";
?>
<div class="max-container">
<div class="form-section">
    <div class="login-alert"><?php flash("forgottenpassword"); ?></div>
    <div class="form-container">
        <div class="login-form-container">
        <p>Forgotten your passsword? Enter the email associated with your accounts forgotten password and we will send you a password reset link.</p>
        <form action="controllers/ResetPasswords.php" method="post" class="login-form">
            <input type="hidden" name="type" value="forgotpassword">
            <div class="form-control">
                <label for="">Email:</label>
                <input type="text" name="email" id="email">
            </div>
            <div class="submit-btn-container">
            <input type="submit" value="Send Email">
            </div>
        </form>
        </div>
    </div>
</div>
</div>

<?php
    include "includes/footer.php";
?>