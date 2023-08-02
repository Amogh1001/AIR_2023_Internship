<?php
require __DIR__.'/classes/rest.php';
$getlogin = $_GET['login'];
$getpwd = $_GET['pwd'];
$rest = new rest();
echo $rest->read($getlogin, $getpwd);

?>