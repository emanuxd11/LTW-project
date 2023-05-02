<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  // verificar antes de registar se o utilizador já existe
  // pedir nome real e confirmação de pass
  // redirecionar para o login após o register

  $status = User::registerUser($db, $_POST['username'], $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'], $_POST['password_confirmation']);

  if ($status !== true) { 
    $session->addMessage('error', $status);
  }

  /* if ($user) {
    $session->setId($user->id);
    $session->setName($user->name());
    $session->addMessage('success', 'Login successful!');
  } else {
    $session->addMessage('error', 'Wrong password!');
  } */

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>