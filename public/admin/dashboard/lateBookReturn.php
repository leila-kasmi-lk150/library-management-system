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
        <div class="titleDiv"><a href="index.php" style="margin-right: 30px;"><i class="fa fa-reply"></i></a>Late Resources
            Return</div>
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
                <th>User</th>
                <th>COTE </th>
                <th>Title</th>
                <th>Notification</th>
            </tr>
            <?php

            $query = mysqli_query($conn, "SELECT * FROM borrow,books,users,typeBook WHERE books.idType=typeBook.idType AND books.idBook=borrow.idBook AND users.idUser=borrow.idUser AND isReturn='0' AND dateReturn < now()");
            $queryGP = mysqli_query($conn, "SELECT * FROM borrow_gp,graduation_project,users WHERE graduation_project.idGP=borrow_gp.idGP AND users.idUser=borrow_gp.idUser AND isReturn='0' AND dateReturn < now()");

            if ((mysqli_num_rows($query)+mysqli_num_rows($queryGP) ) > 0) {
                while ($row2 = mysqli_fetch_assoc($query)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row2['codeUser']; ?>
                        </td>
                        <td>
                            <?php echo $row2['firstName'];
                            echo " ";
                            echo $row2['lastName']; ?>
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
                            <!-- <span class="viewSpan"> -->
                            <form action="code/sendNotification.php" method="post">
                                <input type="hidden" name="idUser" value="<?php echo $row2['idUser']; ?>">
                                <input type="hidden" name="idBook" value="<?php echo $row2['idBook']; ?>">
                                <input type="hidden" name="idB" value="<?php echo $row2['idB']; ?>">
                                <button type="submit" name="get" class="btn btn-view">Send</button>
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
                            <?php echo $row2['firstName'];
                            echo " ";
                            echo $row2['lastName']; ?>
                        </td>
                        <td>
                            <?php echo $row2['coteG']; ?>
                        </td>
                        <td>
                            <?php echo $row2['title']; ?>
                        </td>
                        <td>
                            <!-- <span class="viewSpan"> -->
                            <form action="code/sendNotification.php" method="post">
                                <input type="hidden" name="idUser" value="<?php echo $row2['idUser']; ?>">
                                <input type="hidden" name="idGP" value="<?php echo $row2['idGP']; ?>">
                                <button type="submit" name="getGP" class="btn btn-view">Send</button>
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
                    url: "liveSearchLate.php",
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