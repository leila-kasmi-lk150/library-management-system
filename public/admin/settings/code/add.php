<?php
include('../../../../private/conn.php');

if (isset($_POST['addP'])) {
    $publisher = $_POST['publisher'];

    $query_publisher_test = mysqli_query($conn, "SELECT * FROM publisher WHERE publisher='$publisher'");


    if(mysqli_num_rows($query_publisher_test) == 0) {
        $query_publisher_insert = mysqli_query($conn, "INSERT INTO publisher(publisher) VALUES ('$publisher')");
        if ($query_publisher_insert) {
            header("Location: ../publisher.php?success=New piblisher has been added");
            exit();
        } else {
            header("Location: ../publisher.php?error=Error");
            exit();
        }
    
    }else {
        header("Location: ../publisher.php?error=This publisher exists");
        exit();
    } 
    
}


if (isset($_POST['addL'])) {
    $language = $_POST['language'];

    $query_language_test = mysqli_query($conn, "SELECT * FROM language WHERE language='$language'");


    if(mysqli_num_rows($query_language_test) == 0) {
        $query_language_insert = mysqli_query($conn, "INSERT INTO language(language) VALUES ('$language')");
        if ($query_language_insert) {
            header("Location: ../language.php?success=New piblisher has been added");
            exit();
        } else {
            header("Location: ../language.php?error=Error");
            exit();
        }
    
    }else {
        header("Location: ../language.php?error=This language exists");
        exit();
    } 
}


if (isset($_POST['addA'])) {
    $author = $conn->real_escape_string(trim($_POST['NameA']));
    $aboutAuthor=$conn->real_escape_string(trim($_POST['aboutAuthor']));

    $query_author_test = mysqli_query($conn, "SELECT idAuthor FROM authors WHERE author='$author'");


    if(mysqli_num_rows($query_author_test) == 0) {
        $query_author_insert = mysqli_query($conn, "INSERT INTO authors(author,aboutAuthor) VALUES ('$author','$aboutAuthor')");
        if ($query_author_insert) {
            header("Location: ../authors.php?success=New author has been added");
            exit();
        } else {
            header("Location: ../authors.php?error=Error");
            exit();
        }
    
    }else {
        header("Location: ../authors.php?error=This author exists");
        exit();
    } 
}


if (isset($_POST['addT'])) {
    $typeBook = $conn->real_escape_string(trim($_POST['typeBook']));
    $nbrTypeBook=$_POST['nbrTypeBook'];
    $idCategorie=$_POST['idCategorie'];

    $query_type_test = mysqli_query($conn, "SELECT idType FROM typebook WHERE typebook='$typeBook'");
    $nbrTypeBook_test = mysqli_query($conn,"SELECT * FROM typebook WHERE nbrTypeBook='$nbrTypeBook'");
    if (mysqli_num_rows($nbrTypeBook_test) != 0) {
        header("Location: ../type.php?error=This Number Type exists");
        exit();
    } else if(mysqli_num_rows($query_type_test) == 0) {
        $query_type_insert = mysqli_query($conn, "INSERT INTO typebook(typeBook,nbrTypeBook,idCategorie) VALUES ('$typeBook','$nbrTypeBook','$idCategorie')");
        if ($query_type_insert) {
            header("Location: ../type.php?success=New Type has been added");
            exit();
        } else {
            header("Location: ../type.php?error=Error");
            exit();
        }
    
    }else {
        header("Location: ../type.php?error=This Type exists");
        exit();
    } 
}
?>