<?php
session_start();
include_once 'sendmail.php';
include_once 'acessdb.php';

$mail=searchemail($_SESSION['id_user']);
echo $mail;
sendingmail($mail);
l
