<?php

/**
*  Database Connection
*/
class Database
{
  private $hostname = "localhost";
  private $database = "betcoin";
  private $username = "root";
  private $password = "";

  public $connection;

  public function getConnection()
  {
    $this->connection = null;

    try {
      $this->connection = new PDO("mysql:host=".$this->hostname.";dbname=".$this->database, $this->username, $this->password);
      $this->connection->exec("SET NAMES UTF8");
    } catch (PDOException $e) {
      echo "Database connection error: ".$e->getMessage();
    }

    return $this->connection;
  }
}
