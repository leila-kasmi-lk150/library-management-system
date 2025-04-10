<?php
include('../../../../private/conn.php');

if(isset($_POST['delete_btn']))
{
    $idGP = $_POST['delete_id'];
    $idCategorie = $_POST['idCategorie'];

    $query = "DELETE FROM graduation_project WHERE idGP='$idGP' ";
    $queryA = mysqli_query($conn, "DELETE FROM authors_gp WHERE idGP='$idGP' ");

    $query_run = mysqli_query($conn, $query);

    if($query_run && $queryA)
    {
        header("Location: ../graduationProject.php?success=The book has been deleted&idCategorie=$idCategorie");
	    exit();
    }
    else
    {
        header("Location: ../graduationProject.php?error=Error&idCategorie=$idCategorie");
	    exit();
    }    
}

?>