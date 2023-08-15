<?php

require __DIR__.'/rest.php';

ini_set('session.gc_maxlifetime', 1800);
session_start();
$_SESSION['last_activity'] = time();

if(!isset($_POST['login']) || !isset($_POST['pwd'])){
    echo "Incomplete request";
    exit();
}
$getlogin = $_POST['login'];
$getpwd = $_POST['pwd'];
$rest = new rest();
$rest->login($getlogin, $getpwd);
$token = $_SESSION["token"];
$user = $rest->read($token);
$user = json_decode($user, true);
$user[0]["password"] = $getpwd;
if(isset($_POST['mod_name'])){
    $user[0]["name"] = $_POST['mod_name'];
}
if(isset($_POST['mod_num'])){
    $user[0]["mobile_number"] = $_POST['mod_num'];
}
if(isset($_POST['mod_email'])){
    $user[0]["email"] = $_POST['mod_email'];
}
if(isset($_POST['mod_address'])){
    $user[0]["address"] = $_POST['mod_address'];
}
if(isset($_POST['mod_login'])){
    $user[0]["login_name"] = $_POST['mod_login'];
}
if(isset($_POST['mod_pwd'])){
    $user[0]["password"] = $_POST['mod_pwd'];
}
echo $rest->update($token, $user[0]["name"], $user[0]["mobile_number"], $user[0]["email"], $user[0]["address"], $user[0]["login_name"], $user[0]["password"]);

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > ini_get('session.gc_maxlifetime'))) {
    session_unset();
    session_destroy();
}

?>