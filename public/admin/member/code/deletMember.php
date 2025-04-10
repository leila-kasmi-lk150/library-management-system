<?php
include('../../../../private/conn.php');

if(isset($_POST['delete_btn']))
{
    $idUser = $_POST['delete_id'];

    $query = "DELETE FROM users WHERE idUser='$idUser' ";

    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        header("Location: ../index.php?success=The member has been deleted");
	    exit();
    }
    else
    {
        header("Location: ../index.php?error=Error");
	    exit();
    }    
}

?>