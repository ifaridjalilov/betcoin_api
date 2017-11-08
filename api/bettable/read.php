<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../model/bettable.php';

$database = new Database();
$db = $database->getConnection();

$bet = new BetTable($db);

$bet->setUsername( isset($_POST['username']) ? $_POST['username'] : die() );
$bets = $bet->readBets();

$result = count($bets) > 0 ? json_encode($bets) : 'Fail';
echo $result;
