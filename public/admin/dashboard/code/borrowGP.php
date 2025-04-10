<?php
include('../../../../private/conn.php');

if (isset($_POST['borrow'])) {
    $codeUser = $_POST['codeUser'];
    $idUserQ = mysqli_fetch_assoc(mysqli_query($conn, "SELECT idUser FROM users WHERE codeUser='$codeUser'"));
    $idUser = $idUserQ['idUser'];

    $coteGP = $_POST['coteGP'];
    $idGPQ = mysqli_fetch_assoc(mysqli_query($conn, "SELECT idGP FROM graduation_project WHERE coteG='$coteGP'"));
    $idGP = $idGPQ['idGP'];


    $Action = $_POST['action'];



    $borrow = mysqli_query($conn, "SELECT COUNT(*) AS b FROM borrow_gp WHERE idUser='$idUser'AND isReturn='0'");
    $request1 = mysqli_query($conn, "SELECT COUNT(*) AS r FROM request_gp WHERE idUser='$idUser'");
    $b = mysqli_fetch_assoc($borrow);
    $r = mysqli_fetch_assoc($request1);

    $total = $b['b'] + $r['r'];

    // $count!=
    $block = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE idUser='$idUser'"));
    if ($block['block'] == '1') {
        header("Location: ../index.php?errorBG=This member can't borrow now, his action blocked");
    }
     else
    if ((mysqli_num_rows(mysqli_query($conn, "SELECT * FROM borrow WHERE idUser='$idUser'AND isReturn='0'")) + mysqli_num_rows(mysqli_query($conn, "SELECT * FROM request WHERE idUser='$idUser'"))) >= 1) {
        header("Location: ../index.php?errorBG='can't borrow books and graduation project in the same time'");
    } else
        if ($total >= 2) {
            header("Location: ../index.php?errorBG='can't borrow more then 2 graduation projects'");
        } else if ($idBookQ['qte'] <= 1 && $Action == "borrow") {
            header("Location: ../index.php?errorBG='We have one copy , Graduation project Cant't Be Borrowed '");
        } else if ($idBookQ['nbrCopy'] == '0' || $idBookQ['nbrCopy'] <= 1 && $row['qte'] > 1) {
            header("Location: ../index.php?errorBG='All Copis of this GP have been borrowed'");
        } else {

            $request = mysqli_query($conn, "INSERT INTO borrow_gp(idUser,idGP,Action) VALUES ('$idUser','$idGP','$Action')");

            $request2 = mysqli_query($conn, "UPDATE graduation_project SET nbrCopy=nbrCopy-1 WHERE idGP='$idGP' ");

            if ($request && $request2) {
                header("Location: ../index.php?successBG='Success'");
            } else {
                header("Location: ../index.php?errorBG='error'");
            }
        }

}


?>