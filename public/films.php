<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header("Content-type: application/json; charset=utf-8");
error_reporting(E_ALL);
ini_set("display_errors", 0);



function get_films() {
  return [
    '1' => [
      'id' => '1',
      'name' => 'Спиздили',
    ],

    '2' => [
      'id' => '2',
      'name' => 'Карты деньги, два ствола',
    ],

    '3' => [
      'id' => '3',
      'name' => 'Титаник',
    ],

    '4' => [
      'id' => '4',
      'name' => 'Джуманджи',
    ],

    '5' => [
      'id' => '5',
      'name' => 'Немецкие официантки',
    ],

    '6' => [
      'id' => '6',
      'name' => 'Любовь и голуби',
    ],
    '7' => [
      'id' => '7',
      'name' => 'Выживший',
    ],

  ];
}

function get_films_attribute($id, $attr) {
  $films = get_films();
  $result = $films[$id][$attr] ?? null;
  return $result;
}

function get_film_name($id) {
  return get_films_attribute($id, 'name');
}

function get_film($id) {
  $films = get_films();
  $result = $films[$id];
  return $result;
}
$films = get_films();
$arr = (array) $films;
echo json_encode($arr, true);


