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
        $query = "SELECT * FROM categorie WHERE idCategorie=$idCategorie";
        $query_run = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($query_run);

        $query2 = "SELECT * FROM graduation_project WHERE idCategorie='$idCategorie'";
        $query_run2 = mysqli_query($conn, $query2);
        ?>

        <div class="viewBook">
            <div class="typeName">Graduation Project
                <?php echo $row['categorie']; ?>
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


            <div class="search-box">
                <form action="addGP.php" method="post">
                    <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                    <button id="add_book" name="add_book" type="submit"><i class="fa fa-plus"></i>Add new</button>

                </form>

                <div class="search-container">
                    <input type="text" placeholder="Search..." name="search" id="live_search">
                    <button type="submit" name="searchButton"><i class="fa fa-search"></i></button>
                </div>
            </div>
            <div id="result"></div>
            <div id="myTable" style="display: block;">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Cote</th>
                            <th>Titel</th>
                            <th>Auther</th>
                            <th>Year</th>
                            <th>Lavel</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <?php
                    if (mysqli_num_rows($query_run2) > 0) {
                        $count = 1;
                        while ($row2 = mysqli_fetch_assoc($query_run2)) {
                            $idGP = $row2['idGP'];

                            // select authors that have the same coteG 
                            $author = mysqli_query($conn, "SELECT * FROM authors_gp WHERE idGP='$idGP'");

                            ?>

                            <tr>
                                <td class='text-center'>
                                    <?php echo $row2['coteG']; ?>
                                </td>
                                <td class='text-left'>
                                    <?php echo $row2['title']; ?>
                                </td>
                                <td class='text-left'>


                                    <?php
                                    while ($rowA = mysqli_fetch_assoc($author)) {
                                        echo $rowA['name'];
                                        echo "<br>";
                                    }
                                    ?>

                                </td>
                                <td class='text-left'>
                                    <?php echo $row2['year']; ?>
                                </td>
                                <td class='text-center'>
                                    <?php echo $row2['level']; ?>
                                </td>
                                <td class='text-center'>
                                    <span class="viewSpan">
                                        <form action="viewGPcard.php" method="post">
                                            <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                            <input type="hidden" name="view_id" value="<?php echo $row2['idGP']; ?>">
                                            <button type="submit" name="view_btn" class="btn btn-view"><i
                                                    class='fa fa-eye'></i></button>
                                        </form>
                                    </span>
                                </td>
                                <td class='text-center'>
                                    <span class="editSpan">
                                        <form action="editGP.php" method="post">
                                            <input type="hidden" name="edit_id" value="<?php echo $row2['idGP']; ?>">
                                            <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                            <button type="submit" name="edit_btn" class="btn btn-edit"><i
                                                    class='fa fa-edit'></i></button>
                                        </form>
                                    </span>
                                </td>
                                <td class='text-center'>
                                    <span class="deletSpan">
                                        <form action="code/deletGPcode.php" method="post">
                                            <input type="hidden" name="delete_id" value="<?php echo $row2['idGP']; ?>">
                                            <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                            <button type="submit" name="delete_btn" class="btn btn-danger"><i
                                                    class='fa fa-trash'></i></button>
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
        </div>

    <?php
    } else
    // if (isset($_GET['idTypeReturn'])) 
    {

        $idCategorie = $_GET['idCategorie'];

        $query = "SELECT * FROM categorie WHERE idCategorie='$idCategorie'";
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


        $row = mysqli_fetch_assoc($query_run);


        $query2 = "SELECT * FROM graduation_project WHERE idCategorie='$idCategorie'";
        $query_run2 = mysqli_query($conn, $query2);
        ?>

        <div class="viewBook">
            <div class="typeName">Graduation Project
                <?php echo $row['categorie']; ?>
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

            <form action="addGP.php" method="post">
                <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                <button id="add_book" name="add_book" type="submit"><i class="fa fa-plus"></i> Add new</button>
                <!-- <input type="text" placeholder="Search" class="navbar-search" /> -->
            </form>

            <div class="search-box">
                <div class="search-container">
                    <input type="text" placeholder="Search..." name="search" id="live_search">
                    <button type="submit" name="searchButton"><i class="fa fa-search"></i></button>
                </div>
            </div>
            <div id="result"></div>


            <div id="myTable" style="display: block;">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Cote</th>
                            <th>Titel</th>
                            <th>Auther</th>
                            <th>Year</th>
                            <th>Lavel</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <?php
                    if (mysqli_num_rows($query_run2) > 0) {
                        $count = 1;
                        while ($row2 = mysqli_fetch_assoc($query_run2)) {
                            $idGP = $row2['idGP'];

                            // select authors that have the same coteG 
                            $author = mysqli_query($conn, "SELECT * FROM authors_gp WHERE idGP='$idGP'");



                            ?>

                            <tr>
                                <td class='text-center'>
                                    <?php echo $row2['coteG']; ?>
                                </td>
                                <td class='text-left'>
                                    <?php echo $row2['title']; ?>
                                </td>
                                <td class='text-left'>
                                    <?php
                                    while ($rowA = mysqli_fetch_assoc($author)) {
                                        echo $rowA['name'];
                                        echo "<br>";
                                    }
                                    ?>
                                </td>
                                <td class='text-left'>
                                    <?php echo $row2['year']; ?>
                                </td>
                                <td class='text-center'>
                                    <?php echo $row2['level']; ?>
                                </td>
                                <td class='text-center'>
                                    <span class="viewSpan">
                                        <form action="viewGPCard.php" method="post">
                                            <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                            <input type="hidden" name="view_id" value="<?php echo $row2['idGP']; ?>">
                                            <button type="submit" name="view_btn" class="btn btn-view"><i
                                                    class='fa fa-eye'></i></button>
                                        </form>
                                    </span>
                                </td>
                                <td class='text-center'>
                                    <span class="editSpan">
                                        <form action="editGP.php" method="post">
                                            <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                            <input type="hidden" name="edit_id" value="<?php echo $row2['idGP']; ?>">
                                            <button type="submit" name="edit_btn" class="btn btn-edit"><i
                                                    class='fa fa-edit'></i></button>
                                        </form>
                                    </span>
                                </td>
                                <td class='text-center'>
                                    <span class="deletSpan">
                                        <form action="code/deletGPcode.php" method="post">
                                            <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                            <input type="hidden" name="delete_id" value="<?php echo $row2['idGP']; ?>">
                                            <button type="submit" name="delete_btn" class="btn btn-danger"><i
                                                    class='fa fa-trash'></i></button>
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
        </div>

    <?php
    }
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        var idCategorie = "<?php echo $idCategorie; ?>";
        $(document).ready(function () {
            $("#live_search").keyup(function () {
                var input = $(this).val();
                // if(input != ""){
                $.ajax({
                    url: "searchGP.php",
                    method: "POST",
                    data: {
                        input: input,
                        idCategorie: idCategorie
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