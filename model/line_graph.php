<?php

class LineGraph
{
  private $connection;
  private $id;
  private $name;
  private $price_usd;
  private $date;

  public function __construct( $connection )
  {
    $this->connection = $connection;
  }

  /* Getters */
  public function getId()
  {
    return $this->id;
  }
  public function getName()
  {
    return $this->name;
  }
  public function getPriceUsd()
  {
    return $this->price_usd;
  }
  public function getDate()
  {
    return $this->date;
  }
  /*****************/

  /* Setters */
  public function setId($id)
  {
    $this->id = $id;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function setPriceUsd($price_usd)
  {
    $this->price_usd = $price_usd;
  }
  public function setDate($date)
  {
    $this->date = $date;
  }
  /********************/

  public function create()
  {
    $stmt = $this->connection->prepare("
      INSERT INTO line_graph
        (name, price_usd, date)
      VALUES
        (:name, :price_usd, :date)
    ");
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":price_usd", $this->price_usd);
    $stmt->bindParam(":date", $this->date);
    return $stmt->execute() ? true : false;
  }

  public function readAll()
  {
    $stmt = $this->connection->prepare("
      SELECT * FROM line_graph
    ");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $key => $value)
    {
      $result[$key]['price_usd'] = intval($result[$key]['price_usd']);
    }
    return $result;
  }
}
