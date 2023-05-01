<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  // ele regista
  // não está ainda a dar login
  // verificar antes de registar se o utilizador já existe
  // pedir nome real e confirmação de pass
  // redirecionar para o login após o registo

  User::registerUser($db, $_POST['username'], $_POST['name'], $_POST['email'], $_POST['password']);

  /* if ($user) {
    $session->setId($user->id);
    $session->setName($user->name());
    $session->addMessage('success', 'Login successful!');
  } else {
    $session->addMessage('error', 'Wrong password!');
  } */

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>