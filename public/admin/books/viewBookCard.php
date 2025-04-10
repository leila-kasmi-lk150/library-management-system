<?php
session_start();
if (isset($_SESSION['idUser']) && $_SESSION['userType']=='admin') {
    include('../includes/header.php');
    include('../../../private/conn.php');
?>
    <style>
    <?php include('../assets/css/viewBookCard.css'); ?>
    <?php include('../../user/css/view.css');?>
        table{
            width:100%;
        }
    </style>
    <meta>
        <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,600;1,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </meta>
    <?php
    if(isset($_POST['view_btn'])){
        $idCategorie = $_POST['idCategorie'];
        $query = "SELECT * FROM typebook WHERE idCategorie='$idCategorie'";
        $query_run = mysqli_query($conn, $query);
        if ($idCategorie=='1') {
            ?>
            <style>
            #info{
                padding: 5px;
                border-bottom: 5px solid white;
            }
        </style>
    <?php
} else if ($idCategorie=='2') {
    ?>
    <style>
        #maths{
            padding: 5px;
            border-bottom: 5px solid white;
        }
    </style>
    <?php
} else if ($idCategorie=='3') {
    ?>
    <style>
        #physics{
            padding: 5px;
            border-bottom: 5px solid white;
        }
    </style>
    <?php
}else if ($idCategorie=='4') {
    ?>
    <style>
        #chemistry{
            padding: 5px;
            border-bottom: 5px solid white;
        }
    </style>
    <?php
}

    $idType = $_POST['returnIdType'];
    $typeQuery=mysqli_query($conn,"SELECT nbrTypeBook FROM typeBook WHERE idType=$idType");
    $type= mysqli_fetch_assoc($typeQuery);
    $idBook = $_POST['view_id'];
    $query = "SELECT * FROM books,language,publisher WHERE publisher.idPublisher=books.idPublisher AND language.idLanguage=books.idLanguage AND  idBook='$idBook'";
    $query_run = mysqli_query($conn, $query);
    foreach($query_run as $row)
    {
?>
<div class="typeName"><a href="viewBook.php?idTypeReturn=<?php echo $idType;?>&idCategorie=<?php echo $idCategorie;?>" style="margin-right: 30px;"><i class="fa fa-reply"></i></a>DETAILS ABOUT <?php echo $row['nameBook'] ?> </div>
<section class="about" id="about">
            <h1 class="heading">
                <!-- INFORMATION ABOUT <span2> THE BOOK </span2>  -->
            </h1>
            <div class="row-1">
                <div class="image">
                <img src="code/uploadsBook/<?php echo $row['image'] ?>">
                </div>
                <div class="content">
                    <!-- title -->
                    <h3> <?php echo $row['nameBook']; ?> </h3>
                    <!-- Parallel title -->
                    <p> <?php echo $row['parallelTitele']; ?></p>
                    <div class="box-container">
                        <div class="box">
                            
                            <?php
                            $author = mysqli_query($conn, "SELECT * FROM authors,writ WHERE writ.idAuthor=authors.idAuthor AND writ.idBook='$idBook'");
                            if (mysqli_num_rows($author) > 0) {
                                $countA=1;
                                while ($rowA = mysqli_fetch_assoc($author)) {
                                    echo "<p> <span> Author $countA : </span> ";
                                    echo $rowA['author'];
                                    echo "<br>";
                                    $countA++;
                                }
                            } else {
                                echo "0";
                            } ?>
                            </p>
                            <p> <span> Publisher : </span> <?php echo $row['publisher'] ?> </p>
                            <p> <span> language : </span> <?php echo $row['language'] ?> </p>
                            <p> <span> Date Of Publisher : </span> <?php echo $row['dateOfPublisher']; ?> </p>
                        </div>
                    <div class="box">
                        <?php if (!is_null($row['hardCover'])) {
                            ?>
                                <p> <span> Hard Cover : </span> <?php echo $row['hardCover']; ?> </p>
                            <?php
                        }?>
                            
                            <p> <span> Quantity : </span> <?php echo $row['quantity']; ?> </p>

                        <?php if (!is_null($row['isbn'])) {
                            ?>
                            <p> <span> ISBN : </span> <?php echo $row['isbn']; ?> </p>
                            <?php
                        }?>
                        <p> <span> Cote : </span> <?php echo $type['nbrTypeBook']; echo "-"; echo $row['nbrBook']; ?> </p>
                    </div>
                    </div>
                    
                
                <div class="div" style="display: flex; margin-top: 50px;">
                <!-- <a href="#" class="btnD">download</a> -->
                <span class="deletSpan" >
                                        <form action="code/deletBookCode.php" method="post">
                                        <input type="hidden" name="returnIdType" value="<?php echo $idType ?>">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['idBook']; ?>">
                                        <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                        <button type="submit" name="delete_btn" id="deletBtn" class=" btn-danger"><i class='fa fa-trash'></i></button>
                                        </form>
                </span>
                <span class="editSpan">
                                     <form action="editBook.php" method="post">
                                        <input type="hidden" name="returnIdType" value="<?php echo $idType ?>">
                                        <input type="hidden" name="edit_id" value="<?php echo $row['idBook']; ?>">
                                        <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                        <button type="submit" name="edit_btn" id="editBtn" class=" btn-edit"><i class='fa fa-edit'></i></button>
                                    </form>
                </span>
                </div>
                <!-- <a href="multi.html" class="btn" id="emprint">emprint</a> -->
                </div>
            </div>
    </section>

    <?php

if (!empty($row['summary'])) {
   ?>

   
    <section class="home" id="home">
            <div class="content">
                <h3> <span> <?php echo $row['nameBook']; ?> </span></h3>
                <p class="info"> Summary </p>
                <p class="text"><?php echo $row['nameBook']; echo " "; ?><br>
                <?php echo $row['summary']; ?></p>
                <a href="#about" class="btn">About</a>
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




<?php
    }
?>


<?php
$historyBook = mysqli_query($conn,"SELECT * FROM borrow,users WHERE users.idUser=borrow.idUser AND idBook=$idBook");


?>
    <hr style="2px solid #ddd">
        <center><h1 class="heading"> <span>History</span> </h1></center>

       
        <table class="table"  >
                <thead>
                        <tr>
                            <th >User Code</th>
                            <th >Name user</th>
                            <th >Date Borrow</th>
                            <th >Date Return</th>
                            <th >View</th>
                        </tr>
                </thead>
                <?php
                if(mysqli_num_rows($historyBook) > 0)        
                {
                while ($h=mysqli_fetch_assoc($historyBook)) {
                    ?>
                        <tr>
                            <td ><?php echo $h['codeUser'];?></td>
                            <td ><?php echo $h['firstName']; echo " "; echo $h['lastName'];?></td>
                            <td ><?php echo $h['dateGet'];?></td>
                            <td ><?php echo $h['dateReturn'];?></td>
                            <td>
                                        <form action="../member/viewMember.php" method="post">
                                            <input type="hidden" name="view_id" value="<?php echo $h['idUser']; ?>">
                                            <button type="submit" name="view_btn" class="btn-view"><i class='fa fa-eye'></i></button>
                                        </form>
                            </td>
                        </tr>

                    <?php
                }}else{
                    ?>
                    <tr>
                        <td>No record found</td>
                    </tr>

                    <?php
                }
                ?>

                </table>

<?php

?>
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="../../user/js/consulterBooks.js"></script>


<?php
}
// <?php
}else{
    header("Location: ../../home/index.php");
    exit();
  }
?>