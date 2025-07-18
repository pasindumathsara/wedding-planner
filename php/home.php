
<?php
session_start();
?>

<div class="user-auth" style="position:relative; left:00px;">
    <?php if (isset($_SESSION['username'])): ?>
        <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
        <a href="logout.php" class="btn logout-btn"  style="background-color:#b76e79">Logout</a>
    <?php else: ?>
        <a href="index.php" class="btn" style="background-color:#b76e79">Sign Up</a>
        <a href="index.php" class="btn" style="background-color:#b76e79">Login</a>
    <?php endif; ?>
</div>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wedding Website</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <link rel="stylesheet" href="../css/home.css">

    <script src="../js/script1.js" defer></script>
</head>
<body>

<div class="container">
    <section class="header">
        <a href="home.php" class="logo" style="   font-size: 100%;">Dream Wedding</a>
        <nav class="navbar">
            <a href="home.php" style="   font-size: 100%;">Home</a>
            <a href="about.php" style="   font-size: 100%;">About</a>
            <a href="view_packages.php" style="   font-size: 100%;">Packages</a>
            <a href="../html/portfolio.html" style="   font-size: 100%;">Portfolio</a>
            <a href="contact.php" style="   font-size: 100%;">Contact</a>
        </nav>
        <div id="menu-btn" class="fas fa-bars"></div>
    </section>

    <section class="home">
        <div class="swiper home-slider">
            <div class="swiper-wrapper">

                <div class="swiper-slide" style="background:url(../images/home-slide-1.jpg) no-repeat center; background-size:cover;">
                    <div class="content">
                        <h3>Start Planning Your Dream Wedding</h3>
                        <p>Your big day should be unforgettable. Let us help you make every moment perfect, from the flowers to the final kiss.</p>
                        <a href="about.php" class="btn">Discover more</a>
                    </div>
                </div>

                <div class="swiper-slide" style="background:url(../images/home-slide-2.jpg) no-repeat center; background-size:cover;">
                    <div class="content">
                        <h3>Elegant, Memorable, and Perfect</h3>
                        <p>We design weddings that reflect your love story — stylish, unique, and full of unforgettable memories.</p>
                        <a href="about.php" class="btn">Discover more</a>
                    </div>
                </div>

                <div class="swiper-slide" style="background:url(../images/home-slide-3.jpg) no-repeat center; background-size:cover;">
                    <div class="content">
                        <h3>Celebrate Love with Confidence</h3>
                        <p>From planning to decoration and coordination, we take care of everything so you can enjoy your big day stress-free.</p>
                        <a href="about.php" class="btn">Discover more</a>
                    </div>
                </div>

            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3  style="   font-size: 100%;">quick links</h3>
                <a href="home.php" style="   font-size: 100%;"><i class="fas fa-angle-right"></i> Home</a>
                <a href="about.php" style="   font-size: 100%;"><i class="fas fa-angle-right"></i> About</a>
                <a href="portfolio.php" style="   font-size: 100%;"><i class="fas fa-angle-right"></i> Portfolio</a>
                <a href="pricing.php" style="   font-size: 100%;"><i class="fas fa-angle-right"></i> Pricing</a>
                <a href="contact.php" style="   font-size: 100%;"><i class="fas fa-angle-right"></i> Contact</a>
            </div>

            <div class="box">
                <h3>extra links</h3>
                <a href="#" style="   font-size: 100%;"><i class="fas fa-angle-right"></i> Plan Wedding</a>
                <a href="#" style="   font-size: 100%;"><i class="fas fa-angle-right"></i> Our Services</a>
                <a href="#" style="   font-size: 100%;"><i class="fas fa-angle-right"></i> Ask Questions</a>
                <a href="#" style="   font-size: 100%;"><i class="fas fa-angle-right"></i> Terms Of Use</a>
                <a href="#" style="   font-size: 100%;"><i class="fas fa-angle-right"></i> Privacy Policy</a>
            </div>

            <div class="box">
                <h3>contact info</h3>
                <a href="#" style="   font-size: 100%;"><i class="fas fa-phone"></i> +123-456-7890</a>
                <a href="#" style="   font-size: 100%;"><i class="fas fa-envelope"></i> yourmail@gmail.com</a>
                <a href="#" style="   font-size: 100%;"><i class="fas fa-map"></i> Matara, Hakmana</a>
            </div>

            <div class="box">
                <h3>follow us</h3>
                <a href="#" style="   font-size: 100%;"><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="#" style="   font-size: 100%;"><i class="fab fa-twitter"></i> Twitter</a>
                <a href="#" style="   font-size: 100%;"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="#" style="   font-size: 100%;"><i class="fab fa-linkedin"></i> Linkedin</a>
            </div>
        </div>
        <div class="credit"> Created by <span>Kaushan Gamage</span> | All Rights Reserved! </div>
    </section>

</div> <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
</body>
</html>