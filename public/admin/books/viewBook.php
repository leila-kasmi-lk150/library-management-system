<?php
session_start();
if (isset($_SESSION['idUser']) && $_SESSION['userType'] == 'admin') {
    ?>
    <?php
    include('../includes/header.php');
    include('../../../private/conn.php');
    ?>
    <style>
        <?php include('../assets/css/section.css');
        ?>
    </style>
    <?php
    if (isset($_POST['go_to'])) {

        $idType = $_POST['idType'];
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
        $query = "SELECT * FROM typeBook WHERE idType=$idType ";
        $query_run = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($query_run);

        $query2 = "SELECT * FROM books WHERE  idType='$idType' ORDER BY `nbrBook` ASC";
        $query_run2 = mysqli_query($conn, $query2);
        ?>

        <div class="viewBook">
            <div class="typeName">
                <?php echo $row['typeBook']; ?>
            </div>
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


            <div style="display: flex;">
                <form action="addBook.php" method="post">
                    <input type="hidden" name="idType" value="<?php echo $row['idType']; ?>">
                    <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                    <button id="add_book" name="add_book" type="submit"><i class="fa fa-plus"></i>Add new</button>

                </form>
                <div class="search-container">
                    <input type="text" placeholder="Search..." name="search" id="live_search">
                    <button type="submit" name="searchButton"><i class="fa fa-search"></i></button>
                </div>
            </div>
            <div id="result"></div>
            <table class="table table-bordered table-striped table-hover" id="myTable">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">Cote</th>
                        <th class="text-center" scope="col">Book</th>
                        <th class="text-center" scope="col">Auther</th>
                        <th class="text-center" scope="col">date Of Publisher</th>
                        <th class="text-center" scope="col">ISBN</th>
                        <th class="text-center" scope="col">IMAGE</th>
                        <th class="text-center" scope="col">View</th>
                        <th class="text-center" scope="col">Edit</th>
                        <th class="text-center" scope="col">Delete</th>
                    </tr>
                </thead>

                <?php
                if (mysqli_num_rows($query_run2) > 0) {
                    $count = 1;
                    while ($row2 = mysqli_fetch_assoc($query_run2)) {

                        ?>

                        <tr>
                            <td class='text-center'>
                                <?php echo $row2['nbrBook']; ?>
                            </td>
                            <td class='text-left'>
                                <?php echo $row2['nameBook']; ?>
                            </td>
                            <td class='text-left'>
                                <?php
                                $idBook = $row2['idBook'];
                                $author = mysqli_query($conn, "SELECT * FROM authors,writ WHERE writ.idAuthor=authors.idAuthor AND writ.idBook='$idBook'");
                                if (mysqli_num_rows($author) > 0) {
                                    while ($rowA = mysqli_fetch_assoc($author)) {
                                        echo "<br>";
                                        echo $rowA['author'];

                                    }
                                } else {
                                    echo "0";
                                } ?>
                            </td>
                            <td class='text-left'>
                                <?php echo $row2['dateOfPublisher']; ?>
                            </td>
                            <td class='text-center'>
                                <?php echo $row2['isbn']; ?>
                            </td>
                            <td class='text-center'>
                                <?php
                                if (!empty($row2['image'])) {
                                    ?>
                                    <img src="code/uploadsBook/<?php echo $row2['image'] ?>" alt="" width="150">
                                    <?php
                                } else{
                                ?>
                                <img src="code/uploadsBook/empty.jpg" alt="" width="150">
                                <?php } ?>
                            </td>
                            <td class='text-center'>
                                <span class="viewSpan">
                                    <form action="viewBookCard.php" method="post">
                                        <input type="hidden" name="returnIdType" value="<?php echo $idType ?>">
                                        <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                        <input type="hidden" name="view_id" value="<?php echo $row2['idBook']; ?>">
                                        <button type="submit" name="view_btn" class="btn btn-view"><i class='fa fa-eye'></i></button>
                                    </form>
                                </span>
                            </td>
                            <td class='text-center'>
                                <span class="editSpan">
                                    <form action="editBook.php" method="post">
                                        <input type="hidden" name="returnIdType" value="<?php echo $idType ?>">
                                        <input type="hidden" name="edit_id" value="<?php echo $row2['idBook']; ?>">
                                        <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                        <button type="submit" name="edit_btn" class="btn btn-edit"><i class='fa fa-edit'></i></button>
                                    </form>
                                </span>
                            </td>
                            <td class='text-center'>
                                <span class="deletSpan">
                                    <form action="code/deletBookCode.php" method="post">
                                        <input type="hidden" name="returnIdType" value="<?php echo $idType ?>">
                                        <input type="hidden" name="delete_id" value="<?php echo $row2['idBook']; ?>">
                                        <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                        <button type="submit" name="delete_btn" class="btn btn-danger"
                                            onclick="return confirm('are you sure?')"><i class='fa fa-trash'></i></button>
                                    </form>
                                </span>
                            </td>
                            <?php
                    }



                }
                
                else {
                    echo "No Record Found";
                }

                ?>
                </tr>


            </table>
        </div>

        <?php
    } else
    // if (isset($_GET['idTypeReturn'])) 
    {

        $idType = $_GET['idTypeReturn'];
        $idCategorie = $_GET['idCategorie'];

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


        $query = "SELECT * FROM typeBook WHERE idType=$idType ";
        $query_run = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($query_run);


        $query2 = "SELECT * FROM books WHERE idType=$idType ORDER BY `books`.`nbrBook` ASC";
        $query_run2 = mysqli_query($conn, $query2);
        ?>

        <div class="viewBook">
            <div class="typeName">
                <?php echo $row['typeBook']; ?>
            </div>

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

            <div style="display: flex;">
                <form action="addBook.php" method="post">
                    <input type="hidden" name="idType" value="<?php echo $row['idType']; ?>">
                    <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                    <button id="add_book" name="add_book" type="submit"><i class="fa fa-plus"></i> Add new</button>
                </form>

                <div class="search-container">
                    <input type="text" placeholder="Search..." name="search" id="live_search">
                    <button type="submit" name="searchButton"><i class="fa fa-search"></i></button>
                </div>
            </div>
            <div id="result"></div>


            <table class="table table-bordered table-striped table-hover" id="myTable">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">Cote</th>
                        <th class="text-center" scope="col">Book</th>
                        <th class="text-center" scope="col">Auther</th>
                        <th class="text-center" scope="col">date Of Publisher</th>
                        <th class="text-center" scope="col">ISBN</th>
                        <th>Image</th>
                        <th class="text-center" scope="col">View</th>
                        <th class="text-center" scope="col">Edit</th>
                        <th class="text-center" scope="col">Delete</th>
                    </tr>
                </thead>

                <?php
                if (mysqli_num_rows($query_run2) > 0) {
                    $count = 1;
                    while ($row2 = mysqli_fetch_assoc($query_run2)) {

                        ?>

                        <tr>
                            <td class='text-center'>
                                <?php echo $row2['nbrBook']; ?>
                            </td>
                            <td class='text-left'>
                                <?php echo $row2['nameBook']; ?>
                            </td>
                            <td class='text-left'>
                                <?php
                                $idBook = $row2['idBook'];
                                $author = mysqli_query($conn, "SELECT * FROM authors,writ WHERE writ.idAuthor=authors.idAuthor AND writ.idBook='$idBook'");
                                if (mysqli_num_rows($author) > 0) {
                                    while ($rowA = mysqli_fetch_assoc($author)) {
                                        echo "<br>";
                                        echo $rowA['author'];
                                        echo "<br>";

                                    }
                                } else {
                                    echo "0";
                                } ?>
                            </td>
                            <td class='text-left'>
                                <?php echo $row2['dateOfPublisher']; ?>
                            </td>
                            <td class='text-center'>
                                <?php echo $row2['isbn']; ?>
                            </td>
                            <td class='text-center'>
                                <?php
                                if (!empty($row2['image'])) {
                                    ?>
                                    <img src="code/uploadsBook/<?php echo $row2['image'] ?>" alt="" width="150">
                                    <?php
                                }else{
                                ?>
                                <img src="code/uploadsBook/empty.jpg" alt="" width="150">
                                <?php } ?>
                            </td>
                            <td class='text-center'>
                                <span class="viewSpan">
                                    <form action="viewBookCard.php" method="post">
                                        <input type="hidden" name="returnIdType" value="<?php echo $idType ?>">
                                        <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                        <input type="hidden" name="view_id" value="<?php echo $row2['idBook']; ?>">
                                        <button type="submit" name="view_btn" class="btn btn-view"><i class='fa fa-eye'></i></button>
                                    </form>
                                </span>
                            </td>
                            <td class='text-center'>
                                <span class="editSpan">
                                    <form action="editBook.php" method="post">
                                        <input type="hidden" name="returnIdType" value="<?php echo $idType ?>">
                                        <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                        <input type="hidden" name="edit_id" value="<?php echo $row2['idBook']; ?>">
                                        <button style="padding: 5px;" type="submit" name="edit_btn" class="btn btn-edit"><i
                                                class='fa fa-edit'></i></button>
                                    </form>
                                </span>
                            </td>
                            <td class='text-center'>
                                <span class="deletSpan">
                                    <form action="code/deletBookCode.php" method="post">
                                        <input type="hidden" name="returnIdType" value="<?php echo $idType ?>">
                                        <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                        <input type="hidden" name="delete_id" value="<?php echo $row2['idBook']; ?>">
                                        <button type="submit" name="delete_btn" class="btn btn-danger"
                                            onclick="return confirm('are you sure?')"><i class='fa fa-trash'></i></button>
                                    </form>
                                </span>
                            </td>
                            <?php
                    }
                } else {
                    echo "No Record Found";
                }

                ?>
                </tr>


            </table>
        </div>

        <?php
    }
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        var idCategorie = "<?php echo $idCategorie; ?>";
        var idType = "<?php echo $idType; ?>";
        $(document).ready(function () {
            $("#live_search").keyup(function () {
                var input = $(this).val();
                // if(input != ""){
                $.ajax({
                    url: "searchBook.php",
                    method: "POST",
                    data: {
                        input: input,
                        idCategorie: idCategorie,
                        idType: idType
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
?>
<?php
} else {
    header("Location: ../../home/index.php");
    exit();
}
?>