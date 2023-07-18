<html>

<form method="get">
    login: <input type="text" name="login"><br>
    pwd: <input type="text" name="pwd"><br>
    <input type="submit" name="submit">
</form>

<form action="http://localhost/project/net/create.php" method="get" target="_blank">
  <input type="submit" value="Sign Up">
</form>

<?php
    include('net/functions.php');
    error_reporting(E_ALL);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "amogh";
    $mysqli = new mysqli($servername, $username, $password, $dbname);
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    if(isset($_GET['submit'])) {
        read($mysqli, 0);
    }
?>

</html>