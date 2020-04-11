<?php
session_start();
include_once 'sendmail.php';
include_once 'acessdb.php';
$targetmail="lacouranaelanim@gmail.com";
//echo $targetmail;
$mail=searchemail($_SESSION['id_user']);
echo $mail;
sendingmail($mail);
