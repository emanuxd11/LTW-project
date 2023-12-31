<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  $user = User::getUserWithPassword($db, $_POST['email'], $_POST['password']);

  if ($user) {
    $session->setId($user->id);
    $session->setUsername($user->username);
    // $session->addMessage('success', 'Login successful!');
    header('Location: ../index.php');
  } else {
    $session->addMessage('error', 'The username or password did not match, please try again.');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
?>