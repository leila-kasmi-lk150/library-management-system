<?php
session_start(); 
include "../conn.php";

require '../phpMailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../phpMailer/vendor/phpmailer/phpmailer/src/SMTP.php';
require '../phpMailer/vendor/phpmailer/phpmailer/src/Exception.php';


require '../phpMailer/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['submit'])) {
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    // $email = $_POST['email'];

    $check_email = "SELECT * FROM users WHERE email='$email'";
    $run_sql = mysqli_query($conn, $check_email);

    if(mysqli_num_rows($run_sql) > 0){
        
        $code = rand(999999, 111111);
        $insert_code = "UPDATE users SET code = $code WHERE email = '$email'";

        $run_query =  mysqli_query($conn, $insert_code);

        if($run_query){
        // To PHPMailer function work , you must enable the passwordapp feature in your email 
        // Watch this video for more understanding (if it has not been deleted by the channel owner)
        // https://youtu.be/mte7LroYd74

        // https://youtu.be/maYnD0Sdr7c
        // if you have any question , do not hesitate to contact me leilakasmi150@gmail.com

            $subject = "Password Reset Code";
            $message = "Your password reset code is $code";



            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = "true";
            
            $mail->Username = '';
            $mail->Password = '';
            $mail->SMTPSecure = 'tls'; //sll
            $mail->Port = 587; //465
            
            $mail->setFrom('','meesage univ mascara libray');
            $mail->addAddress($email);
            $mail->subject= $subject;
            $mail->Body = $message;
            
            
            if($mail->send()){
                header("location: getCode.php?success=We have sent a passwrod reset to your email - $email");
                exit();
            }else{
                header('location: forgetPassword.php?error=Failed while sending code! , look to the code , in the comment');
                exit();
            }
        }else{
            header('location: forgetPassword.php?error=Something went wrong!');
                exit();
        }

    }
    else{
        header("Location: forgetPassword.php?error=This email address does not exist!");
	    exit();
    }

    ?>


<?php
}
?>
   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <title>Login landing page | library</title>
    <link rel="icon" type="image/x-icon" href="../../public/home/image/icon.jpg">
</head>
<body>

<style>

.success {
    color: green;
    margin: 5px;
    margin-left: 15px;
  }
</style>
    
    <section class="side">
        <img src="assets/Library.svg" alt="">
    </section>
    
    <section class="main">
        <div class="login-container">
            <p class="title"><h1>Code Verification</h1></p>
            <div class="separator"></div>
            <p class="welcome-message"> <?php if (isset($_GET['success'])) { ?><p class="success"><?php echo $_GET['success']; ?></p><?php } ?></p>
            
            
            <form class="login-form" action="newPassword.php" method="post" id="formValidation">
                <?php if (isset($_GET['error'])) { ?>
     			    <p class="error"><?php echo $_GET['error']; ?></p>
     		    <?php } ?>
                 <div class="form-control">
                    <input type="text" placeholder="Enter code" name="otp" required>
                    <i class="fa fa-envelope-open"></i>
                </div>
                <div style="display:flex; margin-left: 15px;">
                <a style="margin-left:15px; margin-right:10px;" href="logout.php" style="margin-right:12px;">Home</a>
                </div>
                <button type="submit" class="submit" name="check-reset-otp">Continue</button>
            </form>
        </div>
    </section>


    <?php

    
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="../assets/loginValidation.js"></script>
</body>
</html>

