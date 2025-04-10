<?php
include('../../../../private/conn.php');

if (isset($_POST['deleteP'])) {
    $idPublisher = $_POST['delete_id'];

        $queryBook=mysqli_query($conn,"UPDATE books SET idPublisher='' WHERE idPublisher='$idPublisher'");
        $query_publisher_insert = mysqli_query($conn, "DELETE FROM publisher  WHERE idPublisher='$idPublisher'");
        if ($query_publisher_insert) {
            header("Location: ../publisher.php?success=Info piblisher has been deleted");
            exit();
        } else {
            header("Location: ../publisher.php?error=Error");
            exit();
        }
}


if (isset($_POST['deleteL'])) {
    $idLanguage=$_POST['delete_id'];
    $queryBook=mysqli_query($conn,"UPDATE books SET idLanguage='' WHERE idLanguage='$idLanguage'");
        $query_language_insert = mysqli_query($conn, "DELETE FROM language WHERE idLanguage='$idLanguage'");
        if ($query_language_insert) {
            header("Location: ../language.php?success=Info language has been deleted");
            exit();
        } else {
            header("Location: ../language.php?error=Error");
            exit();
        }
    
}


if (isset($_POST['deleteA'])) {
    $idAuthor=$_POST['delete_id'];
    $writ=mysqli_query($conn,"DELETE FROM writ WHERE idAuthor='$idAuthor'");
        $query_author_insert = mysqli_query($conn, "DELETE FROM authors WHERE idAuthor='$idAuthor'");
        if ($query_author_insert) {
            header("Location: ../authors.php?success=Info author has been deleted");
            exit();
        } else {
            header("Location: ../authors.php?error=Error");
            exit();
        }
    
}

if (isset($_POST['deleteT'])) {
    $idType=$_POST['delete_id'];
        $query_author_insert = mysqli_query($conn, "DELETE FROM typebook WHERE idType='$idType'");
        if ($query_author_insert) {
            header("Location: ../type.php?success=Type has been deleted");
            exit();
        } else {
            header("Location: ../type.php?error=Error");
            exit();
        }
    
}
?>