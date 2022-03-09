<?php
    $title = "Register An Account | Uni-Connect";
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
<div class="form-section">
<div class="register-container">
        <div class="form-container">
        <div class="register-flash-container">
        <?php flash("register"); ?> <!--- Error messages during registration are flashed here -->
        </div>
        <form action="controllers/Users.php" method="post" class="register-form">
            <input type="hidden" name="type" value="register">
            <div class="form-control">
                <label for="" class="reg-label">First Name</label>
                <input type="text" name="fname" id="fname" class="reg-input" value="<?php
                    if(!empty($_SESSION["temp_fname"])) {
                        echo $_SESSION["temp_fname"];
                    }
                ?>">
            </div>
            <div class="form-control">
                <label for="" class="reg-label">Last Name</label>
                <input type="text" name="lname" id="lname" class="reg-input" value="<?php
                    if(!empty($_SESSION["temp_lname"])) {
                        echo $_SESSION["temp_lname"];
                    }
                ?>">
            </div>
            <div class="form-control">
                <label for="" class="reg-label">Username</label>
                <div class="tool-tip-wrapper">
                <input type="text" name="username" id="username" value="<?php
                    if(!empty($_SESSION["temp_username"])) {
                        echo $_SESSION["temp_username"];
                    }
                ?>">
                <span class="tooltip tooltip-username">Must be at least 6 characters long and can only contain letters, numbers, dots and underscores.</span>
                </div>
            </div>
            <div class="form-control">
                <label for="" class="reg-label">Password</label>
                <div class="tool-tip-wrapper">  
                <i class="fas fa-eye-slash password-eye"></i>
                <input type="password" name="password" id="password">
                <span class="tooltip tooltip-password">Password Must Have At Least:<br> 8 Characters<br> 1 Uppercase Character <br> 1 Lowercase Character <br> 1 Number <br> Optional Special Character: <br> [!£$%^&*_.@?#]</span>
                </div>
            </div>
            <div class="form-control">
                <label for="" class="reg-label">Password Confirm</label>
                <div class="tool-tip-wrapper">
                <input type="password" name="passwordconfirm" id="passwordconfirm" class="reg-input">
                <i class="fas fa-eye-slash password-eye-confirm"></i>
                </div>
            </div>
            <div class="form-control">
                <label for="" class="reg-label">University</label>
                <select name="university" id="university" placeholder="test">
                <?php
                    if(empty($_SESSION["temp_university"])) {
                        echo '<option value="" selected disabled hidden>Select Your University...</option>';
                    } else {
                        echo '<option value="'.$_SESSION["temp_university"].'"selected>'.$_SESSION["temp_university"].'</option>';
                    }
                ?>
                </select>
            </div>
            <div class="form-control">
                <label for="" class="reg-label">University Email</label>
                <div class="tool-tip-wrapper">
                <input type="text" name="email" id="email" value="<?php
                    if(!empty($_SESSION["email"])) {
                        echo $_SESSION["email"];
                    }
                ?>">
                <span class="tooltip tooltip-email">e.g. john.doe@university.ac.uk</span>
                </div>
            </div>
            <div class="submit-btn-container">
            <input type="submit" value="Register">
            </div>
        </form>
        </div>
    </div> 
</div>
</div>
<script src="scripts/university_register_array.js"></script>
<script src="scripts/password_toggler.js"></script>
<?php
    include "includes/footer.php";
?>
</div>