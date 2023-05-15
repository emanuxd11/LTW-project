<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');

  require_once(__DIR__ . '/../database/ticket.class.php');

  require_once(__DIR__ . '/../database/user.class.php');

  require_once(__DIR__ . '/../templates/common.tpl.php');

  require_once(__DIR__ . '/../templates/ticket_show.tpl.php');

  $db = getDatabaseConnection();

  $ticket_id = intval($_GET['id']);
  $ticket = Ticket::getTicketByID($db, $ticket_id);

  drawHeader($session);
  drawTicket($ticket, User::getUser($db, $ticket->client_id));
  drawFooter();
?>