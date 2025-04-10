<?php
session_start();
if (isset($_SESSION['idUser'])) {
    $idUser = $_SESSION['idUser'];

    include('../../../private/conn.php');
    if (isset($_POST['deletN'])) {
        $idN = $_POST['idN'];

        $query = mysqli_query($conn, "DELETE FROM notifications WHERE idN=$idN");

        if($query){
            header("Location: viewBook?success=Notification has been deleted");
            exit();
            }else{
                header("Location: viewBook?error=error");
                exit();
        }
    }
    

    


} else {
    header("Location: ../../home/index.php");
    exit();
}