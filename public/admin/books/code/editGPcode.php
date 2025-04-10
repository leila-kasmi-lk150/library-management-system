<?php
include('../../../../private/conn.php');

if (isset($_POST['edit'])) {

    $idCategorie = $_POST['idCategorie'];
    $idGP = $_POST['idGP'];


    // update author if there 2 author 
    $author1 = $_POST['author1'];
    $codeUser1 = $_POST['codeUser1'];
    $idA1 = $_POST['idA1'];
    $author2 = $_POST['author2'];
    $codeUser2 = $_POST['codeUser2'];
    $idA2 = $_POST['idA2'];

    $testA = $_POST['testA'];
    // this value for test if there 2 author or 1 



    $a1 = mysqli_query($conn, "UPDATE authors_gp SET codeUser='$codeUser1', name='$author1', idGP='$idGP' WHERE idAGP='$idA1'");


    
    if ($testA == '2') {
        if (!empty($author2)) {
            $a2 = mysqli_query($conn, "UPDATE authors_gp SET codeUser='$codeUser2', name='$author2', idGP='$idGP' WHERE idAGP='$idA2'");
        } else {
            $a2 = mysqli_query($conn, " DELETE FROM authors_gp WHERE `authors_gp`.`idAGP` = '$idA2'");
        }
    } else {
        if (!empty($author2)) {

            $a2 = mysqli_query($conn, "INSERT INTO authors_gp(name, codeUser, idGP) VALUES ('$author2', '$codeUser2', '$idGP')");
        }

    }




    // ===============
    $titel = $conn->real_escape_string(trim($_POST['titel']));
    $summary = $conn->real_escape_string(trim($_POST['summary']));
    $level = $_POST['level'];
    $year = $_POST['year'];
    $quantity = $_POST['quantity'];
    $coteG = $_POST['cote'];


    // language 
    $language = ucwords($_POST['language']);
    $language2 = ucwords($_POST['language2']);

    if (empty($language2)) {
        $query_get_id_language = mysqli_query($conn, "SELECT idLanguage FROM language WHERE language='$language'");
        $row_language = mysqli_fetch_assoc($query_get_id_language);
        $idLanguage = $row_language['idLanguage'];
    } else {
        $query_language_test = mysqli_query($conn, "SELECT * FROM language WHERE language='$language2'");
        if (mysqli_num_rows($query_language_test) == 0) {
            $query_language_insert = mysqli_query($conn, "INSERT INTO language(language) VALUES ('$language2')");
            $query_get_id_language = mysqli_query($conn, "SELECT idLanguage FROM language WHERE language='$language2'");
            $row_language = mysqli_fetch_assoc($query_get_id_language);
            $idLanguage = $row_language['idLanguage'];
        } else {
            $row_language = mysqli_fetch_assoc($query_language_test);
            $idLanguage = $row_language['idLanguage'];
        }
    }

    $testCote = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM graduation_project WHERE coteG='$coteG' AND idGP!='$idGP'"));
    if ($testCote == '0') {
        $query = mysqli_query($conn, "UPDATE graduation_project SET title='$titel', resume='$summary', level='$level', year='$year', idLanguage='$idLanguage', qte='$quantity', coteG='$coteG' WHERE idGP='$idGP'");

        if ($a1 && $a2 && $query) {
            $em = "edit ";
            header("Location: ../graduationProject.php?success=$em&idCategorie=$idCategorie");

        } else {
            $em = "error";
            header("Location: ../graduationProject.php?error=$em&idCategorie=$idCategorie");
        }
    } else {
        $em = "cote of graduation project that you entered exists ";
        header("Location: ../graduationProject.php?error=$em&idCategorie=$idCategorie");
    }

}