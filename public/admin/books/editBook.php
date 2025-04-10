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
    </style>
    <?php
    if (isset($_POST['edit_btn'])) {
        $idType = $_POST['returnIdType'];
        $idCategorie = $_POST['idCategorie'];
        if ($idCategorie == '1') { ?>
            <style>
                #info {
                    padding: 5px;
                    border-bottom: 5px solid white;
                }
            </style>
        <?php } else if ($idCategorie == '2') { ?>
                <style>
                    #maths {
                        padding: 5px;
                        border-bottom: 5px solid white;
                    }
                </style>
        <?php } else if ($idCategorie == '3') { ?>
                    <style>
                        #physics {
                            padding: 5px;
                            border-bottom: 5px solid white;
                        }
                    </style>
        <?php } else if ($idCategorie == '4') { ?>
                        <style>
                            #chemistry {
                                padding: 5px;
                                border-bottom: 5px solid white;
                            }
                        </style>
        <?php } ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <?php
        $idBook = $_POST['edit_id'];
        $query = "SELECT * FROM books,publisher,language WHERE language.idLanguage=books.idLanguage AND publisher.idPublisher=books.idPublisher AND idBook='$idBook'";
        $query_run = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
            <center>
                <form action="code/editBookCode.php" method="post" enctype="multipart/form-data" id="formValidation">
                    <h2><a href="viewBook.php?idTypeReturn=<?php echo $idType; ?>&idCategorie=<?php echo $idCategorie; ?>"
                            style="margin-right: 30px;"><i class="fa fa-reply"></i></a> Edit The Book</h2>
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
                    <input type="hidden" name="idType" value="<?php echo $idType ?>">
                    <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                    <input type="hidden" name="idBook" value="<?php echo $idBook; ?>">
                    <div class="input-row">
                        <label>Name Book</label>
                        <input type="text" name="name_book" id="name_book" placeholder="Name Book"
                            value="<?php echo $row['nameBook'] ?>" required>
                        <br>
                    </div>
                    <div class="input-row">
                        <label>Parallel Titele</label>
                        <input type="text" name="parallel_titele" placeholder="Parallel Titele"
                            value="<?php echo $row['parallelTitele'] ?>">
                        <br>
                    </div>
                    <!-- ================================ Authors =========================== -->

                    <?php
                    $countA = '0';
                    $Authors_fetch_all = mysqli_query($conn, "SELECT * FROM authors,writ WHERE writ.idAuthor=authors.idAuthor AND writ.idBook='$idBook'");
                    while ($leila = mysqli_fetch_array($Authors_fetch_all)) {
                        $countA++;
                        ?>
                        <div>
                        <label for="">Author
                            <?php echo $countA; ?>
                        </label><br>
                        <select name="idAuthors[]" class="authors" id="select">
                            <option value="<?= $leila['idAuthor']?>"><?= $leila['author']?></option>
                            <?php
                            $queryAuthor = "SELECT * FROM authors";
                            $result = mysqli_query($conn, $queryAuthor);
                            while ($row22 = mysqli_fetch_assoc($result)) {
                                $authorId = $row22['idAuthor'];
                                $authorName = $row22['author'];
                                echo '<option value="' . $authorId . '">' . $authorName . '</option>';
                            }
                            ?>
                        </select>
                        <?php
                        if ($countA == 1) {
                            echo "<a name='addAuthor' class='addOption addAuthor'><i class='fa fa-plus'></i></a><br>";
                        } else {
                            echo "<a type='button' name='remove' class='addOption remove'><i class='fa'>-</i></a><br>";
                        }
                        echo "</div>";
                        
                    }
                    ?>
                    <div class="divAddAuthors"></div>
                    <!-- ================================ END Authors =========================== -->
                    <div class="input-row">
                        <input type="hidden" name="img" value="<?php echo $row['image']; ?>">
                        <label>Image</label>
                        <center><img src="code/uploadsBook/<?php echo $row['image'] ?>" alt="" width="150"></center>
                        <input type="file" name="my_image" id="image" accept="image/*">
                        <br>
                    </div>
                    <div class="input-row">
                        <label>Summary</label>
                        <textarea name="summary" placeholder="Summary" id=""
                            value="<?php echo $row['summary'] ?>"><?php echo $row['summary'] ?></textarea>
                        <br>
                    </div>
                    <div class="input-row">
                        <label>Hard Cover</label>
                        <input type="number" name="hard_cover" placeholder="Hard Cover" value="<?php echo $row['hardCover'] ?>"
                            min="0">
                        <br>
                    </div>
                    <label>Publisher</label>
                    <div class="selectDiv">
                        <select name="publisher" id="select" value="<?php echo $row['publisher']; ?>"
                            required><!-- class="chosen" -->
                            <option style="text-transform: uppercase;" value="<?php echo $row['publisher']; ?>"> <?= $row["publisher"] ?></option>
                            <?php
                            $query_publisher = "SELECT * FROM publisher ORDER BY `publisher`.`publisher` ASC";
                            $query_run_publisher = mysqli_query($conn, $query_publisher);
                            if (mysqli_num_rows($query_run_publisher) > 0) {
                                while ($row_publisher = mysqli_fetch_assoc($query_run_publisher)) {
                                    ?>
                                    <option value="<?php echo $row_publisher['publisher']; ?>"><?= $row_publisher["publisher"] ?></option>
                                    <?php
                                }
                            } else {
                                echo "No Record Found";
                            }
                            ?>
                        </select>
                        <a class="addOption" onclick="show_publisher()"><i class="fa fa-plus"></i></a>
                        <div class="wrapper" id="wrapper_publisher">
                            <div class="content_publisher">
                                <div class="input-row">
                                    <label>Add publisher</label>
                                    <input type="text" name="publisher2" id="publisher2" placeholder="Add publisher"
                                        style="text-transform: uppercase;">
                                    <br>
                                </div>
                                <a class="addOption" onclick="hide_publisher()">Close</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="input-row">
                        <label>Date Of Publisher</label>
                        <select class="form-control" value="<?php echo $row['dateOfPublisher'] ?>" name="date_of_publisher"
                            id="select">
                            <option value="<?php echo $row['dateOfPublisher'] ?>"><?php echo $row['dateOfPublisher'] ?></option>
                            <?php
                            for ($year = (int) date('Y'); 1900 <= $year; $year--): ?>
                                <option value="<?php echo $year; ?>"><?= $year; ?></option>
                            <?php endfor; ?>
                        </select>
                        <br>
                    </div>
                    <label>Language</label>
                    <div class="selectDiv">
                        <select name="language" id="select" value="<?php echo $row['language']; ?>" required>
                            <option style="text-transform: uppercase;" value="<?php echo $row['language']; ?>"><?= $row["language"] ?> </option>
                            <?php
                            $query_language = "SELECT * FROM language";
                            $query_run_language = mysqli_query($conn, $query_language);
                            if (mysqli_num_rows($query_run_language) > 0) {
                                while ($row_language = mysqli_fetch_assoc($query_run_language)) {
                                    ?>
                                    <option value="<?php echo $row_language['language']; ?>"><?= $row_language["language"] ?></option>
                                    <?php
                                }
                            } else {
                                echo "No Record Found";
                            }
                            ?>
                        </select>
                        <a class="addOption" onclick="show_language()"><i class="fa fa-plus"></i></a>
                        <div class="wrapper" id="wrapper_language">
                            <div class="content_language">
                                <div class="input-row">
                                    <label>Add language</label>
                                    <input type="text" name="language2" id="language2" placeholder="Add language"
                                        style="text-transform: capitalize;">
                                    <br>
                                </div>
                                <a class="addOption" onclick="hide_language()">Close</a>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="input-row">
                        <label>Quantity</label>
                        <input type="number" name="quantity" placeholder="Quantity " value="<?php echo $row['quantity'] ?>" required
                            min="0">
                        <br>
                    </div>
                    <div class="input-row">
                        <label>ISBN</label>
                        <input type="number" name="isbn" placeholder="ISBN" value="<?php echo $row['isbn'] ?>" min="0">
                        <br>
                    </div>
                    <div class="input-row">
                        <label>Cote</label>
                        <input type="number" name="cote" placeholder="Cote" value="<?php echo $row['nbrBook'] ?>" required min="0">
                        <br>
                    </div>
                    <div class="input-row">
                        <label>categorie</label>
                        <input type="number" name="categorie" placeholder="Categorie" value="<?php echo $row['idCategorie'] ?>"
                            required min="0">
                        <br>
                    </div>
                    <div class="input-row">
                        <button type="submit" name="edit">Edit</button>
                    </div>
                    <div style="margin:20px;"></div>
                </form>
                <div style="margin:80px;"></div>
            </center>
            <?php
        }
    }
    ?>

    <script>
        $(document).ready(function () {
            var count = <?php echo $countA ?>;

            $(document).on('click', '.addAuthor', function () {
                count++;
                var html = '';
                html += '<div>';
                html += 'Author ' + count + '<br>';
                html += '<select id="select" name="idAuthors[]" class="authors"><option value="">Select Author</option>';

                // Fetch authors dynamically using PHP and store them in a JavaScript variable
                var authors = <?php
                $query = "SELECT * FROM authors";
                $result = mysqli_query($conn, $query);
                $authors = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $authors[] = $row;
                }
                echo json_encode($authors);
                ?>;

                authors.forEach(function (author) {
                    html += '<option value="' + author.idAuthor + '">' + author.author + '</option>';
                });

                html += '</select>';
                html += '<a type="button" name="remove" class="addOption remove"><i class="fa">-</i></a>';
                html += '</div>';

                $('.divAddAuthors').append(html);
            });
            $(document).on('click', '.remove', function () {
                $(this).closest('div').remove();
            });
        });
    </script>
    <script type="text/javascript">

        function show_publisher() {
            document.getElementById('wrapper_publisher').classList.add('active');
        }
        function hide_publisher() {
            document.getElementById("publisher2").value = "";
            document.getElementById('wrapper_publisher').classList.remove('active');
        }
        function show_language() {
            document.getElementById('wrapper_language').classList.add('active');
        }
        function hide_language() {
            document.getElementById("language2").value = "";
            document.getElementById('wrapper_language').classList.remove('active');
        }
    </script>
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