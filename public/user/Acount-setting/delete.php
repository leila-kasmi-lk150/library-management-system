<?php
session_start();
if (isset($_SESSION['idUser'])) {
    $idUser = $_SESSION['idUser'];

    include('../../../private/conn.php');
    if (isset($_POST['deletN'])) {
        $idN = $_POST['idN'];

        $query = mysqli_query($conn, "DELETE FROM notifications WHERE idN=$idN");

        if($query){
            header("Location: notification.php?success=Notification has been deleted");
            exit();
            }else{
                header("Location: notification.php?error=error");
                exit();
        }
    }
    if (isset($_POST['deletNGP'])) {
        $idN = $_POST['idN'];

        $query = mysqli_query($conn, "DELETE FROM notifications_gp WHERE idNGP=$idN");

        if($query){
        header("Location: notification.php?success=Notification has been deleted");
        exit();
        }else{
            header("Location: notification.php?error=error");
            exit();
        }
    }

    if (isset($_POST['deletS'])) {
        $idS = $_POST['idS'];

        $query = mysqli_query($conn, "DELETE FROM saved WHERE idS=$idS");

        if($query){
            header("Location: sived.php?success=success");
            exit();
            }else{
                header("Location: sived.php?error=error");
                exit();
        }
    }

    if (isset($_POST['deletSGP'])) {
        $idS = $_POST['idS'];

        $query = mysqli_query($conn, "DELETE FROM saved_gp WHERE idSGP=$idS");

        if($query){
            header("Location: sived.php?success=success");
            exit();
            }else{
                header("Location: sived.php?error=error");
                exit();
        }
    }
    if (isset($_POST['deletComment'])) {
        $idC = $_POST['idC'];
        $idBook = $_POST['idBook'];
        $idType = $_POST['idType'];
        $idCategorie=$_POST['idCategorie'];

        $query = mysqli_query($conn, "DELETE FROM comments WHERE idC=$idC");

        if($query){
            header("Location: ../consulterBooks/viewBook.php?success=success&idCategorie=$idCategorie&idBook=$idBook&idType=$idType");
            exit();
            }else{
                header("Location: ../consulterBooks/viewBook.php?error=error&idCategorie=$idCategorie&idBook=$idBook&idType=$idType");
                exit();
        }
    }

    if (isset($_POST['deletCommentGP'])) {
        $idC = $_POST['idC'];
        $idGP = $_POST['idGP'];
        $idCategorie=$_POST['idCategorie'];

        $query = mysqli_query($conn, "DELETE FROM comments_gp WHERE idCGP=$idC");

        if($query){
            header("Location: ../consulterBooks/viewGP.php?success=success&idCategorie=$idCategorie&idGP=$idGP");
            exit();
            }else{
                header("Location: ../consulterBooks/viewGP.php?error=error&idCategorie=$idCategorie&idGP=$idGP");
                exit();
        }
    }
} else {
    header("Location: ../../home/index.php");
    exit();
}