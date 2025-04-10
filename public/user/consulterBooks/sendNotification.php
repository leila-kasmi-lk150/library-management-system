<?php
include('../../../private/conn.php');
$idBook=$_GET['idBook'];
$idUser=$_GET['idUser'];
$idType = $_GET['idType'];
$idCategorie =$_GET['idCategorie'];


$notification =mysqli_num_rows(mysqli_query($conn,"SELECT * FROM notifications WHERE idUser=$idUser AND idBook=$idBook AND send='0'"));

if ($notification==0) {
   
$query=mysqli_query($conn, "INSERT INTO notifications(idUser, idBook,send,message) VALUES ('$idUser', '$idBook','0','The Book Is Currently Available')");

if ($query) {
    header("Location: viewBook.php?idCategorie='$idCategorie'&idBook='$idBook'&idType='$idType'");
} else {
    header("Location: viewBook.php?idCategorie='$idCategorie'&idBook='$idBook'&idType='$idType'");
}
}else {
    header("Location: viewBook.php?idCategorie='$idCategorie'&idBook='$idBook'&idType='$idType'");
}
?>