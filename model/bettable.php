<?php

class BetTable
{
  private $connection;
  private $id;
  private $coinname;
  private $username;
  private $percent;
  private $incdec;
  private $bitcoin;
  private $date;
  private $status;

  public function __construct( $connection )
  {
    $this->connection = $connection;
  }

  /* Getters */
  public function getId()
  {
    return $this->id;
  }
  public function getCoinname()
  {
    return $this->coinname;
  }
  public function getUsername()
  {
    return $this->username;
  }
  public function getPercent()
  {
    return $this->percent;
  }
  public function getIncdec()
  {
    return $this->incdec;
  }
  public function getBitcoin()
  {
    return $this->bitcoin;
  }
  public function getDate()
  {
    return $this->date;
  }
  public function getStatus()
  {
    $status_name = '';
    switch ($this->status)
    {
      case 0:
        $status_name = '';
        break;
      case 1:
        $status_name = 'Uğurlu';
        break;
      case 2:
        $status_name = 'Uğursuz';
        break;
      case 3:
        $status_name = 'Əməliyyatda';
        break;
    }
    return $status_name;
  }
  /**********************/

  /* Setters */
  public function setId($id)
  {
    $this->id = $id;
  }
  public function setCoinname($coinname)
  {
    $this->coinname = $coinname;
  }
  public function setUsername($username)
  {
    $this->username = $username;
  }
  public function setPercent($percent)
  {
    $this->percent = $percent;
  }
  public function setIncdec($incdec)
  {
    $this->incdec = $incdec;
  }
  public function setBitcoin($bitcoin)
  {
    $this->bitcoin = $bitcoin;
  }
  public function setStatus($status)
  {
    $this->status = $status;
  }
  /*********************/

  public function create()
  {
    $stmt = $this->connection->prepare("
      INSERT INTO bettable
        (coinname, username, percent, incdec, bitcoin)
      VALUES
        (:coinname, :username, :percent, :incdec, :bitcoin)
    ");
    $stmt->bindParam(":coinname", $this->coinname);
    $stmt->bindParam(":username", $this->username);
    $stmt->bindParam(":percent", $this->percent);
    $stmt->bindParam(":incdec", $this->incdec);
    $stmt->bindParam(":bitcoin", $this->bitcoin);
    return $stmt->execute() ? true : false;
  }

  public function readBets()
  {
    $stmt = $this->connection->prepare("
      SELECT * FROM bettable
      WHERE username = :username
    ");
    $stmt->bindParam(":username", $this->username);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
}
