<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/user.class.php');
  require_once(__DIR__ . '/../database/connection.db.php');

  $password = $_POST['password'];

  // Check if the password meets the requirements
  if (!User::passwordStrong($password)) {
    echo "not_strong";
  } else if(User::passwordTooLong($password)) {
    echo "too_long";
  } else {
    echo "strong";
  }
?>