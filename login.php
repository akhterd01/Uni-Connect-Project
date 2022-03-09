<?php
    $title = "Login To Your Account | Uni-Connect";
    require_once "helpers/session_helper.php";
    include "includes/header_logreg.php";
    include "includes/navbar_main.php";
?>

<?php
if(isset($_SESSION["id"])) {
    redirect("../index.php");
}
?>

<div class="body-container">
<div class="body-img"></div>
<div class="max-container">
<div class="form-section login-form-section">
    <div class="form-container login-container">
    <div class="login-alert"><?php flash("login"); ?></div>
        <div class="login-form-container">
        <form action="controllers/Users.php" method="post" class="login-form">
            <input type="hidden" name="type" value="login">
            <div class="form-control">
                <label for="">Username/Email</label>
                <input type="text" name="username/email" id="username/email">
            </div>
            <div class="form-control">
                <label for="">Password</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="submit-btn-container">
            <input type="submit" value="Login">
            </div>
        </form>
        <a href="forgottenpassword.php">Forgotten password?</a>
        </div>
    </div>
</div>
</div>
<?php
    include "includes/footer.php";
?>
</div>
