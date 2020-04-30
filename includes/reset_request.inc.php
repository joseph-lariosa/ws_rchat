<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';
require '../includes/defaults.inc.php';

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";

$mail->SMTPDebug  = 1;  
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port       = 587;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "jedcore14@gmail.com";
$mail->Password   = "0153123a~";

if (isset($_POST["reset-request-submit"])){

    include '../config.php';
    include '../includes/db.php';
    
    $selector = bin2hex(random_bytes(8));
    $token = bin2hex(random_bytes(64));

    $url = $base_url."/forgot-password/create-new-password.php?selector=". $selector . "&validator=".$token;

    $expires = date("U") + 1800;
    $userEmail = $_POST["email"];


    $query = ("DELETE FROM pwdreset WHERE pwdResetEmail='{$userEmail}'");
    $select_user_query = mysqli_query($conn, $query);

    if (!$select_user_query) {
      die("QUERY FAILED" . mysqli_error($conn));
    }


    $query = ("INSERT INTO pwdreset (pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpires) VALUES ('$userEmail','$selector','$token','$expires')");
    $select_user_query = mysqli_query($conn, $query);

    if (!$select_user_query) {
      die("QUERY FAILED" . mysqli_error($conn));
    }


    $to = $userEmail;

    $subject = 'Password Recovery for '.$sitename;
    $message = '<p></p>We received a password reset request. The link to reset your password is below. If you did not make this request, you can ignore this email.</p>';
    $message .= '<p>Here is your password reset link: </br>';
    $message .= '<a href="'.$url.'">'.$url.'</a></p>';

    $headers = "From: ".$sitename." <".$mail->Username .">\r\n";
    $headers .= "Reply-To: ".$sitename."\r\n";
    $headers .= "Content-type: text/html\r\n";


    $mail->IsHTML(true);
    $mail->AddAddress($userEmail, "recipient-name");
    $mail->SetFrom($mail->Username , $sitename);
    $mail->AddReplyTo($mail->Username , "No-Reply");
    $mail->Subject = $subject;
    $content = $message;


    $mail->MsgHTML($content); 
    if(!$mail->Send()) {
    echo "Error while sending Email.";
    var_dump($mail);
    } else {
        session_start();
        $_SESSION['message-success']="A password reset link has been sent to your email address! <strong>" . $userEmail ."</strong>";
        header("Location: ../forgot-password/?reset=success");
    }


  

} else {
    header("Location ../index.php");
}