<?php
include('../../../../private/conn.php');

if (isset($_POST['add'])) {

    $idCategorie = $_POST['idCategorie'];
    $nameBook = $conn->real_escape_string(trim($_POST['name_book']));
    $parallelTitele = $conn->real_escape_string(trim($_POST['parallel_titele']));
    // image


    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];


    // ====****====



    $summary = $conn->real_escape_string(trim($_POST['summary']));




    $hardCover = $_POST['hard_cover'];

    // ===============ID publisher=========== 

    $publisher = strtoupper($_POST['publisher']);
    $publisher2 = strtoupper($_POST['publisher2']);

    if (empty($publisher2)) {
        $query_get_id_publisher = mysqli_query($conn, "SELECT idPublisher FROM publisher WHERE publisher='$publisher'");
        $row_publisher = mysqli_fetch_assoc($query_get_id_publisher);
        $idPublisher = $row_publisher['idPublisher'];
    } else {
        $query_publisher_test = mysqli_query($conn, "SELECT * FROM publisher WHERE publisher='$publisher2'");
        if (mysqli_num_rows($query_publisher_test) == 0) {
            $query_publisher_insert = mysqli_query($conn, "INSERT INTO publisher(publisher) VALUES ('$publisher2')");
            $query_get_id_publisher = mysqli_query($conn, "SELECT idPublisher FROM publisher WHERE publisher='$publisher2'");
            $row_publisher = mysqli_fetch_assoc($query_get_id_publisher);
            $idPublisher = $row_publisher['idPublisher'];
        } else {
            $row_publisher = mysqli_fetch_assoc($query_publisher_test);
            $idPublisher = $row_publisher['idPublisher'];
        }
    }
    // =============*******========
    $dateOfPublisher = $_POST['date_of_publisher'];

    // ===============ID LANGUAGE=========== 

    $language = ucwords($_POST['language']);
    $language2 = ucwords($_POST['language2']);

    if (empty($language2)) {
        $query_get_id_language = mysqli_query($conn, "SELECT idLanguage FROM language WHERE language='$language'");
        $row_language = mysqli_fetch_assoc($query_get_id_language);
        $idLanguage = $row_language['idLanguage'];
    } else {
        $query_language_test = mysqli_query($conn, "SELECT * FROM language WHERE language='$language2'");
        if (mysqli_num_rows($query_language_test) == 0) {
            $query_language_insert = mysqli_query($conn, "INSERT INTO language(language) VALUES ('$language2')");
            $query_get_id_language = mysqli_query($conn, "SELECT idLanguage FROM language WHERE language='$language2'");
            $row_language = mysqli_fetch_assoc($query_get_id_language);
            $idLanguage = $row_language['idLanguage'];
        } else {
            $row_language = mysqli_fetch_assoc($query_language_test);
            $idLanguage = $row_language['idLanguage'];
        }
    }

    // =============*******========

    $quantity = $_POST['quantity'];




    // 
    $idType = $_POST['idType'];
    $nbrBook = $_POST['cote'];

    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);

    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
    $img_upload_path = 'uploadsBook/' . $new_img_name;
    move_uploaded_file($tmp_name, $img_upload_path);



    $isbn = $_POST['isbn'];
    $isbnTest = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM books WHERE isbn='$isbn'"));
    if ($isbnTest != '0') {
        $em = "isbn exixt";
        header("Location: ../viewBook.php?idTypeReturn=$idType&error=$em&idCategorie=$idCategorie");
        exit();
    }
    $coteTest = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM books WHERE nbrBook='$nbrBook' AND idType='$idType'"));
    if ($coteTest != '0') {
        $em = "cote exsit";
        header("Location: ../viewBook.php?idTypeReturn=$idType&error=$em&idCategorie=$idCategorie");
        exit();
    }
    $query = "INSERT INTO books( nameBook, parallelTitele, image, summary, hardCover, dateOfPublisher, isbn, quantity, idType, nbrBook, idPublisher, idLanguage, idCategorie) VALUES('$nameBook', '$parallelTitele', '$new_img_name', '$summary', '$hardCover', '$dateOfPublisher' ,'$isbn', '$quantity', '$idType', '$nbrBook', '$idPublisher', '$idLanguage',  '$idCategorie')";
    $query_run = mysqli_query($conn, $query);

    $getIdBook = mysqli_fetch_assoc(mysqli_query($conn, "SELECT idBook FROM books WHERE isbn='$isbn' AND nameBook='$nameBook'"));
    $idBook = $getIdBook['idBook'];








    // ===============ID author=========== 

    $selectedAuthors = $_POST['idAuthors'];

    if (!empty($selectedAuthors)) {
        // Remove duplicate author IDs
        $uniqueAuthors = array_unique($selectedAuthors);

        $values = array();
        foreach ($uniqueAuthors as $authorId) {
            // Check if the combination of idBook and idAuthor already exists
            $checkQuery = "SELECT * FROM writ WHERE idBook = '$idBook' AND idAuthor = '$authorId'";
            $result = mysqli_query($conn, $checkQuery);
            if (mysqli_num_rows($result) == 0) {
                $values[] = "('$idBook', '$authorId')";
            }
        }

        if (!empty($values)) {
            $insertQuery = "INSERT INTO writ (idBook, idAuthor) VALUES " . implode(",", $values);
            mysqli_query($conn, $insertQuery);
            // Redirect or display a success message
            // ...
        } else {
            // No unique combinations to insert
            // Handle the error or display a message
            // ...
        }
    }




    if ($query_run) {
        $em = "Book added";
        header("Location: ../viewBook.php?idTypeReturn=$idType&success=$em&idCategorie=$idCategorie");

    } else {
        $em = "error";
        header("Location: ../viewBook.php?idTypeReturn=$idType&error=$em&idCategorie=$idCategorie");
    }
}
// }




// }