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
        <title></title>
        <link rel="icon" type="image/x-icon" href="../../image/icon.jpg">
        <title>Library Of Faculty Of Exact Science</title>

        <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />


        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,600;1,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    </head>
    <style>
        <?php include('../css/consulterBooks.css'); ?>
    </style>

    <body>
        <nav>
            <a href="../../home/index.php"><img id="img" src="../../home/image/icon.jpg"></a>
            <div class="nav-links" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li>
                        <a href="../../home/index.php">Home</a>
                    </li>
                    <li>
                        <a href="contact.php#contact-us">Contact Us</a>
                    </li>
                    <li>
                        <a href="about.php#about-us">About Us</a>
                    </li>
                    <li>
                        <a href="../Acount-setting/notification.php">Notifications</a>
                    </li>
                    <li>
                        <a href="../Acount-setting/index.php">Settings</a>
                    </li>
                    <li>
                        <a href="../Acount-setting/history.php">History</a>
                    </li>
                    <li>
                        <a href="../../../private/login/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>




        <div class="icons">
            <div id="search-btn"></div>
            <div id="login-btn"></div>
        </div>



        <div class="login-form-container">
            <div id="close-login-btn"></div>
        </div>

        <?php
        if (isset($_GET['idCategorie'])) {
            include "../../../private/conn.php";
            $idCategorie = $_GET['idCategorie'];
            //  GET NAME OF Categorie
            $categorieQuery = mysqli_query($conn, "SELECT * FROM categorie");
            ?>
            <center>
                <div class="typeName">
                    <?php
                    while ($categorie = mysqli_fetch_assoc($categorieQuery)) {
                        if ($categorie['idCategorie'] == $idCategorie) {
                            ?>
                            <h1>
                                <a href="index.php?idCategorie=<?php echo $categorie['idCategorie']; ?>">
                                    <p class="p1">
                                        <?php echo $categorie['categorie'] ?>
                                    </p>
                                </a>
                            </h1>
                            <?php
                        } else {
                            ?>
                            <h1>
                                <a href="index.php?idCategorie=<?php echo $categorie['idCategorie']; ?>">
                                    <p class="p2">
                                        <?php echo $categorie['categorie'] ?>
                                    </p>
                                </a>
                            </h1>
                            <?php
                        }

                    }

                    ?>
                </div>
            </center>
            <center>
                <form action="search.php" class="search-form" method="post">
                    <input type="search" name="search" placeholder="search here..." id="live_search">
                    <input type="hidden" name="idCategorie" value="<?= $idCategorie; ?>">
                    <button type="submit" name="searchBTN"><i class="fas fa-search"></i></button>
                </form>
            </center>


            <div id="result"></div>
            <?php

            // SELECT NAME TYPE OF THIS Categorie
    
            $sql = "SELECT * FROM `typebook` WHERE typebook.idCategorie='$idCategorie'";
            $sql_run = mysqli_query($conn, $sql);


            ?>
            <div id="display">
                <?php
                if (mysqli_num_rows($sql_run) > 0) {
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($sql_run)) {
                        ?>
                        <!--section starts  -->
                        <section class="featured" id="featured">
                            <h1 class="heading"> <span>
                                    <?php echo $row['nbrTypeBook'];
                                    echo " : ";
                                    echo $row['typeBook']; ?>
                                </span> </h1>
                            <div class="swiper featured-slider">
                                <div class="swiper-wrapper">

                                    <?php
                                    $idType = $row['idType'];
                                    $sql2 = "SELECT * FROM `books` WHERE idType='$idType'";
                                    $sql_run2 = mysqli_query($conn, $sql2);
                                    if (mysqli_num_rows($sql_run2) > 0) {
                                        $count = 1;
                                        while ($row2 = mysqli_fetch_assoc($sql_run2)) {
                                            ?>
                                            <div class="swiper-slide box">
                                                <div class="image">
                                                    <?php
                                                    if ($row2['image'] == null) {
                                                        ?>
                                                        <img src="../../home/image/download.jfif">
                                                        <?php

                                                    } else {
                                                        ?>
                                                        <img src="../../admin/books/code/uploadsBook/<?php echo $row2['image'] ?>">
                                                    <?php } ?>
                                                </div>
                                                <div class="content">
                                                    <?php $idBook = $row2['idBook']; ?>
                                                    <a href="viewBook.php?idBook=<?php echo $idBook ?>&idType=<?php echo $idType ?>&idCategorie=<?php echo $idCategorie ?>"
                                                        class="btn">View</a>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>


                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </section>

                        <?php
                    }
                }


                ?>
            </div>
            
                     
            <div id="display">
                <section class="featured" id="featured">
                    <h1 class="heading"> <span>Graduation Project</span> </h1>
                    <div class="swiper featured-slider">
                        <div class="swiper-wrapper">

                        <?php
                        $gp = mysqli_query($conn, "SELECT * FROM graduation_project WHERE idCategorie=$idCategorie");
                        while ($gpRun = mysqli_fetch_assoc($gp)) {
                           
                        ?>
                            <div class="swiper-slide box">
                                <div class="image" style="height: 100px;">
                                   <h1> <?=$gpRun['title'];?></h1>
                                </div>
                                <div class="content">
                                    <a href="viewGP.php?idGP=<?=$gpRun['idGP'];?>&idCategorie=<?php echo $idCategorie ?>" class="btn">View</a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </section>
            </div>  
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
            <!-- <script>
        var idCategorie = "<?php echo $_GET['idCategorie']; ?>";
        $(document).ready(function(){
        $("#live_search").keyup(function(){
            var input = $(this).val();
                $.ajax({
                    url:"liveSearchType.php",
                    method: "POST",
                    data:{
                        input:input,
                        idCategorie: idCategorie
                    },
                    
                    success:function(data){
                        $("#result").html(data);
                        $("#display").css("display","none");
                    }
                });
            // } else{
                
            // }
        });
       });
    </script> -->

            <?php
        }

        ?>

        <!--section ends -->


        <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

        <!-- custom js file link  -->
        <script src="../js/consulterBooks.js"></script>
        <script src="../../home/script.js"></script>

    </body>

    </html>

    <?php
} else {
    header("Location: ../../home/index.php");
    exit();
}
?>