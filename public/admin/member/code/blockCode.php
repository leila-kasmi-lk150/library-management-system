<?php
include('../../../../private/conn.php');

if(isset($_POST['deblock']))
{
    $idUser = $_POST['idUser'];

    $query = "UPDATE users SET block='0' WHERE idUser='$idUser' ";

    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        header("Location: ../block.php?success=You deblock the member");
	    exit();
    }
    else
    {
        header("Location: ../block.php?error=Error");
	    exit();
    }    
}


if(isset($_POST['block']))
{
    $idUser = $_POST['idUser'];

    $query = "UPDATE users SET block='1' WHERE idUser='$idUser' ";

    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        header("Location: ../block.php?success=You block the member");
	    exit();
    }
    else
    {
        header("Location: ../block.php?error=Error");
	    exit();
    }    
}

if(isset($_POST['blockAll']))
{
    $idUser = $_POST['idUser'];

    $query = "UPDATE users SET block='1' ";

    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        header("Location: ../block.php?success=You block all member");
	    exit();
    }
    else
    {
        header("Location: ../block.php?error=Error");
	    exit();
    }    
}
?>