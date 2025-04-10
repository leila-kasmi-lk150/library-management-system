<?php
include('../../../../private/conn.php');


if (isset($_POST['get'])) {
    $idBook=$_POST['idBook'];
    $idUser=$_POST['idUser'];
    
    $query=mysqli_query($conn, "INSERT INTO notifications(idUser, idBook,send,message) VALUES ('$idUser', '$idBook','1','Return the book, the specified period has been exceeded')");
    
    if ($query) {
        header("Location: ../lateBookReturn.php?success='the Notification send'");
    } else {
        header("Location: ../lateBookReturn.php?error='error'");
    }
}

if (isset($_POST['getGP'])) {
    $idGP=$_POST['idGP'];
    $idUser=$_POST['idUser'];
    
    $query=mysqli_query($conn, "INSERT INTO notifications_gp(idUser, idGP,send,message) VALUES ('$idUser', '$idGP','1','Return the graduation project, the specified period has been exceeded')");
    
    if ($query) {
        header("Location: ../lateBookReturn.php?success='the Notification send'");
    } else {
        header("Location: ../lateBookReturn.php?error='error'");
    }
}
?>