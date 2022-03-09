<?php 
if(!isset($_SESSION)) {
    session_start();
    if(empty($_SESSION["id"])) {
        header("location: index.php");
        exit();
    }
}
?>
<?php
    $title = "Profile Settings | Uni-Connect";
    require_once "helpers/session_helper.php";
    include "includes/header_logged_in.php";
    include "includes/navbar_logged_in.php";
?>
<div class="profile-page-container profile-page-container-fix">
    <div class="profile-settings-container">

        <div class="profile-settings-left">
        <a href="editprofile.php"><h3 class="p-s-edit-profile">Edit Profile</h3></a>
        <a href="interestsandhobbies.php"><h3 class="p-s-interests-hobbies">Interests and Hobbies</h3></a>
        <a href="changepassword.php"><h3 style="background-color: rgb(241, 236, 236); border-left: 2px solid rgb(54, 122, 248);" class="p-s-edit-password">Change Password</h3></a>
        <a href="deleteaccount.php"><h3 class="p-s-delete">Delete Account</h3></a>
        <a href="help.php"><h3 class="p-s-help">Help</h3></a>
        <a href="contact.php"><h3 class="p-s-contact">Contact</h3></a> 
        </div>

        <div class="profile-settings-right">
        <div class="change-password-container">
                <div class="change-password-inner">
                    <form action="controllers/Users.php" method="post" id="change-password-form">
                        <div class="change-password-flash">
                            <?php flash("change-password") ?>
                        </div>
                        <input type="hidden" name="type" value="change-password">
                        <input type="password" name="old-password" placeholder="Current Password">
                        <input type="password" name="new-password" placeholder="New Password">
                        <input type="password" name="new-password-repeat" placeholder="Confirm New Password">
                        <div id="change-password-submit-container">
                        <input type="submit" value="Change Password">
                        </div>
                    </form>
                    <div class="password-format">
                        <h3>New password must meet the following criteria:</h3>
                        <ul>
                            <li>At least one uppercase letter</li>
                            <li>At least one lowercase letter</li>
                            <li>At least one number</li>
                            <li>Be at least 8 characters long</li>
                        </ul>
                        <h3>The following (optional) special characters are allowed in your password:</h3>
                        <ul>
                            <li>!£$%^&*_.@?#</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="scripts/upload_profile.js"></script>
<script src="scripts/settingstoggler.js"></script>
<?php
    include "includes/footer.php";
?>  