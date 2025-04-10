<?php
    session_start();
    if (isset($_SESSION['idUser'])) {
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../image/icon.jpg">
    <title>Library Of Faculty Of Exact Science</title>
    <link rel="stylesheet" href="../css/acountSetting.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <style>

.upload{
  width: 100px;
  position: relative;
  margin-right: 60px;
}

.upload img{
  border-radius: 50%;
  border: 8px solid #DCDCDC;
  width: 90px;
  height: 90px;
}

.upload .round{
  position: absolute;
  bottom: 0;
  right: 0;
  background: #00B4FF;
  width: 32px;
  height: 32px;
  line-height: 33px;
  text-align: center;
  border-radius: 50%;
  overflow: hidden;
}

.upload .round input[type = "file"]{
  position: absolute;
  transform: scale(2);
  opacity: 0;
}

input[type=file]::-webkit-file-upload-button{
    cursor: pointer;
}



        .error2{
            color: #ff312e;
    font-size: medium;
  }
  .conn-btn #view{
    text-decoration: none;
    border: none;
    background-color: #0a6cff;
    padding: 8px 25px;
    color: black;
    font-size: 15px;
    font-weight: 600;
    border-radius: 6px;
    box-shadow: 0px 0px 11px -4px rgb(162 162 162 / 50%);
    cursor: pointer;
}
.conn-btn #view:hover{
    background-color: #000;
    color: white;
}
    </style>
        <nav>
              <a href="../../home/index.php"><img id="img" src="../../home/image/icon.jpg"></a>
              <div class="nav-links" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li>
                        <a href="../../home/index.php">Home</a>
                    </li>
                    <li>
                        <a href="../../home/contact.php#about">About Us</a>
                    </li>
                    <li>
                        <a href="../../home/contact.php#contact">Contact Us</a>
                    </li>
                    <li>
                        <a href="notification.php">Notifications</a>
                    </li>
                    <li>
                        <!-- <a href="index.php">Settings</a> -->
                    </li>
                    <li>
                        <a href="../../../private/login/logout.php">Logout</a>
                    </li>
                </ul>
              </div>
              <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>

        <?php
        include('../../../private/conn.php');
        $idUser=$_SESSION['idUser'];
        $query_run = mysqli_query($conn, "SELECT * FROM users WHERE idUser=$idUser");
        foreach($query_run as $row)
        {
            ?>

            
        
        <section class="section">
            <div class="main">
                <!-- Account Section -->
                <div class="sect">
                    <div class="sect-heading">
                        <h1>Account</h1>
                    </div>
                    <div class="sect-avatar">
                        <div class="sect-avatar-img">
                        <form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
                        <div class="upload">
                            <?php
                            // $id = $user["id"];
                            // $name = $user["name"];
                            // $image = $user["image"];
                            $image=$row['imageUser'];
                            ?>
                            <img src="../../admin/member/code/uploadsMember/<?php echo $row['imageUser']; ?>"   title="<?php echo $image; ?>">
                            <!-- <img src="../../admin/member/code/uploadsMember< ?php echo $row['imageUser']; ?>" > -->
                            <div class="round">
                            <input type="hidden" name="idUser" value="<?php echo $_SESSION['idUser']; ?>">
                            <input type="hidden" name="oldImg" value="<?php echo $row['imageUser']; ?>">
                            <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png">
                            <input type="hidden" name="name" value="<?php echo $row['firstName']; ?>">
                            <i class = "fa fa-camera" style = "color: #fff;"></i>
                            </div>
                        </div>
                        </form>
                            
                        </div>
                        <div class="name-bio">
                            <p class="user-name" id="userNameAccount"> <?php echo $row['firstName']; echo " ";  echo $row['lastName'];?> </p>
                            <p class="bio" id="UserBioAccount"> Student <?php echo $row['specialty']; echo " ";  echo $row['level'];?> </p>
                        </div>
                    </div>
                    <div class="btns">
                    <?php if (isset($_GET['error'])) { ?><p class="error"><?php echo $_GET['error']; ?></p><?php } ?>
                    <?php if (isset($_GET['success'])) { ?><p class="success"><?php echo $_GET['success']; ?></p><?php } ?>
                
                    </div>
                    <hr >
                    <hr size="1px" style="margin: 30px 0px 10px 0px; border: 1px solid #ddd;">
                    <div class="account-edit-form">
                    <!-- editAccount.php -->
                        <form action="editAccount.php" class="acc-edit-frm" method="post" name="formValidation" id="formValidation" onsubmit="return validateInputs()">
                            <input type="hidden" name="idUser" value="<?php echo $row['idUser'] ?>">
                            <div class="form-1">
                                <div class="inner-form-1">
                                    <p>Email <span class="error2" id="emailError"></span></p>
                                    <input type="text" name="email" value="<?php echo $row['email'] ?>">
                                    
                                </div>
                                <div class="inner-form-2">
                                    <p>Phone <span class="error2" id="phoneError"></span></p>
                                    <input type="text" id="phone" name="phone" value="<?php echo $row['phone'] ?>" >
                                    
                                </div>
                            </div>
                            <div class="form-2">
                                <div class="inner-form-2-1">
                                    <p>Password <span class="error2" id="passwordError"></span></p>
                                    <input type="password" id="password" name="pw" value="<?php echo $row['passWord'] ?>">
                                    
                                </div>
                                <div class="inner-form-2-2">
                                    <p>Adress <span class="error2" id="adressError"></span></p>
                                    <input type="text" id="adress" name="adress" value="<?php echo $row['adress'] ?>">
                                    
                                </div>
                            </div>
                            <div class="save-btn">
                            <input type="submit" value="Save" class="save-bbtn" name="saveProfile">
                        </div>
                        </form>
                        <hr size="1px" style="margin: 30px 0px 10px 0px; border: 1px solid #ddd;">
                            <div class="history">
                                <div class="headings">
                                    <h1>History</h1>
                                </div>
                                <div class="acc-history">
                                    <div class="history-acc">
                                        <p>You can see your history</p>
                                    </div>
                                    <div class="conn-btn">
                                        <a href="history.php" style="color:white;" id="view">View</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr size="1px" style="margin: 30px 0px 10px 0px; border: 1px solid #ddd; ">
                        <div class="history">
                                <div class="headings">
                                    <h1>Saved</h1>
                                </div>
                                <div class="acc-history">
                                    <div class="history-acc">
                                        <p>Book and graduation projects saved</p>
                                    </div>
                                    <div class="conn-btn">
                                        <a href="sived.php" id="view" style="color:white;">View</a>
                                    </div>
                                </div>
                        </div>
                        <hr size="1px" style="margin: 30px 0px 10px 0px; border: 1px solid #ddd; ">
                        <div class="history">
                                <div class="headings">
                                    <h1>Reserved resources</h1>
                                </div>
                                <div class="acc-history">
                                    <div class="history-acc">
                                        <p>You can see resources that you reserved</p>
                                    </div>
                                    <div class="conn-btn">
                                        <a href="reserved.php" id="view" style="color:white;">View</a>
                                    </div>
                                </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
        <?php
        }

        ?>

