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
    $title = "Delete Account | Uni-Connect";
    require_once "helpers/session_helper.php";
    include "includes/header_logged_in.php";
?>
<div class="delete-account-page-container">
<!--Pop Up Section-->
<div class="pop-up-delete-account">
    <div class="pop-up-content-delete-account">
        <h3>Are you sure you want to delete your account? This cannot be reversed.</h3>
        <form action="controllers/Users.php" method="post">
            <input type="hidden" name="type" value="delete-account">
            <button type="button" id="cancel-btn">Cancel</button>
            <input type="submit" value="Delete Account">
        </form>
    </div>
</div>
<!--End of Pop Up Section-->
<?php 
    include "includes/navbar_logged_in.php";
?>
<div class="profile-page-container profile-page-container-fix">
    <div class="profile-settings-container">

        <div class="profile-settings-left">
        <a href="editprofile.php"><h3 class="p-s-edit-profile">Edit Profile</h3></a>
        <a href="interestsandhobbies.php"><h3 class="p-s-interests-hobbies">Interests and Hobbies</h3></a>
        <a href="changepassword.php"><h3 class="p-s-edit-password">Change Password</h3></a>
        <a href="deleteaccount.php"><h3 style="background-color: rgb(241, 236, 236); border-left: 2px solid rgb(54, 122, 248);" class="p-s-delete">Delete Account</h3></a>
        <a href="help.php"><h3 class="p-s-help">Help</h3></a>
        <a href="contact.php"><h3 class="p-s-contact">Contact</h3></a> 
        </div>

        <div class="profile-settings-right">
            <div class="delete-account-container">
                <div class="delete-account-inner">
                    <h3>Delete Your Uni-Connect Account</h3>
                    <h4>When you delete your account, all information stored in our databases relating to your account will be completely removed, and we cannot reverse this once it happens. If you are still sure that you want to delete your account, press the button below. You will be prompted with a final warning, confirming your decision.</h4>
                    <button type="button" id="delete-btn-1">Delete Account</button>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="scripts/upload_profile.js"></script>
<script src="scripts/settingstoggler.js"></script>
<script src="scripts/delete_account_popup.js"></script>
<?php
    include "includes/footer.php";
?>
</div>  