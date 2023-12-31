<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  // se já tiver sessão iniciada redireciona para a página principal
  if ($session->isLoggedIn()) {
    header('Location: index.php');
  }

  require_once(__DIR__ . '/../database/connection.db.php');

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../templates/register.tpl.php');

  $db = getDatabaseConnection();

  drawHeaderWithoutLogin($session);
  drawRegisterForm($session);
  drawFooter();
?>