<?php
session_start(); 
include "../conn.php";
if(isset($_POST['check-reset-otp'])){
    $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
    $check_code = "SELECT * FROM users WHERE code = $otp_code";
    $code_res = mysqli_query($conn, $check_code);
    if(preg_match('/^\d+$/',$otp_code) && mysqli_num_rows($code_res) > 0){
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['email'];
        $idUser = $fetch_data['idUser'];
        $_SESSION['email'] = $email;
        $_SESSION['idUser'] = $idUser;
        header("location: newPassword.php?success=Please create a new password that you don't use on any other site.");
        exit();
    }else{
        header("location: getCode.php?error=You've entered incorrect code!");
        exit();
    }
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
<style>
    .success {
    color: green;
    margin: 5px;
    margin-left: 15px;
  }
</style>
<body>
    
    <section class="side">
        <img src="assets/Library.svg" alt="">
    </section>
    
    <section class="main">
        <div class="login-container">
            <p class="title"><h1>Create a New Password</h1></p>
            <div class="separator"></div>
            <p class="welcome-message"> <?php if (isset($_GET['success'])) { ?><p class="success"><?php echo $_GET['success']; ?></p><?php } ?></p>
            
            
            <form class="login-form" action="newPassword.php" method="post" id="formValidation">
                <?php if (isset($_GET['error'])) { ?>
     			    <p class="error"><?php echo $_GET['error']; ?></p>
     		    <?php } ?>
                <div class="form-control">
                    <input type="password" placeholder="Create new password" name="password" required>
                    <i class="fas fa-lock"></i>
                </div>
                <div class="form-control">
                    <input type="password" placeholder="Confirm your password" name="cpassword" required>
                    <i class="fas fa-lock"></i>
                </div>
                <div style="display:flex; margin-left: 15px;">
                <a style="margin-left:15px; margin-right:10px;" href="logout.php" style="margin-right:12px;">Home</a>
                </div>
                <button type="submit" class="submit" name="change-password">Change</button>
            </form>
        </div>
    </section>


    <?php

//if user click change password button
if(isset($_POST['change-password'])){
    $idUser=$_SESSION['idUser'];
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    if($password !== $cpassword){
        header("location: newPassword.php?error=Confirm password not matched!");
        exit();
    }else{
        $code = 0;
        $email = $_SESSION['email']; //getting this email using session
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $update_pass = "UPDATE users SET code = $code, passWord = '$password' WHERE email = '$email'";
        $run_query = mysqli_query($conn, $update_pass);
        if($run_query){
            header("location: index.php?success=Your password changed. Now you can login with your new password.");
            exit();
        }else{
            header("location: newPassword.php?error=Failed to change your password!");
            exit();
        }
    }
}
?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="../assets/loginValidation.js"></script>
</body>
</html>