<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="image/icon.jpg">
    <title>Library Of Faculty Of Exact Science</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,600;1,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


 <!-- jQuery library -->
 <script src="https://ajax.googleapis.com/ajax/libs/
    jquery/3.3.1/jquery.min.js">
    </script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/
    popper.js/1.12.9/umd/popper.min.js">
    </script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/
    4.0.0/js/bootstrap.min.js">
    </script>

</head>

<?php
// generate token 




?>
<body>
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
                            <a href="#about-us">About Us</a>
                        </li>
                        <li>
                            <a href="#contact-us">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <i class="fa fa-bars" onclick="showMenu()"></i>
            </nav>
            <div class="text-box">
                <h1>Faculty of Exact Sciences Library</h1><br>
                <h2>University Of Mustapha Stambouli</h2><br>
                <h3>Mascara-Algeria</h3><br>
            </div>
        </section>
    <!-- content us  -->
    <section class="location">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1625.8249738861143!2d0.1288696290187977!3d35.41392636765463!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1281db53ff3b4695%3A0x2cf73146b7430843!2sBiblioth%C3%A8que!5e0!3m2!1sfr!2sdz!4v1669146566686!5m2!1sfr!2sdz" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>   
    </section>
    <section class="contact-us" id="contact-us">
        <div class="row">
            <div class="contact-col">
                <div><i class="fa fa-home"></i>
                <?php
                include('../../private/conn.php');
                $sql=mysqli_query($conn,"SELECT * FROM users WHERE userType='admin'");
                $row=mysqli_fetch_assoc($sql);
                ?>
                    <span>
                        <h5>University of Mustapha Stambouli, Mascara</h5>
                        <p><?=$row['adress'];?></p>
                    </span>
                </div>
            <div><i class="fa fa-phone"></i>
                <span>
                    <h5><?=$row['phone'];?></h5>
                    <p>Sunday to thursday,08:30AM to 4PM</p>
                </span>
            </div>
            <div><i class="fa fa-envelope-o"></i>
                <span>
                    <h5><?=$row['email'];?></h5>
                    <p>Email us your query</p>
                </span>
            </div>
        </div>
        <div class="contact-col"> 
            <!-- //" -->
        <form  method="post" action="phpMailer.php" name="formValidation" id="formValidation" onsubmit="return validateInputs()">
            <?php if (isset($_GET['error'])) { ?><p class="error"><?php echo $_GET['error']; ?></p><?php } ?>
            <?php if (isset($_GET['success'])) { ?><p class="success"><?php echo $_GET['success']; ?></p><?php } ?>
            <input type="text" name="name" id="name" placeholder="Enter Your name" class="input" >
            <span class="error2" id="nameError"></span>

            <input type="text" name="email" id="email" placeholder="Enter Your Email address" class="input" >
            <span class="error2" id="emailError"></span>

            <input type="text" name="subject" id="subject" placeholder="Enter Your subject" class="input">
            <span class="error2" id="subjectError"></span>

            <textarea row="8" name="message" id="message" placeholder="Message" class="input" ></textarea>
            <span class="error2" id="msgError"></span><br>


            <button type="submit" class="hero-btn red-btn" name="send">Send Message</button>
        </form>
    </div>

</div>
</section>
    
<section class="about-us" id="about-us">
      <div class="row">
        <div class="about-col">
            <h1>The Faculty Of Exact Sciences Library</h1>
            <p style="font-size: 25px; line-height: 1.5;">Our University library are an essential resource for students, faculty, and researchers. 
                They offer access to a wide range of academic materials, including books, journals, research databases, 
                and other resources. Additionally, university library  provide a variety of services to support academic success, 
                including research assistance, study spaces, and technology and equipment lending. Whether you're studying for an
                 exam, conducting research, or working on a project, 
                the university library is a valuable tool that can help you achieve your academic goals..</p>
            <a href="../../private/login/index.php" class="hero-btn red-btn">EXPLORE NOW</a>
        </div>
        <div class="about-col">
          <img src="image/book.gif">
        </div>
      </div>
    </section>


<section class="footer">
    <div class="icons">
        <!-- <i class="fa fa-facebook"></i>
        <i class="fa fa-twitter"></i>
        <i class="fa fa-instagram"></i>
        <i class="fa fa-linkedin"></i> -->

    </div>
    <p> created by <span>Leila & Khadidja</span> | all rights reserved</p>
    
    
</section>

<script>

    // validation form 

    const form = document.getElementById('formValidation');
        const name2 = document.getElementById('name');
        const email = document.getElementById('email');
        const subject = document.getElementById('subject');
        const msg= document.getElementById('message');
        
        const errorDisplayName = document.getElementById('nameError');
        const errorDisplayEmail = document.getElementById('emailError');
        const errorDisplaySubject = document.getElementById('subjectError');
        const errorDisplayMsg = document.getElementById('msgError');


        // form.addEventListener('submit', e => {
        //     e.preventDefault();
        
        //     validateInputs();
        // });
        
        
        
        
        function check_email(val){
            if(!val.match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)){ // Jaymon's / Squirtle's solution
            // Do something
            return false;
            }
            if( val.indexOf(' ')!=-1 || val.indexOf('..')!=-1){
            // Do something
            return false;
            }
        return true;
        }
        function validateInputs(){
            const nameValue = name2.value.trim();
            const emailValue = email.value.trim();
            const subjectValue = subject.value.trim();
            const messageValue = msg.value.trim();

            var valid = 0;
        
            if(nameValue === '') {
              errorDisplayName.innerText = 'Name is required';
              name2.style.border = '1px solid red';
              
            } else{
              errorDisplayName.innerText = '';
              name2.style.border = '1px solid green';
              valid=valid+1;
            }
        
            if(emailValue === '') {
              errorDisplayEmail.innerText = 'Email is required';
              email.style.border = '1px solid red';
            } else if (!check_email(emailValue)) {
              errorDisplayEmail.innerText = 'Provide a valid email address';
              email.style.border = '1px solid red';
            }
             else {
              errorDisplayEmail.innerText = '';
              email.style.border = '1px solid green';
              valid=valid+1;
            }
        
            if(subjectValue === '') {
              errorDisplaySubject.innerText = 'Subject is required';
              subject.style.border = '1px solid red';
            }  else {
              errorDisplaySubject.innerText = '';
              subject.style.border = '1px solid green';
              valid=valid+1;
            }
        
            if(messageValue === '') {
              errorDisplayMsg.innerText = 'Message is required';
              msg.style.border = '1px solid red';
            }else {
              errorDisplayMsg.innerText = '';
              msg.style.border = '1px solid green';
              valid=valid+1;
            }
        
            if (valid==4) {
                return true;
            }else{
                return false;
            }
        };
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery-validate.min.js"></script>
<script src="script.js"></script>  
</body>
</html>