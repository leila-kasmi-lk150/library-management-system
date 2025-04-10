<?php
include('../../../../private/conn.php');

if (isset($_POST['editP'])) {
    $publisher = $_POST['publisher'];
    $idPublisher = $_POST['idPublisher'];

    $query_publisher_test = mysqli_query($conn, "SELECT * FROM publisher WHERE publisher='$publisher' AND idPublisher!='$idPublisher'");


    if(mysqli_num_rows($query_publisher_test) == 0) {
        $query_publisher_insert = mysqli_query($conn, "UPDATE publisher SET publisher='$publisher' WHERE idPublisher='$idPublisher'");
        if ($query_publisher_insert) {
            header("Location: ../publisher.php?success=Info piblisher has been modified");
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


if (isset($_POST['editL'])) {
    $language = $_POST['language'];
    $idLanguage=$_POST['idLanguage'];

    $query_language_test = mysqli_query($conn, "SELECT * FROM language WHERE language='$language' AND idLanguage!='$idLanguage'");


    if(mysqli_num_rows($query_language_test) == 0) {
        $query_language_insert = mysqli_query($conn, "UPDATE language SET language='$language' WHERE idLanguage='$idLanguage'");
        if ($query_language_insert) {
            header("Location: ../language.php?success=Info piblisher has been modified");
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


if (isset($_POST['editA'])) {
    $author = $conn->real_escape_string(trim($_POST['NameA']));
    $aboutAuthor=$conn->real_escape_string(trim($_POST['aboutAuthor']));
    $idAuthor=$_POST['idAuthor'];

    $query_author_test = mysqli_query($conn, "SELECT idAuthor FROM authors WHERE author='$author' AND idAuthor!='$idAuthor'");


    if(mysqli_num_rows($query_author_test) == 0) {
        $query_author_insert = mysqli_query($conn, "UPDATE authors SET author='$author',aboutAuthor='$aboutAuthor' WHERE idAuthor='$idAuthor'");
        if ($query_author_insert) {
            header("Location: ../authors.php?success=Info author has been modified");
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

if (isset($_POST['editT'])) {
    $typeBook = $conn->real_escape_string(trim($_POST['typeBook']));
    $nbrTypeBook=$_POST['nbrTypeBook'];
    $idCategorie=$_POST['idCategorie'];
    $idType=$_POST['idType'];

    $query_type_test = mysqli_query($conn, "SELECT idType FROM typebook WHERE typebook='$typeBook' AND idType!='$idType'");
    $nbrTypeBook_test = mysqli_query($conn,"SELECT * FROM typebook WHERE nbrTypeBook='$nbrTypeBook' AND idType!='$idType'");
    if (mysqli_num_rows($nbrTypeBook_test) != 0) {
        header("Location: ../type.php?error=This Number Type exists");
        exit();
    } else if(mysqli_num_rows($query_type_test) == 0) {
        $query_type_insert = mysqli_query($conn, "UPDATE typebook SET typeBook='$typeBook',nbrTypeBook='$nbrTypeBook',idCategorie='$idCategorie' WHERE idType='$idType'");
        if ($query_type_insert) {
            header("Location: ../type.php?success=info Type has been modified");
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