<?php
session_start();
if (isset($_SESSION['idUser']) && $_SESSION['userType'] == 'admin') {
    ?>
    <?php
    include('../includes/header.php');
    include('../../../private/conn.php');

    ?>
    <style>
        <?php include('../assets/css/search.css'); ?>
    </style>
    <?php

    $search = $_POST['search'];
    // $selectSearch = $_POST['selectSearch'];
    $idCategorie = $_POST['idCategorie'];

    if ($idCategorie == '1') {
        ?>
        <style>
            #info {
                padding: 5px;
                border-bottom: 5px solid white;
            }
        </style>
        <?php
    } else if ($idCategorie == '2') {
        ?>
            <style>
                #maths {
                    padding: 5px;
                    border-bottom: 5px solid white;
                }
            </style>
        <?php
    } else if ($idCategorie == '3') {
        ?>
                <style>
                    #physics {
                        padding: 5px;
                        border-bottom: 5px solid white;
                    }
                </style>
        <?php
    } else if ($idCategorie == '4') {
        ?>
                    <style>
                        #chemistry {
                            padding: 5px;
                            border-bottom: 5px solid white;
                        }
                    </style>
        <?php
    }
    ?>
    <center>



        <div class="search-container">
            <form action="search.php" method="POST">
                <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                <input type="text" placeholder="Search..." name="search" id="live_search">
                <button type="submit" name="searchButton"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </center>
    <?php {
        $query_book = "SELECT * FROM books,typebook WHERE books.idType=typebook.idType AND  books.idCategorie='$idCategorie' AND (nameBook LIKE '%$search%' OR isbn LIKE '%$search%' OR parallelTitele LIKE '%$search%')";
        $result_book = mysqli_query($conn, $query_book);

        $resultGP = mysqli_query($conn, "SELECT * FROM graduation_project WHERE graduation_project.idCategorie='$idCategorie' AND (title LIKE '%$search%' OR level LIKE '%$search%')");



        ?>
        <center>



            <?php
            if (mysqli_num_rows($result_book) > 0) {
                while ($row2 = mysqli_fetch_assoc($result_book)) {
                    ?>
                    <hr style="border: 2px solid #1c4966; margin: 26px; width: 50%">
                    <table class="viewTab">
                        <form action="viewBookCard.php" method="post">
                            <input type="hidden" name="returnIdType" value="<?php echo $row2['idType'] ?>">
                            <input type="hidden" name="idCategorie" value="<?php echo $row2['idCategorie']; ?>">
                            <input type="hidden" name="view_id" value="<?php echo $row2['idBook']; ?>">
                            <td style="width: 20%;">

                                <?php
                                if (!empty($row2['image'])) {
                                    ?>
                                    <img src="code/uploadsBook/<?php echo $row2['image']; ?>" style="border: 2px solid rgba(0,0,0,.1);"
                                    width="120">
                                    <?php
                                }else{
                                ?>
                                <img src="code/uploadsBook/empty.jpg" style="border: 2px solid rgba(0,0,0,.1);"
                                    width="120">
                                <?php } ?>
                                
                            </td>
                            <td style="width: 70%;">
                                <h3>
                                    <?php echo $row2['nameBook']; ?>
                                </h3> <br>
                                <h4>
                                    <?php echo $row2['parallelTitele']; ?>
                                </h4>
                                <h5>
                                    ISBN :
                                    <?php echo $row2['isbn']; ?> <br>
                                    Cote :
                                    <?php echo $row2['nbrTypeBook'];
                                    echo "-";
                                    echo $row2['nbrBook']; ?>
                                </h5>
                            </td>
                            <td style="width: 10%;">
                                <button class="viewButton" type="submit" name="view_btn"> Show <span
                                        class="fas fa-chevron-right"></span></button>
                            </td>
                        </form>
                    </table>
                    <?php
                }
            }

            if (mysqli_num_rows($resultGP) > 0) {
                while ($row2 = mysqli_fetch_assoc($resultGP)) {
                    ?>
                    <hr style="border: 2px solid #1c4966; margin: 26px; width: 50%">
                    <table class="viewTab">
                        <form action="viewGPCard.php" method="post">
                            <input type="hidden" name="idCategorie" value="<?php echo $row2['idCategorie']; ?>">
                            <input type="hidden" name="view_id" value="<?php echo $row2['idGP']; ?>">
                            <td style="width: 20%;">
                                <img src="../../user/Acount-setting/img2.jpg" style="border: 2px solid rgba(0,0,0,.1);"
                                    width="120">
                            </td>
                            <td style="width: 70%;">
                                <h3>
                                    <?php echo $row2['title']; ?>
                                </h3> 
                                <h5>
                                    Level :
                                    <?php echo $row2['level']; ?> <br>
                                    Year :
                                    <?= $row2['year'];?>
                                    Cote
                                    <?php echo $row2['coteG']; ?>
                                </h5>
                            </td>
                            <td style="width: 10%;">
                                <button class="viewButton" type="submit" name="view_btn"> Show <span
                                        class="fas fa-chevron-right"></span></button>
                            </td>
                        </form>
                    </table>
                    <?php
                }
            }


    } {
        $query = "SELECT * FROM typebook WHERE idCategorie='$idCategorie' AND (nbrTypeBook LIKE '%$search%' OR typeBook LIKE '%$search%') ";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            ?>
                <center>
                    <div class="cardBox">
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <form action="viewBook.php" method="post">
                                <div class="card">
                                    <button type="submit" id="go_to" name="go_to">
                                        <div class="numbers">
                                            <?php echo $row["nbrTypeBook"]; ?>
                                        </div>
                                        <div class="cardName">
                                            <?php echo $row["typeBook"] ?>
                                        </div>
                                        <input type="hidden" name="idType" value="<?php echo $row['idType']; ?>">
                                        <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                    </button>
                                </div>
                            </form>
                            <?php
                        }

                        ?>
                    </div>
                </center>
                <?php
        }

        ?>

            <?php
    }
    if ((mysqli_num_rows($result) + mysqli_num_rows($result_book)+mysqli_num_rows($resultGP)) == 0) {
        ?>
            <center>
                <div class="cardBox">
                    <div class="card">
                        <button id="go_to" name="go_to">
                            <div class="numbers">
                                0
                            </div>
                            <div class="cardName">
                                No Record Found
                            </div>
                        </button>
                    </div>
                </div>
            </center>

            <?php
    }

    include('../includes/scripts.php');

} else {
    header("Location: ../../home/index.php");
    exit();
}
?>