<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header("Content-type: application/json; c harset=utf-8");
error_reporting(E_ALL);
ini_set("display_errors", 0);

$data = file_get_contents('php://input');
$name = json_decode($data)->name;
$todayDate = json_decode($data)->date;
$file_name = 'saved/'.$name.'_'.$todayDate.'.json';
file_put_contents($file_name, $data);

echo($file_name);




