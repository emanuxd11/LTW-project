<?php
  declare(strict_types = 1);

  class User {
    public int $id;
    public string $first_name;
    public string $last_name;
    public string $username;
    public string $email;
    public string $creation_date;

    public function __construct(int $id, string $first_name, string $last_name, string $username, string $email, string $creation_date) {
      $this->id = $id;
      $this->first_name = $first_name;
      $this->last_name = $last_name;
      $this->username = $username;
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

    public function isUserClient($db): bool {
      $stmt = $db->prepare('
        SELECT id FROM client WHERE user_id = ?
      ');
      
      $stmt->execute(array($this->id));
      $row = $stmt->fetch();

      return $row !== false;
    }

    public function isUserAgent($db): bool {
      $stmt = $db->prepare('
        SELECT id FROM agent WHERE user_id = ?
      ');
      
      $stmt->execute(array($this->id));
      $row = $stmt->fetch();
      
      return $row !== false;
    }

    public function isUserAdmin($db): bool {
      $stmt = $db->prepare('
        SELECT id FROM admin WHERE user_id = ?
      ');
      
      $stmt->execute(array($this->id));
      $row = $stmt->fetch();
      
      return $row !== false;
    }
    
    static function passwordStrong(string $password): bool {
      if (strlen($password) < 8) {
        return false;
      }

      if (!preg_match("#[0-9]+#", $password)) {
        return false;
      }

      if (!preg_match("#[a-zA-Z]+#", $password)) {
        return false;
      }

      return true;
    }

    static function passwordTooLong(string $password): bool {
      if (strlen($password) > 20) {
        return true;
      }

      return false;
    }

    static function emailExists(PDO $db, string $email): bool {
      $stmt = $db->prepare('
        SELECT id FROM user WHERE email = ?
      ');
      
      $stmt->execute(array($email));
      $row = $stmt->fetch();
      
      return $row !== false;
    }

    static function usernameExists(PDO $db, string $username): bool {
      $stmt = $db->prepare('
        SELECT id FROM user WHERE username = ?
      ');

      $stmt->execute(array($username));
      $row = $stmt->fetch();
      
      return $row !== false;
    }

    static function passwordsMatch(string $password, string $password_confirmation): bool {
      return $password == $password_confirmation;
    }

    static function registerUser(PDO $db, string $username, string $email, string $password, string $password_confirmation) {
      // check if email exists
      if (User::emailExists($db, $email)) {
        return "Email is already registered.";
      }

      // check if username exists
      if (User::usernameExists($db, $username)) {
        return "Username already exists.";
      }

      // check if password is strong enough
      if (!User::passwordStrong($password)) {
        return "Password must include at least one number, one letter and be at least 8 characters long.";
      }

      // check if password is too long
      if (User::passwordTooLong($password)) {
        return "Password cannot be longer than 20 characters.";
      }

      // check if passwords match
      if (!User::passwordsMatch($password, $password_confirmation)) {
        return "Passwords don't match";
      }
      
      // insert user into user table
      $stmt = $db->prepare('
        INSERT INTO user (username, email, password) VALUES ( ?, ?, ? )
      ');
      $stmt->execute(array($username, $email, password_hash($password, PASSWORD_DEFAULT)));

      // insert user into client table (default, this can be altered later by an admin)
      $stmt = $db->prepare('
        INSERT INTO client (user_id)
        SELECT id FROM user WHERE username = ?
      ');
      $stmt->execute(array($username));

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
        (int)$user['id'],
        (string)$user['first_name'],
        (string)$user['last_name'],
        (string)$user['username'],
        (string)$user['email'],
        (string)$user['creation_date']
      );
    }
  }
?>