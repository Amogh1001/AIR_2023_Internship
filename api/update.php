<?php
require __DIR__.'/classes/rest.php';
session_start();
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
if(isset($_POST['mod_mobile_number'])){
    $user[0]["mobile_number"] = $_POST['mod_mobile_number'];
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

?>