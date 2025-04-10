<?php
    session_start();
    if (isset($_SESSION['idUser'])) {
       $idUser=$_SESSION['idUser'];

       include('../../../private/conn.php');
if (isset($_POST['sendBtn'])) {
    $send=$_POST['send'];

    $query=mysqli_query($conn, "UPDATE users SET sendNotify=$send WHERE idUser=$idUser");
   
        header("Location: notification.php");
        exit();
}


}else{
    header("Location: ../../home/index.php");
    exit();
  }