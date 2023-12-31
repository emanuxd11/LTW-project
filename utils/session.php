<?php
  require_once(__DIR__ . '/../database/user.class.php');

  class Session {
    private array $messages;

    public function __construct() {
      session_start();

      $this->messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
      unset($_SESSION['messages']);
    }

    public function isLoggedIn() : bool {
      return isset($_SESSION['id']);    
    }

    public function logout() {
      session_destroy();
    }

    public function isSessionAgent(PDO $db) : bool {
      $user = User::getUser($db, $_SESSION['id']);
      return $user->isUserAgent($db);
    }

    public function isSessionAdmin(PDO $db) : bool {
      $user = User::getUser($db, $_SESSION['id']);
      return $user->isUserAdmin($db);
    }

    public function getId() : ?int {
      return isset($_SESSION['id']) ? $_SESSION['id'] : null;    
    }

    public function getUsername() : ?string {
      return isset($_SESSION['username']) ? $_SESSION['username'] : null;
    }

    public function getName() : ?string {
      return isset($_SESSION['name']) ? $_SESSION['name'] : null;
    }

    public function setId(int $id) {
      $_SESSION['id'] = $id;
    }

    public function setUsername(string $username) {
      $_SESSION['username'] = $username;
    }

    public function setName(string $first_name, string $last_name) {
      $_SESSION['name'] = $first_name . ' ' . $last_name;
    }

    public function addMessage(string $type, string $text) {
      $_SESSION['messages'][] = array('type' => $type, 'text' => $text);
    }

    public function getMessages() {
      return $this->messages;
    }
  }
?>