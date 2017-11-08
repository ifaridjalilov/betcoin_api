<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../model/task.php';

$database = new Database();
$db = $database->getConnection();

$tasks = new Task($db);

$allTasks = $tasks->readAll();
$count = count($allTasks);

if ($count > 0)
{
  print json_encode($allTasks);
}
else {
  print json_encode(
    [ 'message' => 'No tasks' ]
  );
}
