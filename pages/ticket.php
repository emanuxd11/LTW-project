<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) {
    header('Location: ../pages/login.php');
  }

  require_once(__DIR__ . '/../database/connection.db.php');

  require_once(__DIR__ . '/../database/ticket.class.php');

  require_once(__DIR__ . '/../database/user.class.php');

  require_once(__DIR__ . '/../templates/common.tpl.php');

  require_once(__DIR__ . '/../templates/ticket_show.tpl.php');

  $db = getDatabaseConnection();

  $ticket_id = intval($_GET['id']);
  $ticket = Ticket::getTicketByID($db, $ticket_id);

  drawHeader($session);

  if ($session->isSessionAgent($db)) {
    drawTicketAgentView($ticket, User::getUser($db, $ticket->client_id));
  } else if ($session->isSessionAdmin($db)) {
    drawTicketAdminView($ticket, User::getUser($db, $ticket->client_id));
  } else {
    drawTicketClientView($ticket, User::getUser($db, $ticket->client_id));
  }

  drawFooter();
?>