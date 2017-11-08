<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../model/bettable.php';

$database = new Database();
$db = $database->getConnection();

$bet = new BetTable($db);

$bet->setCoinname( isset($_POST['coinname']) ? $_POST['coinname'] : die() );
$bet->setUsername( isset($_POST['username']) ? $_POST['username'] : die() );
$bet->setPercent( isset($_POST['percent']) ? $_POST['percent'] : die() );
$bet->setIncdec( isset($_POST['incdec']) ? $_POST['incdec'] : die() );
$bet->setBitcoin( isset($_POST['bitcoin']) ? $_POST['bitcoin'] : die() );

$message = $bet->create() ? 'Success' : 'Fail';
echo $message;
