<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');


$link = mysqli_connect("localhost", "root", "root", "study1");

if ($link == false){
  print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}

$data = file_get_contents('php://input');
$_POST = json_decode($data, true);


function addProduct($name, $price, $link)
{
  $sql = sprintf("INSERT INTO products (name, price) VALUES ('%s', '%s')", $name, $price);
  $result = mysqli_query($link, $sql);
  if ($result) {
    echo 'Добавлен продукт '.$name;
  }
}


if (isset($_POST['name']) && isset($_POST['price'])) {
  $name = htmlspecialchars($_POST['name']);
  $price = htmlspecialchars($_POST['price']);
  addProduct($name, $price, $link);
}

