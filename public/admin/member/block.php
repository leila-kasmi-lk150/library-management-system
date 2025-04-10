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
            <div class="typeName">Block Members</div>
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
            <center>
                <div class="search-container">
                    <input type="text" placeholder="Search..." name="search" id="live_search">
                    <button type="submit" name="searchButton"><i class="fa fa-search"></i></button>
                </div>
            </center>

            <form action="code/blockCode.php" method="post">
            <button type="submit" id="export" style="background-color: #a55352;" name="blockAll"><i
                    class="fa fa-user-times"></i>Block All</button>
            </form>


            <div id="result"></div>
            <div id="myTable" style="display: block;">
                <table class="table table-bordered table-striped table-hover" style="width: 100%">

                    <thead style="width: 100%">
                        <tr style="width: 100%">
                            <th class="text-center" scope="col">S.L</th>
                            <th class="text-center" scope="col">Name</th>
                            <th class="text-center" scope="col">EMAIL</th>
                            <th class="text-center" scope="col">SPECIALTY</th>
                            <th class="text-center" scope="col">ADRESS</th>
                            <th>Action</th>
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
                                    <?php
                                    if ($row['block'] == '1') {
                                        ?>
                                    <td class='text-center'>
                                        <span class="viewSpan">
                                            <form action="code/blockCode.php" method="post">
                                                <input type="hidden" name="idUser" value="<?php echo $row['idUser']; ?>">
                                                <button type="submit" name="deblock" class="btn btn-view"><i class="fas fa-user"></i>
                                                </button>
                                            </form>
                                        </span>
                                    </td>
                                    <?php
                                    } else {
                                        ?>
                                    <td class='text-center'>
                                        <span class="deletSpan">
                                            <form action="code/blockCode.php" method="post">
                                                <input type="hidden" name="idUser" value="<?php echo $row['idUser']; ?>">
                                                <button type="submit" name="block" class="btn btn-danger"><i
                                                        class="fas fa-user-slash"></i>
                                                </button>
                                            </form>
                                        </span>
                                    </td>
                                    <?php
                                    }
                                    ?>
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
                        url: "liveSearchBlock.php",
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