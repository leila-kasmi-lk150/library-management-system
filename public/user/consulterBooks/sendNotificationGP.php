<?php
include('../../../private/conn.php');
$idGP=$_GET['idGP'];
$idUser=$_GET['idUser'];
$idCategorie =$_GET['idCategorie'];

$notification =mysqli_num_rows(mysqli_query($conn,"SELECT * FROM notifications_gp WHERE idUser=$idUser AND idGP=$idGP AND send='0'"));

if ($notification==0) {
   


$query=mysqli_query($conn, "INSERT INTO notifications_gp(idUser, idGP,send,message) VALUES ('$idUser', '$idGP','0','The graduation project Is Currently Available')");

if ($query) {
    header("Location: viewGP.php?idCategorie=$idCategorie&idGP=$idGP");
} else {
    # code...
    header("Location: viewGP.php?idCategorie=$idCategorie&idGP=$idGP");
}
}else {
    # code...
    header("Location: viewGP.php?idCategorie=$idCategorie&idGP=$idGP");
}

?>