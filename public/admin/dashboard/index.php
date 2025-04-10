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


    
    <table class="firstTab">
        <td class="leftTab">
            <table class="formTab">
                <tr>
                    <h1 style="color: #15a0e1;font-weight: bold;"> Graduation Project</h1>
                </tr>
                <tr>
                    <td>
                        <?php if (isset($_GET['errorBG'])) { ?>
                            <p class="error">
                                <?php echo $_GET['errorBG']; ?>
                            </p>
                        <?php } ?>
                        <?php if (isset($_GET['successBG'])) { ?>
                            <p class="success">
                                <?php echo $_GET['successBG']; ?>
                            </p>
                        <?php } ?>
                    </td>
                </tr>
                <form action="code/borrowGP.php" method="post">
                    <tr>
                        <td>
                            <label for="">Action</label>
                        </td>
                        <td>
                            <Select name="action">
                                <option value="reed">Read</option>
                                <option value="borrow">Borrow</option>
                            </Select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Code User</label>
                        </td>
                        <td>
                            <input type="number" name="codeUser" placeholder="Enter user code ..." min="1">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="">Cote Graduation Project</label>
                        </td>
                        <td>
                            <input type="text" name="coteGP" placeholder="Enter cote ...">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button id="borrow" name="borrow" type="submit">Borrow</button>
                        </td>
                    </tr>
                </form>
            </table>
        </td>
        <td class="rightTab">
            <table class="formTab">
                <tr>
                    <h1 style="color: #15a0e1;font-weight: bold;"> Books</h1>
                </tr>
                <tr>
                    <td>
                        <?php if (isset($_GET['errorB'])) { ?>
                            <p class="error">
                                <?php echo $_GET['errorB']; ?>
                            </p>
                        <?php } ?>
                        <?php if (isset($_GET['successB'])) { ?>
                            <p class="success">
                                <?php echo $_GET['successB']; ?>
                            </p>
                        <?php } ?>
                    </td>
                </tr>
                <form action="code/borrow.php" method="post">
                    <tr>
                        <td>
                            <label for="">Action</label>
                        </td>
                        <td>
                            <Select name="action">
                                <option value="reed">Read</option>
                                <option value="borrow">Borrow</option>
                            </Select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Code User</label>
                        </td>
                        <td>
                            <input type="number" name="codeUser" placeholder="Enter user code ..." min="1">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="">Cote Book</label>
                        </td>
                        <td>
                            <input type="number" name="nbrBook" placeholder="Enter cote book ..." min="1">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Type Book Number</label>
                        </td>
                        <td>
                            <select name="idType" id="">
                                <?php
                                $q1 = mysqli_query($conn, "SELECT * FROM typebook");
                                while ($rowQ1 = mysqli_fetch_assoc($q1)) {
                                    ?>
                                    <option value="<?php echo $rowQ1['idType']; ?>"><?php echo $rowQ1['nbrTypeBook']; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button id="borrow" name="borrow" type="submit">Borrow</button>
                        </td>
                    </tr>
                </form>
            </table>
        </td>
    </table>
    <center>
        <div class="linkTab" id="link1">
            <a href="request.php">Request</a>
        </div>
        <div class="linkTab" id="link2">
            <a href="lateBookReturn.php">Return Delays</a>
        </div>
    </center>
    <center>
        <div class="titleDiv">Borrowed Resources</div>
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
        <input type="text" placeholder="Search..." name="search" id="live_search">
        <button type="submit" name="searchButton"><i class="fa fa-search"></i></button>
    </div>

    <div id="result"></div>
    <div id="myTable">
        <table style="width:100%;" class="MainTab">
            <tr>
                <th>Code User</th>
                <th>User</th>
                <th>COTE </th>
                <th>Title</th>
                <th>Action</th>
            </tr>
            <?php

            $query = mysqli_query($conn, "SELECT * FROM borrow,books,users,typeBook WHERE books.idType=typeBook.idType AND books.idBook=borrow.idBook AND users.idUser=borrow.idUser AND isReturn='0'");
            $queryGP = mysqli_query($conn, "SELECT * FROM borrow_gp,graduation_project,users WHERE graduation_project.idGP=borrow_gp.idGP AND users.idUser=borrow_gp.idUser AND isReturn='0'");

            if ((mysqli_num_rows($query) + mysqli_num_rows($query)) > 0) {
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
                            <form action="code/returnBook.php" method="post">
                                <input type="hidden" name="idUser" value="<?php echo $row2['idUser']; ?>">
                                <input type="hidden" name="idBook" value="<?php echo $row2['idBook']; ?>">
                                <input type="hidden" name="Action" value="<?php echo $row2['Action']; ?>">
                                <input type="hidden" name="idB" value="<?php echo $row2['idB']; ?>">
                                <input type="submit" name="get" class="btn btn-view" value="Return">
                            </form>
                            <!-- </span> -->
                        </td>
                    </tr>
                    <?php
                }
                while ($row3 = mysqli_fetch_assoc($queryGP)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row3['codeUser']; ?>
                        </td>
                        <td>
                            <?php echo $row3['firstName'];
                            echo " ";
                            echo $row3['lastName']; ?>
                        </td>
                        <td>
                            <?php echo $row3['coteG']; ?>
                        </td>
                        <td>
                            <?php echo $row3['title']; ?>
                        </td>
                        <td>
                            <!-- <span class="viewSpan"> -->
                            <form action="code/returnBook.php" method="post">
                                <input type="hidden" name="idUser" value="<?php echo $row3['idUser']; ?>">
                                <input type="hidden" name="idGP" value="<?php echo $row3['idGP']; ?>">
                                <input type="hidden" name="Action" value="<?php echo $row3['Action']; ?>">
                                <input type="hidden" name="idBGP" value="<?php echo $row3['idBGP']; ?>">
                                <input type="submit" name="reurnGP" class="btn btn-view" value="Return">
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
                    url: "searchBorrow.php",
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