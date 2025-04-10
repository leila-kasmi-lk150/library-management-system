<?php
session_start();
if (isset($_SESSION['idUser']) && $_SESSION['userType'] == 'admin') {
    ?>
    <?php
    include('../includes/header.php');
    include('../../../private/conn.php');
    ?>
    <style>
        <?php include('../assets/css/section.css'); ?>
        #settings {
            padding: 5px;
            border-bottom: 5px solid white;
        }
    </style>
    <?php {
        ?>
        <div class="viewBook">
            <div class="typeName">Publisher</div>
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

                <div class="search-container">
                    <input type="text" placeholder="Search..." name="search" id="live_search">
                    <button type="submit" name="searchButton"><i class="fa fa-search"></i></button>
                </div>
                <button id="add_book" name="add_book" type="submit" title="Add new"><i class="fa fa-plus"></i> <a
                        href="addPublisher.php">Add new</a></button>
            </div>

            <br />
            <hr>
            <div id="result"></div>
            <div id="myTable">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">S.L</th>
                            <th class="text-center" scope="col">publisher</th>
                            <th class="text-center" scope="col">Edit</th>
                            <th class="text-center" scope="col">Delete</th>
                        </tr>
                    </thead>
                    <?php
                    $sql = "SELECT * FROM publisher";
                    $sql_run = mysqli_query($conn, $sql);
                    $count = 1;


                    if (mysqli_num_rows($sql_run) > 0) {
                        $count = 1;
                        while ($row = mysqli_fetch_assoc($sql_run)) {



                            ?>

                            <tr id="tr">
                                <td class='text-center'>
                                    <?php echo $count; ?>
                                </td>
                                <td class='text-left'>
                                    <?php echo $row["publisher"]; ?>
                                </td>
                                <td class='text-center'>
                                    <center>
                                        <span style="width: 50%; background-color: transparent;" class="editSpan">
                                            <form action="edit.php" method="post">
                                                <input type="hidden" name="edit_id" value="<?php echo $row['idPublisher']; ?>">
                                                <button type="submit" name="editP" class="btn btn-edit"><i
                                                        class='fa fa-edit'></i></button>
                                            </form>

                                        </span>
                                    </center>
                                </td>
                                <td class='text-center'>
                                    <center>
                                        <span style="width: 50%; background-color: transparent;" class="deletSpan">
                                            <form action="code/delet.php" method="post">
                                                <input type="hidden" name="delete_id" value="<?php echo $row['idPublisher']; ?>">
                                                <button style="width: 100%" type="submit" name="deleteP" class="btn btn-danger"><i
                                                        class='fa fa-trash'></i></button>
                                            </form>
                                        </span>
                                    </center>
                                </td>
                            </tr>
                            <?php
                            $count = $count + 1;
                        }
                    } else {
                        echo "No Record Found";
                    }
                    ?>
                </table>
            </div>
        </div>





        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#live_search").keyup(function () {
                    var input = $(this).val();
                    // if(input != ""){
                    $.ajax({
                        url: "liveSearchPublisher.php",
                        method: "POST",
                        data: {
                            input: input
                        },

                        success: function (data) {
                            $("#result").html(data);
                            $("#myTable").css("display", "none");
                        }
                    });
                });
            });
        </script>
        <?php
    }
    include('../includes/scripts.php');
?>
<?php
} else {
    header("Location: ../../home/index.php");
    exit();
}
?>