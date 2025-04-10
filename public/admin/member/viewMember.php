<?php
session_start();
if (isset($_SESSION['idUser']) && $_SESSION['userType'] == 'admin') {
    ?>
    <?php
    include('../includes/header.php');
    include('../../../private/conn.php');
    ?>
    <style>
        <?php include('../assets/css/viewMemberCard.css');
        include('../assets/css/section.css');
        ?>
        #member {
            padding: 5px;
            border-bottom: 5px solid white;
        }
    </style>
    <?php
    if (isset($_POST['view_btn'])) {
        $idUser = $_POST['view_id'];
        $query = "SELECT * FROM users WHERE  idUser='$idUser'";
        $query_run = mysqli_query($conn, $query);
        foreach ($query_run as $row) {
            ?>
            <div class="typeName"> <a href="index.php" style="margin-right: 30px;"><i class="fa fa-reply"></i></a>BIOGRAPHY OF
                MEMBER <div class="buttonDiv">
                    <a href="viewCardMemberDownload/pdf.php?idUser=<?php echo $row['idUser'] ?>"><i class="fa fa-download"></i></a>


                </div>
            </div>
            <div class="viewMember" id="print">
                <div class="wrapperDiv">
                    <div class="leftDiv">
                        <!-- <div class="card-body"> -->
                        <div class="tob-card-body">
                            <?php
                            if (!empty($row['imageUser'])) {
                                ?>
                                <img src="code/uploadsMember/<?= $row['imageUser'] ?>" width="150">
                                <?php
                            } else {
                                ?>
                                <img src="code/uploadsMember/user.png" width="150">
                                <?php
                            }

                            ?>

                            <h3>
                                <?php echo $row['firstName'];
                                echo " ";
                                echo $row['lastName']; ?>
                            </h3>
                        </div>
                        <div class="infoDiv">
                            <p><i class="fa fa-map-marker"></i><span>
                                    <?php echo $row['adress'] ?>
                                </span></p>
                            <p><i class="fa fa-phone"></i><span>
                                    <?php echo $row['phone'] ?>
                                </span></p>
                            <p><i class="fa fa-envelope"></i><span>
                                    <?php echo $row['email'] ?>
                                </span></p>
                            <p><i class="fas fa-id-card"></i><span>
                                    <?php echo "  ";
                                    echo $row['codeUser']; ?>
                                </span></p>
                            <p><i class="fa fa-graduation-cap"></i><span>
                                    <?php echo $row['specialty'];
                                    echo " "; ?>
                                    <?php echo $row['level'] ?>
                                </span></p>
                        </div>

                        <!-- </div> -->
                    </div>
                    <div class="rightDiv">
                        <h3>Faculty Of Exact Sciences Library <br> University Mustafa Stambouli</h3><br>
                        <h3></h3>
                        <div class="aboutDiv">
                            <h4>First Name</h4>
                            <?php echo $row['firstName'] ?>
                        </div>
                        <hr>
                        <div class="aboutDiv">
                            <h4>Last Name</h4>
                            <?php echo $row['lastName'] ?>
                        </div>
                        <hr>
                        <div class="aboutDiv">
                            <h4>Date Of Birth</h4>
                            <?php echo $row['dateOfBirth'] ?>
                        </div>
                        <hr>
                        <div class="aboutDiv">
                            <h4>Place Of Birth</h4>
                            <?php echo $row['PlaceOfBirth'] ?>
                        </div>
                    </div>

                </div>

                <!-- <center> -->

                <!-- </center> -->
            </div>



            
            <div style="margin: 35px;"></div>

            <?php

            ?>
            <div class="typeName">History</div>

            <div class="viewBook">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>COTE</th>
                            <th>Name Book</th>
                            <th>Date Borrow</th>
                            <th>Date Return</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <thead>
                        <?php
                        $idUser = $row['idUser'];
                        $history = mysqli_query($conn, "SELECT * FROM borrow,books,typeBook WHERE books.idType=typeBook.idType AND books.idBook=borrow.idBook AND iduser=$idUser");
                        $historyGP = mysqli_query($conn, "SELECT * FROM borrow_gp,graduation_project WHERE graduation_project.idGP=borrow_gp.idGP AND iduser=$idUser");
                        if (mysqli_num_rows($history) > 0) {
                            $count = 1;
                            while ($row2 = mysqli_fetch_assoc($history)) {

                                ?>
                                <tr>
                                    <td>
                                        <?php echo $row2['nbrTypeBook'];
                                        echo "-";
                                        echo $row2['nbrBook']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row2['nameBook']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row2['dateGet']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row2['dateReturn']; ?>
                                    </td>
                                    <td>
                                        <form action="../books/viewBookCard.php" method="post">
                                            <input type="hidden" name="returnIdType" value="<?php echo $row2['idType']; ?>">
                                            <input type="hidden" name="idCategorie" value="<?php echo $row2['idCategorie']; ?>">
                                            <input type="hidden" name="view_id" value="<?php echo $row2['idBook']; ?>">
                                            <button type="submit" name="view_btn" class="btn-view"><i class='fa fa-eye'></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        if (mysqli_num_rows($historyGP) > 0) {
                            $count = 1;
                            while ($row2 = mysqli_fetch_assoc($historyGP)) {

                                ?>
                                <tr>
                                    <td>
                                        <?php echo $row2['coteG']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row2['title']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row2['dateGet']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row2['dateReturn']; ?>
                                    </td>
                                    <td>
                                        <form action="../books/viewGPCard.php" method="post">
                                            <input type="hidden" name="idCategorie" value="<?php echo $row2['idCategorie']; ?>">
                                            <input type="hidden" name="view_id" value="<?php echo $row2['idGP']; ?>">
                                            <button type="submit" name="view_btn" class="btn-view"><i class='fa fa-eye'></i></button>
                                        </form>


                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        if ((mysqli_num_rows($history) + mysqli_num_rows($historyGP)) == '0') {
                            ?>
                            <tr>
                                <td>No Record Found</td>
                            </tr>

                            <?php
                        }
                        ?>
                    </thead>
                </table>
                </table>
                <?php
        }
    }
    ?>




        <?php

        include('../includes/scripts.php');
        ?>
        <?php
} else {
    header("Location: ../../home/index.php");
    exit();
}
?>