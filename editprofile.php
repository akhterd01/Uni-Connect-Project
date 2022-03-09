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
    $title = "Edit Profile | Uni-Connect";
    require_once "helpers/session_helper.php";
    include "includes/header_logged_in.php";
    include "includes/navbar_logged_in.php";
?>
<div class="profile-page-container profile-page-container-fix">
    <div class="profile-settings-container">

        <div class="profile-settings-left">
        <a href="editprofile.php"><h3 style="background-color: rgb(241, 236, 236); border-left: 2px solid rgb(54, 122, 248);" class="p-s-edit-profile">Edit Profile</h3></a>
        <a href="interestsandhobbies.php"><h3 class="p-s-interests-hobbies">Interests and Hobbies</h3></a>
        <a href="changepassword.php"><h3 class="p-s-edit-password">Change Password</h3></a>
        <a href="deleteaccount.php"><h3 class="p-s-delete">Delete Account</h3></a>
        <a href="help.php"><h3 class="p-s-help">Help</h3></a>
        <a href="contact.php"><h3 class="p-s-contact">Contact</h3></a> 
        </div>

        <div class="profile-settings-right">

            <div class="edit-profile-container">
                <div class="edit-profile-inner flex-container">
                    <div class="edit-profile-inner-left">
                        <?php flash("profile-settings"); ?>
                        <img src="images\profile_images\<?php echo $_SESSION['profile_photo']; ?>" alt="Profile Picture">
                        <div id="file-list"></div>
                        <form action="controllers/users.php" method="post" id="photo-upload-form" enctype="multipart/form-data">
                            <input type="hidden" name="type" value="updateProfilePicture">
                            <label class="edit-profile-upload" style="border: none;" type="button">
                                <input type="file" name="profile_photo" id="profile-photo" onchange="updateBtn()">
                                Upload Picture
                            </label>
                            <input type="submit" value="Save Changes" class="edit-profile-upload">
                        </form>
                    </div>
                    <div class="edit-profile-inner-right">
                        <form action="controllers/Users.php" method="post" class="edit-profile-right-form">
                            <input type="hidden" name="type" value="profile-settings">
                            <input type="text" name="fname" id="fname" placeholder="First Name" value="<?php echo $_SESSION["fname"]; ?>">
                            <input type="text" name="lname" id="fname" placeholder="Last Name" value="<?php echo $_SESSION["lname"]; ?>">
                            <div class="birthday-wrapper">
                                <label for="dateofbirth"><?php echo $_SESSION["dateofbirth"]; ?></label>
                                <input type="date" id="dateofbirth" name="dateofbirth" placeholder="Date of Birth" value="<?php echo $_SESSION["dateofbirth"]; ?>" min="1945-12-31" max="<?php echo (date("Y") - 17)?>-01-01">
                            </div>
                            <input type="text" name="bio" id="bio" placeholder="Bio" value="<?php echo $_SESSION["bio"]; ?>">
                            <input type="text" name="course" id="course" placeholder="Course" value="<?php echo $_SESSION["course"]; ?>"><br>
                            <div class="edit-profile-submit-container">
                            <input type="submit" value="Update Details">
                            </div>
                        </form>
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