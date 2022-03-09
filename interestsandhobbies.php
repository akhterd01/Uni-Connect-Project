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
        <a href="interestsandhobbies.php"><h3 style="background-color: rgb(241, 236, 236); border-left: 2px solid rgb(54, 122, 248);" class="p-s-interests-hobbies">Interests and Hobbies</h3></a>
        <a href="changepassword.php"><h3 class="p-s-edit-password">Change Password</h3></a>
        <a href="deleteaccount.php"><h3 class="p-s-delete">Delete Account</h3></a>
        <a href="help.php"><h3 class="p-s-help">Help</h3></a>
        <a href="contact.php"><h3 class="p-s-contact">Contact</h3></a> 
        </div>

        <div class="profile-settings-right">
            <div class="interests-and-hobbies">
                <div class="interests-and-hobbies-inner">
                        
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