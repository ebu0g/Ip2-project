<?php

require_once 'authorizationclass.php';

Authorization::isLogin();
Authorization::hasPermission('access_department');
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departments</title>

    <!-- ICONSCOUT CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <!-- GOOGLE FONTS (MONTSERAT) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="./css/style.css">

    <!-- Link to External JavaScript -->
    <script src="./js/department.js" defer></script>
</head>
<body>
    <nav>
        <div class="container nav_container">
            <a href="index.html"><h4>DEPARTMENT NETWORK</h4></a>
            <ul class="nav__menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="department.php">Department</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
    </nav>

    <section class="department">
        <div class="container department__container" id="department-container">
            <!-- Department data will be dynamically loaded here -->
            <p>Loading departments...</p>
        </div>
    </section>

    <footer>
        <div class="container footer__container">
            <div class="footer__1">
                <a href="index.html" class="footer__logo"><h4>Department Network</h4></a>
                <p>Explore and discover the right department for your academic and career goals.</p>
            </div>
            <div class="footer__2">
                <h4>Permalinks</h4>
                <ul class="permalink">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="department.html">Department</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
            <div class="footer__3">
                <h4>Privacy</h4>
                <ul class="privacy">
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms and Conditions</a></li>
                    <li><a href="#">Refund Policy</a></li>
                </ul>
            </div>
            <div class="footer__4">
                <h4>Contact Us</h4>
                <p>+251934567809</p>
                <p>department@gmail.com</p>
                <ul class="footer__socials">
                    <li><a href="#"><i class="uil uil-facebook-f"></i></a></li>
                    <li><a href="#"><i class="uil uil-instagram-alt"></i></a></li>
                    <li><a href="#"><i class="uil uil-twitter"></i></a></li>
                    <li><a href="#"><i class="uil uil-linkedin-alt"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="footer__copyright">
            <small>&copy; Department Network</small>
        </div>
    </footer>
</body>
</html>