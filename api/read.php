<?php
require __DIR__.'/classes/rest.php';
session_start();
$getlogin = $_GET['login'];
$getpwd = $_GET['pwd'];
$rest = new rest();
$rest->login($getlogin, $getpwd);
$token = $_SESSION["token"];
echo $rest->read($token);
?>