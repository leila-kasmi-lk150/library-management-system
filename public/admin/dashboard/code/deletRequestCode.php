<?php
include('../../../../private/conn.php');

if(isset($_POST['delete_btn'])){
$idRequest=$_POST['idRequest'];
$idBook = $_POST['idBook'];

$query=mysqli_query($conn, "DELETE FROM request WHERE idR='$idRequest'");
$query2= mysqli_query($conn, "UPDATE books SET nbrCopy=nbrCopy+1 WHERE idBook='$idBook'");

if ($query2&&$query) {
    header("Location: ../request.php?success='Request Deleted'");
} else {
    header("Location: ../request.php?error='error'");
}
}
if(isset($_POST['delete_btnGP'])){
    $idRequest=$_POST['idRequest'];
    $idGP = $_POST['idGP'];
    
    $query=mysqli_query($conn, "DELETE FROM request_gp WHERE idRGP='$idRequest'");
    $query2= mysqli_query($conn, "UPDATE graduation_project SET nbrCopy=nbrCopy+1 WHERE idGP='$idGP'");
    
    if ($query2&&$query) {
        header("Location: ../request.php?success='Request Deleted'");
    } else {
        header("Location: ../request.php?error='error'");
    }
    }
?>