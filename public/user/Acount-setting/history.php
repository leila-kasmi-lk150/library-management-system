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
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,600;1,700&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <style>
            .error2 {
                color: #ff312e;
                font-size: medium;
            }

            <?php include('../css/acountSetting.css'); ?>
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
                        <a href="index.php">Settings</a>
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
        $idUser = $_SESSION['idUser'];

        ?>

        <section class="section">
            <div class="main">
                <div class="sect">
                    <div class="sect-heading" style="display: flex;">
                        <h1>History</h1>
                        <div class="search-container">
                            <form action="historySearch.php" method="POST">
                                <input type="text" placeholder="Search..." name="search">
                                <button type="submit" name="searchButton"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="btns">
                        <?php if (isset($_GET['error'])) { ?>
                            <p class="error">
                                <?php echo $_GET['error']; ?>
                            </p>
                        <?php } ?>
                        <?php if (isset($_GET['success'])) { ?>
                            <p class="success">
                                <?php echo $_GET['success']; ?>
                            </p>
                        <?php } ?>
                    </div>
                    <hr>
                    <?php
                    // get book borrow 
                    $query_run = mysqli_query($conn, "SELECT * FROM borrow,books WHERE borrow.idUser=$idUser AND borrow.idBook=books.idBook");
                    while ($row = mysqli_fetch_assoc($query_run)) {
                        ?>
                        <hr size="1px" style="margin: 30px 0px 10px 0px; border: 1px solid #ddd;">
                        <div class="history" style="display: flex;">
                            <div class="imag-H">
                                <img src="../../admin/books/code/uploadsBook/<?= $row['image'] ?>" alt="" width="100%">
                            </div>
                            <div class="abuot-H">
                                <h3>
                                    <?= $row['nameBook'] ?>
                                </h3><br>
                                <h4>
                                    <?= $row['parallelTitele'] ?>
                                </h4> <br>
                                <p>
                                    <?= $row['Action'] ?> In :
                                    <?= $row['dateGet'] ?><br>
                            </div>
                            <div class="button-H">
                                <br><br><br><br>
                                <a href="../consulterBooks/viewBook.php?idCategorie=<?= $row['idCategorie'] ?>&idBook=<?= $row['idBook'] ?>&idType=<?= $row['idType'] ?>"
                                    id="ah">View</a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <hr size="1px" style="margin: 30px 0px 10px 0px; border: 1px solid #ddd; ">
                    <?php
                    // get book borrow 
                    $query_runGP = mysqli_query($conn, "SELECT * FROM borrow_gp,graduation_project WHERE borrow_gp.idUser=$idUser AND borrow_gp.idGP=graduation_project.idGP");
                    while ($row = mysqli_fetch_assoc($query_runGP)) {
                        ?>
                        <hr size="1px" style="margin: 30px 0px 10px 0px; border: 1px solid #ddd;">
                        <div class="history" style="display: flex;">
                            <div class="imag-H">
                                <img src="img2.jpg" alt="" width="100%">
                            </div>
                            <div class="abuot-H">
                                <h3>
                                    <?= $row['title'] ?>
                                </h3><br>
                                <h4>
                                    <?= $row['level'] ?>
                                    <?= $row['year'] ?>
                                </h4> <br>
                                <p>
                                    <?= $row['Action'] ?> In :
                                    <?= $row['dateGet'] ?><br>
                            </div>
                            <div class="button-H">
                                <br><br>
                                <a href="../consulterBooks/viewGP.php?idCategorie=<?= $row['idCategorie'] ?>&idGP=<?= $row['idGP'] ?>" id="ah">View</a>
                            </div>
                        </div>
                        <?php
                    }
                    if ((mysqli_num_rows($query_runGP) + mysqli_num_rows($query_run)) == 0) {
                        echo "No items";
                    }
                    ?>
                </div>
            </div>
        </section>


        <script src="../../home/script.js"></script>


    </body>

    </html>
    <?php
} else {
    header("Location: ../../home/index.php");
    exit();
}
?>