<?php
require __DIR__.'/classes/rest.php';
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (isset($_GET['id'])) {
        $getid = $_GET['id'];
        $rest = new rest();
        echo $rest->delete($getid);
        // Now $id contains the value sent in the 'id' parameter
        // Use $id to perform your deletion operation or other processing.
    } else {
        // Handle the case when the 'id' parameter is not provided.
    }
}
?>