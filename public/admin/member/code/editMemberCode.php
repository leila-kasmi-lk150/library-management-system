<?php
include('../../../../private/conn.php');


if (isset($_POST['edit'])) {
    $idUser = $_POST['edit_idUser'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dateBirth = $_POST['dateBirth'];
    $placeBirth = $_POST['placeBirth'];
    $adress = $_POST['adress'];
    $codeUser = $_POST['codeUser'];
    $speciality = $_POST['speciality'];
    $level = $_POST['level'];
    $userType=$_POST['userType'];



    $emailTest = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND idUser!='$idUser'"));
    $codeUserTest = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE codeUser='$codeUser'AND idUser!='$idUser'"));
    if ($emailTest != '0') {
        header("Location: ../index.php?error=This email exist");
        exit();
    } else if ($codeUserTest != '0') {
        header("Location: ../index.php?error=Code User exist");

    } else {


        $query = "UPDATE users SET email='$email', firstName='$firstName', lastName='$lastName', dateOfBirth='$dateBirth', PlaceOfBirth='$placeBirth', phone='$phone', adress='$adress', codeUser='$codeUser', specialty='$speciality', level='$level', userType='$userType' WHERE idUser='$idUser'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            header("Location: ../index.php?success=Member's information has been modified");
            exit();
        } else {
            header("Location: ../index.php?error=Error");
            exit();
        }

    }
}