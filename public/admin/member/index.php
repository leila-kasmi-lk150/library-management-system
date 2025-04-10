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
        #member {
            padding: 5px;
            border-bottom: 5px solid white;
        }
    </style>
    <?php {
        ?>
        <div class="viewBook">
            <div class="typeName">Members</div>
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
                        href="addMember.php">Add new</a></button>
                <a href="block.php" type="submit" id ="export" style="background-color: #a55352;" ><i class="fa fa-user-times"></i>Block</a>
                <a href="code/export.php" id="export" title="Export"><i class="fa fa-download"></i> Export</a>

            </div>


            <!-- <a href="block.php" id ="export" style="background-color: #a55352;"><i class="fa fa-user-times"></i>Block</a> -->
            <!-- <input type="search" name="" placeholder="search here..." id="live_search" class="navbar-search"> -->
            <br />
            <hr>
            <div id="result"></div>
            <table class="table table-bordered table-striped table-hover" id="myTable">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">S.L</th>
                        <th>Type</th>
                        <th class="text-center" scope="col">Name</th>
                        <th class="text-center" scope="col">EMAIL</th>
                        <th class="text-center" scope="col">SPECIALTY</th>
                        <th class="text-center" scope="col">ADRESS</th>
                        <th class="text-center" scope="col">View</th>
                        <th class="text-center" scope="col">Edit</th>
                        <th class="text-center" scope="col">Delete</th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM users WHERE userType!='admin'";
                $sql_run = mysqli_query($conn, $sql);

                if (mysqli_num_rows($sql_run) > 0) {
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($sql_run)) {



                        ?>

                        <tr id="tr">
                            <td class='text-center'>
                                <?php echo $count; ?>
                            </td>
                            <td class='text-left'>
                                <?php echo $row['email']; ?>
                            </td>
                            <td class='text-left'>
                                <?php echo $row["firstName"];
                                echo " ";
                                echo $row["lastName"]; ?>
                            </td>
                            <td class='text-left'>
                                <?php echo $row['email']; ?>
                            </td>
                            <td class='text-left'>
                                <?php echo $row["specialty"];
                                echo " ";
                                echo $row["level"]; ?>
                            </td>
                            <td class='text-center'>
                                <?php echo $row['adress']; ?>
                            </td>

                            <td class='text-center'>
                                <span class="viewSpan">
                                    <form action="viewMember.php" method="post">
                                        <input type="hidden" name="view_id" value="<?php echo $row['idUser']; ?>">
                                        <button type="submit" name="view_btn" class="btn btn-view"><i class='fa fa-eye'></i></button>
                                    </form>
                                </span>
                            </td>
                            <td class='text-center'>
                                <span class="editSpan">
                                    <form action="editMember.php" method="post">
                                        <input type="hidden" name="edit_id" value="<?php echo $row['idUser']; ?>">
                                        <button type="submit" name="edit_btn" class="btn btn-edit"><i class='fa fa-edit'></i></button>
                                    </form>

                                </span>
                            </td>
                            <td class='text-center'>
                                <span class="deletSpan">
                                    <form action="code/deletMember.php" method="post">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['idUser']; ?>">
                                        <button type="submit" name="delete_btn" class="btn btn-danger"><i
                                                class='fa fa-trash'></i></button>
                                    </form>
                                </span>
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





        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#live_search").keyup(function () {
                    var input = $(this).val();
                    // if(input != ""){
                    $.ajax({
                        url: "liveSearch.php",
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
    }
    include('../includes/scripts.php');
?>
<?php
} else {
    header("Location: ../../home/index.php");
    exit();
}
?>