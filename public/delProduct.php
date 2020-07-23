<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');



$data = file_get_contents('php://input');
$_POST = json_decode($data, true);
if(isset($_POST['id'])){

  $link = mysqli_connect("localhost", "root", "root", "study1");
  if ($link == false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
  }
  $id = mysqli_real_escape_string($link, $_POST['id']);

  $query ="DELETE FROM products WHERE id = '$id'";
  $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

  echo('removed product '.$id);
}
