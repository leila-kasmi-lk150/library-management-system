<?php
session_start();
if (isset($_SESSION['idUser']) && $_SESSION['userType'] == 'admin') {

    include('../includes/header.php');
    include('../../../private/conn.php');
    ?>

    <style>
        <?php include('../assets/css/dashboard.css'); ?>
        #dashboard {
            padding: 5px;
            border-bottom: 5px solid white;
        }
    </style>

    <center>
        <div class="titleDiv"><a href="index.php" style="margin-right: 30px;"><i class="fa fa-reply"></i></a>Request</div>
    </center>
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

    <div class="search-container">
        <!-- <form action="searchBorrow.php" method="POST"> -->
        <input type="text" placeholder="Search..." name="search" id="live_search">
        <button type="submit" name="searchButton"><i class="fa fa-search"></i></button>
        <!-- </form> -->
    </div>

    <div id="result"></div>

    <div id="myTable">
        <table class="MainTab">
            <tr>
                <th>Code User</th>
                <th>User Name</th>
                <th>COTE </th>
                <th>Title </th>
                <th>Date Request </th>
                <th>Action</th>
                <th>Get</th>
                <th>DELET</th>
            </tr>
            <?php

            $query = mysqli_query($conn, "SELECT * FROM request,books,users,typebook WHERE typebook.idType=books.idType AND books.idBook=request.idBook AND users.idUser=request.idUser");
            $queryGP = mysqli_query($conn, "SELECT * FROM request_gp,graduation_project,users WHERE  graduation_project.idGP=request_gp.idGP AND users.idUser=request_gp.idUser");

            if ((mysqli_num_rows($query) + mysqli_num_rows($queryGP)) > 0) {
                while ($row2 = mysqli_fetch_assoc($query)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row2['codeUser']; ?>
                        </td>
                        <td>
                            <?php echo $row2['firstName']; ?> <?php echo $row2['lastName']; ?>
                        </td>
                        <td>
                            <?php echo $row2['nbrTypeBook'];
                            echo "-";
                            echo $row2['nbrBook']; ?>
                        </td>
                        <td>
                            <?php echo $row2['nameBook']; ?>
                        </td>
                        <td>
                            <?php echo $row2['dateRequest']; ?>
                        </td>
                        <td>
                            <?php echo $row2['Action']; ?>
                        </td>
                        <td>
                            <!-- <span class="viewSpan"> -->
                            <form action="code/getBook.php" method="post">
                                <input type="hidden" name="idUser" value="<?php echo $row2['idUser']; ?>">
                                <input type="hidden" name="view_id" value="<?php echo $row2['idBook']; ?>">
                                <input type="hidden" name="Action" value="<?php echo $row2['Action']; ?>">
                                <input type="hidden" name="idR" value="<?php echo $row2['idR']; ?>">
                                <button type="submit" name="get" class="btn btn-view">Get It</button>
                            </form>
                            <!-- </span> -->
                        </td>
                        <td>
                            <!-- <span class="deletSpan"> -->
                            <form action="code/deletRequestCode.php" method="post">
                                <input type="hidden" name="idBook" value="<?php echo $row2['idBook']; ?>">
                                <input type="hidden" name="idRequest" value="<?php echo $row2['idR']; ?>">
                                <button type="submit" name="delete_btn" class="btn btn-danger">Delet</button>
                            </form>
                            <!-- </span> -->
                        </td>
                    </tr>
                    <?php
                }
                while ($row2 = mysqli_fetch_assoc($queryGP)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row2['codeUser']; ?>
                        </td>
                        <td>
                            <?php echo $row2['firstName']; ?> <?php echo $row2['lastName']; ?>
                        </td>
                        <td>
                            <?php echo $row2['coteG']; ?>
                        </td>
                        <td>
                            <?php echo $row2['title']; ?>
                        </td>
                        <td>
                            <?php echo $row2['dateRequest']; ?>
                        </td>
                        <td>
                            <?php echo $row2['Action']; ?>
                        </td>
                        <td>
                            <!-- <span class="viewSpan"> -->
                            <form action="code/getBook.php" method="post">
                                <input type="hidden" name="idUser" value="<?php echo $row2['idUser']; ?>">
                                <input type="hidden" name="view_id" value="<?php echo $row2['idGP']; ?>">
                                <input type="hidden" name="Action" value="<?php echo $row2['Action']; ?>">
                                <input type="hidden" name="idRGP" value="<?php echo $row2['idRGP']; ?>">
                                <button type="submit" name="getGP" class="btn btn-view">Get It</button>
                            </form>
                            <!-- </span> -->
                        </td>
                        <td>
                            <!-- <span class="deletSpan"> -->
                            <form action="code/deletRequestCode.php" method="post">
                                <input type="hidden" name="idGP" value="<?php echo $row2['idGP']; ?>">
                                <input type="hidden" name="idRequest" value="<?php echo $row2['idRGP']; ?>">
                                <button type="submit" name="delete_btnGP" class="btn btn-danger">Delet</button>
                            </form>
                            <!-- </span> -->
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td>
                        No Record Found
                    </td>
                </tr>
                <?php
            } ?>

        </table>

    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#live_search").keyup(function () {
                var input = $(this).val();
                // if(input != ""){
                $.ajax({
                    url: "liveSearchRequest.php",
                    method: "POST",
                    data: {
                        input: input
                    },

                    success: function (data) {
                        $("#result").html(data);
                        $("#myTable").css("display", "none");
                    }
                });
                // } else{

                // }
            });
        });
    </script>


    <?php
    include('../includes/scripts.php');

} else {
    header("Location: ../../home/index.php");
    exit();
}
?>