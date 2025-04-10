<?php
session_start();
if (isset($_SESSION['idUser']) && $_SESSION['userType'] == 'admin') {
    ?>
    <?php
    include('../includes/header.php');
    include('../../../private/conn.php');
    ?>

    <head>
    </head>
    <style>
        <?php
        include('../assets/css/section.css');
        include '../assets/css/addBooks.css';

        ?>
        #settings {
            padding: 5px;
            border-bottom: 5px solid white;
        }
    </style>
    <center>


        <form action="code/add.php" method="post">

            <h2><a href="publisher.php" style="margin-right: 30px;"><i class="fa fa-reply"></i></a> Add New Publisher</h2>
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

            <div class="input-row">
                <label>Publisher</label>
                <input type="text" name="publisher" id="" placeholder="Enter Name Publisher" required>
                <br>
            </div>




            <button type="submit" name="addP">ADD</button>
            <div style="margin: 50px;"></div>
        </form>
    </center>
    <div style="margin: 100px"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="../assets/js/addMemberValidation.js"></script>
    <?php


    ?>






    <script type="text/javascript">
        $(".chosen").chosen();
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