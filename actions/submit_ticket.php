<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');
  require_once(__DIR__ . '/../database/ticket.class.php');

  $db = getDatabaseConnection();

  $id = Ticket::submitTicket($db, $_POST['department'], $_POST['title'], $_POST['description'], $session->getId());

  header('Location: ../pages/ticket.php?id=' . $id);
?>
