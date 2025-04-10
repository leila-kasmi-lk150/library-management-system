<?php
include('../../../private/conn.php');

if (isset($_POST['saveProfile'])) {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pw = $_POST['pw'];
    $adress = $_POST['adress'];
    $idUser = $_POST['idUser'];

    $email = stripcslashes($_POST['email']);
    $pw = stripcslashes($_POST['pw']);

    $email = mysqli_real_escape_string($conn, $email);
    $pw = mysqli_real_escape_string($conn, $pw);

    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.php?error=Provide a valid email addres");
        exit();
    } else if (empty($email)) {
        header("Location: index.php?error=Email is required");
        exit();
    } else if (empty($pw)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else if (!empty($phone) && !preg_match('/^(05|06|07)[0-9]{8}$/', $phone)) {
        header("Location: index.php?error=Provide a valid phone number");
        exit();
    } else {


        $emailTest = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND idUser!='$idUser'"));
        if ($emailTest != '0') {
            header("Location: index.php?error=This email exist");
            exit();
        } else {
            $query = "UPDATE users SET email='$email',  phone='$phone', adress='$adress', passWord='$pw' WHERE idUser='$idUser'";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                header("Location: index.php?success=Your information has been modified");
                exit();
            } else {
                header("Location: index.php?error=Error");
                exit();
            }
        }
    }
}
?>