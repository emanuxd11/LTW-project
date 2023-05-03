<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  $status = User::registerUser($db, $_POST['username'], $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'], $_POST['password_confirmation']);

  if ($status !== true) { 
    $session->addMessage('error', $status);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  } else {
    $session->addMessage('success', 'Registration successful! You can now log in.');
    header('Location: ../pages/login.php');
  }
?>