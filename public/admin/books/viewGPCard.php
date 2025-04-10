<?php
session_start();
if (isset($_SESSION['idUser']) && $_SESSION['userType'] == 'admin') {

    include('../includes/header.php');
    include('../../../private/conn.php');
    ?>
    <style>
        <?php include('../assets/css/viewBookCard.css'); ?>
        <?php include('../../user/css/view.css');
        ?>
        table {
            width: 100%;
        }
    </style>
    <meta>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />


    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,600;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    </meta>
    <?php
    if (isset($_POST['view_btn'])) {
        $idCategorie = $_POST['idCategorie'];

        $query = "SELECT * FROM typebook WHERE idCategorie='$idCategorie'";
        $query_run = mysqli_query($conn, $query);

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



        $idGP = $_POST['view_id'];
        echo $idGP;
        $query = "SELECT * FROM graduation_project,language, categorie WHERE graduation_project.idCategorie=categorie.idCategorie AND graduation_project.idLanguage=language.idLanguage AND idGP='$idGP'";
        $query_run = mysqli_query($conn, $query);
        foreach ($query_run as $row) {
            ?>
            <div class="typeName"><a href="graduationProject.php?idCategorie=<?php echo $idCategorie; ?>"
                    style="margin-right: 30px;"><i class="fa fa-reply"></i></a>DETAILS ABOUT GRADUATION PROJECT
                <?php echo $row['coteG'] ?>
            </div>
            <section class="about" id="about">
                <h1 class="heading">
                    <!-- INFORMATION ABOUT <span2> THE BOOK </span2>  -->
                </h1>
                <div class="row-1">
                    <div class="content">
                        <!-- title -->
                        <h3>
                            <?php echo $row['title']; ?>
                        </h3>
                        <!-- Parallel title -->
                        <div class="box-container">
                            <div class="box">
                                <?php
                                $author = mysqli_query($conn, "SELECT * FROM authors_gp WHERE idGP='$idGP'");
                                $a = 1;
                                while ($row_author = mysqli_fetch_assoc($author)) {
                                    ?>
                                    <div style="display: flex;">
                                        <p> <span> Author
                                                <?= $a; ?> :
                                            </span>
                                            <?php echo $row_author['name'] ?>
                                        </p>
                                        <?php
                                        if (!empty($row_author['codeUser'])) {
                                            # code...
                                            $codeUser = $row_author['codeUser'];
                                            $idUserQ = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE codeUser='$codeUser'"))
                                                ?>
                                            <!-- <div class="viewSpan"> -->
                                            <form action="../member/viewMember.php" method="post" style="margin-left: 25px;">
                                                <input type="hidden" name="view_id" value="<?php echo $idUserQ['idUser']; ?>">
                                                <button type="submit" name="view_btn" class="btn-view"><i class='fa fa-eye'></i></button>
                                            </form>
                                            <!-- </div> -->


                                            <?php
                                        }


                                        $a = $a + 1;
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>

                                <p> <span> Level : </span>
                                    <?php echo $row['level'] ?>
                                </p>
                                <p> <span> Year: </span>
                                    <?php echo $row['year']; ?>
                                </p>
                                <p> <span> Language : </span>
                                    <?php echo $row['language'] ?>
                                </p>
                                <p> <span> Categorie: </span>
                                    <?php echo $row['categorie']; ?>
                                </p>
                                <!-- </div>
                    <div class="box"> -->

                                <p> <span> Quantity : </span>
                                    <?php echo $row['qte']; ?>
                                </p>


                                <p> <span> Cote : </span>
                                    <?php echo $row['coteG']; ?>
                                </p>
                            </div>
                        </div>


                        <div class="div" style="display: flex; margin-top: 50px;">
                            <!-- <a href="#" class="btnD">download</a> -->
                            <span class="deletSpan">
                                <form action="code/deletBookCode.php" method="post">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['idGP']; ?>">
                                    <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                    <button type="submit" name="delete_btn" id="deletBtn" class=" btn-danger"><i
                                            class='fa fa-trash'></i></button>
                                </form>
                            </span>
                            <span class="editSpan">
                                <form action="editBook.php" method="post">
                                    <input type="hidden" name="edit_id" value="<?php echo $row['idGP']; ?>">
                                    <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                    <button type="submit" name="edit_btn" id="editBtn" class=" btn-edit"><i
                                            class='fa fa-edit'></i></button>
                                </form>
                            </span>
                        </div>
                        <!-- <a href="multi.html" class="btn" id="emprint">emprint</a> -->
                    </div>
                </div>
            </section>

            <section class="home" id="home">
                <div class="content">
                    <h3> <span>
                            <?php echo $row['title']; ?>
                        </span></h3>
                    <p class="info"> Resume </p>
                    <p class="text">
                        <?php echo $row['title'];
                        echo " "; ?><br>
                        <?php echo $row['resume']; ?>
                    </p>
                </div>
            </section>






            <?php

            ?>


            <?php
            $historyBook = mysqli_query($conn, "SELECT * FROM borrow_gp,users WHERE users.idUser=borrow_gp.idUser AND idGP='$idGP'");


            ?>
            <hr style="2px solid #ddd">
            <h1 class="heading"> <span>History</span> </h1>


            <table class="table" >
                <thead>
                    <tr>
                        <th>User Code</th>
                        <th>Name user</th>
                        <th>Date Borrow</th>
                        <th>Date Return</th>
                        <th>View</th>
                    </tr>
                </thead>
                <?php
                if (mysqli_num_rows($historyBook) > 0) {
                    while ($h = mysqli_fetch_assoc($historyBook)) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $h['codeUser']; ?>
                            </td>
                            <td>
                                <?php echo $h['firstName'];
                                echo " ";
                                echo $h['lastName']; ?>
                            </td>
                            <td>
                                <?php echo $h['dateGet']; ?>
                            </td>
                            <td>
                                <?php echo $h['dateReturn']; ?>
                            </td>
                            <td>
                                <form action="../member/viewMember.php" method="post">
                                    <input type="hidden" name="view_id" value="<?php echo $h['idUser']; ?>">
                                    <button type="submit" name="view_btn" class="btn-view"><i class='fa fa-eye'></i></button>
                                </form>
                            </td>
                        </tr>

                        <?php
                    }
                    ?>

                </table>

                <?php
                } else {
                    echo "No ";
                }
                ?>
            <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
            <script src="../../user/js/consulterBooks.js"></script>


            <?php
        }
    }
    // <?php
} else {
    header("Location: ../../home/index.php");
    exit();
}
?>