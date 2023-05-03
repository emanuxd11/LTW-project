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
    error_log("Email already registered: " . $email . "\n", 3, '../error.log');
    $session->addMessage('error', 'Email already registered.');
    echo "registered";
  } else {
    $session->addMessage('success', 'Email available.');
    echo "available";
  }
?>