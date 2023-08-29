<!-- This is an HTML form that allows the user to login. -->
<html>

<form method="get">
    <!-- The `login` and `pwd` input fields are used to collect the user's login credentials. -->
    login: <input type="text" name="login"><br>
    pwd: <input type="text" name="pwd"><br>
    <!-- The `submit` button submits the form data to the PHP script. -->
    <input type="submit" name="submit">
</form>

<!-- This is a link to the `create.php` script, which allows the user to create a new account. -->
<form action="http://localhost/project/net/create.php" method="get" target="_blank">
  <!-- The `submit` button opens the `create.php` script in a new tab. -->
  <input type="submit" value="Sign Up">
</form>

<?php
  // This PHP script includes the `functions.php` script, which contains the `read()` function.
  include('net/functions.php');

  // This line sets the error reporting level to E_ALL.
  error_reporting(E_ALL);

  // This line defines the MySQL database connection variables.
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "amogh";

  // This line creates a new MySQLi object.
  $mysqli = new mysqli($servername, $username, $password, $dbname);

  // This line checks if the connection to the MySQL database was successful.
  if ($mysqli->connect_error) {
    // If the connection was not successful, an error message is displayed.
    die("Connection failed: " . $mysqli->connect_error);
  }

  // This code is executed if the `submit` button is clicked.
  if(isset($_GET['submit'])) {
    // The `read()` function is called to read the employee records from the database.
    read($mysqli, 0);
  }
?>

</html>
