<?php

require __DIR__.'/rest.php';

ini_set('session.gc_maxlifetime', 1800);
session_start();
$_SESSION['last_activity'] = time();

if(!isset($_GET['login']) || !isset($_GET['pwd'])){
    echo "Incomplete request";
    exit();
}
$getlogin = $_GET['login'];
$getpwd = $_GET['pwd'];
$rest = new rest();
$rest->login($getlogin, $getpwd);
$token = $_SESSION["token"];
$user = $rest->read($token);
$user = json_decode($user);
$user[0]->pwd = $getpwd;
$user = json_encode($user);
echo $user;


if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > ini_get('session.gc_maxlifetime'))) {
    session_unset();
    session_destroy();
}

?>