<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');


$link = mysqli_connect("localhost", "root", "root", "study1");
if ($link == false){
  print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}

$sql = 'SELECT id, name, price FROM products';
$result = mysqli_query($link, $sql);

$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo(json_encode($rows));

