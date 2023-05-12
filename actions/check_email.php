<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/user.class.php');
  require_once(__DIR__ . '/../database/connection.db.php');

  $db = getDatabaseConnection();

  $email = $_POST['email'];

  // Check if the email is already registered
  if (User::emailExists($db, $email)) {
    echo "registered";
  } else {
    echo "available";
  }
?>