<script src="../../home/script.js"></script>  

<script type="text/javascript">
      document.getElementById("image").onchange = function(){
          document.getElementById("form").submit();
      };
</script>

<?php
    if(isset($_FILES["image"]["name"])){
      $idUser = $_POST["idUser"];
      $name = $_POST["name"];
      $oldImg= $_POST['oldImg'];
      unlink('../../admin/member/code/uploadsMember/' . $oldImg);

      $imageName = $_FILES["image"]["name"];
      $imageSize = $_FILES["image"]["size"];
      $tmpName = $_FILES["image"]["tmp_name"];

      // Image validation
      $validImageExtension = ['jpg', 'jpeg', 'png'];
      $imageExtension = explode('.', $imageName);
      $imageExtension = strtolower(end($imageExtension));
      
     {
        $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
        $newImageName .= '.' . $imageExtension;
        $query = "UPDATE users SET imageUser = '$newImageName' WHERE idUser = '$idUser'";
        mysqli_query($conn, $query);
        move_uploaded_file($tmpName, '../../admin/member/code/uploadsMember/' . $newImageName);
        echo
        "
        <script>
        document.location.href = 'index.php';
        </script>
        ";
      }
    }
    ?>
</body>
</html>
<?php
}else{
    header("Location: ../../home/index.php");
    exit();
  }
?>