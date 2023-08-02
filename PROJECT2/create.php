<?php
require __DIR__.'/classes/rest.php';

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
    echo $rest->read($getlogin, $getpwd);
} else {
    echo "Error: " . $query . "<br>" . $mysqli->error;
}
?>