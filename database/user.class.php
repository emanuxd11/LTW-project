<?php
  declare(strict_types = 1);

  class User {
    public int $id;
    public string $name;
    public string $username;
    public string $email;
    public string $creation_date;

    public function __construct(int $id, string $name, string $email, string $username, string $creation_date) {
      $this->id = $id;
      $this->name= $name;
      $this->email = $email;
      $this->creation_date = $creation_date;
    }

    function save($db) {
      $stmt = $db->prepare('
        UPDATE user SET name = ?
        WHERE id = ?
      ');

      $stmt->execute(array($this->name, $this->id));
    }
    
    static function registerUser(PDO $db, string $username, string $name, string $email, string $password) {
      $stmt = $db->prepare('
        INSERT INTO user (name, username, email, password) VALUES ( ?, ?, ?, ? )
      ');
      
      try {
        $stmt->execute(array($name, $username, $email, password_hash($password, PASSWORD_DEFAULT)));
      } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    }

    static function getUserWithPassword(PDO $db, string $email, string $password) : ?User {
      error_log('password is: ' . $password, 3, "./error.log");

      $stmt = $db->prepare('
        SELECT id, name, username, email, creation_date, password
        FROM user 
        WHERE lower(email) = ?
      ');
    
      $stmt->execute(array(strtolower($email)));
      
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
      if ($user && password_verify($password, $user['password'])) {
        return new User (
          $user['id'],
          $user['name'],
          $user['username'],
          $user['email'],
          $user['creation_date']
        );
      } else {
        return null;
      }
    }

    static function getUser(PDO $db, int $id) : User {
      $stmt = $db->prepare('
        SELECT id, name, username, email, creation_date
        FROM user 
        WHERE id = ?
      ');

      $stmt->execute(array($id));
      $user = $stmt->fetch();
      
      return new User (
        $user['id'],
        $user['name'],
        $user['username'],
        $user['email'],
        $user['creation_date']
      );
    }
  }
?>