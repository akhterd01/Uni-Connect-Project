<?php 
if(empty($_GET["selector"]) && empty($_GET["token"])) {
    echo "There was an error with your request.";
} else {

    $selector = $_GET["selector"];
    $token = $_GET["token"];

    if(ctype_xdigit($selector) && ctype_xdigit($token)) { ?>
<?php
    $title = "Reset Password | Uni-Connect";
    require_once "helpers/session_helper.php";
    include "includes/header_logreg.php";
    include "includes/navbar_main.php";
?>
<div class="max-container">
<div class="form-section">
    <div class="login-alert"><?php flash("resetpassword"); ?></div>
    <div class="form-container">
        <div class="login-form-container">
        <form action="controllers/ResetPasswords.php" method="post" class="login-form">
            <input type="hidden" name="type" value="resetpassword">
            <input type="hidden" name="selector" value="<?php echo $selector; ?>">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <div class="form-control">
                <label for="">New Password:</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="form-control">
                <label for="">Confirm New Password:</label>
                <input type="password" name="passwordconfirm" id="passwordconfirm">
            </div>
            <div class="submit-btn-container">
            <input type="submit" value="Change Password">
            </div>
        </form>
        </div>
    </div>
</div>
</div>

<?php
    include "includes/footer.php";
?>
<?php } else {
    echo "There was an error with your request.";
}}?>