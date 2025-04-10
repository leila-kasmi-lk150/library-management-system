<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="image/icon.jpg">
    <title>Faculty Of Exact Sciences Library</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

    <body>
    <?php
    session_start();
    if (isset($_SESSION['idUser']) && $_SESSION['userType']!='admin') {
        
    
        ?>
        <style>
    <?php
    include('style.css');

    ?>
</style>
         <section class="header">
            <nav>
                <a href="index.php"><img id="img" src="image/icon.jpg"></a>
                <div class="nav-links" id="navLinks">
                    <i class="fa fa-times" onclick="hideMenu()"></i>
                    <ul>
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="contact.php#about-us">AboutUs</a>
                        </li>
                        <li>
                            <a href="contact.php#contact-us">Contact Us</a>
                        </li>
                        <li>
                            <a href="../../private/login/logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
                <i class="fa fa-bars" onclick="showMenu()"></i>
            </nav>
            <div class="text-box">
                <h1> Faculty Of Exact Sciences Library</h1><br>
                <h2>University Of Mustapha Stambouli</h2><br>
                <h3>Mascara Algeria</h3><br>
                <p>Welcome to the Faculty of Exact Sciences Library<br>  Maths, computer science, Physics and Chemistry </p>
                <br><br><br>
                <a href="../user/Acount-setting/index.php"class="hero-btn">My Account</a>
            </div>
        </section>
    
    <!-- services -->
    <section class="services">
        <h1 class="heading"> Our <span>Services</span> </h1>
        <p>we are here to support you at everytime you need help.</p>
    
        
            
        <div class="row">
             <div class="services-col">
                <h3>Borrowing And Lending</h3>
                <p>Our University librarie  allow students, faculty, and staff to borrow books.
                     We can also facilitate interlibrary 
                    loan services to obtain materials not held within their own collections.
                </p>
            </div>
            <div class="services-col">
                <h3>Research Assistance</h3>
                <p>Our university librarie offer research assistance services,
                     including help with finding and using resources, 
                    citation management, and research consultations with librarians.
                </p>
            </div>
            <div class="services-col">
                <h3>And More...</h3>
                <p>Overall, the services of our university library are designed to support the academic
                     and research needs of the university community, 
                    and to provide a comfortable and productive environment for studying, learning and research.
                </p>
            </div>
    
        </div>
    </section>
      
      <!-- books section starts  -->
      <center>
      <section class="books" id="books">
        <h1 class="heading"> Library <span>Catalog</span> </h1>
        <div class="box-container">
            <div class="box">
                <div class="image">
                    <img src="image/info.jpg" alt="">
                </div>
                <center>
                    <div class="content">
                        <h3>Info</h3>
                        <a href="../user/consulterBooks/index.php?idCategorie=1" class="btn"> Show Book <span class="fas fa-chevron-right"></span> </a>
                    </div>
                </center>
            </div>
            
            <div class="box">
                <div class="image">
                    <img src="image/maths.jpg" alt="">
                </div>
                <center>
                    <div class="content">
                        <h3>Maths</h3>
                        <a href="../user/consulterBooks/index.php?idCategorie=2" class="btn"> Show Book  <span class="fas fa-chevron-right"></span> </a>
                    </div>
                </center>
            </div>
            
            <div class="box">
                <div class="image">
                    <img src="image/physique.jpg" alt="">
                </div>
                <center>
                    <div class="content">
                        <h3>Physics</h3>
                        <a href="../user/consulterBooks/index.php?idCategorie=3" class="btn"> Show Book  <span class="fas fa-chevron-right"></span> </a>
                    </div>
                </center>
            </div>
            
            <div class="box">
                <div class="image">
                    <img src="image/chimie.jpg" alt="">
                </div>
                <center>
                    <div class="content">
                        <h3>Chimie</h3>
                        <a href="../user/consulterBooks/index.php?idCategorie=4" class="btn"> Show Book  <span class="fas fa-chevron-right"></span> </a>
                    </div>
                </center>
            </div>
        </div>
        
    </center>
        <!-- CallTO Action -->
        <section class="cta">
            <h1>For Any Queries</h1>
            <a href="contact.php#contact-us"class="hero-btn">Contact Us</a>
            <!-- AboutUs -->
        </section>
        
        <section class="footer">
            <div class="icons">
            </div>
            <p>created by <span>Leila & Khadidja</span> | all rights reserved</p>
        </section>
    
    <!-- --------->
    <script src="script.js"></script>  

    
<?php
}else{
    
    ?>
    <style>
    <?php
    include('style.css');

    ?>
</style>
     <section class="header">
            <nav>
                <a href="index.php"><img id="img" src="image/icon.jpg"></a>
                <div class="nav-links" id="navLinks">
                    <i class="fa fa-times" onclick="hideMenu()"></i>
                    <ul>
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="contact.php#about-us">About Us</a>
                        </li>
                        <li>
                            <a href="contact.php#contact-us">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <i class="fa fa-bars" onclick="showMenu()"></i>
            </nav>
            <div class="text-box">
                <h1>Faculty Of Exact Sciences Library</h1><br>
                <h2>University Of Mustapha Stambouli</h2><br>
                <h3>Mascara-Algeria</h3><br>
                <p>Welcome to the Faculty of Exact Sciences Library<br>  Maths, computer science, Physics and Chemistry </p>
                <br><br><br>
                <a href="../../private/login/index.php"class="hero-btn"> Login</a>
            </div>
        </section>
    
    <!-- services -->
    <section class="services">
        <h1 class="heading"> Our <span>Services</span> </h1>
        <p>we are here to support you at everytime you need help.</p>
    
        
            
        <div class="row">
             <div class="services-col">
                <h3>Borrowing And Lending</h3>
                <p>Our University librarie  allow students, faculty, and staff to borrow books.
                     We can also facilitate interlibrary 
                    loan services to obtain materials not held within their own collections.
                </p>
            </div>
            <div class="services-col">
                <h3>Research Assistance</h3>
                <p>Our university librarie offer research assistance services,
                     including help with finding and using resources, 
                    citation management, and research consultations with librarians.
                </p>
            </div>
            <div class="services-col">
                <h3>And More...</h3>
                <p>Overall, the services of our university library are designed to support the academic
                     and research needs of the university community, 
                    and to provide a comfortable and productive environment for studying, learning and research.
                </p>
            </div>
    
        </div>
    </section>
      
      <!-- books section starts  -->
      <center>
      
      <section class="books" id="books">
        <h1 class="heading"> Library <span>Catalog</span> </h1>
        <div class="box-container">
            <div class="box">
                <div class="image">
                    <img src="image/info.jpg" alt="">
                </div>
                <center>
                    <div class="content">
                        <h3>Info</h3>
                        <a href="../../private/login/index.php" class="btn"> Show Book <span class="fas fa-chevron-right"></span> </a>
                    </div>
                </center>
            </div>
            
            <div class="box">
                <div class="image">
                    <img src="image/maths.jpg" alt="">
                </div>
                <center>
                    <div class="content">
                        <h3>Maths</h3>
                        <a href="../../private/login/index.php" class="btn"> Show Book  <span class="fas fa-chevron-right"></span> </a>
                    </div>
                </center>
            </div>
            
            <div class="box">
                <div class="image">
                    <img src="image/physique.jpg" alt="">
                </div>
                <center>
                    <div class="content">
                        <h3>Physics</h3>
                        <a href="../../private/login/index.php" class="btn"> Show Book  <span class="fas fa-chevron-right"></span> </a>
                    </div>
                </center>
            </div>
            
            <div class="box">
                <div class="image">
                    <img src="image/chimie.jpg" alt="">
                </div>
                <center>
                    <div class="content">
                        <h3>Chimie</h3>
                        <a href="../../private/login/index.php" class="btn"> Show Book  <span class="fas fa-chevron-right"></span> </a>
                    </div>
                </center>
            </div>
        </div>
</section>
</center>
        
        <!-- CallTO Action -->
        <section class="cta">
            <h1>For Any Queries</h1>
            <a href="contact.php#contact-us"class="hero-btn" >Contact Us</a>
            <!-- AboutUs -->
        </section>
        
        <section class="footer">
            <div class="icons">
            </div>
            <p>created by <span>Leila & Khadidja</span> | all rights reserved</p>
        </section>
    
    <!-- --------->
    <script src="script.js"></script>  
    <?php

}
?>

</body>
</html>