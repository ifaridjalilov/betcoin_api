<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../../model/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$user->setUsername( isset($_POST['username']) ? $_POST['username'] : die() );
$user->setPassword( isset($_POST['password']) ? $_POST['password'] : die() );
$user->readOne();

$message = ($user->getUsername() != null) ? "Success" : "Fail";
echo $message;
