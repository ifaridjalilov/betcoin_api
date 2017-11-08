<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../model/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$user->setUsername( isset($_POST['username']) ? $_POST['username'] : die() );
$user->setEmail( isset($_POST['email']) ? $_POST['email'] : die() );
$user->setPassword( isset($_POST['password']) ? $_POST['password'] : die() );
$user->setWalletAddress( isset($_POST['wallet_address']) ? $_POST['wallet_address'] : die() );

$result = $user->create();
if ($result === true)
{
  $message = 'Success';
}
else if($result === -1)
{
  $message = 'This username is used';
}
else {
  $message = 'Fail';
}
echo $message;
