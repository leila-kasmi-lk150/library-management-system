<?php
session_start();
if (isset($_SESSION['idUser']) && $_SESSION['userType'] == 'admin') {
    ?>
    <?php
    include('../includes/header.php');
    include('../../../private/conn.php');
    ?>
    <style>
        <?php
        include('../assets/css/section.css');
        include('../assets/css/popup-form.css');
        ?>
    </style>
    <?php
    $idCategorie = $_GET["idCategorie"];
    $query = "SELECT * FROM typebook WHERE idCategorie='$idCategorie'";
    $query_run = mysqli_query($conn, $query);

    // css for active section in navbar 
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
    ?>
    <center>
        <div class="search-container">
            <form action="search.php" method="POST">
                <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                <input type="text" placeholder="Search..." name="search" id="live_search">
                <button type="submit" name="searchButton"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <!-- </div> -->
    </center>
    <center>
        <?php if (isset($_GET['error_type'])) { ?>
            <p class="error">
                <?php echo $_GET['error_type']; ?>
            </p>
        <?php } ?>
        <?php if (isset($_GET['success_type'])) { ?>
            <p class="success">
                <?php echo $_GET['success_type']; ?>
            </p>
        <?php } ?>


        

        <!-- delet type -->
        <div id="result"></div>

        <div class="cardBox" id="cardBox">
            <?php
            if (mysqli_num_rows($query_run) > 0) {
                while ($row = mysqli_fetch_assoc($query_run)) {
                    ?>
                    <form action="viewBook.php" method="post">
                        <button type="submit" id="go_to" name="go_to">
                            <div class="numbers">
                                <?php echo $row["nbrTypeBook"]; ?>
                            </div>
                            <div class="cardName">
                                <?php echo $row["typeBook"] ?>
                            </div>
                            <input type="hidden" name="idType" value="<?php echo $row['idType']; ?>">
                            <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                        </button>
                    </form>
                    <?php
                }
                ?>
                <form action="graduationProject.php" method="post">
                    <button type="submit" id="go_to" name="go_to">
                        <div class="numbers"><i class="fa fa-graduation-cap"></i></div>
                        <div class="cardName">Graduation Project</div>
                        <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                    </button>
                </form>

                <?php
            } else {
                echo "No Record Found";
            }
            ?>
        </div>
    </center>

    <!-- search script  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
   


    <!-- close or open form of add new type  -->
    <script>
        let loginForm = document.querySelector('.form-container');
        document.querySelector('#add_type').onclick = () => {
            loginForm.classList.toggle('active');
        }

        document.querySelector('#close-btn').onclick = () => {
            loginForm.classList.remove('active');
        }
    </script>

    <!-- close or open form of delet type  -->
    <script>
        let loginFormDelet = document.querySelector('.form-container-delet');
        document.querySelector('#delet_type').onclick = () => {
            loginFormDelet.classList.toggle('active');
        }

        document.querySelector('#close-btn-delet').onclick = () => {
            loginFormDelet.classList.remove('active');
        }
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