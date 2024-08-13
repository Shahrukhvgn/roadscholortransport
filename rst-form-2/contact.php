<?php

$server_name = "localhost";
$username = "root";
$password = "";
$database_name = "database123";

$conn = mysqli_connect($server_name, $username, $password, $database_name);

if (!$conn) {
    die("Connection Faild:" . mysqli_connect_error());
}

if (isset($_POST['save'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $tick = $_POST['tick'];

    $sql_query = "INSERT INTO entry_details (first_name, last_name, email, mobile, tick)
    VALUES ('$first_name','$last_name','$email','$mobile','$tick')";

    if (mysqli_query($conn, $sql_query)) {
        echo " run code";
    } else {
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
}


// SMTP Work for send mail to gmail


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'shahrukhvgnit@gmail.com';                     //SMTP username
    $mail->Password   = 'bduktslirqhcmnjr';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('shahrukhvgnit@gmail.com', 'Mailer');
    $mail->addAddress('shahrukhmca2@gmail.com', 'Joe User');     //Add a recipient

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Road Scholor Transport Enquiry.';
    $mail->Body    = "$first_name $last_name <br> $email <br> $mobile <br> $tick";
   
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}








?>