<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
//include_once 'acessdb.php';
include_once 'function.php';


/*
return the  randomized string which has been send to the email or  an error
*/
function sendingmail($targetmail){
  $mail = new PHPMailer(true);

  $mail->isSMTP();                            // Set mailer to use SMTP
  $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                     // Enable SMTP authentication
  $mail->Username = 'sr03secuutc@gmail.com';          // SMTP username
  $mail->Password = 'sr03sr03'; // SMTP password
  $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 587;                          // TCP port to connect to

  $mail->setFrom('sr03secuutc@gmail.com', 'SR03 securite');

  $mail->addAddress($targetmail);   // Add a recipient


  $mail->isHTML(true);  // Set email format to HTML

 $randomizedstring =generateRandomString();

  $bodyContent = '<h1>you have registered in  the project at '.date('m/d-r').'</h1>'.'
  <h1>this is your password to authenticate '.$randomizedstring.'</h1>';


  $mail->Subject = 'Email password confirmation';
  $mail->Body    = $bodyContent;

  if(!$mail->send()) {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
      return 0;
  } else {
      echo 'Message has been sent';
      return $randomizedstring;
  }
}

?>
