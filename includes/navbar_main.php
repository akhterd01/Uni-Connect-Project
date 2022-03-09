<div class="nav-container">
    <nav class="max-container padding-x-m">
        <div class="header-container margin-x-m">
            <div class="header-wrapper">
                <i class="fas fa-user-friends"></i>
                <h1 class="font-m">Uni-Connect</h1>
            </div>
        </div>
        <div class="links-container">
            <ul class="links-container-inner">
                <li><a href="index.php">Home</a></li>
                <?php if(!isset($_SESSION["id"])):?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
                <?php else: ?>
                <li><a href="controllers/Users.php?query=logout">Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <button class="toggler"><i class="fas fa-bars"></i></button>
    </nav>
</div>