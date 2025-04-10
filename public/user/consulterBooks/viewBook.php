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
                    <title>view Book</title>
                    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,600;1,700&display=swap" rel="stylesheet">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
                    <!-- custom css file link  -->
                    <link rel="stylesheet" href="../css/view.css">
                    <link rel="stylesheet" href="../css/consulterBooks.css">
                    <!-- <link rel="stylesheet" type="text/css" href="../css/stl.css"> -->
                </head>
                <style>
                    <?php
                    include("../css/consulterBooks.css");
                    ?>
                </style>
                <body>
                    <!-- custom cursors  -->
                    <div class="cursor-1"></div>
                    <div class="cursor-2"></div>
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
                    <?php if (isset($_GET['errorAdd'])) { ?><p class="errorAdd"><?php echo $_GET['errorAdd']; ?></p><?php } ?>
                    <?php
                    include "../../../private/conn.php";
                    $idCategorie = $_GET['idCategorie'];
                    $categorieQuery = mysqli_query($conn, "SELECT * FROM categorie");
                    ?>
                    <center>
                        <div class="typeName">
                            <?php
                            while ($categorie = mysqli_fetch_assoc($categorieQuery)) {
                                if ($categorie['idCategorie'] == $idCategorie) {
                                    ?>
                    
                                                <a href="index.php?idCategorie=<?php echo $categorie['idCategorie']; ?>">
                                                    <p class="p1"><?php echo $categorie['categorie'] ?></p>
                                                </a>
                    
                                            <?php
                                } else {
                                    ?>
                    
                                                <a href="index.php?idCategorie=<?php echo $categorie['idCategorie']; ?>">
                                                    <p class="p2"><?php echo $categorie['categorie'] ?></p>
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
                    <?php
                    $idUser = $_SESSION['idUser'];
                    $idBook = $_GET['idBook'];
                    $idType = $_GET['idType'];
                    $typeQuery = mysqli_query($conn, "SELECT nbrTypeBook FROM typeBook WHERE idType=$idType");
                    $type = mysqli_fetch_assoc($typeQuery);
                    $sql = "SELECT * FROM books,language,publisher WHERE publisher.idPublisher=books.idPublisher AND language.idLanguage=books.idLanguage AND  idBook='$idBook'";
                    $sql_run = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($sql_run) > 0) {
                        while ($row = mysqli_fetch_assoc($sql_run)) {
                            ?>
                                                <section class="about" id="about">
                                                    <div class="row-1">
                                                        <div class="image">
                                                            <img src="../../admin/books/code/uploadsBook/<?php echo $row['image'] ?>">
                                                        </div>
                                                        <div class="content">
                                                            <h3><?php echo $row['nameBook']; ?></h3>
                                                            <p><?php echo $row['parallelTitele']; ?></p>
                                                            <div class="box-container">
                                                                <div class="box">
                                                        
                                                                    <?php
                                                                    $author = mysqli_query($conn, "SELECT * FROM authors,writ WHERE writ.idAuthor=authors.idAuthor AND writ.idBook='$idBook'");
                                                                    if (mysqli_num_rows($author) > 0) {
                                                                        $countA = 1;
                                                                        while ($rowA = mysqli_fetch_assoc($author)) {
                                                                            echo "<p> <span> Author $countA : </span> ";
                                                                            echo $rowA['author'];
                                                                            echo "</p> <br>";
                                                                            $countA++;
                                                                        }
                                                                    } else {
                                                                        echo "0";
                                                                    } ?>
                                                        
                                                                    <p> <span> Publisher : </span> <?php echo $row['publisher'] ?></p>
                                                                    <p> <span> language : </span><?php echo $row['language'] ?></p>
                                                                    <p> <span> Date Of Publisher : </span><?php echo $row['dateOfPublisher']; ?></p>
                                                                </div>
                                                                <div class="box">
                                                                    <?php if (!is_null($row['hardCover'])) { ?>
                                                                                    <p> <span> Hard Cover : </span><?php echo $row['hardCover']; ?></p>
                                                                    <?php } ?>
                                                                    <p> <span> Quantity : </span><?php echo $row['quantity']; ?></p>
                                                                    <?php if (!is_null($row['isbn'])) { ?>
                                                                                    <p> <span> ISBN : </span><?php echo $row['isbn']; ?></p>
                                                                    <?php } ?>
                                                                    <p><span> Cote : </span><?php echo $type['nbrTypeBook'];
                                                                    echo "-";
                                                                    echo $row['nbrBook']; ?></p>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <?php
                                                            $b = "borrow";
                                                            $r = "read";
                                                            ?>
                                                            <div style="display: flex; ">
                                                                <form action="" method="post">
                                                                    <input type="hidden" name="idBook" value="<?php echo $row['idBook']; ?>">
                                                                    <button type="submit" class="btn" name="save">Save</button>
                                                                </form>
                                                                <!-- <a href="saveBook.php?idBook=< ?php echo $row['idBook']; ?>" class="btn">Save</a> -->
                                                                <a href="multi.php?idBook=<?php echo $row['idBook']; ?>&idType=<?php echo $idType; ?>&idCategorie=<?php echo $idCategorie; ?>&Action=<?php echo $b; ?>"class="btn" id="emprint" title="Borrow, and get to home">Borrow</a>
                                                                <a href="multi.php?idBook=<?php echo $row['idBook']; ?>&idType=<?php echo $idType; ?>&idCategorie=<?php echo $idCategorie; ?>&Action=<?php echo $r; ?>"class="btn" id="emprint" title="Read in library">Read</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <?php
                                                if (!empty($row['summary'])) {
                                                    ?>
                                                        <section class="home" id="home">
                                                            <div class="content">
                                                                <h3> <span><?php echo $row['nameBook']; ?></span></h3>
                                                                <p class="info"> Summary </p>
                                                                <p class="text"><?php echo $row['nameBook'];
                                                                echo " "; ?><br><?php echo $row['summary']; ?></p>
                                                                <!-- <a href="#about" class="btn">About</a> -->
                                                            </div>
                                                        </section>
                                                        <?php
                                                }
                                                ?>
                                                <?php
                                                 $authorBio = mysqli_query($conn, "SELECT * FROM authors,writ WHERE writ.idAuthor=authors.idAuthor AND writ.idBook='$idBook'");
                                                                
                                                while ($rowAuthor = mysqli_fetch_assoc($authorBio)) {
                                                    
                                                ?>
                                                <section class="deal">
                                                    <hr>
                                                    <div class="content">
                                                        <?php if (!empty($rowAuthor['aboutAuthor'])) { ?>
                                                                    <h3>About <span>Author</span></h3>
                                                                    <h1><?php echo $rowAuthor['author']; ?></h1>
                                                                    <p><?php echo $rowAuthor['aboutAuthor']; ?></p>
                                                        <?php } ?>
                                                    </div>
                                                </section>
                                                <!-- About section ends -->
                                                <div class="icons"><div id="search-btn"></div><div id="login-btn"></div></div>
                                                <div class="login-form-container"><div id="close-login-btn"></div></div>
                                                <?php
                                                $idA = $rowAuthor['idAuthor'];
                                                $authorsBooks = "SELECT * FROM books,writ WHERE writ.idAuthor=$idA AND writ.idBook=books.idBook AND writ.idBook!=$idBook";
                                                $authorsBooks_run = mysqli_query($conn, $authorsBooks);
                                                if (mysqli_num_rows($authorsBooks_run) > 0) {
                                                    ?>
                                                            <section class="featured" id="featured">
                                                                <h1 class="heading"> <span>Other books by the author</span> </h1>
                                                                <div class="swiper featured-slider">
                                                                    <div class="swiper-wrapper">
                                                                <?php
                                                                while ($rowA = mysqli_fetch_assoc($authorsBooks_run)) {
                                                                    ?>
                                    
                                                                                <div class="swiper-slide box">
                                                                                    <div class="image">
                                                                                        <?php
                                                                                        if ($rowA['image'] == null) {
                                                                                            ?>
                                                                                                <img src="../../home/image/download.jfif">
                                                                                                <?php
                                                                                        } else {
                                                                                            ?>
                                                                                                <img src="../../admin/books/code/uploadsBook/<?php echo $rowA['image'] ?>">
                                                                                        <?php } ?>
                                                                                    </div>
                                                                                    <div class="content">
                                                                                        <a href="viewBookCard.php?idBook=<?php echo $idBook ?>" class="btn">View</a>
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
                                                            <?php
                                                } else {
                                                    echo "0";
                                                }
                                                $countA="2";  
                                            }
                                                ?>
                                                    <hr>
                                                    <h1 class="heading"> <span>Comments</span> </h1>
                                                        <section id="comments">
                                                            <form action="comment.php" method="post">
                                                                <input type="text" name="msg" id="input" placeholder="Add a comment...">
                                                                <input type="hidden" name="idType" value="<?php echo $idType; ?>">
                                                                <input type="hidden" name="idBook" value="<?php echo $idBook; ?>">
                                                                <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                                                <button type="reset" class="cancel">Cancel</button>
                                                                <button type="submit" class="comment" name="addComment">Comment</button>
                                                            </form>
                                                            <?php
                                                            $sqlComment = mysqli_query($conn, "SELECT * FROM users,comments WHERE users.idUser=comments.idUser AND comments.idBook=$idBook");
                                                            if (mysqli_num_rows($sqlComment) != 0) {
                                                                while ($rowC = mysqli_fetch_array($sqlComment)) {
                                                                    $img = $rowC['imageUser'];
                                                                    ?>
                                                                                        <div class="commentDiv" style="display: flex;">
                                                                                            <div class="img">
                                                                                            <?php
                                                                                            if (!empty($img)) {
                                                                                                ?>
                                                                                                            <img src="../../admin/member/code/uploadsMember/<?= $img; ?>" width="80">
                                                                                                        <?php
                                                                                            } else {
                                                                                                ?>
                                                                                                            <img src="../../admin/member/code/uploadsMember/user.png" width="80">
                                                                                                        <?php
                                                                                            }
                                                                                            ?>
                                                                                            </div>
                                                                                            <div class="message">
                                                                                                <h1><?= $rowC['firstName'] ?>                                         <?= $rowC['lastName'] ?>  : <?= $rowC['date'] ?></h1><br>
                                                                                                <h2><?= $rowC['comment'] ?></h2>
                                                                                                <br>
                                                                                                <?php
                                                                                                if ($rowC['idUser'] == $idUser) {
                                                                                                    ?>
                                                                                                            <div style="display: flex;">
                                                                                                                <form action="../Acount-setting/delete.php" method="post">
                                                                                                                    <input type="hidden" name="idC" value="<?= $rowC['idC'] ?>">
                                                                                                                    <input type="hidden" name="idType" value="<?php echo $idType; ?>">
                                                                                                                    <input type="hidden" name="idBook" value="<?php echo $idBook; ?>">
                                                                                                                    <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                                                                                                    <button type="submit" name="deletComment" onclick="return confirm('are you sure you want to delete ?')" id="btnDelet" class="deletComment">Delete</button>
                                                                                                                </form>
                                                                                                                <button type="submit" name="editComment" class="editComment" id="edit" onclick="show_edit()">Edit</button>
                                                                                                            </div>
                                                                                                            <div id="editForm">
                                                                                                                <form action="comment.php" method="post" class="formEdit">
                                                                                                                    <input type="text" name="msg" id="input" value="<?= $rowC['comment'] ?>">
                                                                                                                    <input type="hidden" name="idType" value="<?php echo $idType; ?>">
                                                                                                                    <input type="hidden" name="idBook" value="<?php echo $idBook; ?>">
                                                                                                                    <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                                                                                                    <input type="hidden" name="idC" value="<?= $rowC['idC'] ?>">
                                                                                                                    <a  class="deletComment" id="deletComment" onclick="hide_edit()">Cancel</a>
                                                                                                                    <button type="submit" class="editComment" name="editComment">Save</button>
                                                                                                                </form>
                                                                                                            </div>
                                                                                                        <?php
                                                                                                }
                                                                                                ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                                <div class="commentDiv" style="padding: 60px;">
                                                                                    <center>
                                                                                        <h1>
                                                                                            No comments yet <br>
                                                                                            Be the first to comment
                                                                                        </h1>
                                                                                    </center>
                                                                                </div>
                                                                                <?php
                                                            }
                                                            ?>
                                                        </section>
                                                       <section class="vide" id="vide"></section>
                                                       <?php
                        }
                    }
                    ?>
                            
                                    <script src="../../home/script.js"></script>
                                    <script src="../js/viewBook.js"></script>
                                    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

                                    <!-- custom js file link  -->
                                    <script src="../js/consulterBooks.js"></script>
                                    <script src="../../home/script.js"></script>
                                    <script>
                                    // ========= multip step ============

                                        var Form1 = document.getElementById("Form1");
                                        var Form2 = document.getElementById("Form2");

                                        var Next1 = document.getElementById("Next1");
                                        var Back1 = document.getElementById("Back1");

                                        var progress = document.getElementById("progress");

                                        Next1.onclick = function () {
                                            Form1.style.left = "-450px";
                                            Form2.style.left = "40px";
                                            progress.style.width = "240px";
                                        }

                                        Back1.onclick = function () {
                                            Form1.style.left = "40px";
                                            Form2.style.left = "450px";
                                            progress.style.width = "120px";
                                        }
                                        let loginForm = document.querySelector('.container');
                                        document.querySelector('#emprint').onclick = () => {
                                        loginForm.classList.toggle('active');
                                        }
                                        document.querySelector('#close-btn').onclick = () => {
                                        loginForm.classList.remove('active');
                                        }
                                    </script>
                                    <?php
                                    if (isset($_POST['save'])) {
                                        $idBook = $_POST['idBook'];
                                        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM saved WHERE idBook=$idBook AND idUser=$idUser")) == 0) {
                                            $sqlSave = mysqli_query($conn, "INSERT INTO `saved` ( `idUser`, `idBook`) VALUES ( $idUser, $idBook)");
                                            if ($sqlSave) {
                                                echo "<script>alert('saved');</script>";
                                            } else {
                                                echo "<script>alert('error');</script>";
                                            }
                                        } else {
                                            echo "<script>alert('saved already');</script>";
                                        }
                                    }
                                    ?>
                                    <script type="text/javascript">
                                        function hide_edit(){
                                            document.getElementById('editForm').classList.remove('active');
                                            document.getElementById('edit').setAttribute('style', 'display: block;');
                                            document.getElementById('btnDelet').setAttribute('style', 'display: block;');
                                        }
                                        function show_edit(){
                                            document.getElementById('editForm').classList.add('active');
                                            document.getElementById('edit').setAttribute('style', 'display: none;');
                                            document.getElementById('btnDelet').setAttribute('style', 'display: none;');
                                        }
                                        </script>
                        </body>
                    </html>
        <?php
} else {
    header("Location: ../../home/index.php");
    exit();
}
?>