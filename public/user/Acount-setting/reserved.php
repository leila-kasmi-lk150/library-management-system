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
    <link rel="stylesheet" href="src/css/responsive.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <style>
        <?php
        include('../css/acountSetting.css');
        ?>
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
                    <a href="../../home/About.php">AboutUs</a>
                </li>
                <li>
                    <a href="../../home/contact.php">ContactUs</a>
                </li>
                <li>
                    <a href="notification.php">Notifications</a>
                </li>
                <li>
                    <a href="index.php">Settings</a>
                </li>
                <li>
                    <a href="../../../private/login/logout.php">Logout</a>
                </li>
            </ul>
        </div>
        <i class="fa fa-bars" onclick="showMenu()"></i>
    </nav>



        <!-- notification  -->
        <?php 
        include('../../../private/conn.php');
        $idUser=$_SESSION['idUser'];
        ?>
        <section class="section">
            <div class="main">
                <div class="sect" id="accountSection">
                    <div class="sect-heading">
                        <h1>Reserved Resources</h1>
                        <br>
                        <?php if (isset($_GET['error'])) { ?><p class="error"><?php echo $_GET['error']; ?></p><?php } ?>
                        <?php if (isset($_GET['success'])) { ?><p class="success"><?php echo $_GET['success']; ?></p><?php } ?>
                
                    </div>
                    <hr size="1px" style="margin: 30px 0px 10px 0px; border: 1px solid #ddd; ">
                    
                    <div class="notification-msg">
                        <?php
                        $query=mysqli_query($conn,"SELECT * FROM request,books WHERE request.idBook=books.idBook AND request.idUser='$idUser'");
                        // if(mysqli_num_rows($query) > 0)        
                        
                            $c=1;
                            while($row = mysqli_fetch_assoc($query))
                            {
                        ?>
                        
                            <i class="fa fa-bell"></i> <?php echo $c; ?> <br>
                            <p> <?php echo $row['nameBook'];?></p> 
                            <div class="noti" style="display: flex;">
                            <form action="deleteReserved.php" method="post">
                                <input type="hidden" name="idR" value="<?php echo $row['idR']; ?>">
                                <input type="hidden" name="idBook" value="<?php echo $row['idBook']; ?>">
                                <button type="submit" id="btn-N" class="delet-btn" name="deletR" onclick="return confirm('are you sure you want to delete this request ?')">Delete</button>
                            </form>
                             <button id="btn-N" class="get-btn"><a  href="../consulterBooks/viewBook.php?idBook=<?php echo $row['idBook']; ?>&idType=<?php echo $row['idType']; ?>&idCategorie=<?php echo $row['idCategorie']; ?>">Get It</a></button>
                             </div>
                             <br>
                             
                             <?php  $c++; }
                             $queryGP=mysqli_query($conn,"SELECT * FROM graduation_project,request_gp WHERE graduation_project.idGP=request_gp.idGP AND request_gp.idUser='$idUser'");
                            // if(mysqli_num_rows($query) > 0)        
                        
                                
                                while($row = mysqli_fetch_assoc($queryGP))
                                {
                            ?>
                        
                                <i class="fa fa-bell"></i> <?php echo $c; ?> <br>
                                <p> <?php echo $row['title']; echo " to "; echo $row['Action'];?></p> 
                                <div class="noti" style="display: flex;">
                                    <form action="deleteReserved.php" method="post">
                                        <input type="hidden" name="idRGP" value="<?php echo $row['idRGP']; ?>">
                                        <input type="hidden" name="idGP" value="<?php echo $row['idGP']; ?>">
                                        <button type="submit" id="btn-N" class="delet-btn" name="deletNGP" onclick="return confirm('are you sure you want to delete ?')">Delete</button>
                                    </form>
                                    <button id="btn-N" class="get-btn"><a  href="../consulterBooks/viewGP.php?idCategorie=<?= $row['idCategorie'] ?>&idGP=<?= $row['idGP'] ?>">Get It</a></button>
                                </div>
                             <br>
                             
                             <?php  $c++; }


                             
                             if((mysqli_num_rows($query)+mysqli_num_rows($queryGP))==0){ ?>
                                <i class="fa fa-bell"></i> 0 <br>
                                <p> No Items</p> <br>
                                <?php }?>
                            <hr size="1px" style="margin: 30px 0px 10px 0px;">
                            
                        </div>
                    </div>
                </div>
            </section>



<!-- -------JavaScript To toggle menu -->
<script src="../js/script.js"></script> 
</body>
</html>

<?php
if (isset($_POST['deletN'])) {
    $idN=$_POST['idN'];
    $q=mysqli_query($conn,"DELETE FROM notifications WHERE idN='$idN' ");
}
}else{
    header("Location: ../../home/index.php");
    exit();
  }
?>