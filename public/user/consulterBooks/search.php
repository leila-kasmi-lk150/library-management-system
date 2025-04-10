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
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,600;1,700&display=swap"
            rel="stylesheet">
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
                <i class="fa fa-times" onclick='hideMenu()'></i>
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

        <?php
        if (isset($_POST['searchBTN'])) {
            include "../../../private/conn.php";
            $search = $_POST['search'];
            $idCategorie = $_POST['idCategorie'];
            ?>
            <div class="icons">
                <div id="search-btn"></div>
                <div id="login-btn"></div>
            </div>
            <div class="login-form-container">
                <div id="close-login-btn"></div>
            </div>

            <?php 
                //  GET NAME OF Categorie
                $categorieQuery = mysqli_query($conn, "SELECT * FROM categorie");
                ?>
                <center>
                    <div class="typeName">
                        <?php
                        while ($categorie = mysqli_fetch_assoc($categorieQuery)) {
                            if ($categorie['idCategorie'] == $idCategorie) {
                                ?>
                               
                                    <a href="index.php?idCategorie=<?php echo $categorie['idCategorie']; ?>">
                                        <p class="p1">
                                            <?php echo $categorie['categorie'] ?>
                                        </p>
                                    </a>
                                
                                <?php
                            } else {
                                ?>
                               
                                    <a href="index.php?idCategorie=<?php echo $categorie['idCategorie']; ?>">
                                        <p class="p2">
                                            <?php echo $categorie['categorie'] ?>
                                        </p>
                                    </a>
                                
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
                $sql = "SELECT * FROM `typebook` WHERE idCategorie='$idCategorie' AND typeBook LIKE '%$search%' OR nbrTypeBook LIKE '%$search%'";
                $sql_run = mysqli_query($conn, "SELECT * FROM `typebook` WHERE idCategorie='$idCategorie' AND typeBook LIKE '%$search%' OR nbrTypeBook LIKE '%$search%'");
                ?>
                <div id="display">
                    <?php
                    if (mysqli_num_rows($sql_run) > 0)
                     {
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


                <!-- search book  -->
                <?php
                $sqlBook = mysqli_query($conn,"SELECT * FROM books WHERE idCategorie='$idCategorie' AND nameBook LIKE '%$search%' OR isbn LIKE '%$search%' OR parallelTitele LIKE '%$search%'");
                if (mysqli_num_rows($sqlBook)) {
                    ?>
                    <hr size="1px" style="margin: 30px 0px 10px 0px; border: 1px solid #ddd;">
                    <?php
                while ($rowBook = mysqli_fetch_assoc($sqlBook)) {
                ?>
                            
                            <center>
                            <hr size="1px" style="margin: 30px 0px 10px 0px; border: 1px solid #ddd; width: 50%;">
                            <div class="history" style="display: flex;">
                                <div class="imag-H">
                                    <img src="../../admin/books/code/uploadsBook/<?= $rowBook['image'] ?>" alt="" width="100%">
                                </div>
                                <div class="abuot-H">
                                    <h1>
                                        <?= $rowBook['nameBook'] ?>
                                    </h1><br>
                                    <h2>
                                        <?= $rowBook['parallelTitele'] ?>
                                    </h2> <br>
                                    <h3>
                                        ISBN : <?= $rowBook['isbn'] ?> <br>
                                    </h3>
                                </div>
                                <div class="button-H">
                                    <br><br><br><br>
                                    <a href="viewBook.php?idCategorie=<?= $rowBook['idCategorie'] ?>&idBook=<?= $rowBook['idBook'] ?>&idType=<?= $rowBook['idType'] ?>"
                                        id="ah">View</a>
                                </div>
                            </div>
                            </center>
                <?php
                }
                }

                // Search GP
                $sqlGP = mysqli_query($conn,"SELECT * FROM graduation_project WHERE title LIKE '%$search%' AND idCategorie='$idCategorie' ");
                while ($rowGP = mysqli_fetch_assoc($sqlGP)) {
                    $idGP=$rowGP['idGP'];
                    ?>
                    <center>
                    <hr size="1px" style="margin: 30px 0px 10px 0px; border: 1px solid #ddd; width: 50%">
                    <div class="history" style="display: flex;">
                        <div class="imag-H">
                            <img src="../Acount-setting/img2.jpg" alt="" width="100%">
                        </div>
                        <div class="abuot-H">
                            <h1>
                                <?= $rowGP['title'] ?>
                            </h1><br>
                            <h2>
                                <?= $rowGP['level'] ?>
                                <?= $rowGP['year'] ?>
                            </h2> <br>
                        </div>
                        <div class="button-H">
                            <br><br>
                            <a href="viewGP.php?idCategorie=<?=$idCategorie?>&idGP=<?=$idGP?>" id="ah">View</a>
                        </div>
                    </div>
                    </center>
                    <?php
                }
                if ((mysqli_num_rows($sqlBook) + mysqli_num_rows($sqlGP)+ mysqli_num_rows($sql_run)) == 0) {
                    ?>
                    <center>
                        <div style="width: 52%; background-color: #e9e9e9; padding: 35px; margin: 30px;border-radius: 10px;">
                        <h1>No items</h1>
                        </div>
                    </center>
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
        }
} else {
    header("Location: ../../home/index.php");
    exit();
}
?>