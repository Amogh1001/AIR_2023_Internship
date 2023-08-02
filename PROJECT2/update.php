<?php
require __DIR__.'/classes/rest.php';
$rawData = file_get_contents('php://input');
$data = json_decode($rawData, true);
echo $data->name;
echo "\n";
echo $data->age;

$rest = new rest();

?>