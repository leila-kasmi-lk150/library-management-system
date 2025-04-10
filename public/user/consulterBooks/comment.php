<?php
session_start();
if (isset($_SESSION['idUser'])) {
    $idUser = $_SESSION['idUser'];

    include('../../../private/conn.php');
    
    
    if (isset($_POST['addComment'])) {
        $text= $_POST['msg'];
        $msg = mysqli_real_escape_string($conn, $text);

        $idBook =$_POST['idBook'];
        $idType =$_POST['idType'];
        $idCategorie=$_POST['idCategorie'];
        if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM comments WHERE iduser=$idUser AND idBook=$idBook"))==0) {
            # code...
        

        

        $sqlAddComment = mysqli_query($conn,"INSERT INTO `comments` ( `idBook`, `idUser`, `comment`) VALUES ('$idBook', '$idUser', '$msg')");
        if ($sqlAddComment) {
            header("Location: ../consulterBooks/viewBook.php?success=success&idCategorie=$idCategorie&idBook=$idBook&idType=$idType");
            exit();
            }else{
                header("Location: ../consulterBooks/viewBook.php?error=error&idCategorie='$idCategorie'&idBook=$idBook&idType=$idType");
            exit();
        }
    } else {
        $err = "<script>alert('you cant add more than one comment');</script>";
        header("Location: ../consulterBooks/viewBook.php?errorAdd=$err&idCategorie='$idCategorie'&idBook=$idBook&idType=$idType");
        exit();
    }
    }
    if (isset($_POST['editComment'])) {
        $idBook =$_POST['idBook'];
        $idType =$_POST['idType'];
        $idCategorie=$_POST['idCategorie'];
        $text= $_POST['msg'];
        $msg = mysqli_real_escape_string($conn, $text);
        $idC = $_POST['idC'];

        $run = mysqli_query($conn, "UPDATE comments SET comment='$msg' WHERE idC=$idC ");
        if ($run) {
            header("Location: ../consulterBooks/viewBook.php?success=success&idCategorie=$idCategorie&idBook=$idBook&idType=$idType");
            exit();
            }else{
                header("Location: ../consulterBooks/viewBook.php?error=error&idCategorie='$idCategorie'&idBook=$idBook&idType=$idType");
            exit();
        }
    }
    

    
    

} else {
    header("Location: ../../home/index.php");
    exit();
}