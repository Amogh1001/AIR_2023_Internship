<?php

require __DIR__.'/rest.php';

ini_set('session.gc_maxlifetime', 1800);
session_start();
$_SESSION['last_activity'] = time();

if(!isset($_POST['name']) || !isset($_POST['num']) || !isset($_POST['email']) || !isset($_POST['address']) || !isset($_POST['login']) || !isset($_POST['pwd'])){
    echo "Incomplete data";
    exit();
}
$getName = $_POST['name'];
$getNum = $_POST['num'];
$getemail = $_POST['email'];
$getaddress = $_POST['address'];
$getlogin = $_POST['login'];
$getpwd = $_POST['pwd'];
$getdate = date("Y-m-d H:i:s");

$rest = new rest();
$flag = $rest->create($getName, $getNum, $getemail, $getaddress, $getlogin, $getpwd, $getdate);
if($flag == 1){
    echo "Successfully created";
} else {
    echo "Error: " . $query . "<br>" . $mysqli->error;
}

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > ini_get('session.gc_maxlifetime'))) {
    session_unset();
    session_destroy();
}

?>