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
        include '../assets/css/addBooks.css';
        ?>

        #settings {
            padding: 5px;
            border-bottom: 5px solid white;
        }
    </style>
    <?php
    if (isset($_POST['editL'])) {
        $idLanguage = $_POST['edit_id'];
        $query = "SELECT * FROM language WHERE idLanguage='$idLanguage'";
        $query_run = mysqli_query($conn, $query);
        foreach ($query_run as $row) {
            ?>
            <center>
                <form action="code/editCode.php" method="post" enctype="multipart/form-data" id="formValidation">
                    <h2><a href="language.php" style="margin-right: 30px;"><i class="fa fa-reply"></i></a> Edit The Language</h2>
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
                    <input type="hidden" name="idLanguage" value="<?php echo $idLanguage; ?>">

                    <div class="input-row">
                        <label>Language</label>
                        <input type="text" name="language" value="<?= $row['language']; ?>" required>
                        <br>
                    </div>



                    <div class="input-row">
                        <button type="submit" name="editL">Edit</button>
                    </div>
                    <div style="margin:20px;"></div>

                </form>

                <div style="margin:80px;"></div>

            </center>
            <?php
        }
    }
    ?>
    <?php
    if (isset($_POST['editT'])) {
        $idType = $_POST['edit_id'];
        $query = "SELECT * FROM typebook,categorie WHERE typebook.idCategorie=categorie.idCategorie AND idType='$idType'";
        $query_run = mysqli_query($conn, $query);
        foreach ($query_run as $row) {
            ?>
            <center>
                <form action="code/editCode.php" method="post" enctype="multipart/form-data" id="formValidation">
                    <h2><a href="type.php" style="margin-right: 30px;"><i class="fa fa-reply"></i></a> Edit Type</h2>
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
                    <input type="hidden" name="idType" value="<?php echo $idType; ?>">

                    <div class="input-row">
                        <label>Type</label>
                        <input type="text" name="typeBook" id="typeBook" value="<?=$row['typeBook'] ?>" required>
                        <br>
                    </div>


                    <div class="input-row">
                        <label>Number Type Book</label>
                        <input type="number" name="nbrTypeBook" value="<?=$row['nbrTypeBook'] ?>" required>
                        <br>
                    </div>

                    <div class="input-row">
                        <label>Categorie</label><br>
                        <select name="idCategorie" id="select">
                            <option value="<?= $row['idCategorie'] ?>"><?= $row['categorie'] ?></option>
                            <option value="1">Computer Science</option>
                            <option value="2">Maths</option>
                            <option value="3">Physics</option>
                            <option value="4">Chemistry</option>
                        </select>
                        <br>
                    </div>



                    <div class="input-row">
                        <button type="submit" name="editT">Edit</button>
                    </div>
                    <div style="margin:20px;"></div>

                </form>

                <div style="margin:80px;"></div>

            </center>
            <?php
        }
    }
    ?>
    <?php
    if (isset($_POST['editP'])) {
        $idPublisher = $_POST['edit_id'];
        $query = "SELECT * FROM publisher WHERE idPublisher='$idPublisher'";
        $query_run = mysqli_query($conn, $query);
        foreach ($query_run as $row) {
            ?>
            <center>
                <form action="code/editCode.php" method="post" enctype="multipart/form-data" id="formValidation">
                    <h2><a href="publisher.php" style="margin-right: 30px;"><i class="fa fa-reply"></i></a> Edit The Publisher</h2>
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
                    <input type="hidden" name="idPublisher" value="<?php echo $idPublisher; ?>">

                    <div class="input-row">
                        <label>Publisher</label>
                        <input type="text" name="publisher" value="<?= $row['publisher']; ?>" required>
                        <br>
                    </div>



                    <div class="input-row">
                        <button type="submit" name="editP">Edit</button>
                    </div>
                    <div style="margin:20px;"></div>

                </form>

                <div style="margin:80px;"></div>

            </center>
            <?php
        }
    }
    ?>

    <?php
    if (isset($_POST['editA'])) {
        $idAuthor = $_POST['edit_id'];
        $query = "SELECT * FROM authors WHERE idAuthor='$idAuthor'";
        $query_run = mysqli_query($conn, $query);
        foreach ($query_run as $row) {
            ?>
            <center>
                <form action="code/editCode.php" method="post" enctype="multipart/form-data" id="formValidation">
                    <h2><a href="authors.php" style="margin-right: 30px;"><i class="fa fa-reply"></i></a> Edit the author</h2>
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
                    <input type="hidden" name="idAuthor" value="<?php echo $idAuthor; ?>">

                    <div class="input-row">
                        <label>Name</label>
                        <input type="text" name="NameA" value="<?= $row['author']; ?>" required>
                        <br>
                    </div>


                    <div class="input-row">
                        <label>About Author</label>
                        <textarea name="aboutAuthor" value="<?= $row['aboutAuthor']; ?>" cols="30"
                            rows="10"><?= $row['aboutAuthor']; ?></textarea>
                        <br>
                    </div>



                    <div class="input-row">
                        <button type="submit" name="editA">Edit</button>
                    </div>
                    <div style="margin:20px;"></div>

                </form>

                <div style="margin:80px;"></div>

            </center>
            <?php
        }
    }
    ?>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="../assets/js/addBookValidation.js"></script>


    <?php

    include('../includes/scripts.php');
?>
<?php
} else {
    header("Location: ../../home/index.php");
    exit();
}
?>