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
echo $rest->login($getlogin, $getpwd);
// echo $rest->read($getlogin, $getpwd);

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > ini_get('session.gc_maxlifetime'))) {
    session_unset();
    session_destroy();
}


?>