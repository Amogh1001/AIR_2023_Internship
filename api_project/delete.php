<?php

require __DIR__.'/rest.php';

ini_set('session.gc_maxlifetime', 1800);
session_start();
$_SESSION['last_activity'] = time();

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (!isset($_SESSION['token'])) {
        echo("You are not logged in.");
    } else {
        if (isset($_GET['id'])) {
            $getid = $_GET['id'];
            $rest = new rest();
            $user = $rest->read($_SESSION['token']);
            if ($user["id"]!=$_GET["id"]){
                echo("You are not authorized to delete this user.");
                session_unset();
                session_destroy();
                exit();
            }
            $stat = $rest->delete($getid);
            if ($stat == 1) {
                echo("Deleted successfully.");
                session_unset();
                session_destroy();
            } else {
                http_response_code(400);
                echo json_encode(array('status' => 'error', 'message' => 'Failed to delete.'));
            }
        } else {
            echo("ID not found");
            session_unset();
            session_destroy();
        }
    }
}
?>