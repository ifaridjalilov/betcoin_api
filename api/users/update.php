<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../model/task.php';

$database = new Database();
$db = $database->getConnection();

$task = new Task($db);

$data = json_decode(file_get_contents("php://input"));

$task->setId( $data->id );

$task->setName( $data->name );
$task->getActive( $data->is_active );

if($task->update()){
  echo '{';
  echo '  "message": "Product was updated."';
  echo '}';
}
else{
  echo '{';
  echo '  "message": "Unable to update product."';
  echo '}';
}
