<?php
include('../../../../private/conn.php');

if(isset($_POST['delete_btn']))
{
    $idBook = $_POST['delete_id'];
    $idType = $_POST['returnIdType'];
    $idCategorie = $_POST['idCategorie'];

    $query = "DELETE FROM books WHERE idBook='$idBook' ";

    $query_run = mysqli_query($conn, $query);
    $queryWrit = mysqli_query($conn,"DELETE FROM writ WHERE idBook='$idBook' ");
    $queryBorrow = mysqli_query($conn,"DELETE FROM borrow WHERE idBook='$idBook' ");
    $queryComments = mysqli_query($conn,"DELETE FROM comments WHERE idBook='$idBook' ");
    $queryNotifications = mysqli_query($conn,"DELETE FROM notifications WHERE idBook='$idBook' ");
    $queryRequest = mysqli_query($conn,"DELETE FROM request WHERE idBook='$idBook' ");
    $querySaved = mysqli_query($conn,"DELETE FROM saved WHERE idBook='$idBook' ");

    if($query_run)
    {
        header("Location: ../viewBook.php?success=The book has been deleted&idTypeReturn=$idType&idCategorie=$idCategorie");
	    exit();
    }
    else
    {
        header("Location: ../viewBook.php?error=Error&idTypeReturn=$idType&idCategorie=$idCategorie");
	    exit();
    }    
}

?>