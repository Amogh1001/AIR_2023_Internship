<?php
include('functions.php');
$username = $_GET['login'];
$password = $_GET['pwd'];

// Perform your auth    entication logic
error_reporting(E_ALL);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "amogh";
$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
if ($username === 'admin' && $password === '1111') {
    read($mysqli, 1);
    echo 'Login successful!';
} else {
    read($mysqli, 0);
}
?>
