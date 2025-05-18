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
 



    <!--SWIPER JS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>


    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
     <nav>
        <div class="container nav_container">
            <a href="index.html"><h4>DEPARTMENT NETWORK</h4></a>
            <u1 class="nav__menu">
               <li><a href="index.html">Home</a></li>
               <li><a href="about.php">About</a></li>  
               <li><a href="department.php">Department</a></li>  
               <li><a href="contact.php">Contact</a></li>  
               <li><a href="dashbord.php">Dashboard</a></li>  
               <li><a href="http://localhost:8000/frontend/login.php">login</a></li>
               <li><a href="http://localhost:8000/frontend/signup.php">signup</a></li>
               <li><a href="http://localhost:8000/backend/controllers/logout.php">logout</a></li>
             
            </u1>
            <button id="open-menu-btn"><i class="uil uil-bars"></i></button>
            <button id="close-menu-btn"><i class="uil uil-multiply"></i></button>
        </div>
     </nav>
     <!--=================== END OF NAVBAR====================-->
    
     



     <header>
        <div class="container header__container">
            <div class="header_left">
                <h1>Carefully choose your department to secure a bright future.</h1>
                <p>Choosing the right department is crucial for your career. Assess your interests, research options, and seek advice to make an informed decision. A thoughtful choice can lead to a fulfilling future.</p>
                <a href="department.html" class="btn btn-primary">Get started</a>
            </div>
            <div class="header__right">
                <div class="header__right-image">
                    <img src="./image/header.jpg" alt="Department illustration">
                </div>
            </div>
        </div>

     </header>
     <!--=================== END OF HEADER =================-->





     <section class="categories">
        <div class="container categories__container">
            <div class="categories__left">
                <h1>categories</h1>
                <p>
                    As a freshman at AASTU, choosing the right department is key to building a successful career. Our Department Recommendation Tool helps you explore fields in engineering, science, and technology, highlighting skills, course content, and career paths for each option.
                </p>
                <a href="#" class="btn"> Learn more </a>
            </div>
            <div class="categories__right">

            </div>
        </div>
     </section><script src="http://localhost:8000/frontend/js/category.js"></script>


     <!--===================== END OF CATEGORIES =============-->
    
     <h1 class="popular-departments-title">Popular Departments</h1>
<div id="popular-departments" class="container department__container">
    <!-- Popular departments will be rendered here -->
</div>

<!-- Include the JavaScript file -->
<script src="http://localhost:8000/frontend/js/popularDepartment.js"></script>
          <!---==============END OF DEPARTMENT ============-->



          <section class="faqs">
            <h2>Frequently Asked Questions</h2>
            <div class="container faqs__container">
                <!-- FAQs will be dynamically rendered here -->
            </div>
        </section>
        <script src="http://localhost:8000/frontend/js/mainQuestion.js"></script>
     



            


           <section class="container testimonial__container mySwiper">
               <h2>Students' Testimonials</h2>
               <div class="swiper-wrapper">
                   <article class="testimonial swiper-slide">
                       <div class="avatar">
                           <img src="./image/email.jpg">
                       </div>
                        <div class="testimonial__info">
                            <h5> Hana Gizaw</h5>
                            <small>student</small>
                        </div>
                        <div class="testimonial__body">
                            <p>
                                This Website made it easy to explore departments and find the right fit for me. It’s a great tool for making informed decisions about my academic future!
                            </p>
                        </div>
                   </article>

                   <article class="testimonial swiper-slide">
                    <div class="avatar">
                        <img src="./image/email1.png">
                    </div>
                     <div class="testimonial__info">
                         <h5> Abel T</h5>
                         <small>student</small>
                     </div>
                     <div class="testimonial__body">
                         <p>
                            Using this app, I was able to quickly compare departments and their career options. It made my decision-making process much clearer and easier.
                         </p>
                     </div>
                </article>

                <article class="testimonial swiper-slide">
                    <div class="avatar">
                        <img src="./image/email2.png">
                    </div>
                     <div class="testimonial__info">
                         <h5> Sol Gb</h5>1  
                         <small>student</small>
                     </div>
                     <div class="testimonial__body">
                         <p>
                            Exploring departments through this website was incredibly helpful. It offered all the details I needed, making it easier to choose the right path for my future.
                         </p>
                     </div>
                </article>

                <article class="testimonial swiper-slide">
                    <div class="avatar">
                        <img src="./image/email3.png">
                    </div>
                     <div class="testimonial__info">
                         <h5> Mercy Eyasu</h5>
                         <small>student</small>
                     </div>
                     <div class="testimonial__body">
                         <p>
                            This website provided a detailed look at various departments and their career prospects, making it a valuable tool in helping me make informed academic choices.
                         </p>
                     </div>
                </article>

                <article class="testimonial swiper-slide">
                    <div class="avatar">
                        <img src="./image/email4.jpg">
                    </div>
                     <div class="testimonial__info">
                         <h5> Rediet B</h5>
                         <small>student</small>
                     </div>
                     <div class="testimonial__body">
                         <p>
                            Thanks to this website, I was able to easily explore the various departments and understand what they entail, allowing me to make a confident decision about my academic journey.
                         </p>
                     </div>
                </article>

               </div>
               <div class="swiper-pagination"></div>
           </section>
           <!--============== END OF TESTIMONIALS ============-->




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







     <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
     <script src="./main.js"></script>



     <script>
        
        var swiper = new Swiper(".mySwiper", {
          slidesPerView: 3,
          spaceBetween: 30,
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
          },
          
          breakpoints: {
               600:{
                    slidesPerview: 2
               }
          }
        });
      </script>

<script src="./js/popularDepartments.js"></script>
</body>
</html> 