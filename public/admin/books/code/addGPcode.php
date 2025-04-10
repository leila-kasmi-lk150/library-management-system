<?php
include('../../../../private/conn.php');

if (isset($_POST['add'])) {

    $idCategorie = $_POST['idCategorie'];
    $titel = $conn->real_escape_string(trim($_POST['titel']));

    $summary = $conn->real_escape_string(trim($_POST['summary']));



    // =============*******========
    $year = $_POST['year'];

    // ===============ID LANGUAGE=========== 

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

    // =============*******========
    $quantity = $_POST['quantity'];

    $coteG = $_POST['cote'];
    $level = $_POST['level'];
    // ===============ID author=========== 

    $author1 = ucwords($_POST['author1']);
    $author2 = ucwords($_POST['author2']);
    $codeUser1 = $_POST['codeUser1'];
    $codeUser2 = $_POST['codeUser2'];

    // insert author 
    // 
    // $testAuthor = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM graduation_project"))
    $queryA1 = mysqli_query($conn, "INSERT INTO authors_gp(name, codeUser, coteG) VALUES ('$author1', '$codeUser1', '$coteG')");

    if (!empty($author2)) {
        $queryA2 = mysqli_query($conn, "INSERT INTO authors_gp(name, codeUser, coteG) VALUES ('$author2', '$codeUser2', '$coteG')");

    }

    $testCote = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM graduation_project WHERE coteG='$coteG'"));
    if ($testCote == '0') {
        # code...

        $query = "INSERT INTO graduation_project(coteG,title,  year, level, idCategorie, qte, resume , idLanguage) 
            VALUES('$coteG', '$titel', '$year', '$level', '$idCategorie' ,'$quantity', '$summary','$idLanguage')";
        $query_run = mysqli_query($conn, $query);



        $idGPQuery = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM graduation_project WHERE coteG='$coteG'"));
        $idGP = $idGPQuery['idGP'];
        $queryA1 = mysqli_query($conn, "INSERT INTO authors_gp(name, codeUser, idGP) VALUES ('$author1', '$codeUser1', '$idGP')");

    if (!empty($author2)) {
        $queryA2 = mysqli_query($conn, "INSERT INTO authors_gp(name, codeUser, idGP) VALUES ('$author2', '$codeUser2', '$idGP')");

    }
        if ($query_run) {
            $em = "graduation project added";
            header("Location: ../graduationProject.php?success=$em&idCategorie=$idCategorie");

        } else {
            $em = "error";
            header("Location: ../graduationProject.php?error=$em&idCategorie=$idCategorie");
        }
    }else {
        $em = "cote of graduation project that you entered exists ";
        header("Location: ../graduationProject.php?error=$em&idCategorie=$idCategorie");
    }
}
// }




// }