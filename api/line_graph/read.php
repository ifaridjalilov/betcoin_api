<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../model/line_graph.php';

$database = new Database();
$db = $database->getConnection();

$lg = new LineGraph($db);

$lgAll = $lg->readAll();

$result = count($lgAll) > 0 ? json_encode($lgAll) : 'Fail';
echo $result;
