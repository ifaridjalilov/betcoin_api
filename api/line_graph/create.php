<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../model/line_graph.php';

$database = new Database();
$db = $database->getConnection();

$lg = new LineGraph($db);
$datas = json_decode(file_get_contents('https://api.coinmarketcap.com/v1/ticker/?limit=20'), true);

foreach ($datas as $data)
{
  for($i = 0; $i < 7; $i++)
  {
    $price = $data['price_usd'];
    $lg->setName($data['name']);
    $lg->setPriceUsd($price + rand(-$price/100, $price/100));
    $lg->setDate( date('Y-m-d', strtotime('-6 days +'.$i.' days')) );
    $lg->create();
  }
}
