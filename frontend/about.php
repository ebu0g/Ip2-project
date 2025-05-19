

<?php
require_once 'Authorization.php';

Authorization::isLogin();
Authorization::hasPermission('access_about')

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Educational Website using HTML, CSS & Javascript</title>

    <!--ICONSCOUT CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <!--GOOGLE FONTS (MONTSERAT) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
 
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/about.css">
</head>
<body>
     <nav>
        <div class="container nav_container">
            <a href="index.html"><h4>DEPARTMENT NETWORK</h4></a>
            <u1 class="nav__menu">
               <li><a href="index.php">Home</a></li>
               <li><a href="about.php">About</a></li>  
               <li><a href="department.php">Department</a></li>  
               <li><a href="contact.php">Contact</a></li>  
            </u1>
            <button id="open-menu-btn"><i class="uil uil-bars"></i></button>
            <button id="close-menu-btn"><i class="uil uil-multiply"></i></button>
        </div>
     </nav>
     <!--=================== END OF NAVBAR====================-->









    <section class="about__achievement">
        <div class="container about__achievements-container">
            <div class="about__achievements-left">
                <img src="./image/achievements.webp">
            </div>
            <div class="about__achievements-right">
                <h1>Achievements</h1>
                <p>Department Network helps AASTU freshmen find the right department based on their interests and skills.</p>
                    <div class="achievements__cards">
                        <article class="achievements__card">
                            <div class="achievement__icon"><i class="uil uil-video"></i></div>
                            
                            <h3 class="department_number">Loading...</h3> <!-- Default text while data is being fetched -->
                            <script>
                              // Fetch department count from the backend using JavaScript
                              const apiUrl = 'http://localhost:8000/backend/controllers/about.php';
                          
                              fetch(apiUrl)
                                .then(response => {
                                  if (!response.ok) {
                                    throw new Error('Error fetching data');
                                  }
                                  return response.json();
                                })
                                .then(data => {
                                  // Check if department_number exists and render it
                                  const departmentNumber = data.department_number ? data.department_number + '+' : 'Data unavailable';
                                  document.querySelector('.department_number').textContent = departmentNumber;
                                })
                                .catch(error => {
                                  console.error(error);
                                  document.querySelector('.department_number').textContent = 'Error fetching data';
                                });
                            </script>

                          <p>Departments</p>
                        </article>
                        
                        <article class="achievements__card">
                            <div class="achievement__icon"><i class="uil uil-users-alt"></i></div>
                          <h3>5000+</h3>
                          <p>Students</p>
                        </article>
                      </div>
            </div>
        </div>
    </section>
    <!-- ============================ END OF ACHIEVEMENT =========================-->
 


<section class="team">
    <h2>Meet Our Team</h2>
    <div class="container team__container">
        <!-- Dynamic content will be injected here by team_members.js -->
    </div>
</section>
<!-- ============================ END OF TEAM =========================-->


     <footer>
        <div class="container footer__container">
            <div class="footer__1">
                <a href="index.html" class="footer__logo"><h4>Department Network</h4></a>
                <p>
                    Explore and discover the right department for your academic and career goals.
                </p>
            </div>

            <div class="footer__2">
              <h4>permalinks</h4>
              <u1 class="permalink">
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="department.html">Department</a></li>
                <li><a href="contact.html">Contact</a></li>
              </u1>
            </div>

            <div class="footer__3">
                <h4>primacy</h4>
                <u1 class="privacy">
                    <li><a href="#">Privacy policy</a></li>
                    <li><a href="#">Terms and Condition</a></li>
                    <li><a href="#">Refund policy</a></li>
                </u1>
            </div>

            <div class="footer__4">
                <h4>Contact Us</h4>
                <div>
                    <p>+251934567809</p>
                    <p>department@gmail.com</p>
                </div> 

                <u1 class="footer__socials">
                    <li>
                        <a href="#"><i class="uil uil-facebook-f"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="uil uil-instagram-alt"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="uil uil-twitter"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="uil uil-linkedin-alt"></i></a>
                    </li>
                </u1>
            </div>
        </div>
        <div class="footer__copyright">
            <small>Copyright &copy; Department Network YouTube</small>
         </div>
       </footer>

 
<script src="./main.js"></script>
<script src="./js/team_members.js"></script>
</body>
</html> 