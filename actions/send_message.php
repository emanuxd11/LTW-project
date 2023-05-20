<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/ticket.class.php');
  require_once(__DIR__ . '/../database/message.class.php');
  require_once(__DIR__ . '/../database/connection.db.php');

  $db = getDatabaseConnection();

  $text = $_POST['text'];
  $ticket_id = intval($_POST['ticket_id']);
  $sender_id = intval($_POST['sender_id']);

  Message::storeMessage($db, $text, $ticket_id, $sender_id);

  header("Location: /pages/ticket.php?id=" . $ticket_id)
?>
