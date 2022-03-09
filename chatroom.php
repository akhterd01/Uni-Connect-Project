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
    $title = "Chatroom | Uni-Connect";
    require_once "helpers/session_helper.php";
    include "includes/header_logged_in.php";
    include "includes/navbar_logged_in.php";
?>
<div class="chatroom-page-container">

</div>
<script src="scripts/settingstoggler.js"></script>
<?php
    include "includes/footer.php";
?> 