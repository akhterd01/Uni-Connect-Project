<?php 
if(!isset($_SESSION)) {
    session_start();
}
if(empty($_SESSION["id"])) { ?>
<?php
    $title = "Uni-Connect | Where Students Connect";
    require_once "helpers/session_helper.php";
    include "includes/header_main.php";
    include "includes/navbar_main.php";
?>
<div class="page-container">
<!--Hero Content -->
<div class="hero-container">
    <div class="hero-content">
        <h3>Want to meet people at your university?</h3>
        <h3>Register today and start connecting.</h3>
    </div>
</div>
<!--End of Hero Content -->
<!-- Main Content Section -->
<div class="line line-1"></div>
<section class="segment">
    <div class="segment-left">
        <div class="page-number"><span>Page 1 of 32</span></div>
        <h1>Meet people at your university.</h1>
        <h1><i class="fas fa-graduation-cap"></i></h1>
        <h3>A Report By Uni-Connect</h3>
    </div>
    <div class="segment-right">
       <div class="page-number"><span>Page 2 of 32</span></div>
       <h2>1. Register an account</h2><br>
       <h3>Create an account to join the millions of other students using Uni-Connect.</h3><br>
       <h2>2. Create a profile</h2><br>
       <h3>Create your profile and get matched with people who:</h3><br>
       <ul>
           <li>Go to your uni</li>
           <li>Are on the same course as you</li>
           <li>Share similar hobbies/interests</li>
       </ul><br>
       <h2>3. Join the forums</h2><br>
       <h3>Kick back, relax, and talk to others at your uni on the integrated forum.    </h3>
    </div>
</section>
<div class="line line-2"></div>
<section class="segment">
    <div class="segment-left">
        <div class="page-number"><span>Page 3 of 32</span></div>
        <h1>Join the discussion on the integrated uni forum.</h1>
        <h1><i class="fab fa-wpforms"></i></h1>
    </div>
    <div class="segment-right">
        <div class="page-number"><span>Page 4 of 32</span></div>
        <h2>Engage in discussion</h2><br>
        <h3>Browse various topics and engage with other students on a range of subjects.</h3><br>
        <h2>Stay up to date with the latest events</h2><br>
        <h3>Keep in the loop with whats going on at uni, sign up to events or create your own.</h3><br>
        <h2>Connect with like-minded individuals</h2><br>
        <h3>Talk about topics which are of interest to you and meet other students along the way.</h3>
    </div>
</section>
<div class="line line-3"></div>
<section class="statistics">
    <div class="stats-header"><h3>Join a growing community</h3></div>
    <div class="stats-container">
        <div class="stat">
            <div class="inner-container">
                <h1><i class="far fa-user"></i></h1><br>
                <h2>8,543,503</h2><br>
                <h3>Registered Users</h3>
            </div>
        </div>
        <div class="stat">
            <div class="inner-container">
                <h1><i class="fas fa-university"></i></h1><br>
                <h2>130</h2><br>
                <h3>Integrated Universities</h3>
            </div>
        </div>
        <div class="stat">
            <div class="inner-container">
                <h1><i class="fas fa-phone"></i></h1><br>
                <h2>24/7</h2><br>
                <h3>24/7 Support</h3>
            </div>
        </div>
    </div>
</section>
<!-- End of Main Content Section -->
</div>
<?php
    include "includes/footer.php";
?>  
<?php } else {
    header("location: myprofile.php");
    exit();
}?>