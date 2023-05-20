<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/ticket.class.php');
  require_once(__DIR__ . '/../database/connection.db.php');

  $db = getDatabaseConnection();

  $ticket_id = intval($_POST['ticket_id']);

  $ticket = Ticket::getTicketById($db, $ticket_id);
  $ticket->markClosed($db);

  header('Location: ../pages/ticket.php?id=' . $ticket_id);
?>