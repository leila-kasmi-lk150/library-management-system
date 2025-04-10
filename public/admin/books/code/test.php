<?php
include('../../../../private/conn.php');

if (isset($_POST['edit'])) {

    $idCategorie = $_POST['idCategorie'];
    $idBook = $_POST['idBook'];
    $idType = $_POST['idType'];
    // ===============ID author=========== 

    $author1 = ucwords($_POST['author1']);
    $author12 = ucwords($_POST['author12']);
    $aboutAuthor1 = $conn->real_escape_string(trim($_POST['about_author1']));
    $idW1 = $_POST['idW1'];
    if (empty($author12)) {
        $idAuthor1 = $_POST['author1'];
        $query_author_update1 = mysqli_query($conn, "UPDATE authors SET aboutAuthor='$aboutAuthor1' WHERE idAuthor='$idAuthor1'");
        $writ1 = mysqli_query($conn, "UPDATE writ SET idBook='$idBook', idAuthor= '$idAuthor1' WHERE idW='$idW1'");
    } else {
        $query_author_test1 = mysqli_query($conn, "SELECT * FROM authors WHERE author='$author12'");
        if (mysqli_num_rows($query_author_test1) == 0) {
            $query_author_insert1 = mysqli_query($conn, "INSERT INTO authors(author,aboutAuthor) VALUES ('$author12','$aboutAuthor1')");
            $query_get_id_author1 = mysqli_query($conn, "SELECT idAuthor FROM authors WHERE author='$author12'");
            $row_author1 = mysqli_fetch_assoc($query_get_id_author1);
            $idAuthor1 = $row_author1['idAuthor'];
            $writ1 = mysqli_query($conn, "UPDATE writ SET idBook='$idBook', idAuthor= '$idAuthor1' WHERE idW='$idW1'");
        } else {
            $row_author1 = mysqli_fetch_assoc($query_author_test1);
            $idAuthor1 = $row_author1['idAuthor'];
            $query_author_update1 = mysqli_query($conn, "UPDATE authors SET aboutAuthor='$aboutAuthor1' WHERE idAuthor='$idAuthor1'");
            $writ1 = mysqli_query($conn, "UPDATE writ SET idBook='$idBook', idAuthor= '$idAuthor1' WHERE idW='$idW1'");
        }
    }
    $author2 = ucwords($_POST['author2']);
    $author22 = ucwords($_POST['author22']);
    $aboutAuthor2 = $conn->real_escape_string(trim($_POST['about_author2']));
    $idW2 = $_POST['idW2'];
    $deletAuthor2 = $_POST['deletAuthor2'];

    $author3 = ucwords($_POST['author3']);
    $author32 = ucwords($_POST['author32']);
    $aboutAuthor3 = $conn->real_escape_string(trim($_POST['about_author3']));
    $idW3 = $_POST['idW3'];
    $deletAuthor3 = $_POST['deletAuthor3'];

    if ($deletAuthor2 == 'delete') {
        $writ2 = mysqli_query($conn, "DELETE FROM writ WHERE idW='$idW2'");
    } else {
        if ($author2 != $author1 && $author2 != $author3) {
            if (empty($author22)) {
                $idAuthor2 = $_POST['author2'];
                $query_author_update2 = mysqli_query($conn, "UPDATE authors SET aboutAuthor='$aboutAuthor2' WHERE idAuthor='$idAuthor2'");
                $writ2 = mysqli_query($conn, "UPDATE writ SET idBook='$idBook', idAuthor= '$idAuthor2' WHERE idW='$idW2'");
            } else {
                $query_author_test2 = mysqli_query($conn, "SELECT * FROM authors WHERE author='$author22'");
                if (mysqli_num_rows($query_author_test2) == 0) {
                    $query_author_insert2 = mysqli_query($conn, "INSERT INTO authors(author,aboutAuthor) VALUES ('$author22','$aboutAuthor2')");
                    $query_get_id_author2 = mysqli_query($conn, "SELECT idAuthor FROM authors WHERE author='$author22'");
                    $row_author2 = mysqli_fetch_assoc($query_get_id_author2);
                    $idAuthor2 = $row_author2['idAuthor'];
                    $writ2 = mysqli_query($conn, "UPDATE writ SET idBook='$idBook', idAuthor= '$idAuthor2' WHERE idW='$idW2'");
                } else {
                    $row_author2 = mysqli_fetch_assoc($query_author_test2);
                    $idAuthor2 = $row_author2['idAuthor'];
                    $query_author_update2 = mysqli_query($conn, "UPDATE authors SET aboutAuthor='$aboutAuthor2' WHERE idAuthor='$idAuthor2'");
                    $writ2 = mysqli_query($conn, "UPDATE writ SET idBook='$idBook', idAuthor= '$idAuthor2' WHERE idW='$idW2'");
                }
            }
        }
    }

    if ($deletAuthor2 == 'delete') {
        $writ2 = mysqli_query($conn, "DELETE FROM writ WHERE idW='$idW2'");
    } else {
        if ($author3 != $author1 && $author3 != $author2) {
            if (empty($author32)) {
                $idAuthor3 = $_POST['author3'];
                $query_author_update3 = mysqli_query($conn, "UPDATE authors SET aboutAuthor='$aboutAuthor3' WHERE idAuthor='$idAuthor3'");
                $writ3 = mysqli_query($conn, "UPDATE writ SET idBook='$idBook', idAuthor= '$idAuthor3' WHERE idW='$idW3'");
            } else {
                $query_author_test3 = mysqli_query($conn, "SELECT * FROM authors WHERE author='$author32'");
                if (mysqli_num_rows($query_author_test3) == 0) {
                    $query_author_insert3 = mysqli_query($conn, "INSERT INTO authors(author,aboutAuthor) VALUES ('$author32','$aboutAuthor3')");
                    $query_get_id_author3 = mysqli_query($conn, "SELECT idAuthor FROM authors WHERE author='$author32'");
                    $row_author3 = mysqli_fetch_assoc($query_get_id_author3);
                    $idAuthor3 = $row_author3['idAuthor'];
                    $writ3 = mysqli_query($conn, "UPDATE writ SET idBook='$idBook', idAuthor= '$idAuthor3' WHERE idW='$idW3'");
                } else {
                    $row_author3 = mysqli_fetch_assoc($query_author_test3);
                    $idAuthor3 = $row_author3['idAuthor'];
                    $query_author_update3 = mysqli_query($conn, "UPDATE authors SET aboutAuthor='$aboutAuthor3' WHERE idAuthor='$idAuthor3'");
                    $writ3 = mysqli_query($conn, "UPDATE writ SET idBook='$idBook', idAuthor= '$idAuthor3' WHERE idW='$idW3'");
                }
            }
        }
    }


    $authorAdd2 = $_POST['authorAdd2'];
    $addAuthor22 = $_POST['addAuthor22'];
    $about_add_author2 = $_POST['about_add_author2'];

    if (empty($addAuthor22) && $authorAdd2 != '0') {
        $query_get_id_author_add_2 = mysqli_query($conn, "SELECT idAuthor FROM authors WHERE author='$authorAdd2'");
        $row_author_add_2 = mysqli_fetch_assoc($query_get_id_author_add_2);
        $idAuthor_add_2 = $row_author_add_2['idAuthor'];
        $query_author_update_add_2 = mysqli_query($conn, "UPDATE authors SET aboutAuthor='$about_add_author2' WHERE idAuthor='$idAuthor_add_2'");

        $writTest = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM writ WHERE idBook='$idBook' AND idAuthor='$idAuthor_add_2'"));
        if ($writTest == '0') {
            $writ = mysqli_query($conn, "INSERT INTO writ(idBook, idAuthor) VALUES ('$idBook', '$idAuthor_add_2')");
        }
    } else if (!empty($addAuthor22)) {
        $query_author_test_add_2 = mysqli_query($conn, "SELECT * FROM authors WHERE author='$addAuthor22'");
        if (mysqli_num_rows($query_author_test_add_2) == 0) {
            $query_author_insert_add_2 = mysqli_query($conn, "INSERT INTO authors(author,aboutAuthor) VALUES ('$addAuthor22','$about_add_author2')");
            $query_get_id_author_add_2 = mysqli_query($conn, "SELECT idAuthor FROM authors WHERE author='$addAuthor22'");
            $row_author_add_2 = mysqli_fetch_assoc($query_get_id_author_add_2);
            $idAuthor_add_2 = $row_author_add_2['idAuthor'];
            $writTest = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM writ WHERE idBook='$idBook' AND idAuthor='$idAuthor_add_2'"));
            if ($writTest == '0') {
                $writ = mysqli_query($conn, "INSERT INTO writ(idBook, idAuthor) VALUES ('$idBook', '$idAuthor_add_2')");
            }
        } else {
            $row_author_add_2 = mysqli_fetch_assoc($query_author_test_add_2);
            $idAuthor_add_2 = $row_author_add_2['idAuthor'];
            $query_author_update_add_2 = mysqli_query($conn, "UPDATE authors SET aboutAuthor='$about_add_author2' WHERE idAuthor='$idAuthor_add_2'");
            $writTest = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM writ WHERE idBook='$idBook' AND idAuthor='$idAuthor_add_2'"));
            if ($writTest == '0') {
                $writ = mysqli_query($conn, "INSERT INTO writ(idBook, idAuthor) VALUES ('$idBook', '$idAuthor_add_2')");
            }
        }
    }


    $authorAdd3 = $_POST['authorAdd3'];
    $addAuthor32 = $_POST['addAuthor32'];
    $about_add_author3 = $_POST['about_add_author3'];

    if (empty($addAuthor32) && $authorAdd3 != '0') {
        $query_get_id_author_add_3 = mysqli_query($conn, "SELECT idAuthor FROM authors WHERE author='$authorAdd3'");
        $row_author_add_3 = mysqli_fetch_assoc($query_get_id_author_add_3);
        $idAuthor_add_3 = $row_author_add_3['idAuthor'];
        $query_author_update_add_3 = mysqli_query($conn, "UPDATE authors SET aboutAuthor='$about_add_author3' WHERE idAuthor='$idAuthor_add_3'");

        $writTest = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM writ WHERE idBook='$idBook' AND idAuthor='$idAuthor_add_3'"));
        if ($writTest == '0') {
            $writ = mysqli_query($conn, "INSERT INTO writ(idBook, idAuthor) VALUES ('$idBook', '$idAuthor_add_3')");
        }
    } else if (!empty($addAuthor32)) {
        $query_author_test_add_3 = mysqli_query($conn, "SELECT * FROM authors WHERE author='$addAuthor32'");
        if (mysqli_num_rows($query_author_test_add_3) == 0) {
            $query_author_insert_add_3 = mysqli_query($conn, "INSERT INTO authors(author,aboutAuthor) VALUES ('$addAuthor32','$about_add_author3')");
            $query_get_id_author_add_3 = mysqli_query($conn, "SELECT idAuthor FROM authors WHERE author='$addAuthor32'");
            $row_author_add_3 = mysqli_fetch_assoc($query_get_id_author_add_3);
            $idAuthor_add_3 = $row_author_add_3['idAuthor'];
            $writTest = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM writ WHERE idBook='$idBook' AND idAuthor='$idAuthor_add_3'"));
            if ($writTest == '0') {
                $writ = mysqli_query($conn, "INSERT INTO writ(idBook, idAuthor) VALUES ('$idBook', '$idAuthor_add_3')");
            }
        } else {
            $row_author_add_3 = mysqli_fetch_assoc($query_author_test_add_3);
            $idAuthor_add_3 = $row_author_add_3['idAuthor'];
            $query_author_update_add_3 = mysqli_query($conn, "UPDATE authors SET aboutAuthor='$about_add_author3' WHERE idAuthor='$idAuthor_add_3'");
            $writTest = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM writ WHERE idBook='$idBook' AND idAuthor='$idAuthor_add_3'"));
            if ($writTest == '0') {
                $writ = mysqli_query($conn, "INSERT INTO writ(idBook, idAuthor) VALUES ('$idBook', '$idAuthor_add_3')");
            }
        }
    }
    if ($writ1) {
        $em = "Book modified";
        header("Location: ../viewBook.php?idTypeReturn=$idType&success=$em&idCategorie=$idCategorie");

    } else {
        $em = "error";
        header("Location: ../viewBook.php?idTypeReturn=$idType&error=$em&idCategorie=$idCategorie");
    }
}
// }




// }