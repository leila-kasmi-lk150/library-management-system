<?php
include('../../../../private/conn.php');

if(isset($_POST['get'])){
$idUser=$_POST['idUser'];
$idBook = $_POST['view_id'];
$Action = $_POST['Action'];
$idR = $_POST['idR'];

$query=mysqli_query($conn, "INSERT INTO `borrow` (`idUser`, `idBook`, `Action`) VALUES ('$idUser', '$idBook','$Action')");
$query2= mysqli_query($conn, "DELETE FROM request WHERE idR='$idR'");

if ($query2&&$query) {
    header("Location: ../request.php?success='get it'");
} else {
    header("Location: ../request.php?error='error'");
}
}

if(isset($_POST['getGP'])){
    $idUser=$_POST['idUser'];
    $idGP = $_POST['view_id'];
    $Action = $_POST['Action'];
    $idR = $_POST['idRGP'];
    
    $query=mysqli_query($conn, "INSERT INTO `borrow_gp` (`idUser`, `idGP`, `Action`) VALUES ('$idUser', '$idGP','$Action')");
    $query2= mysqli_query($conn, "DELETE FROM request_gp WHERE idRGP='$idR'");
    
    if ($query2&&$query) {
        header("Location: ../request.php?success='get it'");
    } else {
        header("Location: ../request.php?error='error'");
    }
    }

?>