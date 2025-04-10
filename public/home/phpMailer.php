<?php




require '../../private/phpMailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../private/phpMailer/vendor/phpmailer/phpmailer/src/SMTP.php';
require '../../private/phpMailer/vendor/phpmailer/phpmailer/src/Exception.php';


require '../../private/phpMailer/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if (isset($_POST['send'])) {
    $from = $_POST['email'];
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if (empty($from)) {
        header("Location: contact.php?error=email is required");
        exit();
    } else if (empty($name)) {
        header("Location: contact.php?error=name is required");
        exit();
    } else if (empty($subject)) {
        header("Location: contact.php?error=subject is required");
        exit();
    } else if (empty($message)) {
        header("Location: contact.php?error=message is required");
        exit();
    } else if (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact.php?error=Provide a valid email address");
        exit();
    } else {
        header("Location: contact.php?error=Look the code , in the comment");
        exit();

        // To PHPMailer function work , you must enable the passwordapp feature in your email 
        // Watch this video for more understanding (if it has not been deleted by the channel owner)
        // https://youtu.be/mte7LroYd74

        // https://youtu.be/maYnD0Sdr7c
        // if you have any question , do not hesitate to contact me leilakasmi150@gmail.com

        // 
        // $mail = new PHPMailer();

        // $mail->isSMTP();
        // $mail->Host = 'smtp.gmail.com';
        // $mail->SMTPAuth = "true";

        // $mail->Username = '';
        // $mail->Password = '';
        // $mail->SMTPSecure = 'tls'; //sll
        // $mail->Port = 587; //465

        // $mail->setFrom('$from', 'meesage');
        // $mail->addAddress('');
        // $mail->subject = $subject;
        // $leila = "$from 
        //         $name
        //         $message";
        //         $mail->Body = $leila;

        // if (!$mail->send()) {
        //     header("Location: contact.php?error=meesage not send");
        //     exit();
        // } else {
        //     header("Location: contact.php?success=The Message has been sent");
        //     exit();
        //     $mail->smtpClose();
        // }
    }
}
?>