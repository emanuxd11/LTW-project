<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/user.class.php');
  require_once(__DIR__ . '/../database/connection.db.php');

  $db = getDatabaseConnection();

  $username = $_POST['username'];

  // Check if the email is already registered
  if (User::usernameExists($db, $username)) {
    echo "taken";
  } else {
    echo "available";
  }
?>