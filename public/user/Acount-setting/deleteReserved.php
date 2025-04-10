<?php
session_start();
if (isset($_SESSION['idUser'])) {
    $idUser = $_SESSION['idUser'];

    include('../../../private/conn.php');
    if (isset($_POST['deletR'])) {
        $idR = $_POST['idR'];
        $idBook = $_POST['idBook'];

        $query = mysqli_query($conn, "DELETE FROM request WHERE idR=$idR");
        $request2 = mysqli_query($conn, "UPDATE books SET nbrCopy=nbrCopy+1 WHERE idBook='$idBook' ");

        if ($query) {
            header("Location: reserved.php?success=Request has been deleted");
            exit();
        } else {
            header("Location: reserved.php?error=error");
            exit();
        }
    }
    if (isset($_POST['deletNGP'])) {
        $idR = $_POST['idR'];
        $idGP = $_POST['idGP'];

        $query = mysqli_query($conn, "DELETE FROM request_gp WHERE idRGP=$idR");
        $request2 = mysqli_query($conn, "UPDATE graduation_project SET nbrCopy=nbrCopy-1 WHERE idGP='$idGP' ");

        if ($query) {
            header("Location: reserved.php?success=Request has been deleted");
            exit();
        } else {
            header("Location: reserved.php?error=error");
            exit();
        }
    }
} else {
    header("Location: ../../home/index.php");
    exit();
}