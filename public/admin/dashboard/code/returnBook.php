<?php
include('../../../../private/conn.php');

if(isset($_POST['get'])){
$idUser=$_POST['idUser'];
$idBook = $_POST['idBook'];
$idB = $_POST['idB'];

$query=mysqli_query($conn, "UPDATE borrow SET isReturn='1', dateReturn= now() WHERE idB='$idB'");
$query2= mysqli_query($conn, "UPDATE books SET nbrCopy=nbrCopy+1 WHERE idBook='$idBook'");

if ($query2&&$query) {
    header("Location: ../index.php?success='book return'");
} else {
    header("Location: ../index.php?error='error'");
}
}
if(isset($_POST['reurnGP'])){
    $idUser=$_POST['idUser'];
    $idGP = $_POST['idGP'];
    $idBGP = $_POST['idBGP'];
    
    $query=mysqli_query($conn, "UPDATE borrow_gp SET isReturn='1', dateReturn= now() WHERE idBGP='$idBGP'");
    $query2= mysqli_query($conn, "UPDATE graduation_project SET nbrCopy=nbrCopy+1 WHERE idGP='$idGP'");
    
    if ($query2&&$query) {
        header("Location: ../index.php?success='graduation project return'");
    } else {
        header("Location: ../index.php?error='error'");
    }
    }

?>