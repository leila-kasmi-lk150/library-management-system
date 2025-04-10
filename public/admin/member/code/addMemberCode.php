<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require '../../../../private/phpMailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../../../private/phpMailer/vendor/phpmailer/phpmailer/src/SMTP.php';
require '../../../../private/phpMailer/vendor/phpmailer/phpmailer/src/Exception.php';


require '../../../../private/phpMailer/vendor/autoload.php';

include('../../../../private/conn.php');


if (isset($_POST['add'])) {
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
    $userType = $_POST['userType'];

    if (empty($_POST['pw'])) {
        $pw = str_replace("-", "", $dateBirth);
    } else {
        $pw = $_POST['pw'];
    }






    $emailTest = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='$email'"));
    $codeUserTest = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE codeUser='$codeUser'"));
    if ($emailTest != '0') {
        header("Location: ../addMember.php?error=This email exist");
        exit();
    } else if ($codeUserTest != '0') {
        header("Location: ../addMember.php?error=Code User exist");

    } else { {
            $img_name = $_FILES['my_image']['name'];
            $img_size = $_FILES['my_image']['size'];
            $tmp_name = $_FILES['my_image']['tmp_name'];
            $error = $_FILES['my_image']['error'];



            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = 'uploadsMember/' . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);
        }

        $query = "INSERT INTO users(passWord, email, firstName, lastName, dateOfBirth, PlaceOfBirth, phone, adress, codeUser, specialty, level, imageUser,userType) VALUES('$pw', '$email', '$firstName', '$lastName', '$dateBirth', '$placeBirth', '$phone', '$adress', '$codeUser', '$speciality', '$level', '$new_img_name', '$userType' )";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {



            // Here in this comment, this code sends an email sends an email to the owner of the member
            // To PHPMailer function work , you must enable the passwordapp feature in your email 
            // Watch this video for more understanding (if it has not been deleted by the channel owner)
            // https://youtu.be/mte7LroYd74

            // https://youtu.be/maYnD0Sdr7c
            // if you have any question , do not hesitate to contact me leilakasmi150@gmail.com

            // $subject = "Library Acount";
            // $message = "your acount has been created ... your bassword id your data birth you can chang it 
            //             letter ... for exampel if you born in 06/09/2002 so your password is 06092002";

            // $mail = new PHPMailer();

            // $mail->isSMTP();
            // $mail->Host = 'smtp.gmail.com';
            // $mail->SMTPAuth = "true";

            // $mail->Username = '';
            // $mail->Password = '';
            // $mail->SMTPSecure = 'tls'; //sll
            // $mail->Port = 587; //465

            // $mail->setFrom('', 'mascrar');
            // $mail->addAddress($email);
            // $mail->subject = $subject;
            // $mail->Body = $message;



            // if (!$mail->send()) {
            //     header("Location: ../addMember.php?error=meesage not send");
            //     exit();
            // } else {
            //     $mail->smtpClose();
            // }

            header("Location: ../addMember.php?success=The Member has been added ,plz Look the code , in the comment");
            exit();

        } else {
            header("Location: ../addMember.php?error=Error");
            exit();
        }


    }
}