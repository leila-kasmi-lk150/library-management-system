<?php
session_start();
if (isset($_SESSION['idUser'])) {
    $idUser = $_SESSION['idUser'];

    include('../../../private/conn.php');
    
    
    if (isset($_POST['addComment'])) {
        $text= $_POST['msg'];
        $msg = mysqli_real_escape_string($conn, $text);

        $idGP =$_POST['idGP'];
        $idCategorie=$_POST['idCategorie'];
        if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM comments_gp WHERE iduser=$idUser AND idGP=$idGP"))==0) {
            # code...
        

        

        $sqlAddComment = mysqli_query($conn,"INSERT INTO `comments_gp` ( `idGP`, `idUser`, `comment`) VALUES ('$idGP', '$idUser', '$msg')");
        if ($sqlAddComment) {
            header("Location: ../consulterBooks/viewGP.php?success=success&idCategorie=$idCategorie&idGP=$idGP");
            exit();
            }else{
                header("Location: ../consulterBooks/viewGP.php?error=error&idCategorie='$idCategorie'&idGP=$idGP");
            exit();
        }
    } else {
        $err = "<script>alert('you cant add more than one comment');</script>";
        header("Location: ../consulterBooks/viewGP.php?errorAdd=$err&idCategorie='$idCategorie'&idGP=$idGP");
        exit();
    }
    }
    if (isset($_POST['editComment'])) {
        $idGP =$_POST['idGP'];
        $idCategorie=$_POST['idCategorie'];
        $text= $_POST['msg'];
        $msg = mysqli_real_escape_string($conn, $text);
        $idC = $_POST['idC'];

        $run = mysqli_query($conn, "UPDATE comments_gp SET comment='$msg' WHERE idCGP=$idC ");
        if ($run) {
            header("Location: ../consulterBooks/viewGP.php?success=success&idCategorie=$idCategorie&idGP=$idGP");
            exit();
            }else{
                header("Location: ../consulterBooks/viewGP.php?error=error&idCategorie='$idCategorie'&idGP=$idGP");
            exit();
        }
    }
    

    
    

} else {
    header("Location: ../../home/index.php");
    exit();
}