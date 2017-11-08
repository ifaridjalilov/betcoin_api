<?php

class User
{
  private $connection;
  private $id;
  private $username;
  private $email;
  private $password;
  private $wallet_address;

  public function __construct( $connection )
  {
    $this->connection = $connection;
  }

  /* Getters */
  public function getId()
  {
    return $this->id;
  }
  public function getUsername()
  {
    return $this->username;
  }
  public function getEmail()
  {
    return $this->email;
  }
  public function getPassword()
  {
    return $this->password;
  }
  public function getWalletAddress()
  {
    return $this->wallet_address;
  }
  /*********************/

  /* Setters */
  public function setId($id)
  {
    $this->id = $id;
  }
  public function setUsername($username)
  {
    $this->username = $username;
  }
  public function setEmail($email)
  {
    $this->email = $email;
  }
  public function setPassword($password)
  {
    $this->password = md5($password);
  }
  public function setWalletAddress($wallet_address)
  {
    $this->wallet_address = $wallet_address;
  }
  /*************************/

  public function readAll()
  {
    $stmt = $this->connection->prepare("
      SELECT * FROM users
    ");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function create()
  {
    $stmt = $this->connection->prepare("
      SELECT username FROM users WHERE username = :username
    ");
    $stmt->bindParam(":username", $this->username);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!(count($result) > 0))
    {
      $stmt = $this->connection->prepare("
        INSERT INTO users
          (username, email, password, wallet_address)
        VALUES
          (:username, :email, :password, :wallet_address)
      ");
      $stmt->bindParam(":username", $this->username);
      $stmt->bindParam(":email", $this->email);
      $stmt->bindParam(":password", $this->password);
      $stmt->bindParam(":wallet_address", $this->wallet_address);
      return $stmt->execute() ? true : false;
    }
    else
    {
      return -1;
    }
  }

  public function readOne()
  {
    $stmt = $this->connection->prepare("
      SELECT username FROM users
      WHERE username = :username AND password = :password
    ");
    $stmt->bindParam(":username", $this->username);
    $stmt->bindParam(":password", $this->password);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->username = $result['username'];
  }
  //
  // public function update()
  // {
  //   $stmt = $this->connection->prepare("
  //     UPDATE
  //       tasks
  //     SET
  //       name = :name,
  //       is_active = :is_active
  //     WHERE
  //       id = :id
  //   ");
  //   $stmt->bindParam(':id', $this->id);
  //   $stmt->bindParam(':name', $this->name);
  //   $stmt->bindParam(':is_active', $this->is_active);
  //
  //   return $stmt->execute() ? true : false;
  // }
  //
  // public function delete()
  // {
  //   $stmt = $this->connection->prepare("
  //     DELETE FROM tasks WHERE id = :id
  //   ");
  //   $stmt->bindParam(':id', $this->id);
  //
  //   return $stmt->execute() ? true : false;
  // }
}
