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

    <!-- action="code/add.php" -->
        <form action="code/add.php" method="post" id="formValidation">

            <h2><a href="authors.php" style="margin-right: 30px;"><i class="fa fa-reply"></i></a> Add New Author</h2>
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
                <label>Name</label>
                <input type="text" name="NameA" id="NameA" placeholder="Enter Name Author" required>
                <br>
            </div>


            <div class="input-row">
                <label>About Author</label>
                <textarea name="aboutAuthor" id="" cols="30" rows="10" placeholder="Enter Biography"></textarea>
                <br>
            </div>


            <button type="submit" name="addA">ADD</button>
            <div style="margin: 50px;"></div>
        </form>
    </center>
    <div style="margin: 100px"></div>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="../assets/js/addBookValidation.js"></script>
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