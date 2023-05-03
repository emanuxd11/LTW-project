<?php
  declare(strict_types = 1);

  class User {
    public int $id;
    public string $first_name;
    public string $last_name;
    public string $username;
    public string $email;
    public string $creation_date;

    public function __construct(int $id, string $first_name, string $last_name, string $email, string $username, string $creation_date) {
      $this->id = $id;
      $this->first_name= $first_name;
      $this->last_name= $last_name;
      $this->email = $email;
      $this->creation_date = $creation_date;
    }

    function save($db) {
      $stmt = $db->prepare('
        UPDATE user SET username = ?
        WHERE id = ?
      ');

      $stmt->execute(array($this->username, $this->id));
    }
    
    static function emailExists(PDO $db, string $email): bool {
      $stmt = $db->prepare('
        SELECT id FROM user WHERE email = ?
      ');
      
      $stmt->execute(array($email));
      $row = $stmt->fetch();
      
      return $row != false;
    }

    static function usernameExists(PDO $db, string $username): bool {
      $stmt = $db->prepare('
        SELECT id FROM user WHERE username = ?
      ');

      $stmt->execute(array($username));
      $row = $stmt->fetch();
      
      return $row != false;
    }

    static function passwordsMatch(string $password, string $password_confirmation): bool {
      return $password == $password_confirmation;
    }

    static function registerUser(PDO $db, string $username, string $first_name, string $last_name, string $email, string $password, string $password_confirmation) {
      // check if email exists
      if (User::emailExists($db, $email)) {
        return "Email is already registered.";
      }

      // check of username exists
      if (User::usernameExists($db, $username)) {
        return "Username already exists.";
      }

      // check if passwords match
      if (!User::passwordsMatch($password, $password_confirmation)) {
        return "Passwords don't match";
      }
      
      $stmt = $db->prepare('
        INSERT INTO user (first_name, last_name, username, email, password) VALUES ( ?, ?, ?, ?, ? )
      ');
      
      $stmt->execute(array($first_name, $last_name, $username, $email, password_hash($password, PASSWORD_DEFAULT)));
      
      return true;
    }

    static function getUserWithPassword(PDO $db, string $email, string $password) : ?User {
      $stmt = $db->prepare('
        SELECT id, first_name, last_name, username, email, creation_date, password
        FROM user 
        WHERE lower(email) = ?
      ');
    
      $stmt->execute(array(strtolower($email)));
      
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
      if ($user && password_verify($password, $user['password'])) {
        return new User (
          $user['id'],
          $user['first_name'],
          $user['last_name'],
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
        SELECT id, first_name, last_name, username, email, creation_date
        FROM user 
        WHERE id = ?
      ');

      $stmt->execute(array($id));
      $user = $stmt->fetch();
      
      return new User (
        $user['id'],
        $user['first_name'],
        $user['last_name'],
        $user['username'],
        $user['email'],
        $user['creation_date']
      );
    }
  }
?>