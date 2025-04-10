<?php
include('../../../../private/conn.php');

if (isset($_POST['borrow'])) {
    $codeUser = $_POST['codeUser'];
    $idUserQ = mysqli_fetch_assoc(mysqli_query($conn, "SELECT idUser FROM users WHERE codeUser='$codeUser'"));
    $idUser = $idUserQ['idUser'];

    $idType = $_POST['idType'];
    $nbrBook = $_POST['nbrBook'];
    $idBookQ = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM books WHERE idType='$idType' AND nbrBook='$nbrBook'"));
    $idBook = $idBookQ['idBook'];

    $Action = $_POST['action'];




    $borrow = mysqli_query($conn, "SELECT COUNT(*) AS b FROM borrow WHERE idUser='$idUser'AND isReturn='0'");
    $request1 = mysqli_query($conn, "SELECT COUNT(*) AS r FROM request WHERE idUser='$idUser'");
    $b = mysqli_fetch_assoc($borrow);
    $r = mysqli_fetch_assoc($request1);

    $total = $b['b'] + $r['r'];

    $count = (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM borrow_gp WHERE idUser='$idUser'AND isReturn='0'")) + mysqli_num_rows(mysqli_query($conn, "SELECT * FROM request_gp WHERE idUser='$idUser'")));
    $block = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE idUser='$idUser'"));
    if ($block['block'] == '1') {
        header("Location: ../index.php?errorB=This member can't borrow now, his action blocked");
    }
     else if ($count != 0) {
        header("Location: ../index.php?errorB=$count can't borrow books and graduation project in the same time'");
    } else
        if ($total >= 2) {
            header("Location: ../index.php?errorB='can't borrow more then 2 books'");
        } else if ($idBookQ['quantity'] <= 1 && $Action == "borrow") {
            header("Location: ../index.php?errorB='We have one copy , Book Cant't Be Borrowed '");
        } else if ($idBookQ['nbrCopy'] == '0' || $idBookQ['nbrCopy'] <= 1 && $row['quantity'] > 1) {
            header("Location: ../index.php?errorB='All Copis of this book have been borrowed'");
        } else {

            $request = mysqli_query($conn, "INSERT INTO borrow(idUser,idBook,Action) VALUES ('$idUser','$idBook','$Action')");

            $request2 = mysqli_query($conn, "UPDATE books SET nbrCopy=nbrCopy-1 WHERE idBook='$idBook' ");

            if ($request && $request2) {
                header("Location: ../index.php?successB='Success'");
            } else {
                header("Location: ../index.php?errorB='error'");
            }
        }

}


?>