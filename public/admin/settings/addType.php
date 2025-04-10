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

    <!--  -->
        <form action="code/add.php" method="post" id="formValidation">

            <h2><a href="type.php" style="margin-right: 30px;"><i class="fa fa-reply"></i></a> Add New Type</h2>
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
                <label>Type</label>
                <input type="text" name="typeBook" id="typeBook" placeholder="Enter Type" required>
                <br>
            </div>


            <div class="input-row">
                <label>Number Type Book</label>
                <input type="number" name="nbrTypeBook"  placeholder="Number type Book" required>
                <br>
            </div>

            <div class="input-row">
                <label>Categorie</label><br>
                <select name="idCategorie" id="select">
                    <option value="1">Computer Science</option>
                    <option value="2">Maths</option>
                    <option value="3">Physics</option>
                    <option value="4">Chemistry</option>
                </select>
                <br>
            </div>


            <button type="submit" name="addT">ADD</button>
            <div style="margin: 50px;"></div>
        </form>
    </center>
    <div style="margin: 100px"></div>
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