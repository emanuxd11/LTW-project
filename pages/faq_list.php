<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');

  require_once(__DIR__ . '/../templates/common.tpl.php');
  
  require_once(__DIR__ . '/../templates/faq.tpl.php');

  $db = getDatabaseConnection();

  drawHeader($session);
  
  drawFaqsPreview($session, $db);

  if ($session->isLoggedIn()) {
    if ($session->isSessionAdmin($db) or $session->isSessionAgent($db)) {
      drawFaqFormLink();    
    }
  }

  drawFooter();
?>