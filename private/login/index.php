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
            <p class="title">Welcome back</p>
            <div class="separator"></div>
            <p class="welcome-message">Please, provide login credential to proceed and have access to all our services</p>
            
            <form class="login-form" action="loginCode.php" method="post" id="formValidation">
                <?php if (isset($_GET['error'])) { ?>
     			    <p class="error"><?php echo $_GET['error']; ?></p>
     		    <?php } ?>
                 <?php if (isset($_GET['success'])) { ?>
     			    <p class="success"><?php echo $_GET['success']; ?></p>
     		    <?php } ?>
                <div class="form-control">
                    <input type="text" placeholder="Email" name="email" required>
                    <i class="fa fa-envelope"></i>
                </div>
                <div class="form-control">
                    <input type="password" placeholder="Password" name="passWord" required>
                    <i class="fas fa-lock"></i>
                </div>
                <div style="display:flex; margin-left: 15px;">
                <a style="margin-left:15px; margin-right:10px;" href="logout.php" style="margin-right:12px;">Home</a><a href="forgetPassword.php">Forget Your Password?</a>
                </div>
                <button type="submit" class="submit" name="submit">Login</button>
            </form>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="../assets/loginValidation.js"></script>
</body>
</html>